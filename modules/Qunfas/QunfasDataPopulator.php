<?php
include_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('data/CRMEntity.php');
require_once('include/utils/utils.php');
/** 
 ** Class to populate the module required data during installation  
 */
class QunfasDataPopulator extends CRMEntity {
		
	function QunfasDataPopulator() {
		$this->log = LoggerManager::getLogger('QunfasDataPopulator');
		$this->db = & getSingleDBInstance();
	}
	var $new_schema = true;
	function create_tables() {
	}
	/** 
	 **Function to populate the default required data during installation  
 	*/
	function create_defautdata($is_upgrade=false) {
		//$this->db->query( "CREATE SEQUENCE ".$sequence." INCREMENT BY 1 NO MAXVALUE NO MINVALUE CACHE 1;");
		$query = "select tabid from ec_tab where name='Qunfas'";
		$result = $this->db->query($query);
		$noofrows = $this->db->num_rows($result);
		if($noofrows > 0) {
			$tab_id = $this->db->query_result($result,0,"tabid");
		} 
		else {
			//$tab_id = $this->db->getUniqueID("ec_tab");
			$query = "select max(tabid) as tabid from ec_tab";
			$result = $this->db->query($query);
			$tab_id = $this->db->query_result($result,0,"tabid") + 1;
			$this->db->query("insert into ec_tab values (".$tab_id.",'Qunfas',0,".$tab_id.",'Qunfas',null,null,1,1)");
			
		}
		$this->db->query("insert into ec_moduleowners values(".$tab_id.",1)");
		$this->db->query("insert into ec_parenttabrel values ('".$module_parenttabid."',".$tab_id.",'".$module_displayorder."')");	
	}
}
?>