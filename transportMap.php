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

    	<link href="css/transportMap.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8&language=th">
		</script>
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
	            <li><a href="#">จัดการข้อมูล</a>
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
	            
	            <li><a href="#">คลังสินค้า</a>
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

		$Time = $_REQUEST['rdoDate']; 
		$TomorrowDate = $_REQUEST['tomorrowDate']; 
		$LastDate = $_REQUEST['lastDate']; 
		$TruckId = $_REQUEST['listTruckName'];
		$EmployeeId = $_REQUEST['listEmployeeName'];
		$GeoidMin = $_REQUEST['min']; 


		require 'dbManagement.php';
		$dbManagement = new dbManagement();

		$Transport=$dbManagement->select("SELECT TransportID FROM transport ");
		$i = 0;
		$maxID = 0;
		if (mysqli_num_rows($Transport) > 0) {
			while($row = mysqli_fetch_assoc($Transport)) {
		        $TransportID[$i] = $row["TransportID"];

		        if ($maxID < str_replace('TS','',$TransportID[$i])) {
		        	$maxID = str_replace('TS','',$TransportID[$i]);
		        }
		        $i++;
			}
		}

		$newID = $maxID + 1;
		$newID = 'TS'.$newID;

		$Truck = $dbManagement->select("SELECT * FROM  truck
										WHERE TruckID = '".$TruckId."' ");

		if (mysqli_num_rows($Truck) > 0) {
		    while($row = mysqli_fetch_assoc($Truck)) {
		        $TruckID = $row["TruckID"];
		        $WeightCapacity = $row["WeightCapacity"];  
		        $TruckName = $row["TruckName"];
		        $TruckTypeID = $row["TruckTypeID"];
		        $ConsumptionFuel = $row["ConsumptionFuel"];
		        $FuelID = $row["FuelID"];
		        $TruckCost = $row["TruckCost"];
		        $ResidualValue = $row["ResidualValue"];  
		    }
		}

	?>

		<div id="realMap" style="display: none;"></div>
		<div id="map_canvas" style="height:500px; width: 960px; margin: 40px 0 40px 190px;"></div>
			<label id="Distance">รวมระยะทางทั้งหมด :</label>
			  <input id="totalDistance" readonly>
			  <b>กิโลเมตร</b>
			<br>
		<div id="detailOrderSend" style="margin-top: 25px;">
			<label style="font-family: 'quarkbold'; color: #01DFA5; font-size: 26px; margin-left: 210px;vertical-align: top">หมายเลขใบสั่งซื้อของเส้นทางนี้ :</label>
			<label id="ordersID" style=" margin-left: 40px;font-family: 'quarkbold'; color: #FFFFFF; font-size: 22px;"></label>
		</div>
			
			<select multiple="" id="geoIdWaypoints" class="hide"></select>
			<select multiple="" id="Waypoints" class="hide"></select>
			<input type="hidden" id="start" value="13.922174, 100.468186">
			<input type="hidden" id="end" value="13.922208, 100.468212">


		<div id="directions-panel"></div>

		<div id="ptt">
		  <IFRAME name="fuel"
		      src="http://www.pttplc.com/th/GetOilPrice.aspx" 
		      width="100%" height="555" align="middle" scrolling="no" frameborder="0" margin-left="220px">  
		  </IFRAME>
		</div>

		<form action="transportAddSQL.php">
          <div class="expensive">
              <p>ค่าใช้จ่ายต่างๆ</p>
                    <input type="hidden" id="consumptionExp" name="consumptionExp" value="<?php echo $ConsumptionFuel ?>">
                    <input type="hidden" id="truckCost" name="truckCost" value="<?php echo $TruckCost ?>">
                    <input type="hidden" id="residualValue" name="residualValue" value="<?php echo $ResidualValue ?>">

                    <table id="table" style="width: 100%">
                        <tr>
                            <td>
                            <label id="truckType">รถบรรทุก:&nbsp;&nbsp;&nbsp;<?php echo $TruckTypeID ?></label>
                      
                            <label id="truckName">|&nbsp;หมายเลขทะเบียน:&nbsp;&nbsp;&nbsp;<?php echo $TruckName ?></label>
                            </td>                                
                        </tr>

                        <tr>
                            <td>
                              <label id="fuelId">ชนิดน้ำมัน:&nbsp;&nbsp;&nbsp;<?php echo $FuelID ?></label>
                            </td>
            
                        </tr>

                        <tr>
                            <td>
                              <label>ค่าน้ำมันเชื้อเพลิง:</label>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="text" id="FuelExpensive" name="FuelExpensive" value="0" class="txtExpenses" required>
                               &nbsp;&nbsp;<label>บาท/ลิตร</label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                              <label>ค่าแรงงาน(ต่อคน) :</label>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="text" id="LaborExpensive" name="LaborExpensive" value="0" class="txtExpenses" required>
                              <label>บาท/วัน</label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                              <label>จำนวนพนักงาน :</label>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="text" id="AmountExployee" name="AmountExployee" value="0" class="txtExpenses" required>
                              &nbsp;&nbsp;<label>คน</label>
                            </td>
                        </tr>

                        <tr>
                            <td>
                              <label>ระยะทางที่วิ่ง :</label>
                              &nbsp;&nbsp;&nbsp;&nbsp;
                              <label  id="labelDistance" name="labelDistance"></label>
                              &nbsp;&nbsp;<label>กิโลเมตร</label> 
                            </td>
                        </tr> 
                        <br>
                        <br>

                        <tr> 
                          <td><label>ค่าใช้จ่ายรวมต่อรอบ :</label>
                            <label id="ExpensesPerAround"></label>

                            <input type="hidden" id="hiddenExpensesPerAround" name="hiddenExpensesPerAround" value="0">
                            
                            <label>บาท</label>
                          </td>
                        </tr>
                  </table>
          </div>

          <div id="btncal" style="margin-left: 215px; width: 500px; margin-bottom: 20px;">
             <tr>
               <td>
                 <button type="button" id="<?php echo 'btnCalculator' ?>" name="<?php echo 'calculator' ?>" class="btn btn-primary" style="width: 200px;">คำนวณ</button>
               </td>
             </tr> 
          </div>

       
        	<input type="hidden" name="transportId" id="transportId" value="<?php echo $newID ?>">
        	<input type="hidden" name="timeTransport" id="timeTransport" value="<?php echo $Time ?>">
        	<input type="hidden" name="tomorrowDate" id="tomorrowDate" value="<?php echo $TomorrowDate ?>">
        	<input type="hidden" name="lastDate" id="lastDate" value="<?php echo $LastDate ?>">
        	<input type="hidden" name="truckId" id="truckId" value="<?php echo $TruckID ?>">
        	<input type="hidden" name="truckWeight" id="truckWeight" value="<?php echo $WeightCapacity ?>">
        	<input type="hidden" name="employeeId" id="employeeId" value="<?php echo $EmployeeId ?>">
        	<input type="hidden" name="geo" id="geo" value="<?php echo $GeoidMin ?>">
        	<input type="hidden" name="distance" id="distance">
        	<input type="hidden" id="orderid" name="orderid">


		  <div id="btnCB">
		      <tr id="button-command">
		          <td>
		            <a href="indexEmployee.php">
		            <button type="submit" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button>
		            </a>
		          </td>                
		          <td>
		            <button type="submit" id="btnCF" name="btnCF" class="btn btn-success btn-md" disabled>บันทึกข้อมูล</button>
		          </td>
		      </tr>
		  </div>                
		</form>


	</body>

	<script type="text/javascript">

		//show real map 
		function initMap2() {
		  var directionsService = new google.maps.DirectionsService;
		  var directionsDisplay = new google.maps.DirectionsRenderer;
		  var map = new google.maps.Map(document.getElementById('realMap'), {
		    zoom: 18,
		    center: {lat: 13.922080715335339, lng: 100.46815484762192}
		  });
		  directionsDisplay.setMap(map);
			calculateAndDisplayRoute2(directionsService, directionsDisplay);

		}

		function calculateAndDisplayRoute2(directionsService, directionsDisplay) {
		  var waypts = [];
		  var checkboxArray = document.getElementById('geoIdWaypoints');
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
				var summaryPanel = document.getElementById('directions-panel');
				summaryPanel.innerHTML = '';
				var totalDistance = 0;
				// For each route, display summary information.
				for (var i = 0; i < route.legs.length; i++) {
					var routeSegment = i + 1;
					summaryPanel.innerHTML += '<br><b>ลำดับOrderและเส้นทางที่: ' + routeSegment +
					    '</b><br>';
					summaryPanel.innerHTML += '<b>จาก</b> '+route.legs[i].start_address + '<br><b> ถึง</b>';
					summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
					summaryPanel.innerHTML += 'เป็นระยะทาง : '+route.legs[i].distance.text + '<br><br>';
					totalDistance = totalDistance + parseFloat(route.legs[i].distance.text.replace('กม.',''));
				}

		    } else {
		      window.alert('Directions request failed due to ' + status);
		    }
			    $('#totalDistance').val(totalDistance);
			    $('#distance').val(totalDistance);
			    $('label[name=labelDistance]').text(totalDistance);
		  });
		}

		var weightCar = $("input[name='truckWeight']").val();
		var geoId = $("input[name='geo']").val();
		var date = $("input[name='lastDate']").val();

		$.ajax({
			url: "searchGeoid.php", 
			method: "GET",
			data: { 
				weightCar : weightCar,
				geoId : geoId,
				date : date,
			},
			success: function(orderInQueue){
				var orderInQueue = jQuery.parseJSON(orderInQueue);

				var lat,lng;

				for (geoId in orderInQueue) {
					for (index in orderInQueue[geoId]['OrderID']) {
						lat = orderInQueue[geoId]['latOrder'][index];
						lng = orderInQueue[geoId]['lonOrder'][index];

						$('#geoIdWaypoints').append('<option value="'+lat+','+lng+'" selected></option>');
						initMap2();
					}	
				}
			}
		});
	</script>

	        <script type="text/javascript">
	        var startlatlng = document.getElementById('start').value.split(',');
	        var endlatlng = document.getElementById('end').value.split(',');
	        	var directionDisplay,
					directionsService = new google.maps.DirectionsService(),
				      map,
				    startPoint = new google.maps.LatLng(parseFloat(startlatlng[0]),parseFloat(startlatlng[1])),
				    endPoint = new google.maps.LatLng(parseFloat(endlatlng[0]), parseFloat(endlatlng[1]));
				     
			  function ginit() {
			    directionsDisplay = new google.maps.DirectionsRenderer();
			    
			    var myOptions = {
			      zoom:15,
			      mapTypeId: google.maps.MapTypeId.ROADMAP,
			      center: startPoint
			    }
			    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			    directionsDisplay.setMap(map);
			    calcRoute();
			  }
	  
			  function calcRoute() {
				  var waypts = [];
				  var checkboxArray = document.getElementById('Waypoints');
				  for (var i = 0; i < checkboxArray.length; i++) {
				    if (checkboxArray.options[i].selected) {
				      waypts.push({
				        location: checkboxArray[i].value,
				        stopover: true
				      });
				    }
				  }
			    var start = startPoint;
			    var end = endPoint;
			    var request = {
			        origin:start, 
			      	destination:end,
			      	travelMode: google.maps.DirectionsTravelMode.DRIVING,
			      	waypoints: waypts,
			      	optimizeWaypoints: true,
	          		avoidHighways: true,
			    };
			    directionsService.route(request, function(response, status) {
			      if (status == google.maps.DirectionsStatus.OK) {
			        directionsDisplay.setDirections(response);
			        fx(response.routes[0]);
			      }
			    });
			  }
	  
			  function fx(o)
			  {
			    if(o && o.legs)
			    {
			      for(l=0;l<o.legs.length;++l)
			      {
			        var leg=o.legs[l];
			        for(var s=0;s<leg.steps.length;++s)
			        {
			          var step=leg.steps[s],
			              a=(step.lat_lngs.length)?step.lat_lngs[0]:step.start_point,
			              z=(step.lat_lngs.length)?step.lat_lngs[1]:step.end_point,
			              dir=((Math.atan2(z.lng()-a.lng(),z.lat()-a.lat())*180)/Math.PI)+360,
			              ico=((dir-(dir%3))%120);
			              new google.maps.Marker({
			                position: a,
			                icon: new google.maps.MarkerImage('http://maps.google.com/mapfiles/dir_'+ico+'.png',
			                                            new google.maps.Size(24,24),
			                                            new google.maps.Point(0,0),
			                                            new google.maps.Point(12,12)
			                                           ),
			          map: map,
			          title: Math.round((dir>360)?dir-360:dir)+'°'
			        });

			        }
			      }
			    }
			  }

			  var weightCar = $("input[name='truckWeight']").val();
			  var geoId = $("input[name='geo']").val();
			  var date = $("input[name='lastDate']").val();

			  $.ajax({
			  	url: "searchGeoid.php", 
			  	method: "GET",
			  	data: { 
			  		weightCar : weightCar,
			  		geoId : geoId,
			  		date : date,
			  	},
			  	success: function(orderInQueue){
			  		var orderInQueue = jQuery.parseJSON(orderInQueue);
			  		var lat,lng,order,unit;
			  		for (geoId in orderInQueue) {
			  			for (index in orderInQueue[geoId]['OrderID']) {
			  				lat = orderInQueue[geoId]['latOrder'][index];
			  				lng = orderInQueue[geoId]['lonOrder'][index];
			  				order = orderInQueue[geoId]['OrderID'];
			  				showOrder = orderInQueue[geoId]['OrderID'][index]+orderInQueue[geoId]['AumphurName'][index]+orderInQueue[geoId]['ProvinceName'][index];
			  				
			  				$('#Waypoints').append('<option value="'+lat+','+lng+'" selected></option>');
			  				$('#orderid').val(order);
		  				
			  				var oldOrder = $('#ordersID').html();
			  				if (oldOrder== '') {
			  					$('#ordersID').html(showOrder);
			  				} else {
			  					$('#ordersID').html(oldOrder+'<br>'+showOrder);
			  				}
			  				ginit();
			  			}	
			  		}
			  	}
			  });

			
	        </script>


</html>