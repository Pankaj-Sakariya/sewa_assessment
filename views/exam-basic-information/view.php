<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ExamBasicInformation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exam Basic Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-basic-information-view">

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

    /*  for fetch subject name from id   */
    $value = \app\models\Subject::find()->where(['id'=>$model->subject_id])->one();
    $final_value= $value!='null'?$value:'';
    $subject_name = $final_value->subject_name;

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //            'subject_id',
            [
                'attribute'=>'subject_id',
                'value' => $subject_name
            ],
            'no_of_question_for_exam',
            'time_for_exam',
            'exam_secret_code',
            //            'is_active',
            [
                'attribute'=>'is_active',
                'value' => check_active_status($model)
            ],
            'created_at',
            'modified_by',
        ],
    ]) ?>

</div>
