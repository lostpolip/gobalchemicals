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
        $truck=$_REQUEST['listTruckName'];
        $truckDB=implode(',', $truck);
        $employee=$_REQUEST['listEmployeeName'];
        $employeeDB=implode(',', $employee);
        $routeTime=$_REQUEST['rdoDate'];

        require 'dbManagement.php';
        $dbManagement = new dbManagement();  
        foreach ($truck as $key => $value) {
          $Truck[$key] = $dbManagement->select("SELECT * FROM truck
                            WHERE TruckID= '".$value."'
                            ");
          $i=0;
          if (mysqli_num_rows($Truck[$key]) > 0) {
              while($row = mysqli_fetch_assoc($Truck[$key])) {
                  $TruckID[$key][$i] = $row["TruckID"];
                  $TruckName[$key][$i] = $row["TruckName"];
                  $TruckTypeID[$key][$i] = $row["TruckTypeID"];
                  $ConsumptionFuel[$key][$i] = $row["ConsumptionFuel"];
                  $FuelID[$key][$i] = $row["FuelID"];
                  $TruckCost[$key][$i] = $row["TruckCost"];
                  $ResidualValue[$key][$i] = $row["ResidualValue"];
                  $i++;
              }  
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
        <div id="map" style="display: none"></div>
        <div id="map_canvas" style="height:500px; width: 960px; margin: 40px 0 40px 190px;"></div>
          
            <div class="hide" style="display: none;">
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
        <br>
        <br>

        <label style="font-family: 'quarkbold'; color: #01DFA5; font-size: 26px; margin-left: 210px;">หมายเลขใบสั่งซื้อของเส้นทางนี้ :</label>
            <?php
                for($j=0;$j<$i;$j++){ 
            ?>
                <label style="font-family: 'quarkbold'; color: #FFFFFF; font-size: 23px;"><?php echo $order ?></label>
            <?php
              }
            ?>

        <div id="directions-panel"></div>
        <br>

        <form action="expensiveAddSQL.php">
          <input type="hidden" id="transportId" name="transportId">
              <br>
              <?php 

                foreach ($truck as $key => $value) {
                  if ($key == 0) {
                    $truckIdAll = $value;
                  } else {
                    $truckIdAll = $truckIdAll.','.$value;
                  }
              ?>
                  <div class="expensive">
                      <p>ค่าใช้จ่ายต่างๆ</p> 

                          <table id="table" style="width: 100%">
                            <input type="hidden" id="<?php echo 'consumptionExp'.$value ?>" name="<?php echo 'consumptionExp'.$value ?>" value="<?php echo $ConsumptionFuel[$key][0] ?>">
                            <input type="hidden" id="<?php echo'truckCost'.$value ?>" name="<?php echo 'truckCost'.$value ?>" value="<?php echo $TruckCost[$key][0] ?>">
                            <input type="hidden" id="<?php echo 'residualValue'.$value ?>" name="<?php echo 'residualValue' ?>" value="<?php echo $ResidualValue[$key][0] ?>">

                                <tr>
                                    <td>
                                    <label id="<?php echo 'truckType'.$value ?>">รถบรรทุก:&nbsp;&nbsp;&nbsp;<?php echo $TruckTypeID[$key][0] ?></label>
                              
                                    <label id="<?php echo 'truckName'.$value ?>">|&nbsp;หมายเลขทะเบียน:&nbsp;&nbsp;&nbsp;<?php echo $TruckName[$key][0] ?></label>
                                    </td>                                
                                </tr>

                                <tr>
                                    <td>
                                      <label id="<?php echo 'fuelId'.$value ?>">ชนิดน้ำมัน:&nbsp;&nbsp;&nbsp;<?php echo $FuelID[$key][0] ?></label>
                                    </td>
                    
                                </tr>

                                <tr>
                                    <td>
                                      <label>ค่าน้ำมันเชื้อเพลิง:</label>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="text" id="<?php echo 'FuelExpensive'.$value ?>" name="<?php echo 'FuelExpensive'.$value ?>" value="0" class="txtExpenses" required>
                                       &nbsp;&nbsp;<label>บาท/ลิตร</label>
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                      <label>ระยะเวลาค่าเสื่อมราคา :</label>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="text" id="<?php echo 'ConsumptionExp'.$value ?>" name="<?php echo 'ConsumptionExp'.$value ?>" value="0" class="txtExpenses" required>
                                      &nbsp;&nbsp;<label>ปี</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                      <label>ค่าแรงงาน(ต่อคน) :</label>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="text" id="<?php echo 'LaborExpensive'.$value ?>" name="<?php echo 'LaborExpensive'.$value ?>" value="0" class="txtExpenses" required>
                                      <label>บาท/วัน</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                      <label>จำนวนพนักงาน :</label>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="text" id="<?php echo 'AmountExployee'.$value ?>" name="<?php echo 'AmountExployee'.$value ?>" value="0" class="txtExpenses" required>
                                      &nbsp;&nbsp;<label>คน</label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                      <label>ค่าซ่อมบำรุง :</label>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="text" id="<?php echo 'MaintenanceExp'.$value ?>" name="<?php echo 'MaintenanceExp'.$value ?>" value="0" class="txtExpenses" required>
                                      &nbsp;&nbsp;<label>บาท/กิโลเมตร</label>
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
                                    <label id="<?php echo 'ExpensesPerAround'.$value ?>"></label>

                                    <input type="hidden" id="<?php echo 'hiddenExpensesPerAround'.$value ?>" name="<?php echo 'hiddenExpensesPerAround'.$value ?>" value="0">
                                    
                                    <label>บาท</label>
                                  </td>
                                </tr>
                          </table>
                  </div>
            <?php
              }
            ?>
            <tr>
              <td><button type="button" id="<?php echo 'btnCalculator' ?>" name="<?php echo 'calculator' ?>" class="btn btn-primary" style="margin-left: 215px;">คำนวณ</button></td>
            </tr>      
            <input type="hidden" id="truck-id" name="truck-id" value="<?php echo $truckIdAll; ?>">

              <br>

                        
            <div id="btnCB">
              <tr id="button-command">
                  <td>
                    <a href="indexEmployee.php">
                    <button type="button" id="btnBack" class="btn btn-danger btn-md">กลับไปหน้าหลัก</button>
                    </a>
                  </td>
                  
                
                  <td><button type="submit" id="btnCF" name="btnCF" class="btn btn-success btn-md" disabled>บันทึกข้อมูล</button></td>
      
              </tr>
            </div>                
        </form>           

        <br>
        <br>

                      <input type="hidden" id="transport-orderid" name="transport-orderid" value="<?php echo $order ?>">

                      <input type="hidden" id="hiddenDate" name="hiddenDate" value="<?php echo $date ?>" >  

                      <input type="hidden" id="hiddenWeightProduct" name="hiddenWeightProduct" value="<?php echo $totalWeight ?>"> 

                      <input type="hidden" id="hiddenTruck" name="hiddenTruck" value="<?php echo $truckDB ?>" >  

                      <input type="hidden" id="hiddenEmployee" name="hiddenEmployee" value="<?php echo $employeeDB ?>" > 

                      <input type="hidden" id="hiddenRouteTime" name="hiddenRouteTime" value="<?php echo $routeTime ?>" > 

                   
        
        <script>

          $( document ).ready(function() {
           $( "#submit" ).trigger( "click" );
      		});

            function initMap() {
              var directionsService = new google.maps.DirectionsService;
              var directionsDisplay = new google.maps.DirectionsRenderer;
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: {lat: 13.922080715335339, lng: 100.46815484762192}
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
                travelMode: google.maps.TravelMode.DRIVING,
                avoidHighways: true,
                
              }, function(response, status) {
                var arrayDestination = $('#arrayDestination').val().split('+');

                var temp = [];
                var a = [];
                var count = response.request.waypoints.length;
                for (i = 0; i<count;i++) {
                  temp[i] = arrayDestination[i].split('&');
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
                    summaryPanel.innerHTML += '<br><b>ลำดับและเส้นทางที่: ' + routeSegment +
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
                          hiddenRouteTime : $('#hiddenRouteTime').val(),
                        },
                        success: function(results){
                            $('#transportId').val(results);
                          }
                      });
                    }

                    $('#totalDistance').val(totalDistance);
                    $('label[name=labelDistance]').text(totalDistance);
                
                    } else {
                      window.alert('Directions request failed due to ' + status);
                    }
              });
            }




            
        </script>

        <script 
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBQWx9LHwmq7KUVzQr0JNfWmYnqhxUMz8&callback=initMap&language=th">
        </script>

        <script type="text/javascript">
        var startlatlng = document.getElementById('start').value.split(',');
        var endlatlng = document.getElementById('end').value.split(',');
        	var directionDisplay,
			      directionsService = new google.maps.DirectionsService(),
			      map,
			     startPoint = new google.maps.LatLng(parseFloat(startlatlng[0]),parseFloat(startlatlng[1])),
			    endPoint = new google.maps.LatLng(parseFloat(endlatlng[0]), parseFloat(endlatlng[1]));
			      console.log(document.getElementById('start').value);

      
      
      
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
		              var checkboxArray = document.getElementById('waypoints');
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

		ginit();
        </script>


      <div id="tooplate_footer_wrapper">
        <div id="tooplate_footer">
            Copyright © 2016 &nbsp;&nbsp;The GobalChemicals CO.,LTD.
          <div class="cleaner"></div><!--end of tooplate_footer-->
        </div><!--end of tooplate_footer-->
      </div> <!--end of tooplate_footer_wrapper-->

  </body>
</html>
