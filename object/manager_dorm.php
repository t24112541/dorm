<?php if(isset($_GET['mng_edit'])){
		$que=oci_parse($conn,"SELECT * FROM MANAGER_DORM where MNG_ID=:mng_edit");
		oci_bind_by_name($que, ':mng_edit', $_GET['mng_edit']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>
<?php } ?>
<div class="col-sm-4" style="margin-top:20px;">
	<form name="MANAGER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
		<!-- <?php if(isset($_GET['mng_edit'])){?>
			<a href="?S_DEL=<?php echo $res['MNG_ID'] ?>" style="margin-left:90%" class="btn btn_dan"><i class="fas fa-trash-alt"></i></a>
		<?php } ?> -->
		<div id="" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >รหัสประชาชน:</label>
			<div class="col-sm-9">
				<textarea required readonly  oninvalid="this.setCustomValidity('กรอกรหัสประชาชน')"
    oninput="this.setCustomValidity('')" maxlength="13" rows="1" class="form-control" id="MNG_ID" name="MNG_ID" placeholder="รหัสประชาชน"><?php if(isset($_GET['mng_edit'])) echo $res['MNG_ID'];?></textarea>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ชื่อ:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกชื่อ')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="MNG_NAME" name="MNG_NAME" placeholder="ชื่อ"><?php if(isset($_GET['mng_edit'])) echo $res['MNG_NAME'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >นามสกุล:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกนามสกุล')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="MNG_LNAME" name="MNG_LNAME" placeholder="นามสกุล"><?php if(isset($_GET['mng_edit'])) echo $res['MNG_LNAME'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >เบอร์โทร:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกเบอร์โทร')"
    oninput="this.setCustomValidity('')" maxlength="10" rows="1" class="form-control" id="MNG_TEL" name="MNG_TEL" placeholder="เบอร์โทร"><?php if(isset($_GET['mng_edit'])) echo $res['MNG_TEL'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >เพศ:</label>
			<div class="col-sm-9">
				<label class="radio-inline">
			    	<input type="radio" name="MNG_GENDER" value="ชาย" checked <?php if(isset($_GET['mng_edit'])&&$res['MNG_GENDER']=="ชาย"){echo "checked";} ?>>ชาย
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="MNG_GENDER" value="หญิง" <?php if(isset($_GET['mng_edit'])&&$res['MNG_GENDER']=="หญิง"){echo "checked";} ?>>หญิง
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="MNG_GENDER" value="อื่นๆ" <?php if(isset($_GET['mng_edit'])&&$res['MNG_GENDER']=="อื่นๆ"){echo "checked";} ?>>อื่นๆ
			    </label>
			</div>
		</div>

		<div class="form-group">
			<?php if(isset($_GET['mng_edit'])){?>
			<div class="col-sm-6"><center>
				<button class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
			<?php } ?>
			<div class="<?php if(isset($_GET['mng_edit'])){ echo 'col-sm-6';}else{echo 'col-sm-12';}?>" ><center>
				<button class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> เพิ่มผู้จัดการ</button> </a>
			</div>
		</div>
	</form>
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="col-sm-8 " style="margin-top:30px;"><center>
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, "SELECT * FROM MANAGER_DORM  order by MNG_NAME asc");
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(MNG_ID)as NUM from MANAGER_DORM ");
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<td align="left">ชื่อ</td>
					<td align="left">นามสกุล</td>
					<td align="left">เบอรโทร</td>				
				</tr>
			</thead>
			<tbody>
		<?php
		if($res['NUM']==0){?>
			<tr>
				<td colspan="4">ไม่พบข้อมูล</td>
			</tr>    
		<?php }
		else{
			while (($row = oci_fetch_array($que, OCI_ASSOC))) {?>
				
					<tr>
						<td align="left"><?=$row['MNG_NAME'];?></td>
						<td align="left"><?=$row['MNG_LNAME'];?></td>
						<td align="left"><?=$row['MNG_TEL'];?></td>
						<td align="center"><a  href="?mng_edit=<?=$row['MNG_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_add']) && $_POST['MNG_ID']!=''){
		$que_chk=oci_parse($conn,"select count(MNG_ID)as NUM from MANAGER_DORM where MNG_ID=:MNG_ID");
		oci_bind_by_name($que_chk, ':MNG_ID', $_POST['MNG_ID']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$S_DATE=date("d/m/Y h:i:sa");
			$que=oci_parse($conn,"insert into MANAGER_DORM (MNG_ID,MNG_NAME,MNG_LNAME,MNG_TEL,MNG_GENDER) values (:MNG_ID,:MNG_NAME,:MNG_LNAME,:MNG_TEL,:MNG_GENDER)");
			oci_bind_by_name($que, ':MNG_ID', $_POST['MNG_ID']);
			oci_bind_by_name($que, ':MNG_NAME', $_POST['MNG_NAME']);
			oci_bind_by_name($que, ':MNG_LNAME', $_POST['MNG_LNAME']);
			oci_bind_by_name($que, ':MNG_TEL', $_POST['MNG_TEL']);
			oci_bind_by_name($que, ':MNG_GENDER', $_POST['MNG_GENDER']);
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?mng_edit=".$_POST['MNG_ID']."'>";}
		}else{ ?>
			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
			</script>
		<?php }
	}elseif(isset($_POST['btn_edit']) && $_POST['MNG_ID']!=''){
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
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?mng_edit=".$_POST['MNG_ID']."'>";}
			// 
		
	}elseif(isset($_GET['S_DEL'])){}
?>



