Link to importSpreadsheet/import/upload, 

Must pass model.

skipRows skips to Column Headings, at the moment you must have column heading, but they don't have to be top row.

Usually tables have a field 'name' - this is default value of matchField. set e.g. 'matchField' => 'word', if not matching on name field (for duplicates inserting from spreadsheet).

If passing a matchRelation then matchField will be in the related table, use if importing to a joining table (e.g. WordlistWords, matchField will look for 'word' in related model)    

Creates new entry in related table (e.g. Word when Importing WordlistWords) however WILL ONLY IMPORT VALUES other than matchField TO model, not related model (maybe change TODO)

No fields required at mo except matchField (TODO) - see ImportForm.php
 
ALWAYS OVERWRITES FIELDS at mo - will blank out values if fields in spreadsheet empty

Assumes all models have an autoinc ID PK


<?= Html::a(Yii::t('app', 'Import WordlistWords Manual Map'),
    [
        'importSpreadsheet/import/upload', 
        'model' => '\common\models\WordlistWord',
        'matchField' => 'word',
        'matchRelation' => 'word',            
        'fields' => ['word.id'],
        'setFields' => ['wordlist_id' => $model->id],
        'autoMap' => 0,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>   


Other Examples,


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


<?= Html::a(Yii::t('app', 'Import Items Manual Map word is matchField'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => $importFields,
        'matchField' => 'word',
        'autoMap' => 0,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>


<?= Html::a(Yii::t('app', 'Import Items Manual Map word is matchField with wordlist_id being set'), 
    [
        'importSpreadsheet/import/upload', 
        'model' => '\backend\models\Item', 
        'fields' => ['name', 'description'],
        'setFields' => ['wordlist_id' => '303'],
        'matchField' => 'word',
        'autoMap' => 0,
        'returnRoute' => Yii::$app->request->url,
    ], 
    ['class' => 'btn btn-primary']) 
?>