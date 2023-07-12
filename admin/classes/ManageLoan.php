<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/CrudOperation.php");
include_once ($filepath."/../helpers/Format.php");
include_once ($filepath."/../classes/Mailer.php");

/**
* Sample Class for photo uploading, insert data, update data and others.
*/
class ManageLoan
{	
	private $db;
	private $fm;
	private $mail;
	function __construct()
	{
		$this->db = new CrudOperation();
		$this->fm = new Format();
		$this->mail = new Mailer();
	}

	function showPath(){
		return realpath(dirname(__FILE__));
	}
	function dbcon(){
		return $this->db->link;
	}

	//loan application
	public function applyForLoan($data, $file)
	{
			// 	//validation of borrower data
		$b_id = $this->fm->validation($data['b_id']);

		$borrower_name = $this->fm->validation($data['borrower_name']);

		$loan_amount = $this->fm->validation($data['loan_amount']);

		$loan_percent = $this->fm->validation($data['loan_percent']);

		$installments = $data['installments'];

		$total_amount = $this->fm->validation($data['total_amount']);

		$borrower_emi = $this->fm->validation($data['borrower_emi']);

		//take image information using super global variable $_FILES[];
		$permited  = array('doc', 'docx', 'pdf');
		$file_name = $file['borrower_files']['name'];
		$file_size = $file['borrower_files']['size'];
		$file_temp = $file['borrower_files']['tmp_name'];

		
		if (empty($b_id) or empty($borrower_name) or empty($loan_amount) or empty($loan_percent) or empty($installments) or empty($total_amount) or empty($borrower_emi) or empty($file_name))
		{
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}else{
			//validate uploaded images
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_file = "uploads/documents/".$unique_image;
			
			if ($file_size >10048567) {
				$msg = "<span class='error'>Borrower not found !</span>";
				return $msg;
			} elseif (in_array($file_ext, $permited) === false) {
				echo "<span class='error'>You can upload only:-"
				.implode(', ', $permited)."</span>";
			}else{
				move_uploaded_file($file_temp, $uploaded_file);
				
				$query = "INSERT INTO tbl_loan_application(b_id,name,expected_loan,loan_percentage,installments,total_loan,emi_loan,amount_remain, remain_inst,files) 
				VALUES('$b_id','$borrower_name','$loan_amount','$loan_percent','$installments','$total_amount','$borrower_emi','$total_amount','$installments','$uploaded_file')";

				$inserted = $this->db->insert($query);
				if ($inserted) {
					$msg = "<span class='success'>Loan Application submitted successfully.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Failed to submit.</span>";
					return $msg;
				}
		 	}

		}

	}

	//loan application
	public function applyForLoanBorrower($data, $file)
	{
		$b_id = $this->fm->validation($data['b_id']);

		$borrower_name = $this->fm->validation($data['borrower_name']);

		$loan_amount = $this->fm->validation($data['loan_amount']);

		$loan_percent = $this->fm->validation($data['loan_percent']);

		$installments = $data['installments'];

		$total_amount = $this->fm->validation($data['total_amount']);

		$borrower_emi = $this->fm->validation($data['borrower_emi']);

		//take image information using super global variable $_FILES[];
		$permited  = array('doc', 'docx', 'pdf');
		$file_name = $file['borrower_files']['name'];
		$file_size = $file['borrower_files']['size'];
		$file_temp = $file['borrower_files']['tmp_name'];

		
		if (empty($b_id) or empty($borrower_name) or empty($loan_amount) or empty($loan_percent) or empty($installments) or empty($total_amount) or empty($borrower_emi) or empty($file_name))
		{
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}else{
			//validate uploaded images
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_file = "admin/uploads/documents/".$unique_image;
			$uploaded_file_dir = "uploads/documents/".$unique_image;
			
			if ($file_size >10048567) {
				$msg = "<span class='error'>Borrower not found !</span>";
				return $msg;
			} elseif (in_array($file_ext, $permited) === false) {
				echo "<span class='error'>You can upload only:-"
				.implode(', ', $permited)."</span>";
			}else{
				move_uploaded_file($file_temp, $uploaded_file);
				
				$query = "INSERT INTO tbl_loan_application(b_id,name,expected_loan,loan_percentage,installments,total_loan,emi_loan,amount_remain, remain_inst,files) 
				VALUES('$b_id','$borrower_name','$loan_amount','$loan_percent','$installments','$total_amount','$borrower_emi','$total_amount','$installments','$uploaded_file_dir')";

				$inserted = $this->db->insert($query);
				if ($inserted) {
					$msg = "<span class='success'>Loan Application submitted successfully.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Failed to submit.</span>";
					return $msg;
				}
		 	}

		}

	}

