<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WordlistWord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wordlist-word-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wordlist_id')->textInput() ?>

    <?= $form->field($model, 'word_id')->textInput() ?>

    <?= $form->field($model, 'definition')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
