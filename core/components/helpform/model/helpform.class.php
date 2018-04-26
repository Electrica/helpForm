<?php

class modDashboardWidgetHelpForm extends modDashboardWidgetInterface {
    public $version = '1.0';
    public $config;

    public function __construct($modx, modDashboardWidget $widget, modManagerController $controller)
    {
        parent::__construct($modx, $widget, $controller);

        //Подготовим на развитие, если компонент понравится людям, то будем выводить в админку обращения и переведем виджет на ExtJs

        $corePath = $this->modx->getOption('helpform_core_path', null, $this->modx->getOption('core_path') . 'components/helpform/');
        $assetsUrl = $this->modx->getOption('helpform_assets_path', null, $this->modx->getOption('assets_url') . 'components/helpform/');

        $this->config = array(
            'tplPath' => $corePath . 'elements/',
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',

            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        );

        //Inicialize script & styles
        $this->controller->addCss($this->config['cssUrl'] . 'mgr/main.css');
        //$this->controller->addJavascript($this->config['jsUrl'] . 'mgr/helpform.js');
        $this->controller->addJavascript($this->config['jsUrl'] . 'mgr/uikit.min.js');

        $this->modx->lexicon->load('helpform:default');
    }

    public function render() {

        if(!$this->modx->getService('pdoTools')){
            $chunk = '<p style="color: #9e0505;">Для работы необходим pdoTools</p>';
        }else{

            //Заготовка для ExtJs

//            $this->controller->addHtml('
//            <script type="text/javascript">
//            helpForm.config = ' . json_encode($this->config) . ';
//              Ext.onReady(function() {
//                MODx.load({
//                  xtype: "helpform-grid",
//                  renderTo: "helpform-panel-home-div"
//                });
//              });
//            </script>');

            /**
             * @var pdoTools $pdoTools
             */

            $pdoTools = $this->modx->getService('pdoTools');

            // Загружаем чанк с формой
            $chunk = $pdoTools->getChunk('@FILE chunks/helpform.tpl', array('tplPath' => $this->config['tplPath']));
        }

        if($_POST['helpform']){

            $fields = $_POST;

            // Вырезаем урл сайта
            $pattern = "/^(http|https):\/\//";
            $siteUrl = str_replace('/','',preg_replace($pattern,'',$this->modx->getOption('site_url')));

            $fields = array_merge(array(
                'client' => $siteUrl
            ), $fields);

            //Если дали разрешение на скачку error.log
            if($_POST['log']){
                $log = MODX_CORE_PATH . 'cache/logs/error.log';

                if(is_file($log)){
                    $fields = array_merge(array(
                        'error_log' => file_get_contents($log),
                    ), $fields);
                }
            }

            if($emails = $this->modx->getOption('helpform_help_email')){
                // Тут обработка отправки почты

                $mail = array();
                foreach (explode(',', $emails) as $email){
                    $mail[] = $email;
                }

                $fields = array_merge(array('tplPath' => $this->config['tplPath']), $fields);

                $message = $pdoTools->getChunk('@FILE chunks/helpformemail.tpl', $fields);

                $this->modx->getService('mail', 'mail.modPHPMailer');
                $this->modx->mail->set(modMail::MAIL_BODY, $message);
                $this->modx->mail->set(modMail::MAIL_FROM, $this->modx->getOption('emailsender'));
                $this->modx->mail->set(modMail::MAIL_FROM_NAME, $this->modx->getOption('site_name'));
                $this->modx->mail->set(modMail::MAIL_SUBJECT, $fields['question']);
                foreach ($mail as $m){
                    $this->modx->mail->address('to', trim($m));
                }
                $this->modx->mail->setHTML(true);
                if($log){
                    $this->modx->mail->attach($log);
                }

                if (!$this->modx->mail->send()) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'An error occurred while trying to send the email: '.$this->modx->mail->mailer->ErrorInfo);
                }

                $this->modx->mail->reset();
                $chunk = '<h2>'.$this->modx->lexicon('helpform_thanks_message').'</h2>';

            }elseif($this->modx->getOption('helpform_curl_url')){

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->modx->getOption('helpform_curl_url'));
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

                $result = curl_exec($ch);
                curl_close($ch);

                if($result){
                    $result = $this->modx->stripTags($result);
                    $chunk = '<h2>'.$result.'</h2>';
                }

            }else{
                $chunk = '<h2>'.$this->modx->lexicon('helpform_empty_settings').'</h2>';
            }

        }


        return $chunk;
    }
}
return 'modDashboardWidgetHelpForm';