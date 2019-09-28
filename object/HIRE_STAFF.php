
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['HS_EDIT'])){
		$que=oci_parse($conn,"SELECT MANAGER_DORM.MNG_ID,HS_PRICE,STAFF_DORM.S_ID,STAFF_DORM.S_NAME,STAFF_DORM.S_LNAME,MANAGER_DORM.MNG_NAME,MANAGER_DORM.MNG_LNAME,HS_STATUS,HS_DATE_RECEIVE,HS_DATE_PAY FROM HIRE_STAFF,MANAGER_DORM,STAFF_DORM where HIRE_STAFF.MNG_ID=MANAGER_DORM.MNG_ID AND HIRE_STAFF.S_ID=STAFF_DORM.S_ID AND  HIRE_STAFF.HS_ID=:HS_EDIT");
		oci_bind_by_name($que, ':HS_EDIT', $_GET['HS_EDIT']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>
<?php } ?>
<div class="col-sm-6" style="margin-top:20px;">
	<form name="USER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
		<input type="hidden" name="HS_ID" value=<?php if(isset($_GET['HS_EDIT'])){ echo $_GET['HS_EDIT'];}?>>
		<div class="form-group">
			<label class="control-label col-sm-3" >พนักงาน:</label>
			<div class="col-sm-9">
				<select id="S_ID" name="S_ID" required class="form-control" id="sel1">
					<option value=" " selected >โปรดเลือกพนักงาน</option>
					<?php 
						$que_b = oci_parse($conn, "SELECT * FROM STAFF_DORM");
						$r_b = oci_execute($que_b);
						while (($row_b = oci_fetch_array($que_b, OCI_ASSOC))) {?>
							<option <?php if(isset($_GET['HS_EDIT']) && $res['S_ID']==$row_b['S_ID']){echo "selected";}?> value="<?php echo $row_b['S_ID'];?>"><?php echo $row_b['S_NAME'].' '.$row_b['S_LNAME'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >จำนวนเงินค่าจ้าง:</label>
			<div class="col-sm-9">
				<input type="number" required oninvalid="this.setCustomValidity('กรอกจำนวนเงิน')"
    oninput="this.setCustomValidity('')" class="form-control" id="HS_PRICE" name="HS_PRICE" placeholder="กรอกจำนวนเงิน" value="<?php echo $res['HS_PRICE'];?>">
			</div>
		</div>
		<?php if(isset($_GET['HS_EDIT'])){?>
		<div class="form-group">
			<label class="control-label col-sm-3" >ผู้ทำเรื่องจ่าย:</label>
			
				<div class="col-sm-9">
					<a class="cv_link" href="?mng_edit=<?php echo $res['MNG_ID'];?>"><label class="control-label col-sm-12" align="left"><?php echo $res['MNG_NAME']." ".$res['MNG_LNAME']; ?></label></a>	
				</div>
			

		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ผู้รับเงิน:</label>
				<div class="col-sm-9">
					<a class="cv_link" href="?s_edit=<?php echo $res['S_ID'];?>"><label class="control-label col-sm-12" align="left"><?php echo $res['S_NAME']." ".$res['S_LNAME']; ?></label></a>	
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >สถานะ:</label>
				<div class="col-sm-9">
					<label class="col-sm-12" align="left"><?php echo $res['HS_STATUS']; ?></label>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >วันที่ทำเรื่องจ่าย:</label>
				<div class="col-sm-9">
					<label class="col-sm-12" align="left"><?php echo $res['HS_DATE_PAY']; ?></label>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >วันที่ทำเรื่องรับ:</label>
				<div class="col-sm-9">
					<label class="col-sm-12" align="left"><?php echo $res['HS_DATE_RECEIVE']; ?></label>
				</div>
		</div>
		<?php }?>
		<div class="form-group">
			<?php if(isset($_GET['HS_EDIT'])){?>
			<div class="col-sm-12"><center>
				<button class="btn btn_dan" name="btn_edit" onclick="return confirm('ลบจริงหรือไม่?')"><i class="fas fa-trash-alt fa-1x"></i> ลบข้อมูล</button> </a>
			</div>
			<?php } ?>
		</div>
		<div class="form-group">
			<div class="col-sm-12"><center>
				<button  onclick="" class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> เพิ่มข้อมูล</button> </a>
			</div>
		</div>
	</form>
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class=" <?php if(isset($_GET['HS_EDIT'])){echo 'col-sm-4';}else{echo 'col-sm-6';}?>" style="margin-top:30px;">
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, "SELECT * FROM HIRE_STAFF,MANAGER_DORM,STAFF_DORM where HIRE_STAFF.MNG_ID=MANAGER_DORM.MNG_ID AND HIRE_STAFF.S_ID=STAFF_DORM.S_ID order by HIRE_STAFF.HS_ID desc");
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(HIRE_STAFF.HS_ID) as NUM from HIRE_STAFF,MANAGER_DORM,STAFF_DORM where HIRE_STAFF.MNG_ID=MANAGER_DORM.MNG_ID AND HIRE_STAFF.S_ID=STAFF_DORM.S_ID");
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		?>
		<table class="table table-striped">
			<thead>
				<tr>
					<td align="left">วันที่จ่าย</td>
					<td align="left">วันที่รับ</td>
					<td align="left">ผู้รับ</td>
					<td align="left">ผู้จ่าย</td>		
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
						<td align="left"><?=$row['HS_DATE_PAY'];?></td>
						<td align="left"><?=$row['HS_DATE_RECEIVE'];?></td>
						<td align="left"><?=$row['S_NAME'];?></td>
						<td align="left"><?=$row['MNG_NAME'];?></td>
						<td align="center"><a  href="?HS_EDIT=<?=$row['HS_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php
	if(isset($_POST['btn_add']) && $_POST['S_ID']!=""){
		$S_DATE=date("d/m/Y h:i:sa");
			$que=oci_parse($conn,"insert into HIRE_STAFF (HS_PRICE,S_ID,MNG_ID,HS_STATUS,HS_DATE_PAY,HS_DATE_RECEIVE) values (:HS_PRICE,:S_ID,:MNG_ID,'WAITING RECEIVE',:HS_DATE_PAY,' ') RETURNING HS_ID INTO :return_val");
			oci_bind_by_name($que, ':HS_PRICE', $_POST['HS_PRICE']);
			oci_bind_by_name($que, ':S_ID', $_POST['S_ID']);
			oci_bind_by_name($que, ':MNG_ID', $_SESSION['id']);
			oci_bind_by_name($que, ':HS_DATE_PAY', $S_DATE);
			oci_bind_by_name($que, ":return_val", $val, 18);
			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?HS_EDIT=".$val."'>";}	
		
	}elseif(isset($_POST['btn_edit']) && $_POST['HS_ID']!=''){
			$que=oci_parse($conn,"delete from HIRE_STAFF where HS_ID=:HS_ID");
			oci_bind_by_name($que, ':HS_ID', $_POST['HS_ID']);
			if(!$r=oci_execute($que)){echo "delete error";}else{
				echo "<meta http-equiv='refresh' content='0;url=?HS_EDIT=".$_POST['HS_ID']."'>";
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



