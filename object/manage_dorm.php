
<?php
// include "../connect/connect.php";
$que = oci_parse($conn, 'SELECT * FROM manager_dorm');
	$r = oci_execute($que);
	?>
	<table>
		<tr>
			<td>ชื่อ-นามสกุล</td>
			<td>เพศ</td>
			<td>โทรศัพท์</td>
		</tr>


	<?php
	while (($row = oci_fetch_array($que, OCI_ASSOC))) {var_dump($row);?>
		<tr>
			<td><?=$row['mng_name']." ".$row['mng_lname'];?></td>
			<td><?=$row['mng_gender'];?></td>
			<td><?=$row['mng_tel'];?></td>
		</tr>    
		 
	<?php }
	?>
	</table>