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
    	<div class="col-sm-3"></div>
    	<div class="col-sm-9" style="margin-top:50px">
    		<?php 
    			if(isset($_GET['room_type']) || isset($_GET['rt_edit'])){include "./object/room_type.php";}
          else if(isset($_GET['mount_student'])){include "./object/mount_student.php";}
          
          
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
