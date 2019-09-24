<?php
if(isset($_SESSION['db_status'])&&$_SESSION['db_status']=="main_db_fail"){
		$arr = json_decode(file_get_contents('./db/db_main.txt'), true)  or die("Unable to open file!");
		$host=$arr['host'];
		$username=$arr['username'];
		$password=$arr['password'];
		$sid=$arr['sid'];
		$port=$arr['port'];
		if(isset($_POST['db_save']) &&$_POST['host']!='' &&$_POST['port']!='' &&$_POST['sid']!='' &&$_POST['username']!='' ){
			$arr = array('host'=> $_POST['host'] ,'username'=> $_POST['username'],'password'=> $_POST['password'],'sid'=>$_POST['sid'],'port'=>$_POST['port'] );
			file_put_contents('./db/db_main.txt',  json_encode($arr).PHP_EOL);
			session_destroy();
			echo "<meta http-equiv='refresh' content='0;url=?'>";
		}
?>
		<div class="col-sm-12">
		<form class="form-horizontal box-content" method="POST" action="">
	      	<h3>database setup</h3>
			<div style="">

			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Username">host name/ip address:</label>
			    <div class="col-sm-10">
			      	<input type="text" class="form-control" name="host" placeholder="Enter host name/ip address" value="<?php echo $host ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Password">port:</label>
			    <div class="col-sm-10"> 
			      <input type="text" class="form-control" name="port" placeholder="Enter port" value="<?php echo $port ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Password">sid:</label>
			    <div class="col-sm-10"> 
			      <input type="text" class="form-control" name="sid" placeholder="Enter database" value="<?php echo $sid ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Password">username:</label>
			    <div class="col-sm-10"> 
			      <input type="text" class="form-control" name="username" placeholder="Enter username" value="<?php echo $username ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Password">password:</label>
			    <div class="col-sm-10"> 
			      <input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $password ?>">
			    </div>
			  </div>
			 <div class="form-group">
			    
			    <div class="col-sm-12 "> 
			      <p align="center" class="cv_important" id="war"></p>
			    </div>
			  </div>
			  <div class="form-group" style="text-align: center;"> 
			    <div class="col-sm-12">
			      <button type="submit" name="db_save" class="cv_btn btn-ok">บันทึกการเปลี่ยนแปลง</button>
			    </div>
			  </div>
			  <?php if(isset($_GET['saved'])): ?>
			  <div  class="form-group" style="text-align: center;font-size: 64px;color:#4c9e33">
			  	<span id="update_ok"  class="glyphicon glyphicon-ok-circle"></span>
			  </div>
			<?php endif ?>
			</div>
		</form>
	</div>	
<?php } else{?>

	<div class="view" style="height:100%;background-image: url('./img/blue-apartments-over-white-background-vector-1494231.png');">
            <!-- Mask & flexbox options-->
            <div style="height:100%" class="mask rgba-gradient align-items-center">
              <!-- Content -->
              
                <!--Grid row-->
                <div class="row">
                  <!--Grid column-->
                  <div style="color:#fff" class="col-md-6 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
                    <h1 class="h1-responsive font-weight-bold mt-sm-5">ระบบบริหารจัดการหอพัก </h1>
                    <hr class="hr-light">
                    <h6 class="font_size-sm">ระบบบริหารจัดการข้อมูลผู้เข้าพัก หอพักจันทร์เจ้า </h6>
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  
                    <div class="col-sm-4 col-lg-4" style="padding-top:2%">
						<form class="form-horizontal box-content" style="height: 80%;" method="POST" action="">
							
							<div style="padding-top: 10%">
								<div class="form-group" align="center" style="">
								    <i class="fas fa-user fa-6x"></i>
								</div>
								  <div class="form-group">
								    <label class="control-label col-sm-4" >รหัสประชาชน:</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" name="id" placeholder="รหัสประชาชน" value="123456">
								    </div>
								  </div>
								  <div class="form-group">
								    <label class="control-label col-sm-4" >เบอร์โทรศัพท์:</label>
								    <div class="col-sm-8"> 
								      <input type="password" class="form-control" name="tel" placeholder="เบอร์โทรศัพท์" value="123456">
								    </div>
								  </div>
								 <div class="form-group">
								    
								    <div class="col-sm-12 "> 
								      <p align="center" class="cv_important" id="war"></p>
								    </div>
								  </div>
								  <div class="form-group" style="text-align: center;padding-top:10%"> 
								    <div class="col-sm-12">
								      <button type="submit" class="cv_btn btn-ok">เข้าสู่ระบบ <i class="fas fa-sign-in-alt fa-1x"></i></button>
								    </div>
								  </div>
							</div>
						</form>
					</div>

                </div>
                <!--Grid row-->
           
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>

<?php }
if(isset($_POST['id']) && $_POST['id']!='' && isset($_POST['tel']) && $_POST['tel']!=''){

	$que=oci_parse($conn,"select * from MANAGER_DORM where MNG_ID=:id and MNG_TEL=:tel");
	oci_bind_by_name($que, ':id', $_POST['id']);
	oci_bind_by_name($que, ':tel', $_POST['tel']);
	$r = oci_execute($que);
	$num_chk=oci_fetch_all($que, $out);

	if($num_chk==1){
		$_SESSION['id']=$_POST['id'];
		$_SESSION['tel']=$_POST['tel'];
		echo "<meta http-equiv=\"refresh\" content=\"0;url=?db\">";
	}else{?>
		<script type="text/javascript">
			document.getElementById("war").innerHTML ="โปรดตรวจสอบ รหัสประชาชน หรือ เบอร์โทรศัพท์!";
		</script>
	<?php }

}
?>