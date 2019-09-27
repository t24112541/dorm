
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Dorm</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!-- <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ผู้เช่า<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li> -->
        <li class="<?php if(isset($_GET['user_dorm'])){echo 'active';}?>"><a href="?user_dorm" >ผู้เช่า</a></li>
        <li class="<?php if(isset($_GET['manager_dorm'])){echo 'active';}?>"><a href="?manager_dorm" >ผู้จัดการ</a></li>
        <li class="<?php if(isset($_GET['staff_dorm'])){echo 'active';}?>"><a href="?staff_dorm" >พนักงาน</a></li>
        <li class="<?php if(isset($_GET['building_dorm'])){echo 'active';}?>"><a href="?building_dorm" >อาคาร</a></li>
        <li class="<?php if(isset($_GET['room_dorm'])){echo 'active';}?>"><a href="?room_dorm" >ห้อง</a></li>
        <li class="<?php if(isset($_GET['room_type'])){echo 'active';}?>"><a href="?room_type" >ประเภทห้อง</a></li>
        <li class="<?php if(isset($_GET['HIRE_USER'])){echo 'active';}?>"><a href="?HIRE_USER" >เช่าห้องพัก</a></li>
        <li class="<?php if(isset($_GET['HIRE_STAFF'])){echo 'active';}?>"><a href="?HIRE_STAFF" >จ้างพนักงาน</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="?get_out!" ><i class="fas fa-sign-out-alt " style="font-size:20px"></i> logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- 
<script type="text/javascript">
    $(document).ready(
     function(){
       $("a").click(function(){
         $("a").toggleClass("active");
       });
     }
   )
</script> -->