Link to importSpreadsheet/import/upload, 

Must pass model.


Examples,


<?= Html::a(Yii::t('app', 'Import Items Auto Map'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => ['name', 'description'],
        'autoMap' => 1,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Auto Map skip 2 rows'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => $importFields,
        'autoMap' => 1,            
        'skipRows' => 2,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Auto Map NO FIELDS RESTRICTION'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item',                 
        'autoMap' => 1,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Manual Map'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => $importFields,
        'autoMap' => 0,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Manual Map skip 3 rows'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => $importFields,
        'autoMap' => 0,
        'skipRows' => 3,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Manual Map WRONG matchField'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => $importFields,
        'matchField' => 'SOMETHINGWRONG',
        'autoMap' => 0,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Manual Map Description is matchField'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => $importFields,
        'matchField' => 'description',
        'autoMap' => 0,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>