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

		<link href="css/expensiveRoutting.css" rel="stylesheet" type="text/css" />
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
									<li><a href="#" class="selected">จัดการข้อมูล</a>
				                        <ul>
												<li><a href="product.php" >ข้อมูลสินค้า</a></li>
												<li><a href="supplier.php">ข้อมูลผู้จัดจำหน่าย</a></li>
												<li><a href="employee.php">ข้อมูลพนักงาน</a></li>
				                                <li><a href="truck.php">ข้อมูลรถ</a></li>
										</ul>
			                        </li>
									
									<li><a href="#">ตรวจสอบข้อมูล</a>
				                        <ul>
												<li><a href="#">การสั่งซื้อสินค้า</a></li>
												<li><a href="#">การเคลมสินค้า</a></li>
												
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

		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<p>จัดเส้นทาง</p>
	           
                        <table id="table" style="width: 100%">
                                <input type="hidden" id="txtExpensiveID" name="txtExpensiveID">
							<tr>
                                <td><label id="date">ชื่อผู้จัดจำหน่าย:</label></td>
                                <td><input type="date" id="txtExpensiveDate" name="txtExpensiveDate" ></td>
                            

                          
                               
                               	<td>   <!-- Button trigger modal -->
										<button type="button" class="btn btn-primary btn-lg" id="addPr" data-toggle="modal" data-target="#myModal">เลือกใบส่งสินค้า</button>
									<!-- Button trigger modal -->

									<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										        <h4 class="modal-title" id="myModalLabel">ใบส่งสินค้า</h4>
										      </div>
										      <div class="modal-body">

			             						 <table  class="table table-bordred table-striped">
							                        	<tr>
							                        		<th>รหัสใบส่งสินค้า</th>
							                                <th>วันที่จัดเส้นทาง</th>
							                                <th>จำนวนระยะทาง</th>
							                                <th>เลือก</th>
							                                
							                        	</tr>

							                        	<tbody id="showOrder">
										                    <tr>    	
															    <td><label></label></td>
															    <td><label></label></td>
															    <td><label></label></td>
															    <td>
															    		<button class="btnAlert" data-title="delete" data-toggle="modal" type="submit" class="btn btn-default">เลือก</button>
															    	
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
								</td>	
                            </tr>
                        </table>    
 
                            <tr>
					    	<table id="table2" width="100%">

		                        	<tr>
		                        		<th>เส้นทางการขนส่ง</th>
		                        		<th>ระยะทาง(กม.)</th>
		                                <th>เชื้อเพลิง(ลิตร)</th>
		                                <th>อัตราสิ้นเปลือง</th>
		                                <th>เป็นเงิน(บาท)</th>
		                                
		                        	</tr>
		                        	<tr>
		                        		
		                        		<td id="expensiveid"></td>
		                        		<td id="expensive"></td>
		                        		<td id="expensive"></td>
		                        		<td id="expensive"></td>
		                        		<td id="expensiveprice"></td>
		                        	</tr>
							</table>
                            </tr>
                        <p>ค่าใช้จ่ายต่างๆ</p>    
                        <table id="table" style="width: 100%">

                            <tr>
                                <td><label>ค่าเที่ยวรถ:</label></td>
                           
                                <td><input id="txtExpensive" name="txtExpensive" required>
                               		</input>
								</td>
                            </tr>

							<tr>
                                <td><label>ค่าผ่านทาง :</label></td>
                                <td>
                                	<input type="text" id="txtExpensive" name="txtExpensive" required>
                                </td>
                            </tr>

                            <tr>
                                <td><label>ค่าต่อเนื่องผู้ติดตาม :</label></td>
                                <td>
                                	<input type="tel" id="txtExpensive" name="txtExpensive" required>
                                </td>
                            </tr>

                            <tr>
                                <td><label>ค่าอื่นๆ :</label></td>
                                <td>
                                	<input type="email" id="txtExpensive" name="txtExpensive" >
                                </td>
                            </tr>

                            <tr> <td><label>รวมค่าเชื้อเพลิง :</label></td></tr>
                            <tr> <td><label>รวมค่าใช้จ่ายในการดำเนินการ :</label></td></tr>
                            <tr> <td><label>สรุปค่าใช้จ่าย :</label></td></tr>
                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

	                            <tr id="button-command">
	                            		<td><button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button></td>
	                                    <td><button type="submit" id="btnCF" class="btn btn-success btn-md">สร้างเส้นทาง</button></td>
	                                    
	                            </tr>

                        </table>
	                        
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
