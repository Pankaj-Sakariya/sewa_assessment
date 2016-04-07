<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',],]); ?>

    <?= $form->field($model, 'topic_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Topic::find()->all(), 'id', 'topic_name'))->label('Topic') ?>

    <?= $form->field($model, 'question_name')->textarea(['rows' => 6]) ?>



    <?= $form->field($model, 'weightage_for_question')->textInput() ?>

    <?= $form->field($model, 'number_of_answer')->textInput() ?>


    <?php $model->is_active = '0' ?>
    <?= $form->field($model, 'is_active')->radioList(["0" => "InActive", "1" => "Active"])->label('') ?>

    <!--/////////////////////////-->


    <?= $form->field($model, 'image')->fileInput() ?>

    <?php
    if ($model->isNewRecord == false) {
        $form->field($model, 'image')->textInput();
    }
    ?>


    <div>
        <img src ="../uploads/question/<?php echo $model->image; ?>" style="width: 100px"height="100px;">
    </div> 

    <!--/////////////////////////-->






    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
