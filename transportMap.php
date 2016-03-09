<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">
		<meta name="keywords" content="" />
		<meta name="description" content="" />

		<link href="css/transportMap.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script type="text/javascript" src="js/transportMap.js"></script>
		
		

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
			$destination =$_REQUEST['destination'];
			?>

		    <div id="map"></div>
		    	
		    		<div>
		    			<br>
		    				<input type="hidden" id="start" value="13.9220992,100.4680291">
		    			<br>
						    <select multiple id="waypoints" class="hide">
							    <?php
							    	foreach ($destination as $key => $value) {
							    ?>
						     		<option value="<?php echo $value; ?>" selected></option>
						    	<?php
						    	}
						    	?>
						    </select>
		    			<br>
		    				<input type="hidden" id="end" value="13.922157, 100.468176">
		   				<br>
		      				<input type="submit" id="submit" class="hide">
		      			<br>
		      			<br>		      				
		    		</div>	
		    	<label id="Distance">รวมระยะทางทั้งหมด :</label>
		    		<input id="totalDistance">
		      	<b>กิโลเมตร</b>

				<div id="directions-panel"></div>
	            <br>
	            <div id="btnCB">
	                <tr id="button-command">
	                    <td>
	                    	<a href="indexEmployee.php">
	                    	<button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button>
	                    	</a>
	                    </td>
	                    <td><button type="submit" id="btnCF" class="btn btn-success btn-md">บันทึกเส้นทาง</button></td>
	                                    
	                </tr>
	            </div>
		    <script>
		    	$( document ).ready(function() {	
					$( "#submit" ).trigger( "click" );
				});

			      function initMap() {
			        var directionsService = new google.maps.DirectionsService;
			        var directionsDisplay = new google.maps.DirectionsRenderer;
			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 13,
			          center: {lat: 13.7627284, lng: 100.5349091}
			        });
			        directionsDisplay.setMap(map);

			        document.getElementById('submit').addEventListener('click', function() {
			          calculateAndDisplayRoute(directionsService, directionsDisplay);
			        });
			      }

			      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
			        var waypts = [];
			        var checkboxArray = document.getElementById('waypoints');
			        for (var i = 0; i < checkboxArray.length; i++) {
			          if (checkboxArray.options[i].selected) {
			            waypts.push({
			              location: checkboxArray[i].value,
			              stopover: true
			            });
			          }
			        }
			        directionsService.route({
			          origin: document.getElementById('start').value,
			          destination: document.getElementById('end').value,
			          waypoints: waypts,
			          optimizeWaypoints: true,
			          travelMode: google.maps.TravelMode.DRIVING
			        }, function(response, status) {
			          if (status === google.maps.DirectionsStatus.OK) {
			            directionsDisplay.setDirections(response);
			            var route = response.routes[0];
			            var summaryPanel = document.getElementById('directions-panel');
			            summaryPanel.innerHTML = '';
			            var totalDistance = 0;
			            // For each route, display summary information.
			            for (var i = 0; i < route.legs.length; i++) {
			              var routeSegment = i + 1;
			              summaryPanel.innerHTML += '<br><b>ส่วนเส้นทางที่: ' + routeSegment +
			                  '</b><br>';
			              summaryPanel.innerHTML += '<b>จาก</b> '+route.legs[i].start_address + '<br><b> ถึง</b>';
			              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
			              summaryPanel.innerHTML += 'เป็นระยะทาง : '+route.legs[i].distance.text + '<br><br>';
			              ////////// here
			              totalDistance = totalDistance + parseFloat(route.legs[i].distance.text.replace('กม.',''));
			              $('#totalDistance').val(totalDistance);

			            }
			          } else {
			            window.alert('Directions request failed due to ' + status);
			          }
			        });
			      }


		    </script>

		    <script 
		    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8&callback=initMap&language=th">
		    </script>


			<div id="tooplate_footer_wrapper">
				<div id="tooplate_footer">
						Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
					<div class="cleaner"></div><!--end of tooplate_footer-->
				</div><!--end of tooplate_footer-->
			</div> <!--end of tooplate_footer_wrapper-->

	</body>
</html>
