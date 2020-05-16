<?php

namespace backend\modules\importSpreadsheet\models;

use yii\base\Model;

class DynamicForm extends Model
{
    private $dynamicFields;
    private $dynamicData;
    protected $dynamicRules = [];

    public function rules()
    {
        return $this->dynamicRules;
    }

    public function __get($name)
    {
        return $this->dynamicData[$name];
    }

    public function __set($name, $value)
    {
        $this->dynamicData[$name] = $value;
    }

    public function getDynamicFields()
    {
        return $this->dynamicFields;
    }

    public function setDynamicFields($value)
    {
        $this->dynamicFields = $value;
    }
}
