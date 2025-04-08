<?php

namespace frontend\views\generate\controllers;

use common\models\SchoolYear;
use common\models\StudentData;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\StudentViolation;
use DateTime;
use Yii;
use yii\base\DynamicModel;

use yii\filters\AccessControl;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
use yii\web\Response;
use PhpOffice\PhpSpreadsheet\Style\Font;

class GmcController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'generate' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['Guidance'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $model = new DynamicModel(['student_data_id', 'schoolYearDropdown', 'gradeDropdown', 'strandDropdown', 'sectionDropdown']);
        $model->addRule(['student_data_id'], 'required');
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionGenerate()
    {
        $model = new DynamicModel(['student_data_id', 'schoolYearDropdown', 'gradeDropdown', 'strandDropdown', 'sectionDropdown']);
        $model->addRule(['student_data_id'], 'required');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $studentId = $model->student_data_id;

            $schoolYearId = Yii::$app->request->post('schoolYearDropdown');

            $hasUnsettledViolation = StudentViolation::find()
                ->where(['student_data_id' => $studentId,])
                ->andWhere(['school_year_id' => $schoolYearId])
                ->andWhere(['is_settled' => '0'])
                ->exists();

            if ($hasUnsettledViolation) {
                Yii::$app->session->setFlash('error', 'Cannot generate Good Moral. The student has unsettled violations in the selected school year.');
                return $this->render('index', [
                    'model' => $model,
                ]);
            } else {
                return $this->redirect(['generate-gmc', 'studentId' => $studentId, 'schoolYearId' => $schoolYearId]);
            }
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    public function actionGenerateGmc($studentId, $schoolYearId)
    {

        $templatePath = Yii::getAlias('@frontend/web/templates/good-moral-template.xlsx');

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $student = StudentData::findOne($studentId);
        $schoolYear = SchoolYear::findOne($schoolYearId);

        if (!$student || !$schoolYear || !$student->personalInformation) {
            Yii::$app->session->setFlash('error', 'Error: Could not retrieve student or school year information.');
            return $this->redirect(['gmc/index']);
        }

        $sheet->setCellValue('D13', strtoupper($student->personalInformation->fullName) . ' - (' . $student->strand->name . ')');
        $sheet->getStyle('D13')->getFont()->setBold(true);
        $sheet->setCellValue('A14', 'is a former learner of this institution for the school year ' . $schoolYear->name);

        $today = new DateTime();
        $day = $today->format('jS');
        $month = $today->format('F');
        $year = $today->format('Y');

        $formattedDate = $day . ' day of ' . $month . ' ' . $year;

        $sheet->setCellValue('C35', $formattedDate . ' at Don Eufemio F. Eriguel Memorial National High School,');


        $writer = new Xlsx($spreadsheet);
        $filename = 'Good_Moral_Certificate_' . $student->personalInformation->last_name . '_' . $student->personalInformation->first_name . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        Yii::$app->end();
    }

    public function actionGenerateAnecdotal($studentId) {}
}
