<?php 
include_once('inc/header.php');
Session::checkSessionBorrower();
?>
   <script>
    function calculateEMI() {
        var loan_amount =document.myform.loan_amount.value;
        if (!loan_amount)
            loan_amount = '0';

        var loan_percent = document.myform.loan_percent.value;
        if (!loan_percent)
            loan_percent = '0';

         var installments = document.myform.installments.value;
        if (!installments)
            installments = '0';

        var loan_amount = parseFloat(loan_amount);
        var loan_percent = parseFloat(loan_percent);
        var installments = parseFloat(installments);

        function pmt(rate_per_period, number_of_payments, present_value, future_value, type){
            future_value = typeof future_value !== 'undefined' ? future_value : 0;
            type = typeof type !== 'undefined' ? type : 0;

          if(rate_per_period != 0.0){
            // Interest rate exists
            var q = Math.pow(1 + rate_per_period, number_of_payments);
            return -(rate_per_period * (future_value + (q * present_value))) / ((-1 + q) * (1 + rate_per_period * (type)));

          } else if(number_of_payments != 0.0){
            // No interest rate, but number of payments exists
            return -(future_value + present_value) / number_of_payments;
          }

          return 0;
        }

        var emi = pmt((loan_percent/100)/12,installments,-(loan_amount),0,0);

        var total = emi*installments;

        document.myform.total_amount.value = parseFloat(total).toFixed(2);
        document.myform.borrower_emi.value = parseFloat(emi).toFixed(2);
    }
  </script>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_loan_application'])) {
    $inserted = $ml->applyForLoanBorrower($_POST,$_FILES);
    }
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
    
<div class="container mt-8 mb-8">
  <h5 class="card-title p-3 btn-primary text-white mb-0">Fill up loan details</h5>
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

  <?php
    $name ="" ; $b_id = "";
    $b_id = Session::get('borrower_id');
    $bor = $bor->viewBorrowerByID($b_id);
    if ($bor) {
      $row = $bor->fetch_assoc();
      $name = $row['name'];
      $b_id = $row['id'];
    }
  ?> 

  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="myform" id="myform" class="p-3" style="background-color: #f1f1f1;">

    <!--Added Borrower Name-->
    <div class="form-group row mb-3">
      <label for="borrower_name" class="text-right col-2 font-weight-bold col-form-label">Borrower Name</label>                      
      <div class="col-sm-10">
          <input type="text"  name="borrower_name" class="form-control" value="<?php echo $name; ?>" readonly>
      </div>
    </div>

    <!--Added Borrower ID-->
    <div class="form-group row mb-3">
      <label for="borrower_id" class="text-right col-2 font-weight-bold col-form-label">Borrower ID</label>                      
      <div class="col-sm-10">
          <input type="text"  name="b_id" class="form-control" value="<?php echo $b_id; ?>" readonly>
      </div>
    </div>

    <!--Select Loan Purpose-->
    
    <?php if (isset($_GET['apply_id']) && $_GET['apply_id'] != "") {
    

  
    } else { ?>
    <div class="form-group row mb-3">
      <label for="inputBorrowerEORS" class="text-right col-2 font-weight-bold col-form-label">Loan Purpose</label>
      <div class="col-sm-10">
        <select class="form-control" name="borrower_loan_purpose" id="loanPurpose">
          <option selected>Select a Loan Purpose</option>
        <?php
        $purpose = $ml->getLoanPurpose();
        if ($purpose) {
          $i = 1;
            while ($row = $purpose->fetch_assoc()) {
            $i++;
          ?>
          <option value="<?php echo $row['id'] ?>"><?php echo $row['loan_purpose'] ?></option>
          <?php 
          }
        }
        ?>
      </select>
      </div>
    </div>
    <?php } ?> 
      
    <!--Auto Load Interest Percentage-->
    <div class="form-group row mb-3">
      <label for="loanpercentage" class="text-right col-2 font-weight-bold col-form-label">Loan Percentage</label>                      
      <div class="col-sm-10">
        <?php 
          if (isset($_GET['apply_id']) && $_GET['apply_id'] != "") {
            $id = $_GET['apply_id'];
            $purpose = $ml->getLoanPurposeId($id);
            if ($purpose) {
              $row = $purpose->fetch_assoc();
              ?>
              <input type="number" onkeyup="calculateEMI()" name="loan_percent" class="form-control" id="loanpercentage" placeholder="Enter loan percent" value="<?php echo $row['interest_rates'] ?>" readonly>
              <?php 
            }
          } else { ?>
            <input type="number" onkeyup="calculateEMI()" name="loan_percent" class="form-control" id="loanpercentage" placeholder="Enter loan percent" value="">
          <?php 
          }
        ?>
          
      </div>
      <div class="interest"></div>
    </div>

    <div class="form-group row">
      <label for="loanamount" class="text-right col-2 font-weight-bold col-form-label">Expected Loan amount</label>                      
      <div class="col-sm-10">
          <input type="number"  onkeyup="calculateEMI()" name="loan_amount" class="form-control" id="loanamount" placeholder="Enter expected loan" required>
      </div>
    </div>

    <div class="form-group row">
        <label for="installments" class="text-right col-2 font-weight-bold col-form-label">Set number of installments</label>                    
         <div class="col-sm-10">
          <input type="number" onkeyup="calculateEMI()" name="installments" id="installments" class="form-control"  placeholder="Enter installments number" required>
      </div>
    </div> 
    
     <div class="form-group row">
        <label  class="text-right col-2 font-weight-bold col-form-label">Total amount including interest</label>                      
         <div class="col-sm-10">
          <input type="text"  name="total_amount" class="form-control" readonly required>
      </div>
    </div> 

    <div class="form-group row">
        <label for="inputBorrowerMobile" class="text-right col-2 font-weight-bold col-form-label">Automated calculated EMI</label>  
        <div class="col-sm-10">
            <input type="text" name="borrower_emi" class="form-control positive-integer" id="inputBorrowerMobile" readonly required>
        </div>
    </div>

    <hr>
    <div class="form-group row">
        <label for="borrower_files" class="text-right font-weight-bold col-2 col-form-label">Borrower Files<br>(doc, docx, and pdf only)</label>
        <div class="col-sm-10">    
            <input type="file"  name="borrower_files" required>
        </div>
    </div>
       <hr>
    <div class="form-group row">
        <div class="col-md-12 text-end">
        <input type="submit" name="submit_loan_application" class="btn btn-primary px-10" value="Submit Application">
        </div>
    </div><!-- /.box-footer -->    
  </form>
</div>    

     
<?php
include_once "inc/footer.php";
?>