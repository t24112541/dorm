<?php session_start();
	include "./connect/connect.php";
	include "include_bootstrap.html";
 ?>
 <html lang="en">
<head>
	<title>Dorm manage</title>
  
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  
<?php 

 ?>
  <div class="container-fluid" style="margin-top:0">
    <div class="row">
<?php
if(isset($_SESSION['id'])&&$_SESSION['id']!=''&&isset($_SESSION['tel'])&&$_SESSION['tel']!=''){?>
<?php include "object/right_menu.php"; ?>
    	<div class="col-sm-1"></div>
    	<div class="col-sm-11" style="margin-top:50px">
    		<?php 
          if(isset($_GET['room_type']) || isset($_GET['rt_edit'])){include "./object/room_type.php";}
          else if(isset($_GET['building_dorm']) || isset($_GET['b_edit'])){include "./object/building_dorm.php";}
          else if(isset($_GET['room_dorm']) || isset($_GET['r_edit'])){include "./object/room_dorm.php";}
          else if(isset($_GET['staff_dorm']) || isset($_GET['s_edit']) || isset($_GET['S_DEL'])){include "./object/staff_dorm.php";}
          else if(isset($_GET['manager_dorm']) || isset($_GET['mng_edit']) || isset($_GET['S_DEL'])){include "./object/manager_dorm.php";}
          else if(isset($_GET['user_dorm']) || isset($_GET['u_edit']) || isset($_GET['U_DEL'])){include "./object/user_dorm.php";}
          else if(isset($_GET['HIRE_USER']) || isset($_GET['hire']) || isset($_GET['HU_EDIT']) || isset($_GET['txt_search'])){include "./object/HIRE_USER.php";}
          else if(isset($_GET['HIRE_STAFF'])  || isset($_GET['HS_EDIT'])){include "./object/HIRE_STAFF.php";}
          else if(isset($_GET['HIRE_PRICE_ADD']) || isset($_GET['HIRE_PRICE']) || isset($_GET['HP_EDIT'])){include "./object/HIRE_PRICE.php";}
          else if(isset($_GET['HIRE_STAFF_for_staff']) || isset($_GET['HS_EDIT_for_staff'])){include "./object/HIRE_STAFF_for_staff.php";}
          else if(isset($_GET['edit_profile'])){include "./object/profile.php";}
          else if(isset($_GET['fix_dorm'])){include "./object/fix_dorm.php";}
          else if(isset($_GET['fix_dorm_edit'])){include "./object/fix_dorm_edit.php";}
          elseif(isset($_GET['del_fix_dorm'])){
            $que=oci_parse($conn,"delete from $s_owner.FIX_ROOM where F_ID=".$_GET['del_fix_dorm']."");
            if(!$r=oci_execute($que)){echo "delete error";echo oci_error();}else{
              echo "<meta http-equiv='refresh' content='0;url=?fix_dorm'>";
            }
          }
          else{include "./object/room_dorm.php";}
    		 ?>
    	</div>
    <?php }
    else{include "./object/login.php";}

    if(isset($_GET['get_out!'])){
      session_destroy();
      echo "<meta http-equiv='refresh' content='0;url=?'>";
    }
?>
    </div>
  </div>


</body>
</html>
