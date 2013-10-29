<?php

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb('Log Viewer', array('controller' => 'Viewer', 'action' => 'index'));

echo $this->Html->link('Delete Log', array('action' => 'kill') , array('class' => 'btn'));
echo '<div></div>';
if (is_array($logs)) {
if (count($logs) > 0) {
krsort($logs);
$i = 0;
foreach ($logs as $log) {
	if ($log != '') {
	echo $this->Form->textarea('entry_' . $i, array('value' => $log . '{main}', 'class' => 'input-xxlarge'));
	$i++;
	echo '<div></div>';
	}
}
}
}
?>

