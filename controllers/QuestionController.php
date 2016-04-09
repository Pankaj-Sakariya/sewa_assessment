<?php

namespace app\controllers;

use Yii;
use app\models\Question;
use app\models\Answer;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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

        if ($model->load($_POST))
        {   
            //$this->addfielvalue();
            
            if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                $path_info = pathinfo(\yii\web\UploadedFile::getInstance($model, 'image')->name);
//              
                $model->image = $model->id . '.' . $path_info['extension'];
            }
      
            if($model->save())
            {
               if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                    $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
//                    display_array($model->image);
//                    exit;
                    $model->upload($model->id);
                }  
            
            

            $this->saveAnswers($model->id);
            return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        else
        {
         return $this->render('create', [
               'model' => $model,
        ]);
        }

        
                // $question['topic_id'] = $model->topic_id;
                // $question['question_name'] = $model->question_name;
                // $question['weightage_for_question'] = $model->weightage_for_question;
                // $question['is_active'] = $model->is_active;
                // $question['number_of_answer'] = $_POST['number_of_answer'];
                // $answer_id = $_POST['ans'];
                // $ans_txt = $_POST['ans_text'];
                // for($i=0; $i<=5; $i++)
                // {
                //     $answer[$i]["option"][] = $answer_id;
                //     $answer[$i]["option"][] = $ans_txt;
                // }
                // foreach ($answer_id as $key) {
                //     $answer['answer'][] = $key;
                // }
                // foreach ($ans_txt as $value) {
                //     $answer['option'][] = $value;
                // }

                // print_r($answer);
                //print_r($)
             //print_r($question);exit;
             // echo "</pre>";
        
        // } else {
        //     
        // }
    }


    public function saveAnswers($question_id)
    {   
        //display_array($_POST);
        
        
        if(isset($_POST['Answer']))
        {
            $Answer = $_POST['Answer'];
            
             // exit;
      
        foreach ($Answer as $key => $value) {
            //echo $modelAns->is_correct;exit;
//           display_array($Answer);exit;
                
            // $Answer['Answer'][$key]['Answer']['is_correct'] = "0";
             
            $modelAns = new Answer();
            //display_array($modelAns);exit;
            if(isset($Answer[$key]['Answer']['id']))
            {
               $modelAns1 = Answer::find()->where(['id'=>$Answer[$key]['Answer']['id']])->one();
               if($modelAns1!=null)
               {
                    $modelAns = $modelAns1;  
               }
            }


            $modelAns->load($Answer[$key]);
        
            $modelAns->question_id = $question_id;
            
            if(isset($_POST['Answer'][$key]['Answer']['is_correct']))
            {
                 $modelAns->is_correct= 1;
            }
            else{
                 $modelAns->is_correct= 0;
            }
           
            //display_array($modelAns);
            $file_name = $_FILES['Answer']['name'][$key]['Answer']['image'];
            $tmp_name1 = explode(".", $file_name);

            //print_r($Answer[$key]);
            //$modelAns['image']
            $modelAns->save();
//             display_array($modelAns);
//            exit;
            $new_file_name = $modelAns->id.".".  end($tmp_name1);
            //echo $new_file_name;exit;
            //$file_name = $_FILES['Answer']['name'][$key]['Answer']['image'];
            $tmp_name = $_FILES['Answer']['tmp_name'][$key]['Answer']['image'];
            $dir = "uploads/answer/";
            $move = move_uploaded_file($tmp_name, $dir.$new_file_name);

            $modelAns->image =$new_file_name;
            $modelAns->save();
            //display_array($modelAns);exit;

            // if($move)
            // {
            //     // echo "file uploaded";
            // }
            // else
            // {
            //     // echo "nhi hua";
            // }

            ///print_r($modelAns);
            // $Options[$key]
        }
            
        }
        else
        {
            echo 'Please select answer';
            
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
            
            if($model->save())
            {
               if (isset(\yii\web\UploadedFile::getInstance($model, 'image')->name)) {
                    $model->image = \yii\web\UploadedFile::getInstance($model, 'image');
//                    display_array($model->image);
//                    exit;
                    $model->upload($model->id);
                }  
            $this->saveAnswers($model->id);
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
}
