<?php if(isset($_GET['edit_profile']) && $_SESSION['status']=="MNG"){
		$que=oci_parse($conn,"SELECT * FROM MANAGER_DORM where MNG_ID=:edit_profile");
		oci_bind_by_name($que, ':edit_profile', $_GET['edit_profile']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>

<div class="col-sm-3"></div>
<div class="col-sm-6" style="margin-top:20px;">
	<form name="MANAGER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
		<!-- <?php if(isset($_GET['edit_profile'])){?>
			<a href="?S_DEL=<?php echo $res['MNG_ID'] ?>" style="margin-left:90%" class="btn btn_dan"><i class="fas fa-trash-alt"></i></a>
		<?php } ?> -->
		<div id="" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >รหัสประชาชน:</label>
			<div class="col-sm-9">
				<textarea required readonly  oninvalid="this.setCustomValidity('กรอกรหัสประชาชน')"
    oninput="this.setCustomValidity('')" maxlength="13" rows="1" class="form-control" id="MNG_ID" name="MNG_ID" placeholder="รหัสประชาชน"><?php if(isset($_GET['edit_profile'])) echo $res['MNG_ID'];?></textarea>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ชื่อ:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกชื่อ')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="MNG_NAME" name="MNG_NAME" placeholder="ชื่อ"><?php if(isset($_GET['edit_profile'])) echo $res['MNG_NAME'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >นามสกุล:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกนามสกุล')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="MNG_LNAME" name="MNG_LNAME" placeholder="นามสกุล"><?php if(isset($_GET['edit_profile'])) echo $res['MNG_LNAME'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >เบอร์โทร:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกเบอร์โทร')"
    oninput="this.setCustomValidity('')" maxlength="10" rows="1" class="form-control" id="MNG_TEL" name="MNG_TEL" placeholder="เบอร์โทร"><?php if(isset($_GET['edit_profile'])) echo $res['MNG_TEL'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >เพศ:</label>
			<div class="col-sm-9">
				<label class="radio-inline">
			    	<input type="radio" name="MNG_GENDER" value="ชาย" checked <?php if(isset($_GET['edit_profile'])&&$res['MNG_GENDER']=="ชาย"){echo "checked";} ?>>ชาย
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="MNG_GENDER" value="หญิง" <?php if(isset($_GET['edit_profile'])&&$res['MNG_GENDER']=="หญิง"){echo "checked";} ?>>หญิง
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="MNG_GENDER" value="อื่นๆ" <?php if(isset($_GET['edit_profile'])&&$res['MNG_GENDER']=="อื่นๆ"){echo "checked";} ?>>อื่นๆ
			    </label>
			</div>
		</div>
		<?php if($_SESSION['status']=="MNG"){?>
		<div class="form-group">
			<?php if(isset($_GET['edit_profile'])){?>
			<div class="col-sm-12"><center>
				<button class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
			<?php } ?>
		</div>
		<?php } 
		if(isset($_GET['profile_stg'])){?>
			<div class="form-group">
			
			<div class="col-sm-12" style="color:#4c9e33"><center>
				<i class="fas fa-check-circle fa-3x"></i><br> บันทึกข้อมูลแล้ว
			</div>

		</div>
		<?php } ?>
	</form>
</div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_edit']) && $_POST['MNG_ID']!=''){
		$que_chk=oci_parse($conn,"select count(MNG_ID)as NUM from MANAGER_DORM where MNG_ID=:MNG_ID");
		oci_bind_by_name($que_chk, ':MNG_ID', $_POST['MNG_ID']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		$S_DATE=date("Y/m/d h:i:sa");
			$que=oci_parse($conn,"update MANAGER_DORM set MNG_NAME=:MNG_NAME,MNG_LNAME=:MNG_LNAME,MNG_TEL=:MNG_TEL,MNG_GENDER=:MNG_GENDER where MNG_ID=:MNG_ID");
			oci_bind_by_name($que, ':MNG_ID', $_POST['MNG_ID']);
			oci_bind_by_name($que, ':MNG_NAME', $_POST['MNG_NAME']);
			oci_bind_by_name($que, ':MNG_LNAME', $_POST['MNG_LNAME']);
			oci_bind_by_name($que, ':MNG_TEL', $_POST['MNG_TEL']);
			oci_bind_by_name($que, ':MNG_GENDER', $_POST['MNG_GENDER']);
			if(!$r=oci_execute($que)){echo "update error";}else{
				$_SESSION['name']= $_POST['MNG_NAME'].' '.$_POST['MNG_LNAME'];
				echo "<meta http-equiv='refresh' content='0;url=?edit_profile=".$_POST['MNG_ID']."&&profile_stg'>";
			}
			// 
		
	}
?>
<?php }
elseif((isset($_GET['edit_profile']) && $_SESSION['status']=="STAFF")) {
	$que=oci_parse($conn,"SELECT * FROM STAFF_DORM,MANAGER_DORM where STAFF_DORM.MNG_ID=MANAGER_DORM.MNG_ID AND S_ID=:edit_profile");
		oci_bind_by_name($que, ':edit_profile', $_GET['edit_profile']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>
<div class="col-sm-3"></div>
<div class="col-sm-6" style="margin-top:20px;">
	<form name="STAFF_DORM" class="form-horizontal box-content was-validated	" method="POST" action="">
		<!-- <?php if(isset($_GET['edit_profile'])){?>
			<a href="?S_DEL=<?php echo $res['S_ID'] ?>" style="margin-left:90%" class="btn btn_dan"><i class="fas fa-trash-alt"></i></a>
		<?php } ?> -->
		<div id="" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >รหัสประชาชน:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกรหัสประชาชน')" <?php if(isset($_GET['edit_profile']))echo "readonly";?>
    oninput="this.setCustomValidity('')" maxlength="13" rows="1" class="form-control" id="S_ID" name="S_ID" placeholder="รหัสประชาชน"><?php if(isset($_GET['edit_profile'])) echo $res['S_ID'];?></textarea>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ชื่อ:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกชื่อ')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="S_NAME" name="S_NAME" placeholder="ชื่อ"><?php if(isset($_GET['edit_profile'])) echo $res['S_NAME'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >นามสกุล:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกนามสกุล')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="S_LNAME" name="S_LNAME" placeholder="นามสกุล"><?php if(isset($_GET['edit_profile'])) echo $res['S_LNAME'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >เบอร์โทร:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกเบอร์โทร')"
    oninput="this.setCustomValidity('')" maxlength="10" rows="1" class="form-control" id="S_TEL" name="S_TEL" placeholder="เบอร์โทร"><?php if(isset($_GET['edit_profile'])) echo $res['S_TEL'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >เพศ:</label>
			<div class="col-sm-9">
				<label class="radio-inline">
			    	<input type="radio" name="S_GENDER" value="ชาย" checked <?php if(isset($_GET['edit_profile'])&&$res['S_GENDER']=="ชาย"){echo "checked";} ?>>ชาย
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="S_GENDER" value="หญิง" <?php if(isset($_GET['edit_profile'])&&$res['S_GENDER']=="หญิง"){echo "checked";} ?>>หญิง
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="S_GENDER" value="อื่นๆ" <?php if(isset($_GET['edit_profile'])&&$res['S_GENDER']=="อื่นๆ"){echo "checked";} ?>>อื่นๆ
			    </label>
			</div>
		</div>
	

		<?php if($_SESSION['status']=="STAFF"){?>
		<div class="form-group">
			<?php if(isset($_GET['edit_profile'])){?>
			<div class="col-sm-12"><center>
				<button class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
			<?php } ?>
		</div>
		<?php } 
		if(isset($_GET['profile_stg'])){?>
			<div class="form-group">
			
			<div class="col-sm-12" style="color:#4c9e33"><center>
				<i class="fas fa-check-circle fa-3x"></i><br> บันทึกข้อมูลแล้ว
			</div>

		</div>
		<?php } ?>
	</form>
</div>

<?php if(isset($_POST['btn_edit']) && $_POST['S_ID']!=''){
		$que_chk=oci_parse($conn,"select count(S_ID)as NUM from STAFF_DORM where S_ID=:S_ID");
		oci_bind_by_name($que_chk, ':S_ID', $_POST['S_ID']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		$S_DATE=date("Y/m/d h:i:sa");
			$que=oci_parse($conn,"update STAFF_DORM set S_NAME=:S_NAME,S_LNAME=:S_LNAME,S_TEL=:S_TEL,S_GENDER=:S_GENDER,S_STATUS=:S_STATUS where S_ID=:S_ID");
			oci_bind_by_name($que, ':S_ID', $_POST['S_ID']);
			oci_bind_by_name($que, ':S_NAME', $_POST['S_NAME']);
			oci_bind_by_name($que, ':S_LNAME', $_POST['S_LNAME']);
			oci_bind_by_name($que, ':S_TEL', $_POST['S_TEL']);
			oci_bind_by_name($que, ':S_GENDER', $_POST['S_GENDER']);
			oci_bind_by_name($que, ':S_STATUS', $_POST['S_STATUS']);
			if(!$r=oci_execute($que)){echo "update error";}else{
				$_SESSION['name']= $_POST['S_NAME'].' '.$_POST['S_LNAME'];
				echo "<meta http-equiv='refresh' content='0;url=?edit_profile=".$_POST['S_ID']."&&profile_stg'>";} 
		}
} 
?>


