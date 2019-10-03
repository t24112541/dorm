<?php if(isset($_GET['u_edit'])){
		$que=oci_parse($conn,"SELECT * FROM USER_DORM,USER_DORM_DETAIL where USER_DORM.U_ID=USER_DORM_DETAIL.U_ID AND USER_DORM.U_ID=:u_edit");
		oci_bind_by_name($que, ':u_edit', $_GET['u_edit']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);

		$que_chk=oci_parse($conn,"select count(U_ID) as NUM from HIRE_USER_DETAIL where U_ID=:u_edit");
		oci_bind_by_name($que_chk, ':u_edit', $_GET['u_edit']);
		$r_chk=oci_execute($que_chk);
		$res_chk=oci_fetch_array($que_chk);
		if($res_chk['NUM']>0){
			$que_room=oci_parse($conn,"select * from ROOM_DORM,BUILDING_DORM,ROOM_TYPE,HIRE_USER_DETAIL,HIRE_USER where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID AND HIRE_USER.R_ID=ROOM_DORM.R_ID AND HIRE_USER.HU_ID=HIRE_USER_DETAIL.HU_ID AND HIRE_USER_DETAIL.U_ID=:u_edit");
			oci_bind_by_name($que_room, ':u_edit', $_GET['u_edit']);
			$r_room=oci_execute($que_room);
			$res_room=oci_fetch_array($que_room);
		}
?>
<?php } ?>
<div class="col-sm-4" style="margin-top:20px;">
	<form name="USER_DORM" class="form-horizontal box-content was-validated" method="POST" action="" enctype="multipart/form-data">
		<!-- <?php if(isset($_GET['u_edit'])){?>
			<a href="?S_DEL=<?php echo $res['U_ID'] ?>" style="margin-left:90%" class="btn btn_dan"><i class="fas fa-trash-alt"></i></a>
		<?php } ?> -->
		<div id="" class="form-group" >
			<?php if(isset($_GET['u_edit'])){?>
				<div class="col-sm-12">
					<center><img src="<?php echo $res['U_IMG'];?>" style="width:40%">
						<input type="hidden" name="old_U_IMG" value="<?php echo $res['U_IMG'];?>">
				</div> 
			<?php }?>
			<div class="col-sm-12">
				<center>เลือกรูป</center>
			</div>
			<div class="col-sm-12">
				<center><input type="file" placeholder="เลือกรูป" name="U_IMG" class="img-responsive"></center>
			</div>
		</div>
		<div id="" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >รหัสประชาชน:</label>
			<div class="col-sm-9">
				<textarea required  <?php if(isset($_GET['u_edit'])) echo "readonly";?> oninvalid="this.setCustomValidity('กรอกรหัสประชาชน')"
    oninput="this.setCustomValidity('')" maxlength="13" rows="1" class="form-control" id="U_ID" name="U_ID" placeholder="รหัสประชาชน"><?php if(isset($_GET['u_edit'])) echo $res['U_ID'];?></textarea>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ชื่อ:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกชื่อ')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="U_NAME" name="U_NAME" placeholder="ชื่อ"><?php if(isset($_GET['u_edit'])) echo $res['U_NAME'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >นามสกุล:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกนามสกุล')"
    oninput="this.setCustomValidity('')" rows="1" class="form-control" id="U_LNAME" name="U_LNAME" placeholder="นามสกุล"><?php if(isset($_GET['u_edit'])) echo $res['U_LNAME'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >เบอร์โทร:</label>
			<div class="col-sm-9">
				<textarea required  oninvalid="this.setCustomValidity('กรอกเบอร์โทร')"
    oninput="this.setCustomValidity('')" maxlength="10" rows="1" class="form-control" id="U_TEL" name="U_TEL" placeholder="เบอร์โทร"><?php if(isset($_GET['u_edit'])) echo $res['U_TEL'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >เพศ:</label>
			<div class="col-sm-9">
				<label class="radio-inline">
			    	<input type="radio" name="U_GENDER" value="ชาย" checked <?php if(isset($_GET['u_edit'])&&$res['U_GENDER']=="ชาย"){echo "checked";} ?>>ชาย
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="U_GENDER" value="หญิง" <?php if(isset($_GET['u_edit'])&&$res['U_GENDER']=="หญิง"){echo "checked";} ?>>หญิง
			    </label>
			    <label class="radio-inline">
			    	<input type="radio" name="U_GENDER" value="อื่นๆ" <?php if(isset($_GET['u_edit'])&&$res['U_GENDER']=="อื่นๆ"){echo "checked";} ?>>อื่นๆ
			    </label>
			</div>
		</div>
		<?php 	if(isset($_GET['u_edit'])){
					$que_s_id=oci_parse($conn,"select count(MNG_ID) as MNG_ID from MANAGER_DORM where MNG_ID=:ID");
					oci_bind_by_name($que_s_id,':ID',$res['S_ID']);
					$r_s_id=oci_execute($que_s_id);
					$res_s_id=oci_fetch_array($que_s_id);
					if($res_s_id['MNG_ID']>0){
						$que_s_id=oci_parse($conn,"select * from MANAGER_DORM where MNG_ID=:ID");
						oci_bind_by_name($que_s_id,':ID',$res['S_ID']);
						$r_s_id=oci_execute($que_s_id);
						$res_s_id=oci_fetch_array($que_s_id);
						$s_name=$res_s_id['MNG_NAME'];
						$s_id=$res_s_id['MNG_ID'];
						$s_link='?mng_edit='.$s_id;
					}else{
						$que_s_id=oci_parse($conn,"select count(S_ID) as S_ID from STAFF_DORM where S_ID=:ID");
						oci_bind_by_name($que_s_id,':ID',$res['S_ID']);
						$r_s_id=oci_execute($que_s_id);
						$res_s_id=oci_fetch_array($que_s_id);
						if($res_s_id['S_ID']>0){
							$que_s_id=oci_parse($conn,"select * from STAFF_DORM where S_ID=:ID");
							oci_bind_by_name($que_s_id,':ID',$res['S_ID']);
							$r_s_id=oci_execute($que_s_id);
							$res_s_id=oci_fetch_array($que_s_id);
							$s_name=$res_s_id['S_NAME'];
							$s_id=$res_s_id['S_ID'];
							$s_link='?s_edit='.$s_id;
						}
					}
			?>
			<div class="form-group">
				<label class="control-label col-sm-3" >ผู้รับเข้า:</label>
				<a class="cv_link" href="<?php echo $s_link; ?>">
					<div class="col-sm-9">
						<p style="margin-top:5px;"><?php echo $s_name; ?></p>
					</div>
				</a>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >วันที่เข้า:</label>
				<div class="col-sm-9">
					<p style="margin-top:5px;"><?php if(isset($_GET['u_edit'])) echo $res['UD_DATE'];?></p>
				</div>
			</div>
			<?php if($res_chk['NUM']>0){?>
			<div class="form-group">
				<label class="control-label col-sm-3" >ห้อง:</label>
				<div class="col-sm-9">
					<p style="margin-top:5px;"><?php if(isset($_GET['u_edit'])){echo $res_room['R_NAME'];}?></p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >ประเภท:</label>
				<div class="col-sm-9">
					<p style="margin-top:5px;"><?php if(isset($_GET['u_edit'])){echo $res_room['RT_NAME'];}?></p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >อาคาร:</label>
				<div class="col-sm-9">
					<p style="margin-top:5px;"><?php if(isset($_GET['u_edit'])){echo $res_room['B_NAME'];}?></p>
				</div>
			</div>
		<?php } }?>
		<div class="form-group">
			<?php if(isset($_GET['u_edit'])){?>
				<div class="col-sm-6"><center>
					<button class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> 
				</div>
			<?php if($res_chk['NUM']>0){?>
				<div class="col-sm-6"><center>
					<a href="?r_edit=<?php echo $res_room['R_ID']?>" class="btn btn-default" ><i class="fas fa-concierge-bell fa-1x"></i> ดูห้อง</a> 
				</div>
			<?php } else {?>
				<div class="col-sm-6"><center>
					<a href="?room_dorm" class="btn btn-default" ><i class="fas fa-concierge-bell fa-1x"></i> ดูห้องทั้งหมด</a> 
				</div>
			<?php } ?>
			<div class="col-sm-6">
				<a class="btn " style="margin-left:70%;margin-top:20px" href="?user_dorm"><i class="fas fa-arrow-circle-left fa-1x"></i> ห้อง</a> </a>
			</div>
			<?php  } else{ ?>
			<div class="<?php if(isset($_GET['mng_edit'])){ echo 'col-sm-6';}else{echo 'col-sm-12';}?>" ><center>
				<button class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> เพิ่มข้อมูล</button> </a>
			</div>
			<?php } ?>
		</div>
		<?php if(isset($_GET['add_stg'])){?>
		<div class="form-group" id="noti">
			<input type="hidden" name="add_stg" value="<?php echo $_GET['add_stg']?>">
			<div class="alert alert-success alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>บันทึกข้อมูลสำเร็จ!</strong>
			</div>
		</div>
		<?php }?>
	</form>
</div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class=" <?php if(isset($_GET['u_edit'])){echo 'col-sm-8';}else{echo 'col-sm-8';}?>" style="margin-top:30px;">
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, "SELECT * FROM USER_DORM,USER_DORM_DETAIL where USER_DORM.U_ID=USER_DORM_DETAIL.U_ID  order by U_NAME asc");
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(USER_DORM.U_ID) as NUM from USER_DORM,USER_DORM_DETAIL where USER_DORM.U_ID=USER_DORM_DETAIL.U_ID ");
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
				<td colspan="4" align="center">ไม่พบข้อมูล</td>
			</tr>    
		<?php }
		else{
			while (($row = oci_fetch_array($que, OCI_ASSOC))) {?>
				
					<tr>
						<td align="left"><?=$row['U_NAME'];?></td>
						<td align="left"><?=$row['U_LNAME'];?></td>
						<td align="left"><?=$row['U_TEL'];?></td>
						<td align="center"><a  href="?u_edit=<?=$row['U_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_add']) && $_POST['U_ID']!=''){
		$que_chk=oci_parse($conn,"select count(U_ID)as NUM from USER_DORM where U_ID=:U_ID");
		oci_bind_by_name($que_chk, ':U_ID', $_POST['U_ID']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$S_DATE=date("d/m/Y h:i:sa");
			if(isset($_FILES['U_IMG']) && $_FILES['name']!=" "){
				$target_path = "./img/user/";  
				$target_path = $target_path.basename( $_FILES['U_IMG']['name']);   
				move_uploaded_file($_FILES['U_IMG']['tmp_name'], $target_path);
				echo "1";
			}else{echo "2";
				$target_path="./img/user/user.PNG";;
			}
						 
			    $que=oci_parse($conn,"insert into USER_DORM (U_ID,U_NAME,U_LNAME,U_TEL,U_GENDER,U_IMG) values (:U_ID,:U_NAME,:U_LNAME,:U_TEL,:U_GENDER,:U_IMG)");
				oci_bind_by_name($que, ':U_ID', $_POST['U_ID']);
				oci_bind_by_name($que, ':U_NAME', $_POST['U_NAME']);
				oci_bind_by_name($que, ':U_LNAME', $_POST['U_LNAME']);
				oci_bind_by_name($que, ':U_TEL', $_POST['U_TEL']);
				oci_bind_by_name($que, ':U_GENDER', $_POST['U_GENDER']);
				oci_bind_by_name($que, ':U_IMG', $target_path);
				if(!$r=oci_execute($que)){$err=oci_error(); echo "<center style='color:#ac3115;'>".$err['message']."</center>";}else{
					$que_ud=oci_parse($conn,"insert into USER_DORM_DETAIL (UD_DATE,S_ID,U_ID) values (:UD_DATE,:S_ID,:U_ID)");
					oci_bind_by_name($que_ud, ':UD_DATE', $S_DATE);
					oci_bind_by_name($que_ud, ':S_ID', $_SESSION['id']);
					oci_bind_by_name($que_ud, ':U_ID', $_POST['U_ID']);
					if(!$r=oci_execute($que_ud)){$err=oci_error(); echo "<center style='color:#ac3115;'>".$err['message']."</center>";}else{
						echo "<meta http-equiv='refresh' content='0;url=?u_edit=".$_POST['U_ID']."'>";
					}
				}			
		}else{ ?>
			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
			</script>
		<?php }
	}elseif(isset($_POST['btn_edit']) && $_POST['U_ID']!=''){
		
			
			if(isset($_FILES['U_IMG']) && $_FILES['name']!=" "){
				$target_path = "./img/user/";  
				$target_path = $target_path.basename( $_FILES['U_IMG']['name']);   
				move_uploaded_file($_FILES['U_IMG']['tmp_name'], $target_path);
				echo "1";
			}else{echo "2";
				$target_path=$_POST['old_U_IMG'];
			}

		$que_chk=oci_parse($conn,"select count(U_ID)as NUM from USER_DORM where U_ID=:U_ID");
		oci_bind_by_name($que_chk, ':U_ID', $_POST['U_ID']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		$S_DATE=date("Y/m/d h:i:sa");
			$que=oci_parse($conn,"update USER_DORM set U_IMG=:U_IMG,U_NAME=:U_NAME,U_LNAME=:U_LNAME,U_TEL=:U_TEL,U_GENDER=:U_GENDER where U_ID=:U_ID");
			oci_bind_by_name($que, ':U_ID', $_POST['U_ID']);
			oci_bind_by_name($que, ':U_NAME', $_POST['U_NAME']);
			oci_bind_by_name($que, ':U_LNAME', $_POST['U_LNAME']);
			oci_bind_by_name($que, ':U_TEL', $_POST['U_TEL']);
			oci_bind_by_name($que, ':U_GENDER', $_POST['U_GENDER']);
			oci_bind_by_name($que, ':U_IMG', $target_path);
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?u_edit=".$_POST['U_ID']."'>";}
			
		
	}elseif(isset($_GET['S_DEL'])){}
?>



