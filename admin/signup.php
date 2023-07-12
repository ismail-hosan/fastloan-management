<?php
include_once "inc/header.php";
include_once "inc/sidebar.php";
include_once "classes/Employee.php";
$emp = new Employee();
?>
    <h3 class="page-heading mb-4">Add New User</h3>
      
    <hr>

    <?php 
        if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
          $inserted = $emp->employeeReg($_POST);
        } 
    ?>
    <form class="form-signin" action="" method="POST">
      <div class="text-center mb-4"><?php 
          if (isset($inserted)) {
            echo $inserted."";
          }
      ?></div>
      <div class="form-group">
        <label for="inputName">Full Name</label>
        <input type="text" id="inputName" class="form-control" name="name" placeholder="Full Name" required autofocus>
        
      </div>
      <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        
      </div>

      <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Password" required>
        
      </div>
      
      <div class="form-group">
        <label for="inputPassword">Designation</label>
        <select class="custom-select d-block w-100" name="role" required>
          <option selected>Select Designation...</option>
          <option value="1">Varifier</option>
          <option value="2">Branch Officer</option>
          <option value="3">Head Officer</option>
        </select>
      </div>

      <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Add User">
    </form>
  <?php
include_once "inc/footer.php";
?>