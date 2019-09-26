<?php
	// error_reporting(E_ERROR | E_PARSE);
	date_default_timezone_set("Asia/Bangkok");
	$arr = json_decode(file_get_contents('./db/db_main.txt'), true)  or die("Unable to open file!");

	$username=$arr['username'];
	$password=$arr['password'];
	$host=$arr['host'];
	$port=$arr['port'];
	$sid=$arr['sid'];
	$char="AL32UTF8";

	$db = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port)))(CONNECT_DATA=(SID=$sid)))";
	$conn = oci_connect($username,$password,$db,$char);
	if (!$conn){
		$err=oci_error();
		echo "<center style='color:#ac3115;'>".$err['message']."</center>";
		$_SESSION['db_status']="main_db_fail";
	}
	

////////////////////////////////  select ///////////////////////////
	////////////////////////////////////////////////////////////////////

////////////////////////////////  insert ///////////////////////////

	// $que=oci_parse($conn,"insert into building_dorm (column1,b_location,b_room_count) values ('test1','location',2)");
	// $rec=oci_execute($que);
	// if($rec){echo "insert ok";}else{echo "insert error";}
////////////////////////////////////////////////////////////////////

////////////////////////////////  update ///////////////////////////
	// $que=oci_parse($conn,"update building_dorm set column1='ola' where b_id=14");
	// $rec=oci_execute($que);
	// if($rec){echo "update ok";}else{echo "update error";}
////////////////////////////////////////////////////////////////////

////////////////////////////////  commit ///////////////////////////
	// $que=oci_parse($conn,"commit");
	// $rec=oci_execute($que);
	// if($rec){echo "commit ok";}else{echo "commit error";}
////////////////////////////////////////////////////////////////////
	// oci_close($conn);
?>