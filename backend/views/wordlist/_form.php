<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Wordlist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wordlist-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php      
        echo $form->field($model, 'user_id')->dropdownList(ArrayHelper::map(User::find()->all(), 'id', 'username'),['prompt'=>'Select User']);
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);               
    ?>    
               
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
