<?php
/**
 * Created by PhpStorm.
 * User: Pankaj Sakariya
 * Date: 05/04/2016
 * Time: 3:27 PM
 */
function display_array($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}


function check_active_status($model)
{

    if($model['is_active'] == '0')
    {
        $status='InActive';
    }
    else{

        $status='Active';
    }

    return $status;
}

function fetch_name_from_id($model_name,$data_key,$data_array,$data_field_name,$resultant_field_name)
{

/*
     $model_name =  Subject;
     $data_key = id;
     $data_array = $data;
     $data_field_name = subject_id;
    $resultant_field_name = subject_name;

It will return resultant field name;


      */

    $pre_model = "\\app\\models\\";
//
    display_array($pre_model.$model_name);
//    $a =     "\app\models\Subject::";
//    display_array($a);
//    exit;



    $value = $pre_model.$model_name::find()->where([$data_key=>$data_array->$data_field_name])->one();
    display_array($value);
    $final_value= $value!='null'?$value:'';
    return $final_value->$resultant_field_name;




}



?>