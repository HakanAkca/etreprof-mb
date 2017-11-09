<?php 
return [ 
		
	[
		"question" => "Comment avez vous connu EtreProf.fr ?",
		"code" => "connu",
		"format" => "radio",
		"required" => true,
		"reponses" => [ 
			 //"" => "Choisissez une réponse"
			 "facebook-groupe" => "Groupes enseignant·e·s Facebook",
			 "facebook-autre" => "Autre Facebook",
			 "twitter" => "Twitter",
			 "collegue" => "Par un·e collègue enseignant·e",
			 "autre" => "Autre, préciser :"
		]
	], 
	[
		"question" => "1. Enseigner pour vous c’est d’abord :",
		"code" => "enseigner",
		"format" => "radio",
		"required" => true,
		"score" => 10,
		"reponses" => [ 
			 300 => "Transmettre",
			 301 => "Faire pratiquer",
			 '302,304' => "Faire réfléchir",
			 303 => "Soutenir"
		]
	], 
	[
		"question" => "2. Quelle image représente le mieux l’enseignement selon vous :",
		"description" => "<small>(Images pressfoto – freepik)</small>",
		"code" => "image",
		"format" => "image",
		"required" => true,
		"score" => 10,
		"reponses" => [ 
			 300 => "https://etreprof.fr/photos/shares/default/Image_Profil_1.jpg?timestamp=1490952838",
			 301 => "https://etreprof.fr/photos/shares/default/Image_Profil_2.jpg?timestamp=1490952838",
			 '302,304' => "https://etreprof.fr/photos/shares/default/Image_Profil_3.jpg?timestamp=1490952838",
			 303 => "https://etreprof.fr/photos/shares/default/Image_Profil_4.jpg?timestamp=1490952838"
		]
	], 
	[
		"question" => "3. Pour faire classe il faut :",
		"notice" => "Classez les déclarations suivantes de la plus importante à la moins importante selon vous :",
		"code" => "ranking",
		"required" => true,
		"format" => "rank",
		"scores" => [
			1 => '<span class="glyphicon glyphicon-star"></span><br><small>(La moins importante)</small>',
			2 => '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>',
			3 => '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>',
			4 => '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><br><small>(La plus importante)</small>',

		],
		"reponses" => [ 
			 300 => "Maîtriser parfaitement le contenu à enseigner et planifier précisément ses cours pour transmettre et captiver les élèves.",
			 301 => "Montrer comment faire et faire pratiquer les élèves en les autonomisant progressivement.",
			 '302,304' => "Partir de ce que savent les élèves et les faire réfléchir pour leur permettre de développer leurs connaissances et compétences.",
			 303 => "Instaurer un climat de confiance, encourager les élèves et récompenser les efforts."
		]
	], 
	[
		"question" => "4.	Qu’aimeriez-vous trouver idéalement sur cette plateforme ? ",
		"code" => "attentes",
		"format" => "checkbox",
		"reponses" => [ 
			 'contenus' => "Des contenus directement utilisables",
			 'echanges' => "Des échanges avec d’autres enseignants",
			 'inspiration' => "De l’inspiration",
			 'gestion' => "Des ressources pour gérer ma classe",
			 'former' => "Des outils pour me former",
			 'autre' => "Autre (précisez) :"
		]
	] 
];