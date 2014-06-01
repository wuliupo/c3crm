<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
require_once('include/CRMSmarty.php');
require_once('modules/Notes/Notes.php');
require_once('include/utils/utils.php');
//Redirecting Header for single page layout
require_once('user_privileges/default_module_view.php');
global $singlepane_view;
if($singlepane_view == 'true' && $_REQUEST['action'] == 'CallRelatedList' )
{
	header("Location:index.php?action=DetailView&module=".$_REQUEST['module']."&record=".$_REQUEST['record']."&parenttab=".$_REQUEST['parenttab']);
}
else
{
$focus = new Notes();
$currentmodule = $_REQUEST['module'];
$RECORD = $_REQUEST['record'];
if(isset($_REQUEST['record']) && $_REQUEST['record']!='') {
    $focus->retrieve_entity_info($_REQUEST['record'],"Notes");
    $focus->id = $_REQUEST['record'];
    $focus->notes_title=$focus->column_fields['notes_title'];
}
global $mod_strings;
global $app_strings;
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
$smarty = new CRMSmarty();
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
        $focus->id = "";
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode'] != ' ') {
	$smarty->assign("OP_MODE",$_REQUEST['mode']);
}
 if(isset($_SESSION['rlvs']) && !$_SESSION['rlvs'][$module])
 {
       unset($_SESSION['rlvs']);
 }
$category = getParentTab();
$smarty->assign("CATEGORY",$category);
$smarty->assign("UPDATEINFO",updateInfo($focus->id));
if (isset($focus->name)) $smarty->assign("NAME", $focus->name);
$related_array=getRelatedLists("Notes",$focus);
$smarty->assign("RELATEDLISTS", $related_array);
$smarty->assign("ID",$focus->id);
$smarty->assign("MODULE",$currentmodule);
$smarty->assign("SINGLE_MOD",'Note');
$smarty->assign("MOD",$mod_strings);
$smarty->assign("APP",$app_strings);
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);
$check_button = Button_Check($module);
$smarty->assign("CHECK", $check_button);
$smarty->display("RelatedLists.tpl");
}
?>
