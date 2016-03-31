<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
	
	if (!($_SESSION['PositionID'] == 2 || $_SESSION['PositionID'] == 1)) {
		header( "location: /gobalchemicals/permission.php" );

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
		<script type="text/javascript" src="js/approveClaim.js"></script>
		
		

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
												<li><a href="paymentCustomer.php">การชำระเงิน</a></li>
												
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
			$result = $dbManagement->select("SELECT * FROM  claim  
											JOIN customer ON claim.CustomerID=customer.CustomerID
											JOIN claimdetail ON claim.ClaimID=claimdetail.ClaimID
											WHERE StateClaim='Processing'		
											");


			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			        $ClaimID[$i] = $row["ClaimID"];
			        $ClaimDate[$i] = $row["ClaimDate"];
			        $CustomerID[$i] = $row["CustomerID"];
			        $CustomerName[$i] = $row["CustomerName"];
			        $StateClaim[$i] = $row["StateClaim"];
			        $ClaimSendDate[$i] = $row["ClaimSendDate"];
			        $OrderID[$i] = $row["OrderID"];
			        $i++;
			    }
			}
		?>
	<form action="approveAddDateSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					 <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#approveClaim" aria-controls="profile" role="tab" data-toggle="tab">แจ้งการเคลม</a></li> 
					  </ul>
					    <div role="tabpanel" class="tab-pane" id="approveClaim">
					    	<br>
					    	<?php
		                        for($j=0;$j<$i;$j++){ 
		                    ?>	
					    	<table id="table2" width="100%">
					    		<label id="labelDate"><span id="claimDD">วันทีสั่งซื้อ :&nbsp;&nbsp;</span><?php echo $ClaimDate[$j]; ?></label>&nbsp;&nbsp;
					    		<label id="labelCM"><span id="claimDD">รหัสการเคลมสินค้า:&nbsp;&nbsp;</span><?php echo trim($ClaimID[$j]); ?></label>
					    		<input type="hidden" id="claimid" name="claimid" value="<?php echo $ClaimID[$j]; ?>">
								
		                        	<tr>
		                        		<th>ชื่อลูกค้า</th>
		                                <th>กำหนดวันที่ส่ง</th>
		                                <th>สถานะ</th>
		                                <th>ยืนยันการเคลม</th>
		                                
		                                
		                        	</tr>
		                        	<tr>

		                        		<td id="customername"><?php echo $CustomerName[$j]; ?></td>
		                        		<td>
		                        			<input type="date" id="claimDate" name="claimDate" min="<?php echo date('Y-m-d');?>" <?php if ($ClaimSendDate[$j]!='0000-00-00') { echo 'disabled';} ?> value="<?php echo $ClaimSendDate[$j]; ?>">

		                        			<button type="submit" id="btnSet" <?php if ($ClaimSendDate[$j]!='0000-00-00') { echo 'disabled';} ?> >กำหนด</button>
		                        		</td>

		                        		<td><label id="stateid"><?php echo $StateClaim[$j]; ?></label>
		                        		</td>
		                        		
		                        		<td>
		                        			<button type="submit" id="btnDetail"><a href="approveClaimDetail.php?ClaimID=<?php echo $ClaimID[$j]; ?> ">เลือก</a></button>
		                        		</td>

		                        			<input type="hidden" id="hiddenOrderId" name="hiddenOrderId" value="<?php echo $OrderID[$j]; ?>">
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
 </form>	

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
