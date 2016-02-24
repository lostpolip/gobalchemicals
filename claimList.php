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

		<link href="css/claimList.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>


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

						<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary btn-lg" id="menuAlert" data-toggle="modal" data-target="#myModal">
							</button>
						<!-- Button trigger modal -->

						<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">รายการสั่งซื้อ</h4>
							      </div>
							      <div class="modal-body">

             						 <table  class="table table-bordred table-striped">
             						 	<thead>
				                        		<th>ชื่อสินค้า</th>
				                                <th>จำนวนคงเหลือ</th>
							                    <th>สั่งซื้อ</th>
										</thead>
	   									<tbody id="showOrder">
											    <td><label></label></td>
											    <td><label></label></td>
											    <td>
											    		<a href="productPurchaseAdd.php"><button class="btnAlert" data-title="delete" data-toggle="modal" data-target="#delete" >สั่งซื้อสินค้า</button>
											    	
											    </td>
											</tr>
										</tbody>
        							</table>

							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">กลับไปหน้าแรก</button>
							        
							      </div>
							    </div>
							  </div>
							</div>
						<!-- Modal -->

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
			$result = $dbManagement->select("SELECT * FROM claim
											JOIN product ON claim.ProductID=product.ProductID
											JOIN customer on claim.CustomerID=customer.CustomerID
											WHERE StateClaim = 'confirm'
											");

			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$ClaimID[$i] = $row["ClaimID"];
			        $ClaimDate[$i] = $row["ClaimDate"]; 
			        $ClaimAmount[$i] = $row["ClaimAmount"]; 
			        $ProductID[$i] = $row["ProductID"]; 
			        $ProductName[$i] = $row["ProductName"]; 
			        $CustomerID[$i] = $row["CustomerID"]; 
			        $CustomerName[$i] = $row["CustomerName"];
			        $ClaimDetail[$i] = $row["ClaimDetail"];
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
					    <li role="presentation" class="active"><a href="#approveOrder" aria-controls="home" role="tab" data-toggle="tab">รายการการเคลมสินค้า</a></li>
					  </ul>

					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane active">
					    	<br>

					    	<table id="table2" width="100%">


		                        	<tr>
		                        		<th>เลขที่ใบเคลม</th>
		                        		<th>วันที่แจ้งเคลม</th>
		                        		<th>ชื่อลูกค้า</th>
		                        		<th>ชื่อสินค้า</th>
		                                <th>จำนวน(ถุง)</th>
		                                <th>วันจัดส่ง</th>
		                                <th>รายละเอียด</th>
		                        	</tr>

					    			<?php
		                        		for($j=0;$j<$i;$j++){ 
		                   			 ?>	

		                        	<tr>
		                        		<td id="claimid"><?php echo $ClaimID[$j]; ?></td>
		                        		<td id="claimdate"><?php echo $ClaimDate[$j]; ?></td>
		                        		<td id="customername"><?php echo $CustomerName[$j]; ?></td>
		                        		<td id="productname"><?php echo $ProductName[$j]; ?></td>
		                        		<td id="claimamount"><?php echo $ClaimAmount[$j]; ?></td>
		                        		<td id="claimdetail"><?php echo $ClaimSendDate[$j]; ?></td>
		                        		<td id="claimdetail"><?php echo $ClaimDetail[$j]; ?></td>
		                        	</tr>
		                        	<?php
		                        		}
		                    		?>        
							</table> 
					    </div><!--- แจ้งซื้อสินค้า -->
                    </div>
				</div>
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