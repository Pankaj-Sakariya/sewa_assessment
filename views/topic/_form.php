<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;




/* @var $this yii\web\View */
/* @var $model app\models\Topic */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>
<?php
echo $form->field($model, 'subject_id')->widget(Select2::classname(), [
yii\helpers\ArrayHelper::map(app\models\Subject::find()->all(), 'id', 'subject_name'),
    'language' => 'de',
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);

?>
    <?= $form->field($model, 'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Subject::find()->where(['is_active' => '1'])->all(), 'id', 'subject_name')) ?>

    <?= $form->field($model, 'topic_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_of_question_to_be_ask')->textInput() ?>

    <?php $model->is_active = '0'; ?>
    <?= $form->field($model, 'is_active')->radioList(['1' => 'Active', 0 => 'InActive'])->label(''); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">

    $(document).ready(function () {
            

        $("#topic-subject_id").change(function(){
            alert('s');
        });

    });       

</script>