<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'is_active')->textInput() ?>
    <?php  $model->is_active = '0'; ?>
    <?= $form->field($model, 'is_active')->radioList(['1'=>'Active',0=>'InActive'])->label(''); ?>

   <!-- <?/*= $form->field($model, 'created_at')->textInput() */?>

    --><?/*= $form->field($model, 'modified_by')->textInput() */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
