<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\PersonalInformation; // Make sure this use statement is present

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['roles', 'required'],

            [['personal_information_id'], 'integer'],
            [['personal_information_id'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'personal_information_id' => 'Personal Information ID',
        ];
    }

    public function signup(PersonalInformation $personalInfoModel, array $roles = [])
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->personal_information_id = $personalInfoModel->id;

        if ($user->save()) {
            $personalInfoModel->link('user', $user);

            $auth = Yii::$app->authManager;
            foreach ($roles as $roleName) {
                $role = $auth->getRole($roleName);
                if ($role) {
                    if ($auth->assign($role, $user->getId())) {
                        Yii::info("Assigned role '$roleName' to user ID " . $user->getId());
                    } else {
                        Yii::error("Failed to assign role '$roleName' to user ID " . $user->getId());
                    }
                } else {
                    Yii::warning("Role '$roleName' not found.");
                }
            }

            return $user;
        }

        return null;
    }
}
