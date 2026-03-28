<?php include_once("navbar.php");
$record;
$userID = $_SESSION["userID"];
$result =$conn->query("SELECT COUNT(*) FROM users where userID=$userID AND userType='user'")->fetch_array()[0];
if($result == 1)
{
    $sql = "SELECT * FROM users where userID=$userID AND userType='user'";
    $result =$conn->query($sql);
    $record = $result->fetch_assoc();
}else{
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
  $userID = $_REQUEST["userID"];
  $firstName = $_REQUEST["firstName"];
  $lastName = $_REQUEST["lastName"];
  $userName = $_REQUEST["userName"];
  $address = $_REQUEST["address"];
  $phoneNumber = $_REQUEST["phoneNumber"];
  $email = $_REQUEST["email"];
  $sql;
  if (!empty($_FILES['fileToUpload']['name']))
  {
      $target_dir = "../../webroot/images/users/";
      $uniquesavename=time().uniqid(rand());
      $target_file = $target_dir .$uniquesavename. basename($_FILES["fileToUpload"]["name"]);
      $userPhotoPath = $uniquesavename. basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql="Update users set firstName='$firstName',lastName='$lastName',userName='$userName',address='$address',userPhotoPath='$userPhotoPath',phoneNumber='$phoneNumber',email='$email' where userID=$userID";
      }
  }
  }else{
    $sql="Update users set firstName='$firstName',lastName='$lastName',userName='$userName',address='$address',phoneNumber='$phoneNumber',email='$email' where userID=$userID";
    
  }
  $result = $conn->query($sql);
  if($result == false)
  {
      echo "<script>alert('Data Not Updated!!!');</script>";
  }else{
    echo "<script>alert('Data Updated Successfully');</script>";
  }


  //echo $sql;

}

?>






<!-- start of dashboard files -->







    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">My Account</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">My Account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Account Dashboard Section:::... -->
    <div class="account-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <!-- Nav tabs -->
                    <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover active">Dashboard</a>
                            </li>
                            <li> <a href="#orders" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover">Checked Products</a></li>
                            <li><a href="#account-details" data-bs-toggle="tab"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover">Account details</a>
                            </li>
                            <li><a href="../phpProces/logout.php"
                                    class="nav-link btn btn-block btn-md btn-black-default-hover">logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                        <div class="tab-pane fade show active" id="dashboard">
                            <div><img class="rounded-circle" style="height:100px;width:100px;" src="../../webroot/images/users/<?php echo $record['userPhotoPath']; ?>" alt=""></div>
                            <h4><?php echo $record['firstName']." ".$record['lastName'] ?></h4>
                        </div>
                        <div class="tab-pane fade" id="orders">
                            <h4>Checked Products</h4>
                            <div class="table_page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product image</th>
                                            <th>Procuct name</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "SELECT * FROM clickedproduct WHERE userID=$userID";
                                        $result = $conn->query($sql);
                                        $cpCount = 0;
                                        foreach($result as $record){
                                            $cpCount++;
                                            $productID = $record['productID'];
                                            $sql = "SELECT * FROM product WHERE productID=$productID";
                                            $result = $conn->query($sql);
                                            $product = $result->fetch_assoc();
                                            $sql = "SELECT PImagesPP FROM PImages WHERE productID = $productID ORDER BY PImagesID LIMIT 1";
                                            $result = $conn->query($sql);
                                            $imgurl = $result->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo $cpCount; ?></td>
                                            <td class="product_thumb"><img src="../../webroot/images/products/<?php echo $imgurl['PImagesPP']; ?>" alt=""></td>
                                            <td><?php echo $product['pname']; ?></td>
                                            <td><?php echo $record['cleckedDate']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-details">
                        <?php
                            $sql = "SELECT * FROM users where userID=$userID AND userType='user'";
                            $result =$conn->query($sql);
                            $record = $result->fetch_assoc();
                        ?>
                        <div class="tab-pane fade show active" id="dashboard">
                            <div><img class="rounded-circle mb-3" style="height:100px;width:100px;" src="../../webroot/images/users/<?php echo $record['userPhotoPath']; ?>" alt=""></div>
                        </div>
                            <div class="login">
                                <div class="login_form_container">
                                    <div class="account_login_form">
                                       
                                        <form class="needs-validation" action="#" enctype="multipart/form-data" method="post" >
                                            <input type="text" value="<?php echo $record["userID"]; ?>" name="userID" hidden>
                                            <input type="text" value="<?php echo $record["userPhotoPath"]; ?>" name="existingPhotoName" hidden>
                                            <div class="default-form-box mb-20">
                                                <label for="firstName">First Name:</label>
                                                <input type="text" value="<?php echo $record["firstName"]; ?>" class="form-control" id="firstName" placeholder="Enter your First Name" name="firstName" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out first Name.</div>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <label for="lastName">Last Name:</label>
                                                <input type="text" value="<?php echo $record["lastName"]; ?>" class="form-control" id="lastName" placeholder="Enter your Last Name" name="lastName" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out last Name.</div>
                                            </div>
                                            
                                            <div class="default-form-box mb-20">
                                                <label for="userName">User Name</label>
                                                <input type="text" value="<?php echo $record["userName"]; ?>" class="form-control" id="fuserName" placeholder="Enter your User Name" name="userName" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out username.</div>
                                            </div>
                                            
                                            <div class="default-form-box mb-20">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" value="<?php echo $record["phoneNumber"]; ?>" class="form-control" id="phoneNumber" placeholder="Enter your Phone Number" name="phoneNumber" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out Phone Number.</div>
                                            </div>
                                            
                                            <div class="default-form-box mb-20">
                                                <label for="address">Address</label>
                                                <input type="text" value="<?php echo $record["address"]; ?>" class="form-control" id="address" placeholder="Enter your Address" name="address" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out Address.</div>
                                            </div>
                                            
                                            <div class="default-form-box mb-20">
                                                <label for="email">Email</label>
                                                <input type="text" value="<?php echo $record["email"]; ?>" class="form-control" id="email" placeholder="Enter your Email" name="email" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out Email.</div>
                                            </div>
                                            <div class="default-form-box mb-20">
                                                <div class="custom-file">
                                                    <input class="form-control custom-file-input" type="file" name="fileToUpload" id="fileToUpload" />
                                                    <label asp-for="Photo" class="custom-file-label">Choose File...</label>
                                                    <div id="disp_tmp_path"></div>
                                                    <span asp-validation-for="Photo" class="text-danger"></span>

                                                </div>
                                            </div>
                                            <div style="height:200px;" class=" w-100 text-center ">
                                                <img class="h-100  imagepreview rounded-circle  " style="width:200px;" alt="photo" src="../../webroot/images/users/<?php echo $record["userPhotoPath"]; ?>" />
                                            </div>
                                            <div class="save_button mt-3">
                                                <button class="btn btn-md btn-black-default-hover"
                                                    type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Account Dashboard Section:::... -->









<!-- end of dashboard files -->





<?php include_once("footer.php"); ?>