	public function viewLoanApplication()
	{
		//get all borrower data
		$sql = "SELECT tbl_borrower.*, tbl_loan_application.*
			    FROM tbl_borrower
				INNER JOIN tbl_loan_application
				ON tbl_borrower.id = tbl_loan_application.b_id
		 		ORDER BY tbl_loan_application.id DESC";
		$result = $this->db->select($sql);
		return $result;
	}

	public function viewLoanApplicationNotVerified()
	{
		//get all borrower data
		$sql = "SELECT tbl_borrower.*, tbl_loan_application.*
			    FROM tbl_borrower
				INNER JOIN tbl_loan_application
				ON tbl_borrower.id = tbl_loan_application.b_id
				WHERE tbl_loan_application.status != 3
		 		ORDER BY tbl_loan_application.id";
		$result = $this->db->select($sql);
		return $result;
	}

	public function getLoanById($loan_id)
	{
		$sql = "SELECT * FROM tbl_loan_application WHERE id='$loan_id' ";
		$result = $this->db->select($sql);
		return $result;	
	}

	public function getLoanPurpose()
	{
		$sql = "SELECT * FROM tbl_interest_rates";
		$result = $this->db->select($sql);
		return $result;
	}

	public function getLoanPurposeId($id)
	{
		$sql = "SELECT * FROM tbl_interest_rates WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;
	}

	public function getLoanInterest($id)
	{
		$sql = "SELECT * FROM tbl_interest_rates WHERE id='$id'";
		$result = $this->db->select($sql);
		return $result;
	}


	public function getLoanVerificationStatus($loan_id, $role_id)
	{	
		if ($role_id == 1) {
			$sql = "UPDATE tbl_loan_application SET status = 1 WHERE id = '$loan_id' ";

		}else if($role_id == 2){
			$sql = "UPDATE tbl_loan_application SET status = 2 WHERE id = '$loan_id' ";
			
		}else{
			$borSql = "SELECT b_id FROM tbl_loan_application WHERE id = '$loan_id' ";
			$borResult = $this->db->select($borSql);
			
			if ($borResult) {
				$borRow = $borResult->fetch_assoc();

				$b_id = $borRow['b_id'];
				$query = "SELECT name, email FROM tbl_borrower WHERE id='$b_id'";
				$all = $this->db->select($query);

				if ($all) {
					$row = $all->fetch_assoc();

					$borrower_name = $row['name'];
					$borrower_email = $row['email'];

					$subject = "Loan Verified By Head Office";
					$message = "
					Hello $borrower_name;

					<br><br>

					Your loan successfully verified by head office. Please, Pay regular EMI & help us.

					<br><br>

					Thanks,
					<br>
					Fast Loan Ltd.";
					
					$sql = "UPDATE tbl_loan_application SET status = 3 WHERE id = '$loan_id' ";

					$this->mail->sendMail($borrower_email, $subject, $message);
				}
			}
		}
		
		$updated = $this->db->update($sql);
		if ($updated) {
			$msg = "<span style='color:green'>Successfully verified!</span>";
			return $msg;
		}else{
			$msg = "<span style='color:red'>Failed to verify!</span>";
			return $msg;
		}
	}


