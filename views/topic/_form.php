<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;




/* @var $this yii\web\View */
/* @var $model app\models\Topic */
/* @var $form yii\widgets\ActiveForm */
?>
    

 <?php $form = ActiveForm::begin(); ?>

 <?php if($model->isNewRecord == false){
     $model->subject_id =isset($model->subject_id)?json_decode($model->subject_id):"";
 }?>
   <?= $form->field($model, 'subject_id')->widget(Select2::classname(), [
            'language' => 'en',
            //'name' => isset($model->subject_id)?json_decode($model->subject_id):"",
//            'value'=>,
            'data' => yii\helpers\ArrayHelper::map(app\models\Subject::find()->where(['is_active' => '1'])->all(), 'id', 'subject_name'),
            'options' => ['placeholder' => 'Select Subject','multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    <?= $form->field($model, 'topic_name')->textInput(['maxlength' => true]) ?>

 <!--<?php //$form->field($model, 'number_of_question_to_be_ask')->textInput() ?>-->

    <?php $model->isNewRecord ? $model->is_active = 0: $model->is_active = $model->is_active ;  ?>
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