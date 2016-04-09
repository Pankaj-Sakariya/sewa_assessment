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
        //display_array($topicModel);
        
        
        ?>

<table id="table_topic" class="table table-bordered" xmlns="http://www.w3.org/1999/html" >
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
          //  display_array($topicModel[$ti]->id);
            
            $topicModelSingle = $topicModel[$ti];
            ?>
            <tr>
                <td style="display: none"  id = "topic_id-<?php echo $ti ?>">
                    <?php echo $topicModelSingle->id; ?>
                    <input name='Topic[<?php echo $ti ?>][Topic][id]' value="<?php echo $topicModelSingle->id ?>">
                </td>
                <td>
                    <?php echo $topicModelSingle->topic_name; ?>
                </td>
                <td>
                    <input name="Topic[<?php echo $ti ?>][Topic][number_of_question_to_be_ask]" type="number" id = "number_of_question_to_be_ask-<?php echo $ti ?>" value="<?php echo $topicModelSingle->number_of_question_to_be_ask; ?>"class="form-control" onchange="number_of_question_changed(this);load_total_questions();return false">
                        <div id="error-<?php echo $ti ?>" class="error" style="color:red;"></div>
                </td>

            </tr>
            <script>
                function load_total_questions()
                {
                    var select_val =document.getElementById("container").innerHTML;
                    if(select_val == 0)
                    {
                       
                        select_val = "";
                    }
                    
                    //alert(select_val);
                    $("#exambasicinformation-no_of_question_for_exam").val(select_val);
                    
                }

            </script>
                 <?php
                $i = $i + $topicModelSingle->number_of_question_to_be_ask;
                ?>

            <?php
            }
           ?>
            
           <tr>
               <th onload="load_total_questions(),return false">Total Questions</th>
               <th id="container"><?php if($i == "0"){ echo  "";}else {echo $i ;}?></th>
           </tr>
            
        </table>
        
    <input type="hidden"id="number_of_rows" value="<?php echo $ti ?>"/>
    <?php
//    $i =0;
//        for ($ti = 0; $ti < count($topicModel); $ti++) { ?>
<!--    <input type="text"id="number_of_rows" value="<?php // echo $topicModel[$ti]->id; ?>"/>-->
        <?php// }?>
        <script>
            
            function number_of_question(mthis) {
                
                var no_of_question_exam = $("#exambasicinformation-no_of_question_for_exam").val();
                var sum = 0;
                var count = $("#number_of_rows").val();
                
                var sum  = 0;
                for(var i=0;i<count;i++)
                {
//                    alert($("#number_of_question_to_be_ask-"+i).val());
//                    if($("#number_of_question_to_be_ask-"+i).val()!="")
//                    {
                        sum = sum + parseInt($("#number_of_question_to_be_ask-"+i).val());
//                    }
                }
//                alert(no_of_question_exam);
//                alert(sum);
                
               
                 
                if(no_of_question_exam > sum)
                {
                   var message =("You can add maximum "+sum+ " questions for this subject, Or Add more questions in question bank.");
               
                }
//                else if(no_of_question_exam < sum)
//                {
//                    alert("Please enter proper number of questions for exam LESS THAN");
//                }
                else if(no_of_question_exam == sum)
                {
                   var message =("equal");
                }
                else
                {
                   var message =("else part:");
                }
                
                
            }
 

            function number_of_question_changed(mthis) {
                
                var no_of_question_exam = $("#exambasicinformation-no_of_question_for_exam").val();
               // alert(no_of_question_exam);
                var valueee = mthis.id;
                var textvalue = mthis.value;
               
                var sp = valueee.split("-");
                //alert(sp[1]);
                
//                 var topic_id = $("#topic_id-"+sp[1]).val();
                   var topic_id_name = "topic_id-"+sp[1];
                 
                // alert(topic_id_name);
                 
                  var topic_id =($("#topic_id-"+sp[1]).html()).trim();
                  
                 
                 //alert(topic_id);
              

                var count = $("#number_of_rows").val();
                
                           
                var sum = 0;
                for(var i=0;i<count;i++)
                {
                   var sum = sum + parseInt($("#number_of_question_to_be_ask-"+i).val());
                }
               
//                alert(sum);
//                
//                   
//                  if(no_of_question_exam == sum)
//                        {
//
//                            alert("equal");
//                        }
//                    else if(no_of_question_exam < sum)
//                        {
//
//                            alert("Please enter proper number of questions for exam LESS THAN");
//                        }
//                    
                
                    $("#container").html(sum);
                    
                    
                   // alert(no_of_question_exam);
                    
                     $.ajax({

                type: 'GET',
                url: '<?php echo \yii\helpers\Url::to(["question/question-count"]) ?>',
                data: {'topic_id': topic_id ,'textvalue':textvalue , 'textbox_id':valueee },
                success: function(data) {
                     var select = JSON.parse(data);
//                    alert(select['message']);
                    
                    if(select['status']==0)
                    {
                        $("#number_of_question_to_be_ask-"+sp[1]).val("");
                        $("#error-"+sp[1]).html(select['message']);
                        $("#number_of_question_to_be_ask-"+sp[1]).focus();
                        $("#container").html("");
                        $("#exambasicinformation-no_of_question_for_exam").val("");
                    }
                    else
                    {
                        $("#error-"+sp[1]).html("");
                    }
                    
                    
                   //var mdata = JSON:decode(data);
                  // var mdata = JSON:Parser(data);
                    // alert(mdata['message']);
                     
                   // $("#"+container).html(data);


                }
            });
                
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
