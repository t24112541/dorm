<div class="col-sm-4" style="margin-top:20px;">
	<form name="room_dorm" class="form-horizontal box-content was-validated	" method="POST" action="">
		<div id="div_R_NAME" class="form-group" >
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >ห้อง:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['r_edit'])){
					$que=oci_parse($conn,"SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID AND R_ID=:r_edit");
					oci_bind_by_name($que, ':r_edit', $_GET['r_edit']);
					$r=oci_execute($que);
					$res=oci_fetch_array($que);
					// var_dump($res);
					// echo $res['R_NAME'];
					?>
					<input type="hidden" name="R_ID" value=<?=$_GET['r_edit']?>>
				<?php } ?>
				<textarea required  oninvalid="this.setCustomValidity('กรอกชื่อห้อง')"
    oninput="this.setCustomValidity('')" rows="2" class="form-control" id="R_NAME" name="R_NAME" placeholder="ชื่อห้อง"><?php if(isset($_GET['r_edit'])) echo $res['R_NAME'];?></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >ราคา:</label>
			<div class="col-sm-9">
				<input type="number" required  oninvalid="this.setCustomValidity('กรอกราคา/เดือน')"
    oninput="this.setCustomValidity('')" class="form-control" id="R_PRICE" name="R_PRICE" placeholder="ราคา" value="<?php if(isset($_GET['r_edit'])) echo $res['R_PRICE'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >สถานะห้อง:</label>
			<div class="col-sm-9">
				<select required id="R_STATUS" name="R_STATUS" class="form-control" id="sel1">
					<option value="ว่าง" <?php if(isset($_GET['r_edit'])){if($res['R_STATUS']=="ว่าง")echo "selected  hidden" ;}?>>ว่าง</option>
					<option value="ไม่ว่าง" <?php if(isset($_GET['r_edit'])){if($res['R_STATUS']=="ไม่ว่าง")echo "selected  hidden" ;}?>>ไม่ว่าง</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ประเภทห้อง:</label>
			<div class="col-sm-9">
				<select id="RT_ID" name="RT_ID" class="form-control" id="sel1">
					<?php 
						$que_rt = oci_parse($conn, "SELECT * FROM room_type");
						$r_rt = oci_execute($que_rt);
						while (($row_rt = oci_fetch_array($que_rt, OCI_ASSOC))) {?>
							<option value="<?php echo $row_rt['RT_ID'];?>" 
								<?php if(isset($_GET['r_edit'])){
									if($row_rt['RT_ID']==$res['RT_ID'])echo "selected hidden" ;
									}?>
							 ><?php echo $row_rt['RT_NAME'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >อาคาร:</label>
			<div class="col-sm-9">
				<select id="B_ID" name="B_ID" class="form-control" id="sel1">
					<?php 
						$que_b = oci_parse($conn, "SELECT * FROM BUILDING_DORM");
						$r_b = oci_execute($que_b);
						while (($row_b = oci_fetch_array($que_b, OCI_ASSOC))) {?>
							<option value="<?php echo $row_b['B_ID'];?>"
								<?php
								if(isset($_GET['r_edit'])){
									if($row_b['B_ID']==$res['B_ID'])echo "selected hidden" ;
								}?>
								><?php echo $row_b['B_NAME'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<?php if(isset($_GET['r_edit'])){?>
			<div class="col-sm-6"><center>
				<button  onclick="chk_R_NAME()" class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
			<?php } ?>
			<div class="<?php if(isset($_GET['r_edit'])){ echo 'col-sm-6';}else{echo 'col-sm-12';}?>" ><center>
				<button  onclick="chk_R_NAME()" class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> เพิ่มห้อง</button> </a>
			</div>
		</div>
	</form>
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="col-sm-8 " style="margin-top:30px;"><center>
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, "SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID order by R_STATUS asc");
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(R_ID)as NUM from ROOM_DORM,BUILDING_DORM,ROOM_TYPE where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID ");
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<td align="left">สถานะห้อง</td>
					<td align="left">ชื่อห้อง</td>
					<td align="left">อาคาร</td>
					<td align="right">ราคา/เดือน</td>
					<td align="left">ประเภทห้อง</td>
					
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
						<td align="left"><?=$row['R_STATUS'];?></td>
						<td align="left"><?=$row['R_NAME'];?></td>
						<td align="left"><?=$row['B_NAME'];?></td>
						<td align="right"><?=$row['R_PRICE'];?></td>
						<td align="left"><?=$row['RT_NAME'];?></td>
						
						<td align="center"><a  href="?r_edit=<?=$row['R_ID'];?>"><i style="color:#b06821" class="fas fa-pen-square fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_add']) && $_POST['R_NAME']!=''){
		$que_chk=oci_parse($conn,"select count(R_NAME)as NUM from ROOM_DORM where R_NAME=:R_NAME");
		oci_bind_by_name($que_chk, ':R_NAME', $_POST['R_NAME']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
			$que=oci_parse($conn,"insert into ROOM_DORM (R_NAME,R_PRICE,R_STATUS,B_ID,RT_ID) values (:R_NAME,:R_PRICE,:R_STATUS,:B_ID,:RT_ID)");
			oci_bind_by_name($que, ':R_NAME', $_POST['R_NAME']);
			oci_bind_by_name($que, ':R_PRICE', $_POST['R_PRICE']);
			oci_bind_by_name($que, ':R_STATUS', $_POST['R_STATUS']);
			oci_bind_by_name($que, ':B_ID', $_POST['B_ID']);
			oci_bind_by_name($que, ':RT_ID', $_POST['RT_ID']);
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?room_dorm'>";}
	}elseif(isset($_POST['btn_edit']) && $_POST['R_NAME']!=''){
		$que_chk=oci_parse($conn,"select count(R_NAME)as NUM from ROOM_DORM where R_NAME=:R_NAME");
		oci_bind_by_name($que_chk, ':R_NAME', $_POST['R_NAME']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
			$que=oci_parse($conn,"update ROOM_DORM set R_NAME=:R_NAME,R_PRICE=:R_PRICE,R_STATUS=:R_STATUS,B_ID=:B_ID,RT_ID=:RT_ID where R_ID=:R_ID");
			oci_bind_by_name($que, ':R_NAME', $_POST['R_NAME']);
			oci_bind_by_name($que, ':R_PRICE', $_POST['R_PRICE']);
			oci_bind_by_name($que, ':R_STATUS', $_POST['R_STATUS']);
			oci_bind_by_name($que, ':B_ID', $_POST['B_ID']);
			oci_bind_by_name($que, ':RT_ID', $_POST['RT_ID']);
			oci_bind_by_name($que, ':R_ID', $_POST['R_ID']);
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?room_dorm'>";}
		
	}
?>


