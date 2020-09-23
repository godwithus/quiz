<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="site-index">

    <div class="jumbotron" style="background-color: #333333; color: #ffffff">
        <h1>To Get Answer</h1>

        <p class="lead">Choose any of the options below </p>

    </div>

</div>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">

                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h4><b><a href="<?= Url::to(['section/index', 'id' => $section->id ]) ?>">Sections</a> :-: <?= $section->name?></b> Quiz</h4>

                        <!-- Button trigger modal -->
                            
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            
                            <?php Modal::begin([
                                'header' => '',
                                'toggleButton' => ['label' => 'Create New Question', 'class'=>'btn btn-primary'],
                            ]); ?>
                                <div class="questions-form">

                                    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]); ?>

                                    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

                                    <?= $form->field($model, 'image')->fileInput() ?>

                                    <?= $form->field($model, 'opt1')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'opt2')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'opt3')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'opt4')->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($model, 'ans')->radioList(
                                        array(  'a' => 'A',
                                                'b' => 'B',
                                                'c' => 'C',
                                                'd' => 'D' ),
                                        array( 'separator' => " | " ) ); 
                                    ?>


                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>

                            <?php Modal::end(); ?>
                        
                        <?php } ?>


                        <span>
                            <b>( <?= $allQuestion ?> )</b> Questions
                        </span>
                    </div>
                </div>

                <div class="question bg-white p-3 border-bottom">

                    
                    <h3 style="color: red; display: none; font-size: 40px;" id="iterror" class="text-center">
                        Your Selected Answer is Incorrect
                    </h3>

                    <h3 style="color: green; display: none; font-size: 40px;" id="success" class="text-center">
                        Correct! You get it Right
                    </h3>

                    
                    <?php foreach ($question as $quest) { ?>
                    <div class="col-12">
                        <?php if($quest->image != ''){ ?>
                            <img src="<?= Url::to('@web/images/question_images/'.$quest->image)?>" alt="<?= $quest->question ?>" width="200" />
                        <?php } ?>
                    </div> <br> <br>

                    <div class="d-flex flex-row align-items-center question-title">
                        <h3 class="text-danger">Q.</h3>
                        
                        <h1 style="margin-left:10px;"><?= $quest->question ?></h1>
                        

                        <h5 class="mt-1 ml-2">
                        
                        <?php if (!Yii::$app->user->isGuest) { ?>

                            <?php Modal::begin([
                                    'header' => '',
                                    'toggleButton' => ['label' => 'Edit', 'class'=>'btn btn-primary', 'style'=>'margin-left: 100px;'],
                                ]); ?>
                                    <div class="questions-form">

                                        <?php $form = ActiveForm::begin([
                                            'method' => 'post',
                                            'action' => ['questions/update', 'id' => $quest->id],
                                            'options'=>['enctype' => 'multipart/form-data'],
                                        ]); ?>

                                        <?= $form->field($model, 'question')->textarea(['rows' => 6, 'value'=>$quest->question]) ?>

                                        <?= $form->field($model, 'image')->fileInput(['value'=>$quest->image]) ?>

                                        <?= $form->field($model, 'id')->textInput(['value'=>$quest->id, 'type'=>'hidden']) ?>

                                        <?= $form->field($model, 'opt1')->textInput(['maxlength' => true, 'value'=>$quest->opt1]) ?>

                                        <?= $form->field($model, 'opt2')->textInput(['maxlength' => true, 'value'=>$quest->opt2]) ?>

                                        <?= $form->field($model, 'opt3')->textInput(['maxlength' => true, 'value'=>$quest->opt3]) ?>

                                        <?= $form->field($model, 'opt4')->textInput(['maxlength' => true, 'value'=>$quest->opt4]) ?>

                                        <?= $form->field($model, 'ans')->radioList(
                                            array(  'a' => 'A',
                                                    'b' => 'B',
                                                    'c' => 'C',
                                                    'd' => 'D' ),
                                            array( 'separator' => " | " ) ); 
                                        ?>


                                        <div class="form-group">
                                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>

                                    </div>

                            <?php Modal::end(); ?>

    
                            <?php Modal::begin([
                                    'header' => '',
                                    'toggleButton' => ['label' => 'Delete', 'class'=>'btn btn-danger'],
                                ]); ?>

                                    <h2 class="text-center">Are You Sure You Want To Delete This Question ? <br><br>
                                        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">No</button>

                                        <?= Html::a('Delete', ['delete', 'id' => $quest->id], [
                                            'class' => 'btn btn-danger btn-lg',
                                            'data' => [
                                                'method' => 'post',
                                            ],
                                        ]) ?>

                                    </h2>
                            <?php Modal::end(); ?>
                        
                        <?php } ?>

                        </h5>
                    </div>

                    <form name="adewale" method="post" id="mosesForm">

                        <div class="ans ml-2">
                            <label class="radio">
                                <input type="radio" name="brazil" value="a" id="<?php if($quest->ans  == 'a'){ echo 'correct'; }else{ echo '0'; } ?>" />
                                A) <span><?= $quest->opt1 ?></span>
                            </label>
                        </div>

                        <div class="ans ml-2">
                            <label class="radio">
                                <input type="radio" name="brazil" value="b" id="<?php if($quest->ans  == 'b'){ echo 'correct'; }else{ echo '0'; } ?>" />
                                B) <span><?= $quest->opt2 ?>l</span>
                            </label>
                        </div>                       

                        <div class="ans ml-2">
                            <label class="radio">
                                <input type="radio" name="brazil" value="c" id="<?php if($quest->ans  == 'c'){ echo 'correct'; }else{ echo '0'; } ?>" />
                                C) <span><?= $quest->opt3 ?></span>
                            </label>
                        </div>                      

                        <div class="ans ml-2">
                            <label class="radio">
                                <input type="radio" name="brazil" value="d" id="<?php if($quest->ans  == 'd'){ echo 'correct'; }else{ echo '0'; } ?>" />
                                D) <span><?= $quest->opt4 ?></span>
                            </label>
                        </div>
                    </form>
                    <?php } ?>
                </div>
                
                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                    
                    <?= LinkPager::widget([
                            'pagination' => $pagination,
                            ]);
                    ?>
                

                </div>
            </div>
        </div>
    </div>
</div>