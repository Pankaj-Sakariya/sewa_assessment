<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

   
    <?= $form->field($model,'topic_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Topic::find()->where(['is_active'=>'1'])->all(),'id','topic_name'),['prompt'=>'Select Topic'])?>

    <?= $form->field($model, 'question_name')->textarea(['rows' => 6]) ?>
    <label>Image for Question</label>
    <input type="file" name="image"><br/>
    <?= $form->field($model, 'weightage_for_question')->textInput() ?>

    <?= $form->field($model, 'number_of_answer')->textInput() ?>

<!--    --><?//= $form->field($model, 'correct_answer')->textInput() ?>

    <?php  $model->is_active = '0'; ?>
    <?= $form->field($model, 'is_active')->radioList(['1'=>'Active',0=>'InActive'])->label(''); ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'modified_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
