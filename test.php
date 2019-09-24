<?php 	include "./connect/connect.php";
		include "include_bootstrap.html"; 
/////////////////////////////////////////////////////////////////////// mng //////////////////////////////////////////////////////////////////////

if(isset($_GET['mng'])){ ?>
<form class="form-horizontal box-content" style="height: 80%;" method="POST" action="">
	<div class="form-group">
		<label class="control-label col-sm-2" >รหัสประจำตัวประชาชน:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="mng_id" placeholder="รหัสประจำตัวประชาชน">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" >ชื่อ-นามสกุล:</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" name="mng_name" placeholder="ชื่อ">
		</div>
		<div class="col-sm-5">
			<input type="text" class="form-control" name="mng_lname" placeholder="นามสกุล">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" >เบอร์โทรศัพท์:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="mng_tel" placeholder="เบอร์โทรศัพท์">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" >เพศ:</label>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="mng_gender" value="male">ชาย</label>
			<label class="radio-inline"><input type="radio" name="mng_gender" value="female">หญิง</label>
			<label class="radio-inline"><input type="radio" name="mng_gender" value="other">อื่นๆ</label>
		</div>
	</div>
	<div class="form-group" style="text-align: center;padding-top:10%"> 
		<div class="col-sm-12">
			<button name="btn_add" type="submit" class="cv_btn btn-ok">login</button>
		</div>
	</div>
</form>
<?php
	if(isset($_POST['btn_add']) && $_POST['mng_id']!="" && $_POST['mng_name']!="" && $_POST['mng_tel']!="" ){ 
		$mng_id=$_POST['mng_id']; $mng_name=$_POST['mng_name']; $mng_lname=$_POST['mng_lname']; $mng_tel=$_POST['mng_tel']; $mng_gender=$_POST['mng_gender'];
		$que=oci_parse($conn, "insert into manager_dorm (MNG_ID, MNG_NAME, MNG_LNAME, MNG_TEL, MNG_GENDER) values ('".$mng_id."', '".$mng_name."', '".$mng_lname."', '".$mng_tel."',' ".$mng_gender."')");
		$rec=oci_execute($que);
		if(!$rec){$err=oci_error();echo "<center style='color:#ac3115;'>".$err['message']."</center>";}	

	}
}
/////////////////////////////////////////////////////////////////////// staff //////////////////////////////////////////////////////////////////////
elseif(isset($_GET['staff'])){
?>
<form class="form-horizontal box-content" style="height: 80%;" method="POST" action="">
	<div class="form-group">
		<label class="control-label col-sm-2" >รหัสประจำตัวประชาชน:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="s_id" placeholder="รหัสประจำตัวประชาชน">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" >ชื่อ-นามสกุล:</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" name="s_name" placeholder="ชื่อ">
		</div>
		<div class="col-sm-5">
			<input type="text" class="form-control" name="s_lname" placeholder="นามสกุล">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" >เบอร์โทรศัพท์:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="s_tel" placeholder="เบอร์โทรศัพท์">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">เพศ:</label>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="s_gender" value="male">ชาย</label>
			<label class="radio-inline"><input type="radio" name="s_gender" value="female">หญิง</label>
			<label class="radio-inline"><input type="radio" name="s_gender" value="other">อื่นๆ</label>
		</div>
	</div>
	<div class="form-group">
		<label>ผู้รับเข้าทำงาน:</label>
		<div class="col-sm-10">
			<select class="form-control" id="mng_id" name="mng_id">
				<?php $que=oci_parse($conn,"select * from manager_dorm");
						$rec=oci_execute($que);
						while(($sh=oci_fetch_array($que))) { ?>
							<option value="<?=$sh['MNG_ID']?>"><?=$sh['MNG_NAME']." ".$sh['MNG_LNAME'];?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group" style="text-align: center;padding-top:10%"> 
		<div class="col-sm-12">
			<button name="btn_add" type="submit" class="cv_btn btn-ok">login</button>
		</div>
	</div>
</form>
<?php 
	if(isset($_POST['btn_add']) && $_POST['s_id']!="" && $_POST['s_name']!="" && $_POST['s_lname']!="" && $_POST['mng_id']!="" ){ 
			$s_id=$_POST['s_id']; $s_name=$_POST['s_name'];$s_lname=$_POST['s_lname'];$mng_id=$_POST['mng_id']; $s_gender=$_POST['s_gender'];$s_tel=$_POST['s_tel'];
			$sql="insert into STAFF_DORM (s_id,s_name,s_lname,mng_id,s_gender,s_tel) values ('".$s_id."','".$s_name."','".$s_lname."','".$mng_id."','".$s_gender."','".$s_tel."')";
			$que=oci_parse($conn, $sql);
			echo $sql;

			$rec=oci_execute($que);
			if(!$rec){$err=oci_error();echo "<center style='color:#ac3115;'>".$err['message']."</center>";}	

	}
} ?>