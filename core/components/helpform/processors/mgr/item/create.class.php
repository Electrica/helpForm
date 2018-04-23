<?php

class helpFormItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'helpFormItem';
    public $classKey = 'helpFormItem';
    public $languageTopics = ['helpform'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('helpform_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('helpform_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'helpFormItemCreateProcessor';