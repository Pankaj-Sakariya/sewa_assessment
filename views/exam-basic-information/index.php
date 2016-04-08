<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExamBasicInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exam Basic Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-basic-information-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exam Basic Information', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'subject_id',
            [
                'attribute'=>'subject_id',
                'content'=>function($data){
                    $value = \app\models\Subject::find()->where(['id'=>$data->subject_id])->one();
//                    display_array($value);
                    $final_value= $value!='null'?$value:'';
                    return $final_value->subject_name;

//                    return  check_active_status($data);
                }
            ],
            'no_of_question_for_exam',
            'time_for_exam',
            'exam_secret_code',
            // 'is_active',
            // 'created_at',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
