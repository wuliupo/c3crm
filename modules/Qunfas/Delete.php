<?php
require_once('modules/Qunfas/Qunfas.php');
require_once('include/logging.php');
$log = LoggerManager::getLogger('qunfa_delete');
$focus = new Qunfas();
if(!isset($_REQUEST['record']))
	die("A record number must be specified to delete the note.");
DeleteEntity($_REQUEST['module'],$_REQUEST['return_module'],$focus,$_REQUEST['record'],$_REQUEST['return_id']);
if(isset($_REQUEST['parenttab']) && $_REQUEST['parenttab'] != "") $parenttab = $_REQUEST['parenttab'];
header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']."&parenttab=$parenttab"."&relmodule=".$_REQUEST['module']);
?>
