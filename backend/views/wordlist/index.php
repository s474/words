<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WordlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wordlists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wordlist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Wordlist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->name, ['wordlist/update', 'id' => $data->id]);
                },                        
            ],
            [                
                'attribute'=>'user_id',
                'format' => 'raw',                
                'value' => 'user.username',
                'filter' => ArrayHelper::map(
                    common\models\User::find()->asArray()->all(), 'id', 'username'                        
                ),
                'value' => function ($data) {
                    return Html::a($data->user->username, ['user/update', 'id' => $data->user_id]);
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
                        $url = Url::to(['wordlist/delete', 'id' => $model->id]);
                        return $url;
                    }
                }
            ], 
        ],
    ]); ?>    
    
</div>
