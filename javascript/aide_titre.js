//Met a jour le nombre de caract�re entr� dans l'input
$(document).ready(function(){
	$("#titre").keyup(function(){
		$(this).next("span").children("span:first-child").html(this.value.length);
	});
});