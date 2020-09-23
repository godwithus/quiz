<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section_id')->textInput() ?>

    <?= $form->field($model, 'opt1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opt2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opt3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opt4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ans')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
