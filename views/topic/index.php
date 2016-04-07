<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TopicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Topic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
        //    'subject_id',
            [
                'attribute'=>'subject_id',
                'content'=>function($data){
                    try {
                        $modelm = app\models\Subject::find()->select("subject_name")
                                        ->where(["IN", "id", json_decode($data->subject_id)])->all();

                        $mstringn = "";
                        for ($im = 0; $im < count($modelm); $im++) {
                            if ($im == 0) {
                                $mstringn = $mstringn . "" . $modelm[$im]->subject_name;
                            } else {
                                $mstringn = $mstringn . " , " . $modelm[$im]->subject_name;
                            }
                        }
                        return $mstringn;
                    } catch (Exception $exc) {
                        
                    }
                }
            ],
                    
//             [
//                'attribute' => 'subject_id',
//                'filter' => "",
//                'content' => function($data) {
////                    display_array($data);
////                    exit;
//
//                    try {
//                        $modelm = app\models\Subject::find()->select("subject_name")
//                                        ->where(["IN", "id", json_decode($data->subject_id)])->all();
//
//                        $mstringn = "";
//                        for ($im = 0; $im < count($modelm); $im++) {
//                            if ($im == 0) {
//                                $mstringn = $mstringn . "" . $modelm[$im]->subject_name;
//                            } else {
//                                $mstringn = $mstringn . " , " . $modelm[$im]->subject_name;
//                            }
//                        }
//                        return $mstringn;
//                    } catch (Exception $exc) {
//                        
//                    }
//                }
//                    ],       
            'topic_name',
            'number_of_question_to_be_ask',
//            'is_active',
            [
                'attribute'=>'is_active',
                'content'=>function($data){
//                    fetch_name_from_id('Subject','id',$data,'subject_id','subject_name');
                    return  check_active_status($data);
                }
            ],
             'created_at',
             'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);


    ?>

</div>
