<?php

namespace app\controllers;

use Yii;
use app\models\Questions;
use app\models\Section;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;

/**
 * QuestionsController implements the CRUD actions for Questions model.
 */
class QuestionsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['create', 'update'], If this is enable only the action in that array will not be accessible
                'rules' => [
                    [
                        'actions' => ['index'], // Only the action in this array will be accessible
                        'allow' => true
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                    
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex($id)
    {        

        $id = (Int)$id;
        $model = new Questions();
        $section = Section::findOne($id);
        $allQuestion = Questions::find()->where(['section_id' => $id])->count();

        if ($model->load(Yii::$app->request->post())) {

            $model->section_id = $id;

            $imageFile = UploadedFile::getInstance($model, 'image');

            $time = '';
            if(isset($imageFile->size)){

                if(!file_exists(Url::to('images/question_images/'))){
                    mkdir(Url::to('images/question_images/'), 0777, true);
                }

                $time = time().rand(100, 999);
                $imageName = Url::to('images/question_images/').'/'.$time.'.'.$imageFile->extension;

                $imageFile->saveAs($imageName);
            }

            $model->image = $time.'.'.$imageFile->extension;

            if ($model->validate()) {

                $model->save(false);

                return $this->redirect(Yii::$app->request->referrer);
            } else {

                $errors = json_encode($model->errors);
                
                    echo "<h2 style='background-color: #ffffff; padding: 10px; color: red;'>$errors</h2>";
            }
        }
                
        $query = Questions::find()->where(['section_id' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 1]);

        $question = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'model' => $model,
            'question' => $question,
            'section' => $section,
            'pagination' => $pagination,
            'allQuestion' => $allQuestion,
        ]);

    }

    /**
     * Displays a single Questions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Questions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->post());

        $imageFile = UploadedFile::getInstance($model, 'image');

        $time = '';
        if(isset($imageFile->size)){

            if(!file_exists(Url::to('images/question_images/'))){
                mkdir(Url::to('images/question_images/'), 0777, true);
            }

            $time = time().rand(100, 999);
            $imageName = Url::to('images/question_images/').'/'.$time.'.'.$imageFile->extension;

            $imageFile->saveAs($imageName);
        }

        $model->image = $time.'.'.$imageFile->extension;

        if ($model->validate()) {

                $model->save(false);

                return $this->redirect(Yii::$app->request->referrer);
         } else {

            $errors = json_encode($model->errors);
            
                echo "<h2 style='background-color: #ffffff; padding: 10px; color: red;'>$errors</h2>";
        }
        
    }

    /**
     * Deletes an existing Questions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
