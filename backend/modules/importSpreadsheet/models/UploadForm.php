<?php

namespace backend\modules\importSpreadsheet\models;

use Yii;
use yii\base\Model;

class UploadForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv, xls', 'checkExtensionByMimeType' => false],
        ];
    }

    public function uploadAndPrepare($moduleStr)
    {
        if ($this->validate()) {
            if (isset($this->file) && $this->file != '') {
                if ($this->file->saveAs(\Yii::getAlias('@uploads') . '/' . $this->file->baseName . '.' . $this->file->extension)) {
                    $module = Yii::$app->getModule($moduleStr);
                    $sheet = $module->loadSpreadsheet($this->file);
                    if ($module->prepare($this, $sheet)) {
                        return $sheet;
                    }
                    $this->addError('file', implode(', ', $module->err));
                    return false;
                }
                // File not saved
                $this->addError('file', 'Error saving file');
                return false;
            }
        } else {
            return false;
        }
    }
}
