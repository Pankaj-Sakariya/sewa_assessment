<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View*/
/* @var $model app\models\Topic */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-view">

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
    
                  $modelm = app\models\Subject::find()->select("subject_name")
                                        ->where(["IN", "id", json_decode($model->subject_id)])->all();
                       
                        $mstringn = "";
                        for ($im = 0; $im < count($modelm); $im++) {
                            if ($im == 0) {
                                $mstringn = $mstringn . "" . $modelm[$im]->subject_name;
                            } else {
                                $mstringn = $mstringn . " , " . $modelm[$im]->subject_name;
                            }
                        }
                        
                        
    
    ?>

    <?php

    /*  for fetch subject name from id   */
//    $value = \app\models\Subject::find()->where(['id'=>$model->subject_id])->one();
//    $final_value= $value!='null'?$value:'';
//    $subject_name = $final_value->subject_name;


    echo DetailView::widget([
        'model' => $model,
        
        
        
        'attributes' => [
            'id',
            //'subject_id',
            [
                'attribute'=>'subject_id',
                'value' => $mstringn
            ],
            'topic_name',
            'number_of_question_to_be_ask',
           // 'is_active',
            [
                'attribute'=>'is_active',
                'value' => check_active_status($model)
            ],
            'created_at',
            'modified_by',
        ],
    ]) ?>

</div>
