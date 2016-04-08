<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExamBasicInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-basic-information-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model,'subject_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Subject::find()->where(['is_active'=>'1'])->all(),'id','subject_name'),['onchange'=>'subject_changed("data_contrainer")'])?>




    <?= $form->field($model, 'no_of_question_for_exam')->textInput() ?>

    <?= $form->field($model, 'time_for_exam')->textInput() ?>

    <?= $form->field($model, 'exam_secret_code')->textInput(['maxlength' => true]) ?>


    <?php

    $array = \app\models\Subject::find()->where(['is_active'=>'1'])->all();
    //display_array($array);




    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


    <script>


        function subject_changed(container)
        {

            var selectedValue =  document.getElementById("exambasicinformation-subject_id").value;


            $.ajax({

                type: 'GET',
                url: '<?php echo \yii\helpers\Url::to(["topic/topic-changed"]) ?>',
                data: {'value': selectedValue },
                success: function(data) {

                    $("#"+container).html(data);


                }
            });
        }

        subject_changed("data_contrainer");


    </script>



    <?php  $model->is_active = '0'; ?>
    <?= $form->field($model, 'is_active')->radioList(['1'=>'Active',0=>'InActive'])->label(''); ?>

    <div id="data_contrainer">
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
