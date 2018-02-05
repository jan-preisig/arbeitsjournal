
$(document).ready(function(){
	$('.open').click(function(){
		$("#dateTableWrapper").toggle('slide', {direction: 'up'});
		$("#dateTableWrapper").toggleClass(".hide");
		$("#dateTableWrapper").toggleClass(".show");
	});
});
