
<?php //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['HS_EDIT_for_staff'])){
		$que=oci_parse($conn,"SELECT MANAGER_DORM.MNG_ID,HS_PRICE,STAFF_DORM.S_ID,STAFF_DORM.S_NAME,STAFF_DORM.S_LNAME,MANAGER_DORM.MNG_NAME,MANAGER_DORM.MNG_LNAME,HS_STATUS,HS_DATE_RECEIVE,HS_DATE_PAY FROM HIRE_STAFF,MANAGER_DORM,STAFF_DORM where HIRE_STAFF.MNG_ID=MANAGER_DORM.MNG_ID AND HIRE_STAFF.S_ID=STAFF_DORM.S_ID AND  HIRE_STAFF.HS_ID=:HS_EDIT");
		oci_bind_by_name($que, ':HS_EDIT', $_GET['HS_EDIT_for_staff']);
		$r=oci_execute($que);
		$res=oci_fetch_array($que);
?>
<div class="col-sm-2"></div>
<div class="col-sm-6" style="margin-top:20px;">
	<form name="USER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
		<input type="hidden" name="HS_ID" value=<?php echo $_GET['HS_EDIT_for_staff'];?>>
		<div class="form-group">
			<label class="control-label col-sm-3" >พนักงาน:</label>
			<div class="col-sm-9">
				<label class="col-sm-12" align="left"><?php echo $res['S_NAME'].' '.$res['S_LNAME'];?></label>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >จำนวนเงินค่าจ้าง:</label>
			<div class="col-sm-9">
				<label class="col-sm-12" align="left"><?php echo $res['HS_PRICE'];?></label>
			</div>
		</div>
		<?php if(isset($_GET['HS_EDIT_for_staff'])){?>
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
		<div class="form-group">
			<?php if($res['HS_STATUS']=="OK"){?>
				<div class="col-sm-12"><center>
					<button class="btn btn-ok" disabled name="btn_receive"><i class="fas fa-check-circle fa-1x"></i> ยืนยันการรับเงิน</button> </a>
				</div>
			<?php } else{?>
			<div class="col-sm-12"><center>
				<button class="btn btn-ok" name="btn_receive"><i class="fas fa-check-circle fa-1x"></i> ยืนยันการรับเงิน</button> </a>
			</div>
			<?php } ?>
		</div>
		<?php }?>
		
	</form>
</div>
<?php
if(isset($_POST['btn_receive'])){
		$S_DATE=date("d/m/Y h:i:sa");
			$que=oci_parse($conn,"update HIRE_STAFF set HS_STATUS='OK',HS_DATE_RECEIVE=:HS_DATE_RECEIVE where HS_ID=:HS_ID");
			oci_bind_by_name($que, ':HS_DATE_RECEIVE', $S_DATE);
			oci_bind_by_name($que, ':HS_ID', $_POST['HS_ID']);

			if(!$r=oci_execute($que)){echo "insert error";}else{echo "<meta http-equiv='refresh' content='0;url=?HS_EDIT_for_staff=".$_POST['HS_ID']."'>";}	
		
	}
}else{ ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="12" style="margin-top:30px;">
	<div class="box-content">

<?php 
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$que = oci_parse($conn, "SELECT * FROM HIRE_STAFF,MANAGER_DORM,STAFF_DORM where HIRE_STAFF.MNG_ID=MANAGER_DORM.MNG_ID AND HIRE_STAFF.S_ID=STAFF_DORM.S_ID AND STAFF_DORM.S_ID=:S_ID order by HIRE_STAFF.HS_ID desc");
		oci_bind_by_name($que, ':S_ID', $_SESSION['id']);
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(HIRE_STAFF.HS_ID) as NUM from HIRE_STAFF,MANAGER_DORM,STAFF_DORM where HIRE_STAFF.MNG_ID=MANAGER_DORM.MNG_ID AND HIRE_STAFF.S_ID=STAFF_DORM.S_ID AND STAFF_DORM.S_ID=:S_ID");
		oci_bind_by_name($que_chk, ':S_ID', $_SESSION['id']);
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
				
					<tr <?php if($row['HS_STATUS']=="WAITING RECEIVE")echo "style='background-color:#f3a1a1'";?>>
						<td align="left"><?=$row['HS_DATE_PAY'];?></td>
						<td align="left"><?=$row['HS_DATE_RECEIVE'];?></td>
						<td align="left"><?=$row['S_NAME'];?></td>
						<td align="left"><?=$row['MNG_NAME'];?></td>
						<td align="center"><a  href="?HS_EDIT_for_staff=<?=$row['HS_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
				
				 
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	<?php }
	
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



