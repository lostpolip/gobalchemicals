<?php
    session_start();

	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  orderdetail 
									JOIN orders ON orderdetail.OrderID = orders.OrderID
									JOIN product ON orderdetail.ProductID = product.ProductID
									WHERE CustomerID ='".$_SESSION['CustomerID']."'
                                    AND orders.OrderID= '".$_REQUEST['orderID']."'
                                    AND orders.State = 'complete'   
									");

   $i=0; 
	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$OrderID[$i] = $row["OrderID"];
	    	$OrderDate[$i] = $row["OrderDate"];
	    	$ProductID[$i] = $row["ProductID"];
            $ProductName[$i] = $row["ProductName"];
	    	$OrderAmount[$i] = $row["OrderAmount"];

            $i++;
	    }
	}else{
        echo('ไม่พบข้อมูลที่ค้นหา');
        exit();
    }
?>                        	
         
<table id="table" style="width: 100%">
        <tr>
            <td><input type="hidden" id="txtClaimID" name="txtClaimID"></td>
        </tr>
        <tr>
            <td><input type="hidden" id="txtCustomerID" name="txtCustomerID" value="<?php echo $_SESSION['CustomerID']?>"></td>
        </tr>
        <br>

        <tr>
            <td><label id="orderid">เลขที่ใบสั่งซื้อ:</label></td>
            <td><input id="txtOrderID" name="txtOrderID" value="<?php echo $OrderID[0]; ?>"readonly></td>                    
        </tr>
</table>
  <!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active">
        <br>
        <table id="table2" width="100%">


                <tr>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวนที่สั่งซื้อ</th>
                    <th>จำนวนสินค้าชำรุด</th>
                    <th>รายละเอียดเพิ่มเติม</th>
 
                </tr>

                <?php
                $claimId='';
                    for($j=0;$j<$i;$j++){ 

                        $claimId=$claimId.$ProductID[$j].',';
                 ?>

                <tr>
                    <td id="productid"><?php echo $ProductID[$j]; ?></td>
                    <td id="productname"><?php echo $ProductName[$j]; ?></td>
                        <input type="hidden" id="<?php echo 'productID'. $ProductID[$j]; ?>" name="<?php echo 'productID'. $ProductID[$j]; ?>" value="<?php echo $ProductID[$j]; ?>">
                    <td id="orderamount"><?php echo $OrderAmount[$j]; ?></td>
                    <td id="claimamount"><input id="<?php echo 'txtClaimAmount'. $ProductID[$j]; ?>" name="<?php echo 'txtClaimAmount'. $ProductID[$j]; ?>"></td>
                    <td><textarea id="<?php echo 'txtClaimDetail'. $ProductID[$j]; ?>" name="<?php echo 'txtClaimDetail'. $ProductID[$j]; ?>"></textarea></td>

                </tr>
                <?php

                    }
                ?> 
                  <input type="hidden" id="claim-id" name="claim-id" value="<?php echo $claimId ?>">     
        </table> 
    </div><!--- แจ้งซื้อสินค้า -->

        <tr>
                <td><a href="indexCustomer.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                <td><button type="submit" id="btnCF" name="btnCF">บันทึก</button></td>
        </tr>
    
</div>
