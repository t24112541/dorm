<?php
$today=date('d-m-Y');
	if(isset($_GET['HIRE_PRICE_ADD'])){?>
<div class="col-sm-12" style="margin-top:20px;">
	<form name="USER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
					<p align="center" class="cv_important" id="war"></p>

		<!-- <input type="hidden" name="HU_ID" value=<?php if(isset($_GET['HS_EDIT'])){ echo $_GET['HS_EDIT'];}?>> -->
		<h3 align="center">ออกใบเสร็จค่าเช่า</h3>
		<div class="form-group">
			<label class="control-label col-sm-3" >ห้อง:</label>
			<div class="col-sm-9">
				<select id="R_ID" name="R_ID" class="form-control">
					<option value=" " selected >โปรดเลือกห้อง</option>
					<?php 
						$que_b = oci_parse($conn, "SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID");
						$r_b = oci_execute($que_b);
						while (($row_b = oci_fetch_array($que_b, OCI_ASSOC))) {?>
							<option  value="<?php echo $row_b['R_ID'];?>"><?php echo $row_b['B_NAME'].' &nbsp;&nbsp;&nbsp;ห้อง '.$row_b['R_NAME'];?></option>
					<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ค่าไฟ:</label>
<!-- 			<div class="col-sm-4">
				<input type="number" required oninvalid="this.setCustomValidity('หน่วยที่อ่าน')"
    oninput="this.setCustomValidity('')" onchange="cal_elec()" class="form-control" id="HP_ELEC_UNIT_R" name="HP_ELEC_UNIT_R" placeholder="หน่วยที่อ่าน" value="">
			</div>
			<div class="col-sm-5">
				<select onchange="cal_elec()" id="HP_ELEC_UNIT" name="HP_ELEC_UNIT" required class="form-control" id="sel1">
					<option value=" " disabled selected >เลือกค่าไฟ/หน่วย</option>
					<?php 
						for($i=1;$i<=50;$i++) {?>
							<option value="<?php echo $i?>"><?php echo $i;?></option>
					<?php }?>
				</select>
				
			</div> -->
			<!-- <label class="control-label col-sm-3" >เป็นเงิน:</label> -->
			<div class="col-sm-9">
				<input type="number" required oninvalid="this.setCustomValidity('ห้ามว่าง')"
    oninput="this.setCustomValidity('')" class="form-control" id="HP_ELECTRIC_PRICE" name="HP_ELECTRIC_PRICE" placeholder="กรอกจำนวนเงิน" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >ค่าน้ำ:</label>
			<!-- <div class="col-sm-3"> -->
<!-- 				<input onchange="cal_wat()" type="number" required oninvalid="this.setCustomValidity('หน่วยที่อ่าน')"
    oninput="this.setCustomValidity('')" class="form-control" id="HP_WATER_UNIT_R" name="HP_WATER_UNIT_R" placeholder="หน่วยที่อ่าน" value="">
			</div>
			<div class="col-sm-5">
				<select onchange="cal_wat()" id="HP_WATER_UNIT" name="HP_WATER_UNIT" required class="form-control" id="sel1">
					<option value=" " disabled selected >เลือกค่าน้ำ/หน่วย</option>
					<?php 
						for($i=1;$i<=50;$i++) {?>
							<option value="<?php echo $i?>"><?php echo $i;?></option>
					<?php }?>
				</select>
				
			</div> -->
			<!-- <label class="control-label col-sm-3" >เป็นเงิน:</label> -->
			<div class="col-sm-9">
				<input type="number" required oninvalid="this.setCustomValidity('ห้ามว่าง')"
    oninput="this.setCustomValidity('')" class="form-control" id="HP_WATER_PRICE" name="HP_WATER_PRICE" placeholder="กรอกจำนวนเงิน" value="">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" >กำหนดจ่าย:</label>
			<div class="col-sm-2">
				<select onchange="date(this.value)" id="HP_OUTOFDATE" name="HP_OUTOFDATE" required class="form-control" id="sel1">
					<option value=" " selected disabled>เลือกกำหนดจ่าย/หน่วย</option>
					<?php 
						for($i=1;$i<=20;$i++) {?>
							<option value="<?php echo $i?>" <?php if($i==15){echo "selected";}?>><?php echo $i;?></option>
					<?php }?>
				</select>
			</div>
			<label class="control-label col-sm-2" >วันหลังจากที่ออกค่าเช่า</label>
			
		</div>
		<div class="form-group">
			<div class="col-sm-12"><center>
				<button  onclick="" class="btn btn-ok" name="btn_add"><i class="fas fa-plus-square fa-1x"></i> ออกใบเสร็จ</button> </a>
			</div>
		</div>
	</form>
</div>

<?php } elseif(isset($_GET['HIRE_PRICE'])){
	$que = oci_parse($conn, "SELECT * FROM HIRE_PRICE,ROOM_DORM,BUILDING_DORM where HIRE_PRICE.R_ID=ROOM_DORM.R_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID order by HIRE_PRICE.HP_ID desc");
		$r = oci_execute($que);
		$que_chk=oci_parse($conn,"select count(HIRE_PRICE.HP_ID) as NUM from HIRE_PRICE,ROOM_DORM,BUILDING_DORM where HIRE_PRICE.R_ID=ROOM_DORM.R_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID");
		$r_chk=oci_execute($que_chk);
		$res = oci_fetch_array($que_chk, OCI_ASSOC);
		?>

<div class="col-sm-12 " style="margin-top:30px;"><center>
	<div class="box-content">
		<table class="table table-striped">
			<thead>
				<tr>
					<td align="left">กำหนดจ่าย</td>
					<td align="left">อาคาร</td>
					<td align="left">ห้อง</td>
					<td align="left">ราคา</td>		
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
						<td align="left"><?=$row['HP_OUTOFDATE'];?></td>
						<td align="left"><?=$row['B_NAME'];?></td>
						<td align="left"><?=$row['R_NAME'];?></td>
						<td align="left"><?=$row['R_PRICE']+$row['HP_ELECTRIC_PRICE']+$row['HP_WATER_PRICE'];?></td>
						<td align="center"><a  href="?HP_EDIT=<?=$row['HP_ID'];?>"><i style="color:#b06821" class="fas fa-book-open fa-2x" ></i></a></td>
					</tr>   
			<?php } 
		}?>
			</tbody> 
		</table>
	</div>
