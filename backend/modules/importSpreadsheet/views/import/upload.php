<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Import Spreadsheet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Import Spreadsheet'), 'url' => ['upload']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="importSpreadsheet-import-upload">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_upload', [
        'model' => $model,
    ]) ?>

    <br />
	<br />    

    <?= Html::a('back', $module->returnRoute) ?>
    
    <br />
    <br />
    
<?php
    /*
    echo '<pre><b>model</b><br />';
    var_dump($module->model);
    echo '</pre><br /><br /><pre><b>file</b><br />';
    var_dump($module->file);
    echo '</pre><br /><br /><pre><b>fields</b><br />';
    var_dump($module->fields);
    echo '</pre><br /><br /><pre><b>autoMap</b><br />';
    var_dump($module->autoMap);
    echo '</pre><br /><br /><pre><b>foundHeadings</b><br />';
    var_dump($module->foundHeadings);
    echo '</pre><br /><br /><pre><b>notFoundHeadings</b><br />';
    var_dump($module->notFoundHeadings);
    echo '</pre><br /><br /><pre><b>notPermittedHeadings</b><br />';
    var_dump($module->notPermittedHeadings);
    echo '</pre><br /><br /><pre><b>skipRows</b><br />';
    var_dump($module->skipRows);
    echo '</pre><br /><br /><pre><b>matchField</b><br />';
    var_dump($module->matchField);
    echo '</pre><br /><br /><pre><b>returnRoute</b><br />';
    var_dump($module->returnRoute);
    echo '</pre><br /><br /><pre><b>rows</b><br />';
    var_dump($module->reportRows);
    echo '</pre><br /><br /><pre><b>okNew</b><br />';
    var_dump($module->reportokNew);
    echo '</pre><br /><br /><pre><b>okUpdated</b><br />';
    var_dump($module->reportokUpdated);
    echo '</pre><br /><br /><pre><b>failedNew</b><br />';
    var_dump($module->reportfailedNew);
    echo '</pre><br /><br /><pre><b>failedUpdated</b><br />';
    var_dump($module->reportfailedUpdated);
    echo '</pre><br /><br /><pre><b>err</b><br />';
    var_dump($module->err);
    echo '</pre>';
     *
     */

     echo '@uploads points to: ' . \Yii::getAlias('@uploads');
?>     
    
</div>
