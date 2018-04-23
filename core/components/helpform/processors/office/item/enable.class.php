<?php

class helpFormOfficeItemEnableProcessor extends modObjectProcessor
{
    public $objectType = 'helpFormItem';
    public $classKey = 'helpFormItem';
    public $languageTopics = ['helpform'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('helpform_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var helpFormItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('helpform_item_err_nf'));
            }

            $object->set('active', true);
            $object->save();
        }

        return $this->success();
    }

}

return 'helpFormOfficeItemEnableProcessor';
