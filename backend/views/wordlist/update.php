<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\Wordlist */

$this->title = 'Update Wordlist: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Wordlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wordlist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>    

    <?= GridView::widget([
        'dataProvider' => $wordlistWordDataProvider,
        'filterModel' => $wordlistWordSearchModel,
        'columns' => [
            'word.word',            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Add Word', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= Html::a(Yii::t('app', 'Import WordlistWords Manual Map'),
        [
            'importSpreadsheet/import/upload', 
            'model' => '\common\models\WordlistWord',
            'matchField' => 'word',
            'matchRelation' => 'word',            
            'fields' => ['word', 'definition'],
            'setFields' => ['wordlist_id' => $model->id],
            'autoMap' => 0,
            'returnRoute' => Yii::$app->request->url,
        ], 
        ['class' => 'btn btn-primary']) 
    ?> 
    <!--
    <?= Html::a(Yii::t('app', 'Import WordlistWords Manual Map skipRows 2'),
        [
            'importSpreadsheet/import/upload', 
            'model' => '\common\models\WordlistWord',
            'matchField' => 'word',
            'matchRelation' => 'word',            
            'fields' => ['word', 'definition'],
            'setFields' => ['wordlist_id' => $model->id],
            'autoMap' => 0,
            'skipRows' => 2,            
            'returnRoute' => Yii::$app->request->url,
        ], 
        ['class' => 'btn btn-primary']) 
    ?>     
    -->
</div>
