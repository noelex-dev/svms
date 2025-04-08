<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PersonalInformation;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['Administrator', 'Guidance'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && $action->id !== 'login') {
            Yii::$app->response->redirect(['site/login']);
            return false;
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $username = Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username;
        return $this->render('index', [
            'username' => $username,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->response->redirect(['site/login']);
        return false;
    }

    public function actionSignup()
    {
        $user = new User();
        $personalInformation = new PersonalInformation();

        if (Yii::$app->request->isPost) {
            if ($user->load(Yii::$app->request->post()) && $personalInformation->load(Yii::$app->request->post())) {

                $isValid = $user->validate();
                $isValid = $personalInformation->validate() && $isValid;

                if ($isValid) {
                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        if (!$personalInformation->save()) {
                            Yii::error('Failed to save personal information: ' . print_r($personalInformation->getErrors(), true));
                            throw new \Exception('Error saving personal details.');
                        }

                        $user->personal_information_id = $personalInformation->id;
                        $user->setPassword($user->password);
                        $user->generateAuthKey();
                        // $user->generateEmailVerificationToken();
                        $user->status = User::STATUS_ACTIVE;

                        if (!$user->save()) {
                            Yii::error('Failed to save user: ' . print_r($user->getErrors(), true));
                            throw new \Exception('Error saving account details.');
                        }

                        $auth = Yii::$app->authManager;
                        $roleName = $user->role;
                        $role = $auth->getRole($roleName);
                        if ($role) {
                            $auth->assign($role, $user->id);
                        } else {
                            Yii::error("Role '{$roleName}' not found in RBAC system.");
                            throw new \Exception("Invalid role selected.");
                        }


                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Account registration successful!');
                        return $this->redirect(['signup']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::error('Signup transaction error: ' . $e->getMessage());
                        Yii::$app->session->setFlash('error', 'Registration could not be completed due to a server error. Please try again later.');
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        Yii::error('Signup transaction error (Throwable): ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine());
                        Yii::$app->session->setFlash('error', 'Registration could not be completed due to a system error. Please contact support.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Please correct the errors indicated below.');
                }
            } else {
                Yii::warning('Failed to load POST data for User or PersonalInformation during signup.');
                Yii::$app->session->setFlash('error', 'Could not process registration data. Please try submitting the form again.');
            }
        }

        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $roleOptions = ArrayHelper::map($roles, 'name', function ($role) {
            return $role->name . ' - ' . $role->description;
        });

        return $this->render('signup', [
            'model' => $user,
            'personalInformationModel' => $personalInformation,
            'roleOptions' => $roleOptions,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        // if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
        //     Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
        //     return $this->goHome();
        // }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