	public function getApprovedLoan($b_id)
	{
		//get all borrower data
		$sql = "SELECT tbl_borrower.*, tbl_loan_application.*
			    FROM tbl_borrower
				INNER JOIN tbl_loan_application
				ON tbl_borrower.id = tbl_loan_application.b_id
				WHERE tbl_loan_application.status = 3 AND tbl_loan_application.b_id = '$b_id'
		 		ORDER BY tbl_loan_application.id DESC";
		$result = $this->db->select($sql);
		return $result;
	}

	//get upapproved loan
	public function getNotApproveLoan()
	{
		$sql = "SELECT * FROM tbl_loan_application WHERE status != 3 ";
		$result = $this->db->select($sql);
		if ($result) {
			$result = $result->num_rows;
			return $result;
		}else{
			return 0;
		}
		
			
	}

	public function getAllApproveLoan()
	{
		$sql = "SELECT * FROM tbl_loan_application WHERE status = 3 ";
		$result = $this->db->select($sql);
		if ($result) {
			$result = $result->num_rows;
			return $result;
		}else{
			return 0;
		}
			
	}

	public function totalPaidLoanAmount()
	{
		$sql = "SELECT SUM(amount_paid) as total_money FROM tbl_loan_application";
		$result = $this->db->select($sql);
			
		return $result;
	}

	//get loan not paid
	public function getApprovedLoanNotPaid($b_id)
	{
		//get all borrower data
		$sql = "SELECT tbl_borrower.*, tbl_loan_application.*
			    FROM tbl_borrower
				INNER JOIN tbl_loan_application
				ON tbl_borrower.id = tbl_loan_application.b_id
				WHERE tbl_loan_application.status = 3 AND tbl_loan_application.b_id = '$b_id' AND tbl_loan_application.total_loan > tbl_loan_application.amount_paid
		 		ORDER BY tbl_loan_application.id DESC";
		$result = $this->db->select($sql);
		return $result;	
	}

	//pay loan
	public function payLoan($data)
	{

		$b_id = $this->fm->validation($data['b_id']);
		
		$loan_id = $this->fm->validation($data['loan_id']);

		$payment = $this->fm->validation($data['payment']);

		$pay_date = $this->fm->validation($data['pay_date']);

		$current_inst = $this->fm->validation($data['current_inst']);
		
		$remain_inst = $this->fm->validation($data['remain_inst']);
	
		$paid_amount = $this->fm->validation($data['paid_amount']);

		$remain_amount = $data['total_amount'] -$data['paid_amount'];
		
		$fine = 0;
		//fine calculation needed field
		if (isset($data['fine_amount'])) {
			$fine = $data['fine_amount'];
		}

		$next_date = '0000-00-00';

		if (isset($data['next_date'])) {
			$next_date = $data['next_date'];
		}else{

			$next_date = strtotime('+30 days',strtotime($data['pay_date']));
			$next_date = date('Y-m-d', $next_date);
			var_dump($next_date);
		}

		if (empty($b_id) or empty($loan_id) or empty($payment) or empty($pay_date) or empty($current_inst) or empty($paid_amount) )
		{
			$msg = "<span style='color:red'>Error....!</span>";
			return $msg;

		}else{

			$query = "INSERT INTO tbl_payment(b_id,loan_id,pay_amount,pay_date,current_inst,remain_inst,fine) 
				VALUES('$b_id','$loan_id','$payment','$pay_date','$current_inst','$remain_inst','$fine')";
			$inserted = $this->db->insert($query);

			if ($inserted != true) {
				$msg = "<span class='error'>Failed to submit.</span>";
				return $msg;
			} else {

				$updateSql = "UPDATE tbl_loan_application SET amount_paid = '$paid_amount', amount_remain ='$remain_amount', current_inst='$current_inst', remain_inst='$remain_inst', next_date='$next_date' WHERE id = '$loan_id' ";

				$up = $this->db->update($updateSql);

				if ($up != true) {
					$msg = "<span class='error'>Failed to submit.</span>";
					return $msg;
				} else {

					$sql = "SELECT name, email FROM tbl_borrower WHERE id='$b_id'";
					$all = $this->db->select($sql);
					$row = $all->fetch_assoc();

					$borrower_name = $row['name'];
					$borrower_email = $row['email'];

					$subject = "Pay Loan By Branch Officer";
					$message = "
					Hello $borrower_name;

					<br><br>

					Your loan emi successfully paid.<br>
					Amount Paid: $paid_amount;<br>
					Remain Amount: $remain_amount;<br>
					Next Payment date: $next_date.

					<br><br>

					Thanks,
					<br>
					Fast Loan Ltd.";

					$this->mail->sendMail($borrower_email, $subject, $message);

					$msg = "<span class='success'>Loan payment submitted successfully and send mail borrower email account successfully.</span>";
					return $msg;
				}
			}
		}
	}

