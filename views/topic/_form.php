<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Topic */
/* @var $form yii\widgets\ActiveForm */

use kartik\widgets\Select2;
$data = [
    "red" => "red",
    "green" => "green",
    "blue" => "blue",
    "orange" => "orange",
    "white" => "white",
    "black" => "black",
    "purple" => "purple",
    "cyan" => "cyan",
    "teal" => "teal"
];

// Tagging support Multiple
echo '<label class="control-label">Tag Multiple</label>';
echo Select2::widget([
    'name' => 'color_1',
    'value' => ['red', 'green'], // initial value
    'data' => $data,
    'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);

// Tagging support Multiple (maintain the order of selection)
echo '<label class="control-label">Tag Multiple</label>';
echo Select2::widget([
    'name' => 'color_2',
    'value' => ['red', 'green'], // initial value
    'data' => $data,
    'maintainOrder' => true,
    'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);

// Tagging support (Multiple) for an update scenario that maintains the order of
// selected tags on initialization when the (maintain the order of selection)
echo '<label class="control-label">Tag Multiple</label>';
echo Select2::widget([
    'name' => 'color_2a',
    'value' => ['teal', 'green', 'red'], // initial value (will be ordered accordingly and pushed to the top)
    'data' => $data,
    'maintainOrder' => true,
    'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);

// Tagging support Multiple (maintain the order of selection)
echo '<label class="control-label">Tag Multiple</label>';
echo Select2::widget([
    'name' => 'color_3',
    'value' => ['red', 'green'], // initial value
    'data' => $data,
    'maintainOrder' => true,
    'toggleAllSettings' => [
        'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> Tag All',
        'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> Untag All',
        'selectOptions' => ['class' => 'text-success'],
        'unselectOptions' => ['class' => 'text-danger'],
    ],
    'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);

// Tagging support Single
echo '<label class="control-label">Tag Single</label>';
echo Select2::widget([
    'name' => 'color_3',
    'value' => 'red', // initial value
    'data' => $data,
    'options' => ['placeholder' => 'Select a color ...'],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10
    ],
]);
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
