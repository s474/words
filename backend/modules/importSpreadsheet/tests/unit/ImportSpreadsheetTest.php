<?php

namespace backend\modules\importSpreadsheet\tests\unit;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Yii;

class ImportSpreadsheetTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testPrepareAutoMapSetsRequired()
    {
        $importFields = ['name', 'description'];
        $_GET['fields'] = $importFields;
        $_GET['autoMap'] = 1;
        $_GET['model'] = '\backend\models\Item';
        //$_GET['matchField'] = 'squirrel';

        $uploadForm = new \backend\modules\importSpreadsheet\models\UploadForm();
        $uploadForm->file = 'filename.csv';

        $cellStub = $this->createMock(Cell::class);
        $cellStub->method('getCalculatedValue')
                ->will($this->onConsecutiveCalls(
                    'name',
                    'description',
                    'field1',
                    'field2',
                    'field3',
                    'r2_name',
                    'r2_description',
                    'r2_field1',
                    'r2_field2',
                    'r2_field3',
                    'r3_name',
                    'r3_description',
                    'r3_field1',
                    'r3_field2',
                    'r3_field3'
                ));

        $worksheetStub = $this->createMock(Worksheet::class);
        $worksheetStub->method('getHighestRow')->willReturn('3');
        $worksheetStub->method('getHighestColumn')->willReturn('E');
        $worksheetStub->method('getCellByColumnAndRow')->willReturn($cellStub);

        $module = Yii::$app->getModule('importSpreadsheet');
        $module->prepare($uploadForm, $worksheetStub);

        /*
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module file ' . $module->file);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module matchField ' . $module->matchField);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module highestColumnIndex ' . $module->highestColumnIndex);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module err ' . implode(', ', $module->err));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module headings ' . implode(', ', $module->headings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module foundHeadings ' . implode(', ', $module->foundHeadings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module notFoundHeadings ' . implode(', ', $module->notFoundHeadings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module notPermittedHeadings ' . implode(', ', $module->notPermittedHeadings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module matchCol ' . $module->matchCol);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module fields ' . implode(', ', $module->fields));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module fieldCols ' . implode(', ', $module->fieldCols));
        */

        $this->assertTrue($module->file == 'filename.csv');
        $this->assertTrue($module->highestRow == '3');
        $this->assertTrue($module->highestColumn == 'E');
        $this->assertTrue($module->highestColumnIndex == 5);
        $this->assertTrue($module->headings == ['name', 'description', 'field1', 'field2', 'field3']);
        $this->assertTrue($module->foundHeadings == ['name', 'description']);
        $this->assertTrue($module->notFoundHeadings == []);
        $this->assertTrue($module->notPermittedHeadings == ['field1', 'field2', 'field3']);
        $this->assertTrue($module->matchCol == 1);
        $this->assertTrue($module->fields == ['name', 'description']);
        $this->assertTrue($module->fieldCols == ['1', '2']);
        $this->assertTrue($module->err == []);
    }

    public function testPrepareManualMapSetsRequired()
    {
        $importFields = ['name', 'description'];
        $_GET['fields'] = $importFields;
        $_GET['autoMap'] = 0;
        $_GET['model'] = '\backend\models\Item';

        $uploadForm = new \backend\modules\importSpreadsheet\models\UploadForm();
        $uploadForm->file = 'filename.csv';

        $cellStub = $this->createMock(Cell::class);
        $cellStub->method('getCalculatedValue')
                ->will($this->onConsecutiveCalls(
                    'name',
                    'description',
                    'field1',
                    'field2',
                    'field3',
                    'r2_name',
                    'r2_description',
                    'r2_field1',
                    'r2_field2',
                    'r2_field3',
                    'r3_name',
                    'r3_description',
                    'r3_field1',
                    'r3_field2',
                    'r3_field3'
                ));

        $worksheetStub = $this->createMock(Worksheet::class);
        $worksheetStub->method('getHighestRow')->willReturn('3');
        $worksheetStub->method('getHighestColumn')->willReturn('E');
        $worksheetStub->method('getCellByColumnAndRow')->willReturn($cellStub);

        $module = Yii::$app->getModule('importSpreadsheet');
        $module->prepare($uploadForm, $worksheetStub);

        /*
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module file ' . $module->file);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module matchField ' . $module->matchField);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module highestColumnIndex ' . $module->highestColumnIndex);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module err ' . implode(', ', $module->err));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module headings ' . implode(', ', $module->headings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module foundHeadings ' . implode(', ', $module->foundHeadings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module notFoundHeadings ' . implode(', ', $module->notFoundHeadings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module notPermittedHeadings ' . implode(', ', $module->notPermittedHeadings));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module matchCol ' . $module->matchCol);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module fields ' . implode(', ', $module->fields));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module fieldCols ' . implode(', ', $module->fieldCols));
        */

        $this->assertTrue($module->file == 'filename.csv');
        $this->assertTrue($module->highestRow == '3');
        $this->assertTrue($module->highestColumn == 'E');
        $this->assertTrue($module->highestColumnIndex == 5);
        $this->assertTrue($module->headings == ['name', 'description', 'field1', 'field2', 'field3']);
        $this->assertTrue($module->foundHeadings == ['name', 'description']);
        $this->assertTrue($module->notFoundHeadings == []);
        $this->assertTrue($module->notPermittedHeadings == ['field1', 'field2', 'field3']);
        $this->assertTrue($module->matchCol == '');
        $this->assertTrue($module->fields == ['name', 'description']);
        $this->assertTrue($module->fieldCols == []);
        $this->assertTrue($module->err == []);
    }

    public function testPrepareMapSetsRequired()
    {
        $importFields = ['name', 'description'];
        $_GET['fields'] = $importFields;
        $_GET['autoMap'] = 0;
        $_GET['model'] = '\backend\models\Item';

        // Simulate the user's field mapping
        $post = ['ImportForm' => ['name' => '0', 'description' => '1']];

        $module = Yii::$app->getModule('importSpreadsheet');
        $module->prepareMap($post);

        /*
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module matchCol ' . $module->matchCol);
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module fields ' . implode(', ', $module->fields));
        codecept_debug('!*!*!*!*!*!*!*!*!*!*!*!*!*! module fieldCols ' . implode(', ', $module->fieldCols));
        */

        $this->assertTrue($module->matchCol == '1');
        $this->assertTrue($module->fields == ['name', 'description']);
        $this->assertTrue($module->fieldCols == ['1', '2']);
    }

    public function testImportAutoMap()
    {
    }

    public function testImportManualMap()
    {
    }
}
