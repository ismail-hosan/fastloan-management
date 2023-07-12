<?php
$filepath = realpath(dirname(__FILE__));

include_once ($filepath."/../libs/CrudOperation.php");
include_once ($filepath."/../libs/Session.php");
include_once ($filepath."/../helpers/Format.php");
include_once ($filepath."/../classes/Mailer.php");

/**
* Users class for registration and login, user profiles and others.
*/
class Employee
{
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new CrudOperation();
		$this->fm = new Format();
	}

	public function employeeReg($data){
		$name = $this->fm->validation($data['name']);
		$name = mysqli_real_escape_string($this->db->link, $name);

		$email = $data['email'];
		$email = mysqli_real_escape_string($this->db->link, $email);

	    $pass = $this->fm->validation(md5($data['pass']));
	    $pass = mysqli_real_escape_string($this->db->link, $pass);

		$role = $this->fm->validation($data['role']);
	    $role = mysqli_real_escape_string($this->db->link, $role);

	    //check empty value
	    if (empty($name) or empty($email) or empty($pass) or empty($role))
		{
			$msg = "<span class='text-danger'>Fields must not be empty !</span>";
			return $msg;
		}
		$ckemail = "SELECT * FROM tbl_user WHERE email='$email'";
		$result = $this->db->select($ckemail);
		if ($result != false) {
			$msg = "<span class='text-danger'>This email already registered !</span>";
			return $msg;
		}else{

			if ($role == 1) {
		    	$designation = "Varifier";
		    }elseif($role == 2){
		    	$designation = "Branch Officer";
		    }else{
		    	$designation = "Head Officer";
		    }

			 $sql = "INSERT INTO tbl_user(name,email,pass,designation,role) VALUES('$name','$email','$pass','$designation','$role')";
		    $inserted = $this->db->insert($sql);
		    if ($inserted) {
		    	$msg = "<span class='text-success'>Registered successfully !</span>";
			    return $msg;
		    }else{
		    	$msg = "<span class='text-danger'>Registration failed !</span>";
				return $msg;
		    }
		}
	}

	public function viewUser()
	{
		//get all user data
		$sql = "SELECT * FROM tbl_user  ORDER BY id DESC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function editUser($id)
	{
		//get all user data
		$sql = "UPDATE tbl_user SET name='$name', email='$email', designation='$designation', status='$status'  WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function deleteUser($id)
	{
		//get all user data
		$sql = "DELETE FROM tbl_user WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;
	}



	// Interest Rates And Purpose
	public function addInterestRates($data)
	{
		$purpose = $this->fm->validation($data['purpose']);
		$purpose = mysqli_real_escape_string($this->db->link, $purpose);

		$rate = $this->fm->validation($data['rate']);
		$rate = mysqli_real_escape_string($this->db->link, $rate);

		if (empty($purpose) or empty($rate))
		{
			$msg = "<span class='text-danger'>Fields must not be empty !</span>";
			return $msg;
		} else {
			$sql = "INSERT INTO tbl_interest_rates(	loan_purpose,interest_rates) VALUES('$purpose','$rate')";
			$inserted = $this->db->insert($sql);
		    if ($inserted) {
		    	$msg = "<span class='text-success'>Added successfully !</span>";
			    return $msg;
		    }else{
		    	$msg = "<span class='text-danger'>Added failed !</span>";
				return $msg;
		    }
		}
	}

	public function viewInterestRates()
	{
		$sql = "SELECT * FROM tbl_interest_rates  ORDER BY id DESC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function editInterestRates($data,$id)
	{
		$purpose = $this->fm->validation($data['edit-purpose']);
		$purpose = mysqli_real_escape_string($this->db->link, $purpose);

		$rate = $this->fm->validation($data['edit-rate']);
		$rate = mysqli_real_escape_string($this->db->link, $rate);

		if (empty($purpose) or empty($rate))
		{
			$msg = "<span class='text-danger'>Fields must not be empty !</span>";
			return $msg;
		} else {
			$sql = "UPDATE tbl_interest_rates SET loan_purpose='$purpose', interest_rates='$rate' WHERE id=$id";
			$inserted = $this->db->insert($sql);
		    if ($inserted) {
		    	$msg = "<span class='text-success'>Update successfully !</span>";
			    return $msg;
		    }else{
		    	$msg = "<span class='text-danger'>Update failed !</span>";
				return $msg;
		    }
		}
	}

	public function viewUpdateInterestRates($id)
	{
		$sql = "SELECT * FROM tbl_interest_rates WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function deleteInterestRates($id)
	{
		$sql = "DELETE FROM tbl_interest_rates WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;
	}




	// //users login
	public function employeeLogin($data){
		$email = $data['email'];
		$email = mysqli_real_escape_string($this->db->link, $email);
		$pass = $this->fm->validation(md5($data['pass']));
	    $pass = mysqli_real_escape_string($this->db->link, $pass);
	    if (empty($email) or empty($pass))
		{
			$msg = "<span class='text-danger'>Fields must not be empty !</span>";
			return $msg;
		}else{
			$sql = "SELECT * FROM tbl_user WHERE email='$email' AND pass='$pass'";
			$result = $this->db->select($sql);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("userlogin",true);
				Session::set("user_id",$value['id']);
				Session::set("name",$value['name']);
				Session::set("designation",$value['designation']);
				Session::set("role",$value['role']);
				header("Location: index.php");
			}else{
				$msg = "<span class='text-danger'>Email or password not matched !</span>";
				return $msg;
			}
		}
	}

	public function addBorrower2($data, $file)
	{
			// 	//validation of borrower data
		$borrower_name = $this->fm->validation($data['borrower_name']);
		$borrower_name = mysqli_real_escape_string($this->db->link, $borrower_name);

		$borrower_nid = $this->fm->validation($data['borrower_nid']);
		$borrower_nid = mysqli_real_escape_string($this->db->link, $borrower_nid);

		$borrower_gender = $this->fm->validation($data['borrower_gender']);
		$borrower_gender = mysqli_real_escape_string($this->db->link, $borrower_gender);

		$borrower_mobile = $data['borrower_mobile'];
		$borrower_mobile = mysqli_real_escape_string($this->db->link, $borrower_mobile);

		$borrower_email = $this->fm->validation($data['borrower_email']);
		$borrower_email = mysqli_real_escape_string($this->db->link, $borrower_email);

		$borrower_dob = $this->fm->validation($data['borrower_dob']);
	    $borrower_dob = mysqli_real_escape_string($this->db->link, $borrower_dob);

	    $borrower_address = $this->fm->validation($data['borrower_address']);
	    $borrower_address = mysqli_real_escape_string($this->db->link, $borrower_address);

	    $borrower_working_status = $this->fm->validation($data['borrower_working_status']);
	    $borrower_working_status = mysqli_real_escape_string($this->db->link, $borrower_working_status);

		//take image information using super global variable $_FILES[];
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		
		if (empty($borrower_name) or empty($borrower_nid) or empty($borrower_gender) or empty($borrower_mobile) or empty($borrower_email) or empty($borrower_dob) or empty($borrower_address) or empty($borrower_working_status) or empty($file_name))
		{
			$msg = "<span class='error'>Fields must not be empty !.</span>";
			return $msg;
		}else{

			$nidSql = "SELECT * FROM tbl_borrower WHERE nid = '$borrower_nid' ";
			$nidresult = $this->db->select($nidSql);
			if ($nidresult) {
				$msg = "<span class='error'>NID already exists !.</span>";
				return $msg;
			}else{
			//validate uploaded images
				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
				$uploaded_image = "admin/uploads/".$unique_image;
				
				if ($file_size >1048567) {
					$msg = "<span class='error'>Borrower not found !.</span>";
					return $msg;
				} elseif (in_array($file_ext, $permited) === false) {
					echo "<span class='error'>You can upload only:-"
					.implode(', ', $permited)."</span>";
				}else{
					move_uploaded_file($file_temp, $uploaded_image);
					
					$query = "INSERT INTO tbl_borrower(name,nid,gender,mobile,email,dob,address,working_status,image) 
					VALUES('$borrower_name','$borrower_nid','$borrower_gender','$borrower_mobile','$borrower_email','$borrower_dob','$borrower_address','$borrower_working_status','$uploaded_image')";

					$inserted = $this->db->insert($query);
					if ($inserted) {

						$msg = "<span class='success'>Borrower added successfully.</span>";
						return $msg;
					}else{
						$msg = "<span class='error'>Failed to insert.</span>";
						return $msg;
					}
			 	}
			 }
		}

	}


	public function addBorrower($data, $file)
	{
			// 	//validation of borrower data
		$borrower_name = $this->fm->validation($data['borrower_name']);
		$borrower_name = mysqli_real_escape_string($this->db->link, $borrower_name);

		$borrower_nid = $this->fm->validation($data['borrower_nid']);
		$borrower_nid = mysqli_real_escape_string($this->db->link, $borrower_nid);

		$borrower_gender = $this->fm->validation($data['borrower_gender']);
		$borrower_gender = mysqli_real_escape_string($this->db->link, $borrower_gender);

		$borrower_mobile = $data['borrower_mobile'];
		$borrower_mobile = mysqli_real_escape_string($this->db->link, $borrower_mobile);

		$borrower_email = $this->fm->validation($data['borrower_email']);
		$borrower_email = mysqli_real_escape_string($this->db->link, $borrower_email);

		$borrower_dob = $this->fm->validation($data['borrower_dob']);
	    $borrower_dob = mysqli_real_escape_string($this->db->link, $borrower_dob);

	    $borrower_city = $this->fm->validation($data['borrower_city']);
	    $borrower_city = mysqli_real_escape_string($this->db->link, $borrower_city);

	    $borrower_address = $this->fm->validation($data['borrower_address']);
	    $borrower_address = mysqli_real_escape_string($this->db->link, $borrower_address);

	    $borrower_working_status = $this->fm->validation($data['borrower_working_status']);
	    $borrower_working_status = mysqli_real_escape_string($this->db->link, $borrower_working_status);

	    $borrower_password = $this->fm->validation($data['borrower_password']);
	    $borrower_password = mysqli_real_escape_string($this->db->link, $borrower_password);

	    $borrower_con_password = $this->fm->validation($data['borrower_con_password']);
	    $borrower_con_password = mysqli_real_escape_string($this->db->link, $borrower_con_password);

		//take image information using super global variable $_FILES[];
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		
		if (empty($borrower_name) or empty($borrower_nid) or empty($borrower_gender) or empty($borrower_mobile) or empty($borrower_email) or empty($borrower_dob) or empty($borrower_address) or empty($borrower_working_status) or empty($file_name))
		{
			$msg = "<span class='error'>Fields must not be empty !.</span>";
			return $msg;
		} else {
			if ($borrower_password != $borrower_con_password) {
				$msg = "<span class='error'>Password & Confirm Password Doesn't Matched.</span>";
		    } else {

		    	$borrower_hash_password = password_hash($borrower_con_password, PASSWORD_DEFAULT);

				$nidSql = "SELECT * FROM tbl_borrower WHERE nid = '$borrower_nid' ";
				$nidresult = $this->db->select($nidSql);
				if ($nidresult) {
					$msg = "<span class='error'>NID already exists !.</span>";
					return $msg;
				} else {
				//validate uploaded images
					$div = explode('.', $file_name);
					$file_ext = strtolower(end($div));
					$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
					$uploaded_image = "admin/uploads/".$unique_image;
					
					if ($file_size >1048567) {
						$msg = "<span class='error'>Borrower not found !.</span>";
						return $msg;
					} elseif (in_array($file_ext, $permited) === false) {
						echo "<span class='error'>You can upload only:-"
						.implode(', ', $permited)."</span>";
					}else{
						move_uploaded_file($file_temp, $uploaded_image);
						
						$query = "INSERT INTO tbl_borrower(name,nid,gender,mobile,email,dob,address,working_status,image,password,city) 
						VALUES('$borrower_name','$borrower_nid','$borrower_gender','$borrower_mobile','$borrower_email','$borrower_dob','$borrower_address','$borrower_working_status','$uploaded_image','$borrower_hash_password','$borrower_city')";

						$inserted = $this->db->insert($query);

						$subject = "Create your account by Branch Officer";
						$message = "
							Hello $borrower_name;
							<br>

							Your account successfully created by Branch Officer. 

							<br><br>

							Your Email: $borrower_email;
							<br>
							Your Password: $borrower_password;

							<br><br>

							Please login and apply for loan <a href='http://localhost/loan-management/apply_for_loan.php'>

							<br><br>

							Thanks,
							<br>
							Fast Loan Ltd.";

						if ($inserted) {
							$mail  = new Mailer();
							$msg = "<span class='success'>Borrower Added & Send Email Successfully Completed.</span>";
							$mail->sendMail($borrower_email, $subject, $message);
							return $msg;
						}else{
							$msg = "<span class='error'>Failed to insert.</span>";
							return $msg;
						}
				 	}
				 }
			}
		}
	}

	public function registerBorrower($data, $file)
	{
			// 	//validation of borrower data
		$borrower_name = $this->fm->validation($data['borrower_name']);
		$borrower_name = mysqli_real_escape_string($this->db->link, $borrower_name);

		$borrower_nid = $this->fm->validation($data['borrower_nid']);
		$borrower_nid = mysqli_real_escape_string($this->db->link, $borrower_nid);

		$borrower_gender = $this->fm->validation($data['borrower_gender']);
		$borrower_gender = mysqli_real_escape_string($this->db->link, $borrower_gender);

		$borrower_mobile = $data['borrower_mobile'];
		$borrower_mobile = mysqli_real_escape_string($this->db->link, $borrower_mobile);

		$borrower_email = $this->fm->validation($data['borrower_email']);
		$borrower_email = mysqli_real_escape_string($this->db->link, $borrower_email);

		$borrower_dob = $this->fm->validation($data['borrower_dob']);
	    $borrower_dob = mysqli_real_escape_string($this->db->link, $borrower_dob);

	    $borrower_city = $this->fm->validation($data['borrower_city']);
	    $borrower_city = mysqli_real_escape_string($this->db->link, $borrower_city);

	    $borrower_address = $this->fm->validation($data['borrower_address']);
	    $borrower_address = mysqli_real_escape_string($this->db->link, $borrower_address);

	    $borrower_working_status = $this->fm->validation($data['borrower_working_status']);
	    $borrower_working_status = mysqli_real_escape_string($this->db->link, $borrower_working_status);

	    $borrower_password = $this->fm->validation($data['borrower_password']);
	    $borrower_password = mysqli_real_escape_string($this->db->link, $borrower_password);

	    $borrower_con_password = $this->fm->validation($data['borrower_con_password']);
	    $borrower_con_password = mysqli_real_escape_string($this->db->link, $borrower_con_password);

		//take image information using super global variable $_FILES[];
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];

		
		if (empty($borrower_name) or empty($borrower_nid) or empty($borrower_gender) or empty($borrower_mobile) or empty($borrower_email) or empty($borrower_dob) or empty($borrower_address) or empty($borrower_working_status) or empty($file_name))
		{
			$msg = "<span class='error'>Fields must not be empty !.</span>";
			return $msg;
		} else {
			if ($borrower_password != $borrower_con_password) {
				$msg = "<span class='error'>Password & Confirm Password Doesn't Matched.</span>";
		    } else {

		    	$borrower_hash_password = password_hash($borrower_con_password, PASSWORD_DEFAULT);

				$nidSql = "SELECT * FROM tbl_borrower WHERE nid = '$borrower_nid' ";
				$nidresult = $this->db->select($nidSql);
				if ($nidresult) {
					$msg = "<span class='error'>NID already exists !.</span>";
					return $msg;
				} else {
				//validate uploaded images
					$div = explode('.', $file_name);
					$file_ext = strtolower(end($div));
					$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
					$uploaded_image = "admin/uploads/".$unique_image;
					
					if ($file_size >1048567) {
						$msg = "<span class='error'>Borrower not found !.</span>";
						return $msg;
					} elseif (in_array($file_ext, $permited) === false) {
						echo "<span class='error'>You can upload only:-"
						.implode(', ', $permited)."</span>";
					}else{
						move_uploaded_file($file_temp, $uploaded_image);
						
						$query = "INSERT INTO tbl_borrower(name,nid,gender,mobile,email,dob,address,working_status,image,password,city) 
						VALUES('$borrower_name','$borrower_nid','$borrower_gender','$borrower_mobile','$borrower_email','$borrower_dob','$borrower_address','$borrower_working_status','$uploaded_image','$borrower_hash_password','$borrower_city')";

						$inserted = $this->db->insert($query);
						if ($inserted) {
							$msg = "<span class='success'>Borrower added successfully.</span>";
							return $msg;
						}else{
							$msg = "<span class='error'>Failed to insert.</span>";
							return $msg;
						}
				 	}
				 }
			}
		}
	}

	public function viewBorrower()
	{
		//get all borrower data
		$sql = "SELECT * FROM tbl_borrower  ORDER BY id DESC";
		$result = $this->db->select($sql);
		return $result;

	}

	

	public function findBorrower($nid)
	{
		//get all borrower data by nid
		$sql = "SELECT * FROM tbl_borrower WHERE nid='$nid'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function findBorrowerById($id)
	{
		//get all borrower data by nid
		$sql = "SELECT * FROM tbl_borrower WHERE id='$id' ";
		$result = $this->db->select($sql);
		return $result;
	}

//end of Employee class
}
?>

