<?php
namespace frontend\controllers;

require_once '..\..\vendor\autoload.php';

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use \PhpOffice\PhpSpreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Site controller
 */
class SiteController extends Controller
{
	
	public function actionMyName ()
	{
		return $this->render('my-name');
	}
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index',['name' => 'ВАСЯ']);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionExcel()
    {
        $connect = mysqli_connect("localhost", "root", "", "equip_accounting");
            $sql = "SELECT * FROM equipment_view ORDER BY ID DESC";
            $result = mysqli_query($connect, $sql);
            if(mysqli_num_rows($result) > 0){


                $file = new Spreadsheet();

                $active_sheet = $file->getActiveSheet();

                $active_sheet->setCellValue('A1', 'ID');
                $active_sheet->setCellValue('B1', 'Наименование');
                $active_sheet->setCellValue('C1', 'Тип');
                $active_sheet->setCellValue('D1', 'Компоненты');
                $active_sheet->setCellValue('E1', 'Кабинет');

                $count = 2;

                foreach($result as $row)
                {
                    $active_sheet->setCellValue('A'.$count, $row["ID"]);
                    $active_sheet->setCellValue('B'.$count, $row["Наименование"]);
                    $active_sheet->setCellValue('C'.$count, $row["Тип"]);
                    $active_sheet->setCellValue('D'.$count, $row["Компоненты"]);
                    $active_sheet->setCellValue('E'.$count, $row["Кабинет"]);

                    $active_sheet->getStyle('D'.$count)->getAlignment()->setWrapText(true);

                    $count=$count+1;
                }

                //Настройка стиля
                $active_sheet->getColumnDimension('B')->setWidth(15);
                $active_sheet->getColumnDimension('C')->setWidth(15);
                $active_sheet->getColumnDimension('D')->setWidth(20);

                $styleHeader = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '0000'],
                        ],
                    ],
                ];
                $styleTable = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '0000'],
                        ],
                    ],
                ];

                $active_sheet->getStyle("A2:E$count")->applyFromArray($styleTable);
                $active_sheet->getStyle("A1:E1")->applyFromArray($styleHeader);
                $active_sheet->getStyle("A1:E$count")->applyFromArray($styleHeader);

                $writer = IOFactory::createWriter($file, "Xls");
                $file_name = time().'.'.strtolower('xls');
                $writer->save($file_name);
                header('Content-Type: application/xls');
                header('Content-Transfer-Encoding: Binary');

                header("Content-disposition: attachment; filename=\"".$file_name."\"");
                readfile($file_name);
                unlink($file_name);
            }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
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
}
