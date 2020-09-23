<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-index">

    <div class="jumbotron" style="background-color: #333333; color: #ffffff">
        <h1>To Continue</h1>

        <p class="lead">Choose any of the sections listed below</p>

    </div>

</div>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h4><b>Quiz</b> Sections</h4>

                        
                        <!-- Button trigger modal -->
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <?php Modal::begin([
                                'header' => '',
                                'toggleButton' => ['label' => 'Create New Section', 'class'=>'btn btn-secondary'],
                            ]); ?>
                                <div class="section-form">

                                    <?php $form = ActiveForm::begin(); ?>

                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>
                            <?php Modal::end(); ?>
                        <?php } ?>


                        <span><?= count($allSection)?> Sections</span>
                    </div>
                </div>
                
                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                    <br><br>
                    
                    <?php foreach($allSection as $section){?>
                        <button type="button" class="btn btn-primary">
                            <a href="<?= Url::to(['questions/index', 'id' => $section->id ])?>" style="color: #ffffff; text-decoration: none;"><?= $section->name; ?></a>
                        </button>
                    <?php } ?>

                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>