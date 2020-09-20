<?php if(isset($_GET['hire'])){ 
		$que=oci_parse($conn,"SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID AND R_ID=:hire");
		oci_bind_by_name($que, ':hire', $_GET['hire']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);?>

<div class="col-sm-6" style="margin-top:20px;">
	<form name="room_dorm" class="form-horizontal box-content was-validated	" method="POST" action="">
		<div id="div_R_NAME" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >ห้อง:</label>
			<div class="col-sm-9">
				<input type="hidden" name="R_ID" value=<?=$_GET['hire']?>>
				<textarea required readonly  oninvalid="this.setCustomValidity('กรอกชื่อห้อง')"
	    oninput="this.setCustomValidity('')" rows="2" class="form-control" id="R_NAME" name="R_NAME" placeholder="ชื่อห้อง"><?php echo $res['R_NAME'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ราคา:</label>
			<div class="col-sm-9">
				<input type="number" required readonly  oninvalid="this.setCustomValidity('กรอกราคา/เดือน')"
    oninput="this.setCustomValidity('')" class="form-control" id="R_PRICE" name="R_PRICE" placeholder="ราคา" value="<?php echo $res['R_PRICE'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ประเภทห้อง:</label>
			<div class="col-sm-9">
				<select id="RT_ID" name="RT_ID" class="form-control" id="sel1" readonly>
					<option value="<?php echo $res['RT_ID'];?>"><?php echo $res['RT_NAME'];?></option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >อาคาร:</label>
			<div class="col-sm-9">
				<select id="B_ID" name="B_ID" class="form-control" id="sel1" readonly>
					<option value="<?php echo $res['B_ID'];?>"><?php echo $res['B_NAME'];?></option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ผู้เช่า:</label>
			<div class="col-sm-9">
				<select id="U_ID" name="U_ID" required class="form-control" id="sel1">
					<option value=" " selected >โปรดเลือกผู้เช่า</option>
					<?php 
						$que_b = oci_parse($conn, "SELECT * FROM USER_DORM");
						$r_b = oci_execute($que_b);
						while (($row_b = oci_fetch_array($que_b, OCI_ASSOC))) {?>
							<option value="<?php echo $row_b['U_ID'];?>"><?php echo $row_b['U_NAME'].' '.$row_b['U_LNAME'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12"><center>
				<button class="btn btn-ok" onclick="chk()" name="btn_hire"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
		</div>
	</form>
</div>
<?php }
if(isset($_POST['btn_hire']) && $_POST['U_ID']!=""){
			$S_DATE=date("d/m/Y h:i:sa");
			$que=oci_parse($conn,"insert into HIRE_USER (S_ID,R_ID) values (:S_ID,:R_ID) RETURNING HU_ID INTO :return_val");
			oci_bind_by_name($que, ':R_ID', $_POST['R_ID']);
			oci_bind_by_name($que, ':S_ID', $_SESSION['id']);
			oci_bind_by_name($que, ":return_val", $val, 18);
			if(!$r=oci_execute($que)){$err=oci_error(); echo "<center style='color:#ac3115;'>".$err['message']."</center>";}
			else{
				// echo $val;
				$HUD_STATUS="in";
				$R_STATUS="ไม่ว่าง";
				$que_ud=oci_parse($conn,"insert into HIRE_USER_DETAIL (HUD_DATE,HUD_STATUS,U_ID,HU_ID) values (:HUD_DATE,:HUD_STATUS,:U_ID,:HU_ID)");
				oci_bind_by_name($que_ud, ':HUD_DATE', $S_DATE);
				oci_bind_by_name($que_ud, ':HUD_STATUS', $HUD_STATUS);
				oci_bind_by_name($que_ud, ':U_ID', $_POST['U_ID']);
				oci_bind_by_name($que_ud, ':HU_ID', $val);
				if(!$r=oci_execute($que_ud)){$err=oci_error(); echo "<center style='color:#ac3115;'>".$err['message']."</center>";}else{
					$que_R=oci_parse($conn,"update ROOM_DORM set R_STATUS=:R_STATUS where R_ID=:R_ID");
					oci_bind_by_name($que_R, ':R_STATUS', $R_STATUS);
					oci_bind_by_name($que_R, ':R_ID', $_POST['R_ID']);
					if(!$r=oci_execute($que_R)){$err=oci_error(); echo "<center style='color:#ac3115;'>".$err['message']."</center>";}else{
						echo "<meta http-equiv='refresh' content='0;url=?HU_EDIT=".$val."'>";
					}
				}
			}
		
}?>
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['HU_EDIT'])){
		$que=oci_parse($conn,"SELECT * FROM HIRE_USER,HIRE_USER_DETAIL,ROOM_DORM,ROOM_TYPE,BUILDING_DORM,USER_DORM where HIRE_USER.R_ID=ROOM_DORM.R_ID AND ROOM_TYPE.RT_ID=ROOM_DORM.RT_ID AND BUILDING_DORM.B_ID=ROOM_DORM.B_ID AND HIRE_USER_DETAIL.HU_ID=HIRE_USER.HU_ID AND HIRE_USER_DETAIL.U_ID=USER_DORM.U_ID AND  HIRE_USER.HU_ID=:HU_EDIT");
		oci_bind_by_name($que, ':HU_EDIT', $_GET['HU_EDIT']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>

<div class="col-sm-6" style="margin-top:20px;">
	<form name="USER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
		<input type="hidden" name="HU_ID" value=<?=$_GET['HU_EDIT']?>>
		<input type="hidden" name="HUD_ID" value=<?=$res['HUD_ID']?>>
		<input type="hidden" name="R_ID" value=<?=$res['R_ID']?>>
		<div id="" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >ห้อง:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['HU_EDIT'])) echo $res['R_NAME'];?>				
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ประเภท:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['HU_EDIT'])) echo $res['B_LOCATION'];?>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >อาคาร:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['HU_EDIT'])) echo $res['B_NAME'];?>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ที่ตั้ง:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['HU_EDIT'])) echo $res['B_LOCATION'];?>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ผู้เช่า:</label>
			<div class="col-sm-9">
				<a href="?u_edit=<?php echo $res['U_ID']; ?>"><?php if(isset($_GET['HU_EDIT'])) echo $res['U_NAME']." ".$res['U_LNAME'];?></a>
			</div>
		</div>
		<div id="" class="form-group" >
			<label class="control-label col-sm-3" >ติดต่อ:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['HU_EDIT'])) echo $res['U_TEL'];?>
			</div>
		</div>
		<?php 	if(isset($_GET['HU_EDIT'])){
					$que_s_id=oci_parse($conn,"select count(MNG_ID) as MNG_ID from MANAGER_DORM where MNG_ID=:ID");
					oci_bind_by_name($que_s_id,':ID',$res['S_ID']);
					$r_s_id=oci_execute($que_s_id);
					$res_s_id=oci_fetch_array($que_s_id);
					if($res_s_id['MNG_ID']>0){
						$que_s_id=oci_parse($conn,"select * from MANAGER_DORM where MNG_ID=:ID");
						oci_bind_by_name($que_s_id,':ID',$res['S_ID']);
						$r_s_id=oci_execute($que_s_id);
						$res_s_id=oci_fetch_array($que_s_id);
						$s_name=$res_s_id['MNG_NAME'].' '.$res_s_id['MNG_LNAME'];
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
							$s_name=$res_s_id['S_NAME'].' '.$res_s_id['S_LNAME'];
							$s_id=$res_s_id['S_ID'];
							$s_link='?s_edit='.$s_id;
						}
					}
			?>
			<div class="form-group">
				<label class="control-label col-sm-3" >ผู้ดูแล:</label>
					<div class="col-sm-9">
						<a class="" href="<?php echo $s_link; ?>"><?php echo $s_name; ?></a>
					</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >วันที่เข้า:</label>
				<div class="col-sm-9">
					<p style="margin-top:5px"><?php if(isset($_GET['HU_EDIT'])) echo $res['HUD_DATE'];?></p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3" >สถานะห้อง:</label>
				<div class="col-sm-9">
					<label class="radio-inline">
			    		<input type="radio" name="HUD_STATUS" value="in" <?php if(isset($_GET['HU_EDIT'])&&$res['HUD_STATUS']=="in"){echo "checked";} ?>>เช่า
				    </label>
				    <label class="radio-inline">
				    	<input type="radio" name="HUD_STATUS" value="out" <?php if(isset($_GET['HU_EDIT'])&&$res['HUD_STATUS']=="out"){echo "checked";} ?>>เลิกเช่า
				    </label>
				</div>
			</div>
		<?php } ?>
		<div class="form-group">
			<?php if(isset($_GET['HU_EDIT'])){?>
			<div class="col-sm-12"><center>
				<button class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
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
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class=" <?php if(isset($_GET['HU_EDIT']) || isset($_GET['hire'])){echo 'col-sm-5';}else{echo 'col-sm-12';}?>" style="margin-top:30px;">
	<div class="box-content">
		<form method="GET">
			<div class="input-group">
				    <input type="text" class="form-control" name="txt_search" placeholder="หาชื่อห้องสิไอเวร">
				    <div class="input-group-btn">
				      <button class="btn btn-default" type="submit" name="btn_search">
				        <i class="glyphicon glyphicon-search" style="padding:3px"></i>
				      </button>
				    </div>
			</div>
		</form>


<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if(isset($_GET['btn_search']) && $_GET['txt_search']!=" "){
			$que = oci_parse($conn,"SELECT * FROM HIRE_USER,HIRE_USER_DETAIL,ROOM_DORM,ROOM_TYPE,BUILDING_DORM,USER_DORM where HIRE_USER.R_ID=ROOM_DORM.R_ID AND ROOM_TYPE.RT_ID=ROOM_DORM.RT_ID AND BUILDING_DORM.B_ID=ROOM_DORM.B_ID AND HIRE_USER_DETAIL.HU_ID=HIRE_USER.HU_ID AND HIRE_USER_DETAIL.U_ID=USER_DORM.U_ID AND  ROOM_DORM.R_NAME LIKE '%".$_GET['txt_search']."%' order by HIRE_USER_DETAIL.HUD_STATUS asc");
			// oci_bind_by_name($que, ':txt_search', $_GET['txt_search']);// BUILDING_DORM.B_NAME LIKE '%".$_GET['txt_search']."%' OR
			// echo "1";
		}else{
			$que=oci_parse($conn,"SELECT * FROM HIRE_USER,HIRE_USER_DETAIL,ROOM_DORM,ROOM_TYPE,BUILDING_DORM,USER_DORM where HIRE_USER.R_ID=ROOM_DORM.R_ID AND ROOM_TYPE.RT_ID=ROOM_DORM.RT_ID AND BUILDING_DORM.B_ID=ROOM_DORM.B_ID AND HIRE_USER_DETAIL.HU_ID=HIRE_USER.HU_ID AND HIRE_USER_DETAIL.U_ID=USER_DORM.U_ID order by HIRE_USER_DETAIL.HUD_STATUS asc");
			// echo "2";
		}
		
		
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(HIRE_USER.HU_ID) as NUM from HIRE_USER,HIRE_USER_DETAIL,ROOM_DORM,ROOM_TYPE,BUILDING_DORM,USER_DORM where HIRE_USER.R_ID=ROOM_DORM.R_ID AND ROOM_TYPE.RT_ID=ROOM_DORM.RT_ID AND BUILDING_DORM.B_ID=ROOM_DORM.B_ID AND HIRE_USER_DETAIL.HU_ID=HIRE_USER.HU_ID AND HIRE_USER_DETAIL.U_ID=USER_DORM.U_ID");
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<td align="left">สถานะ</td>
					<td align="left">อาคาร</td>
					<td align="left">ห้อง</td>
					<td align="left">ชื่อ</td>
					<td align="left">เบอร์โทร</td>				
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
						
						<td align="left"><?php if($row['HUD_STATUS']=="in"){echo "เช่า";}else{echo "เลิกเช่า";} ?></td>
						<td align="left"><?=$row['B_NAME'];?></td>
						<td align="left"><?=$row['R_NAME'];?></td>
						<td align="left"><?=$row['U_NAME'];?></td>
						<td align="left"><?=$row['U_TEL'];?></td>
						<td align="center"><a  href="?HU_EDIT=<?=$row['HU_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_edit']) && $_POST['HUD_ID']!=''){
			$que=oci_parse($conn,"update HIRE_USER_DETAIL set HUD_STATUS=:HUD_STATUS where HUD_ID=:HUD_ID");
			oci_bind_by_name($que, ':HUD_ID', $_POST['HUD_ID']);
			oci_bind_by_name($que, ':HUD_STATUS', $_POST['HUD_STATUS']);
			if(!$r=oci_execute($que)){echo "update error";}else{
				if($_POST['HUD_STATUS']=="out"){$R_STATUS="ว่าง";}
				else{$R_STATUS="ไม่ว่าง";}
				$que_R=oci_parse($conn,"update ROOM_DORM set R_STATUS=:R_STATUS where R_ID=:R_ID");
				oci_bind_by_name($que_R, ':R_STATUS', $R_STATUS);
				oci_bind_by_name($que_R, ':R_ID', $_POST['R_ID']);
				if(!$r=oci_execute($que_R)){$err=oci_error(); echo "<center style='color:#ac3115;'>".$err['message']."</center>";}else{
					echo "<meta http-equiv='refresh' content='0;url=?HU_EDIT=".$_POST['HU_ID']."'>";
				}
			}
			// 
		
	}
?>
<script type="text/javascript">
	function chk() {
		var U_ID=document.getElementById("U_ID").value
		if(U_ID==""){
			document.getElementById("war").innerHTML="โปรดเลือกผู้เช่า";
			return false;
		}else{return true;}
		
	}
</script>



