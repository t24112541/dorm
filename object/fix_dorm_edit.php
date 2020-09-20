<?php if(isset($_GET['fix_dorm_edit'])){?>
<h2>รายการการซ่อมบำรุง</h2>

      <?php

        $que = oci_parse($conn, "SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE,$s_owner.FIX_ROOM,
        STAFF_DORM,$s_owner.DISBURSE_DETAIL,$s_owner.ACCESSORY_DORM where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID 
        AND FIX_ROOM.R_ID=ROOM_DORM.R_ID AND STAFF_DORM.S_ID=FIX_ROOM.S_ID 
        AND DISBURSE_DETAIL.F_ID=FIX_ROOM.F_ID AND ACCESSORY_DORM.A_ID=DISBURSE_DETAIL.A_ID AND FIX_ROOM.F_ID='".$_GET['fix_dorm_edit']."'");
      $r = oci_execute($que);
      $res = oci_fetch_array($que, OCI_ASSOC);
      // var_dump($row);
      ?>

<div class="col-sm-offset-2 col-sm-7" style="margin-top:20px;">
  <form class="form-horizontal box-content" method="POST" action="">
    <div class="form-group">
          <input type="hidden" name="HP_OUTOFDATE" id="HP_OUTOFDATE" value="<?php  echo $res['F_DATE'];?>">
          <input type="hidden" name="F_ID" id="F_ID" value="<?php  echo $res['F_ID'];?>">
      <label class="control-label col-sm-2" >พนักงาน:</label>
      <div class="col-sm-4">
        <?php echo $res['S_NAME']." ".$res['S_LNAME'];?>
      </div>
      <label class="control-label col-sm-2" >วันที่:</label>
      <div class="col-sm-4">
        <p id="sh_date"></p>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" >ห้อง:</label>
      <div class="col-sm-2">
        <?php echo $res['R_NAME'];?>
      </div>
      <label class="control-label col-sm-2" >อาคาร:</label>
      <div class="col-sm-2">
          <input type="hidden" name="B_ID" value=<?=$_GET['fix_dorm_edit']?>>
        <?php echo $res['B_NAME'];?>
      </div>
      <label class="control-label col-sm-2" >ที่ตั้ง:</label>
      <div class="col-sm-2">
        <?php echo $res['B_LOCATION'];?></textarea>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table">
        <tr>
          <td align="">รายการ</td>
          <td align="right">จำนวน</td>
        </tr>
        <tr>
          <td><?php echo $res['A_NAME'];?></td>
          <td align="right"><?php echo $res['D_AMOUNT'];?></td>
        </tr>
      </table>
    </div>

    <div class="form-group">
  
      <div class="<?php if(isset($_GET['b_edit'])){ echo 'col-sm-6';}else{echo 'col-sm-12';}?>" ><center>
        <a class="cv_btn btn_dan" onclick="return confirm('ลบจริงหรือไม่?')" href="?del_fix_dorm=<?php echo $res['F_ID']?>"><i class="fas fa-trash-alt fa-1x"></i> ลบ</a> </a>
      </div>
    </div>
  
  </form>
</div>
<?php }
  elseif(isset($_GET['fix_del'])){
    $que_d1=oci_parse($conn,"delete from $s_owner.FIX_ROOM where F_ID=:F_ID");
    oci_bind_by_name($que_d1, ':F_ID', $_POST['F_ID']);

    if(!$r=oci_execute($que_d1)){
      echo "delete error";
    }else{
      $q_2=oci_parse($conn,"delete from $s_owner.DISBURSE_DETAIL where F_ID=:F_ID");
      oci_bind_by_name($q_2, ':F_ID', $_POST['F_ID']);
      if(!$r2=oci_execute($q_2)){echo "delete error 2";}else{
        // echo "<meta http-equiv='refresh' content='0;url=?fix_dorm'>";
      }
    }
  }
?>
<script type="text/javascript">
  var months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม"];
  var m=document.getElementById("HP_OUTOFDATE").value;
  var str=m.split("-");
  var month=str[1];
  var year=parseInt(str[2])+543;
  document.getElementById("sh_date").innerHTML =str[0]+" "+months[month-1]+" "+year;
  console.log(months[month-1]);
</script>
