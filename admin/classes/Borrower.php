<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/CrudOperation.php");
include_once ($filepath."/../libs/Session.php");
include_once ($filepath."/../helpers/Format.php");
/**
* Users class for registration and login, user profiles and others.
*/
class Borrower
{
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new CrudOperation();
		$this->fm = new Format();
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
					$uploaded_image = "admin/admin/uploads/".$unique_image;
					
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


	// //users login
	public function borrowerLogin($data){
		$email = $data['email'];
		$email = mysqli_real_escape_string($this->db->link, $email);
		$pass = $data['pass'];
	    $pass = mysqli_real_escape_string($this->db->link, $pass);
	    if (empty($email) or empty($pass))
		{
			$msg = "<span class='text-danger'>Fields must not be empty !</span>";
			return $msg;
		}else{
			$sql = "SELECT * FROM tbl_borrower WHERE email='$email'";
			$result = $this->db->select($sql);
			if ($result != false) {
				$value = $result->fetch_assoc();
				if (password_verify($pass, $value['password'])) {
					Session::set("borrowerlogin",true);
					Session::set("borrower_id",$value['id']);
					Session::set("borrower_name",$value['name']);
					Session::set("borrower_working_status",$value['designation']);
					header("Location: index.php");
				} else {
					$msg = "<span class='text-danger'>Password not matched !</span>";
					return $msg;
				}
			} else {
				$msg = "<span class='text-danger'>Email not matched !</span>";
				return $msg;
			}
		}
	}

	public function viewBorrowerByID($id)
	{
		//get all borrower data
		$sql = "SELECT * FROM tbl_borrower WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;

	}

//end of Borrower class
}
?>

