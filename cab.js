function cab(){
	$('.caberror').hide();
	console.log('yayyyyy');
	var pick = $("#pickup").val();
	var drop = $("#drop").val();
	var cab = $("#cabtype").val();
	if(cab =='CedMicro'){
		$('#luggage').attr("disabled",true);
		alert("luggage facility is not available for micro");
	}
	else{
		$('#luggage').attr("disabled",false);
	}
}
function disable() {
	
    var x = $(".pickup").val();
    var y=$(".drop option[value='"+x+"']").val();
    $(".drop option[value='"+x+"']").attr("disabled", "disabled").siblings().removeAttr("disabled");
    $('.pickerror').hide();

}
function dis() {
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
function onlynumber(button) { 
	var code = button.which;
    if (code > 31 && (code < 48 || code > 57)) 
        return false; 
    return true; 
} 





