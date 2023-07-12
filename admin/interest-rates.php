<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";
 
	if (isset($_GET['del_id']) && $_GET['del_id'] != "") {
		$id = $_GET['del_id'];

		$delete = $emp->deleteInterestRates($id);
		header("location: interest-rates.php");
	}

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $inserted = $emp->addInterestRates($_POST);
  }

	if (isset($_GET['edit_id']) && $_GET['edit_id'] != "") {
		$edit_id = $_GET['edit_id'];

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-update'])) {
			$inserted = $emp->editInterestRates($_POST,$edit_id);
			header("location: interest-rates.php");
		}

		$result = $emp->viewUpdateInterestRates($edit_id);
	  if ($result->num_rows > 0) {
	      $row = $result->fetch_assoc();
	      $purpose = $row['loan_purpose'];
	      $rate = $row['interest_rates'];
	  }
	}

?>

<div class="card" <?php if (isset($_GET['edit_id']) && $_GET['edit_id'] != "") { echo "hidden"; } ?>>
  <div class="card-header">
    Add Interest Rates
  </div>
  <div class="card-body">

  	<?php if (isset($inserted)) { ?>
	  <div id="successMessage" class="alert alert-success alert-dismissible">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      <?php  echo $inserted; ?>
	  </div>
		<?php } ?> 

  	<form action="" method="post" id="add_interest_rate_form">
  		<div class="form-group row">

	      <div class="col-lg-5 mb-3">
	        <input type="text" name="purpose" class="form-control" placeholder="Enter Loan Purpose" value="">
	      </div>

	      <div class="col-lg-5 mb-3">       
	        <input type="text" name="rate" class="form-control" placeholder="Enter Interest Rate" value="">
	      </div>

	      <div class="col-lg-2 mb-3">
			    <button type="submit" name="submit" class="btn btn-info btn-block" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait">Save</button>
			  </div>

		  </div>
  	</form>
  </div>
</div>

<div class="card" <?php if (isset($_GET['edit_id']) && $_GET['edit_id'] != "") { echo "show"; } else {echo "hidden";} ?>>
  <div class="card-header">
    Update Interest Rates
  </div>
  <div class="card-body">

  	<?php if (isset($inserted)) { ?>
	  <div id="successMessage" class="alert alert-success alert-dismissible">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      <?php  echo $inserted; ?>
	  </div>
		<?php } ?> 

  	<form action="" method="post" id="add_interest_rate_form">
  		<div class="form-group row">

	      <div class="col-lg-5 mb-3">
	        <input type="text" name="edit-purpose" class="form-control" placeholder="Enter Loan Purpose" value="<?php if(isset($purpose)){ echo $purpose;} ?>">
	      </div>

	      <div class="col-lg-5 mb-3">       
	        <input type="text" name="edit-rate" class="form-control" placeholder="Enter Interest Rate" value="<?php if(isset($rate)){ echo $rate;} ?>">
	      </div>

	      <div class="col-lg-2 mb-3">
			    <button type="submit" name="submit-update" class="btn btn-info btn-block" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Please Wait">Update</button>
			  </div>

		  </div>
  	</form>
  </div>
</div>


<br><br>

<div class="card">
  <div class="card-header">
    Interest Rates & Purpose Information
  </div>
  <div class="card-body">
    	<h5 class="card-title" hidden>Interest Rates & Purpose Information</h5>
		<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th>#ID</th>
	                <th>Loan Purpose</th>
	                <th>Interest Rate</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tfoot>
	            <tr>
	                <th>#ID</th>
	                <th>Loan Purpose</th>
	                <th>Interest Rate</th>
	                <th>Action</th>
	            </tr>
	        </tfoot>
	        <tbody>
	        	<?php 
	        		$all = $emp->viewInterestRates();
	        		if ($all) {
	        			$i = 1;
	        			while ($row = $all->fetch_assoc()) {
	        				$i++;

	        	 ?>
	            <tr>
	                <td><?php echo $row['id']; ?></td>
	                <td><?php echo $row['loan_purpose']; ?></td>
	                <td><?php echo $row['interest_rates']; ?>%</td>
	                <td><a href="?edit_id=<?php echo $row['id']; ?>" class="text-dark"><i class="fa fa-edit"></i></a><a href="?del_id=<?php echo $row['id']; ?>" class="text-danger" onclick="alert('Are you sure delete this loan purpose: (<?php echo $row['loan_purpose']; ?>).')"><i class="fa fa-trash"></i></a></td>
	            </tr>
				<?php 
	        			}
	        		}
				 ?>
	        </tbody>
	    </table>
	  </div>
	</div>

<?php
include_once "inc/footer.php";
?>