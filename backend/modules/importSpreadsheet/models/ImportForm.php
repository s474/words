<?php

namespace backend\modules\importSpreadsheet\models;

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
