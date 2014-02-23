//Ouvre une fenetre de confirmation de suppression
$(document).ready(function(){
	$(".suppr").click(function(){
		if(confirm("Etes-vous sur de supprimer l'article ?", "Confirmation de suppression")){
			$(this).parent().next("div").children("form").submit();
		}
	});
});

//Affiche le bloc contenant les modifieurs supplémentaires
$(document).ready(function(){
	$(".article_modif_more").mouseenter(function(){
		$(this).children("div").show("slow");
		$(this).children("img").attr("style", "opacity:0.5");
	});
});

//Cache le bloc contenant les modifieurs supplémentaires
$(document).ready(function(){
	$(".article_modif_more_popup").mouseleave(function(){
		$(this).hide("slow");
		$(this).next("img").attr("style", "opacity:1");
	});
});
