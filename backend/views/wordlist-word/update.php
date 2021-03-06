<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WordlistWord */

$this->title = 'Update List Word: ' . $model->word->word;
$this->params['breadcrumbs'][] = ['label' => 'Wordlist Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wordlist-word-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
