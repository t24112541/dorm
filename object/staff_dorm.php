<?php if(isset($_GET['s_edit'])){
		$que=oci_parse($conn,"SELECT * FROM STAFF_DORM,MANAGER_DORM where STAFF_DORM.MNG_ID=MANAGER_DORM.MNG_ID AND S_ID=:s_edit");
		oci_bind_by_name($que, ':s_edit', $_GET['s_edit']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>
<?php } ?>
<div class="col-sm-4" style="margin-top:20px;">
	<form name="STAFF_DORM" class="form-horizontal box-content was-validated	" method="POST" action="">
		<!-- <?php if(isset($_GET['s_edit'])){?>
			<a href="?S_DEL=<?php echo $res['S_ID'] ?>" style="margin-left:90%" class="btn btn_dan"><i class="fas fa-trash-alt"></i></a>
		<?php } ?> -->
		<div id="" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >รหัสประชาชน:</label>
			<div class="col-sm-9">
				<textarea required readonly oninvalid="this.setCustomValidity('กรอกรหัสประชาชน')"
    oninput="this.setCustomValidity('')" maxlength="13" rows="1" class="form-control" id="S_ID" name="S_ID" placeholder="รหัสประชาชน"><?php if(isset($_GET['s_edit'])) echo $res['S_ID'];?></textarea>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ชื่อ:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกชื่อ')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="S_NAME" name="S_NAME" placeholder="ชื่อ"><?php if(isset($_GET['s_edit'])) echo $res['S_NAME'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >นามสกุล:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกนามสกุล')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="S_LNAME" name="S_LNAME" placeholder="นามสกุล"><?php if(isset($_GET['s_edit'])) echo $res['S_LNAME'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >เบอร์โทร:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกเบอร์โทร')"
    oninput="this.setCustomValidity('')" maxlength="10" rows="1" class="form-control" id="S_TEL" name="S_TEL" placeholder="เบอร์โทร"><?php if(isset($_GET['s_edit'])) echo $res['S_TEL'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >เพศ:</label>
			<div class="col-sm-9">
				<label class="radio-inline">
			    	<input type="radio" name="S_GENDER" value="ชาย" checked <?php if(isset($_GET['s_edit'])&&$res['S_GENDER']=="ชาย"){echo "checked";} ?>>ชาย
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="S_GENDER" value="หญิง" <?php if(isset($_GET['s_edit'])&&$res['S_GENDER']=="หญิง"){echo "checked";} ?>>หญิง
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="S_GENDER" value="อื่นๆ" <?php if(isset($_GET['s_edit'])&&$res['S_GENDER']=="อื่นๆ"){echo "checked";} ?>>อื่นๆ
			    </label>
			</div>
		</div>
		<?php if(isset($_GET['s_edit'])){?>
			<div class="form-group">
				<label class="control-label col-sm-3" >ผู้รับเข้าทำงาน:</label>
				<a class="cv_link" href="?mng_edit=<?php echo $res['MNG_ID']; ?>">
					<div class="col-sm-9">
						<label class="control-label col-sm-12" align="left"><?php if(isset($_GET['s_edit'])) echo $res['MNG_NAME'];?></label>
					</div>
				</a>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >วันที่รับเข้า:</label>
				<div class="col-sm-9">
					<label class="control-label col-sm-12" ><?php if(isset($_GET['s_edit'])) echo $res['S_DATE'];?></label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >สถานะ:</label>
				<div class="col-sm-9">
					<select required id="S_STATUS" name="S_STATUS" class="form-control" >
						<option value="จ้าง" <?php if($res['S_STATUS']=="จ้าง")echo "selected  hidden" ;?>> จ้าง</option>
						<option value="เลิกจ้าง" <?php if($res['S_STATUS']=="เลิกจ้าง")echo "selected  hidden" ;?>>เลิกจ้าง</option>
					</select>
				</div>
			</div>
		<?php } ?>
		<div class="form-group">
			<?php if(isset($_GET['s_edit'])){?>
			<div class="col-sm-6"><center>
				<button  onclick="chk_S_NAME()" class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
			<?php } ?>
			<div class="<?php if(isset($_GET['s_edit'])){ echo 'col-sm-6';}else{echo 'col-sm-12';}?>" ><center>
				<button  onclick="chk_S_NAME()" class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> เพิ่มพนักงาน</button> </a>
			</div>
		</div>
	</form>
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="col-sm-8 " style="margin-top:30px;"><center>
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, "SELECT * FROM STAFF_DORM,MANAGER_DORM where STAFF_DORM.MNG_ID=MANAGER_DORM.MNG_ID order by S_NAME asc");
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(S_ID)as NUM from STAFF_DORM,MANAGER_DORM where STAFF_DORM.MNG_ID=MANAGER_DORM.MNG_ID ");
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
						<td align="left"><?=$row['S_NAME'];?></td>
						<td align="left"><?=$row['S_LNAME'];?></td>
						<td align="left"><?=$row['S_TEL'];?></td>
						<td align="center"><a  href="?s_edit=<?=$row['S_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_add']) && $_POST['S_ID']!=''){
		$que_chk=oci_parse($conn,"select count(S_ID)as NUM from STAFF_DORM where S_ID=:S_ID");
		oci_bind_by_name($que_chk, ':S_ID', $_POST['S_ID']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$S_DATE=date("d/m/Y h:i:sa");
			$que=oci_parse($conn,"insert into STAFF_DORM (S_ID,S_NAME,S_LNAME,S_TEL,S_GENDER,MNG_ID,S_DATE,S_STATUS) values (:S_ID,:S_NAME,:S_LNAME,:S_TEL,:S_GENDER,:MNG_ID,:S_DATE,'จ้าง')");
			oci_bind_by_name($que, ':S_ID', $_POST['S_ID']);
			oci_bind_by_name($que, ':S_NAME', $_POST['S_NAME']);
			oci_bind_by_name($que, ':S_LNAME', $_POST['S_LNAME']);
			oci_bind_by_name($que, ':S_TEL', $_POST['S_TEL']);
			oci_bind_by_name($que, ':S_GENDER', $_POST['S_GENDER']);
			oci_bind_by_name($que, ':MNG_ID', $_SESSION['id']);
			oci_bind_by_name($que, ':S_DATE', $S_DATE);
			// oci_bind_by_name($que, ':S_STATUS', "จ้าง");
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?staff_dorm'>";}
		}else{ ?>
			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
			</script>
		<?php }
	}elseif(isset($_POST['btn_edit']) && $_POST['S_ID']!=''){
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
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?s_edit=".$_POST['S_ID']."'>";}
			// 
		
	}elseif(isset($_GET['S_DEL'])){}
?>



