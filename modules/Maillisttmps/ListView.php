<?php
require_once('include/CRMSmarty.php');
require_once("data/Tracker.php");
require_once('modules/Maillisttmps/Maillisttmps.php');
require_once('include/logging.php');
require_once('include/ListView/ListView.php');
require_once('include/utils/utils.php');
require_once('modules/Maillisttmps/ModuleConfig.php');
require_once('modules/CustomView/CustomView.php');
require_once('include/DatabaseUtil.php');
global $app_strings,$mod_strings,$list_max_entries_per_page;
$log = LoggerManager::getLogger('maillisttmp_list');
global $currentModule,$image_path,$theme;
$focus = new Maillisttmps();
$smarty = new CRMSmarty();
$other_text = Array();
//<<<<<<<<<<<<<<<<<<< sorting - stored in session >>>>>>>>>>>>>>>>>>>>
$sorder = $focus->getSortOrder();
$order_by = $focus->getOrderBy();
$_SESSION['MAILLISTTMPS_ORDER_BY'] = $order_by;
$_SESSION['MAILLISTTMPS_SORT_ORDER'] = $sorder;
//<<<<<<<<<<<<<<<<<<< sorting - stored in session >>>>>>>>>>>>>>>>>>>>
if($_REQUEST['parenttab'] != '')
{
	$category = $_REQUEST['parenttab'];
}
else
{
	$category = getParentTab();
}
if(!$_SESSION['lvs'][$currentModule])
{
	unset($_SESSION['lvs']);
	$modObj = new ListViewSession();
	$modObj->sorder = $sorder;
	$modObj->sortby = $order_by;
	$_SESSION['lvs'][$currentModule] = get_object_vars($modObj);
}
//<<<<cutomview>>>>>>>
$oCustomView = new CustomView("Maillisttmps");
$viewid = $oCustomView->getViewId($currentModule);
if($viewid == 0){
	$viewid = 9;
}
$customviewcombo_html = $oCustomView->getCustomViewCombo($viewid);
$viewnamedesc = $oCustomView->getCustomViewByCvid($viewid);
//<<<<<customview>>>>>
if (!isset($where)) $where = "";
$url_string = ''; // assigning http url string
if(isset($_REQUEST['errormsg']) && $_REQUEST['errormsg'] != '')
{
        $errormsg = $_REQUEST['errormsg'];
        $smarty->assign("ERROR","The User does not have permission to delete ".$errormsg." ".$currentModule);
}else
{
        $smarty->assign("ERROR","");
}
//change by renzhen for save the search information
if(isset($_REQUEST['clearquery']) && $_REQUEST['clearquery'] == 'true'){
	unset($_SESSION['LiveViewSearch'][$currentModule]);
	if(isset($_REQUEST['query'])) $_REQUEST['query']='';
}
if(isset($_REQUEST['query']) && $_REQUEST['query'] == 'true')
{
	list($where, $ustring) = explode("#@@#",getWhereCondition($currentModule));
	// we have a query
	$url_string .="&query=true".$ustring;
	$log->info("Here is the where clause for the list view: $where");
	$smarty->assign("SEARCH_URL",$url_string);
	if(!isset($_SESSION['LiveViewSearch'])) $_SESSION['LiveViewSearch']=array();
	$searchopts=getSearchConditions();
	$_SESSION['LiveViewSearch'][$currentModule]=array($viewid,$where,$ustring,$searchopts);
}else{
	$_SESSION['LiveViewSearch'][$currentModule]= array();
}
if(isPermitted($currentModule,'EditView','') == 'yes')
{
	//quick edit
	//$other_text['quick_edit'] = $app_strings['LBL_QUICKEDIT_BUTTON_LABEL'];
	$other_text['c_owner'] = $app_strings["LBL_CHANGE_OWNER"];
}
if(isPermitted($currentModule,'Delete','') == 'yes')
{
	$other_text['del'] = $app_strings['LBL_MASS_DELETE'];
}
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
$smarty->assign("CUSTOMVIEW_OPTION",$customviewcombo_html);
$smarty->assign("VIEWID", $viewid);
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("MODULE",$currentModule);
$smarty->assign("SINGLE_MOD",'Maillisttmp');
$smarty->assign("BUTTONS",$other_text);
$smarty->assign("CATEGORY",$category);
//Retreive the list from Database
//<<<<<<<<<customview>>>>>>>>>
if(isset($where) && $where != '')
{
	$_SESSION['export_where'] = $where;
	$where = ' and '.$where;
}
else
   unset($_SESSION['export_where']);
