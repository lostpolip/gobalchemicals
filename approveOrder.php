<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">
		<meta name="keywords" content="" />
		<meta name="description" content="" />

		<link href="css/approveOrder.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/approveOrder.js"></script>
		
		

		<script language="javascript" type="text/javascript">
		function clearText(field)
		{
			if (field.defaultValue == field.value) field.value = '';
			else if (field.value == '') field.value = field.defaultValue;
		}
	</script>

	<script type="text/javascript">

		ddsmoothmenu.init({
			mainmenuid: "tooplate_menu", //menu DIV id
			orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu', //class added to menu's outer DIV
			//customtheme: ["#1c5a80", "#18374a"],
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})

	</script>


	</head>
	<body>

			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">
					<div id="tooplate_header">	
                    	<div id="tooplate_user">
							<label id="label1"><?php echo $_SESSION['EmployeeName']?> |&nbsp;</label>
                        </div>
                        <div id="imageMenuOrder">
                        	<input type="image" src="images/order.png" alt="Submit" id="menu0rder">
                            <input type="image" src="images/claim.png" alt="Submit" id="menu0rder">
                        </div>

					  <div id="tooplate_top">
							<div id="tooplate_login">
						  		<a href="logOutBack.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
							</div>
					  </div>						
						<div id="site_title"><h1><a href="indexEmployee.php">Gray Box</a></h1>
							<div id="tooplate_menu" class="ddsmoothmenu">
								<ul >
									<li><a href="#">จัดการข้อมูล</a>
				                        <ul>
												<li><a href="product.php" >ข้อมูลสินค้า</a></li>
												<li><a href="supplier.php">ข้อมูลผู้จัดจำหน่าย</a></li>
												<li><a href="employee.php">ข้อมูลพนักงาน</a></li>
				                                <li><a href="truck.php">ข้อมูลรถ</a></li>
										</ul>
			                        </li>
									
