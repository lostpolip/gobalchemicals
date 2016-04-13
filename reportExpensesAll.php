<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
?>

<script type="text/javascript">
	function myFunction() {
	    window.print();
	}
</script>

<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">
		<meta name="keywords" content="" />
		<meta name="description" content="" />

		<link href="css/reportAll.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/datatable.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/datatable.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/approveOrder.js"></script>
		<script type="text/javascript" src="js/chart.min.js"></script>
		<script type="text/javascript" src="js/reportExpensesAll.js"></script>
		
		

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
	<?php
	date_default_timezone_set('Asia/Bangkok');
	?>

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
											<li><a href="reportCar.php">รายงานการใช้รถบรรทุก</a></li>
											
									  </ul>
									</li>
								</ul>
							</div> <!-- end of tooplate_menu -->
						</div>
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<input type="hidden" id="OrderDate" value="<?php echo $OrderDate; ?>"></input>
		<input type="hidden" id="ExtendedPrice" value="<?php echo $ExtendedPrice; ?>"></input>

		<div id="tooplate_main">
				<td><label id="labelTittle">รายงานค่าใช้จ่ายค่าขนส่ง</label></td>
				<button style="	font-family: 'quarklight'; font-size: 20px;border-color: #2E2EFE;background-color: #5882FA;
					color: #fff;border-style: solid;height: 40px;width: 120px; margin-left: 400px; " onclick="myFunction()" >พิมพ์เอกสาร</button>
				<br>		
				<br>		
			    <tr>
			    	<td><label id="labelDate">วันที่ :</label></td>
                    <td><input type="date" id="startDate" name="startDate" max="<?php echo date("Y-m-d")?>"></td>
                    <td><label id="labelDate1">ถึง</label></td>
			    	<td><label id="labelDate1">วันที่ :</label></td> 
                    <td><input type="date" id="endDate" name="endDate" max="<?php echo date("Y-m-d")?>"></td>
                    <td><button type="button" id="btnView" class="btn btn-primary">view</button></td>
    			</tr>
    			<br>
			<canvas id="myChart" width="800" height="400"></canvas>
			<br>
			<br>
			<div id="total">
				<td><label style="font-size: 24px; margin-left: 370px; font-family: 'quarkbold';">รายได้จากค่าขนส่ง :</label>
					<label id="labelExpensesOrder" style="font-size: 22px;  font-family: 'quarklight'; color: #337ab7;"></label>
					<label style="font-size: 24px; font-family: 'quarkbold';">บาท</label>
				</td> 
				<br>
				<td><label style="font-size: 24px; margin-left: 370px; font-family: 'quarkbold';">ค่าใช้จ่ายการขนส่ง :</label>
					<label id="labelExpenses" style="font-size: 22px;  font-family: 'quarklight'; color: #337ab7;"></label>
					<label style="font-size: 24px; font-family: 'quarkbold';">บาท</label>
				</td>
				<br>
				<td><label style="font-size: 24px; margin-left: 370px; font-family: 'quarkbold';">กำไรจากค่าขนส่ง :</label>
					<label id="labelProfit" style="font-size: 22px;  font-family: 'quarklight'; color: #337ab7;"></label>
					<label style="font-size: 24px; font-family: 'quarkbold';">บาท</label>
				</td>
			</div>

			<br>
			<table id="table" style="display: none;"> 
				<caption>Optional table caption.</caption> 
					<thead> 
						<tr> 
							<th>#</th> 
							<th>วันที่</th> 
							<th>รายได้ค่าขนส่ง(ต่อวัน)</th> 
							<th>ค่าใช้จ่ายค่าขนส่ง(ต่อวัน)</th> 
							<th>กำไร(ต่อวัน)</th> 
						</tr> 
					</thead> 
				<tbody id="tablebody"> 
					
				</tbody> 
			</table>
			<br>
		</div><!--end of tooplate_main-->
 	

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
