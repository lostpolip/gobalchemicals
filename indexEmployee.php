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

		<link href="css/indexEmployee.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/indexEmployee.js"></script>


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

	<style>
		a.alert {
			display: inline-block;
			position: relative;
		    padding: 2px 0px 0 4px;
		}
		span.alert {
		    position: absolute;
		    padding: 1px;
		    top: 0px;
		    color: white;
		    background-color: red;
		    font-size: 12px;
		    border-radius: 25px;
		    height: auto;
		    width: auto;
		    left: 28px;
		    display: none;
		}
	</style>
	
	</head>
	<body>
			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">	
					<div id="tooplate_header">	
                    	<div id="tooplate_user">
							<label id="label1"><?php echo $_SESSION['EmployeeName']?> |&nbsp;</label>
                        </div>
                          <div id="imageMenuOrder" style="">

							<a href="approveClaim.php" class="alert">
								<input type="image" src="images/claim.png" alt="Submit" id="menu0rder">
								<span class="alert" id="txtClaim"></span>
							</a>
                            <a class="alert" href="approveOrder.php"><input type="image" src="images/order.png" alt="Submit" id="menu0rder">
                            	<span class="alert" id="txtOrder"></span>
                            </a>
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
												<li><a href="product.php">ข้อมูลสินค้า</a></li>
												<li><a href="supplier.php">ข้อมูลผู้จัดจำหน่าย</a></li>
												<li><a href="employee.php">ข้อมูลพนักงาน</a></li>
				                                <li><a href="truck.php">ข้อมูลรถ</a></li>
										</ul>
			                        </li>
									
									<li><a href="#">ตรวจสอบข้อมูล</a>
				                        <ul>
												<li><a href="investigateOrder.php">การสั่งซื้อสินค้า</a></li>
												<li><a href="claimList.php">การเคลมสินค้า</a></li>
												
										</ul>
			                        </li>
									
									<li><a href="#">คลังสินค้า</a>
										<ul>
											<li><a href="productReceive.php">รับสินค้า</a></li>
											<li><a href="productPurchase.php">สั่งสินค้า</a></li>
											<li><a href="productStock.php">เช็คสินค้า</a></li>
									  	</ul>
									</li>
									
									<li ><a href="#">ส่งสินค้า</a>
				                        <ul>
												<li ><a href="transport.php">จัดเส้นทาง</a></li>
												<li ><a href="billTransport.php">ใบส่งสินค้า</a></li>

										</ul>
			                        </li>
			                        
									<li ><a href="#">สรุปรายงาน</a>
			                            <ul>
											<li><a href="reportAll.php">รายงานรายได้</a></li>
											<li><a href="reportExpensesAll.php">รายงานค่าใช้จ่าย</a></li>
											
									  </ul>
									</li>
								</ul>
							</div> <!-- end of tooplate_menu -->
						</div>
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->
		<?php
			date_default_timezone_set('Asia/Bangkok');
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM product
											WHERE StateProduct ='Confirm'");

			$receive = $dbManagement->select("SELECT * FROM productreceive
											JOIN purchase ON productreceive.PurchaseID = purchase.PurchaseID
											WHERE StateReceive ='complete'
											ORDER BY ExpiryDate
											");

			$i = 0;
			$z =0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ProductID[$i] = $row["ProductID"];
			        $ProductName[$i] = $row["ProductName"];
			        $ProductAmount[$i] = $row["ProductAmount"];
			        $OrderPoints[$i] = $row["OrderPoints"];
			        if ($ProductAmount[$i] <= $OrderPoints[$i]) {
			        	$alertProduct[$z]	= [
			        		'name'	=> $ProductName[$i],
			        		'amount'	=> $ProductAmount[$i],
			        	];
			        	$z++;
			        }
			        
			        $i++;
			    }
			}

			$r = 0;
			$y = 0;
			$datenow = date('Y-m-d');

			if (mysqli_num_rows($receive) > 0) {
			    while($row = mysqli_fetch_assoc($receive)) {
			        $ProductPurchase[$r] = $row["ProductID"];
			        $PurchaseID[$r] = $row["PurchaseID"];
			        $ExpiryDate[$r] = $row["ExpiryDate"];
			        $Lot[$r] = $row["Lot"];
			        $ReceiveID[$r] = $row["ReceiveID"];

			        if ($ExpiryDate[$r] <= $datenow) {
			        	$alertLot[$y]	= [
			        		'lots'	=> $Lot[$r],
			        		'expirydate'	=> $ExpiryDate[$r],
			        		'purchase'	=> $PurchaseID[$r],
			        		'product'	=> $ProductPurchase[$r],
			        		'receiveid'	=> $ReceiveID[$r],
			        	];
			        	$y++;
			        }
			        
			        $r++;
			    }
			}



		?>
		<div id="tooplate_main">
			<div class="col_fw_last">
			
				<div class="col_w630 float_l">

				<?php 
					if ($z > 0) {
				?>
					<h2>แจ้งเตือนสินค้า</h2>
	    				<table id="table2" width="100%">
                        	<tr>
                                <th>ชื่อสินค้า</th>
                                <th>จำนวนสินค้า</th>    
                        	</tr>

                        	<?php
                        	for($j=0;$j<$z;$j++){ 

                        	?>

                        	<tr>
                        		<td>
                        			<label id="productName"><?php echo $alertProduct[$j]['name'] ?></label>
                        		</td>
                        		<td>
                        			<label id="productAmount" style="color: red;"><?php echo $alertProduct[$j]['amount'] ?></label>
                        		</td>
                        	</tr>
                        	<?php
                        	}
                        	?>
                    	</table> 
                <?php 
					}
				?>
		
				<?php 
					if ($y > 0) {
				?>    	 

					<h2>แจ้งเตือนสินค้าหมดอายุ</h2>
	    				<table id="table2" width="100%">
                        	<tr>
                                <th>Lot</th>
                                <th>วันหมดอายุ</th>    
                                <th>จำนวนสินค้าในคคลังของLot</th>    
                        	</tr>

                        	<?php
                        	for($l=0;$l<$y;$l++){ 

                        	?>

                        	<tr>
                        		<td>
                        			<label id="lot"><?php echo $alertLot[$l]['lots'] ?></label>
                        			<input type="hidden" id="receiveid" name="receiveID" value="<?php echo $alertLot[$l]['receiveid'] ?>">
                        		</td>
                        		<td>
                        			<label id="expiry" style="color: red;"><?php echo $alertLot[$l]['expirydate'] ?></label>
                        		</td>
                        		<td>
                        			<input type="hidden" id="productid" name="productID" value="<?php echo $alertLot[$l]['product'] ?>">
                        			<a href="receiveExpiry.php?receiveID=<?php echo $alertLot[$l]['receiveid']; ?>">
                        				<button type="submit" id="btnPurchase" name="btnPurchase">ตัดสต๊อก</button>
                        			</a>
                        		</td>
                        	</tr>
                        	<?php
                        	}
                        	?>
                    </table>
                <?php 
					}
				?>      


				</div>
				
			</div>
		</div><!--end of tooplate_main-->


		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
