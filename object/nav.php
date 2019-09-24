
<nav class="navbar navbar-cv navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="?home">CPM OFC</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="<?php 
        if(isset($_GET['home']) || isset($_GET['btn_add_report_broken']) || isset($_GET['btn_show_report_broken'])||isset($_GET['btn_edit_report_broken'])){echo 'active';}
        ?>"><a href="?home">รายงานเหตุเสีย OFC</a></li>
        <li class="<?php if(isset($_GET['cpm_link']) || isset($_GET['btn_edit_cpm_link'])){echo 'active';} ?>"><a href="?cpm_link">เส้นทาง</a></li>
        <li class="<?php if(isset($_GET['cpm_cause']) || isset($_GET['btn_edit_cpm_cause'])){echo 'active';} ?>"><a href="?cpm_cause">สาเหตุการเสีย</a></li>
      </ul>
      <form class="navbar-form navbar-left" method="POST" action="">
          <div class="form-group">s
            <input type="text" class="form-control" name="text_search" placeholder="ค้นหา">
            <button style="padding:9px;margin" type="submit" name="btn_search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
          </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
        <li><a href="?logout"><span class="glyphicon glyphicon-log-in"></span> ออกจากระบบ</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php if(isset($_GET['logout'])){session_destroy();echo "<meta http-equiv='refresh' content='0;url=?'>";} ?>

