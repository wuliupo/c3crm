<?php
include("../../config.php");
//echo "upload_file_name.csv";
global $tmp_dir, $root_directory;
$upload_file_name = tempnam($root_directory.$tmp_dir, "upload.crm");
//echo "upload_file_name:".$upload_file_name;
if (isset($_FILES["Filedata"]) && is_uploaded_file($_FILES["Filedata"]["tmp_name"]) && $_FILES["Filedata"]["error"] == 0) {
	//�ϴ��ļ���ֵ��$upload_file
	$upload_file=$_FILES["Filedata"];
	if(move_uploaded_file($upload_file["tmp_name"],$upload_file_name)){
		$upload_file_name = str_replace("\\","/",$upload_file_name);
		echo $upload_file_name;
	}else{
		echo '';
	}
} else {
	echo ' '; // I have to return something or SWFUpload won't fire uploadSuccess
}
/*
//����Ĭ�Ϸ�����ļ���
$filename = GetID( ".csv" );
$s = new SaeStorage();
if (isset($_FILES["Filedata"]) && is_uploaded_file($_FILES["Filedata"]["tmp_name"]) && $_FILES["Filedata"]["error"] == 0) {
	//�ϴ��ļ���ֵ��$upload_file
	$upload_file=$_FILES["Filedata"];
	
	$ret = $s->upload( 'upload' , $filename , $upload_file["tmp_name"] );
	if($ret == false){
		echo 'error';
	}else{
		echo $filename;
	}
} else {
	echo ''; // I have to return something or SWFUpload won't fire uploadSuccess
}
// ��������ļ���
function GetID($prefix) {
   //��һ��:��ʼ������
   //microtime(); �Ǹ�����
   $seedstr =@split(" ",microtime(),5);
   
   $seed =$seedstr[0]*10000;   
   //�ڶ���:ʹ�����ӳ�ʼ�������������
   srand($seed);   
   //������:����ָ����Χ�ڵ������
   $random =rand(1000,10000);
  
   $filename = date("YmdHis", time()).$random.$prefix;
  
   return $filename;
}
*/
?>