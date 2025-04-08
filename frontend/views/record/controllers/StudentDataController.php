<?php

namespace frontend\views\record\controllers;

use common\models\ActiveSchoolYearSem;
use common\models\GradeLevel;
use common\models\PersonalInformation;
use common\models\StudentData;
use common\models\searches\StudentDataSearch;
use common\models\Section;
use common\models\Strand;
use common\models\StudentGuardian;
use common\models\StudentInformation;
use common\models\StudentPlan;
use common\models\StudentViolation;
use common\models\TeacherAdvisoryAssignment;
use DateTime;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StudentDataController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new StudentDataSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $studentData = new StudentData();
        $studentPersonalInfo = new PersonalInformation();
        $studentInfo = new StudentInformation();
        $studentPlan = new StudentPlan();
        $studentGuardian = new StudentGuardian();
        $guardianPersonalInfo = new PersonalInformation();

        $studentData->school_year_id = ActiveSchoolYearSem::getActiveSchoolYearId();

        $teacherId = Yii::$app->user->id;

        $assignment = TeacherAdvisoryAssignment::find()
            ->where(['user_id' => $teacherId])
            ->andWhere(['school_year_id' => $studentData->school_year_id])
            ->one();

        if ($assignment) {
            $studentData->adviser_id = $assignment->user_id;
            $studentData->grade_level_id = $assignment->grade_level_id;
            $studentData->strand_id = $assignment->strand_id;
            $studentData->section_id = $assignment->section_id;
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (
                    $studentData->load($post) &&
                    $studentPersonalInfo->load($post, 'StudentPersonalInformation') &&
                    $studentInfo->load($post) &&
                    $studentPlan->load($post) &&
                    $studentGuardian->load($post) &&
                    $guardianPersonalInfo->load($post, 'GuardianPersonalInformation')
                ) {
                    $studentPersonalInfo->save(false);
                    $studentInfo->save(false);
                    $studentPlan->save(false);
                    $guardianPersonalInfo->save(false);

                    $studentGuardian->personal_information_id = $guardianPersonalInfo->id;
                    $studentGuardian->save(false);

                    $studentData->personal_information_id = $studentPersonalInfo->id;
                    $studentData->student_information_id = $studentInfo->id;
                    $studentData->student_plan_id = $studentPlan->id;
                    $studentData->guardian_id = $studentGuardian->id;

                    $studentData->save(false);

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Student was Added successfully.');
                    return $this->redirect(['view', 'id' => $studentData->id]);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                if (strpos($e->getMessage(), 'UNIQUE constraint failed: student_data.lrn') !== false) {
                    Yii::$app->session->setFlash('error', 'LRN already exists. Please enter a unique LRN.');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save Student. Please check the form for errors.');
                }
                Yii::error('Transaction failed: ' . $e->getMessage());
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Failed to save Student. Please check the form for errors.');
                Yii::error('Transaction failed: ' . $e->getMessage());
            }
        }

        return $this->renderAjax('_form', [
            'studentDataModel' => $studentData,
            'studentPersonalInformationModel' => $studentPersonalInfo,
            'studentInformationModel' => $studentInfo,
            'studentPlanModel' => $studentPlan,
            'studentGuardianModel' => $studentGuardian,
            'guardianPersonalInformationModel' => $guardianPersonalInfo,
        ]);
    }

    public function actionUpdate($id)
    {
        $studentDataModel = $this->findModel($id);

        $studentPersonalInformationModel = PersonalInformation::findOne($studentDataModel->personal_information_id);
        $studentInformationModel = StudentInformation::findOne($studentDataModel->student_information_id);
        $studentPlanModel = StudentPlan::findOne($studentDataModel->student_plan_id);
        $studentGuardianModel = StudentGuardian::findOne($studentDataModel->guardian_id);
        $guardianPersonalInformationModel = PersonalInformation::findOne($studentGuardianModel->personal_information_id);

        $post = Yii::$app->request->post();

        if (
            $studentDataModel->load($post) &&
            $studentPersonalInformationModel->load($post, 'StudentPersonalInformation') &&
            $studentInformationModel->load($post) &&
            $studentPlanModel->load($post) &&
            $studentGuardianModel->load($post) &&
            $guardianPersonalInformationModel->load($post, 'GuardianPersonalInformation')
        ) {
            $isValid = $studentDataModel->validate();
            $isValid = $studentPersonalInformationModel->validate() && $isValid;
            $isValid = $studentInformationModel->validate() && $isValid;
            $isValid = $studentPlanModel->validate() && $isValid;
            $isValid = $studentGuardianModel->validate() && $isValid;
            $isValid = $guardianPersonalInformationModel->validate() && $isValid;

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($isValid) {
                    $studentPersonalInformationModel->save(false);
                    $studentInformationModel->save(false);
                    $studentPlanModel->save(false);
                    $guardianPersonalInformationModel->save(false);

                    $studentGuardianModel->personal_information_id = $guardianPersonalInformationModel->id;
                    $studentGuardianModel->save(false);

                    $studentDataModel->personal_information_id = $studentPersonalInformationModel->id;
                    $studentDataModel->student_information_id = $studentInformationModel->id;
                    $studentDataModel->student_plan_id = $studentPlanModel->id;
                    $studentDataModel->guardian_id = $studentGuardianModel->id;

                    $studentDataModel->save(false);

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Student was updated successfully.');
                    return $this->redirect(['view', 'id' => $studentDataModel->id]);
                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Failed to update Student. Please check the form for errors.');
                $transaction->rollBack();
                Yii::error('Transaction failed: ' . $e->getMessage());
            }
        }

        return $this->renderAjax('update', [
            'studentDataModel' => $studentDataModel,
            'studentPersonalInformationModel' => $studentPersonalInformationModel,
            'studentInformationModel' => $studentInformationModel,
            'studentPlanModel' => $studentPlanModel,
            'studentGuardianModel' => $studentGuardianModel,
            'guardianPersonalInformationModel' => $guardianPersonalInformationModel,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model !== null) {
            try {
                if ($model->delete()) {
                    Yii::$app->session->setFlash('success', 'Student Violation deleted successfully.');
                } else {
                    Yii::$app->session->setFlash('warning', 'Student Violation could not be deleted.');
                }
            } catch (\yii\db\IntegrityException $e) {
                Yii::$app->session->setFlash('error', "Can't delete this Student Violation. It is being used in other records.");
            }
        } else {
            Yii::$app->session->setFlash('info', "The requested School Year does not exist.");
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = StudentData::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportAnecdotal($studentId)
    {
        $model = $this->findModel($studentId);

        if (!$model || !$model->personalInformation) {
            Yii::$app->session->setFlash('error', 'Error: Could not retrieve student information for anecdotal report.');
            return $this->redirect(['view', 'id' => $studentId]);
        }

        $templatePath = Yii::getAlias('@frontend/web/templates/anecdotal-template.xlsx');

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('C5', $model->adviser->personalInformation->fullName ?? '-');
        $sheet->setCellValue('C6', $model->studentClass ?? '-');
        $sheet->setCellValue('A10', 'Name: ' . $model->personalInformation->fullName ?? '-');
        $birthdate = '';
        if ($model->personalInformation && $model->personalInformation->birthdate) {
            $birthdate = new DateTime($model->personalInformation->birthdate);
        }
        $sheet->setCellValue('A11', 'Birth Date: ' . ($birthdate ? $birthdate->format('F d, Y') : '-'));
        $sheet->setCellValue('E11', 'Birthplace: ' . $model->personalInformation->birthplace ?? '-');
        $age = '';
        if ($model->personalInformation && $model->personalInformation->birthdate) {
            $birthDate = new DateTime($model->personalInformation->birthdate);
            $currentDate = new DateTime('now', new \DateTimeZone('Asia/Manila'));
            $interval = $currentDate->diff($birthDate);
            $age = $interval->y;
        }
        $sheet->setCellValue('I11', 'Age: ' . $age ?? '');
        $sheet->setCellValue('A13', 'Guardian: ' . $model->guardian->personalInformation->fullName ?? '-');
        $sheet->setCellValue('E13', 'Occupation: ' . $model->guardian->occupation ?? '-');
        $sheet->setCellValue('A14', 'Contact No.: ' . $model->guardian->contact_number ?? '-');
        $sheet->setCellValue('E14', 'Guardian Relation: ' . $model->guardian->relationship->name ?? '-');
        $sheet->setCellValue('A16', 'Language: ' . $model->studentInformation->language ?? '-');
        $sheet->setCellValue('E16', 'Height: ' . $model->studentInformation->height ?? '-');
        $sheet->setCellValue('I16', 'Weight: ' . $model->studentInformation->weight ?? '-');
        $sheet->setCellValue('A17', 'Early Disease/s: ' . $model->studentInformation->early_disease ?? '-');
        $sheet->setCellValue('E17', 'Serious Accidents: ' . $model->studentInformation->serious_accident ?? '-');
        $sheet->setCellValue('A18', 'Hobby: ' . $model->studentInformation->hobby ?? '-');
        $sheet->setCellValue('E18', 'Special Talents: ' . $model->studentInformation->special_talent ?? '-');
        $sheet->setCellValue('A19', 'Subject/s Found Easy: ' . $model->studentInformation->easy_subject ?? '-');
        $sheet->setCellValue('E19', 'Subject/s Found Difficult: ' . $model->studentInformation->hard_subject ?? '-');
        $sheet->setCellValue('A21', 'Higher Education (College): ' . ($model->studentPlan->higher_education ? 'Yes' : 'No'));
        $sheet->setCellValue('A22', 'Employment: ' . ($model->studentPlan->employment ? 'Yes' : 'No'));
        $sheet->setCellValue('A23', 'Entrepreneurship: ' . ($model->studentPlan->entrepreneurship ? 'Yes' : 'No'));
        $sheet->setCellValue('A24', 'Middle-level Skills (TESDA): ' . ($model->studentPlan->tesda ? 'Yes' : 'No'));

        $studentViolations = StudentViolation::find()
            ->where(['lrn_id' => $model->lrn])
            ->all();

        $rowStart = 28;
        $row = $rowStart;
        foreach ($studentViolations as $studentViolation) {
            $sheet->insertNewRowBefore($row, 1);
            $sheet->mergeCells('A' . ($row) . ':B' . ($row));
            $sheet->mergeCells('D' . ($row) . ':E' . ($row));
            $sheet->mergeCells('I' . ($row) . ':J' . ($row));
            $sheet->setCellValue('A' . $row, $studentViolation->violation->name ?? '');
            $createdAt = $studentViolation->created_at ? new DateTime('@' . $studentViolation->created_at) : null;
            $sheet->setCellValue('C' . $row, $createdAt ? $createdAt->format('Y-M-d') : '-');
            $sheet->setCellValue('D' . $row, $studentViolation->user->personalInformation->fullName ?? '-');

            $violationType = $studentViolation->violation->violationType;
            if ($violationType->id === 1) {
                $sheet->setCellValue('F' . $row,  '/');
            } else if ($violationType->id === 2) {
                $sheet->setCellValue('G' . $row, '/');
            }

            $sheet->setCellValue('H' . $row, $studentViolation->is_settled ? 'Settled' : 'Unsettled');

            $styleArray = [
                'alignment' => [
                    'wrapText' => false,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                ],
            ];
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray($styleArray);
            $sheet->getStyle('A' . $row . ':B' . $row)->getAlignment()->setWrapText(true);
            $sheet->getStyle('C' . $row . ':J' . $row)->getAlignment()->setWrapText(false);

            $row++;
        }

        $sheet->removeRow($row);

        $writer = new Xlsx($spreadsheet);
        $filename = 'Anecdotal_Record_' . $model->personalInformation->last_name . '_' . $model->personalInformation->first_name . '-' . time() . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        Yii::$app->end();
    }
}
