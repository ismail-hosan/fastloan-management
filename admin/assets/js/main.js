$('#loanPurpose').change(function(){
	var loanPurposeId = $(this).val();
	//console.log(loanPurposeId);

	$.ajax({
		method:"POST",
		url:"../interest_rates.php",
		data:{loanPurposeId:loanPurposeId},
		success:function(data){
			$("#loanpercentage").attr("value",data);
		}
	});
});



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