	//send notification if not paying for 3 month 
	public function getNotification3monthNotPaying()
	{	

		$sql = "SELECT tbl_borrower.*, tbl_loan_application.*
				FROM tbl_borrower
				INNER JOIN tbl_loan_application
				ON tbl_borrower.id = tbl_loan_application.b_id
			 	WHERE tbl_loan_application.status = 3 ";
		$result = $this->db->select($sql);
		return $result;
	}
	//find payment info

	public function findPayment($b_id, $loan_id)
	{
		//get all borrower data by nid
		$sql = "SELECT * FROM tbl_payment WHERE b_id='$b_id' AND loan_id ='$loan_id' ";
		$result = $this->db->select($sql);
		return $result;
	}

	//generate payment report
	public function paymentReport($loan_id, $pay_id, $b_id)
	{
		$sql = "SELECT tbl_payment.*, tbl_loan_application.*
		    FROM tbl_payment
			INNER JOIN tbl_loan_application
			ON tbl_payment.loan_id = tbl_loan_application.id
			WHERE tbl_payment.b_id = '$b_id' AND tbl_payment.loan_id = '$loan_id' AND tbl_payment.id = '$pay_id' ";
		$result = $this->db->select($sql);
		return $result;	
	}

	//property sell details
	public function propertySellDetails($data)
	{
		$b_id = $this->fm->validation($data['b_id']);
		
		$loan_id = $this->fm->validation($data['loan_id']);

		$property_name = $this->fm->validation($data['property_name']);

		$property_details = $this->fm->validation($data['property_details']);
		
		$price = $this->fm->validation($data['price']);

		$pay_remaining_loan = $this->fm->validation($data['pay_remaining_loan']);
		
		$return_money = $price - $pay_remaining_loan;

		$amount_paid = $this->fm->validation($data['amount_paid']);

		$amount_paid = $amount_paid + $pay_remaining_loan;

		if (empty($price) or empty($property_name) or empty($property_details) or empty($pay_remaining_loan) or empty($amount_paid) )
		{
			$msg = "<span style='color:red'>Empty field !</span>";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_liability(b_id,loan_id,property_name,property_details,price,pay_remaining_loan, return_money) 
				VALUES('$b_id','$loan_id','$property_name','$property_details','$price','$pay_remaining_loan','$return_money')";

			$inserted = $this->db->insert($query);
			if ($inserted) {

				$updateSql = "UPDATE tbl_loan_application SET amount_paid = '$amount_paid', amount_remain = 0 WHERE id = '$loan_id' ";

				$up = $this->db->update($updateSql);

				$msg = "<span class='success'>Due loan paid and property selling details saved !</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Failed to insert.</span>";
				return $msg;
			}
		}

	}

	//view liabiility details

	public function viewLiabilityDetails()
	{
		//get all borrower data
		$sql = "SELECT tbl_borrower.*, tbl_liability.*
			    FROM tbl_borrower
				INNER JOIN tbl_liability
				ON tbl_borrower.id = tbl_liability.b_id
		 		ORDER BY tbl_liability.id DESC";
		$result = $this->db->select($sql);
		return $result;
	}


//end of ManageLoan class
}
?>