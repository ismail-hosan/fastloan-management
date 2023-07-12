<?php
use PHPMailer\PHPMailer\PHPMailer;

$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../libs/CrudOperation.php");
include_once ($filepath."/../libs/Session.php");
include_once ($filepath."/../helpers/Format.php");

/**
* Users class for send email, receive email and others.
*/
class Mailer
{
	private $db;
	private $fm;

	function __construct()
	{
		$this->db = new CrudOperation();
		$this->fm = new Format();
	}

	public function addSmtpMailer($data)
	{
		$host = $this->fm->validation($data['host']);
		$host = mysqli_real_escape_string($this->db->link, $host);

		$auth = $this->fm->validation($data['authentication']);
		$auth = mysqli_real_escape_string($this->db->link, $auth);

		$user = $this->fm->validation($data['username']);
		$user = mysqli_real_escape_string($this->db->link, $user);

		$pass = $this->fm->validation($data['password']);
		$pass = mysqli_real_escape_string($this->db->link, $pass);
		$pass = base64_encode($pass);

		$port = $this->fm->validation($data['port']);
		$port = mysqli_real_escape_string($this->db->link, $port);

		$encrypt = $this->fm->validation($data['encryption']);
	    $encrypt = mysqli_real_escape_string($this->db->link, $encrypt);

	    $from_email = $this->fm->validation($data['from-email']);
	    $from_email = mysqli_real_escape_string($this->db->link, $from_email);

	    $from_name = $this->fm->validation($data['from-name']);
	    $from_name = mysqli_real_escape_string($this->db->link, $from_name);

		if (empty($host) or empty($auth) or empty($user) or empty($pass) or empty($port) or empty($encrypt) or empty($from_email) or empty($from_name)) {

			$msg = "<span class='error'>Fields must not be empty !.</span>";
			return $msg;

		} else {
			$sql = "SELECT * FROM tbl_mailer WHERE id=1";
			$result = $this->db->select($sql);
			$row = $result->fetch_assoc();
	        $id = $row['id'];

	        if ($result->num_rows < 1) {

	            $query = "INSERT INTO tbl_mailer(host, authentication, username, password, encryption, port, from_email, from_name) VALUES('$host','$auth','$user','$pass','$encrypt','$port','$from_email','$from_name')";
				$inserted = $this->db->insert($query);

				if ($inserted) {
					$msg = "<span class='success'>Mailer Settings Successfully Saved.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Failed to insert.</span>";
					return $msg;
				}
	        }

	        if ($result->num_rows > 0) {
	            $query = "UPDATE tbl_mailer SET host='$host', authentication='$auth', username='$user', password='$pass', encryption='$encrypt', port='$port', from_email='$from_email', from_name='$from_name' WHERE id='$id'";
	            $inserted = $this->db->insert($query);

	            if ($inserted) {
					$msg = "<span class='success'>Mailer Settings Successfully Updated.</span>";
					return $msg;
				}else{
					$msg = "<span class='error'>Failed to update.</span>";
					return $msg;
				}
	        }

		}
	}

	public function showSmtpMailer()
	{
		$sql = "SELECT * FROM tbl_mailer";
		$result = $this->db->select($sql);
		return $result;
	}

	public function sendMail($email,$subject,$message)
	{
		$sql = "SELECT * FROM tbl_mailer";
		$result = $this->db->select($sql);
		$row = $result->fetch_assoc();

		if($result->num_rows > 0) {
			$name = $row['from_name'];
			$from = $row['from_email'];
		    $host = $row['host'];
		    $auth = $row['authentication'];
		    $user = $row['username'];
		    $pass = $row['password'];
		    $pass = base64_decode($pass);
		    $port = $row['port'];
		    $encrypt = $row['encryption'];
		}
		
		$filepath = realpath(dirname(__FILE__));
		
		include_once ($filepath."/../inc/PHPMailer/PHPMailer.php");
		include_once ($filepath."/../inc/PHPMailer/SMTP.php");
		include_once ($filepath."/../inc/PHPMailer/Exception.php");

		$mail = new PHPMailer();

		// $mail->SMTPDebug = 3;

		$mail->isSMTP();
		$mail->Host=$host;
		$mail->SMTPAuth=true;
		$mail->Username=$user;
		$mail->Password=$pass;
		$mail->Port=587;
		$mail->SMTPSecure='tls';
		$mail->smtpConnect([
			'ssl' => [
				'verify_peer' 		=> false,
				'verify_peer_name' 	=> false,
				'allow_self_signed' => true
			]
		]);

		// Email Settings
		$mail->isHTML(true);
		$mail->setFrom($from,$name);
		$mail->addAddress($email);
		$mail->addReplyTo($from,$name);
		$mail->Subject=$subject;
		$mail->Body=$message;

		if($mail->send()) {
			return true;
		} else {
			$_SESSION['MailError'] = $mail->ErrorInfo;
			return false;
		}
	}
	
	//end of Mailer class
}
?>