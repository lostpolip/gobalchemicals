<!-- <?php
header('Access-Control-Request-Headers: x-requested-with');
?> -->
<!DOCTYPE html>
<html>

	<head>
       
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">

		<link href="css/register.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
        <script type="text/javascript" src="js/register.js"></script>


	</head>
	<body>
			<div id="tooplate_body_wrapper">
				<div id="tooplate_wrapper">				
					<div id="tooplate_header">			
					  <div id="tooplate_top"></div>						
						<div id="site_title"><h1><a href="index.html">Gray Box</a></h1></div>
					</div> <!-- end of tooplate_header -->
				</div><!--end of tooplate_wrapper-->
		</div><!--end of tooplate_body_wrapper-->

		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$result = $dbManagement->select("SELECT * FROM province ORDER BY ProvinceName");
			$i = 0;
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
			    	$ProvinceID[$i] = $row["ProvinceID"];
			        $ProvinceName[$i] = $row["ProvinceName"];
			        $i++;
    		    }			   
			}

		?>

	<form id="registerAddForm" action="registerAdd.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>ข้อมูลส่วนตัว</h2>
                        <table id="table" style="width: 100%">
                        	<tr>
                                <td><label><span class="red-star">* </span>ชื่อผู้ใช้งาน :</label></td>
                                <td>
                                    <input type="text" id="txtUsername" name="txtUsername"placeholder="สำหรับเป็น Login" required></td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>รหัสผ่าน:</label></td>
                                <td><input type="password" id="txtPassword" name="txtPassword" placeholder="a-z หรือ A-Z หรือ 0-9" ></td>
                            </tr>
          
                            <tr> <td>&nbsp;</td></tr>  
<!--                             <tr>
                                <td><label>รหัสลูกค้า :</label></td>
                                <td><input id="txtCustomerID" name="txtCustomerID"></td>
                            </tr> -->
                            <tr>
                                <td><label>ชื่อบริษัท :</label></td>
                                <td><input id="txtName" name="txtName"required></td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ที่อยู่ เลขที่:</label></td>
                                <td><input type="text" id="txtAddress" name="txtAddress" required></td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>จังหวัด :</label></td>
                                <td>
                                	<select id="province" name="province" required>
                                	<option value="" selected>------ เลือกจังหวัด ------</option>
                                	 	<?php
                        					for($j=0;$j<$i;$j++){ 
                        				?>	
                                		<option value="<?php echo $ProvinceID[$j]; ?>"><?php echo $ProvinceName[$j]; ?></option>
                                		<?php
                        					}
                        				?>
									</select> 
								</td>
                            </tr>         

                            <tr id="district-row">
                                <td><label><span class="red-star">* </span>อำเภอ :</label></td>
                                <td><select id="txtDistrict" name="txtDistrict">                                                              
                                </select> 
                                </td>
                            </tr>

                            <tr id="subDistrict-row">
                                <td><label><span class="red-star">* </span>ตำบล :</label></td>
                                <td><select id="txtSubDistrict" name="txtSubDistrict">
                                </select>
                                </td>
                            </tr>                            

                                                      
                            <tr id="zipcode-row">
                                <td><label><span class="red-star">* </span>รหัสไปรษณีย์ :</label></td>
                                <td><select type="text" id="txtZipcode" name="txtZipcode" >
                                </select>
                                </td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>โทรศัพท์ :</label></td>
                                <td><input type="tel" id="txtTel" name="txtTel" required></td>
                            </tr>

                            <tr>
                                <td><label>Fax :</label></td>
                                <td><input type="tel"  id="txtFax" name="txtFax"></td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>Email :</label></td>
                                <td><input type="email" id="txtEmail" name="txtEmail" required></td>
                            </tr>

                            <tr> <td><input type="hidden" id="txtLatitude" name="txtLatitude" ></td></tr>

                            <tr> <td><input type="hidden" id="txtLongitude" name="txtLongitude" ></td></tr>

                            <tr> <td><input type="hidden" id="txtDistance" name="txtDistance" ></td></tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>

                            <tr>
                                     <td><a href="index.html"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                     <td><button type="button" id="btnCF">บันทึก</button></td>
                                   
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
