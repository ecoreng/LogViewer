<?php

App::uses('LogViewerAppController', 'LogViewer.Controller');

class ViewerController extends LogViewerAppController
{

    public $logPath = '';
    public $cachePrefix = array('cake_', 'croogo_');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->logPath = APP . 'tmp' . DS . 'logs' . DS . 'error.log';
    }

    public function admin_index()
    {
        $this->set('title_for_layout', 'Log Viewer');
        $flcnt = '';
        if (is_readable($this->logPath)) {
            $flcnt = file_get_contents($this->logPath);
            $flcnt = explode('{main}' . PHP_EOL, $flcnt);
        }
        $this->set('logs', $flcnt);
    }

    public function admin_kill()
    {
        if (is_readable($this->logPath)) {
            @unlink($this->logPath);
        }
        $this->redirect(
                array(
                    'plugin' => 'LogViewer',
                    'controller' => 'Viewer',
                    'action' => 'index',
                    'admin' => true,
        ));
    }

}
