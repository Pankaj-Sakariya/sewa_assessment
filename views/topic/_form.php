<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Topic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="topic-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'state')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\State::find()->all(), 'id', 'state_name'),['prompt'=>'Select..','onchange' => 'field_changed(this,"Centre[district]","district_container")']) ?>
    <?= $form->field($model,'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Subject::find()->where(['is_active'=>'1'])->all(),'id','subject_name'))?>
<!--    --><?//= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'topic_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_of_question_to_be_ask')->textInput() ?>

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
