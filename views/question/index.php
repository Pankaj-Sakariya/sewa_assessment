<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            
            [
                'attribute'=>'topic_id',
                'content'=>function($data){
                    $value = \app\models\Topic::find()->where(['id'=>$data->topic_id])->one();
//                    display_array($value);
                    $final_value= $value!='null'?$value:'';
                    return $final_value->topic_name;

//                    return  check_active_status($data);
                }
            ],
            
           // 'topic_id',
            'question_name:ntext',
            'weightage_for_question',
            //'number_of_answer',
            // 'correct_answer',
            [
                'attribute'=>'is_active',
                'content'=>function($data){
                  return  check_active_status($data);
                }
            ],
            // 'created_at',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
