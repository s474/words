<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WordlistWord */

$this->title = 'Create Wordlist Word';
$this->params['breadcrumbs'][] = ['label' => 'Wordlist Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wordlist-word-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
