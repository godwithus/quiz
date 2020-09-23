<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Online Quiz Application';
?>
<div class="site-index">

    <div class="jumbotron" style="background-color: #333333; color: #ffffff">
        <h1>Welcome Back</h1>

        <p class="lead">Let's continue the online Educational Quiz</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['section/index'])?>">Get started</a></p>
    </div>

</div>
