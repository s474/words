<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin() ?>
	
    <?php
        $form->action = Url::to(['import/map',
            'model' => $module->model,
            'file' => $module->file,
            'fields' => $module->fields,
            'setFields' => $module->setFields,            
            'autoMap' => $module->autoMap,
            'skipRows' => $module->skipRows,
            'matchField' => $module->matchField,
            'matchRelation' => $module->matchRelation,
            'matchRelatedModelClass' => $module->matchRelatedModelClass,
            'matchRelatedField' => $module->matchRelatedField,            
            'returnRoute' => $module->returnRoute,
            'matchCol' => $module->matchCol,
            'headings' => $module->headings,
            'foundHeadings' => $module->foundHeadings,
            'notFoundHeadings' => $module->notFoundHeadings,
            'notPermittedHeadings' => $module->notPermittedHeadings,
            'highestRow' => $module->highestRow,
            'highestColumn' => $module->highestColumn,
            'highestColumnIndex' => $module->highestColumnIndex, ]);
    ?>

    <?php

        foreach ($model->dynamicFields as $df) {
            echo $form->field($model, $df)->dropdownList(
                $module->headings,
                ['prompt' => 'Select Column']
            );
        }

    ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>        
