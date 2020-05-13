<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Wordlist */

$this->title = 'Create Wordlist';
$this->params['breadcrumbs'][] = ['label' => 'Wordlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wordlist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
