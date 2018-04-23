<?php

/**
 * The home manager controller for helpForm.
 *
 */
class helpFormHomeManagerController extends modExtraManagerController
{
    /** @var helpForm $helpForm */
    public $helpForm;


    /**
     *
     */
    public function initialize()
    {
        $this->helpForm = $this->modx->getService('helpForm', 'helpForm', MODX_CORE_PATH . 'components/helpform/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['helpform:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('helpform');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->helpForm->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/helpform.js');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->helpForm->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        helpForm.config = ' . json_encode($this->helpForm->config) . ';
        helpForm.config.connector_url = "' . $this->helpForm->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "helpform-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="helpform-panel-home-div"></div>';

        return '';
    }
}