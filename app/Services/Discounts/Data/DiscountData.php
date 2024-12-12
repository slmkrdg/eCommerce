<?php

namespace App\Services\Discounts\Data;

class DiscountData
{
    private string $name;
    private string $type;
    private $value;
    private $conditions;
    private string $reason;
    private string $ruleClass;


    // name getter ve setter
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    // type getter ve setter
    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    // value getter ve setter
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    // conditions getter ve setter
    public function getConditions()
    {
        return $this->conditions;
    }

    public function setConditions($conditions = null)
    {
        $this->conditions = $conditions;
        return $this;
    }

    // reason getter ve setter
    public function getReason()
    {
        return $this->reason;
    }

    public function setReason(string $reason)
    {
        $this->reason = $reason;
        return $this;
    }

    public function getRuleClass()
    {
        return $this->ruleClass;
    }

    public function setRuleClass(string $ruleClass)
    {
        $this->ruleClass = $ruleClass;
        return $this;
    }
}