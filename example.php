<?php
// dummy example of RestClient
require_once('include/utils/CommonUtils.php');
require_once('include/RestClient.class.php');
$enteredUsername = "demo@c3crm.cn";//test account
$enteredPassword = "demo";
require_once('config.php');
$paras = array();
//$paras["callback"] = "?";
$paras["method"] = "login";
$paras["input_type"] = "JSON";
$paras["response_type"] = "JSON";
$paras["rest_data"] = json_encode(array(array("password"=>$enteredPassword,"user_name"=>$enteredUsername),"C3CRM",array("name"=>"language","value"=>"en_US")));
$twitter = RestClient::post($site_URL.'/rest.php',$paras);
//$twitter = RestClient::post( // Same for RestClient::get()
//            $site_URL.'/rest.php?callback=?'
//            ,'{
//				method: "login",
//				input_type: "JSON",
//				response_type: "JSON",
//				rest_data: \'[{"password":"'.$enteredPassword.'","user_name":"'.$enteredUsername.'"},"C3CRM",{"name":"language","value":"en_US"}]\'
//			}' 
//            ,''
//            ,''
//			,'application/json');
var_dump($twitter->getResponse());
echo "<br>aaaaaaaaaaaa<br>";
var_dump($twitter->getResponseCode());
echo "<br>bbbbbbbbbbb<br>";
var_dump($twitter->getResponseMessage());
echo "<br>cccccccccccc<br>";
var_dump($twitter->getResponseContentType());
?>