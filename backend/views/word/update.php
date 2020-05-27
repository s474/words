<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Word */

$this->title = 'Update Word: ' . $model->word;
$this->params['breadcrumbs'][] = ['label' => 'Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="word-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    <?= GridView::widget([
        'dataProvider' => $wordlistWordDataProvider,
        'filterModel' => $wordlistWordSearchModel,        
        'columns' => [
            [
                'attribute' => 'wordlist.name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->wordlist->name, ['wordlist-word/update', 'id' => $data->id]);
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
    
</div>
