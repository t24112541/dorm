<?php
session_start();
ob_start();
// $_SESSION['u_id']=1010101;
// session_destroy();
	require_once("../db/controller.php");
	if(getenv('production')==true){
		$db=new controller("192.168.1.178:3306",getenv('db_user'),getenv('db_pass'),"nfc_dts");
	}
	else{
		$db=new controller("localhost","root","","nfc_dts");
	}
	
	$perpage=10;

	if(isset($_POST['load_p_patient'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where p_id like '%{$_POST['filter']}%' || p_name like '%{$_POST['filter']}%' || p_lname like '%{$_POST['filter']}%' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("p_patient","*",$option);
	}else if(isset($_POST['load_p_patient_detail'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where p_id = '{$_POST['filter']}' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}

		echo $db->select("p_patient","*",$option);
	}else if(isset($_POST['p_patient_add'])){
		$chk=$db->count_rows("p_patient","p_id","where p_id='{$_POST['p_id']}'");
		if(!$chk){
			echo $db->insert("p_patient","p_id,p_name,p_lname,p_age,p_blood,p_weight,p_height,p_gender","'{$_POST['p_id']}','{$_POST['p_name']}','{$_POST['p_lname']}','{$_POST['p_age']}','{$_POST['p_blood']}','{$_POST['p_weight']}','{$_POST['p_height']}','{$_POST['p_gender']}'");
		}else{
			$res=[
				"msg"=>"พบรหัสประชาชนเดียวกันในระบบ"
			];
			echo json_encode($res);
		}
	}else if(isset($_POST['p_patient_update'])){
		echo $db->update("p_patient","p_name='{$_POST['p_name']}',p_lname='{$_POST['p_lname']}',p_age='{$_POST['p_age']}',p_blood='{$_POST['p_blood']}',p_weight='{$_POST['p_weight']}',p_height='{$_POST['p_height']}',p_gender='{$_POST['p_gender']}'","p_id='{$_POST['p_id']}'");
	}else if(isset($_POST['p_patient_del'])){
		$chk=json_decode($db->count_rows("p_staff","s_id","where p_id='{$_POST['p_id']}'"));
		// print_r($chk);
		if($chk!=0){
			$res=[
				"msg"=>"ไม่สามารถลบข้อมูลที่ใช้เข้าระบบได้"
			];
			echo json_encode($res);
		}else{
			echo $db->delete("p_patient","p_id='{$_POST['p_id']}'");
		}
	}else if(isset($_POST['load_p_drug'])){
		
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where d_id like '%{$_POST['filter']}%' || d_name like '%{$_POST['filter']}%' ";
		}else{
			$option="where 1 limit {$start},{$perpage}";
		}
		
		echo $db->select("p_drug","*",$option);
	}else if(isset($_POST['load_p_staff'])){
		if(isset($_POST['page'])){
			$page=$_POST['page'];
		}else{
			$page=1;
		} 
		$start=($page-1)*$perpage;
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$option="where p_patient.p_id=p_staff.p_id && p_patient.p_name like '%{$_POST['filter']}%' ";
		}else{
			$option="where p_patient.p_id=p_staff.p_id limit {$start},{$perpage}";
		}

		echo $db->select("p_patient,p_staff","*",$option);
	}else if(isset($_POST['p_staff_add'])){
		$chk=$db->count_rows("p_patient","p_id","where p_id='{$_POST['p_id']}'");
		if(!$chk){
			$p_patient= $db->insert("p_patient","p_id,p_name,p_lname,p_age,p_blood,p_weight,p_height,p_gender","'{$_POST['p_id']}','{$_POST['p_name']}','{$_POST['p_lname']}','{$_POST['p_age']}','{$_POST['p_blood']}','{$_POST['p_weight']}','{$_POST['p_height']}','{$_POST['p_gender']}'");
			$obj2=json_decode($p_patient);
			$first_ins=0;
			foreach ($obj2 as $key => $val ){   
			  if($key=="status" && $val==1){
			  	$first_ins=1;
			  }
			  if($first_ins==1){
			  	if($key=="last_id"){
			  		echo $db->insert("p_staff","s_uname,s_passwd,p_id","'{$_POST['s_uname']}','{$_POST['s_passwd']}','{$_POST['p_id']}'");
			  	}
			  }
			}
		}else{
			$res=[
				"msg"=>"พบรหัสประชาชนเดียวกันในระบบ"
			];
			echo json_encode($res);
		}
		
	}else if(isset($_POST['p_staff_update'])){

		$data=json_decode($db->update("p_patient","p_name='{$_POST['p_name']}',p_lname='{$_POST['p_lname']}',p_age='{$_POST['p_age']}',p_blood='{$_POST['p_blood']}',p_weight='{$_POST['p_weight']}',p_height='{$_POST['p_height']}',p_gender='{$_POST['p_gender']}'","p_id='{$_POST['p_id']}'"));
		if($data->status){
			$update="s_uname='{$_POST['s_uname']}'";
			if(isset($_POST['s_passwd'])){
				$update.=",s_passwd='{$_POST['s_passwd']}'";
			}
			echo ($db->update("p_staff",$update,"p_id='{$_POST['p_id']}'"));
		}else{
			echo $data;
		}
	}else if(isset($_POST['p_staff_del'])){

		$chk=json_decode($db->select("p_staff","s_id","where p_id='{$_POST['p_id']}'"));
		// print_r($chk);
		// // echo $chk->msg==null;
		if($chk[0]->s_id!=$_SESSION['nfc_usr']){
			$data=$db->delete("p_patient","p_id='{$_POST['p_id']}'");
			$obj2=json_decode($data);
			if($obj2->status){
				echo $data2=$db->delete("p_staff","p_id='{$_POST['p_id']}'");
			}else{
				echo $data;
			}
		}else{
			$res=[
				"msg"=>"ไม่สามารถลบข้อมูลที่ใช้เข้าระบบได้"
			];
			echo json_encode($res);
		}
		
	}else if(isset($_POST['set_pagination_staff'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where p_patient.p_id=p_staff.p_id && p_patient.p_id like '%{$_POST['filter']}%' || p_patient.p_name like '%{$_POST['filter']}%' || p_staff.s_uname like '%{$_POST['filter']}%' ";
		}else{
			$where="where p_patient.p_id=p_staff.p_id ";
		}

		
		// $db->count_rows("p_drug","*",$where);

		$total_page=ceil($db->count_rows("p_patient,p_staff","*",$where)/$perpage);
		echo json_encode($total_page);
	}else if(isset($_POST['set_pagination_drug'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where d_id like '%{$_POST['filter']}%' || d_name like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		
		// $db->count_rows("p_drug","*",$where);

		$total_page=ceil($db->count_rows("p_drug","*",$where)/$perpage);
		echo json_encode($total_page);
	}else if(isset($_POST['set_pagination_patient'])){
		if(isset($_POST['filter']) && $_POST['filter']!=""){
			$where="where p_id like '%{$_POST['filter']}%' || p_name like '%{$_POST['filter']}%' || p_lname like '%{$_POST['filter']}%' ";
		}else{
			$where="where 1 ";
		}

		
		// $db->count_rows("p_drug","*",$where);

		$total_page=ceil($db->count_rows("p_patient","*",$where)/$perpage);
		echo json_encode($total_page);
	}else if(isset($_POST['select_p_drug'])){
		echo $db->select("p_math_use_drug","*","where d_id='{$_POST['filter']}'");
	}else if(isset($_POST['load_p_use'])){
		
 
		echo $db->select("p_use","*","where 1 ");
	}else if(isset($_POST['p_drug_add'])){
		echo $db->insert("p_drug","d_id,d_name,d_expire,d_info","'{$_POST['d_id']}','{$_POST['d_name']}','{$_POST['d_expire']}','{$_POST['d_info']}'");

		if(isset($_POST['p_use'])){
			foreach ($_POST['p_use'] as $key => $value) {
				$db->insert("p_math_use_drug","u_id,d_id","{$value},'{$_POST['d_id']}'");
			}
		}
	}else if(isset($_POST['p_drug_del'])){
		echo $db->delete("p_drug","d_id='{$_POST['d_id']}'");
		$db->delete("p_math_use_drug","d_id='{$_POST['d_id']}'");
	}else if(isset($_POST['p_drug_update'])){
		echo $db->update("p_drug","d_name='{$_POST['d_name']}',d_expire='{$_POST['d_expire']}',d_info='{$_POST['d_info']}'","d_id='{$_POST['d_id']}'");
		$db->delete("p_math_use_drug","d_id='{$_POST['d_id']}'");
		if(isset($_POST['p_use'])){
			foreach ($_POST['p_use'] as $key => $value) {
				$db->insert("p_math_use_drug","u_id,d_id","{$value},'{$_POST['d_id']}'");
			}
		}
	}else if(isset($_POST['upload_tmt'])){
		if(isset($_FILES) && $_FILES['tmt_upload']['name']!=''){
			$filename = "../tmt/"."tmt.xls";
			if(move_uploaded_file($_FILES['tmt_upload']["tmp_name"], $filename)){
				require_once '../lib/PHPExcel/Classes/PHPExcel.php';
				include '../lib/PHPExcel/Classes/PHPExcel/IOFactory.php';

				$inputFileType = PHPExcel_IOFactory::identify($filename);  
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
				$objReader->setReadDataOnly(true);  
				$objPHPExcel = $objReader->load($filename);  
				 
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
				$highestRow = $objWorksheet->getHighestRow();
				$highestColumn = $objWorksheet->getHighestColumn();
				 
				$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
				$headingsArray = $headingsArray[1];
				 
				$r = -1;
				$namedDataArray = array();
				for ($row = 2; $row <= $highestRow; ++$row) {
				    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
				    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
				        ++$r;
				        foreach($headingsArray as $columnKey => $columnHeading) {
				            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
				        }
				    }
				}
				 
				foreach ($namedDataArray as $resx) {
					$db->insert("p_drug","d_id,d_name","{$resx['TMTID(TPU)']},'{$resx['FSN']}'");
				}
				$res=[
					"status"=>1
				];
			}else{
				$res=[
					"status"=>0,
					"msg"=>"เกิดข้อผิดพลาดไม่สามารถนำเข้าข้อมูลได้",
				];
			}
		}else{
			$res=[
				"status"=>0,
				"msg"=>"ไม่พบข้อมูล",
			];
		}
		echo json_encode($res);
	}

	else if(isset($_POST['login'])){
		$data= $db->login($_POST['nfc_usr'],$_POST['nfc_pwd']);
		echo $data;

		$obj2=json_decode($data);
		foreach ($obj2 as $key => $val ){   
		  $_SESSION[$key]=$val;

		}

	}else if(isset($_POST['chk_login'])){
		echo $_SESSION['status'];
		echo $_SESSION['auth'];
		echo $_SESSION['nfc_usr'];
	}else if(isset($_POST['load_user'])){
		echo ($db->select("p_staff,p_patient","p_patient.p_name,p_patient.p_lname","where p_staff.p_id=p_patient.p_id && p_staff.s_id='{$_SESSION['nfc_usr']}'"));
	}

	

?>