$('#loanPurpose').change(function(){
	var loanPurposeId = $(this).val();

	$.ajax({
		method:"POST",
		url:"interest_rates.php",
		data:{loanPurposeId:loanPurposeId},
		success:function(data){
			$("#loanpercentage").attr("value",data);
		}
	});
});


(function($){
    $(document).ready(function(){
        $("#submit_btn").on("click",function(e){
            $("#emiSection").addClass("d-block");
            $("#emiSection").removeClass("d-none");
            let params = {
                "loanamount":$("#loanamount").val(),
                "loanpercentage":$("#loanpercentage").val(),
                "installments":$("#installments").val(),
            };

            $.ajax({
                "method":"POST",
                "url":"emi-calculation.php",
                "data":params,
                success:function(data){
                    $(".detail").html(data)
                }
            });
            return false;
        });
    });
})(jQuery);


$(document).ready(function ()
{
    $('input:button').click(function()
    {
        var data = $('form:first').serialize();
        
        $.ajax({
            "method":"POST",
            "url":"process.php",
            "data":data,
            success:function(data){
                // $('#information').hide();
                $('#response').html(data);
                // $(".detail").html(data)
            }
        });
        return false;
    });
});

