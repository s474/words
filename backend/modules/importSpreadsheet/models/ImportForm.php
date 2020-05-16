<?php

namespace backend\modules\importSpreadsheet\models;

use backend\models\DynamicForm;

class ImportForm extends DynamicForm
{
    public $matchField;

    public function rules()
    {
        return [
            [[$this->matchField], 'required'],
        ];
    }
}
