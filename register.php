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
        <!-- <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>  -->


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

        <style type="text/css">  

            /* css กำหนดความกว้าง ความสูงของแผนที่ */  
            #map_canvas {   
                width:550px;  
                height:400px;  
                margin-left:60px;  
            }  
            h4{
                margin-left: 220px;
            }
            </style>  

	<form id="registerAddForm" action="registerAdd.php">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">

					<h2>ข้อมูลส่วนตัว</h2>

                            <h4>กรุณาลากไปยังตำแหน่งของคุณ</h4>
                            <div id="map_canvas"></div>     
                                    <input type="hidden" name="lat_value" type="text" id="lat_value" value="0" />  <br />    
                                    <input type="hidden" name="lon_value" type="text" id="lon_value" value="0" />  <br />  


                        <table id="table" style="width: 100%">
                        	<tr>
                                <td><label><span class="red-star">* </span>ชื่อผู้ใช้งาน :</label></td>
                                <td>
                                    <input type="text" id="txtUsername" name="txtUsername"placeholder="สำหรับเป็น Login" ></td>
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
                                <td><input id="txtName" name="txtName"></td>
                            </tr>

                            <tr>
                                <td><label><span class="red-star">* </span>ที่อยู่ เลขที่:</label></td>
                                <td><input type="text" id="txtAddress" name="txtAddress" ></td>
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

                            <tr> <td><input type="hidden" id="txtDistance" name="txtDistance" ></td></tr>

                            <tr> <td>&nbsp;</td></tr>
                            <tr> <td>&nbsp;</td></tr>
    
                            <tr>
                                     <td><a href="index.html"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                                     <td><button type="button" id="btnCF" disabled>บันทึก</button></td>
                                   
                            </tr>
                            </div>   
                        </table>
				
                            
                            <script type="text/javascript">  
                            var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้  
                            var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น  
                            function initialize() { // ฟังก์ชันแสดงแผนที่  
                                GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM  
                                // กำหนดจุดเริ่มต้นของแผนที่  
                                var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);  
                                var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง  
                                // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas  
                                var my_DivObj=$("#map_canvas")[0];   
                                // กำหนด Option ของแผนที่  
                                var myOptions = {  
                                    zoom: 13, // กำหนดขนาดการ zoom  
                                    center: my_Latlng , // กำหนดจุดกึ่งกลาง  
                                    mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่  
                                };  
                                map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map  
                                  
                                var my_Marker = new GGM.Marker({ // สร้างตัว marker  
                                    position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง  
                                    map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map  
                                    draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้  
                                    title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ  
                                });  
                                  
                                // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร  
                                GGM.event.addListener(my_Marker, 'dragend', function() {  
                                    var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย  
                                    map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker         
                                    $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value  
                                    $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value   
                                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value  
                                });       
                              
                                // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom  
                                GGM.event.addListener(map, 'zoom_changed', function() {  
                                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value    
                                });  
                              
                            }  
                            $(function(){  
                                // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว  
                                // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api  
                                // v=3.2&sensor=false&language=th&callback=initialize  
                                //  v เวอร์ชัน่ 3.2  
                                //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false  
                                //  language ภาษา th ,en เป็นต้น  
                                //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize  
                                $("<script/>", {  
                                  "type": "text/javascript",  
                                  src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"  
                                }).appendTo("body");      
                            });  
                            </script>    

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
