//Met a jour le nombre de caractère entré dans l'input
$(document).ready(function(){
	$("#titre").keyup(function(){
		$(this).next("span").children("span:first-child").html(this.value.length);
	});
});