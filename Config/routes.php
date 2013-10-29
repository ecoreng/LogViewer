<?php

CroogoRouter::connect('/admin/LogViewer', array('plugin' => 'LogViewer', 'controller' => 'Viewer', 'action' => 'index', 'admin' => true));
CroogoRouter::connect('/admin/LogViewer/:action', array('plugin' => 'LogViewer', 'controller' => 'Viewer', 'admin' => true));

