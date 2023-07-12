<?php include_once "inc/header.php"; ?>
<?php 
Session::checkSessionBorrower();
?>
<div class="pt-10 pb-10" style="background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), rgba(0, 0, 0, 0.2) url(assets/images/background/page-header.jpg) no-repeat center; background-size: cover;">
  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="bg-white p-5 rounded">
          <div class="row align-items-center">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
              <h1 class="mb-0">Apply For Loan</h1>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="text-md-end mt-3 mt-md-0">
                <a href="profile.php" class="btn btn-primary px-8">Profile</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once "inc/footer.php"; ?>