</div>

<?php } elseif(isset($_GET['HP_EDIT'])){

		$que_HPD = oci_parse($conn, "SELECT HIRE_PRICE.S_ID as S_ID,HIRE_PRICE_DETAIL.S_ID as S_ID2 FROM HIRE_PRICE,HIRE_PRICE_DETAIL where HIRE_PRICE.HP_ID=HIRE_PRICE_DETAIL.HP_ID and HIRE_PRICE.HP_ID=:HP_ID order by HIRE_PRICE.HP_ID ");
		oci_bind_by_name($que_HPD, ':HP_ID', $_GET['HP_EDIT']);
		$r_HPD = oci_execute($que_HPD);
		$res_HPD = oci_fetch_array($que_HPD, OCI_ASSOC);
		// var_dump($res_HPD);
		$que = oci_parse($conn, "SELECT * FROM HIRE_PRICE,ROOM_DORM,BUILDING_DORM,HIRE_PRICE_DETAIL where HIRE_PRICE.R_ID=ROOM_DORM.R_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID AND HIRE_PRICE.HP_ID=HIRE_PRICE_DETAIL.HP_ID  AND HIRE_PRICE.HP_ID=:HP_ID order by HIRE_PRICE.HP_ID ");
		oci_bind_by_name($que, ':HP_ID', $_GET['HP_EDIT']);
		$r = oci_execute($que);
		$res = oci_fetch_array($que, OCI_ASSOC);

		$HP_OUTOFDATE=$res['HP_OUTOFDATE'];
		$date1=explode("-",$HP_OUTOFDATE);
		$d1=$date1[0];
		$m1=$date1[1];
		$y1=$date1[2];

		$date2=explode("-",$today);
		$d2=$date2[0];
		$m2=$date2[1];
		$y2=$date2[2];

		$y=$y2-$y1;
		$m=$m2-$m1;
		$d=$d2-$d1;
		// echo $d2." ".$m2." ".$y2." <br>";
		// echo $d1." ".$m1." ".$y1." <br>";

		if($y!=0){$y*=365;$d+=$y;}
		if($m!=0){$m*=30;$d+=$m;}
		// echo $d." ".$m." ".$y." <br>";
		if($d>0){$over_date=$d*$res['HPD_OVER_DATE_PRICE'];}
		else{$over_date=0;}
						$que_s_id=oci_parse($conn,"select count(MNG_ID) as MNG_ID from MANAGER_DORM where MNG_ID=:ID");
						oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID']);
						$r_s_id=oci_execute($que_s_id);
						$res_s_id=oci_fetch_array($que_s_id);
						if($res_s_id['MNG_ID']>0){
							$que_s_id=oci_parse($conn,"select * from MANAGER_DORM where MNG_ID=:ID");
							oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID']);
							$r_s_id=oci_execute($que_s_id);
							$res_s_id=oci_fetch_array($que_s_id);
							$s_name=$res_s_id['MNG_NAME']." ".$res_s_id['MNG_LNAME'];
							$s_id=$res_s_id['MNG_ID'];
							$s_link='?mng_edit='.$s_id;
						}else{
							$que_s_id=oci_parse($conn,"select count(S_ID) as S_ID from STAFF_DORM where S_ID=:ID");
							oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID']);
							$r_s_id=oci_execute($que_s_id);
							$res_s_id=oci_fetch_array($que_s_id);
							if($res_s_id['S_ID']>0){
								$que_s_id=oci_parse($conn,"select * from STAFF_DORM where S_ID=:ID");
								oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID']);
								$r_s_id=oci_execute($que_s_id);
								$res_s_id=oci_fetch_array($que_s_id);
								$s_name=$res_s_id['S_NAME']." ".$res_s_id['S_LNAME'];
								$s_id=$res_s_id['S_ID'];
								$s_link='?s_edit='.$s_id;
							}
						}
		?>
<!-- chk_load(<?php echo $res['HPD_DATE_PAY'];?>,'btn_print') -->
<div class="col-sm-12" style="margin-top:20px;">
	<form name="USER_DORM" class="form-horizontal box-content was-validated" method="POST" action="">
					<p align="center" class="cv_important" id="war"></p>
		<div id="printableArea">
			<table style="width:100%" border="0">
				<tr>
					<td align="center" colspan="12"><h3>ใบเสร็จค่าเช่า</h3></td>
				</tr>
				<tr>
					<td style="width:10%"></td>
					<td style="width:5%">อาคาร:</td>
					<td style="width:15%" align="left"><?php echo $res['B_NAME']?></td>
					<td style="width:5%">ห้อง:</td>
					<td style="width:15%" align="left"><?php echo $res['R_NAME']?></td>
					<td style="width:15%">กำหนดจ่าย:</td>
					<td colspan="2" align="left"><p id="sh_date"></p></td>
				</tr>
				<tr >
					<td rowspan="1" colspan="8" align="center">รายการ</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">ค่าไฟ:</td>
					<td colspan="2" align="right"><?php echo $res['HP_ELECTRIC_PRICE']?></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">ค่าน้ำ:</td>
					<td colspan="2" align="right"><?php echo $res['HP_WATER_PRICE']?></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">ค่าห้อง:</td>
					<td colspan="2" align="right"><?php echo $res['R_PRICE']?></td>
					<td colspan="2"></td>
				</tr>
			<?php if($over_date>0){?>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">ล่าช้า: <?php echo $d?> วัน </td>
					<td colspan="2" align="right"></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">อัตราค่าปรับ<input width="14" type="text" class="form-control"  name="HPD_OVER_DATE_PRICE" value="<?php echo $res['HPD_OVER_DATE_PRICE']?>"> บาท</td>
					<td colspan="2" align="right"><?php echo $over_date;?></td>
					<td colspan="2"></td>
				</tr>
			<?php } ?>
				<tr>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2" align="right" style="width:15%"> &nbsp;</td>
					<td colspan="2" style="width:15%"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2" align="right" style="width:15%">รวม: &nbsp;</td>
					<td colspan="2" style="width:15%"> <?php echo $total=$res['R_PRICE']+$res['HP_ELECTRIC_PRICE']+$res['HP_WATER_PRICE']+$over_date;?> บาท</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2" align="right" style="width:15%"> &nbsp;</td>
					<td colspan="2" style="width:15%"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">&nbsp;</td>
					<td colspan="2" align="right" style="width:15%"></td>
					<td colspan="2" style="width:15%"></td>
				</tr>

				<tr>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2" align="right" style="width:15%"></td>
					<td colspan="2" style="width:15%"></td>
				</tr>
				
				<tr>

				<?php 
				$que_s_id=oci_parse($conn,"select count(MNG_ID) as MNG_ID from MANAGER_DORM where MNG_ID=:ID");
						oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID2']);
						$r_s_id=oci_execute($que_s_id);
						$res_s_id=oci_fetch_array($que_s_id);
						if($res_s_id['MNG_ID']>0){
							$que_s_id=oci_parse($conn,"select * from MANAGER_DORM where MNG_ID=:ID");
							oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID2']);
							$r_s_id=oci_execute($que_s_id);
							$res_s_id=oci_fetch_array($que_s_id);
							$s_name_2=$res_s_id['MNG_NAME']." ".$res_s_id['MNG_LNAME'];
							$s_id=$res_s_id['MNG_ID'];
							$s_link='?mng_edit='.$s_id;
						}else{
							$que_s_id=oci_parse($conn,"select count(S_ID) as S_ID from STAFF_DORM where S_ID=:ID");
							oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID2']);
							$r_s_id=oci_execute($que_s_id);
							$res_s_id=oci_fetch_array($que_s_id);
							if($res_s_id['S_ID']>0){
								$que_s_id=oci_parse($conn,"select * from STAFF_DORM where S_ID=:ID");
								oci_bind_by_name($que_s_id,':ID',$res_HPD['S_ID2']);
								$r_s_id=oci_execute($que_s_id);
								$res_s_id=oci_fetch_array($que_s_id);
								$s_name_2=$res_s_id['S_NAME']." ".$res_s_id['S_LNAME'];
								$s_id=$res_s_id['S_ID'];
								$s_link='?s_edit='.$s_id;
							}
						}?>
					<td colspan="2" align="right">ผู้ออกใบเสร็จ : </td>
					<td colspan="2"> &nbsp;<?php echo $s_name;?></td>
					<?php if($res_HPD['S_ID2']!=''){?>
						<td colspan="2" align="right" style="width:10%">ผู้รับเงิน : </td>
						<td colspan="2" align="left" style="" >&nbsp; <?php echo $s_name_2;?></td>
					<?php } ?>
				</tr>

			</table>
		</div>
		<input type="hidden" name="HP_ID" value=<?php if(isset($_GET['HP_EDIT'])){ echo $_GET['HP_EDIT'];}?>>
		<input type="hidden" name="HP_OUTOFDATE" id="HP_OUTOFDATE" value="<?php  echo $res['HP_OUTOFDATE'];?>">
		<input type="hidden" name="HPD_DATE_PAY_js" id="HPD_DATE_PAY_js" value="<?php  echo $res['HPD_DATE_PAY'];?>">
		<input type="hidden" name="HPD_ID" id="HPD_ID" value="<?php  echo $res['HPD_ID'];?>">

		<input type="hidden" name="HPD_OVER_DATE" id="HPD_OVER_DATE" value="<?php  echo $d;?>">
		<!-- <input type="hidden" name="HPD_OVER_DATE_PRICE" id="HPD_OVER_DATE_PRICE" value="<?php  echo $res['HPD_OVER_DATE_PRICE'];?>"> -->
		<input type="hidden" name="HPD_TOTAL_PRICE" id="HPD_TOTAL_PRICE" value="<?php  echo $total?>">
		
		<div class="form-group">
			<div class="col-sm-12"><center>
				<button onclick="" id="btn_pay" class="btn btn-ok" name="btn_pay"><i class="fas fa-money-bill-wave fa-1x"></i> ชำระเงิน</button> </a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12"><center>
				<button onclick="printDiv('printableArea')" id="btn_print" class="btn btn-ok" name="btn_print"><i class="fas fa-print fa-1x"></i> พิมพ์</button> </a>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	// var chk=document.getElementById("HPD_DATE_PAY").value;
	console.log(document.getElementById("HPD_DATE_PAY_js").value);
	if(document.getElementById("HPD_DATE_PAY_js").value=="0"){
		document.getElementById("btn_print").style.display ="none";

	}else if(document.getElementById("HPD_DATE_PAY_js").value!="0"){
		document.getElementById("btn_pay").style.display ="none";
	}
	function chk_load(chk,tar){
		console.log("ok");
		console.log(chk);
		console.log(tar);
		if(chk==" "){
			document.getElementById(tar).disabled = true;
		}
	}
	var months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม"];
	var m=document.getElementById("HP_OUTOFDATE").value;
	var str=m.split("-");
	var month=str[1];
	var year=parseInt(str[2])+543;
	document.getElementById("sh_date").innerHTML =str[0]+" "+months[month-1]+" "+year;
	console.log(months[month-1]);

	function printDiv(divName) {
    	var printContents = document.getElementById(divName).innerHTML;
    	var originalContents = document.body.innerHTML;
    	document.body.innerHTML = printContents;
    	window.print();
    	document.body.innerHTML = originalContents;
	}
</script>
<?php } ?>
<?php if(isset($_POST['btn_add']) && $_POST['R_ID']!=''){
			$today=date('d-m-Y');
			$HP_OUTOFDATE= date('d-m-Y', strtotime($today. ' + '.$_POST['HP_OUTOFDATE'].' days'));
			echo $HP_OUTOFDATE;
			$que=oci_parse($conn,"insert into HIRE_PRICE (HP_ELECTRIC_PRICE,HP_WATER_PRICE,HP_OUTOFDATE,S_ID,R_ID) values (:HP_ELECTRIC_PRICE,:HP_WATER_PRICE,:HP_OUTOFDATE,:S_ID,:R_ID) RETURNING HP_ID INTO :return_val");
			oci_bind_by_name($que, ':HP_ELECTRIC_PRICE', $_POST['HP_ELECTRIC_PRICE']);
			oci_bind_by_name($que, ':HP_WATER_PRICE', $_POST['HP_WATER_PRICE']);
			oci_bind_by_name($que, ':HP_OUTOFDATE', $HP_OUTOFDATE);
			oci_bind_by_name($que, ':S_ID', $_SESSION['id']);
			oci_bind_by_name($que, ':R_ID', $_POST['R_ID']);
			oci_bind_by_name($que, ":return_val", $val, 18);
			if(!$r=oci_execute($que)){echo "insert error";}else{
				$que_HPD=oci_parse($conn,"insert into HIRE_PRICE_DETAIL (HP_ID,S_ID,HPD_OVER_DATE,HPD_OVER_DATE_PRICE,HPD_TOTAL_PRICE,HPD_DATE_PAY) values (:HP_ID,'0',' ',0,0,'0')");
				oci_bind_by_name($que_HPD, ':HP_ID', $val);
				// oci_bind_by_name($que_HPD, ':S_ID', $_SESSION['id']);
				if(!$r=oci_execute($que_HPD)){echo "insert error";}else{
					echo "<meta http-equiv='refresh' content='0;url=?staff_dorm'>";
				}
			}
	}elseif(isset($_POST['btn_pay'])){
		$que_pay=oci_parse($conn,"update HIRE_PRICE_DETAIL set S_ID=:S_ID,HPD_OVER_DATE=:HPD_OVER_DATE,HPD_OVER_DATE_PRICE=:HPD_OVER_DATE_PRICE,HPD_TOTAL_PRICE=:HPD_TOTAL_PRICE,HPD_DATE_PAY=:HPD_DATE_PAY where HPD_ID=:HPD_ID");
			oci_bind_by_name($que_pay, ':S_ID', $_SESSION['id']);
			oci_bind_by_name($que_pay, ':HPD_OVER_DATE', $_POST['HPD_OVER_DATE']);
			oci_bind_by_name($que_pay, ':HPD_OVER_DATE_PRICE', $_POST['HPD_OVER_DATE_PRICE']);
			oci_bind_by_name($que_pay, ':HPD_TOTAL_PRICE', $_POST['HPD_TOTAL_PRICE']);
			oci_bind_by_name($que_pay, ':HPD_DATE_PAY', $today);
			oci_bind_by_name($que_pay, ':HPD_ID', $_POST['HPD_ID']);
			if(!$r=oci_execute($que_pay)){echo "update error";}else{
				// echo $_POST['HPD_OVER_DATE'];
				// echo $_SESSION['id'];
				// echo $_POST['HPD_ID'];
					echo "<meta http-equiv='refresh' content='0;url=?HP_EDIT=".$_POST['HP_ID']."'>";
				// ,HPD_OVER_DATE_PRICE=:HPD_OVER_DATE_PRICE,HPD_TOTAL_PRICE=:HPD_TOTAL_PRICE,HPD_DATE_PAY=:HPD_DATE_PAY
			}
	}?>
<script type="text/javascript">

	function cal_elec() {
		var HP_ELEC_UNIT_R=document.getElementById("HP_ELEC_UNIT_R").value;
		var HP_ELEC_UNIT=document.getElementById("HP_ELEC_UNIT").value;
		console.log(HP_ELEC_UNIT_R*HP_ELEC_UNIT);
		document.getElementById("HS_ELECTRIC_PRICE").value=HP_ELEC_UNIT_R*HP_ELEC_UNIT;
		console.log(HP_ELEC_UNIT_R);
		console.log(HP_ELEC_UNIT);
		
	}
	function cal_wat() {
		console.log("HP_WATER_UNIT_R");
		var HP_WATER_UNIT_R=document.getElementById("HP_WATER_UNIT_R").value;
		var HP_WATER_UNIT=document.getElementById("HP_WATER_UNIT").value;
		var HS_WATER_PRICE=HP_WATER_UNIT_R*HP_WATER_UNIT;
		
		document.getElementById("HS_WATER_PRICE").value=HP_WATER_UNIT_R*HP_WATER_UNIT;
		console.log(HP_WATER_UNIT_R);
		console.log(HP_WATER_UNIT);
		console.log(HS_WATER_PRICE);
	}
	


</script>