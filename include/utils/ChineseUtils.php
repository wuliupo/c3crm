<?php
function toCNcap($data){
   $capnum=array("��","Ҽ","��","��","��","��","½","��","��","��");
   $capdigit=array("","ʰ","��","Ǫ");
   $subdata=explode(".",$data);
   $yuan=$subdata[0];
   $j=0; $nonzero=0;
   for($i=0;$i<strlen($subdata[0]);$i++){
      if(0==$i){ //ȷ����λ 
         if($subdata[1]){ 
            $cncap=(substr($subdata[0],-1,1)!=0)?"Ԫ":"Ԫ��";
         }else{
            $cncap="Ԫ";
         }
      }   
      if(4==$i){ $j=0;  $nonzero=0; $cncap="��".$cncap; } //ȷ����λ
      if(8==$i){ $j=0;  $nonzero=0; $cncap="��".$cncap; } //ȷ����λ
      $numb=substr($yuan,-1,1); //��ȡβ��
      $cncap=($numb)?$capnum[$numb].$capdigit[$j].$cncap:(($nonzero)?"��".$cncap:$cncap);
      $nonzero=($numb)?1:$nonzero;
      $yuan=substr($yuan,0,strlen($yuan)-1); //��ȥβ��	  
      $j++;
   }
   if($subdata[1]){
     $chiao=(substr($subdata[1],0,1))?$capnum[substr($subdata[1],0,1)]."��":"��";
     $cent=(substr($subdata[1],1,1))?$capnum[substr($subdata[1],1,1)]."��":"���";
   }
   $cncap .= $chiao.$cent."��";
   $cncap=preg_replace("/(��)+/","\\1",$cncap); //�ϲ��������㡱
   return $cncap;
 }
?>