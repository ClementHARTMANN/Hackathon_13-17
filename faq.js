// Récupère tous les éléments de question
var questions = document.querySelectorAll(".faq-question");

// Pour chaque question
questions.forEach(function(question) {
	// Ajoute un écouteur d'événement sur le clic
	question.addEventListener("click", function() {
		// Récupère l'élément réponse correspondant
		var answer = question.nextElementSibling;
		// Si la réponse est cachée
		if (answer.style.display === "none") {
			// Affiche la réponse
			answer.style.display = "block";
		} else {
			// Sinon, cache la réponse
			answer.style.display = "none";
		}
	});
});