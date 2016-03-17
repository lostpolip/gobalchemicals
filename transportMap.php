<?php
	session_start();
	if(!isset($_SESSION['EmployeeName'])){
		header( "location: /gobalchemicals/indexLogin.html" );
	}
	if (!($_SESSION['PositionID'] == 4 || $_SESSION['PositionID'] == 1)) {
		header( "location: /gobalchemicals/permission.php" );

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
				$order = '';
				foreach ($destination as $key => $value) {
					$destinationLatlng[$key] = explode('&',$value);
					$order[$key] = $destinationLatlng[$key][1];
				}
				$order = implode(',', $order);
				$date =$_REQUEST['txtDateTransport'];
				$totalWeight=$_REQUEST['txtWeightProduct'];
				$truck=$_REQUEST['hiddenTruckID'];
				$employee=$_REQUEST['ddEmployee'];
				$routeTime=$_REQUEST['rdoDate'];

				require 'dbManagement.php';
				$dbManagement = new dbManagement();			
				$Truck = $dbManagement->select("SELECT * FROM truck
													WHERE TruckID= ".$_REQUEST['hiddenTruckID']."
													");

				if (mysqli_num_rows($Truck) > 0) {
				    while($row = mysqli_fetch_assoc($Truck)) {
				        $TruckID = $row["TruckID"];
				        $ConsumptionFuel = $row["ConsumptionFuel"];
				        $FuelID = $row["FuelID"];
				        $TruckCost = $row["TruckCost"];
				        $ResidualValue = $row["ResidualValue"];
				    }
				   
				}
				
			?>
			<?php 
				$jsonDestination = json_encode($_REQUEST['destination']);
				$jsonDestination = str_replace('"',"'",$jsonDestination);
				$jsonDestination = str_replace('[',"",$jsonDestination);
				$jsonDestination = str_replace(']',"",$jsonDestination);
				$jsonDestination = str_replace("','","+",$jsonDestination);
				$jsonDestination = str_replace("'","",$jsonDestination);
			?>
			<input id="arrayDestination" type="hidden" value="<?php echo $jsonDestination; ?>"></input>
		    <div id="map"></div>
		    	
		    		<div>
		    			<br>
		    				<input type="hidden" id="start" value="13.922174, 100.468186">
		    			<br>
						    <select multiple id="waypoints" class="hide">
							    <?php
							    	foreach ($destinationLatlng as $key => $value) {
							    ?>
						     		<option value="<?php echo $value[0]; ?>" selected></option>
						    	<?php
						    	}
						    	?>
						    </select>
		    			<br>
		    				<input type="hidden" id="end" value="13.922208, 100.468212">
		   				<br>
		      				<input type="button" id="submit" class="hide">

		      			<br>
		      			<br>		      				
		    		</div>	
		    	<label id="Distance">รวมระยะทางทั้งหมด :</label>
		    		<input id="totalDistance" readonly>
		      	<b>กิโลเมตร</b>
			
				<div id="directions-panel"></div>

	 			<form action="expensiveAddSQL.php">
					<input type="hidden" id="transportId" name="transportId" value="0">
					<input type="hidden" id="consumptionExp" name="consumptionExp" value="<?php echo $ConsumptionFuel ?>">
					<input type="hidden" id="truckCost" name="truckCost" value="<?php echo $TruckCost ?>">
					<input type="hidden" id="residualValue" name="residualValue" value="<?php echo $ResidualValue ?>">
		            <br>
		            
			            <div class="expensive">
			              	<p>ค่าใช้จ่ายต่างๆ</p> 
		                        <table id="table" style="width: 100%">

		                            <tr>
		                                <td><label id="fuelId">ชนิดน้ำมัน:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $FuelID ?></label></td>
										
		                            </tr>

		                            <tr>
		                                <td><label>ค่าน้ำมันเชื้อเพลิง:</label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<input type="text" id="FuelExpensive" name="FuelExpensive" value="0" required>
		                               		 &nbsp;&nbsp;<label>บาท/ลิตร</label>
		                               		
										</td>
		                            </tr>

									<tr>
		                                <td><label>ระยะเวลาค่าเสื่อมราคา :</label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                               		<input type="text" id="ConsumptionExp" name="ConsumptionExp" value="0" required>
		                                	&nbsp;&nbsp;<label>ปี</label>
		                                </td>
		                            </tr>

		                            <tr>
		                                <td><label>ค่าแรงงาน(ต่อคน) :</label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<input type="text" id="LaborExpensive" name="LaborExpensive" value="0" required>
		                                	<label>บาท/วัน</label>
		                                </td>
		                            </tr>

		                            <tr>
		                                <td><label>จำนวนพนักงาน :</label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<input type="text" id="AmountExployee" name="AmountExployee" value="0" required>
		                                	&nbsp;&nbsp;<label>คน</label>
		                                </td>
		                            </tr>

		                            <tr>
		                                <td><label>ค่าซ่อมบำรุง :</label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<input type="text" id="MaintenanceExp" name="MaintenanceExp" value="0" required>
		                                	&nbsp;&nbsp;<label>บาท/กิโลเมตร</label>
		                                </td>
		                            </tr>

		                          	<tr>
		                                <td><label>จำนวนวันทำงานต่อเดือน :</label>&nbsp;&nbsp;
		                                	<input type="text" id="AmountDate" name="AmountDate" value="0" required>
		                                	&nbsp;&nbsp;<label>วัน</label>
		                                </td>
		                            </tr>	

		                            <tr>
		                                <td><label>ระยะทางที่วิ่ง :</label>
		                                	&nbsp;&nbsp;&nbsp;&nbsp;
		                                	<label label id="labelDistance"></label>
		                                	&nbsp;&nbsp;<label>กิโลเมตร</label> 

		                                </td>
		                            </tr> 
		                            <br>
		                            <tr>
		                            	<td><button type="button" id="btnCalculator" name="calculator" class="btn btn-primary" >คำนวณ</button></td>
		                            </tr>                           	                            
								</table>
							</div>
							<br>
							<br>
	                        <div class="Fixedcosts">
	                        	<p>ต้นทุนคงที่</p>
	                        	 <table id="table" style="width: 100%">
		                            <tr> 
		                            	<td><label>ค่าเสื่อมราคา :</label>
		                            		<label id="DepreciationDay"></label>
		                            		<label>(บาท/วัน)</label>
		                            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                            	</td>
		                            </tr>
		                            <tr> 
		                            	<td><label>ค่าแรงงาน :</label>
		                            		<label id="LoborExpDay"></label>
		                            		<label>(บาท/วัน)</label>
		                            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                            	</td>
		                            </tr>
		                            <tr> 
		                            	<td><label>ต้นทุนคงที่ต่อวัน :</label>
		                            		<label id="FixedcostsDay"></label>
		                            		<label>(บาท/วัน)</label>
		                            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                            	</td>
		                            </tr>
		                            <tr> 
		                            	<td><label>ต้นทุนคงที่ต่อรอบ :</label>
		                            		<label id="FixedcostsAround"></label>
		                            		<label>(บาท/รอบ)</label>
		                            	</td>
		                            </tr>
		                            <tr> <td>&nbsp;</td></tr>
	                            </table>
	                        </div>

	                        <div class="Variablecosts">
	                        	<p>ต้นทุนผันแปร</p>
	                        	 <table id="table" style="width: 100%">
		                            <tr> 
		                            	<td><label>ค่าน้ำมันเชื้อเพลิง :</label>
		                            		<label id="FuelCost"></label>
		                            		<label>(บาท/กม.)</label>
		                            	</td>
		                            </tr>
		                            <tr> 
		                            	<td><label>ค่าซ่อมบำรุง :</label>
		                            		<label id="MaintenanceCost"></label>
		                            		<label>(บาท/กม.)</label>
		                            	</td>
		                            </tr>
		                            <tr> 
		                            	<td><label>ค่าใช้จ่ายแปรผันรวมต่อกิโลเมตร :</label>
		                            		<label id="ExpensesAllKm"></label>
		                            		<label>(บาท/กม.)</label>
		                            	</td>
		                            </tr>

		                            <tr> <td>&nbsp;</td></tr>
	                            </table>
	                        </div>   

			                <div class="ExpensesAll">
	                        	<p>ค่าใช้จ่าย</p>
	                        	 <table id="table" style="width: 100%">
		                            <tr> 
		                            	<td><label>ค่าใช้จ่ายรวมต่อวัน :</label>&nbsp;&nbsp;&nbsp;
		                            		<label id="ExpensesPerDay"></label>
		                            		<input type="hidden" id="hiddenExpensesPerDay" name="hiddenExpensesPerDay" value="0" >
		                            		<label>บาท</label>
		                            	</td>
		                            </tr>
		                            <tr> 
		                            	<td><label>ค่าใช้จ่ายรวมต่อรอบ :</label>
		                            		<label id="ExpensesPerAround"></label>
		                            		<input type="hidden" id="hiddenExpensesPerAround" name="hiddenExpensesPerAround" value="0">
		                            		<label>บาท</label>
		                            	</td>
		                            </tr>

		                            <tr> <td>&nbsp;</td></tr>
	                            </table>
	                        </div>  

	                        <div id="btnCB">
				                <tr id="button-command">
				                    <td>
				                    	<a href="indexEmployee.php">
				                    	<button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button>
				                    	</a>
				                    </td>
				                    
				                  
				                    <td><button type="submit" id="btnCF" name="btnCF" class="btn btn-success btn-md">บันทึกข้อมูล</button></td>
								
				                </tr>
		            		</div>                
			        </form>           

 				<br>
 				<br>

	                    <input type="hidden" id="transport-orderid" name="transport-orderid" value="<?php echo $order ?>">

	                    <input type="hidden" id="hiddenDate" name="hiddenDate" value="<?php echo $date ?>" >  

	                    <input type="hidden" id="hiddenWeightProduct" name="hiddenWeightProduct" value="<?php echo $totalWeight ?>"> 

	                    <input type="hidden" id="hiddenTruck" name="hiddenTruck" value="<?php echo $truck ?>" >  

	                    <input type="hidden" id="hiddenEmployee" name="hiddenEmployee" value="<?php echo $employee ?>" > 

	                    <input type="hidden" id="hiddenRouteTime" name="hiddenRouteTime" value="<?php echo $routeTime ?>" > 

	                 
	      
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
			        	console.log(response);
			        	var arrayDestination = $('#arrayDestination').val().split('+');

			        	var temp = [];
			        	var a = [];
			       		var count = response.request.waypoints.length;
			       		for (i = 0; i<count;i++) {
			       			temp[i]	=	arrayDestination[i].split('&');
			       		}

			       		// jQuery.inArray( temp[0][0], response.request.waypoints );
			       		for (i = 0; i<count;i++) {
			       			for (j=0;j<count;j++) {
			       				if (temp[j][0] == response.request.waypoints[i].location) {
			       					a[i] = j;
			       				}
			       			}
			       		}
			       		// console.log(a);
			       		// console.log(response.request.waypoints[0].location);
			       		// console.log(jQuery.inArray( temp[0][0], response.request.waypoints ));
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
	
			            }
			            if ($('#totalDistance').val() != '') {
			            	$.ajax({
								url: "transportAddSQL.php", 
								method: "GET",
								data: { 
									totalDistance : totalDistance,
									orderid : $('#transport-orderid').val(),
									hiddenDate : $('#hiddenDate').val(),
									hiddenWeightProduct : $('#hiddenWeightProduct').val(),
									hiddenTruck : $('#hiddenTruck').val(),
									hiddenEmployee : $('#hiddenEmployee').val(),
									hiddenRouteTime : $('#hiddenRouteTime').val()

								},
								success: function(results){
									$('#transportId').val(results);
							    }
							});
			            }
			            $('#totalDistance').val(totalDistance);
			            $('#labelDistance').text(totalDistance);
			          
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
