<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\Wordlist */

$this->title = 'Update List: ' . $model->name;
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
            [
                'attribute' => 'word.word',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->word->word, ['wordlist-word/update', 'id' => $data->id]);
                },                        
            ],
            [
                'attribute' => 'word.definition',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->word->definition, ['word/update', 'id' => $data->word_id]);
                },                        
            ],
            [
                'attribute' => 'notes',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->notes, ['wordlist-word/update', 'id' => $data->id]);
                },                        
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'delete') {
                        $url = Url::to(['wordlist-word/delete', 'id' => $model->id]);
                        return $url;
                    }
                }
            ], 
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
            'fields' => ['word', 'notes'],
            'setFields' => ['wordlist_id' => $model->id],
            'autoMap' => 0,
            'returnRoute' => Yii::$app->request->url,
        ], 
        ['class' => 'btn btn-primary']) 
    ?> 

</div>
