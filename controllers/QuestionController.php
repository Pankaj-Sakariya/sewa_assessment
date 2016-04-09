<?php

namespace app\controllers;

use Yii;
use app\models\Question;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Question();

//        display_array($model);
//            exit();
//        
        
        
        if ($model->load($_POST))
        {
            
            
            if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                $path_info = pathinfo(\yii\web\UploadedFile::getInstance($model, 'image')->name);
//                display_array($path_info);
                
                $model->image = $model->id . '.' . $path_info['extension'];
                
                 
            }
        
               if($model->save()) {
                   
                   
                    if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                    $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
//                    display_array($model->image);
//                    exit;
                    $model->upload($model->id);
                
               }
            return $this->redirect(['view', 'id' => $model->id]);
               }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        
        if ($model->load($_POST))
        {
            
            if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                $path_info = pathinfo(\yii\web\UploadedFile::getInstance($model, 'image')->name);
//                display_array($path_info);
                
                $model->image = $model->id . '.' . $path_info['extension'];
                
                 
            }
        
               if($model->save()) {
                   
                   
                    if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                    $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
//                    display_array($model->image);
//                    exit;
                    $model->upload($model->id);
                
               }
            return $this->redirect(['view', 'id' => $model->id]);
               }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    

    public function actionRemovePhotograph($id) {

        $QuestionModel = Question::find()->where(['id' => $id])->one();
        $QuestionModel->image = "";
        $QuestionModel->save(false);
    }

    public function actionRemoveImage($image_path) {
        if (file_exists($image_path)) {
            unlink($image_path);
            echo '1';
        } else {
            echo '0';
        }
    }
    
    
}
