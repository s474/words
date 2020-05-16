<?php

namespace backend\modules\importSpreadsheet;

use Yii;

/**
 * importSpreadsheet module definition class.
 */
class ImportSpreadsheet extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\importSpreadsheet\controllers';
    private $model;
    private $fields = []; // Fields to map - passed when calling module - automap updates to foundHeadings before import
    private $setFields = []; // Fields to set e.g. importing words to wordlist would set wordlist_id
    private $file;
    private $autoMap = 0;
    private $skipRows = 0;
    private $matchField = 'name';    
    private $matchRelation = 0; // Used if importing to a joining table (e.g. WordlistWords, matchField will look in related table)    
    private $returnRoute;
    private $matchCol;
    private $headings; // All column headings from sheet
    private $foundHeadings; // Column headings from sheet in Fields to map AND found in model
    private $notFoundHeadings; // Column headings from sheet in Fields to map but NOT found in model
    private $notPermittedHeadings; // Column headings from sheet NOT in Fields to map
    private $highestRow;
    private $highestColumn;
    private $highestColumnIndex;
    private $fieldCols = []; // Used in import so don't have to loop all cols in sheet
    private $reportRows;
    private $reportOkNew;
    private $reportOkUpdated;
    private $reportFailedNew;
    private $reportFailedUpdated;
    private $err = [];
           
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof \yii\console\Application) {
            //$this->controllerNamespace = 'app\modules\forum\commands';
        } else {
            $request = Yii::$app->request;
            $get = $request->get();

            if (isset($get['model'])) {
                $this->model = $get['model'];
            }

            if (isset($get['fields'])) {
                $this->fields = $get['fields'];
            }
            
            if (isset($get['setFields'])) {
                $this->setFields = $get['setFields'];
            }            

            if (isset($get['file'])) {
                $this->file = $get['file'];
            }

            if (isset($get['autoMap'])) {
                $this->autoMap = $get['autoMap'];
            }

            if (isset($get['skipRows'])) {
                $this->skipRows = $get['skipRows'];
            }

            if (isset($get['matchField'])) {
                $this->matchField = $get['matchField'];
            }
            
            if (isset($get['matchRelation'])) {
                $this->matchRelation = $get['matchRelation'];
            }            

            if (isset($get['returnRoute'])) {
                $this->returnRoute = $get['returnRoute'];
            }

            if (isset($get['matchCol'])) {
                $this->matchCol = $get['matchCol'];
            }

            if (isset($get['headings'])) {
                $this->headings = $get['headings'];
            }

            if (isset($get['foundHeadings'])) {
                $this->foundHeadings = $get['foundHeadings'];
            }

            if (isset($get['notFoundHeadings'])) {
                $this->notFoundHeadings = $get['notFoundHeadings'];
            }

            if (isset($get['notPermittedHeadings'])) {
                $this->notPermittedHeadings = $get['notPermittedHeadings'];
            }

            if (isset($get['highestRow'])) {
                $this->highestRow = $get['highestRow'];
            }

            if (isset($get['highestColumn'])) {
                $this->highestColumn = $get['highestColumn'];
            }

            if (isset($get['highestColumnIndex'])) {
                $this->highestColumnIndex = $get['highestColumnIndex'];
            }

            $this->defaultRoute = 'import/import';
        }
    }

    public function setModel($value)
    {
        $this->model = $value;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setFile($value)
    {
        $this->file = $value;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFields($value)
    {
        $this->fields = $value;
    }

    public function getFields()
    {
        return $this->fields;
    }
    
    public function setSetFields($value)
    {
        $this->setFields = $value;
    }

    public function getSetFields()
    {
        return $this->setFields;
    }    

    public function setAutoMap($value)
    {
        $this->autoMap = $value;
    }

    public function getAutoMap()
    {
        return $this->autoMap;
    }

    public function setSkipRows($value)
    {
        $this->skipRows = $value;
    }

    public function getSkipRows()
    {
        return $this->skipRows;
    }

    public function setMatchField($value)
    {
        $this->matchField = $value;
    }

    public function getMatchField()
    {
        return $this->matchField;
    }
    
    public function setMatchRelation($value)
    {
        $this->matchRelation = $value;
    }

    public function getMatchRelation()
    {
        return $this->matchRelation;
    }    

    public function setReturnRoute($value)
    {
        $this->returnRoute = $value;
    }

    public function getReturnRoute()
    {
        return $this->returnRoute;
    }

    public function setMatchCol($value)
    {
        $this->matchCol = $value;
    }

    public function getMatchCol()
    {
        return $this->matchCol;
    }

    public function setHeadings($value)
    {
        $this->headings = $value;
    }

    public function getHeadings()
    {
        return $this->headings;
    }

    public function setFoundHeadings($value)
    {
        $this->foundHeadings = $value;
    }

    public function getFoundHeadings()
    {
        return $this->foundHeadings;
    }

    public function setNotFoundHeadings($value)
    {
        $this->notFoundHeadings = $value;
    }

    public function getNotFoundHeadings()
    {
        return $this->notFoundHeadings;
    }

    public function setNotPermittedHeadings($value)
    {
        $this->notPermittedHeadings = $value;
    }

    public function getNotPermittedHeadings()
    {
        return $this->notPermittedHeadings;
    }

    public function setHighestRow($value)
    {
        $this->highestRow = $value;
    }

    public function getHighestRow()
    {
        return $this->highestRow;
    }

    public function setHighestColumn($value)
    {
        $this->highestColumn = $value;
    }

    public function getHighestColumn()
    {
        return $this->highestColumn;
    }

    public function setHighestColumnIndex($value)
    {
        $this->highestColumnIndex = $value;
    }

    public function getHighestColumnIndex()
    {
        return $this->highestColumnIndex;
    }

    public function setFieldCols($value)
    {
        $this->fieldCols = $value;
    }

    public function getFieldCols()
    {
        return $this->fieldCols;
    }

    public function setReportRows($value)
    {
        $this->reportRows = $value;
    }

    public function getReportRows()
    {
        return $this->reportRows;
    }

    public function setReportOkNew($value)
    {
        $this->reportOkNew = $value;
    }

    public function getReportOkNew()
    {
        return $this->reportOkNew;
    }

    public function setReportOkUpdated($value)
    {
        $this->reportOkUpdated = $value;
    }

    public function getReportOkUpdated()
    {
        return $this->reportOkUpdated;
    }

    public function setReportFailedNew($value)
    {
        $this->reportFailedNew = $value;
    }

    public function getReportFailedNew()
    {
        return $this->reportFailedNew;
    }

    public function setReportFailedUpdated($value)
    {
        $this->reportFailedUpdated = $value;
    }

    public function getReportFailedUpdated()
    {
        return $this->reportFailedUpdated;
    }

    public function setErr($value)
    {
        $this->err = $value;
    }

    public function getErr()
    {
        return $this->err;
    }

    public function loadSpreadsheet($file)
    {
        $sheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(\Yii::getAlias('@uploads') . '/' . $file);
        $sheet = $sheet->getActiveSheet();
        return $sheet;
    }

    public function prepare($uploadForm, $sheet)
    {
        $this->file = $uploadForm->file;
        $this->highestRow = $sheet->getHighestRow(); // e.g. 10
        $this->highestColumn = $sheet->getHighestColumn(); // e.g. 'F'
        $this->highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($this->highestColumn); // e.g. 5

        $headings = [];
        $foundHeadings = [];
        $foundHeadingCols = [];
        $notFoundHeadings = [];
        $notPermittedHeadings = [];
        $err = [];

        $uModel = new $this->model();
        
        if (isset($this->matchRelation)) { 
            
            $relation = $uModel->getRelation($this->matchRelation);
            
            if (!$relation) {            
                $err[] = $this->matchRelation . ' relation not found in ' . $this->model;
            } else {
                if (!$relation->primaryModel->hasProperty($this->matchField)) {
                    $err[] = $this->matchField . ' not found in ' . $relation->modelClass . ' (from relation: ' . $this->matchRelation . ')';
                }
            }
            
        } else {
            if (!$uModel->hasProperty($this->matchField)) {            
                $err[] = $this->matchField . ' not found in ' . $this->model;
            }
        }
        
        foreach ($this->setFields as $setField => $setValue) {
            if (!$uModel->hasProperty($setField)) {
                $err[] = 'setField[\'' . $setField . '\'] not found in ' . $this->model;
            }
        }
        
        $firstRow = 1 + $this->skipRows;
        $row = $firstRow;
        $matchCol = false;

        for ($col = 1; $col <= $this->highestColumnIndex; ++$col) {
            $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();

            // Is it column to match for update?
            if ($cellValue == $this->matchField) {
                if ($matchCol == false) {
                    $matchCol = $col;
                } else {
                    $err[] = 'More than one ' . $this->matchField . ' column';
                }
            }

            // Save columm headings in arrays
            $headings[] = $cellValue;
            if (in_array($cellValue, $this->fields) || count($this->fields) == 0) {
                if ($uModel->hasProperty($cellValue)) {
                    $foundHeadings[] = $cellValue;
                    $foundHeadingCols[] = $col;
                } else {
                    $notFoundHeadings[] = $cellValue;
                }
            } else {
                $notPermittedHeadings[] = $cellValue;
            }
        }

        $this->headings = $headings;
        $this->foundHeadings = $foundHeadings;
        $this->notFoundHeadings = $notFoundHeadings;
        $this->notPermittedHeadings = $notPermittedHeadings;

        if ($this->autoMap) {
            if (!$matchCol) {
                $err[] = 'Spreadsheet must contain a column headed: ' . $this->matchField;
            }
            $this->fields = $foundHeadings;
            $this->fieldCols = $foundHeadingCols;
            $this->matchCol = $matchCol;
        }

        $this->err = $err;

        if (count($err) > 0) {
            return false;
        }
        return true;
    }

    public function prepareMap($post)
    {
        $fieldCols = [];

        foreach ($this->fields as $f) {
            $fieldCols[] = ($post['ImportForm'][$f] + 1); // PhpSpreadsheet counts columns from 1
            if ($f == $this->matchField) {
                $this->matchCol = ($post['ImportForm'][$f] + 1); // PhpSpreadsheet counts columns from 1
            }
        }

        $this->fieldCols = $fieldCols;
    }

    public function import($sheet)
    {
        $rows = [];
        $rows[] = ['id' => '', 'values' => $this->fields];
        $okNew = [];
        $okUpdated = [];
        $failedNew = [];
        $failedUpdated = [];
        $firstRow = 1 + $this->skipRows;
        $matchValue = '';

        for ($row = $firstRow + 1; $row <= $this->highestRow; ++$row) {
            $cellValues = [];
            $newRecord = false;

            // Look for existing record - create new if not found
            $matchValue = $sheet->getCellByColumnAndRow($this->matchCol, $row)->getCalculatedValue();
            $uModel = $this->model::findOne([$this->matchField => $matchValue]);
            if (!isset($uModel->id)) {
                $uModel = new $this->model();
                $newRecord = true;
            }

            $i = 0;
            foreach ($this->fieldCols as $col) {
                if ($col == $this->matchCol) {
                    $cellValue = $matchValue;
                    if ($newRecord) {
                        $uModel->{$this->fields[$i]} = $cellValue;
                    }
                } else {
                    $cellValue = $sheet->getCellByColumnAndRow($col, $row)->getCalculatedValue();
                    $uModel->{$this->fields[$i]} = $cellValue;
                }
                $cellValues[] = $cellValue;
                $i++;
            }

            if ($uModel->save()) {
                if ($newRecord) {
                    $ok = ['result' => 'okNew', 'id' => $uModel->id, 'values' => $cellValues];
                    $okNew[] = $ok;
                } else {
                    $ok = ['result' => 'okUpdated', 'id' => $uModel->id, 'values' => $cellValues];
                    $okUpdated[] = $ok;
                }
                $rows[] = $ok;
            } else {
                if ($newRecord) {
                    $failed = ['result' => 'failedNew', 'id' => '', 'values' => $cellValues, 'errors' => $uModel->getErrors()];
                    $failedNew[] = $failed;
                } else {
                    $failed = ['result' => 'failedUpdated', 'id' => $uModel->id, 'values' => $cellValues, 'errors' => $uModel->getErrors()];
                    $failedUpdated[] = $failed;
                }
                $rows[] = $failed;
            }
        }

        $this->reportRows = $rows;
        $this->reportOkNew = $okNew;
        $this->reportOkUpdated = $okUpdated;
        $this->reportFailedNew = $failedNew;
        $this->reportFailedUpdated = $failedUpdated;
    }
}
