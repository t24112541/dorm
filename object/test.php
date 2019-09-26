<?php
	if(isset($_POST['btn_add']) && $_POST['B_NAME']!=''){
		$que_chk=oci_parse($conn,"select count(B_NAME)as NUM from BUILDING_DORM where B_NAME=:B_NAME");
		oci_bind_by_name($que_chk, ':B_NAME', $_POST['B_NAME']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$que=oci_parse($conn,"insert into BUILDING_DORM (B_NAME,B_LOCATION,B_ROOM_COUNT) values (:B_NAME,:B_LOCATION,:B_ROOM_COUNT)");
			oci_bind_by_name($que, ':B_NAME', $_POST['B_NAME']);
			oci_bind_by_name($que, ':B_LOCATION', $_POST['B_LOCATION']);
			oci_bind_by_name($que, ':B_ROOM_COUNT', $_POST['B_ROOM_COUNT']);
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?building_dorm'>";}
		}else{ ?>
			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
				document.getElementById("B_NAME").innerHTML=<?php echo $_POST['B_NAME'];?>;
			</script>
		<?php }
		
	}elseif(isset($_POST['btn_edit']) && $_POST['B_NAME']!=''){
		$que_chk=oci_parse($conn,"select count(B_NAME)as NUM from BUILDING_DORM where B_NAME=:B_NAME");
		oci_bind_by_name($que_chk, ':B_NAME', $_POST['B_NAME']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$que=oci_parse($conn,"update BUILDING_DORM set B_NAME=:B_NAME,B_LOCATION=:B_LOCATION,B_ROOM_COUNT=:B_ROOM_COUNT where B_ID=:B_ID");
			oci_bind_by_name($que, ':B_NAME', $_POST['B_NAME']);
			oci_bind_by_name($que, ':B_LOCATION', $_POST['B_LOCATION']);
			oci_bind_by_name($que, ':B_ROOM_COUNT', $_POST['B_ROOM_COUNT']);
			oci_bind_by_name($que, ':B_ID', $_POST['B_ID']);
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?building_dorm'>";}
		}else{ ?>

			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
				document.getElementById("B_NAME").innerHTML=<?php echo $_POST['B_NAME'];?>;
			</script>
		<?php }
	}
?>