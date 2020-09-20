
<h2>รายการการซ่อมบำรุง</h2>
  <p>แสดงรายการการซ่อมบำรุงทั้งหมด</p>
  <form method="POST">
			<div class="input-group">
				    <input type="text" class="form-control" name="txt_search" placeholder="หาชื่อห้องสิไอเวร">
				    <div class="input-group-btn">
				      <button class="btn btn-default" type="submit" name="btn_search">
				        <i class="glyphicon glyphicon-search" style="padding:3px"></i>
				      </button>
				    </div>
			</div>
		</form>
  <a class="cv_btn btn-ok" href="?fix_dorm_add">เพิ่มข้อมูล</a>
      <?php
      if(isset($_POST['btn_search'])&& $_POST['txt_search']!=" "){
        $que = oci_parse($conn, "SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE,$s_owner.FIX_ROOM,
        STAFF_DORM,$s_owner.DISBURSE_DETAIL,$s_owner.ACCESSORY_DORM where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID 
        AND FIX_ROOM.R_ID=ROOM_DORM.R_ID AND STAFF_DORM.S_ID=FIX_ROOM.S_ID 
        AND DISBURSE_DETAIL.F_ID=FIX_ROOM.F_ID AND ACCESSORY_DORM.A_ID=DISBURSE_DETAIL.A_ID AND R_NAME like '%".$_POST['txt_search']."%'");
      }else{
        $que = oci_parse($conn, "SELECT * FROM ROOM_DORM,BUILDING_DORM,ROOM_TYPE,$s_owner.FIX_ROOM,
        STAFF_DORM,$s_owner.DISBURSE_DETAIL,$s_owner.ACCESSORY_DORM where ROOM_DORM.RT_ID=ROOM_TYPE.RT_ID AND ROOM_DORM.B_ID=BUILDING_DORM.B_ID 
        AND FIX_ROOM.R_ID=ROOM_DORM.R_ID AND STAFF_DORM.S_ID=FIX_ROOM.S_ID 
        AND DISBURSE_DETAIL.F_ID=FIX_ROOM.F_ID AND ACCESSORY_DORM.A_ID=DISBURSE_DETAIL.A_ID");
      }
      $r = oci_execute($que);
      ?>
<table class="table table-hover">
    <thead>
           <tr>
                <th>วันที่</th>
                <th>อาคาร</th>
                <th>ห้อง</th>
                <th>พนักงาน</th>
           </tr>
    </thead>
    <tbody>
      <?php
        while (($row = oci_fetch_array($que, OCI_ASSOC))) {?>
            <tr>
                <td><?php echo $row['F_DATE'];?></td>
                <td><?php echo $row['B_NAME'];?></td>
                <td><?php echo $row['R_NAME'];?></td>
                <td><?php echo $row['S_NAME'];?></td>
                <td><a class="cv_btn btn-war" href="?fix_dorm_edit=<?php echo $row['F_ID'];?>">ดู</a></td>
                <!-- <td><a class="cv_btn btn-dan" href="?del_fix_dorm&&table=FIX_DORM&&col=F_ID&&id=<?php echo $row['F_ID'];?>">ลบ</a></td> -->
            </tr>
      <?php }
    ?>
    </tbody>
</table>
