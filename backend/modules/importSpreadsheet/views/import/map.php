<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Import Spreadsheet Map Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Import Spreadsheet'), 'url' => ['map']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="importSpreadsheet-import-map">
	   
    <h1><?= Html::encode($this->title) ?></h1>
          
    <?=

    $this->render('_form_import', [
        'model' => $model,
        'module' => $module,
    ])

    ?>

    <br />
	<br />    

    <?= Html::a('back', $module->returnRoute) ?>    
    
    <br />
	<br />
                  
    <?php
        /*
        echo '<pre><b>model</b><br />';
        var_dump($model);
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
        echo '</pre><br /><br /><pre><b>highestRow</b><br />';
        var_dump($module->highestRow);
        echo '</pre><br /><br /><pre><b>err</b><br />';
        var_dump($module->err);
        echo '</pre>';
         *
         */
    ?>       
    
</div>
