<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";
?>
<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inserted = $emp->addBorrower($_POST,$_FILES);
  }
?>

<div class="container mt-5">
  <h5 class="card-title p-3 bg-info text-white rounded">Borrower Personal Details</h5>
  <?php
  if (isset($inserted)){
  ?>
  <div id="successMessage" class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <?php  echo $inserted; ?>
  </div>

  <?php
    }
  ?>  
  <form action="" method="post" enctype="multipart/form-data" id="add_borrower_form">
    <h5>Genaral Information:</h5>
    <div class="form-group row">

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerUniqueNumber" class="font-weight-bold">National ID number</label>
        <input type="text" name="borrower_nid" class="form-control" id="inputBorrowerUniqueNumber" placeholder="Unique Number" value="">
        <!-- <p class="text-muted">this id number must be unique otherwise you get error message</p> -->
      </div>

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerFirstName" class="font-weight-bold">Full Name</label>        
        <input type="text" name="borrower_name" class="form-control" id="inputBorrowerFirstName" placeholder="Enter Full Name" value="">
      </div>

      <div class="col-lg-4 mb-3">
        <!-- list($day,$mon,$year) = explode('/', $launch_date);
        $launch_date = "$year-$mon-$day"; -->
        <label for="inputBorrowerDob" class="font-weight-bold">Date of Birth</label>
        <input type="date" name="borrower_dob" class="form-control is-datepick" id="inputBorrowerDob" value="">
      </div>

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerGender" class="font-weight-bold">Gender</label>
        <select class="form-control" name="borrower_gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
      </div>

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerEORS" class="font-weight-bold">Working Status</label>
        <select class="form-control" name="borrower_working_status" id="inputBorrowerEORS">
            <option value="Employee">Employee</option>
            <option value="Owner">Owner</option>
            <option value="Student">Student</option>
            <option value="Unemployed">Unemployed</option>
            <option value="other">Other</option>
        </select>
      </div>
    </div>

    <hr>

    <h5>Contact Information:</h5>
    <div class="form-group row">

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerEmail" class="font-weight-bold">Email</label>
        <input type="text" name="borrower_email" class="form-control" id="inputBorrowerEmail" placeholder="Email" value="">
      </div>

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerMobile" class="font-weight-bold">Mobile</label>  
        <input type="text" name="borrower_mobile" class="form-control positive-integer" id="inputBorrowerMobile" placeholder="Numbers Only" value="">
      </div>

      <div class="col-lg-4 mb-3">
        <label for="inputBorrowerCity" class="font-weight-bold">City</label>
        <select class="form-control" name="borrower_city" id="inputBorrowerCity">
            <option value="Dhaka">Dhaka</option>
            <option value="Sirajganj">Sirajganj</option>
            <option value="Bandharban">Bandharban</option>
            <option value="Bogura">Bogura</option>
        </select>
      </div>

      <div class="col-lg-12 mb-3">
        <label for="inputBorrowerAddress" class="font-weight-bold">Address</label>
        <textarea name="borrower_address" class="form-control" id="inputBorrowerAddress" placeholder="Address" value=""></textarea>

      </div>
    </div>

    <hr>

    <h5>Account Information:</h5>

    <div class="form-group row">

      <div class="col-lg-6 mb-3">
        <label for="inputBorrowerPassword" class="font-weight-bold">Password</label>
        <input type="password" name="borrower_password" class="form-control" id="inputBorrowerPassword" placeholder="Password" value="">
      </div>

      <div class="col-lg-6 mb-3">
        <label for="inputBorrowerConPass" class="font-weight-bold">Confirm Password</label>
        <input type="password" name="borrower_con_password" class="form-control" id="inputBorrowerConPass" placeholder="Confirm Password" value="">
      </div>

    </div>
    <hr>
    <div class="form-group row">
      <div class="col-lg-6">
        <label for="user_picture" class="font-weight-bold">Borrower Photo</label>   
        <input type="file" id="photo_file" name="image">
      </div>

    </div> 
    <hr>

    <div class="box-footer">
        <button type="submit" name="submit" class="btn btn-info pull-right px-5" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait">Submit</button>
    </div><!-- /.box-footer -->    
  </form>
</div>
<?php
include_once "inc/footer.php";
?>