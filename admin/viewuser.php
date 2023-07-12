<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";
?>

<?php 
	if (isset($_GET['del_id']) && $_GET['del_id'] != "") {
		$id = $_GET['del_id'];

		$delete = $emp->deleteUser($id);
		header("location: viewuser.php");
	}
?>

<div class="card">
  <div class="card-header">
    Borrower Information
  </div>
  <div class="card-body">
    	<h5 class="card-title">Borrower personal details</h5>
		<table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	        <thead>
	            <tr>
	                <th>#ID</th>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Designation</th>
	                <th>Status</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tfoot>
	            <tr>
	                <th>#ID</th>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Designation</th>
	                <th>Status</th>
	                <th>Action</th>
	            </tr>
	        </tfoot>
	        <tbody>
	        	<?php 
	        		$all = $emp->viewUser();
	        		if ($all) {
	        			$i = 1;
	        			while ($row = $all->fetch_assoc()) {
	        				$i++;

	        	 ?>
	            <tr>
	                <td><?php echo $row['id']; ?></td>
	                <td><?php echo $row['name']; ?></td>
	                <td><?php echo $row['email']; ?></td>
	                <td><?php echo $row['designation']; ?></td>
	                <td><?php echo $row['status']; ?></td>
	                <td><a href="edituser.php?edit_id=<?php echo $row['id']; ?>" class="text-dark"><i class="fa fa-edit"></i></a><a href="?del_id=<?php echo $row['id']; ?>" class="text-danger" onclick="alert('Are you sure delete this user (<?php echo $row['name']; ?>).')"><i class="fa fa-trash"></i></a></td>
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