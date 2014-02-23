//Apelle le fichier php d'ajout du commentaire à la BDD, si succes la fonction l'ajoute au DOM
$(document).ready(function(){
	$("#nouveau_commentaire > form").submit(function(){
		var fichier = $(this).attr("action");
		var variables = $(this).serialize();
		$.post(fichier, variables, function(table){
				if(table.success == true){
					var div = document.createElement('div');
					div.innerHTML = table.commentaire;
					$(div).addClass('commentaire');
					$(div).insertBefore("#nouveau_commentaire");
					$("#nouveau_commentaire textarea").val("");
				}
			}, "json");
		return false;
	});
});

//soumet le formulaire de suppression d'un commentaire si on click sur l'image
$(document).ready(function(){
	$(".commentaire_supprimer > img").click(function(){
		$(this).next("form").submit();
	});
});

//Appelle le fichier php de suppression du commentaire à la BDD, si succes la fonction le cache du DOM
$(document).ready(function(){
	$(".commentaire_supprimer > form").submit(function(){
		var fichier = $(this).attr('action');
		var variables = $(this).serialize();
		var form_courant = $(this);
		$.post(fichier, variables, function(retour){
			if(retour.success == 1 && confirm("Etes-vous sûr de vouloir supprimer le commentaire")){
				form_courant.parent().parent().hide("slow");
			}
		}, "json");
		return false;
	});
});