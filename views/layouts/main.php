<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <style>
        body{
            background-image: url( "<?= Url::to('@web/images/b1.jpg')?>");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
        
        label.radio {
            cursor: pointer;
        }
        
        .compactRadioGroup LABEL,
        .compactRadioGroup INPUT {
            display: inline !important;
            width: auto !important;    
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none;
        }
        
        label.radio span {
            padding: 4px 0px;
            border: 1px solid red;
            display: inline-block;
            color: red;
            width: 100px;
            text-align: center;
            border-radius: 3px;
            margin-top: 7px;
            text-transform: uppercase;
        }
        
        label.radio span:hover {
            border-color: red;
            background-color: red;
            color: #fff;
        }
        
        .ans {
            margin-left: 36px !important;
        }
        
        .btn:focus {
            outline: 0 !important;
            box-shadow: none !important;
        }
        
        .btn:active {
            outline: 0 !important;
            box-shadow: none !important;
        }
    </style>


    <script type="text/javascript">
        window.onload = function(){
            document.getElementById("mosesForm").onclick = function(){

                var correctAnswer = document.getElementById("correct");

                if (correctAnswer.checked){
                    document.getElementById("success").style.display = 'block';
                    document.getElementById("iterror").style.display = 'none';
                }else{
                    document.getElementById("iterror").style.display = 'block';
                    document.getElementById("success").style.display = 'none';
                    // alert("Wrong Answer");
                }
            };
        }
    </script>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
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
</body>
</html>
<?php $this->endPage() ?>
