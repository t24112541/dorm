<div class="col-sm-7" style="margin-top:20px;">
	<form class="form-horizontal box-content" method="POST" action="">
		<div class="form-group">
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >อาคาร:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['b_edit'])){
					$que=oci_parse($conn,"select * from building_dorm where B_ID=:b_edit");
					oci_bind_by_name($que, ':b_edit', $_GET['b_edit']);
					$r=oci_execute($que);
					$res=oci_fetch_array($que);
					// var_dump($res);
					// echo $res['B_NAME'];
					?>
					<input type="hidden" name="B_ID" value=<?=$_GET['b_edit']?>>
				<?php } ?>
				<textarea rows="2" class="form-control" id="B_NAME" name="B_NAME" placeholder="ชื่ออาคาร"><?php if(isset($_GET['b_edit'])) echo $res['B_NAME'];?></textarea>

				<!-- <input type="text" class="form-control" id="B_NAME" name="B_NAME" placeholder="ชื่ออาคาร" <?php if(isset($_GET['b_edit'])) echo "value=".$res['B_NAME'];?>> -->
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ที่ตั้ง:</label>
			<div class="col-sm-9">
				<textarea rows="2" class="form-control" id="B_LOCATION" name="B_LOCATION" placeholder="ที่ตั้ง"><?php if(isset($_GET['b_edit'])) echo $res['B_LOCATION'];?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >จำนวนห้อง:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="B_ROOM_COUNT" name="B_ROOM_COUNT" placeholder="จำนวนห้อง" <?php if(isset($_GET['b_edit'])) echo "value=".$res['B_ROOM_COUNT'];?>>
			</div>
		</div>
		<div class="form-group">
			<?php if(isset($_GET['b_edit'])){?>
			<div class="col-sm-6"><center>
				<button class="btn btn-ok" name="btn_edit"><i class="fas fa-save fa-1x"></i> บันทึกข้อมูล</button> </a>
			</div>
			<?php } ?>
			<div class="<?php if(isset($_GET['b_edit'])){ echo 'col-sm-6';}else{echo 'col-sm-12';}?>" ><center>
				<button class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> เพิ่มอาคาร</button> </a>
			</div>
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
<div class="col-sm-5 " style="margin-top:30px;"><center>
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, 'SELECT * FROM BUILDING_DORM');
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(B_ID)as NUM from BUILDING_DORM ");
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<td align="left">ชื่ออาคาร</td>
					<td align="center">ที่ตั้ง</td>
					<td align="right">จำนวนห้อง</td>
					<td align="right">จำนวนห้องว่าง</td>
					<td align="center">จัดการข้อมูล</td>
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
						<td><?=$row['B_NAME'];?></td>
						<td><?=$row['B_LOCATION'];?></td>
						<td align="right"><?=$row['B_ROOM_COUNT'];?></td>
						<td align="right"><?php 
							$que_room=oci_parse($conn,"select count(R_ID) as num_room from ROOM_DORM,BUILDING_DORM where ROOM_DORM.B_ID=BUILDING_DORM.B_ID AND ROOM_DORM.B_ID=:B_ID");
							oci_bind_by_name($que_room, ':B_ID', $row['B_ID']);
							$res_room = oci_execute($que_room);
							$row_room = oci_fetch_array($que_room, OCI_ASSOC);
							echo $row['B_ROOM_COUNT']-$row_room['NUM_ROOM'];
						?></td>
						<td align="center"><a  href="?b_edit=<?=$row['B_ID'];?>"><i style="color:#b06821" class="fas fa-pen-square fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


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
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?building_dorm&add_stg'>";}
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
		
			$que=oci_parse($conn,"update BUILDING_DORM set B_NAME=:B_NAME,B_LOCATION=:B_LOCATION,B_ROOM_COUNT=:B_ROOM_COUNT where B_ID=:B_ID");
			oci_bind_by_name($que, ':B_NAME', $_POST['B_NAME']);
			oci_bind_by_name($que, ':B_LOCATION', $_POST['B_LOCATION']);
			oci_bind_by_name($que, ':B_ROOM_COUNT', $_POST['B_ROOM_COUNT']);
			oci_bind_by_name($que, ':B_ID', $_POST['B_ID']);
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?building_dorm'>";}
		
	}

