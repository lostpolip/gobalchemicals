<script type="text/javascript">
	function myFunction() {
	    window.print();
	}
</script>
	
</style>
<!DOCTYPE html>
<html>
	<head>
    		<meta charset="utf-8">
            <link rel="stylesheet" type="text/css" href="fonts/font-quark.css"/>
	</head>
		<body>
		<?php
			require 'dbManagement.php';
			$dbManagement = new dbManagement();
			$orderid =$_REQUEST['OrderID'];
			$result = $dbManagement->select("SELECT * FROM orders
											JOIN customer ON orders.CustomerID=customer.CustomerID
											 WHERE orders.OrderID ='".$orderid."'
											 ");

			
			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					$OrderDate = $row["OrderDate"];
					$CustomerID = $row["CustomerID"];
					$CustomerName = $row["CustomerName"];
					$CustomerEmail = $row["CustomerEmail"];
					$CustomerTel = $row["CustomerTel"];
					$TotalPriceOrder = $row["TotalPriceOrder"];
					$TotalVat = $row["TotalVat"];
					$TotalTransport = $row["TotalTransport"];
					$ExtendedPrice = $row["ExtendedPrice"];
					$CustomerTel = $row["CustomerTel"];
			    
			    }
			}

			$orderdetail = $dbManagement->select("SELECT * FROM orderdetail
											JOIN orders ON orders.OrderID=orderdetail.OrderID
											JOIN product ON product.ProductID=orderdetail.ProductID
											 WHERE orderdetail.OrderID ='".$orderid."'
											 ");

			$i=0;
			if (mysqli_num_rows($orderdetail) > 0) {
			    while($row = mysqli_fetch_assoc($orderdetail)) {
					$ProductID[$i] = $row["ProductID"];
					$ProductName[$i] = $row["ProductName"];
					$OrderAmount[$i] = $row["OrderAmount"];
					$TotalPrice[$i] = $row["TotalPrice"];
					$Price[$i] = $row["Price"];
			    $i++;
			    }
			}
		?>
			<a href="order.php"><button style="	font-family: 'quarklight';font-size: 20px;border-color: #DF0101;background-color: #FE2E2E;color: #fff;border-style: solid;height: 40px;width: 120px;margin-left: 900px; ">ยกเลิก</button></a>				
			<button style="	font-family: 'quarklight'; font-size: 20px;border-color: #2E2EFE;background-color: #5882FA;
				color: #fff;border-style: solid;height: 40px;width: 120px; margin-left: 50px; " onclick="myFunction()" >พิมพ์เอกสาร</button>

				<div class="floating-box" style="float: left;width: 1240px;height: 1120px;margin: 10px;border: 3px solid #E6E6E6; ">
					<div class="box-Logo" style="width: 220px; height: 100px; margin: 50px 0 0 100px;">
						<a href="http://www.mx7.com/view2/yV8WbW6C4pdEXtTJ" target="_blank"><img border="0" src="http://www.mx7.com/i/e9a/dU2SBm.png" /></a>
					</div>

					<div class="box-POId" style="width: 400px;height: 50px;float: right;font-size: 18px;">
						วันที่ :<label id="labelID" style="font-weight: bold; "><?php echo $OrderDate ?></label>
						<br>
						เลขที่ใบสีางซื้อ:<label id="labelDate"><?php echo $orderid ?></label>
                        <br>
                        กำหนดชำระเงิน : 30 วัน 
					</div>

					<div class="box-NamePO" style="font-size: 32px; font-weight: bold; margin: 20px 0 0 100px;">ใบกำกับภาษี (Tax Invoice)</div>
					
					<div class="box-OrderBy" style="font-weight: bold; font-size: 22px; margin: 30px 0 0 100px;">
						ชื่อลูกค้า <br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;"><?php echo $CustomerName ?></label><br>	
						<label style="font-size: 16px; margin: 30px 0 0 10px;">โทรศัพท์ :<?php echo $CustomerTel ?></label><br>
						<label style="font-size: 16px; margin: 30px 0 0 10px;">Email :<?php echo $CustomerEmail ?></label>

					</div>
				
					<div class="box-Detail" style="width: 1040px; margin: 50px 0 0 100px;">
						<table id="table1" width="100%">
                        	<tr>
                        		<th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">รหัสสินค้า</th>
                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">รายละเอียด</th>
                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">จำนวน</th>
                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">หน่วยละ</th>
                                <th style="border: 1px solid #000000; background-color: #A4A4A4;font-size: 18px;color: #000000;">จำนวนเงิน</th>
                                
                                
                        	</tr>
 							<?php
                        		for($j=0;$j<$i;$j++){ 
                        	?>		
                        	<tr>
                        		<td id="productid" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;"><?php echo $ProductID[$j]; ?></td>
                        		<td id="productname" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;"><?php echo $ProductName[$j]; ?></td>
                        		<td id="productamount" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000; text-align: right;"><?php echo $OrderAmount[$j]; ?></td>
                                <td id="productname" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;"><?php echo number_format($Price[$j]); ?></td>
                                <td id="productname" style="border: 1px solid #000000; background-color: #FFFFFF; font-size: 18px; color: #000000;"><?php echo number_format($TotalPrice[$j]); ?></td>
                        	</tr>
                        	<?php
                        		}
                        	?>
                        </table>   
                    </div>

                    <div class="box-total" style="font-weight: bold; font-size: 19px; margin: 0px 0 0 100px;"> 
	                    	<table id="table1" width="91%">
	                        	<tr>
									<th style="border: 1px solid #000000; background-color: #D8D8D8;font-size: 18px;width: 728px; text-align: right; color: #000000;">รวมเป็นเงิน :</th>
	                                <th style="border: 1px solid #000000; font-size: 18px;color: #000000;"><?php echo number_format($TotalPriceOrder); ?></th>
	                            </tr>

	                            <tr>
									<th style="border: 1px solid #000000; background-color: #D8D8D8;font-size: 18px;width: 728px; text-align: right; color: #000000;">ค่าขนส่ง :</th>
	                                <th style="border: 1px solid #000000; font-size: 18px;color: #000000;"><?php echo number_format($TotalTransport); ?></th>
	                            </tr>  
                                
                                <tr>
									<th style="border: 1px solid #000000; background-color: #D8D8D8;font-size: 18px;width: 728px; text-align: right; color: #000000;">มูลค่าเพิ่ม 7.00% :</th>
	                                <th style="border: 1px solid #000000; font-size: 18px;color: #000000;"><?php echo number_format($TotalVat); ?></th>
	                            </tr>  
                                
                                <tr>
									<th style="border: 1px solid #000000; background-color: #D8D8D8;font-size: 18px;width: 728px; text-align: right; color: #000000;">ยอดเงินสุทธิ :</th>
	                                <th style="border: 1px solid #000000; font-size: 18px;color: #000000;"><?php echo number_format($ExtendedPrice); ?></th>
	                            </tr>    
							</table>  
							<br>
							
							<br>
                    </div>
                    <br>
                    <div id="box-footer" style="border: 1px solid #999999; width:1030px; margin-left:100px;" >
                        <div class="box-OrderBy" style="font-weight: bold; font-size: 22px; float:left;  margin: 30px 0 0 30px; width:300px;">
                            The GolbalChemicals CO.,LTD 
                            <label style="font-size: 16px; margin: 30px 0 0 ">Email : nantiyathongpriwan@gmail.com</label><br>
                          
    
                        </div> 
                                                <div class="box-OrderBy" style="font-weight: bold; font-size: 22px;  width:600px; margin:0px 0 20px 400px; " >
                            <br>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">ติดต่อสอบถามรายละเอียดเพิ่มเติม</label><br>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">สถานที่ติดต่อ :&nbsp; 87/84&nbsp; หมู่ 2&nbsp; ตำบลบางพลับ&nbsp; อำเภอปากเกร็ด&nbsp; จังหวัดนนทบุรี&nbsp; 11120</label><br>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Contact : 87/84  No.2</label>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Bang Pat Sub-district,Amphoe Pak Kret </label>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Nonthaburi  11120</label><br>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Phone Number :(668) 188-9525-0</label><br>
                            <label style="font-size: 16px; margin: 30px 0 0 10px;">Fax Number :(662) 554-300</label>
    
                        </div>   
                   </div>
				</div>

	</body>
</html>

