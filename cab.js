function cab(){
	$('#btn').show();
	$('#book').hide();
	$('.caberror').hide();
	console.log('yayyyyy');
	var pick = $("#pickup").val();
	var drop = $("#drop").val();
	var cab = $("#cabtype").val();
	if(cab =='CedMicro'){
		$('#luggage').attr("disabled",true);
		$("#luggage").val("Luggage facility is not available for CedMicro");
		
	}
	else{
		$('#luggage').attr("disabled",false);
		$('#luggage').val("");
	}
}
function disable() {
	$('#btn').show();
    var x = $(".pickup").val();
    var y=$(".drop option[value='"+x+"']").val();
    $(".drop option[value='"+x+"']").attr("disabled", "disabled").siblings().removeAttr("disabled");
    $('.pickerror').hide();
    $('#book').hide();


}
function dis() {
	$('#btn').show();
	$('#book').hide();
    var x = $(".drop").val();
    $(".pickup option[value='"+x+"']").attr("disabled", "disabled").siblings().removeAttr("disabled");
    $('.droperror').hide();
   
}

	

$('.pickerror').hide();
$('.droperror').hide();
$('.caberror').hide();

function calculate(){

	var pickup = $("#pickup").val();
	var destination = $("#drop").val();
	var cedcab = $("#cabtype").val();
	var weights = $("#luggage").val();
	if(pickup=='Current-location'){
		$('.pickerror').html('* Please select your pickup location');
		return;
	}
	if(destination=='Enter Drop for ride estimate'){
		$('.droperror').html('* Please select your drop location');
		return;
	}
	if(cedcab=="Select-Cab-Type"){
		$('.caberror').html('* Please select your cab');
		return;
	}

	
	if(weights==''){
		alert('Your final baggage would be 0 Kgs');
		$("#luggage").val(0);

	}
	console.log(pickup);
	console.log(destination);
	console.log(cedcab);
	console.log(weights);
	$.ajax({
			url:'cab.php',
			type: 'POST',
			data:{from:pickup,to:destination,cab:cedcab,baggage:weights},
			success: function(result){
				var path=result;
				path=result.split(',');
				console.log(path);
				$('.distance').html('Total distance is: '+ path[0]+' '+'KM');
				$('.fare').html('Total fare is:₹'+ path[1]);
				$('#book').show();
				$('#btn').hide();


			},
			error: function(){
				alert("ni aaya");
			}
		});
}
function alphaonly(button) { 
	console.log(button.which);
        var code = button.which;
        if ((code > 64 && code < 91) || (code < 123 && code > 96)|| (code==08)) 
            return true; 
        return false; 
    } 
function onlynumber(button) {
    $('#btn').show();
	$('#book').hide(); 
	var code = button.which;
    if (code > 31 && (code < 48 || code > 57)) 
        return false; 
    return true; 
} 

$("input[name=mobile]").on("blur", function(e){
var myval = $(this).val();

if(myval.length < 10) {
alert("Mobile should be 10 digits.");
$(this).unfocus();
}
});


    
