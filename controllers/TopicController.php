<?php

namespace app\controllers;

use Yii;
use app\models\Topic;
use app\models\TopicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TopicController implements the CRUD actions for Topic model.
 */
class TopicController extends Controller
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
     * Lists all Topic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TopicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Topic model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    function actionTopicChanged()
    {
        $value = $_GET['value'];
        $topicModel = Topic::find()->where(['is_active' => '1']);
        $topicModel->andFilterWhere(['LIKE', 'subject_id', '"' . $value . '"']);
        $topicModel = $topicModel->all();
        ?>

        <table id="table_topic" class="table table-bordered" xmlns="http://www.w3.org/1999/html">
        <thead>
        <tr>
            <th>
                Topic Name
            </th>
            <th>
                Number of questions to be asked
            </th>


        </tr>
        </thead>
        <?php
        $i =0;
        for ($ti = 0; $ti < count($topicModel); $ti++) {
            $topicModelSingle = $topicModel[$ti];
            ?>
            <tr>
                <td>
                    <?php echo $topicModelSingle->topic_name; ?>
                </td>
                <td>
                    <input type="number" id = "number_of_question_to_be_ask" value="<?php echo $topicModelSingle->number_of_question_to_be_ask; ?>"class="form-control" onchange=number_of_question_changed()>
                </td>

            </tr>
            <script>
                function number_of_question_changed()
                {
                    var select_val =document.getElementById("number_of_question_to_be_ask").value;
                }

            </script>
                 <?php
                $i = $i + $topicModelSingle->number_of_question_to_be_ask;
                ?>

            <?php
            }
           ?>
           <tr>
               <th>Total</th>
               <th><?php echo $i ?></th>
           </tr>
        </table>

        <script>


            function number_of_question_changed() {


//                $( '#table_topic' ).on( 'change' , 'input[type="number"]' ,function(){
//                    alert( 'Event fired' );
//                });
               // alert("d"+document.getElementById("number_of_question_to_be_ask).value)
                var no_of_question_for_exam =  document.getElementById("exambasicinformation-no_of_question_for_exam").value;
               // alert(no_of_question_for_exam);
              var select=  document.getElementById("number_of_question_to_be_ask").value;

                alert( <?php echo "Total = ".$i;?> "," + no_of_question_for_exam);

            }


        </script>

        <?php

    }

    
//        
//    function listboxCombine()
//    {   
////        display_array($_POST);
////        exit;
//        if(isset($_POST['Topic']['subject_id']))
//        {   
//            $_POST['Topic']['ict_device'] = json_encode($_POST['Topic']['ict_device']);
//        }
//    }

    
    function Stringfunction(){
        if(isset($_POST['Topic']['subject_id'])){
            $_POST['Topic']['subject_id'] = json_encode($_POST['Topic']['subject_id']);
        }
    }
    /**
     * Creates a new Topic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Topic();
        $this->Stringfunction();
//       display_array($_POST);
//        exit;
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Topic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->Stringfunction();
        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Topic model.
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
     * Finds the Topic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Topic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Topic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
