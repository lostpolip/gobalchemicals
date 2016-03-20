<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">
		<meta name="keywords" content="" />
		<meta name="description" content="" />

		<link href="css/employeeAdd.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<!--<script type="text/javascript" src="js/index.js"></script>-->


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
					  <div id="tooplate_top">
							<div id="tooplate_login">
		                       <form action="index.html" method="get">
		                       	<a href="logOutBack.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
								</form>
							</div>
					  </div>						
						<div id="site_title"><h1><a href="indexEmployee.php">Gray Box</a></h1></div>
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
												<li><a href="#">การสั่งซื้อสินค้า</a></li>
												<li><a href="#">การเคลมสินค้า</a></li>
												
										</ul>
			                        </li>
									
									<li><a href="#">คลังสินค้า</a>
										<ul>
											<li><a href="#">รับสินค้า</a></li>
											<li><a href="#">สั่งสินค้า</a></li>
											<li><a href="#">เช็คสินค้า</a></li>
									  	</ul>
									</li>
									
									<li ><a href="#">ส่งสินค้า</a>
				                        <ul>
												<li ><a href="#">จัดเส้นทาง</a></li>
												<li ><a href="#">ใบส่งสินค้า</a></li>
												<li ><a href="#">ค่าใช้จ่าย</a></li>
										</ul>
			                        </li>
			                        
									<li ><a href="#">รายงาน</a>
			                            <ul>
											<li><a href="#">รายงานรายได้</a></li>
											<li><a href="#">รายงานค่าใช้จ่าย</a></li>
											
									  </ul>
									</li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->



	<form action="test2.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>เพิ่มพนักงาน</h2>
                       
                        <table id="table" style="width: 100%">
                        	<tr>
                                <td><label>ชื่อผู้ใช้งาน:</label></td>
                                <td><input type="text" id="txtUsername" name="txtUsername" placeholder="สำหรับเป็น Login" required > </td>
                            </tr>

                            <tr>
                                <td><label>รหัสผ่าน:</label></td>
                                <td><input type="password" id="txtPassword" name="txtPassword" placeholder="a-z หรือ A-Z หรือ 0-9" required ></td>
                            </tr>
                            <tr> <td>&nbsp;</td></tr>

                                <td ><input type="hidden" id="txtEmployeeID" name="txtEmployeeID"></input></td>
                             <tr>
                                <td><label>ชื่อพนักงาน :</label></td>
                                <td><input type="text" id="txtEmployeeName" name="txtEmployeeName"></td>
                            </tr>

                            <tr>
                                <td><label>ตำแหน่ง:</label></td>
                                <td>
                                	<select id="position" name="positionEmployee">
											  <option value="" >------ กรุณาเลือก ------</option>
										      <option value="พนักงานขับรถ">พนักงานขับรถ</option>
										      <option value="พนักงานบัญชี">พนักงานบัญชี</option>
									</select> 
                                </td>
                            </tr>

                            <tr>
                                <td><label>ที่อยู่ เลขที่ :</label></td>
                                <td><input type="text" id="txtEmployeeAddress" name="txtEmployeeAddress"></td>
                            </tr>
                            <tr>
                                <td><label>อำเภอ :</label></td>
                                <td><input type="text" id="txtEmployeeDistrict" name="txtEmployeeDistrict"></td>
                            </tr>
                            <tr>
                                <td><label>จังหวัด :</label></td>                       
                                <td><select id="txtEmployeeProvince" name="txtEmployeeProvince">
                                	 	<option value="" selected>------ เลือกจังหวัด ------</option>
                                	 	<?php
                        					for($j=0;$j<$i;$j++){ 
                        				?>	
                                		<option value="<?php echo $ProvinceName[$j]; ?>"><?php echo $ProvinceName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
                                	</select>
                                </td>
                         

                            </tr>


							<tr>
                                <td><label>รหัสไปรษณีย์ :</label></td>
                                <td>
                                	<input type="text" id="txtEmployeeZipcode" name="txtEmployeeZipcode">
                                </td>

                            </tr> 
                            <tr>
                                <td><label>เบอร์โทรศัพท์ :</label></td>
                                <td>
                                	<input type="tel" id="txtEmployeeTel" name="txtEmployeeTel">
                                </td>
                            </tr>
                            
                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                    <td><button type="submit" id="bTNCF">บันทึก</button></td>
                                    <td><button id="btnBack"><a href="employee.php">กลับไปหน้าหลัก</a></button></td>
                            </tr>

                        </table>
				</div>
			</div>
		</div><!--end of tooplate_main-->
	</form>	

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
	        
				<div class="col_w240">
						<h4>ติดต่อสอบถามรายละเอียดเพิ่มเติม</h4>
					<ul class="footer_link">
						<li>สถานที่ติดต่อ :&nbsp; 87/84&nbsp; หมู่ 2&nbsp; ตำบลบางพลับ&nbsp; อำเภอปากเกร็ด&nbsp; จังหวัดนนทบุรี&nbsp; 11120</li>
						<li>โทรศัพท์ : (668) 188-9525-0&nbsp;&nbsp; Fax : (662) 554-300</li>
						<li>Email : nantiyathongpriwan@gmail.com</li>
					</ul>
				</div>
			
				
				<div class="cleaner h40"></div>
					Copyright © 2016 <a href="#">The GobalChemicals CO.,LTD.</a>
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->

	
	</body>
</html>
