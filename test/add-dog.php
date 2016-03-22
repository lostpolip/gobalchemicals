<?php
    require_once('connect-db.php');
    require_once('chack-login.php');
    
    require_once('header.php');

    // echo $_SESSION['member_ID'];

?>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/add-image.js"></script>


                              <!-- Button-Show -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $(".show-form").click(function(){
        $("section").toggle();
    });

});



// ===================================== //


function searchBreed(breedName){
$("#dogbreedList").show();
var tData = "breedName="+breedName; 
 jQuery.ajax({
        type: "GET", // HTTP method POST or GET
        url: "dog-breed.php", //Where to make Ajax calls
        dataType:"text", // Data type, HTML, json etc.
        data:tData, //Form variables
        success:function(tResponse){
        
        $("#dogbreedList").html(tResponse);
        },
        error:function (xhr, ajaxOptions, thrownError){
            alert(thrownError);
        }
});

}

function selectDogBreed(dogBreed , dogBreedName){
  $("#dog_Breed").val(dogBreed);
  $("#dog_BreedName").val(dogBreedName);
  $("#dogbreedList").hide();
}


</script><!--script Button-Show -->
                
<style type="text/css">
.dogbreedList{
  background: #FFFFFF;
  max-height: 300px;
  overflow: auto;
  border: 1px solid #cccccc;
}
</style>
                                     

<title>FindDog - ประกาศ</title>

