<?php

Croogo::hookRoutes('LogViewer');

/**
 * Admin menu (navigation)
 */
CroogoNav::add('settings.children.logviewer', array(
	'title' => 'Log Viewer',
	'url' => array(
		'plugin' => 'LogViewer',
		'controller' => 'Viewer',
		'action' => 'index',
		'admin' => true,
	),
));

