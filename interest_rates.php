<?php
include_once "admin/classes/ManageLoan.php";
$ml = new ManageLoan();
if (isset($_POST['loanPurposeId'])) {
	$loanPurposeId = $_POST['loanPurposeId'];
	$interestRate = $ml->getLoanInterest($loanPurposeId);
	$row = $interestRate->fetch_assoc();
	echo trim(stripslashes(htmlspecialchars($row['interest_rates'])));
}
?>