if($viewid != "0")
{
	$listquery = $focus->getListQuery($where);
	$query = $oCustomView->getModifiedCvListQuery($viewid,$listquery,"Maillisttmps");
}else
{
	$query = $focus->getListQuery($where);
}
//<<<<<<<<customview>>>>>>>>>
//Retreiving the no of rows
$count_result = $adb->query( mkCountQuery( $query));
$noofrows = $adb->query_result($count_result,0,"count");
//Storing Listview session object
if($_SESSION['lvs'][$currentModule])
{
	setSessionVar($_SESSION['lvs'][$currentModule],$noofrows,$list_max_entries_per_page);
}
$start = $_SESSION['lvs'][$currentModule]['start'];
//Retreive the Navigation array
$navigation_array = getNavigationValues($start, $noofrows, $list_max_entries_per_page);
//Postgres 8 fixes
if( $adb->dbType == "pgsql")
     $query = fixPostgresQuery( $query, $log, 0);
// Setting the record count string
//modified by rdhital
$start_rec = $navigation_array['start'];
$end_rec = $navigation_array['end_val'];
//By raju Ends
$_SESSION['nav_start']=$start_rec;
$_SESSION['nav_end']=$end_rec;
//limiting the query
if(isset($order_by) && $order_by != '')
{
	if($order_by == 'smownerid')
    {
		$query_order_by = 'user_name';
    }
	else
	{
		$query_order_by =  $focus->entity_table.".".$order_by;
    }
}
if ($start_rec ==0)
	$limit_start_rec = 0;
else
	$limit_start_rec = $start_rec -1;
$list_result = $adb->limitQuery2($query,$limit_start_rec,$list_max_entries_per_page,$query_order_by,$sorder);
$record_string= $app_strings["LBL_SHOWING"]." " .$start_rec." - ".$end_rec." " .$app_strings["LBL_LIST_OF"] ." ".$noofrows;
//Retreive the List View Table Header
if($viewid !='')
$url_string .="&viewname=".$viewid;
$listview_header = getListViewHeader($focus,"Maillisttmps",$url_string,$sorder,$order_by,"",$oCustomView);
$smarty->assign("LISTHEADER", $listview_header);
$listview_header_search = getSearchListHeaderValues($focus,"Maillisttmps",$url_string,$sorder,$order_by,"",$oCustomView);
$smarty->assign("SEARCHLISTHEADER",$listview_header_search);
$listview_entries = getListViewEntries($focus,"Maillisttmps",$list_result,$navigation_array,"","","EditView","Delete",$oCustomView);
$smarty->assign("LISTENTITY", $listview_entries);
$navigationOutput = getTableHeaderNavigation($navigation_array, $url_string,"Maillisttmps","index",$viewid);
$fieldnames = getAdvSearchfields($module);
$criteria = getcriteria_options();
$smarty->assign("CRITERIA", $criteria);
$smarty->assign("FIELDNAMES", $fieldnames);
$smarty->assign("NAVIGATION", $navigationOutput);
$smarty->assign("RECORD_COUNTS", $record_string);
if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display("Maillisttmps/ListViewEntries.tpl");
else
	$smarty->display("Maillisttmps/ListView.tpl");
?>
