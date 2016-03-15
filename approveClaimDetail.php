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

		<link href="css/approveClaimDetail.css" rel="stylesheet" type="text/css" />
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

							<a href="approveClaim.php"><input type="image" src="images/order.png" alt="Submit" id="menu0rder"></a>
                            <a href="approveOrder.php"><input type="image" src="images/claim.png" alt="Submit" id="menu0rder"></a>
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
												<li ><a href="#">ใบส่งสินค้า</a></li>
												<li ><a href="expensiveRoutting.php">ค่าใช้จ่าย</a></li>
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
			date_default_timezone_set('Asia/Bangkok');
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM `claimdetail`  
											JOIN product ON claimdetail.ProductID=product.ProductID 
											JOIN claim ON claimdetail.ClaimID=claim.ClaimID
											WHERE claim.ClaimID='".$_REQUEST['ClaimID']."'
											");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ClaimID[$i] = $row["ClaimID"];
			        $ClaimDate[$i] = $row["ClaimDate"];
			        $ProductID[$i] = $row["ProductID"];
			        $ProductName[$i] = $row["ProductName"];
			        $ClaimAmount[$i] = $row["ClaimAmount"];
			        $StateClaim[$i] = $row["StateClaim"];
			        $ClaimSendDate[$i] = $row["ClaimSendDate"];
			        $OrderID[$i] = $row["OrderID"];
			        $i++;
			    }
			}

		?>
	<form action="approveAddStateSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#approveOrder" aria-controls="home" role="tab" data-toggle="tab">รายการการเคลมสินค้า</a></li>
					  </ul>
					  <input type="hidden" id="claimId" name="claimId" value="<?php echo $ClaimID[0]; ?>">
					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active">
					    	<br>
					    	<table id="table2" width="100%">


		                        	<tr>
		                        		<th>วันที่</th>
		                        		<th>เลขที่ใบสั่งซื้อ</th>
		                        		<th>รหัสสินค้า</th>
		                                <th>ชื่อสินค้า</th>
		                                <th>จำนวนแจ้งเคลม(ถุง)</th>
		                                
		                        	</tr>

					    			<?php
								    	$claimIdAll = '';
			                       		$totalUnit = '';
					                        for($j=0;$j<$i;$j++){ 
					                        if ($j == 0) {
			                       				$claimIdAll = $claimIdAll.$ProductID[$j];
			                       				$totalUnit = $totalUnit.$ClaimAmount[$j];
			                        		} else {
			                        			$claimIdAll = $claimIdAll.','.$ProductID[$j];
			                        			$totalUnit = $totalUnit.','.$ClaimAmount[$j];
			                        		}
					                ?>	

		                        	<tr>
		                        		<td id="date"><?php echo $ClaimDate[$j]; ?></td>
		                        		<td id="orderid"><?php echo $OrderID[$j]; ?></td>
		                        		<td id="productid"><?php echo $ProductID[$j]; ?></td>
		                        		<td id="productname"><?php echo $ProductName[$j]; ?></td>
		                        		<td id="productamount"><?php echo $ClaimAmount[$j]; ?></td>
		                        	</tr>
		                        	<?php
		                        		}
		                    		?> 

		                    		<input type="hidden" name="claimIdAll" value="<?php echo $claimIdAll; ?>"></input>                          
                        			<input type="hidden" name="totalUnit" value="<?php echo $totalUnit; ?>"></input>

							</table> 
					    </div><!--- แจ้งซื้อสินค้า -->
                    	<div>
                			<table id="table4">
                				<tr>
                					<td><a href="approveClaim.php"><button type="button" id="btnBack" class="btn btn-danger">กลับไปหน้าหลัก</button></a>
                					
                					&nbsp;&nbsp;&nbsp;&nbsp;
                					<button type="submit" id="btnCF" class="btn btn-success">ยืนยันการแจ้งเคลม</button>
                					</td>
                				</tr>
                			</table>
						</div>
                    </div>
				</div>	  
			</div>	
		</div><!--end of tooplate_main-->
 	</form>	

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
