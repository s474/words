<?php

namespace backend\modules\importSpreadsheet\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class ImportController extends Controller
{
    public function actionUpload()
    {
        $model = new \backend\modules\importSpreadsheet\models\UploadForm();
        $module = Yii::$app->getModule('importSpreadsheet');

        // Upload form submitted?
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $sheet = $model->uploadAndPrepare('importSpreadsheet');

            if ($sheet) {
                if ($module->autoMap) {

                    // DO AUTO MAP IMPORT
                    $module->import($sheet);

                    // Report back
                    return $this->render('done.php', ['module' => $module]);
                }

                // Not auto mapping - user must map columns to fields
                $model = new \backend\modules\importSpreadsheet\models\ImportForm();
                $model->matchField = $module->matchField;
                $model->dynamicFields = $module->fields;

                foreach ($model->dynamicFields as $df) {
                    $model->$df = '';
                }

                $mapFormAction = Url::to(['import/map',
                    'model' => $module->model,
                    'file' => $module->file,
                    'fields' => $module->fields,
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

                return $this->render('map.php', ['model' => $model, 'module' => $module, 'mapFormAction' => $mapFormAction]);
            }
            // Upload/prepare failed - show upload view
            return $this->render('upload.php', ['model' => $model, 'module' => $module]);
        }
        // Form not submitted yet - show upload view
        return $this->render('upload.php', ['model' => $model, 'module' => $module]);
    }

    public function actionMap()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $post = $request->post();
            //Yii::debug($post,'SJA');
            $module = Yii::$app->getModule('importSpreadsheet');
            //Yii::debug($module,'SJA');
            $module->prepareMap($post);

            // Need to reload sheet - don't need to upload again though
            $sheet = $module->loadSpreadsheet($module->file['name']);
            
            // DO MANUAL MAP IMPORT
            $module->import($sheet);

            // Report back
            return $this->render('done.php', ['module' => $module]);
        }
    }
}
