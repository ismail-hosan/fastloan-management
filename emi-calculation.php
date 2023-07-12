<?php
function PMT($interest,$num_of_payments,$PV,$FV = 0.00, $Type = 0){
	$xp=pow((1+$interest),$num_of_payments);
	return ($PV* $interest*$xp/($xp-1)+$interest/($xp-1)*$FV)*($Type==0 ? 1 : 1/($interest+1));
}
if (isset($_POST['loanamount']) && isset($_POST['loanpercentage']) && isset($_POST['installments'])) {

	$loanamount = $_POST['loanamount'];
	$loanpercentage = $_POST['loanpercentage'];
	$installments = $_POST['installments'];

	if (empty($loanamount) || empty($loanpercentage) || empty($installments)) {
		echo "NaN";
	} else {
		$emi = PMT($loanpercentage/100/12,$installments,$loanamount);

		echo round($emi)."<span> / Month</span>";
	}

	
}
?>
