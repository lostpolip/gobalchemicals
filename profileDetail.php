<?php
	session_start();
	if(!isset($_SESSION['CustomerName'])){
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
		<script type="text/javascript" src="js/index.js"></script>

	</head>
	<body>
			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">				
					<div id="tooplate_header">	
                    	<div id="tooplate_user">
							<label id="label1"><?php echo $_SESSION['CustomerName']?> |&nbsp;</label>
                        </div>							
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

									<li><a href="orderList.php">รายการสั่งซื้อ</a></li>
									
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

	<!-- <form action="editProfileSQL.php">		 -->
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

						<h2>ข้อมูลส่วนตัว</h2>
                        <p>
                            <a href="profileEdit.php?CustomerID=<?php echo $CustomerID[0]; ?>"><button type="button" id="btnEdit">แก้ไขข้อมูล</button></a>
                                </p>
                        <table id="table" style="width: 100%">


                            <tr>
                                <td>ชื่อบริษัท :</td>
                                <td>
                                	<Label id="Label1"><?php echo $CustomerName[0];?></Label>
                                </td>
                            </tr>

                            <tr>
                                <td>ที่อยู่ เลขที่:</td>
                                <td>
                                    <Label id="Label2"><?php echo $CustomerAddress[0];?></Label>
                                </td>
                            </tr>

                            <tr>
                                <td>ตำบล :</td>
                                <td>
                                    <Label id="Label9"><?php echo $DistrictName[0];?></Label>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>อำเภอ :</td>
                                <td>
                                    <Label id="Label3"><?php echo $AumphurName[0];?></Label>
                                </td>
                            </tr>

                            <tr>
                                <td>จังหวัด :</td>
                                <td>
                                    <Label id="Label4"><?php echo $ProvinceName[0];?></Label>
                                </td>
                            </tr>

                            <tr>
                                <td>รหัสไปรษณีย์ :</td>
                                <td>
                                    <Label id="Label5"><?php echo $Zipcode[0];?></Label>
                                </td>
                            </tr>

                            <tr>
                                <td>โทรศัพท์ :</td>
                                <td><Label id="Label6"><?php echo $CustomerTel[0];?></Label></td>
                            </tr>

                            <tr>
                                 <td>Fax :</td>
                                <td><Label id="Label7"><?php echo $CustomerFax[0];?></Label></td>
                            </tr>

                            <tr>
                                 <td>Email :</td>
                                <td><Label id="Label8"><?php echo $CustomerEmail[0];?></Label></td>
                            </tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                    <td><a href="indexCustomer.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                            </tr>
                            
                        </table>
				</div>
			</div>
		</div><!--end of tooplate_main-->
	<!-- </form>	 -->

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
