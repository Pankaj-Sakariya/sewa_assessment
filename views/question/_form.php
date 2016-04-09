<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Answer;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
        $option_count = 0;
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<div class="question-form" >

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model,'topic_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Topic::find()->where(['is_active'=>'1'])->all(),'id','topic_name'),['prompt'=>'Select Topic'])?>

    <?= $form->field($model, 'question_name',['inputOptions' => ['id' => 'question-name','class'=>"form-control"]])->textarea(['rows' => 6]) ?>
   <?= $form->field($model, 'image')->fileInput(['maxlength' => true]) ?>
   <?php if(!$model->isNewRecord == true){
//    echo Html::textInput('image', $model->image) ;
       ?>
    <div style="display: none">
    <?php
       echo $form->field($model, 'image')->textInput(['maxlength' => true]);
   }
     ?>
    </div>
       <?php if(!$model->isNewRecord == true){?>
          <div>
        <img src ="../uploads/question/<?php echo $model->image;?>   " style="width: 100px"height="100px;">
    </div> 
      <?php } ?>

    
     <?php // $form->field($model, 'image')->textInput() ?>
    <?= $form->field($model, 'weightage_for_question',['inputOptions' => ['id' => 'question-weightage','class'=>"form-control"]])->textInput() ?>
    
    
    <div>
        <button class="btn btn-info" style="margin-top: 10px;">Add Options</button>
        <!-- <div><input type="text" name="mytext[]"></div> -->
    </div>
    <?php  $model->is_active = '0'; ?>
    <?= $form->field($model, 'is_active')->radioList(['1'=>'Active',0=>'InActive'])->label(''); ?>
    <table class="table">
                <thead>
                    <tr>
                        
                        <th>Answer value</th>
                        <th>Image value</th>
                        <th>Is Correct?</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="input_fields_wrap">
    <?php 
        
    
        if(!$model->isNewRecord)
        {
            $modelAnswers = Answer::find()->where(['question_id'=>$model->id])->all();
            $length = count($modelAnswers);
            
 
                for($i=0;$i<= $length-1;$i++)
            {    if($modelAnswers[$i]->is_correct == 1)
                {
                    $option_set = "checked";
                }
                else 
                    {
                        $option_set = "";
                    }
                
                
                ?>
                    <tr>
                <input name="Answer[<?php echo $i ?>][Answer][id]" value="<?php echo $modelAnswers[$i]->id ?>" type="hidden">

                        <td><input name="Answer[<?php echo $i ?>][Answer][answer_name]" class="form-control" type="text" value="<?php echo $modelAnswers[$i]->answer_name; ?>"</td>

                        <td><img src="../uploads/answer/<?php echo $modelAnswers[$i]->image ?>" height="60px"/> <input name="Answer[<?php echo $i ?>][Answer][image]" class="btn btn-default" type="file" value="<?php echo $modelAnswers[$i]->image ?>" /></td>
                        <td><input id="correct_answer-<?php echo $i; ?>" name="Answer[<?php echo $i ?>][Answer][is_correct]" class="abc" type="checkbox"  value="1" <?php echo $option_set ?> onclick="checkboxes('<?php echo $i; ?>',this);"/></td>
 </tr>

           <?php } 
           $option_count = $i;?>
                
            
 <?php
            //display_array($modelAnswers[0]->question_id);
            //display_array($modelAnswers);
        }
        
     ?>

    </tbody>
</table>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>




    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">

$(document).ready(function() {
//    var max_fields;
//     $("input").change(function(){
//        max_fields = $(this).val();
//    });
    var max_fields      = 5; 
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".btn-info"); 
    var x = 0; 
    
    var count = <?php echo $option_count ?>;
     //alert(count);
    if(count === 0)
    {
        x = 1;
    }
    else
    {
        x = count;
        //alert(x);
    }
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x <= max_fields){ 
            x++; 
            $(wrapper).append('<tr><td><input type="text" class="abc" name="Answer['+x+'][Answer][answer_name]" class="form-control"/></td><td><input type="file" name="Answer['+x+'][Answer][image]" class="btn btn-default btn-file"/></td><td><input type="checkbox" name="Answer['+x+'][Answer][is_correct]" value="1" class="checkbox" value = "1" onclick="checkboxes();"/></td><td><a href="#" class="remove_field">Remove</a></td></tr>'); //add input box

        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).closest('tr').remove(); x--;
    })
});
    function checkboxes(position,mthis)
    {
       var inputElems = $(".abc");
        options_count = 0;

        for (var i=0; i< inputElems.length; i++) 
        {       
            if(inputElems[i].checked)
            {
               if(i!=position)
               {
                   alert("Please select only one option");
                   mthis.checked = false;
               }
            }
        }
    }
    
    function form_validations()
    {
        var question_name = document.getElementById("question-name").value;
        var ques_weightage = document.getElementById("question-weightage").value;
        if(question_name == "" || question_name==null)
        {
            alert("please enter aquestion.");
        }
        if(ques_weightage == "" || ques_weightage==null)
        {
         alert("please enter weightage for the question.");   
        }
        
    }
    
   
</script>