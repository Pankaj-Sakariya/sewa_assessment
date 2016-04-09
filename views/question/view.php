<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    
    <?php 
    
    
    
    $topicM = \app\models\Topic::find()->where(['id'=>$model->topic_id])->one();
    $topic_name = $topicM !=null?$topicM->topic_name:"";
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            
            [  
                'attribute'=>'topic_id',
                'value'=>$topic_name
            ],
           // 'topic_id',
            'question_name:ntext',
            'weightage_for_question',
            //'number_of_answer',
            [
                'attribute'=>'is_active',
                'value' => check_active_status($model)
            ],
            'created_at',
            'modified_by',
        ],
    ]) ?>

</div>
