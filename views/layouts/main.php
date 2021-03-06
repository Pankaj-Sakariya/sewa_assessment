<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>

<body>

<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],

            [
                'label' => 'Assessment',
                'items' => [
                    ['label' => 'Subject', 'url' => \yii\helpers\Url::to(['/subject/index'])],
                    '<li class="divider"></li>',

                    ['label' => 'Topic', 'url' => \yii\helpers\Url::to(['/topic/index'])],

                    '<li class="divider"></li>',

                    ['label' => 'Question', 'url' => \yii\helpers\Url::to(['/question/index'])],

                    '<li class="divider"></li>',

                    ['label' => 'Answer', 'url' => \yii\helpers\Url::to(['/answer/index'])],

                    '<li class="divider"></li>',

                    ['label' => 'Result', 'url' => '#'],

                    '<li class="divider"></li>',

                    ['label' => 'Exam Setting', 'url' => \yii\helpers\Url::to(['/exam-basic-information/index'])],
                ],
                ],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <script>
        function field_changed($mthis,$field,$container)
        {

            var selectedValue =  $mthis.value;
            //alert(selectedValue);

//        alert(selectedValue);

            //var onchange = $("[name='"+$field+"']").attr('onchange');
            //alert(onchange);

            $.ajax({

//                url: '<?php //echo Yii::$app->request->baseUrl. '/question/create' ?>//',
                type: 'post',
              // type: "GET",
                url: 'state-changed',
                data: {'value': selectedValue,'field': $field,'container': $container},
                success: function(data) {
                    // process data
                   alert($container);

//                alert(data);
                    document.getElementById($container).innerHTML = data;


                }
            });
        }

    </script>


    <script>


//    function subject_changed($container)
//    {
//
//        var selectedValue =  $("#exambasicinformation-subject_id").val();
//
//
//        $.ajax({
//
//                type: 'GET',
//                url: '<?php //echo \yii\helpers\Url::to(["topic/topic-changed"]) ?>//',
//                data: {'value': selectedValue },
//                success: function(data) {
//
//                    $("#"+$container).html(data);
//
//
//                }
//            });
//    }


    </script>







    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<!--<script src="/web/js/jquery.min.js"></script>-->
</body>
</html>
<?php $this->endPage() ?>
