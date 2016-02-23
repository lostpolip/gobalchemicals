<?php
	require 'dbManagement.php';
	$dbManagement = new dbManagement();
	$result = $dbManagement->select("SELECT * FROM  purchase 
									-- JOIN supplier ON purchase.SupplierID = supplier.SupplierID
									JOIN product ON purchase.ProductID = product.ProductID
									WHERE PurchaseID = '".$_REQUEST['purchaseID']."'
									");

	if (mysqli_num_rows($result) > 0) {
	    while($row = mysqli_fetch_assoc($result)) {
	    	$PurchaseID = $row["PurchaseID"];
	    	$PurchaseDate = $row["PurchaseDate"];
	    	$ProductID = $row["ProductID"];
	    	$ProductName = $row["ProductName"];
	    	// $SupplierName = $row["SupplierName"];
	    }
	}else{
        echo('ไม่พบข้อมูลที่ค้นหา');
        exit();
    }

?>                        	

   <table id="table" style="width: 100%">
    	<tr>
            <td><label>เลขที่ใบสั่งซื้อ:</label></td>
            <td><input id="txtPurchasseID" name="txtPurchasseID" value="<?php echo $PurchaseID ?>" readonly></td>
        </tr>
    	<tr>
            <td><label>วันที่สั่งซื้อ:</label></td>
            <td><input id="txtPurchasseDate" name="txtPurchasseDate" value="<?php echo $PurchaseDate ?>" readonly></td>
        </tr>                            
    	<tr>
            <td><label>ชื่อสินค้า:</label></td>
            <td><input id="txtProduct" name="txtProduct" value="<?php echo $ProductName ?>" readonly>
            	<input type="hidden" id="txtProductID" name="txtProductID" value="<?php echo $ProductID ?>">
            </td>
        </tr>
    	<tr>
            <td><label>ผู้จัดจำหน่าย:</label></td>
            <td><input id="txtSupplier" name="txtSupplier" value="<?php echo $SupplierName ?>" readonly></td>
        </tr>                          
    </table>  
    <table id="table" style="width: 100%">
        	<tr>
                <td><input type="hidden" id="txtReceiveID" name="txtReceiveID"></td>
            </tr>

        	<tr>
                <td><label>วันที่รับสินค้า:</label></td>
                <td><input type="date" id="txtDateReceive" name="txtDateReceive"></td>
            </tr>
			<tr>
                <td><label><span class="red-star">* </span>วันหมดอายุ :</label></td>
                <td><input type="date" id="txtExpiryDate" name="txtExpiryDate" min="<?php echo date('Y-m-d');?>"></td>

            </tr> 
        	<tr>
                <td><label><span class="red-star">* </span>Lot Number:</label></td>
                <td><input type="text" id="txtLotReceive" name="txtLotReceive" required></td>
            </tr>

            <tr>
                <td><label><span class="red-star">* </span>จำนวนสินค้า :</label></td>
                <td><input type="text" id="txtReceiveAmount" name="txtReceiveAmount" required>&nbsp;&nbsp;
                	<label>ตัน</label> 
                </td>
            </tr>

            <tr> <td><input type="hidden" id="txtReceiveState" name="txtReceiveState"></td>
            </tr>

            <tr> <td>&nbsp;</td></tr>

            <tr>
            		<td><a href="productReceive.php"><button type="button" id="btnBack">กลับไปหน้าหลัก</button></a></td>
                    <td><button type="submit" id="btnCF">บันทึก</button></td>
                    
            </tr>

        </table>