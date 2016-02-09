<?php
	session_start();
	if(!isset($_SESSION['CustomerID'])){
		header( "location: /gobalchemicals/index.html" );
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

		<link href="css/profileDetail.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/profileEdit.js"></script>

	</head>
	<body>
			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">				
					<div id="tooplate_header">			
					  <div id="tooplate_top">
							<div id="tooplate_login">
		                       <form action="index.html" method="get">
		  							<a href="logOut.php"><input type="button" name="Search" value="" alt="Search" id="searchbutton" class="sub_btn"  /></a>
								</form>
							</div>
					  </div>						
						<div id="site_title"><h1><a href="indexCustomer.php">Gray Box</a></h1></div>
							<div id="tooplate_menu" class="ddsmoothmenu">
								<ul>
			                       <li><a href="profileDetail.php" class="selected">ข้อมูลส่วนตัว</a> </li>
						
									<li><a href="order.php">สั่งซื้อสินค้า</a></li>
									
									<li><a href="claim.php">แจ้งเคลมสินค้า</a></li>
								</ul>
							</div> <!-- end of tooplate_menu -->
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
					require 'dbManagement.php';
					$dbManagement = new dbManagement();
					$result = $dbManagement->select("SELECT * FROM customer 
														JOIN aumphur ON customer.AumphurID=aumphur.AumphurID
														JOIN province ON customer.ProvinceID=province.ProvinceID
														JOIN  district ON customer.DistrictID=district.DistrictID
														JOIN zipcode ON customer.ZipcodeID=zipcode.ZipcodeID
														where CustomerID='" . $_SESSION['CustomerID'] . "'");

					$province = $dbManagement->select("SELECT * FROM province ORDER BY ProvinceName");
					$ddprovince = 0;
					if (mysqli_num_rows($province) > 0) {
					    while($row = mysqli_fetch_assoc($province)) {
					    	$ProvinceID[$ddprovince] = $row["ProvinceID"];
					        $ProvinceName[$ddprovince] = $row["ProvinceName"];
					        $ddprovince++;
					    }
					   
					}

					$i = 0;
					if (mysqli_num_rows($result) > 0) {
					    while($row = mysqli_fetch_assoc($result)) {
					        $CustomerID[$i] = $row["CustomerID"];
					        $CustomerName[$i] = $row["CustomerName"];           
					        $CustomerAddress[$i] = $row["CustomerAddress"];
					       	$DistrictID[$i] = $row["DistrictID"];
					       	$DistrictName[$i] = $row["DistrictName"];
					        $ProvinceID[$i] = $row["ProvinceID"];
					        $ProvinceName[$i] = $row["ProvinceName"];
					        $ZipcodeID[$i] = $row["ZipcodeID"];
					        $Zipcode[$i] = $row["Zipcode"];
					        $CustomerTel[$i] = $row["CustomerTel"];
					        $CustomerFax[$i] = $row["CustomerFax"];
					        $CustomerEmail[$i] = $row["CustomerEmail"];
					        $AumphurID[$i] = $row["AumphurID"];
					        $AumphurName[$i] = $row["AumphurName"];
					        $i++;
					    }
					}
		?>

	<form action="editProfileSQL.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>แก้ไขข้อมูลส่วนตัว</h2>
                        <table id="table" style="width: 100%">
                        		<input type="hidden" id="txtCustomerID" name="txtCustomerID" value="<?php echo $CustomerID[0]; ?>">
                            <tr>
                                <td>ชื่อบริษัท :</td>
                                <td ><input id="txtCustomerName" name="txtCustomerName" value="<?php echo $CustomerName[0]; ?>"></td>
                            </tr>

                            <tr>
                                <td><span class="red-star">* </span>ที่อยู่ เลขที่:</td>
                                <td><input id="txtCustomerAddress" name="txtCustomerAddress" value="<?php echo $CustomerAddress[0]; ?>"> </td>
                            </tr>

                            <tr>
                                <td><span class="red-star">* </span>จังหวัด :</td>
                                <td>
                                	<select id="province" name="province" required>
                                	<option value="<?php echo $ProvinceID[0]; ?>" selected><?php echo $ProvinceName[0]; ?></option>
                                	<option value="" >------ เลือกจังหวัด ------</option>
                                	 	<?php
                        					for($j=0;$j<$ddprovince;$j++){ 
                        				?>	
                                		<option value="<?php echo $ProvinceID[$j]; ?>"><?php echo $ProvinceName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
								</td>
                            </tr>         

                            <tr id="district-row">
                                <td><span class="red-star">* </span>อำเภอ :</td>
                                <td><select id="txtDistrict" name="txtDistrict">  
                                	<option value="<?php echo $AumphurID[0]; ?>" selected><?php echo $AumphurName[0]; ?></option>                                                           
                                </select> 
                                </td>
                            </tr>

                            <tr id="subDistrict-row">
                                <td><span class="red-star">* </span>ตำบล :</td>
                                <td><select id="txtSubDistrict" name="txtSubDistrict">
                                	<option value="<?php echo $DistrictID[0]; ?>" selected><?php echo $DistrictName[0]; ?></option>
                                </select>
                                </td>
                            </tr>                            

                                                      
                            <tr id="zipcode-row">
                                <td><span class="red-star">* </span>รหัสไปรษณีย์ :</td>
                                <td><select type="text" id="txtZipcode" name="txtZipcode" >
                                	<option value="<?php echo $ZipcodeID[0]; ?>" selected><?php echo $Zipcode[0]; ?></option>
                                </select>
                                </td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td><span class="red-star">* </span>โทรศัพท์ :</td>
                                <td><input type="tel" id="txtCustomerTel" name="txtCustomerTel" value="<?php echo $CustomerTel[0]; ?>" required></td>
                            </tr>

                            <tr>
                                <td>Fax :</td>
                                <td><input type="tel"  id="txtCustomerFax" name="txtCustomerFax" value="<?php echo $CustomerFax[0]; ?>"></td>
                            </tr>

                            <tr>
                                <td><span class="red-star">* </span>Email :</td>
                                <td><input type="email" id="txtCustomerEmail" name="txtCustomerEmail" value="<?php echo $CustomerEmail[0]; ?>" required></td>
                            </tr>
                             <input type="hidden" id="txtUsername" name="txtUsername" value="<?php echo $CustomerUsername[0]; ?>">
                             <input type="hidden" id="txtPassword" name="txtPassword" value="<?php echo $CustomerPassword[0]; ?>">

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                    <td><a href="indexCustomer.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                    <td><button type="submit" id="btnCF">บันทึก</button></td>
                                    
                            </tr>

                        </table>
				</div>
			</div>
		</div><!--end of tooplate_main-->
	</form>
	
		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
	        
				<div class="col_w240">
						<h4>ติดต่อสอบถามรายละเอียดเพิ่มเติม</h4><br>
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
