
<?php
if($_SESSION['status']=='MNG'){?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="?room_dorm">Dorm</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

        <li class="<?php if(isset($_GET['HIRE_USER'])){echo 'active';}?>"><a href="?HIRE_USER">ข้อมูลการเช่าห้องพัก</a></li>
        <li  class="<?php if(isset($_GET['fix_dorm'])){echo 'active';}?>"><a href="?fix_dorm">ข้อมูลการซ่อมบำรุง</a></li>

        <li class="dropdown <?php if(isset($_GET['HIRE_PRICE_ADD']) || isset($_GET['HIRE_PRICE']) || isset($_GET['HP_EDIT'])){echo 'active';}?>">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-file-invoice-dollar"></i> ค่าเช่า<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['HIRE_PRICE_ADD'])){echo 'active';}?>" ><a href="?HIRE_PRICE_ADD"><i class="fas fa-file-invoice-dollar"></i> ออกใบเสร็จค่าเช่า</a></li>
            <li class="<?php if(isset($_GET['HIRE_PRICE']) || isset($_GET['HP_EDIT'])){echo 'active';}?>"><a href="?HIRE_PRICE">ดูใบเสร็จ</a></li>
          </ul>
        </li>
        <li class="dropdown <?php if(isset($_GET['building_dorm']) || isset($_GET['room_dorm']) || isset($_GET['room_type'])){echo 'active';}?>">
          <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fas fa-hotel"></i> ห้อง<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['building_dorm'])){echo 'active';}?>"><a href="?building_dorm">อาคาร</a></li>
            <li class="<?php if(isset($_GET['room_dorm'])){echo 'active';}?>"><a href="?room_dorm">ห้อง</a></li>
            <li class="<?php if(isset($_GET['room_type'])){echo 'active';}?>"><a href="?room_type" >ประเภทห้อง</a></li>
          </ul>
        </li>
        <li class="dropdown <?php if(isset($_GET['manager_dorm']) || isset($_GET['staff_dorm']) || isset($_GET['HIRE_STAFF']) || isset($_GET['user_dorm'])){echo 'active';}?>">
          <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fas fa-users"></i> ผู้คน<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['manager_dorm'])){echo 'active';}?>"><a href="?manager_dorm" >ผู้จัดการ</a></li>
            <li class="<?php if(isset($_GET['staff_dorm'])){echo 'active';}?>"><a href="?staff_dorm" >พนักงาน</a></li>
            <li class="<?php if(isset($_GET['HIRE_STAFF'])){echo 'active';}?>"><a href="?HIRE_STAFF" >จ่ายค่าจ้างพนักงาน</a></li>
            <li class="<?php if(isset($_GET['user_dorm'])){echo 'active';}?>"><a href="?user_dorm" >ผู้เช่า</a></li>
          </ul>
        </li>

      </ul>

      <ul class="nav navbar-nav navbar-right"><i class="fas fa-user-edit"></i>
         <li class="dropdown <?php if(isset($_GET['manager_dorm']) || isset($_GET['staff_dorm']) || isset($_GET['HIRE_STAFF']) || isset($_GET['user_dorm'])){echo 'active';}?>">
          <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['name']?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['edit_profile'])){echo 'active';}?>"><a href="?edit_profile=<?php echo $_SESSION['id']?>"> <i class="fas fa-user-edit fa-1x"></i> แก้ไขข้อมูล</a></li>
            <li class="<?php if(isset($_GET['get_out'])){echo 'active';}?>"><a href="?get_out!" ><i class="fas fa-sign-out-alt fa-1x"></i> ออกจากระบบ</a></li>
          </ul>
        </li>

        <!-- <li><a href="?get_out!" ><i class="fas fa-sign-out-alt " style="font-size:20px"></i> ออกจากระบบ</a></li> -->
      </ul>
    </div>
  </div>
</nav>
<?php }
elseif($_SESSION['status']=='STAFF'){?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="?room_dorm">Dorm</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="<?php if(isset($_GET['HIRE_USER'])){echo 'active';}?>"><a href="?HIRE_USER">ข้อมูลการเช่าห้องพัก</a></li>
        <li class="dropdown <?php if(isset($_GET['HIRE_PRICE_ADD']) || isset($_GET['HIRE_PRICE']) || isset($_GET['HP_EDIT'])){echo 'active';}?>">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-file-invoice-dollar"></i> ค่าเช่า<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['HIRE_PRICE_ADD'])){echo 'active';}?>" ><a href="?HIRE_PRICE_ADD"><i class="fas fa-file-invoice-dollar"></i> ออกใบเสร็จค่าเช่า</a></li>
            <li class="<?php if(isset($_GET['HIRE_PRICE']) || isset($_GET['HP_EDIT'])){echo 'active';}?>"><a href="?HIRE_PRICE">ดูใบเสร็จ</a></li>
          </ul>
        </li>
        <li class="dropdown <?php if(isset($_GET['building_dorm']) || isset($_GET['room_dorm']) || isset($_GET['room_type'])){echo 'active';}?>">
          <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fas fa-hotel"></i> ห้อง<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['building_dorm'])){echo 'active';}?>"><a href="?building_dorm">อาคาร</a></li>
            <li class="<?php if(isset($_GET['room_dorm'])){echo 'active';}?>"><a href="?room_dorm">ห้อง</a></li>
            <li class="<?php if(isset($_GET['room_type'])){echo 'active';}?>"><a href="?room_type" >ประเภทห้อง</a></li>
          </ul>
        </li>
        <li class="dropdown <?php if(isset($_GET['manager_dorm']) || isset($_GET['staff_dorm']) || isset($_GET['HIRE_STAFF']) || isset($_GET['user_dorm'])){echo 'active';}?>">
          <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fas fa-users"></i> ผู้คน<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['user_dorm'])){echo 'active';}?>"><a href="?user_dorm" >ผู้เช่า</a></li>
          </ul>
        </li>

      </ul>
      <ul class="nav navbar-nav navbar-right"><i class="fas fa-user-edit"></i>
         <li class="dropdown <?php if(isset($_GET['manager_dorm']) || isset($_GET['staff_dorm']) || isset($_GET['HIRE_STAFF']) || isset($_GET['user_dorm'])){echo 'active';}?>">
          <a class="dropdown-toggle " data-toggle="dropdown" href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['name']?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="<?php if(isset($_GET['edit_profile'])){echo 'active';}?>"><a href="?edit_profile=<?php echo $_SESSION['id']?>"> <i class="fas fa-user-edit fa-1x"></i> แก้ไขข้อมูล</a></li>
            <li><a href="?HIRE_STAFF_for_staff" ><i class="fas fa-money-bill-wave-alt " style="font-size:20px"></i> ยืนยันการรับเงิน</a></li>
            <li class="<?php if(isset($_GET['get_out'])){echo 'active';}?>"><a href="?get_out!" ><i class="fas fa-sign-out-alt fa-1x"></i> ออกจากระบบ</a></li>
          </ul>
        </li>

        <!-- <li><a href="?get_out!" ><i class="fas fa-sign-out-alt " style="font-size:20px"></i> ออกจากระบบ</a></li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
      </ul>
    </div>
  </div>
</nav>
<?php }?>