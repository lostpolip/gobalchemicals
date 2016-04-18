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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>The GobalChemicals CO.,LTD.</title> 
		<meta charset="utf-8">
		<meta name="keywords" content="" />
		<meta name="description" content="" />

		<link href="css/transport.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>

		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8&language=th">
    </script>
		<script type="text/javascript" src="js/transport.js"></script>
		

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
									<li><a href="#" >จัดการข้อมูล</a>
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
			                        
			                        <li><a href="#" >คลังสินค้า</a>
										<ul>
											<li><a href="productReceive.php">รับสินค้า</a></li>
											<li><a href="productPurchase.php">สั่งสินค้า</a></li>
											<li><a href="productStock.php">เช็คสินค้า</a></li>
									  	</ul>
									</li>
									
									<li ><a href="#" class="selected">ส่งสินค้า</a>
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

		<?php
			date_default_timezone_set('Asia/Bangkok');
			require 'dbManagement.php';
			$dbManagement = new dbManagement();			
			$truck = $dbManagement->select("SELECT * FROM truck");

			$ddtruck = 0;
			if (mysqli_num_rows($truck) > 0) {
			    while($row = mysqli_fetch_assoc($truck)) {
			        $TruckID[$ddtruck] = $row["TruckID"];
			        $TruckName[$ddtruck] = $row["TruckName"];
			        $TruckTypeID[$ddtruck] = $row["TruckTypeID"];
			        $FuelID[$ddtruck] = $row["FuelID"];
			        $TruckWeight[$ddtruck] = $row["TruckWeight"];
			        $WeightQuantity[$ddtruck] = $row["WeightQuantity"];
			        $WeightCapacity[$ddtruck] = $row["WeightCapacity"];
			        $StateTruck[$ddtruck] = $row["StateTruck"];
			        $ddtruck++;
			    }
			   
			}

		?>
	<form id="transportAddForm" action="transportMap.php" method="post">
		<div id="tooplate_main">
			<div class="col_fw_last">
				<div class="col_w630 float_l">
					<p>จัดเส้นทาง</p>
	           
	                    <input type="hidden" id="txtTransportID" name="txtTransportID">
	                    
	                    <label id="labelDate">วันที่ส่งสินค้า:</label>
	                    <input type="date" id="txtDateTransport" name="txtDateTransport" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" required>

	                    <div id="order">
							<table id="table2" width="100%">
	                        	<tr> 	                                
	                        		<th>วันที่กำหนดส่งสินค้า</th>	                                
	                        		<th>รหัสสั่งซื้อ</th>
	                                <th>ชื่อลูกค้า</th>
	                                <th>ภูมิภาค</th>
	                                <th>น้ำหนักสินค้า(ตัน)</th>
	                        	</tr>
	                    		
	                    	</table> 
                    	</div>    	
                    	<br>


						<div id="timeInfo">
                     		<label id="title">ช่วงเวลาเดินทาง</label>
	                       		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                       	<input name="rdoDate" id="rdoDate1" type="radio" value="09:00-16:00" class="time" required>
		                       	<label id="rdoDate" for="rdoDate1">09:00-16:00 น.</label>

								<input name="rdoDate" type="radio" id="rdoDate3" value="21:00-05:00" class="time" required>
								<label id="rdoDate" for="rdoDate3">21:00-05:00 น.</label>
							<br>
						</div>
	                    
						<div id="truckInfo" style="width: 400px;">
								<label id="title">รถบรรทุก</label>
								<br>										
									<tr> 
										<td>
											<div id="truckOther"></div>
										</td>
									</tr>
						</div> 
						<br>

						<div id="employeeInfo"style="width: 400px;">	
                    		<label id="title">พนักงานขับ</label>
	                            <tr> 
									<td>
										<div id="employeeOther"></div>
									</td>
								</tr>
	                    </div>

                        <br>

						<select multiple="" id="waypoints" class="hide"></select>

                    	<div id="map" class="hide"></div>
                    	<input  id="geoID1" name="geoID" value="0" class="hide"></input>
                    	<input  id="geoID2" name="geoID" value="0" class="hide"></input>
                    	<input  id="geoID3" name="geoID" value="0" class="hide"></input>
                    	<input  id="geoID4" name="geoID" value="0" class="hide"></input>
                    	<input  id="geoID5" name="geoID" value="0" class="hide"></input>
                    	<input  id="geoID6" name="geoID" value="0" class="hide"></input>
                    	<input  id="min" name="min" data-min="1000000" class="hide"></input>
                    	<button id="checkLeastDistance" type="button" class="hide"></button>

		                  <input type="hidden" id="start" value="13.922174, 100.468186">
		                  <input type="hidden" id="end" value="13.922208, 100.468212">
                        
                          <!-- <button id="test" type="button">test</button> -->

                        <tr id="button-command">
                        		<td><a href="indexEmployee.php"><button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button></a></td>
                                <td><button type="submit" id="btnCF" class="btn btn-success btn-md">สร้างเส้นทาง</button></td>
                                
                        </tr>

	                        
				</div>
			</div>	
		</div><!--end of tooplate_main-->
	</form>

		<div id="tooplate_footer_wrapper">
			<div id="tooplate_footer">
					Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
				<div class="cleaner"></div><!--end of tooplate_footer-->
			</div><!--end of tooplate_footer-->
		</div> <!--end of tooplate_footer_wrapper-->






	
	</body>

	<script type="text/javascript">
		var claimAlert = function () {
			$.ajax({
				url: "alertClaim.php", 
				method: "GET",
				success: function(result){
					$('#txtClaim').text(result);
					$('#txtClaim').show();
					if (result == 0) {
						$('#txtClaim').hide();
					}
				}
			});
		}

		var orderAlert = function () {
			$.ajax({
				url: "alertOrder.php", 
				method: "GET",
				success: function(result){
					$('#txtOrder').text(result);
					$('#txtOrder').show();
					if (result == 0) {
						$('#txtOrder').hide();
					}
				}
			});
		}


		function initMap(geoId) {
		  var directionsService = new google.maps.DirectionsService;
		  var directionsDisplay = new google.maps.DirectionsRenderer;
		  var map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 18,
		    center: {lat: 13.922080715335339, lng: 100.46815484762192}
		  });
		  directionsDisplay.setMap(map);
			calculateAndDisplayRoute(directionsService, directionsDisplay, geoId);

		}

		function calculateAndDisplayRoute(directionsService, directionsDisplay, geoId) {
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
		    travelMode: google.maps.TravelMode.DRIVING,
		    avoidHighways: true,
		  }, function(response, status) {
		    if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
				var route = response.routes[0];
				var totalDistance = 0;
				// For each route, display summary information.
				for (var i = 0; i < route.legs.length; i++) {
					var routeSegment = i + 1;
					totalDistance = totalDistance + parseFloat(route.legs[i].distance.text.replace('กม.',''));
				}
				var oldDistance = $('#'+ geoId).val();
				$('#'+ geoId).val(parseFloat(oldDistance)+parseFloat(totalDistance));
				$('#checkLeastDistance').trigger('click');

		    } else {
		      // window.alert('Directions request failed due to ' + status);
		    }
		  });
		}


		$( document ).ready(function() {

			$("input[name='rdoDate']").click(function(){
				$('#truckInfo').show();
				$('#employeeInfo').hide();
				$('#truckOther').html('');
				$('#employeeInfo').show();


				if (this.id == 'rdoDate1') {
					var timeaction = $("#rdoDate1").val();
				} else if (this.id == 'rdoDate2') {
					var timeaction = $("#rdoDate2").val();
				} else {
					var timeaction = $("#rdoDate3").val();
				}

				$.ajax({
					url: "searchTruck.php", 
					method: "GET",
					data: { 
						timeaction : timeaction,
						datetransport : $('#txtDateTransport').val()
					},
					success: function(result){
						var TruckOther = jQuery.parseJSON(result);

				    	for (var x in TruckOther['name']) {
							$('#truckOther').append('<input type="radio" name="listTruckName" data-weight-capacity="'+ $.trim(TruckOther["weightcapacity"][x]) +'" data-available="'+ TruckOther["available"][x] +'" id="'+ $.trim(TruckOther["ID"][x]) +'" value="'+ $.trim(TruckOther["ID"][x]) +'"'+ TruckOther['available'][x]+' > '+'<label for="'+ $.trim(TruckOther["ID"][x]) +'">'+TruckOther['trucktype'][x]+'('+ TruckOther['weightcapacity'][x]	+'ตัน) | เลขทะเบียน: '+TruckOther['name'][x] +'</label><br>');
						}

						$("input[name='listTruckName']").change(function() {
							var weightCar = $("input[name='listTruckName']:checked").data('weight-capacity');
							$('#waypoints').empty();
							$.ajax({
								url: "searchOrder.php", 
								method: "GET",
								data: { 
									weightCar : weightCar,
									datetransport : $('#txtDateTransport').val()
								},
								success: function(orderInQueue){
									var orderInQueue = jQuery.parseJSON(orderInQueue);
									for (geoId in orderInQueue) {
										for (index in orderInQueue[geoId]['OrderID']) {
											var lat = orderInQueue[geoId]['latOrder'][index];
											var lng = orderInQueue[geoId]['lonOrder'][index];
											$('#waypoints').append('<option value="'+lat+','+lng+'" selected></option>');
											initMap(geoId);
										}
									}
								}
							});

							
						});
					}
				});

				$.ajax({
					url: "searchEmployee.php", 
					method: "GET",
					data: { 
						timeaction : timeaction,
						datetransport : $('#txtDateTransport').val()
					},
					success: function(result){
						$('#employeeOther').empty();
						var EmployeeOther = jQuery.parseJSON(result);

				    	for (var x in EmployeeOther['name']) {
							$('#employeeOther').append('<input type="radio" name="listEmployeeName" data-available="'+ EmployeeOther["available"][x]+'" id="'+ $.trim(EmployeeOther["ID"][x]) +'" value="'+ $.trim(EmployeeOther["ID"][x]) +'"'+ EmployeeOther["available"][x]+' > '+'<label for="'+ $.trim(EmployeeOther["ID"][x]) +'">'+EmployeeOther['name'][x] +'</label><br>');
						}
					}
				});
			});

			$('#rdoDate1').trigger('click');

			$('#txtDateTransport').change(function(){
				$('#rdoDate1').trigger('click');
			});
			$('#checkLeastDistance').click(function(){
				$("input[name*='geoID']").each(function() {
					var min = parseFloat($('#min').data('min'));
					var value = parseFloat($(this).val());

					if (value < min && value!=0) {
						$('#min').val(this.id);
						$('#min').data('min', value);
					}
				});
			});
		});

	</script>

	
</html>