<body>

   <div class="content-index col-md-12 col-sm-12 col-xs-12">
      
      <div class="top-menu col-md-12 col-sm-12 hidden-xs">
            <a href="index.php" class="button">เจอสุนัข</a>  
            <a href="lostdog.php" class="button"> สุนัขหาย</a> 
            <a href="nearby-index.php" class="button">รอบๆตัวเรา</a>
            <a href="add-dog.php" class="button"  style="font-size: 36px; color: #F3C026;">ประกาศ</a> <br>
      </div>

              <div class="down-menu col-xs-12 visible-xs navbar navbar-default navbar-fixed-bottom text-center">

                    <div class="col-xs-3">
                      <a href="index.php" class="button-res" >
                      <img src="image/icon_dog.png" style="width: 18px; height: 18px;">
                        <br> เจอ</a>
                    </div>

                    <div class="col-xs-3">
                      <a href="lostdog.php" class="button-res" style="padding-top:30px; ">
                      <img src="image/icon_foot.png" style="width: 18px; height: 18px;">
                      <br> หาย</a>
                    </div>

                    <div class="col-xs-3">
                      <a href="nearby-index.php" class="button-res">
                      <i class="fa fa-map-marker"></i>
                      <br>รอบตัว</a>
                    </div>

                    <div class="col-xs-3">
                      <a href="add-dog.php" class="button-res" style="font-size: 28px; color: #F3C026;">ประกาศ</a></div>
                
              </div>  <!-- down-menu เมนูข้างล่าง -->

      <form name="addcontent_form" id="addcontent_form" method="post" enctype="multipart/form-data" action="add-dog-todb.php">
        
          <div class = "add-dog col-md-offset-1 col-md-10 col-sm-12 col-xs-12" > <!-- กล่องเหลือง --> 
              <div class="announce_Type">  
                        <input name="announce_Type" onchange="showdogaward()" type="radio" checked value="1">ประกาศหาย
                        <input name="announce_Type" onchange="hidedogaward()" type="radio" value="2">ประกาศเจอ  
              </div>


            <div class="announce_Type01 col-md-12 col-sm-12 col-xs-12">


                    <div class="input-detail">
                     <input type="hidden"  id="dog_Breed" name="dog_Breed">
                     <input type="text" onkeyup="searchBreed(this.value)" id="dog_BreedName" name="dog_BreedName" placeholder="พันธุ์สุนัข *">
                     <div id="dogbreedList" class="dogbreedList"></div>
                    </div>

                    <div class="input-detail">
                      <select name="dog_Gender" type="text" class="input-detail" required >
                          <option value="">เพศสุนัข *</option>
                          <option value="1">เพศผู้</option>
                          <option value="2">เพศเมีย</option>
                      </select>
                      
                    </div>   <!-- input-detail -->

                     <div class="input-detail">  <!-- ใช้ดิฟเพื่อเว้นวรรค -->

                  <input name="dog_Date" type="date" class="input-full" placeholder="วัน/เดือน/ปี " size="30"> วัน/เดือน/ปี ที่สุนัขหายหรือเจอสุนัข *<br>

              </div>

      <!---start button show  -->

      <div class="input-detail-show">  

            <div class="box-show-form">
              
            <a class="show-form" type="buttom"> <i class="fa fa-chevron-circle-down"></i> กรอกข้อมูลเพิ่มเติม</a> 

            </div>

        <section style="display:none" >


          <div class="color">  
          
                        <select name="dog_Color01" class="dog_Color">
                          <option value="">สีขน 1</option>
                          <option value="มีหลายสี">มีหลายสี</option>
                          <option value="สีดำ">สีดำ</option>
                          <option value="สีขาว">สีขาว</option>
                          <option value="สีเทาอ่อน">สีเทาอ่อน</option>
                          <option value="สีเทาเข้ม">สีเทาเข้ม</option>
                          <option value="สีน้ำตาลอ่อน">สีน้ำตาลอ่อน</option>
                          <option value="สีน้ำตาล">สีน้ำตาล</option>
                          <option value="สีน้ำตาลเข้ม">สีน้ำตาลเข้ม</option>
                          <option value="สีน้ำตาลแดง">สีน้ำตาลแดง</option>
                        </select>
                                
                        <select name="dog_Color02" class="dog_Color">
                          <option value="">สีขน 2</option>
                          <option value="มีหลายสี">มีหลายสี</option>
                          <option value="สีดำ">สีดำ</option>
                          <option value="สีขาว">สีขาว</option>
                          <option value="สีเทาอ่อน">สีเทาอ่อน</option>
                          <option value="สีเทาเข้ม">สีเทาเข้ม</option>
                          <option value="สีน้ำตาลอ่อน">สีน้ำตาลอ่อน</option>
                          <option value="สีน้ำตาล">สีน้ำตาล</option>
                          <option value="สีน้ำตาลเข้ม">สีน้ำตาลเข้ม</option>
                          <option value="สีน้ำตาลแดง">สีน้ำตาลแดง</option>
                        </select>
                                
                        <select name="dog_Color03" class="dog_Color">
                          <option value="">สีขน 3</option>
                          <option value="มีหลายสี">มีหลายสี</option>
                          <option value="สีดำ">สีดำ</option>
                          <option value="สีขาว">สีขาว</option>
                          <option value="สีเทาอ่อน">สีเทาอ่อน</option>
                          <option value="สีเทาเข้ม">สีเทาเข้ม</option>
                          <option value="สีน้ำตาลอ่อน">สีน้ำตาลอ่อน</option>
                          <option value="สีน้ำตาล">สีน้ำตาล</option>
                          <option value="สีน้ำตาลเข้ม">สีน้ำตาลเข้ม</option>
                          <option value="สีน้ำตาลแดง">สีน้ำตาลแดง</option>
                          
                        </select>

              </div>  <!-- color --> 



           <div class="input-detail">  <!-- ใช้ดิฟเพื่อเว้นวรรค -->
                  <input name="dog_Age" type="text" class="input-full" placeholder="อายุ (ปี/เดือน)" size="30">
            </div>


          <div class="input-detail" style="text-align: center;">  <!-- ใช้ดิฟเพื่อเว้นวรรค -->

            <br>

            <div class="dog-icon"><img src="image/dog-icon.png"></div>

            <div class="dog-icon2">

                <input name="dog_High" type="number" class="input-full2" placeholder="ความสูง (ซม.)">
                  <br><br>
                <input name="dog_Long" type="number" class="input-full2" placeholder="ความยาว (ซม.)">

            </div>

          </div>

            <div class="input-detail">  <!-- ใช้ดิฟเพื่อเว้นวรรค -->

              <input name="dog_Lesion" type="text" class="input-full" placeholder="ลักษณะ/จุดเด่นของสุนัข (60ตัวอักษร)" size="30">
                
            </div>


            <div class="input-detail">  <!-- ใช้ดิฟเพื่อเว้นวรรค -->

                <input name="dog_Additional" id="message" class="input-full" rows="2" size="30"   placeholder="บริเวณสถานที่ที่เจอ/หาย (140ตัวอักษร)">

            </div>

             
              <div class="input-detail">
                   <input name="dog_award" type="number" class="input-full dog_award" placeholder="เงินรางวัล เช่น 1500 (ถ้ามี) " size="30"><br>
              </div>

                <!-- เนื้อหาที่ต้องการแสดงให้กับผู้ใช้งานได้เห็น -->


            </section>

      </div>   <!-- input-detail-show -->

       <!--End button show -->

       </div>  <!-- announce_Type01 -->

        <div class="announce_Type02 col-md-12 col-sm-12 col-xs-12" >

              <i class="fa fa-picture-o"></i>  รูปภาพสุนัข *<br>

                    <div class="add">
                          <input type="file" accept="image/*" name="dog_image1">
                    </div>

                    <div class="box-show-form">
        
                        <a class="add-image"><i class="fa fa-plus-circle"></i>  กดเพิ่มรูปภาพ</a>

                    </div>
                     
        </div> <!-- announce_Type02 -->

            <div class="announce03 col-md-12 col-sm-12 col-xs-12">

                  <i class="fa fa-map-marker"></i>  เพิ่มข้อมูลสถานที่ของสุนัข <br>
                  <?php
                    require_once('map/index.php');  
                  ?>

                   <input name="date_post" type="hidden" id="date_post"/> 
                   <input name="time_post" type="hidden" id="time_post"/> 
            </div>   <!-- announce03 -->


             <input type="submit" name="submit" class="button_add_dog"  value="ประกาศ" ><br>



             <div class="button-res-add-dog col-xs-12 visible-xs"></div> <!-- ดันกล่องขึีนเพื่อให้เท่า -->

    </div> <!-- add-dog -->

</form> 

</body>
</html>

<script type="text/javascript">
  function showdogaward () {
    console.log('show dogaward');
    $('.dog_award').css('display', 'block');
  }
  function hidedogaward () {
    console.log('hide dogaward');
    $('.dog_award').css('display', 'none');
  }
</script>