<!-- 									<li><a href="#">ตรวจสอบข้อมูล</a>
				                        <ul>
												<li><a href="#">การสั่งซื้อสินค้า</a></li>
												<li><a href="#">การเคลมสินค้า</a></li>
												
										</ul>
			                        </li> -->
									
									<li><a href="#">คลังสินค้า</a>
										<ul>
											<li><a href="productReceive.php">รับสินค้า</a></li>
											<li><a href="productPurchase.php">สั่งสินค้า</a></li>
											<li><a href="productStock.php">เช็คสินค้า</a></li>
									  	</ul>
									</li>
									
									<li ><a href="#">ส่งสินค้า</a>
				                        <ul>
												<li ><a href="#">จัดเส้นทาง</a></li>
												<li ><a href="#">ใบส่งสินค้า</a></li>
												<li ><a href="#">ค่าใช้จ่าย</a></li>
										</ul>
			                        </li>
			                        
									<li ><a href="#">สรุปรายงาน</a>
			                            <ul>
											<li><a href="#">รายงานรายได้</a></li>
											<li><a href="#">รายงานค่าใช้จ่าย</a></li>
											
									  </ul>
									</li>
								</ul>
							</div> <!-- end of tooplate_menu -->
						</div>
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM  claim
												JOIN product ON claim.ProductID=product.ProductID
												JOIN customer ON claim.CustomerID=customer.CustomerID");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ClaimID[$i] = $row["ClaimID"];
			        $ClaimDate[$i] = $row["ClaimDate"];
			        $OrderID[$i] = $row["OrderID"];
			        $CustomerID[$i] = $row["CustomerID"];
			        $CustomerName[$i] = $row["CustomerName"];
			        $ProductID[$i] = $row["ProductID"];
			        $ProductName[$i] = $row["ProductName"];
			        $ClaimAmount[$i] = $row["ClaimAmount"];
			        $ClaimSendDate[$i] = $row["ClaimSendDate"];
			        $i++;
			    }
			}
		?>
	
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					 <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#approveOrder" aria-controls="home" role="tab" data-toggle="tab">แจ้งการสั่งซื้อ</a></li>
					    <li role="presentation"><a href="#approveClaim" aria-controls="profile" role="tab" data-toggle="tab">แจ้งการเคลม</a></li> 
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="approveOrder">
					    	<br>

					    	<table id="table2" width="100%">
					    		<label id="labelDate"><span id="claimDD">วันที่ :&nbsp;&nbsp;</span></label>&nbsp;&nbsp;
					    		<label id="labelID"><span id="claimDD">รหัสการสั่งซื้อ :&nbsp;&nbsp;</span></label>

		                        	<tr>
		                        		<th>รหัสสินค้า</th>
		                                <th>ชื่อสินค้า</th>
		                                <th>ชื่อลูกค้า</th>
		                                <th>จำนวน</th>
		                                <th>รวมทั้งสิ้น</th>
		                                <th>คำสั่ง</th>
		                                
		                        	</tr>

		                        	<tr>
		                        		<td id=""></td>
		                        		<td id=""></td>
		                        		<td id=""></td>
		                        		<td id=""></td>
		                        		<td id=""></td>
		                        		<td>

		                        			<a href="#"><button id="btnDetail">รายละเอียด</button></a>
											<button id="btnApprove">อนุมัติ</button>
											<button id="btnNonApprove">ไม่อนุมัติ</button>

		                        		</td>
		                        	</tr>
							</table> 


					    </div><!--- แจ้งซื้อสินค้า -->

					    <div role="tabpanel" class="tab-pane" id="approveClaim">
					    	<br>
					    	<?php
		                        for($j=0;$j<$i;$j++){ 
		                    ?>	
					    	<table id="table2" width="100%">
					    		<label id="labelDate"><span id="claimDD">วันที่ :&nbsp;&nbsp;</span><?php echo $ClaimDate[$j] ?></label>&nbsp;&nbsp;
					    		<span id="claimDD">รหัสการเคลมสินค้า:&nbsp;&nbsp;</span><input id="dateCM" name="dateCM" value="<?php echo $ClaimID[$j] ?>">

		                        	<tr>
		                        		<th>รหัสใบสั่งซื้อ</th>
		                        		<th>ชื่อลูกค้า</th>
		                                <th>ชื่อสินค้า</th>
		                                <th>จำนวน</th>
		                                <th>กำหนดวันที่ส่ง</th>
		                                <th>กำหนด</th>
		                                <th>คำสั่ง</th>
		                                
		                        	</tr>
		                        	<tr>

		                        		<td id="orderid"><?php echo $OrderID[$j] ?></td>
		                        		<td id="customername"><?php echo $CustomerName[$j] ?></td>
		                        		<td id="productname"><?php echo $ProductName[$j] ?></td>
		                        		<td id="claimamount"><?php echo $ClaimAmount[$j] ?>&nbsp;&nbsp;ถุง</td>
		                        		<form action="approveAddSQL.php">
		                        		<td id="claimdate">
			                        		<input type="date" id="claimDate" name="claimDate" >

		                        		</td>
		                        		</form>
		                        		<td><button type="button" id="btnDate" ><a href="approveAddSQL.php?$ClaimID=<?php echo $ClaimID[$j]; ?>">กำหนด</a></button></td>
		                        		<td>
		                        			<button type="button" id="btnEmail" ><a href="testmailClaim.php?ClaimID=<?php echo $ClaimID[$j] ?>CustomerID=<?php echo $CustomerID[$j] ?> ">ยืนยันการแจ้ง</a></button>
		                        			<!-- <button id="btnDelete">ลบ</button> -->
		                        		</td>
		                        	</tr>
							</table>
						 
							<?php
		                        }
		                    ?>        
					    </div>
					</div>
				</div>
			</div>	
		</div><!--end of tooplate_main-->
	

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
