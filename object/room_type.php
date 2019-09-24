<div class="col-sm-6" style="margin-top:20px;">
	<form class="form-horizontal box-content" method="POST" action="">
		<div class="form-group">
			<p align="center" class="cv_important" id="war"></p>
			<label class="control-label col-sm-3" >ประเภทห้อง:</label>
			<div class="col-sm-9">
				<?php if(isset($_GET['rt_edit'])){
					$que=oci_parse($conn,"select * from room_type where RT_ID=:rt_edit");
					oci_bind_by_name($que, ':rt_edit', $_GET['rt_edit']);
					$r=oci_execute($que);
					$res=oci_fetch_array($que);

					?>
					<input type="hidden" name="RT_ID" value=<?=$_GET['rt_edit']?>>
				<?php } ?>


				<input type="text" class="form-control" id="rt_name" name="rt_name" placeholder="ประเภทห้อง" <?php if(isset($_GET['rt_edit'])) echo "value=".$res['RT_NAME'];?>>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12"><center>
				<button class="btn btn-ok" name="<?php if(isset($_GET['rt_edit'])){echo "btn_edit";}else{echo "btn_add";} ?>"><i class="fas fa-plus-square fa-1x"></i><?php if(isset($_GET['rt_edit'])){echo "บันทึกข้อมูล";}else{echo "เพิ่มประเภทห้อง";} ?> </button> </a>
			</div>
		</div>
	</form>
</div>
<div class="col-sm-6 " style="margin-top:30px;"><center>
	<div class="box-content">

	<?php
	if(isset($_POST['btn_add']) && $_POST['rt_name']!=''){
		$que_chk=oci_parse($conn,"select count(RT_NAME)as NUM from room_type where RT_NAME=:RT_NAME");
		oci_bind_by_name($que_chk, ':rt_name', $_POST['rt_name']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$que=oci_parse($conn,"insert into room_type (RT_NAME) values (:rt_name)");
			oci_bind_by_name($que, ':rt_name', $_POST['rt_name']);
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?room_type'>";}
		}else{ ?>
			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
				document.getElementById("rt_name").innerHTML=<?=$_POST['rt_name'];?>
			</script>
		<?php }
		
	}elseif(isset($_POST['btn_edit']) && $_POST['rt_name']!=''){
		$que_chk=oci_parse($conn,"select count(RT_NAME)as NUM from room_type where RT_NAME=:RT_NAME");
		oci_bind_by_name($que_chk, ':rt_name', $_POST['rt_name']);
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		if($res['NUM']==0){
			$que=oci_parse($conn,"update room_type set RT_NAME=:rt_name where RT_ID=:RT_ID");
			oci_bind_by_name($que, ':rt_name', $_POST['rt_name']);
			oci_bind_by_name($que, ':RT_ID', $_POST['RT_ID']);
			if(!$r=oci_execute($que)){echo "update error";}else{echo "<meta http-equiv='refresh' content='0;url=?room_type'>";}
		}else{ ?>

			<script type="text/javascript">
				document.getElementById("war").innerHTML ="พบข้อมูลที่ตรงกันในระบบ";
				document.getElementById("rt_name").innerHTML=<?=$_POST['rt_name'];?>
			</script>
		<?php }
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$que = oci_parse($conn, 'SELECT * FROM room_type');
		$r = oci_execute($que);
		?>
		<table>
			<tr>
				<td>ประเภทห้อง</td>
				<td></td>
			</tr>
		<?php
		while (($row = oci_fetch_array($que, OCI_ASSOC))) {?>
			<tr>
				<td><?=$row['RT_NAME'];?></td>
				<td><a  href="?rt_edit=<?=$row['RT_ID'];?>"><i style="color:#b06821" class="fas fa-pen-square fa-2x" ></i></a></td>
			</tr>    
			 
		<?php }
		?>
		</table>
	</div>
</div>
