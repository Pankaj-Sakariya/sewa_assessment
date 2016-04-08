<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExamBasicInformation */

$this->title = 'Create Exam Basic Information';
$this->params['breadcrumbs'][] = ['label' => 'Exam Basic Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exam-basic-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
