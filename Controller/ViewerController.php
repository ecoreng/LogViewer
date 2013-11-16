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

    public function admin_clearcache()
    {
        $this->delete();
    }

    protected function delete($path = '', $recursive = true)
    {
        if (!$path) {
            $path = CACHE;
        }
        $dirItems = scandir($path);
        $ignore = array('.', '..');
        foreach ($dirItems AS $dirItem) {
            if (in_array($dirItem, $ignore)) {
                continue;
            }

            if (is_dir($path . $dirItem) && $recursive) {
                $this->delete($path . $dirItem . DS);
            } elseif (substr($dirItem, 0, 5) == 'cake_' || substr($dirItem, 0, 7) == 'croogo_') {
                unlink($path . $dirItem);
            }
        }
        $this->redirect(
                array('action' => 'index'
        ));
    }

}
