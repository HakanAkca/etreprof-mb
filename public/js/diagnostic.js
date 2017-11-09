/* ______________________ CALCUL DES PERSPECTIVES DE L'INDIVIDU _________________________________*/



//initialisation des variables
var transmission = "";
var apprenti = "";
var developpement = "";
var soutien = "";
var reforme = "";
var erreur = "";

//textes de résultats pour les visions dominantes
var domiT = "Selon vous, un enseignement efficace nécessite de maîtriser parfaitement le contenu et de planifier correctement son enseignement. Une des premières responsabilités de l’enseignant selon cette vision est donc de présenter les choses de manière précise et efficace aux élèves. Il est de la responsabilité des élèves de faire les efforts pour apprendre ce contenu dans ses formes validées et sanctionnées. Pour vous, il est important de fournir des objectifs clairs, d'ajuster le rythme de leurs cours, de faire un usage efficace du temps, de clarifier les malentendus, de répondre aux questions, de fournir des retours opportuns, de corriger les erreurs, de résumer ce qui a été présenté, et d'établir des standards de réussite et d’évaluation élevés et enfin de développer des moyens objectifs d’évaluer l’apprentissage. Vous cherchez à transmettre votre enthousiasme aux élèves en ce qui concerne les sujets abordés en classe.";
var domiA = "Selon vous, enseigner efficacement consiste à faire en sorte que les élèves développent les bonnes méthodes de travail. Un bon enseignant doit donc être capable de montrer comment faire les choses de manière explicite. Vous traduisez les compétences à acquérir par vos élèves dans un langage accessible, et vous leur proposez une série de tâches organisées. Pour vous, il est important de commencer par des tâches simples avant de gagner en complexité, et vous proposez différents points de vue et entrées en fonction des capacités des élèves. Vous savez ce que vos élèves peuvent faire seuls et ce qu’ils ne peuvent faire qu'avec des conseils et des indications. Au fur et à mesure du développement des compétences de vos élèves vous leur donnez plus de responsabilités afin qu'ils deviennent autonomes.";
var domiD = "Selon vous, un enseignement efficace doit être planifié et réalisé en se mettant à la place de l’élève. Un bon enseignant doit comprendre comment les élèves pensent et réfléchissent à propos du contenu des cours. Pour faire progresser les élèves dans leur réflexion et l'acquisition de compétences, vous vous appuyez sur deux compétences : <ul><li>Un questionnement efficace qui met au défi les élèves et les fait passer à des modes de raisonnement plus complexes ;</li><li>Une identification des connaissances préalables des élèves pour leur proposer des exemples qui font sens pour eux.</li></ul>Vous avez donc tendance à utiliser des questions, problèmes, études de cas et exemples pour créer des liens qui vont vous permettre de &quot;transporter&quot; les élèves vers des manières de raisonner et de résoudre les problèmes plus complexes et sophistiquées. Il est important pour vous d'adapter vos cours au niveau de compréhension et à la manière de penser de chaque élève.";
var domiS = "Selon vous, un enseignement efficace part du principe que les efforts qui permettent aux élèves de réussir viennent autant du cœur que de la tête. Vous pensez que les élèves sont motivés et productifs quand ils travaillent sur des problèmes sans peur de l’échec. Vous encouragez et soutenez les élèves et ils savent que dans votre classe :<ul><li>Ils peuvent réussir à apprendre s’ils essayent vraiment ;</li><li>Leur réussite est le produit de leur propres efforts et capacités ;</li><li>Leurs efforts d’apprentissages sont soutenus par leur enseignant et leurs pairs.</li></ul>Pour vous, plus le contenu à apprendre est difficile, plus il est important que les élèves disposent d'un contexte positif pour soutenir leur apprentissage. Vous cherchez à promouvoir/installer un climat de confiance, en aidant les élèves à se fixer des objectifs exigeants mais réalisables et en fournissant des encouragements et du soutien. Vous avez des attentes claires et raisonnables pour tous les élèves. Vous ne voulez pas que vos élèves sacrifient leur confiance ou leur estime de soi au profit de la réussite. Ainsi, dans l’évaluation de l’apprentissage vous cherchez à prendre autant en compte l’évolution individuelle et les progrès que la réussite et les performances dans l’absolu.";
var domiR = "Selon vous, l'enseignement est efficace s'il cherche à changer la société de manière substantielle. Votre objectif principal est donc plutôt le collectif que l’individu. Vous cherchez à éveiller les élèves aux valeurs et aux idéologies qui restent d'habitude implicites. Vous remettez en question le statut quo et vous encouragez les élèves à reconsidérer la manière dont ils se positionnent. Vous mettez l'accent sur le but et l'origine de telle ou telle connaissance ou pratique. Vous cherchez à faire en sorte que les élèves questionnent ce qu'ils apprennent. Vous les encouragez à adopter un positionnement critique afin de leur donner le pouvoir d’agir pour améliorer leur propre vie. Même si la déconstruction critique est une compétence centrale dans cette vue de l’enseignement, elle n’est pas une fin en soi.";

//textes de résultats pour les visions de support
var suppT = "Vous pensez également qu'il est important pour un enseignant de parfaitement maîtriser le contenu de ses cours et qu'il doit avoir des objectifs précis pour être efficace. Préparer les élèves aux examens en leur permettant de maîtriser un maximum de connaissances et de compétences est également important pour vous. Vous établissez donc des objectifs précis pour vos cours, en ordonnant et planifiant précisément les choses.";
var suppA = "Vous pensez également qu'on ne peut pas dissocier les connaissances de leur application. Vous cherchez donc à proposer un contexte réel et authentique d'application des connaissances dans vos cours. Vous essayez autant que possible de &quot;montrer comment faire&quot;, car vous pensez que les élèves ont besoin de modèles pour comprendre et pour apprendre.";
var suppD = "Vous croyez également au potentiel cognitif de tous les élèves. Vous pensez qu'il est essentiel de partir de là où sont les élèves pour réussir à les faire progresser. Vous cherchez à complexifier les choses petit à petit pour les élèves. Vous considérez également qu'il faut leur laisser le temps de réfléchir pour trouver les solutions par eux-mêmes. Vous encouragez les élèves à se questionner.";
var suppS = "Pour vous, le contexte d'apprentissage a aussi son importance. Vous pensez qu'il est difficile de dissocier l'aspect affectif (émotions, motivation) de l'aspect cognitif (réflexion, mémorisation, compréhension). Vous cherchez donc à créer un climat rassurant ou l'erreur est permise. Vous essayez de proposer des défis surmontables aux élèves, en les aidant à développer une perception positive d'eux-mêmes. Vous mettez l'accent autant sur les efforts et les progrès que sur les réussites. Vous n'hésitez pas à exprimer vos sentiments et à favoriser l'expression des émotions des élèves. Vous reconnaissez la valeur de chaque élève.";
var suppR = "Pour vous, enseigner c'est aussi changer la société. Vous pensez que la construction d'un monde meilleur passe par l'apprentissage et l'enseignement. Vous cherchez donc à faire en sorte que les élèves interrogent leurs propres valeurs et leurs croyances pour qu'ils prennent conscience des stéréotypes et de l'implicite dans nos sociétés. Vos cours sont donc également focalisés sur les valeurs, en plus des connaissances.";

//textes de résultats pour les visions récessives
var receT = "Pour vous, le contenu des cours ne passe pas avant tout le reste et doit être adapté et modifié en fonction d'autres impératifs (difficultés des élèves, contexte de la classe, etc.). L'évaluation ne doit pas simplement consister à mesurer ce qui est acquis et mémorisé.";
var receA = "Pour vous, montrer aux élèves comment faire les choses en détail n'est pas votre préoccupation première. De même, vous ne cherchez pas systématiquement à faire en sorte que les exercices proposés soient applicables tels quels dans la &quot;vie réelle&quot;.";
var receD = "Pour vous, le fait de s'adapter au niveau de chaque élève et provoquer la réflexion et le questionnement ne sont pas des préoccupations premières.";
var receS = "Les émotions et &quot;l'ambiance&quot; dans votre classe ne sont pas à mettre au même niveau que le contenu des cours. Cet aspect est quelque chose de secondaire dans votre vision de l'enseignement et de l'apprentissage.";
var receR = "Vous ne cherchez pas directement à changer la société par le biais de votre enseignement.";


//Fonction de test pour savoir si la vision est dominante, de soutien ou récessive --> pour le tracé des cercles
function testDSR(visionDSR) {
    switch (visionDSR) {
        case "2" :
            return 45;
            break;
        case "1" :
            return 30;
            break;
        case "0" :
            return 15;
        default :
            return 0;
    }
}

//fonction pour la vision de transmission
function cercleT(resultatDSRvision) {
//création du tracé pour la dimension de transmission
    var cT = document.getElementById("canvasT");
    var ctxT = cT.getContext("2d");
    ctxT.fillStyle = "rgb(221, 221, 221)";
    ctxT.lineWidth = 2;
//dessin du fond
    ctxT.beginPath();
    ctxT.arc(70, 50, 50, 0, 2 * Math.PI);
    ctxT.fill();

//dessin du cercle dominant/soutien/récessif
    var circle2T = cT.getContext("2d");
    circle2T.fillStyle = "rgb(221,72,20)";
    ctxT.beginPath();
    ctxT.arc(70, 50, testDSR(resultatDSRvision), 0, 2 * Math.PI);
    ctxT.fill();

//écriture du nom de la vision
    ctxT.font = "18px Calibri,Geneva,Arial";
    ctxT.fillStyle = "black";
    ctxT.fillText("Vision de", 35, 115);
    ctxT.fillText("transmission", 22, 130);
}

//fonction pour la vision de l'apprenti
function cercleA(resultatDSRvision) {
//création du tracé pour la dimension d'apprenti
    var cA = document.getElementById("canvasA");
    var ctxA = cA.getContext("2d");
    ctxA.fillStyle = "rgb(221, 221, 221)";
    ctxA.lineWidth = 2;
//dessin du fond
    ctxA.beginPath();
    ctxA.arc(70, 50, 50, 0, 2 * Math.PI);
    ctxA.fill();

//dessin du cercle dominant/soutien/récessif
    var circle2A = cA.getContext("2d");
    circle2A.fillStyle = "rgb(221,72,20)";
    ctxA.beginPath();
    ctxA.arc(70, 50, testDSR(resultatDSRvision), 0, 2 * Math.PI);
    ctxA.fill();

//écriture du nom de la vision
    ctxA.font = "18px Calibri,Geneva,Arial";
    ctxA.fillStyle = "black";
    ctxA.fillText("Vision du maître", 12, 115);
    ctxA.fillText("et de l'apprenti", 16, 130);
}

//fonction pour la vision de développement
function cercleD(resultatDSRvision) {
    //création du tracé pour la dimension de développement
    var cD = document.getElementById("canvasD");
    var ctxD = cD.getContext("2d");
    ctxD.fillStyle = "rgb(221, 221, 221)";
    ctxD.lineWidth = 2;
//dessin du fond
    ctxD.beginPath();
    ctxD.arc(70, 50, 50, 0, 2 * Math.PI);
    ctxD.fill();

//dessin du cercle dominant/soutien/récessif
    var circle2D = cD.getContext("2d");
    circle2D.fillStyle = "rgb(221,72,20)";
    ctxD.beginPath();
    ctxD.arc(70, 50, testDSR(resultatDSRvision), 0, 2 * Math.PI);
    ctxD.fill();

//écriture du nom de la vision
    ctxD.font = "18px Calibri,Geneva,Arial";
    ctxD.fillStyle = "black";
    ctxD.fillText("Vision de", 35, 115);
    ctxD.fillText("développement", 10, 130);
}

//fonction pour la vision de soutien
function cercleS(resultatDSRvision) {
//création du tracé pour la dimension de soutien
    var cS = document.getElementById("canvasS");
    var ctxS = cS.getContext("2d");
    ctxS.fillStyle = "rgb(221, 221, 221)";
    ctxS.lineWidth = 2;
//dessin du fond
    ctxS.beginPath();
    ctxS.arc(70, 50, 50, 0, 2 * Math.PI);
    ctxS.fill();

//dessin du cercle dominant/soutien/récessif
    var circle2S = cS.getContext("2d");
    circle2S.fillStyle = "rgb(221,72,20)";
    ctxS.beginPath();
    ctxS.arc(70, 50, testDSR(resultatDSRvision), 0, 2 * Math.PI);
    ctxS.fill();

//écriture du nom de la vision
    ctxS.font = "18px Calibri,Geneva,Arial";
    ctxS.fillStyle = "black";
    ctxS.fillText("Vision de", 35, 115);
    ctxS.fillText("soutien", 41, 130);
}

//fonction pour la vision de changement de société
function cercleR(resultatDSRvision) {
//création du tracé pour la dimension de changement de société
    var cR = document.getElementById("canvasR");
    var ctxR = cR.getContext("2d");
    ctxR.fillStyle = "rgb(221, 221, 221)";
    ctxR.lineWidth = 2;
//dessin du fond
    ctxR.beginPath();
    ctxR.arc(70, 50, 50, 0, 2 * Math.PI);
    ctxR.fill();

//dessin du cercle dominant/soutien/récessif
    var circle2R = cR.getContext("2d");
    circle2R.fillStyle = "rgb(221,72,20)";
    ctxR.beginPath();
    ctxR.arc(70, 50, testDSR(resultatDSRvision), 0, 2 * Math.PI);
    ctxR.fill();

//écriture du nom de la vision
    ctxR.font = "18px Calibri,Geneva,Arial";
    ctxR.fillStyle = "black";
    ctxR.fillText("Vision de", 36, 115);
    ctxR.fillText("changement social", 0, 130);
}

//fonction de vision dominante
//inscription des visions dominantes de l'individu avec picto avant
function visionDominante(traDSR, appDSR, devDSR, souDSR, refDSR) {
    if (traDSR == 2) {
        document.write('<tr><td width="80px"><svg height="50px"  xmlns="http://www.w3.org/2000/svg" fill="rgb(221,72,20)" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 77.036" enable-background="new 0 0 100 77.036" xml:space="preserve"><circle  cx="50" cy="3.125" r="3.125"></circle><circle cx="40.021" cy="4.952" r="3.125"></circle><circle  cx="31.287" cy="9.998" r="3.125"></circle><circle cx="24.803" cy="17.725" r="3.125"></circle><path  d="M45.67,53.313c0-0.004-0.002-0.005-0.004-0.01l-4.022-10.059c-0.249-11.273-9.479-20.373-20.811-20.373  C9.347,22.872,0,32.219,0,43.705c0,5.812,2.398,11.069,6.25,14.853v18.479h25v-7.248c5.743,0,9.375-3.675,9.375-9.419v-4.166h3.125  c1.151,0,2.083-0.933,2.083-2.084C45.833,53.863,45.67,53.313,45.67,53.313z M12.5,52.039c-1.725,0-3.125-1.4-3.125-3.125  c0-1.726,1.4-3.125,3.125-3.125s3.125,1.399,3.125,3.125C15.625,50.639,14.225,52.039,12.5,52.039z M12.5,43.705  c-1.725,0-3.125-1.399-3.125-3.125c0-1.725,1.4-3.125,3.125-3.125s3.125,1.399,3.125,3.125C15.625,42.306,14.225,43.705,12.5,43.705  z M20.833,52.039c-1.726,0-3.125-1.4-3.125-3.125c0-1.726,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125  C23.958,50.639,22.559,52.039,20.833,52.039z M20.833,43.705c-1.726,0-3.125-1.399-3.125-3.125c0-1.725,1.399-3.125,3.125-3.125  c1.725,0,3.125,1.399,3.125,3.125C23.958,42.306,22.559,43.705,20.833,43.705z M20.833,35.372c-1.726,0-3.125-1.4-3.125-3.125  s1.399-3.125,3.125-3.125c1.725,0,3.125,1.4,3.125,3.125S22.559,35.372,20.833,35.372z M29.167,52.039  c-1.725,0-3.125-1.4-3.125-3.125c0-1.726,1.4-3.125,3.125-3.125c1.726,0,3.125,1.399,3.125,3.125  C32.292,50.639,30.892,52.039,29.167,52.039z M29.167,43.705c-1.725,0-3.125-1.399-3.125-3.125c0-1.725,1.4-3.125,3.125-3.125  c1.726,0,3.125,1.399,3.125,3.125C32.292,42.306,30.892,43.705,29.167,43.705z"></path><circle cx="59.855" cy="4.952" r="3.125"></circle><circle  cx="68.59" cy="9.998" r="3.125"></circle><circle cx="75.073" cy="17.725" r="3.125"></circle><path  d="M79.167,22.872c-11.333,0-20.562,9.1-20.812,20.373l-4.021,10.059c-0.002,0.005-0.005,0.006-0.005,0.01  c0,0-0.162,0.55-0.162,0.806c0,1.151,0.932,2.084,2.083,2.084h3.125v4.166c0,5.744,3.632,9.419,9.375,9.419v7.248h25V58.558  c3.852-3.783,6.25-9.04,6.25-14.853C100,32.219,90.653,22.872,79.167,22.872z M79.167,52.039c-1.726,0-3.125-1.4-3.125-3.125  c0-1.726,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125C82.292,50.639,80.892,52.039,79.167,52.039z M79.167,43.705  c-1.726,0-3.125-1.399-3.125-3.125c0-1.725,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125  C82.292,42.306,80.892,43.705,79.167,43.705z M79.167,35.372c-1.726,0-3.125-1.4-3.125-3.125s1.399-3.125,3.125-3.125  c1.725,0,3.125,1.4,3.125,3.125S80.892,35.372,79.167,35.372z"></path></svg></td>');
        document.write('<td><b>La vision de transmission</b><br />' + domiT + '<br /><br /></td></tr>');
        //document.write(transmission + '<br />');
    }
    if (appDSR == 2) {
        document.write('<tr><td width="80px"><svg height="60px" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 312.484 211.2525" style="enable-background:new 0 0 312.484 169.002;" xml:space="preserve"><g><circle cx="156.242" cy="61.414" r="22.5"/><path d="M112.113,114.424c3.812,10.202,12.786,21.188,30.096,35.292c1.482,1.2,3.264,1.784,5.033,1.784   c2.328,0,4.639-1.012,6.221-2.962c2.779-3.434,2.254-8.472-1.178-11.253c-16.262-13.101-23.238-22.844-25.147-28.36   c-0.001-0.002-0.002-0.004-0.003-0.007c-0.63-1.732-0.809-3.014-0.811-3.969c0.005-0.236,0.02-0.452,0.04-0.658   c0.114-1.188,0.476-1.925,1.136-2.839c0.402-0.554,0.995-1.118,1.694-1.658v8.933c1.282,3.304,5.615,11.102,20.118,23.494   l-0.958-4.768l2.941-0.592l1.691,8.418c0.186,0.149,0.363,0.297,0.551,0.448c3.971,3.219,4.821,8.867,2.17,13.088l1.662,8.27h8.751   c-1.654-3.37-1.349-7.535,1.142-10.658c9.748-12.186,14.123-21.054,16.023-27.05v-17.905c1.888,2.147,3.255,4.793,3.414,9.209   c0.006,0.171,0.016,0.338,0.019,0.515c0,1.369-0.139,2.922-0.477,4.692c-1.327,7.067-6.077,17.611-17.415,31.787   c-2.758,3.453-2.192,8.487,1.26,11.244c1.475,1.177,3.238,1.748,4.988,1.748c2.35,0,4.678-1.03,6.258-3.009   c12.273-15.41,18.484-27.892,20.602-38.668c0.007-0.033,0.018-0.063,0.023-0.097c0.436-2.283,0.67-4.479,0.733-6.6   c0.011-0.367,0.027-0.736,0.027-1.099c0.015-5.989-1.536-11.265-3.938-15.445c-3.616-6.306-8.792-10.056-12.889-12.275   c-4.132-2.222-7.338-2.997-7.803-3.112c-0.587-0.139-1.174-0.203-1.753-0.211c-0.257-0.025-0.517-0.039-0.779-0.039h-3.512   c-4.269,3.614-9.785,5.8-15.805,5.8c-6.019,0-11.534-2.186-15.804-5.8h-3.515c-0.289,0-0.573,0.019-0.854,0.05   c-0.349,0.015-0.698,0.045-1.051,0.107h-0.002c-0.487,0.111-5.659,0.974-11.519,4.178c-2.921,1.624-6.082,3.881-8.697,7.272   c-2.617,3.354-4.51,8.03-4.477,13.229c-0.001,0.873,0.063,1.76,0.16,2.651c0.244,2.222,0.776,4.493,1.614,6.794   C112.104,114.405,112.109,114.414,112.113,114.424z"/><circle cx="75.467" cy="92.779" r="21.195"/><circle cx="237.018" cy="92.779" r="21.195"/><path d="M312.484,169.002v-5.261h-50.272v-11.104c-4.021,0.67-8.669,1.112-14.15,1.356c-0.121,0.005-0.246,0.009-0.367,0.009   c-1.947,0-3.739-0.654-5.173-1.754l-2.455,5.505h15.376v3.333h-32.334v-3.333h13.675l3.558-7.979   c-0.67-1.155-1.076-2.485-1.137-3.913c-0.177-4.208,2.753-7.83,6.747-8.67l3.845-8.621l2.74,1.222l-3.175,7.118   c5.906-0.324,10.044-0.97,12.851-1.602v-8.995c1.746,1.201,3.502,2.606,4.873,3.999c1.03,1.033,1.826,2.047,2.298,2.838   c0.028,0.047,0.067,0.102,0.093,0.147c0.23,0.403,0.366,0.729,0.429,0.935c0.011,0.035,0.02,0.065,0.026,0.092   c-0.23,0.235-0.848,0.75-2.139,1.33c-0.007,0.003-0.014,0.008-0.022,0.011c-3.109,1.44-9.737,2.922-20.348,3.342   c-3.586,0.151-6.371,3.182-6.221,6.769c0.148,3.494,3.027,6.226,6.492,6.226c0.092,0,0.184-0.002,0.275-0.006   c11.536-0.515,19.382-1.918,25.169-4.491c0.007-0.003,0.014-0.005,0.021-0.008c2.064-0.939,3.905-2.069,5.458-3.501   c0.551-0.507,1.067-1.051,1.542-1.64c1.826-2.223,2.841-5.163,2.805-7.864c-0.055-4.254-1.892-7.508-3.921-10.222   c-3.127-4.06-7.22-7.259-11.072-9.731c-1.935-1.228-3.796-2.242-5.54-3.021c-0.879-0.388-1.723-0.72-2.612-0.989   c-0.74-0.211-1.481-0.406-2.486-0.485c-0.381-0.075-0.774-0.116-1.177-0.116h-3.532c-4.123,3.757-9.6,6.05-15.604,6.05   c-5.471,0-10.501-1.907-14.472-5.086c-2.142,0.452-8.123,2.605-13.603,10.248c-5.582,7.723-10.745,20.579-12.709,42.604h-12.948   v-5.333c-0.132,0.166-0.256,0.33-0.389,0.497c-1.906,2.391-4.758,3.764-7.822,3.764c-2.254,0-4.469-0.775-6.236-2.185   c-0.026-0.021-0.048-0.045-0.074-0.065h-29.057v-3.333h14.604l-1.117-5.559c-1.704,1.267-3.774,1.974-5.953,1.974   c-2.281,0-4.516-0.792-6.291-2.231c-4.396-3.582-8.3-7.008-11.756-10.313v22.784h-12.947c-1.965-22.025-7.128-34.881-12.71-42.604   c-5.478-7.64-11.455-9.794-13.601-10.248c-3.971,3.18-9.001,5.087-14.473,5.087c-6.004,0-11.481-2.293-15.604-6.05h-3.532   c-0.376,0-0.743,0.039-1.101,0.104c-1.467,0.105-2.392,0.439-3.441,0.786c-3.905,1.443-8.606,4.226-13.087,7.995   c-2.208,1.894-4.305,4.012-6.021,6.507c-1.681,2.481-3.133,5.459-3.167,9.173c-0.034,2.698,0.98,5.642,2.806,7.864   c0.477,0.592,0.996,1.137,1.55,1.646c1.554,1.429,3.394,2.556,5.458,3.494l0,0c0.001,0,0.001,0.001,0.002,0.001   c5.789,2.578,13.639,3.983,25.185,4.498c0.092,0.004,0.184,0.006,0.275,0.006c3.465,0,6.344-2.731,6.492-6.226   c0.15-3.587-2.635-6.617-6.221-6.769c-10.63-0.421-17.265-1.907-20.367-3.35c-0.002-0.001-0.003-0.002-0.005-0.003   c-1.29-0.579-1.921-1.102-2.144-1.333c0.025-0.091,0.069-0.225,0.15-0.41c0.085-0.211,0.223-0.472,0.399-0.762   c0.455-0.749,1.194-1.716,2.156-2.689c1.394-1.438,3.213-2.901,5.021-4.146v8.994c2.807,0.632,6.944,1.277,12.851,1.602   l-3.175-7.118l2.74-1.222l3.845,8.621c3.994,0.84,6.924,4.462,6.747,8.67c-0.061,1.428-0.467,2.758-1.137,3.913l3.558,7.979h13.675   v3.333H57.041v-3.333h15.376l-2.455-5.505c-1.434,1.1-3.225,1.754-5.173,1.754c-0.121,0-0.246-0.004-0.367-0.009   c-5.481-0.244-10.129-0.687-14.15-1.356v11.104H0v5.261H312.484z M219.465,128.772c0.121-0.167,0.238-0.311,0.357-0.467v18.933   v16.503h-10.533C211.183,144.028,215.803,133.789,219.465,128.772z M103.194,163.741H92.662v-16.503v-18.925   c0.486,0.639,0.989,1.355,1.51,2.179C97.6,135.977,101.494,146.053,103.194,163.741z"/><path d="M75.832,0C60.92,0.002,48.833,12.089,48.831,27.002c0.002,14.91,12.089,26.997,27.001,26.999   c14.91-0.002,26.997-12.089,27-26.999C102.829,12.089,90.742,0.002,75.832,0z M75.832,50c-12.703-0.021-22.979-10.297-23-22.998   c0.021-12.704,10.297-22.978,23-23.001c12.701,0.023,22.975,10.297,22.999,23.001C98.808,39.703,88.533,49.979,75.832,50z"/><polygon points="76.163,24.55 65.463,14.306 62.699,17.196 62.697,17.196 75.498,29.453 92.531,20.261 90.633,16.742  "/><rect x="74.998" y="5.668" width="1.666" height="6.668"/><rect x="74.998" y="41.67" width="1.666" height="6.666"/><rect x="54.498" y="26.169" width="6.668" height="1.667"/><rect x="90.5" y="26.169" width="6.666" height="1.667"/></g></svg></td>');
        document.write('<td><b>La vision du maître et de l&#39;apprenti</b><br />' + domiA + '<br /><br /></td></tr>');
        //document.write(apprenti + '<br />');
    }
    if (devDSR == 2) {
        document.write('<tr><td width="80px"><svg width="50px" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M60.01,22.264c-0.527-1.055-1.274-2.007-2.215-2.786l0.782-3.326c-0.188-0.119-0.37-0.244-0.568-0.354  s-0.4-0.198-0.601-0.295L55,17.927c-1.159-0.386-2.363-0.516-3.536-0.405l-1.798-2.901c-0.437,0.099-0.867,0.222-1.29,0.369  l0.009,3.413c-1.055,0.527-2.007,1.274-2.786,2.215l-3.326-0.782c-0.119,0.188-0.244,0.37-0.354,0.568  c-0.109,0.197-0.198,0.4-0.295,0.6l2.423,2.408c-0.386,1.16-0.516,2.363-0.405,3.536l-2.901,1.798  c0.099,0.437,0.222,0.867,0.369,1.29l3.413-0.009c0.527,1.055,1.274,2.007,2.215,2.786l-0.781,3.326  c0.188,0.119,0.37,0.244,0.568,0.354c0.197,0.109,0.4,0.198,0.601,0.294l2.408-2.423c1.159,0.386,2.362,0.516,3.536,0.405  l1.798,2.901c0.437-0.099,0.867-0.222,1.29-0.369l-0.009-3.413c1.055-0.527,2.007-1.274,2.786-2.215l3.325,0.782  c0.119-0.188,0.244-0.37,0.354-0.568s0.198-0.4,0.294-0.6l-2.423-2.408c0.386-1.16,0.516-2.363,0.405-3.536l2.901-1.798  c-0.099-0.437-0.222-0.867-0.369-1.289L60.01,22.264z M56.583,28.284c-0.623,1.124-1.647,1.938-2.884,2.292  c-0.438,0.125-0.887,0.188-1.331,0.188c-0.807,0-1.604-0.205-2.328-0.607c-2.32-1.288-3.16-4.223-1.872-6.543  c1.287-2.319,4.22-3.16,6.543-1.873C57.03,23.028,57.871,25.963,56.583,28.284z"/><path d="M38.641,39.829c-0.054-0.283-0.141-0.55-0.25-0.804l1.438-2.429c-0.121-0.153-0.249-0.299-0.382-0.439l-2.623,1.076  c-0.47-0.287-0.998-0.469-1.557-0.538l-1.391-2.473c-0.096,0.014-0.191,0.022-0.288,0.04c-0.096,0.018-0.188,0.046-0.282,0.069  l-0.379,2.811c-0.494,0.27-0.918,0.635-1.25,1.075l-2.836-0.032c-0.072,0.18-0.137,0.362-0.193,0.549l2.233,1.727  c-0.007,0.276,0.01,0.557,0.064,0.84c0.054,0.283,0.141,0.55,0.25,0.804l-1.439,2.429c0.121,0.153,0.249,0.298,0.382,0.439  l2.623-1.076c0.47,0.287,0.999,0.469,1.558,0.538l1.389,2.473c0.096-0.014,0.191-0.022,0.287-0.04  c0.096-0.018,0.188-0.047,0.282-0.069l0.38-2.812c0.494-0.27,0.918-0.635,1.249-1.075l2.835,0.032  c0.072-0.18,0.137-0.362,0.193-0.549l-2.233-1.727C38.713,40.392,38.695,40.112,38.641,39.829z M35.06,41.956  c-0.769,0.147-1.511-0.357-1.658-1.126c-0.147-0.769,0.357-1.511,1.126-1.658c0.769-0.147,1.511,0.357,1.658,1.125  C36.333,41.067,35.829,41.809,35.06,41.956z"/><path d="M83.146,43.782c-0.656-0.937-1.276-1.822-1.645-2.449c-1.399-2.387-1.513-2.687-0.964-5.432  c0.504-2.523-0.19-4.882-0.926-7.379c-0.222-0.751-0.448-1.521-0.648-2.32l-0.099-0.409C74.829,8.904,59.82,5.164,47.94,5  C21.592,4.606,14.846,26.885,14.576,34.709c-0.25,7.24,3.617,16.408,6.309,20.324c2.566,3.732,4.521,11.326,4.756,18.468  c0.212,6.442-7.099,18.83-8.238,20.717C17.042,94.854,17.313,96,18.396,96H61c1.229,0,1.431-1.108,1.437-1.471  c0.039-2.586,0.511-4.305,0.928-5.822c0.415-1.512,0.773-2.817,0.501-4.387c-0.56-3.214,0.229-6.225,2.011-7.671  c0.829-0.675,3.958-1.075,6.472-1.397c2.637-0.338,4.914-0.63,6.111-1.26c2.838-1.495,2.414-6.108,2.046-7.216  c-0.031-0.095-0.068-0.193-0.107-0.296c-0.236-0.627-0.367-0.973,0.347-1.686c1.439-1.439,1.339-2.726,0.789-3.848  c0.449-0.362,0.791-0.815,0.998-1.334c0.231-0.58,0.395-1.517-0.143-2.68c-0.216-0.468-0.263-0.85-0.138-1.138  c0.188-0.437,0.772-0.71,1.229-0.862c1.711-0.57,3.521-1.422,3.351-4.327C86.738,49.021,85.245,46.778,83.146,43.782z   M41.957,44.958l-3.173-0.036c-0.087,0.08-0.172,0.161-0.264,0.236l-0.425,3.145c-0.543,0.232-1.117,0.413-1.721,0.529  s-1.204,0.159-1.795,0.144l-1.555-2.767c-0.112-0.035-0.221-0.079-0.331-0.121l-2.936,1.204c-0.958-0.716-1.769-1.631-2.354-2.705  l1.622-2.738c-0.013-0.058-0.031-0.114-0.042-0.173c-0.011-0.059-0.015-0.117-0.025-0.176l-2.517-1.947  c0.148-1.214,0.564-2.363,1.19-3.382l3.173,0.036c0.087-0.08,0.172-0.161,0.263-0.236l0.425-3.145  c0.544-0.232,1.118-0.413,1.721-0.529c0.604-0.115,1.204-0.159,1.795-0.144l1.555,2.767c0.113,0.036,0.222,0.08,0.333,0.122  l2.935-1.204c0.958,0.716,1.769,1.63,2.354,2.705l-1.622,2.738c0.013,0.058,0.031,0.114,0.042,0.173  c0.011,0.059,0.015,0.117,0.025,0.176l2.517,1.947C43,42.791,42.583,43.939,41.957,44.958z M62.92,26.437  c-0.016,0.614-0.079,1.229-0.203,1.84l2.554,2.539c-0.239,0.664-0.519,1.32-0.868,1.958c-0.015,0.028-0.026,0.057-0.041,0.084  s-0.034,0.052-0.05,0.08c-0.357,0.633-0.765,1.218-1.202,1.772l-3.506-0.824c-0.452,0.428-0.941,0.808-1.454,1.146l0.01,3.608  c-0.648,0.304-1.313,0.567-1.998,0.768c-0.062,0.018-0.124,0.036-0.186,0.053c-0.688,0.192-1.391,0.321-2.101,0.405l-1.901-3.067  c-0.614-0.016-1.229-0.079-1.84-0.203l-2.539,2.554c-0.664-0.239-1.32-0.519-1.957-0.867c-0.028-0.015-0.057-0.026-0.084-0.041  c-0.028-0.015-0.052-0.034-0.08-0.05c-0.633-0.357-1.218-0.765-1.772-1.202l0.824-3.506c-0.429-0.453-0.808-0.941-1.147-1.454  l-3.608,0.01c-0.304-0.648-0.567-1.313-0.768-1.998c-0.018-0.062-0.036-0.124-0.053-0.186c-0.192-0.688-0.321-1.391-0.406-2.102  l3.067-1.901c0.016-0.614,0.079-1.229,0.203-1.84l-2.554-2.539c0.239-0.664,0.519-1.32,0.867-1.958  c0.015-0.028,0.026-0.057,0.042-0.084s0.034-0.052,0.05-0.08c0.357-0.633,0.765-1.218,1.202-1.772l3.506,0.824  c0.453-0.428,0.941-0.808,1.454-1.146l-0.01-3.608c0.648-0.304,1.313-0.567,1.998-0.768c0.062-0.018,0.124-0.036,0.186-0.053  c0.688-0.192,1.391-0.321,2.102-0.405l1.901,3.067c0.614,0.016,1.229,0.079,1.84,0.203l2.539-2.554  c0.664,0.239,1.32,0.519,1.957,0.867c0.028,0.015,0.057,0.026,0.084,0.041s0.052,0.034,0.08,0.05  c0.633,0.357,1.218,0.765,1.772,1.202l-0.824,3.506c0.428,0.452,0.808,0.941,1.146,1.454l3.608-0.01  c0.304,0.647,0.567,1.313,0.768,1.998c0.018,0.062,0.036,0.124,0.053,0.186c0.192,0.688,0.321,1.391,0.406,2.102L62.92,26.437z"/><path d="M53.74,23.49c-0.431-0.239-0.898-0.353-1.359-0.353c-0.99,0-1.951,0.522-2.465,1.447c-0.364,0.657-0.451,1.416-0.244,2.138  c0.206,0.722,0.682,1.321,1.339,1.685c0.656,0.366,1.417,0.451,2.139,0.245c0.722-0.207,1.32-0.683,1.686-1.339  C55.587,25.958,55.096,24.242,53.74,23.49z"/></svg></td>');
        document.write('<td><b>La vision de développement</b><br />' + domiD + '<br /><br /></td></tr>');
        //document.write(developpement + '<br />');
    }
    if (souDSR == 2) {
        document.write('<tr><td width="80px"><svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 90 112.5" style="enable-background:new 0 0 90 90;" xml:space="preserve"><path class="st0" d="M77.1,78.2"/><line class="st0" x1="78.1" y1="78.2" x2="78.1" y2="78.2"/><path class="st1" d="M75.4,36.5H56.8c0,0,0,0,0.8-3.5s1.2-10,0.3-14.5C57,14,52.8,13,51.2,12c-1.6-1-4,1.8-4,1.8s-0.1,1,0.2,8.1  c0.3,7.1-14.8,21.4-14.8,21.4l-0.4,0.3c0,0-0.5,25.5,0,27.2c0.6,1.8,5.3,3,5.3,3h32.6c0,0,3.3-1.3,5-3.6c1.8-2.3,0.7-5.2,0.7-5.2  s1.9-1.2,2.8-3.1c0.9-1.9,0-5.8,0-5.8s1.8-1.4,2.3-3.2S80.1,48,80.1,48s1.1-1.3,1.6-5.2C82.2,38.9,75.4,36.5,75.4,36.5z"/><path class="st1" d="M24,75.6h-13c-1.5,0-2.6-1.5-2.6-3.4v-28c0-1.9,1.2-3.4,2.6-3.4h13c1.5,0,2.6,1.5,2.6,3.4v28  C26.6,74,25.4,75.6,24,75.6z"/></svg></td>');
        document.write('<td><b>La vision de soutien émotionnel</b><br />' + domiS + '<br /><br /></td></tr>');
        //document.write(soutien + '<br />');
    }
    if (refDSR == 2) {
        document.write('<tr><td width="80px"> <svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 64 80" enable-background="new 0 0 64 64" xml:space="preserve"><g><path d="M43.213,3.831C40.34,2.612,36.975,1.96,33.496,1.96c-7.666,0-15.133,3.1-19.472,8.082   c-4.518,5.208-5.728,11.116-3.582,17.572c0.217,0.643,0.085,1.768-0.331,2.949c-0.321,0.907-0.803,1.787-1.314,2.722   c-0.369,0.652-0.728,1.323-1.068,2.051c-0.406,0.898-0.813,2.08-0.331,3.185c0.482,1.096,1.635,1.607,2.571,1.909l0.132,0.095   l0.151,0.18c0.151,0.586,0.246,1.21,0.35,1.909l0.473,2.458c0.161,0.567,0.34,1.049,0.558,1.475   c0.652,1.295,0.87,2.467,0.737,3.932c-0.132,1.456,0.359,2.391,0.785,2.902c0.614,0.737,1.531,1.182,2.656,1.276   c1.011,0.085,2.212,0.18,3.393,0.18c0.832,0,1.588-0.047,2.306-0.132c0.709-0.095,1.295-0.142,1.768-0.142   c1.597,0,2.325,0.406,3.526,2.874c0.435,0.87,0.851,1.749,1.276,2.628l0.936,1.976l21.382-11.078l-0.378-1.701   c-0.113-0.444-0.189-0.87-0.246-1.295c-0.567-4.093,1.333-7.789,3.346-11.702c0.662-1.314,1.427-2.789,2.032-4.225   c0.52-1.21,0.917-2.495,1.21-3.828C58.489,18.057,53.082,8.028,43.213,3.831z M36.748,34.391c-1.446,0-2.807-0.246-4.074-0.699   h-0.047c-0.236,0.028-0.454,0.076-0.643,0.18c-0.435,0.198-0.879,0.378-1.333,0.529c-0.227,0.076-0.454,0.123-0.681,0.189   c-1.115,0.274-2.297,0.35-3.535,0.227c-0.028,0-0.057-0.009-0.085-0.009c-0.095-0.028-0.123-0.047-0.142-0.047l-0.113-0.123   c-0.019-0.076-0.019-0.113-0.019-0.142l0.009-0.076c0.009-0.028,0.038-0.085,0.104-0.18c0.359-0.473,0.709-0.955,1.078-1.437   l0.378-0.52c0.217-0.274,0.359-0.482,0.444-0.718c0.095-0.302,0.047-0.558-0.038-0.775h-0.009   c-2.221-2.231-3.611-5.312-3.611-8.696c0-6.806,5.511-12.317,12.317-12.317c6.796,0,12.298,5.511,12.298,12.317   C49.046,28.89,43.544,34.391,36.748,34.391z"/><path d="M36.95,30.403c-0.382,0-0.745-0.157-1.02-0.431c-0.28-0.28-0.427-0.647-0.422-1.03   c0.005-0.824,0.647-1.466,1.481-1.466c0.799,0.015,1.437,0.682,1.427,1.481c-0.01,0.799-0.667,1.447-1.461,1.447"/><path d="M41.412,20.792c-0.535,0.691-1.216,1.265-1.878,1.824l-0.162,0.137c-0.932,0.785-1.04,1.015-1.064,2.231   c-0.005,0.319-0.015,0.633-0.015,0.946c0,0.221-0.078,0.294-0.289,0.294c-0.147,0.005-0.294,0.005-0.441,0.005h-0.525v-0.005   h-1.285c-0.24,0-0.275-0.064-0.284-0.26c-0.049-0.991,0.029-1.981,0.226-2.932c0.108-0.52,0.387-0.981,0.883-1.451   c0.392-0.378,0.819-0.74,1.226-1.094c0.196-0.172,0.397-0.343,0.588-0.515l0.034-0.029c0.118-0.103,0.245-0.211,0.353-0.338   c0.544-0.618,0.476-1.52-0.157-2.094c-0.495-0.451-1.103-0.618-1.952-0.51c-1.025,0.128-1.682,0.755-2.006,1.922   c-0.01,0.034-0.015,0.069-0.02,0.103s-0.015,0.064-0.025,0.098c-0.059,0.196-0.167,0.191-0.255,0.177   c-0.789-0.093-1.584-0.186-2.368-0.289c-0.157-0.02-0.24-0.083-0.226-0.324c0.152-2.02,1.765-3.683,3.923-4.045   c1.255-0.211,2.408-0.127,3.457,0.24c1.393,0.49,2.329,1.388,2.785,2.663C42.353,18.708,42.176,19.802,41.412,20.792z"/></g></svg></td>');
        document.write('<td><b>La vision de changement de société</b><br />' + domiR + '<br /><br /></td></tr>');
        //document.write(reforme + '<br />');
    }
    if (traDSR != 2 && appDSR != 2 && devDSR != 2 && souDSR != 2 && refDSR != 2) {
        document.write('<tr><td colspan="2">Aucune vision de l&#39;enseignement n&#39;est dominante chez vous.<br /><br /></td></tr>');
    }
}


//fonction de vision de support
function visionSupport(traDSR, appDSR, devDSR, souDSR, refDSR) {
    //écriture du texte avec picto avant
    if (traDSR == 1) {
        document.write('<tr><td width="80px"><svg height="50px"  xmlns="http://www.w3.org/2000/svg" fill="rgb(255, 200, 181)" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 77.036" enable-background="new 0 0 100 77.036" xml:space="preserve"><circle  cx="50" cy="3.125" r="3.125"></circle><circle cx="40.021" cy="4.952" r="3.125"></circle><circle  cx="31.287" cy="9.998" r="3.125"></circle><circle cx="24.803" cy="17.725" r="3.125"></circle><path  d="M45.67,53.313c0-0.004-0.002-0.005-0.004-0.01l-4.022-10.059c-0.249-11.273-9.479-20.373-20.811-20.373  C9.347,22.872,0,32.219,0,43.705c0,5.812,2.398,11.069,6.25,14.853v18.479h25v-7.248c5.743,0,9.375-3.675,9.375-9.419v-4.166h3.125  c1.151,0,2.083-0.933,2.083-2.084C45.833,53.863,45.67,53.313,45.67,53.313z M12.5,52.039c-1.725,0-3.125-1.4-3.125-3.125  c0-1.726,1.4-3.125,3.125-3.125s3.125,1.399,3.125,3.125C15.625,50.639,14.225,52.039,12.5,52.039z M12.5,43.705  c-1.725,0-3.125-1.399-3.125-3.125c0-1.725,1.4-3.125,3.125-3.125s3.125,1.399,3.125,3.125C15.625,42.306,14.225,43.705,12.5,43.705  z M20.833,52.039c-1.726,0-3.125-1.4-3.125-3.125c0-1.726,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125  C23.958,50.639,22.559,52.039,20.833,52.039z M20.833,43.705c-1.726,0-3.125-1.399-3.125-3.125c0-1.725,1.399-3.125,3.125-3.125  c1.725,0,3.125,1.399,3.125,3.125C23.958,42.306,22.559,43.705,20.833,43.705z M20.833,35.372c-1.726,0-3.125-1.4-3.125-3.125  s1.399-3.125,3.125-3.125c1.725,0,3.125,1.4,3.125,3.125S22.559,35.372,20.833,35.372z M29.167,52.039  c-1.725,0-3.125-1.4-3.125-3.125c0-1.726,1.4-3.125,3.125-3.125c1.726,0,3.125,1.399,3.125,3.125  C32.292,50.639,30.892,52.039,29.167,52.039z M29.167,43.705c-1.725,0-3.125-1.399-3.125-3.125c0-1.725,1.4-3.125,3.125-3.125  c1.726,0,3.125,1.399,3.125,3.125C32.292,42.306,30.892,43.705,29.167,43.705z"></path><circle cx="59.855" cy="4.952" r="3.125"></circle><circle  cx="68.59" cy="9.998" r="3.125"></circle><circle cx="75.073" cy="17.725" r="3.125"></circle><path  d="M79.167,22.872c-11.333,0-20.562,9.1-20.812,20.373l-4.021,10.059c-0.002,0.005-0.005,0.006-0.005,0.01  c0,0-0.162,0.55-0.162,0.806c0,1.151,0.932,2.084,2.083,2.084h3.125v4.166c0,5.744,3.632,9.419,9.375,9.419v7.248h25V58.558  c3.852-3.783,6.25-9.04,6.25-14.853C100,32.219,90.653,22.872,79.167,22.872z M79.167,52.039c-1.726,0-3.125-1.4-3.125-3.125  c0-1.726,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125C82.292,50.639,80.892,52.039,79.167,52.039z M79.167,43.705  c-1.726,0-3.125-1.399-3.125-3.125c0-1.725,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125  C82.292,42.306,80.892,43.705,79.167,43.705z M79.167,35.372c-1.726,0-3.125-1.4-3.125-3.125s1.399-3.125,3.125-3.125  c1.725,0,3.125,1.4,3.125,3.125S80.892,35.372,79.167,35.372z"></path></svg></td>');
        document.write('<td><b>La vision de transmission</b><br />' + suppT + '<br /><br /></td></tr>');
        //document.write(transmission + '<br />');
    }
    if (appDSR == 1) {
        document.write('<tr><td width="80px"><svg height="60px" fill="rgb(255, 200, 181)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 312.484 211.2525" style="enable-background:new 0 0 312.484 169.002;" xml:space="preserve"><g><circle cx="156.242" cy="61.414" r="22.5"/><path d="M112.113,114.424c3.812,10.202,12.786,21.188,30.096,35.292c1.482,1.2,3.264,1.784,5.033,1.784   c2.328,0,4.639-1.012,6.221-2.962c2.779-3.434,2.254-8.472-1.178-11.253c-16.262-13.101-23.238-22.844-25.147-28.36   c-0.001-0.002-0.002-0.004-0.003-0.007c-0.63-1.732-0.809-3.014-0.811-3.969c0.005-0.236,0.02-0.452,0.04-0.658   c0.114-1.188,0.476-1.925,1.136-2.839c0.402-0.554,0.995-1.118,1.694-1.658v8.933c1.282,3.304,5.615,11.102,20.118,23.494   l-0.958-4.768l2.941-0.592l1.691,8.418c0.186,0.149,0.363,0.297,0.551,0.448c3.971,3.219,4.821,8.867,2.17,13.088l1.662,8.27h8.751   c-1.654-3.37-1.349-7.535,1.142-10.658c9.748-12.186,14.123-21.054,16.023-27.05v-17.905c1.888,2.147,3.255,4.793,3.414,9.209   c0.006,0.171,0.016,0.338,0.019,0.515c0,1.369-0.139,2.922-0.477,4.692c-1.327,7.067-6.077,17.611-17.415,31.787   c-2.758,3.453-2.192,8.487,1.26,11.244c1.475,1.177,3.238,1.748,4.988,1.748c2.35,0,4.678-1.03,6.258-3.009   c12.273-15.41,18.484-27.892,20.602-38.668c0.007-0.033,0.018-0.063,0.023-0.097c0.436-2.283,0.67-4.479,0.733-6.6   c0.011-0.367,0.027-0.736,0.027-1.099c0.015-5.989-1.536-11.265-3.938-15.445c-3.616-6.306-8.792-10.056-12.889-12.275   c-4.132-2.222-7.338-2.997-7.803-3.112c-0.587-0.139-1.174-0.203-1.753-0.211c-0.257-0.025-0.517-0.039-0.779-0.039h-3.512   c-4.269,3.614-9.785,5.8-15.805,5.8c-6.019,0-11.534-2.186-15.804-5.8h-3.515c-0.289,0-0.573,0.019-0.854,0.05   c-0.349,0.015-0.698,0.045-1.051,0.107h-0.002c-0.487,0.111-5.659,0.974-11.519,4.178c-2.921,1.624-6.082,3.881-8.697,7.272   c-2.617,3.354-4.51,8.03-4.477,13.229c-0.001,0.873,0.063,1.76,0.16,2.651c0.244,2.222,0.776,4.493,1.614,6.794   C112.104,114.405,112.109,114.414,112.113,114.424z"/><circle cx="75.467" cy="92.779" r="21.195"/><circle cx="237.018" cy="92.779" r="21.195"/><path d="M312.484,169.002v-5.261h-50.272v-11.104c-4.021,0.67-8.669,1.112-14.15,1.356c-0.121,0.005-0.246,0.009-0.367,0.009   c-1.947,0-3.739-0.654-5.173-1.754l-2.455,5.505h15.376v3.333h-32.334v-3.333h13.675l3.558-7.979   c-0.67-1.155-1.076-2.485-1.137-3.913c-0.177-4.208,2.753-7.83,6.747-8.67l3.845-8.621l2.74,1.222l-3.175,7.118   c5.906-0.324,10.044-0.97,12.851-1.602v-8.995c1.746,1.201,3.502,2.606,4.873,3.999c1.03,1.033,1.826,2.047,2.298,2.838   c0.028,0.047,0.067,0.102,0.093,0.147c0.23,0.403,0.366,0.729,0.429,0.935c0.011,0.035,0.02,0.065,0.026,0.092   c-0.23,0.235-0.848,0.75-2.139,1.33c-0.007,0.003-0.014,0.008-0.022,0.011c-3.109,1.44-9.737,2.922-20.348,3.342   c-3.586,0.151-6.371,3.182-6.221,6.769c0.148,3.494,3.027,6.226,6.492,6.226c0.092,0,0.184-0.002,0.275-0.006   c11.536-0.515,19.382-1.918,25.169-4.491c0.007-0.003,0.014-0.005,0.021-0.008c2.064-0.939,3.905-2.069,5.458-3.501   c0.551-0.507,1.067-1.051,1.542-1.64c1.826-2.223,2.841-5.163,2.805-7.864c-0.055-4.254-1.892-7.508-3.921-10.222   c-3.127-4.06-7.22-7.259-11.072-9.731c-1.935-1.228-3.796-2.242-5.54-3.021c-0.879-0.388-1.723-0.72-2.612-0.989   c-0.74-0.211-1.481-0.406-2.486-0.485c-0.381-0.075-0.774-0.116-1.177-0.116h-3.532c-4.123,3.757-9.6,6.05-15.604,6.05   c-5.471,0-10.501-1.907-14.472-5.086c-2.142,0.452-8.123,2.605-13.603,10.248c-5.582,7.723-10.745,20.579-12.709,42.604h-12.948   v-5.333c-0.132,0.166-0.256,0.33-0.389,0.497c-1.906,2.391-4.758,3.764-7.822,3.764c-2.254,0-4.469-0.775-6.236-2.185   c-0.026-0.021-0.048-0.045-0.074-0.065h-29.057v-3.333h14.604l-1.117-5.559c-1.704,1.267-3.774,1.974-5.953,1.974   c-2.281,0-4.516-0.792-6.291-2.231c-4.396-3.582-8.3-7.008-11.756-10.313v22.784h-12.947c-1.965-22.025-7.128-34.881-12.71-42.604   c-5.478-7.64-11.455-9.794-13.601-10.248c-3.971,3.18-9.001,5.087-14.473,5.087c-6.004,0-11.481-2.293-15.604-6.05h-3.532   c-0.376,0-0.743,0.039-1.101,0.104c-1.467,0.105-2.392,0.439-3.441,0.786c-3.905,1.443-8.606,4.226-13.087,7.995   c-2.208,1.894-4.305,4.012-6.021,6.507c-1.681,2.481-3.133,5.459-3.167,9.173c-0.034,2.698,0.98,5.642,2.806,7.864   c0.477,0.592,0.996,1.137,1.55,1.646c1.554,1.429,3.394,2.556,5.458,3.494l0,0c0.001,0,0.001,0.001,0.002,0.001   c5.789,2.578,13.639,3.983,25.185,4.498c0.092,0.004,0.184,0.006,0.275,0.006c3.465,0,6.344-2.731,6.492-6.226   c0.15-3.587-2.635-6.617-6.221-6.769c-10.63-0.421-17.265-1.907-20.367-3.35c-0.002-0.001-0.003-0.002-0.005-0.003   c-1.29-0.579-1.921-1.102-2.144-1.333c0.025-0.091,0.069-0.225,0.15-0.41c0.085-0.211,0.223-0.472,0.399-0.762   c0.455-0.749,1.194-1.716,2.156-2.689c1.394-1.438,3.213-2.901,5.021-4.146v8.994c2.807,0.632,6.944,1.277,12.851,1.602   l-3.175-7.118l2.74-1.222l3.845,8.621c3.994,0.84,6.924,4.462,6.747,8.67c-0.061,1.428-0.467,2.758-1.137,3.913l3.558,7.979h13.675   v3.333H57.041v-3.333h15.376l-2.455-5.505c-1.434,1.1-3.225,1.754-5.173,1.754c-0.121,0-0.246-0.004-0.367-0.009   c-5.481-0.244-10.129-0.687-14.15-1.356v11.104H0v5.261H312.484z M219.465,128.772c0.121-0.167,0.238-0.311,0.357-0.467v18.933   v16.503h-10.533C211.183,144.028,215.803,133.789,219.465,128.772z M103.194,163.741H92.662v-16.503v-18.925   c0.486,0.639,0.989,1.355,1.51,2.179C97.6,135.977,101.494,146.053,103.194,163.741z"/><path d="M75.832,0C60.92,0.002,48.833,12.089,48.831,27.002c0.002,14.91,12.089,26.997,27.001,26.999   c14.91-0.002,26.997-12.089,27-26.999C102.829,12.089,90.742,0.002,75.832,0z M75.832,50c-12.703-0.021-22.979-10.297-23-22.998   c0.021-12.704,10.297-22.978,23-23.001c12.701,0.023,22.975,10.297,22.999,23.001C98.808,39.703,88.533,49.979,75.832,50z"/><polygon points="76.163,24.55 65.463,14.306 62.699,17.196 62.697,17.196 75.498,29.453 92.531,20.261 90.633,16.742  "/><rect x="74.998" y="5.668" width="1.666" height="6.668"/><rect x="74.998" y="41.67" width="1.666" height="6.666"/><rect x="54.498" y="26.169" width="6.668" height="1.667"/><rect x="90.5" y="26.169" width="6.666" height="1.667"/></g></svg></td>');
        document.write('<td><b>La vision du maître et de l&#39;apprenti</b><br />' + suppA + '<br /><br /></td></tr>');
        //document.write(apprenti + '<br />');
    }
    if (devDSR == 1) {
        document.write('<tr><td width="80px"><svg width="50px" fill="rgb(255, 200, 181)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M60.01,22.264c-0.527-1.055-1.274-2.007-2.215-2.786l0.782-3.326c-0.188-0.119-0.37-0.244-0.568-0.354  s-0.4-0.198-0.601-0.295L55,17.927c-1.159-0.386-2.363-0.516-3.536-0.405l-1.798-2.901c-0.437,0.099-0.867,0.222-1.29,0.369  l0.009,3.413c-1.055,0.527-2.007,1.274-2.786,2.215l-3.326-0.782c-0.119,0.188-0.244,0.37-0.354,0.568  c-0.109,0.197-0.198,0.4-0.295,0.6l2.423,2.408c-0.386,1.16-0.516,2.363-0.405,3.536l-2.901,1.798  c0.099,0.437,0.222,0.867,0.369,1.29l3.413-0.009c0.527,1.055,1.274,2.007,2.215,2.786l-0.781,3.326  c0.188,0.119,0.37,0.244,0.568,0.354c0.197,0.109,0.4,0.198,0.601,0.294l2.408-2.423c1.159,0.386,2.362,0.516,3.536,0.405  l1.798,2.901c0.437-0.099,0.867-0.222,1.29-0.369l-0.009-3.413c1.055-0.527,2.007-1.274,2.786-2.215l3.325,0.782  c0.119-0.188,0.244-0.37,0.354-0.568s0.198-0.4,0.294-0.6l-2.423-2.408c0.386-1.16,0.516-2.363,0.405-3.536l2.901-1.798  c-0.099-0.437-0.222-0.867-0.369-1.289L60.01,22.264z M56.583,28.284c-0.623,1.124-1.647,1.938-2.884,2.292  c-0.438,0.125-0.887,0.188-1.331,0.188c-0.807,0-1.604-0.205-2.328-0.607c-2.32-1.288-3.16-4.223-1.872-6.543  c1.287-2.319,4.22-3.16,6.543-1.873C57.03,23.028,57.871,25.963,56.583,28.284z"/><path d="M38.641,39.829c-0.054-0.283-0.141-0.55-0.25-0.804l1.438-2.429c-0.121-0.153-0.249-0.299-0.382-0.439l-2.623,1.076  c-0.47-0.287-0.998-0.469-1.557-0.538l-1.391-2.473c-0.096,0.014-0.191,0.022-0.288,0.04c-0.096,0.018-0.188,0.046-0.282,0.069  l-0.379,2.811c-0.494,0.27-0.918,0.635-1.25,1.075l-2.836-0.032c-0.072,0.18-0.137,0.362-0.193,0.549l2.233,1.727  c-0.007,0.276,0.01,0.557,0.064,0.84c0.054,0.283,0.141,0.55,0.25,0.804l-1.439,2.429c0.121,0.153,0.249,0.298,0.382,0.439  l2.623-1.076c0.47,0.287,0.999,0.469,1.558,0.538l1.389,2.473c0.096-0.014,0.191-0.022,0.287-0.04  c0.096-0.018,0.188-0.047,0.282-0.069l0.38-2.812c0.494-0.27,0.918-0.635,1.249-1.075l2.835,0.032  c0.072-0.18,0.137-0.362,0.193-0.549l-2.233-1.727C38.713,40.392,38.695,40.112,38.641,39.829z M35.06,41.956  c-0.769,0.147-1.511-0.357-1.658-1.126c-0.147-0.769,0.357-1.511,1.126-1.658c0.769-0.147,1.511,0.357,1.658,1.125  C36.333,41.067,35.829,41.809,35.06,41.956z"/><path d="M83.146,43.782c-0.656-0.937-1.276-1.822-1.645-2.449c-1.399-2.387-1.513-2.687-0.964-5.432  c0.504-2.523-0.19-4.882-0.926-7.379c-0.222-0.751-0.448-1.521-0.648-2.32l-0.099-0.409C74.829,8.904,59.82,5.164,47.94,5  C21.592,4.606,14.846,26.885,14.576,34.709c-0.25,7.24,3.617,16.408,6.309,20.324c2.566,3.732,4.521,11.326,4.756,18.468  c0.212,6.442-7.099,18.83-8.238,20.717C17.042,94.854,17.313,96,18.396,96H61c1.229,0,1.431-1.108,1.437-1.471  c0.039-2.586,0.511-4.305,0.928-5.822c0.415-1.512,0.773-2.817,0.501-4.387c-0.56-3.214,0.229-6.225,2.011-7.671  c0.829-0.675,3.958-1.075,6.472-1.397c2.637-0.338,4.914-0.63,6.111-1.26c2.838-1.495,2.414-6.108,2.046-7.216  c-0.031-0.095-0.068-0.193-0.107-0.296c-0.236-0.627-0.367-0.973,0.347-1.686c1.439-1.439,1.339-2.726,0.789-3.848  c0.449-0.362,0.791-0.815,0.998-1.334c0.231-0.58,0.395-1.517-0.143-2.68c-0.216-0.468-0.263-0.85-0.138-1.138  c0.188-0.437,0.772-0.71,1.229-0.862c1.711-0.57,3.521-1.422,3.351-4.327C86.738,49.021,85.245,46.778,83.146,43.782z   M41.957,44.958l-3.173-0.036c-0.087,0.08-0.172,0.161-0.264,0.236l-0.425,3.145c-0.543,0.232-1.117,0.413-1.721,0.529  s-1.204,0.159-1.795,0.144l-1.555-2.767c-0.112-0.035-0.221-0.079-0.331-0.121l-2.936,1.204c-0.958-0.716-1.769-1.631-2.354-2.705  l1.622-2.738c-0.013-0.058-0.031-0.114-0.042-0.173c-0.011-0.059-0.015-0.117-0.025-0.176l-2.517-1.947  c0.148-1.214,0.564-2.363,1.19-3.382l3.173,0.036c0.087-0.08,0.172-0.161,0.263-0.236l0.425-3.145  c0.544-0.232,1.118-0.413,1.721-0.529c0.604-0.115,1.204-0.159,1.795-0.144l1.555,2.767c0.113,0.036,0.222,0.08,0.333,0.122  l2.935-1.204c0.958,0.716,1.769,1.63,2.354,2.705l-1.622,2.738c0.013,0.058,0.031,0.114,0.042,0.173  c0.011,0.059,0.015,0.117,0.025,0.176l2.517,1.947C43,42.791,42.583,43.939,41.957,44.958z M62.92,26.437  c-0.016,0.614-0.079,1.229-0.203,1.84l2.554,2.539c-0.239,0.664-0.519,1.32-0.868,1.958c-0.015,0.028-0.026,0.057-0.041,0.084  s-0.034,0.052-0.05,0.08c-0.357,0.633-0.765,1.218-1.202,1.772l-3.506-0.824c-0.452,0.428-0.941,0.808-1.454,1.146l0.01,3.608  c-0.648,0.304-1.313,0.567-1.998,0.768c-0.062,0.018-0.124,0.036-0.186,0.053c-0.688,0.192-1.391,0.321-2.101,0.405l-1.901-3.067  c-0.614-0.016-1.229-0.079-1.84-0.203l-2.539,2.554c-0.664-0.239-1.32-0.519-1.957-0.867c-0.028-0.015-0.057-0.026-0.084-0.041  c-0.028-0.015-0.052-0.034-0.08-0.05c-0.633-0.357-1.218-0.765-1.772-1.202l0.824-3.506c-0.429-0.453-0.808-0.941-1.147-1.454  l-3.608,0.01c-0.304-0.648-0.567-1.313-0.768-1.998c-0.018-0.062-0.036-0.124-0.053-0.186c-0.192-0.688-0.321-1.391-0.406-2.102  l3.067-1.901c0.016-0.614,0.079-1.229,0.203-1.84l-2.554-2.539c0.239-0.664,0.519-1.32,0.867-1.958  c0.015-0.028,0.026-0.057,0.042-0.084s0.034-0.052,0.05-0.08c0.357-0.633,0.765-1.218,1.202-1.772l3.506,0.824  c0.453-0.428,0.941-0.808,1.454-1.146l-0.01-3.608c0.648-0.304,1.313-0.567,1.998-0.768c0.062-0.018,0.124-0.036,0.186-0.053  c0.688-0.192,1.391-0.321,2.102-0.405l1.901,3.067c0.614,0.016,1.229,0.079,1.84,0.203l2.539-2.554  c0.664,0.239,1.32,0.519,1.957,0.867c0.028,0.015,0.057,0.026,0.084,0.041s0.052,0.034,0.08,0.05  c0.633,0.357,1.218,0.765,1.772,1.202l-0.824,3.506c0.428,0.452,0.808,0.941,1.146,1.454l3.608-0.01  c0.304,0.647,0.567,1.313,0.768,1.998c0.018,0.062,0.036,0.124,0.053,0.186c0.192,0.688,0.321,1.391,0.406,2.102L62.92,26.437z"/><path d="M53.74,23.49c-0.431-0.239-0.898-0.353-1.359-0.353c-0.99,0-1.951,0.522-2.465,1.447c-0.364,0.657-0.451,1.416-0.244,2.138  c0.206,0.722,0.682,1.321,1.339,1.685c0.656,0.366,1.417,0.451,2.139,0.245c0.722-0.207,1.32-0.683,1.686-1.339  C55.587,25.958,55.096,24.242,53.74,23.49z"/></svg></td>');
        document.write('<td><b>La vision de développement</b><br />' + suppD + '<br /><br /></td></tr>');
        //document.write(developpement + '<br />');

    }
    if (souDSR == 1) {
        document.write('<tr><td width="80px"><svg height="60" fill="rgb(255, 200, 181)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 90 112.5" style="enable-background:new 0 0 90 90;" xml:space="preserve"><path class="st0" d="M77.1,78.2"/><line class="st0" x1="78.1" y1="78.2" x2="78.1" y2="78.2"/><path class="st1" d="M75.4,36.5H56.8c0,0,0,0,0.8-3.5s1.2-10,0.3-14.5C57,14,52.8,13,51.2,12c-1.6-1-4,1.8-4,1.8s-0.1,1,0.2,8.1  c0.3,7.1-14.8,21.4-14.8,21.4l-0.4,0.3c0,0-0.5,25.5,0,27.2c0.6,1.8,5.3,3,5.3,3h32.6c0,0,3.3-1.3,5-3.6c1.8-2.3,0.7-5.2,0.7-5.2  s1.9-1.2,2.8-3.1c0.9-1.9,0-5.8,0-5.8s1.8-1.4,2.3-3.2S80.1,48,80.1,48s1.1-1.3,1.6-5.2C82.2,38.9,75.4,36.5,75.4,36.5z"/><path class="st1" d="M24,75.6h-13c-1.5,0-2.6-1.5-2.6-3.4v-28c0-1.9,1.2-3.4,2.6-3.4h13c1.5,0,2.6,1.5,2.6,3.4v28  C26.6,74,25.4,75.6,24,75.6z"/></svg></td>');
        document.write('<td><b>La vision de soutien émotionnel</b><br />' + suppS + '<br /><br /></td></tr>');
        //document.write(soutien + '<br />');
    }
    if (refDSR == 1) {
        document.write('<tr><td width="80px"> <svg height="60" fill="rgb(255, 200, 181)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 64 80" enable-background="new 0 0 64 64" xml:space="preserve"><g><path d="M43.213,3.831C40.34,2.612,36.975,1.96,33.496,1.96c-7.666,0-15.133,3.1-19.472,8.082   c-4.518,5.208-5.728,11.116-3.582,17.572c0.217,0.643,0.085,1.768-0.331,2.949c-0.321,0.907-0.803,1.787-1.314,2.722   c-0.369,0.652-0.728,1.323-1.068,2.051c-0.406,0.898-0.813,2.08-0.331,3.185c0.482,1.096,1.635,1.607,2.571,1.909l0.132,0.095   l0.151,0.18c0.151,0.586,0.246,1.21,0.35,1.909l0.473,2.458c0.161,0.567,0.34,1.049,0.558,1.475   c0.652,1.295,0.87,2.467,0.737,3.932c-0.132,1.456,0.359,2.391,0.785,2.902c0.614,0.737,1.531,1.182,2.656,1.276   c1.011,0.085,2.212,0.18,3.393,0.18c0.832,0,1.588-0.047,2.306-0.132c0.709-0.095,1.295-0.142,1.768-0.142   c1.597,0,2.325,0.406,3.526,2.874c0.435,0.87,0.851,1.749,1.276,2.628l0.936,1.976l21.382-11.078l-0.378-1.701   c-0.113-0.444-0.189-0.87-0.246-1.295c-0.567-4.093,1.333-7.789,3.346-11.702c0.662-1.314,1.427-2.789,2.032-4.225   c0.52-1.21,0.917-2.495,1.21-3.828C58.489,18.057,53.082,8.028,43.213,3.831z M36.748,34.391c-1.446,0-2.807-0.246-4.074-0.699   h-0.047c-0.236,0.028-0.454,0.076-0.643,0.18c-0.435,0.198-0.879,0.378-1.333,0.529c-0.227,0.076-0.454,0.123-0.681,0.189   c-1.115,0.274-2.297,0.35-3.535,0.227c-0.028,0-0.057-0.009-0.085-0.009c-0.095-0.028-0.123-0.047-0.142-0.047l-0.113-0.123   c-0.019-0.076-0.019-0.113-0.019-0.142l0.009-0.076c0.009-0.028,0.038-0.085,0.104-0.18c0.359-0.473,0.709-0.955,1.078-1.437   l0.378-0.52c0.217-0.274,0.359-0.482,0.444-0.718c0.095-0.302,0.047-0.558-0.038-0.775h-0.009   c-2.221-2.231-3.611-5.312-3.611-8.696c0-6.806,5.511-12.317,12.317-12.317c6.796,0,12.298,5.511,12.298,12.317   C49.046,28.89,43.544,34.391,36.748,34.391z"/><path d="M36.95,30.403c-0.382,0-0.745-0.157-1.02-0.431c-0.28-0.28-0.427-0.647-0.422-1.03   c0.005-0.824,0.647-1.466,1.481-1.466c0.799,0.015,1.437,0.682,1.427,1.481c-0.01,0.799-0.667,1.447-1.461,1.447"/><path d="M41.412,20.792c-0.535,0.691-1.216,1.265-1.878,1.824l-0.162,0.137c-0.932,0.785-1.04,1.015-1.064,2.231   c-0.005,0.319-0.015,0.633-0.015,0.946c0,0.221-0.078,0.294-0.289,0.294c-0.147,0.005-0.294,0.005-0.441,0.005h-0.525v-0.005   h-1.285c-0.24,0-0.275-0.064-0.284-0.26c-0.049-0.991,0.029-1.981,0.226-2.932c0.108-0.52,0.387-0.981,0.883-1.451   c0.392-0.378,0.819-0.74,1.226-1.094c0.196-0.172,0.397-0.343,0.588-0.515l0.034-0.029c0.118-0.103,0.245-0.211,0.353-0.338   c0.544-0.618,0.476-1.52-0.157-2.094c-0.495-0.451-1.103-0.618-1.952-0.51c-1.025,0.128-1.682,0.755-2.006,1.922   c-0.01,0.034-0.015,0.069-0.02,0.103s-0.015,0.064-0.025,0.098c-0.059,0.196-0.167,0.191-0.255,0.177   c-0.789-0.093-1.584-0.186-2.368-0.289c-0.157-0.02-0.24-0.083-0.226-0.324c0.152-2.02,1.765-3.683,3.923-4.045   c1.255-0.211,2.408-0.127,3.457,0.24c1.393,0.49,2.329,1.388,2.785,2.663C42.353,18.708,42.176,19.802,41.412,20.792z"/></g></svg></td>');
        document.write('<td><b>La vision de changement social</b><br />' + suppR + '<br /><br /></td></tr>');
        //document.write(reforme + '<br />');
    }
    if (traDSR != 1 && appDSR != 1 && devDSR != 1 && souDSR != 1 && refDSR != 1) {
        document.write('<tr><td colspan="2">Aucune vision de l&#39;enseignement n&#39;est une vision de support chez vous.<br /><br /></td></tr>');
    }
}

//fonction de vision récessive
function visionRecessive(traDSR, appDSR, devDSR, souDSR, refDSR) {
    //écriture du texte avec picto avant
    if (traDSR == 0) {
        document.write('<tr><td width="80px"><svg height="50px"  xmlns="http://www.w3.org/2000/svg" fill="rgb(221, 221, 221)" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 77.036" enable-background="new 0 0 100 77.036" xml:space="preserve"><circle  cx="50" cy="3.125" r="3.125"></circle><circle cx="40.021" cy="4.952" r="3.125"></circle><circle  cx="31.287" cy="9.998" r="3.125"></circle><circle cx="24.803" cy="17.725" r="3.125"></circle><path  d="M45.67,53.313c0-0.004-0.002-0.005-0.004-0.01l-4.022-10.059c-0.249-11.273-9.479-20.373-20.811-20.373  C9.347,22.872,0,32.219,0,43.705c0,5.812,2.398,11.069,6.25,14.853v18.479h25v-7.248c5.743,0,9.375-3.675,9.375-9.419v-4.166h3.125  c1.151,0,2.083-0.933,2.083-2.084C45.833,53.863,45.67,53.313,45.67,53.313z M12.5,52.039c-1.725,0-3.125-1.4-3.125-3.125  c0-1.726,1.4-3.125,3.125-3.125s3.125,1.399,3.125,3.125C15.625,50.639,14.225,52.039,12.5,52.039z M12.5,43.705  c-1.725,0-3.125-1.399-3.125-3.125c0-1.725,1.4-3.125,3.125-3.125s3.125,1.399,3.125,3.125C15.625,42.306,14.225,43.705,12.5,43.705  z M20.833,52.039c-1.726,0-3.125-1.4-3.125-3.125c0-1.726,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125  C23.958,50.639,22.559,52.039,20.833,52.039z M20.833,43.705c-1.726,0-3.125-1.399-3.125-3.125c0-1.725,1.399-3.125,3.125-3.125  c1.725,0,3.125,1.399,3.125,3.125C23.958,42.306,22.559,43.705,20.833,43.705z M20.833,35.372c-1.726,0-3.125-1.4-3.125-3.125  s1.399-3.125,3.125-3.125c1.725,0,3.125,1.4,3.125,3.125S22.559,35.372,20.833,35.372z M29.167,52.039  c-1.725,0-3.125-1.4-3.125-3.125c0-1.726,1.4-3.125,3.125-3.125c1.726,0,3.125,1.399,3.125,3.125  C32.292,50.639,30.892,52.039,29.167,52.039z M29.167,43.705c-1.725,0-3.125-1.399-3.125-3.125c0-1.725,1.4-3.125,3.125-3.125  c1.726,0,3.125,1.399,3.125,3.125C32.292,42.306,30.892,43.705,29.167,43.705z"></path><circle cx="59.855" cy="4.952" r="3.125"></circle><circle  cx="68.59" cy="9.998" r="3.125"></circle><circle cx="75.073" cy="17.725" r="3.125"></circle><path  d="M79.167,22.872c-11.333,0-20.562,9.1-20.812,20.373l-4.021,10.059c-0.002,0.005-0.005,0.006-0.005,0.01  c0,0-0.162,0.55-0.162,0.806c0,1.151,0.932,2.084,2.083,2.084h3.125v4.166c0,5.744,3.632,9.419,9.375,9.419v7.248h25V58.558  c3.852-3.783,6.25-9.04,6.25-14.853C100,32.219,90.653,22.872,79.167,22.872z M79.167,52.039c-1.726,0-3.125-1.4-3.125-3.125  c0-1.726,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125C82.292,50.639,80.892,52.039,79.167,52.039z M79.167,43.705  c-1.726,0-3.125-1.399-3.125-3.125c0-1.725,1.399-3.125,3.125-3.125c1.725,0,3.125,1.399,3.125,3.125  C82.292,42.306,80.892,43.705,79.167,43.705z M79.167,35.372c-1.726,0-3.125-1.4-3.125-3.125s1.399-3.125,3.125-3.125  c1.725,0,3.125,1.4,3.125,3.125S80.892,35.372,79.167,35.372z"></path></svg></td>');
        document.write('<td><b>La vision de transmission</b><br />' + receT + '<br /><br /></td></tr>');
        //document.write(transmission + '<br />');
    }
    if (appDSR == 0) {
        document.write('<tr><td width="80px"><svg height="60px" fill="rgb(221, 221, 221)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 312.484 211.2525" style="enable-background:new 0 0 312.484 169.002;" xml:space="preserve"><g><circle cx="156.242" cy="61.414" r="22.5"/><path d="M112.113,114.424c3.812,10.202,12.786,21.188,30.096,35.292c1.482,1.2,3.264,1.784,5.033,1.784   c2.328,0,4.639-1.012,6.221-2.962c2.779-3.434,2.254-8.472-1.178-11.253c-16.262-13.101-23.238-22.844-25.147-28.36   c-0.001-0.002-0.002-0.004-0.003-0.007c-0.63-1.732-0.809-3.014-0.811-3.969c0.005-0.236,0.02-0.452,0.04-0.658   c0.114-1.188,0.476-1.925,1.136-2.839c0.402-0.554,0.995-1.118,1.694-1.658v8.933c1.282,3.304,5.615,11.102,20.118,23.494   l-0.958-4.768l2.941-0.592l1.691,8.418c0.186,0.149,0.363,0.297,0.551,0.448c3.971,3.219,4.821,8.867,2.17,13.088l1.662,8.27h8.751   c-1.654-3.37-1.349-7.535,1.142-10.658c9.748-12.186,14.123-21.054,16.023-27.05v-17.905c1.888,2.147,3.255,4.793,3.414,9.209   c0.006,0.171,0.016,0.338,0.019,0.515c0,1.369-0.139,2.922-0.477,4.692c-1.327,7.067-6.077,17.611-17.415,31.787   c-2.758,3.453-2.192,8.487,1.26,11.244c1.475,1.177,3.238,1.748,4.988,1.748c2.35,0,4.678-1.03,6.258-3.009   c12.273-15.41,18.484-27.892,20.602-38.668c0.007-0.033,0.018-0.063,0.023-0.097c0.436-2.283,0.67-4.479,0.733-6.6   c0.011-0.367,0.027-0.736,0.027-1.099c0.015-5.989-1.536-11.265-3.938-15.445c-3.616-6.306-8.792-10.056-12.889-12.275   c-4.132-2.222-7.338-2.997-7.803-3.112c-0.587-0.139-1.174-0.203-1.753-0.211c-0.257-0.025-0.517-0.039-0.779-0.039h-3.512   c-4.269,3.614-9.785,5.8-15.805,5.8c-6.019,0-11.534-2.186-15.804-5.8h-3.515c-0.289,0-0.573,0.019-0.854,0.05   c-0.349,0.015-0.698,0.045-1.051,0.107h-0.002c-0.487,0.111-5.659,0.974-11.519,4.178c-2.921,1.624-6.082,3.881-8.697,7.272   c-2.617,3.354-4.51,8.03-4.477,13.229c-0.001,0.873,0.063,1.76,0.16,2.651c0.244,2.222,0.776,4.493,1.614,6.794   C112.104,114.405,112.109,114.414,112.113,114.424z"/><circle cx="75.467" cy="92.779" r="21.195"/><circle cx="237.018" cy="92.779" r="21.195"/><path d="M312.484,169.002v-5.261h-50.272v-11.104c-4.021,0.67-8.669,1.112-14.15,1.356c-0.121,0.005-0.246,0.009-0.367,0.009   c-1.947,0-3.739-0.654-5.173-1.754l-2.455,5.505h15.376v3.333h-32.334v-3.333h13.675l3.558-7.979   c-0.67-1.155-1.076-2.485-1.137-3.913c-0.177-4.208,2.753-7.83,6.747-8.67l3.845-8.621l2.74,1.222l-3.175,7.118   c5.906-0.324,10.044-0.97,12.851-1.602v-8.995c1.746,1.201,3.502,2.606,4.873,3.999c1.03,1.033,1.826,2.047,2.298,2.838   c0.028,0.047,0.067,0.102,0.093,0.147c0.23,0.403,0.366,0.729,0.429,0.935c0.011,0.035,0.02,0.065,0.026,0.092   c-0.23,0.235-0.848,0.75-2.139,1.33c-0.007,0.003-0.014,0.008-0.022,0.011c-3.109,1.44-9.737,2.922-20.348,3.342   c-3.586,0.151-6.371,3.182-6.221,6.769c0.148,3.494,3.027,6.226,6.492,6.226c0.092,0,0.184-0.002,0.275-0.006   c11.536-0.515,19.382-1.918,25.169-4.491c0.007-0.003,0.014-0.005,0.021-0.008c2.064-0.939,3.905-2.069,5.458-3.501   c0.551-0.507,1.067-1.051,1.542-1.64c1.826-2.223,2.841-5.163,2.805-7.864c-0.055-4.254-1.892-7.508-3.921-10.222   c-3.127-4.06-7.22-7.259-11.072-9.731c-1.935-1.228-3.796-2.242-5.54-3.021c-0.879-0.388-1.723-0.72-2.612-0.989   c-0.74-0.211-1.481-0.406-2.486-0.485c-0.381-0.075-0.774-0.116-1.177-0.116h-3.532c-4.123,3.757-9.6,6.05-15.604,6.05   c-5.471,0-10.501-1.907-14.472-5.086c-2.142,0.452-8.123,2.605-13.603,10.248c-5.582,7.723-10.745,20.579-12.709,42.604h-12.948   v-5.333c-0.132,0.166-0.256,0.33-0.389,0.497c-1.906,2.391-4.758,3.764-7.822,3.764c-2.254,0-4.469-0.775-6.236-2.185   c-0.026-0.021-0.048-0.045-0.074-0.065h-29.057v-3.333h14.604l-1.117-5.559c-1.704,1.267-3.774,1.974-5.953,1.974   c-2.281,0-4.516-0.792-6.291-2.231c-4.396-3.582-8.3-7.008-11.756-10.313v22.784h-12.947c-1.965-22.025-7.128-34.881-12.71-42.604   c-5.478-7.64-11.455-9.794-13.601-10.248c-3.971,3.18-9.001,5.087-14.473,5.087c-6.004,0-11.481-2.293-15.604-6.05h-3.532   c-0.376,0-0.743,0.039-1.101,0.104c-1.467,0.105-2.392,0.439-3.441,0.786c-3.905,1.443-8.606,4.226-13.087,7.995   c-2.208,1.894-4.305,4.012-6.021,6.507c-1.681,2.481-3.133,5.459-3.167,9.173c-0.034,2.698,0.98,5.642,2.806,7.864   c0.477,0.592,0.996,1.137,1.55,1.646c1.554,1.429,3.394,2.556,5.458,3.494l0,0c0.001,0,0.001,0.001,0.002,0.001   c5.789,2.578,13.639,3.983,25.185,4.498c0.092,0.004,0.184,0.006,0.275,0.006c3.465,0,6.344-2.731,6.492-6.226   c0.15-3.587-2.635-6.617-6.221-6.769c-10.63-0.421-17.265-1.907-20.367-3.35c-0.002-0.001-0.003-0.002-0.005-0.003   c-1.29-0.579-1.921-1.102-2.144-1.333c0.025-0.091,0.069-0.225,0.15-0.41c0.085-0.211,0.223-0.472,0.399-0.762   c0.455-0.749,1.194-1.716,2.156-2.689c1.394-1.438,3.213-2.901,5.021-4.146v8.994c2.807,0.632,6.944,1.277,12.851,1.602   l-3.175-7.118l2.74-1.222l3.845,8.621c3.994,0.84,6.924,4.462,6.747,8.67c-0.061,1.428-0.467,2.758-1.137,3.913l3.558,7.979h13.675   v3.333H57.041v-3.333h15.376l-2.455-5.505c-1.434,1.1-3.225,1.754-5.173,1.754c-0.121,0-0.246-0.004-0.367-0.009   c-5.481-0.244-10.129-0.687-14.15-1.356v11.104H0v5.261H312.484z M219.465,128.772c0.121-0.167,0.238-0.311,0.357-0.467v18.933   v16.503h-10.533C211.183,144.028,215.803,133.789,219.465,128.772z M103.194,163.741H92.662v-16.503v-18.925   c0.486,0.639,0.989,1.355,1.51,2.179C97.6,135.977,101.494,146.053,103.194,163.741z"/><path d="M75.832,0C60.92,0.002,48.833,12.089,48.831,27.002c0.002,14.91,12.089,26.997,27.001,26.999   c14.91-0.002,26.997-12.089,27-26.999C102.829,12.089,90.742,0.002,75.832,0z M75.832,50c-12.703-0.021-22.979-10.297-23-22.998   c0.021-12.704,10.297-22.978,23-23.001c12.701,0.023,22.975,10.297,22.999,23.001C98.808,39.703,88.533,49.979,75.832,50z"/><polygon points="76.163,24.55 65.463,14.306 62.699,17.196 62.697,17.196 75.498,29.453 92.531,20.261 90.633,16.742  "/><rect x="74.998" y="5.668" width="1.666" height="6.668"/><rect x="74.998" y="41.67" width="1.666" height="6.666"/><rect x="54.498" y="26.169" width="6.668" height="1.667"/><rect x="90.5" y="26.169" width="6.666" height="1.667"/></g></svg></td>');
        document.write('<td><b>La vision du maître et de l&#39;apprenti</b><br />' + receA + '<br /><br /></td></tr>');
        //document.write(apprenti + '<br />');
    }
    if (devDSR == 0) {
        document.write('<tr><td width="80px"><svg width="50px" fill="rgb(221, 221, 221)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M60.01,22.264c-0.527-1.055-1.274-2.007-2.215-2.786l0.782-3.326c-0.188-0.119-0.37-0.244-0.568-0.354  s-0.4-0.198-0.601-0.295L55,17.927c-1.159-0.386-2.363-0.516-3.536-0.405l-1.798-2.901c-0.437,0.099-0.867,0.222-1.29,0.369  l0.009,3.413c-1.055,0.527-2.007,1.274-2.786,2.215l-3.326-0.782c-0.119,0.188-0.244,0.37-0.354,0.568  c-0.109,0.197-0.198,0.4-0.295,0.6l2.423,2.408c-0.386,1.16-0.516,2.363-0.405,3.536l-2.901,1.798  c0.099,0.437,0.222,0.867,0.369,1.29l3.413-0.009c0.527,1.055,1.274,2.007,2.215,2.786l-0.781,3.326  c0.188,0.119,0.37,0.244,0.568,0.354c0.197,0.109,0.4,0.198,0.601,0.294l2.408-2.423c1.159,0.386,2.362,0.516,3.536,0.405  l1.798,2.901c0.437-0.099,0.867-0.222,1.29-0.369l-0.009-3.413c1.055-0.527,2.007-1.274,2.786-2.215l3.325,0.782  c0.119-0.188,0.244-0.37,0.354-0.568s0.198-0.4,0.294-0.6l-2.423-2.408c0.386-1.16,0.516-2.363,0.405-3.536l2.901-1.798  c-0.099-0.437-0.222-0.867-0.369-1.289L60.01,22.264z M56.583,28.284c-0.623,1.124-1.647,1.938-2.884,2.292  c-0.438,0.125-0.887,0.188-1.331,0.188c-0.807,0-1.604-0.205-2.328-0.607c-2.32-1.288-3.16-4.223-1.872-6.543  c1.287-2.319,4.22-3.16,6.543-1.873C57.03,23.028,57.871,25.963,56.583,28.284z"/><path d="M38.641,39.829c-0.054-0.283-0.141-0.55-0.25-0.804l1.438-2.429c-0.121-0.153-0.249-0.299-0.382-0.439l-2.623,1.076  c-0.47-0.287-0.998-0.469-1.557-0.538l-1.391-2.473c-0.096,0.014-0.191,0.022-0.288,0.04c-0.096,0.018-0.188,0.046-0.282,0.069  l-0.379,2.811c-0.494,0.27-0.918,0.635-1.25,1.075l-2.836-0.032c-0.072,0.18-0.137,0.362-0.193,0.549l2.233,1.727  c-0.007,0.276,0.01,0.557,0.064,0.84c0.054,0.283,0.141,0.55,0.25,0.804l-1.439,2.429c0.121,0.153,0.249,0.298,0.382,0.439  l2.623-1.076c0.47,0.287,0.999,0.469,1.558,0.538l1.389,2.473c0.096-0.014,0.191-0.022,0.287-0.04  c0.096-0.018,0.188-0.047,0.282-0.069l0.38-2.812c0.494-0.27,0.918-0.635,1.249-1.075l2.835,0.032  c0.072-0.18,0.137-0.362,0.193-0.549l-2.233-1.727C38.713,40.392,38.695,40.112,38.641,39.829z M35.06,41.956  c-0.769,0.147-1.511-0.357-1.658-1.126c-0.147-0.769,0.357-1.511,1.126-1.658c0.769-0.147,1.511,0.357,1.658,1.125  C36.333,41.067,35.829,41.809,35.06,41.956z"/><path d="M83.146,43.782c-0.656-0.937-1.276-1.822-1.645-2.449c-1.399-2.387-1.513-2.687-0.964-5.432  c0.504-2.523-0.19-4.882-0.926-7.379c-0.222-0.751-0.448-1.521-0.648-2.32l-0.099-0.409C74.829,8.904,59.82,5.164,47.94,5  C21.592,4.606,14.846,26.885,14.576,34.709c-0.25,7.24,3.617,16.408,6.309,20.324c2.566,3.732,4.521,11.326,4.756,18.468  c0.212,6.442-7.099,18.83-8.238,20.717C17.042,94.854,17.313,96,18.396,96H61c1.229,0,1.431-1.108,1.437-1.471  c0.039-2.586,0.511-4.305,0.928-5.822c0.415-1.512,0.773-2.817,0.501-4.387c-0.56-3.214,0.229-6.225,2.011-7.671  c0.829-0.675,3.958-1.075,6.472-1.397c2.637-0.338,4.914-0.63,6.111-1.26c2.838-1.495,2.414-6.108,2.046-7.216  c-0.031-0.095-0.068-0.193-0.107-0.296c-0.236-0.627-0.367-0.973,0.347-1.686c1.439-1.439,1.339-2.726,0.789-3.848  c0.449-0.362,0.791-0.815,0.998-1.334c0.231-0.58,0.395-1.517-0.143-2.68c-0.216-0.468-0.263-0.85-0.138-1.138  c0.188-0.437,0.772-0.71,1.229-0.862c1.711-0.57,3.521-1.422,3.351-4.327C86.738,49.021,85.245,46.778,83.146,43.782z   M41.957,44.958l-3.173-0.036c-0.087,0.08-0.172,0.161-0.264,0.236l-0.425,3.145c-0.543,0.232-1.117,0.413-1.721,0.529  s-1.204,0.159-1.795,0.144l-1.555-2.767c-0.112-0.035-0.221-0.079-0.331-0.121l-2.936,1.204c-0.958-0.716-1.769-1.631-2.354-2.705  l1.622-2.738c-0.013-0.058-0.031-0.114-0.042-0.173c-0.011-0.059-0.015-0.117-0.025-0.176l-2.517-1.947  c0.148-1.214,0.564-2.363,1.19-3.382l3.173,0.036c0.087-0.08,0.172-0.161,0.263-0.236l0.425-3.145  c0.544-0.232,1.118-0.413,1.721-0.529c0.604-0.115,1.204-0.159,1.795-0.144l1.555,2.767c0.113,0.036,0.222,0.08,0.333,0.122  l2.935-1.204c0.958,0.716,1.769,1.63,2.354,2.705l-1.622,2.738c0.013,0.058,0.031,0.114,0.042,0.173  c0.011,0.059,0.015,0.117,0.025,0.176l2.517,1.947C43,42.791,42.583,43.939,41.957,44.958z M62.92,26.437  c-0.016,0.614-0.079,1.229-0.203,1.84l2.554,2.539c-0.239,0.664-0.519,1.32-0.868,1.958c-0.015,0.028-0.026,0.057-0.041,0.084  s-0.034,0.052-0.05,0.08c-0.357,0.633-0.765,1.218-1.202,1.772l-3.506-0.824c-0.452,0.428-0.941,0.808-1.454,1.146l0.01,3.608  c-0.648,0.304-1.313,0.567-1.998,0.768c-0.062,0.018-0.124,0.036-0.186,0.053c-0.688,0.192-1.391,0.321-2.101,0.405l-1.901-3.067  c-0.614-0.016-1.229-0.079-1.84-0.203l-2.539,2.554c-0.664-0.239-1.32-0.519-1.957-0.867c-0.028-0.015-0.057-0.026-0.084-0.041  c-0.028-0.015-0.052-0.034-0.08-0.05c-0.633-0.357-1.218-0.765-1.772-1.202l0.824-3.506c-0.429-0.453-0.808-0.941-1.147-1.454  l-3.608,0.01c-0.304-0.648-0.567-1.313-0.768-1.998c-0.018-0.062-0.036-0.124-0.053-0.186c-0.192-0.688-0.321-1.391-0.406-2.102  l3.067-1.901c0.016-0.614,0.079-1.229,0.203-1.84l-2.554-2.539c0.239-0.664,0.519-1.32,0.867-1.958  c0.015-0.028,0.026-0.057,0.042-0.084s0.034-0.052,0.05-0.08c0.357-0.633,0.765-1.218,1.202-1.772l3.506,0.824  c0.453-0.428,0.941-0.808,1.454-1.146l-0.01-3.608c0.648-0.304,1.313-0.567,1.998-0.768c0.062-0.018,0.124-0.036,0.186-0.053  c0.688-0.192,1.391-0.321,2.102-0.405l1.901,3.067c0.614,0.016,1.229,0.079,1.84,0.203l2.539-2.554  c0.664,0.239,1.32,0.519,1.957,0.867c0.028,0.015,0.057,0.026,0.084,0.041s0.052,0.034,0.08,0.05  c0.633,0.357,1.218,0.765,1.772,1.202l-0.824,3.506c0.428,0.452,0.808,0.941,1.146,1.454l3.608-0.01  c0.304,0.647,0.567,1.313,0.768,1.998c0.018,0.062,0.036,0.124,0.053,0.186c0.192,0.688,0.321,1.391,0.406,2.102L62.92,26.437z"/><path d="M53.74,23.49c-0.431-0.239-0.898-0.353-1.359-0.353c-0.99,0-1.951,0.522-2.465,1.447c-0.364,0.657-0.451,1.416-0.244,2.138  c0.206,0.722,0.682,1.321,1.339,1.685c0.656,0.366,1.417,0.451,2.139,0.245c0.722-0.207,1.32-0.683,1.686-1.339  C55.587,25.958,55.096,24.242,53.74,23.49z"/></svg></td>');
        document.write('<td><b>La vision de développement</b><br />' + receD + '<br /><br /></td></tr>');
        //document.write(developpement + '<br />');

    }
    if (souDSR == 0) {
        document.write('<tr><td width="80px"><svg height="60" fill="rgb(221, 221, 221)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 90 112.5" style="enable-background:new 0 0 90 90;" xml:space="preserve"><path class="st0" d="M77.1,78.2"/><line class="st0" x1="78.1" y1="78.2" x2="78.1" y2="78.2"/><path class="st1" d="M75.4,36.5H56.8c0,0,0,0,0.8-3.5s1.2-10,0.3-14.5C57,14,52.8,13,51.2,12c-1.6-1-4,1.8-4,1.8s-0.1,1,0.2,8.1  c0.3,7.1-14.8,21.4-14.8,21.4l-0.4,0.3c0,0-0.5,25.5,0,27.2c0.6,1.8,5.3,3,5.3,3h32.6c0,0,3.3-1.3,5-3.6c1.8-2.3,0.7-5.2,0.7-5.2  s1.9-1.2,2.8-3.1c0.9-1.9,0-5.8,0-5.8s1.8-1.4,2.3-3.2S80.1,48,80.1,48s1.1-1.3,1.6-5.2C82.2,38.9,75.4,36.5,75.4,36.5z"/><path class="st1" d="M24,75.6h-13c-1.5,0-2.6-1.5-2.6-3.4v-28c0-1.9,1.2-3.4,2.6-3.4h13c1.5,0,2.6,1.5,2.6,3.4v28  C26.6,74,25.4,75.6,24,75.6z"/></svg></td>');
        document.write('<td><b>La vision de soutien émotionnel</b><br />' + receS + '<br /><br /></td></tr>');
        //document.write(soutien + '<br />');
    }
    if (refDSR == 0) {
        document.write('<tr><td width="80px"> <svg height="60" fill="rgb(221, 221, 221)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 64 80" enable-background="new 0 0 64 64" xml:space="preserve"><g><path d="M43.213,3.831C40.34,2.612,36.975,1.96,33.496,1.96c-7.666,0-15.133,3.1-19.472,8.082   c-4.518,5.208-5.728,11.116-3.582,17.572c0.217,0.643,0.085,1.768-0.331,2.949c-0.321,0.907-0.803,1.787-1.314,2.722   c-0.369,0.652-0.728,1.323-1.068,2.051c-0.406,0.898-0.813,2.08-0.331,3.185c0.482,1.096,1.635,1.607,2.571,1.909l0.132,0.095   l0.151,0.18c0.151,0.586,0.246,1.21,0.35,1.909l0.473,2.458c0.161,0.567,0.34,1.049,0.558,1.475   c0.652,1.295,0.87,2.467,0.737,3.932c-0.132,1.456,0.359,2.391,0.785,2.902c0.614,0.737,1.531,1.182,2.656,1.276   c1.011,0.085,2.212,0.18,3.393,0.18c0.832,0,1.588-0.047,2.306-0.132c0.709-0.095,1.295-0.142,1.768-0.142   c1.597,0,2.325,0.406,3.526,2.874c0.435,0.87,0.851,1.749,1.276,2.628l0.936,1.976l21.382-11.078l-0.378-1.701   c-0.113-0.444-0.189-0.87-0.246-1.295c-0.567-4.093,1.333-7.789,3.346-11.702c0.662-1.314,1.427-2.789,2.032-4.225   c0.52-1.21,0.917-2.495,1.21-3.828C58.489,18.057,53.082,8.028,43.213,3.831z M36.748,34.391c-1.446,0-2.807-0.246-4.074-0.699   h-0.047c-0.236,0.028-0.454,0.076-0.643,0.18c-0.435,0.198-0.879,0.378-1.333,0.529c-0.227,0.076-0.454,0.123-0.681,0.189   c-1.115,0.274-2.297,0.35-3.535,0.227c-0.028,0-0.057-0.009-0.085-0.009c-0.095-0.028-0.123-0.047-0.142-0.047l-0.113-0.123   c-0.019-0.076-0.019-0.113-0.019-0.142l0.009-0.076c0.009-0.028,0.038-0.085,0.104-0.18c0.359-0.473,0.709-0.955,1.078-1.437   l0.378-0.52c0.217-0.274,0.359-0.482,0.444-0.718c0.095-0.302,0.047-0.558-0.038-0.775h-0.009   c-2.221-2.231-3.611-5.312-3.611-8.696c0-6.806,5.511-12.317,12.317-12.317c6.796,0,12.298,5.511,12.298,12.317   C49.046,28.89,43.544,34.391,36.748,34.391z"/><path d="M36.95,30.403c-0.382,0-0.745-0.157-1.02-0.431c-0.28-0.28-0.427-0.647-0.422-1.03   c0.005-0.824,0.647-1.466,1.481-1.466c0.799,0.015,1.437,0.682,1.427,1.481c-0.01,0.799-0.667,1.447-1.461,1.447"/><path d="M41.412,20.792c-0.535,0.691-1.216,1.265-1.878,1.824l-0.162,0.137c-0.932,0.785-1.04,1.015-1.064,2.231   c-0.005,0.319-0.015,0.633-0.015,0.946c0,0.221-0.078,0.294-0.289,0.294c-0.147,0.005-0.294,0.005-0.441,0.005h-0.525v-0.005   h-1.285c-0.24,0-0.275-0.064-0.284-0.26c-0.049-0.991,0.029-1.981,0.226-2.932c0.108-0.52,0.387-0.981,0.883-1.451   c0.392-0.378,0.819-0.74,1.226-1.094c0.196-0.172,0.397-0.343,0.588-0.515l0.034-0.029c0.118-0.103,0.245-0.211,0.353-0.338   c0.544-0.618,0.476-1.52-0.157-2.094c-0.495-0.451-1.103-0.618-1.952-0.51c-1.025,0.128-1.682,0.755-2.006,1.922   c-0.01,0.034-0.015,0.069-0.02,0.103s-0.015,0.064-0.025,0.098c-0.059,0.196-0.167,0.191-0.255,0.177   c-0.789-0.093-1.584-0.186-2.368-0.289c-0.157-0.02-0.24-0.083-0.226-0.324c0.152-2.02,1.765-3.683,3.923-4.045   c1.255-0.211,2.408-0.127,3.457,0.24c1.393,0.49,2.329,1.388,2.785,2.663C42.353,18.708,42.176,19.802,41.412,20.792z"/></g></svg></td>');
        document.write('<td><b>La vision de changement social</b><br />' + receR + '<br /><br /></td></tr>');
        //document.write(reforme + '<br />');
    }
    if (traDSR != 0 && appDSR != 0 && devDSR != 0 && souDSR != 0 && refDSR != 0) {
        document.write('<tr><td colspan="2">Aucune vision de l&#39;enseignement n&#39;est récessive chez vous.<br /><br /></td></tr>');
    }
}


/* __________________________CROYANCES INTENTIONS ACTIONS __________________________ */


//fonction pour trouver l'indice de la valeur la plus haute dans un tableau
function indexOfMax(tab) {

    var mxm = parseInt(tab[0]);
    var mxmIndex = 0;

    /*   for (var i=0; i<arr.length;i++){
     document.write(arr[i] +'<br />');
     }*/
    for (i = 0; i < tab.length; i++) {
        if (parseInt(tab[i]) > mxm) {
            mxm = tab[i];
            mxmIndex = i;
        }
    }
    return mxmIndex;
}

//fonction pour afficher les décalages entre dominantes et croyances, intentions et actions
function texteCIA(traDSR, appDSR, devDSR, souDSR, refDSR, croT, croA, croD, croS, croR, intT, intA, intD, intS, intR, actT, actA, actD, actS, actR) {
//elements communs à la vérification des croyances, intentions et actions
    var tabNoms = ["Transmission", "Apprenti", "Developpement", "Soutien", "Reforme"];
    var tabDSR = [traDSR, appDSR, devDSR, souDSR, refDSR];
    var txtNoms = ["de transmission", "d&#39;apprenti", "de développement", "de soutien", "de changement social"];
    //initialisation des messages pour les croyances,intentions et actions
    var messagecroyances = "";
    var messageintentions = "";
    var messageactions = "";

//vérification pour les croyances
    //préparation du texte
    var txtdebutC = "Vos <b>croyances les plus fortes</b> concernent la vision ";
    var txtfinOKC = ", dominante chez vous.<br />";
    var txtfinDiffC = ", qui n&#39;est pas dominante chez vous. Pensez-vous que cette vision des choses est plus importante que celle correspondant à votre/vos vision(s) dominantes ? Pourquoi selon-vous avez vous des croyances plus fortes pour cette vision ?  Ces croyances prédominent-elles dans votre établissement ou y adhérez vous complètement ?<br />";

    var tabCroy = [croT, croA, croD, croS, croR];

    var croyMax = indexOfMax(tabCroy);

    //vérification accord entre croyance dominante et vision dominante
    if (parseInt(tabDSR[croyMax]) == 2) {
        messagecroyances += txtdebutC + txtNoms[croyMax] + txtfinOKC;
    }
    else {
        messagecroyances += txtdebutC + txtNoms[croyMax] + txtfinDiffC;
    }
    document.write(messagecroyances + '<br />');

//vérification pour les intentions
    //préparation du texte
    var txtdebutI = "Vos <b>intentions d'enseignement les plus fréquentes</b> sont dans la vision ";
    var txtfinOKI = ", dominante chez vous, ce qui signifie que vous cherchez à mettre en œuvre votre vision de l'enseignement.<br />";
    var txtfinDiffI = ", qui n'est pas dominante chez vous. Pensez-vous qu'il est plus important d'orienter votre pratique vers cette vision des choses ?  Pourquoi cherchez-vous à mettre en oeuvre cette vision ?  Est-ce une exigence de votre établissement ou un choix délibéré ?<br />";

    var tabInten = [intT, intA, intD, intS, intR];

    var intenMax = indexOfMax(tabInten);


    //vérification accord entre croyance dominante et vision dominante
    if (parseInt(tabDSR[intenMax]) == 2) {
        messageintentions += txtdebutI + txtNoms[intenMax] + txtfinOKI;
    }
    else {
        messageintentions += txtdebutI + txtNoms[intenMax] + txtfinDiffI;
    }
    document.write(messageintentions + '<br />');

    //vérification pour les actions
    //préparation du texte
    var txtdebutA = "Vous <b>agissez fréquemment</b> dans le sens de la vision ";
    var txtfinOKA = ", dominante chez vous. Cela signifie que vous agissez selon votre propre vision de l'enseignement.<br />";
    var txtfinDiffA = ", qui n'est pas dominante chez vous. Pensez-vous qu'agir en ce sens est plus important que d'agir selon votre [vision principale] de l'enseignement ? Pourquoi à votre avis agissez-vous selon cette vision particulière ? Est-ce une exigence de votre établissement ou un choix délibéré ?<br />";

    var tabAct = [actT, actA, actD, actS, actR];

    var actMax = indexOfMax(tabAct);

    //vérification accord entre croyance dominante et vision dominante
    if (parseInt(tabDSR[actMax]) == 2) {
        messageactions += txtdebutA + txtNoms[actMax] + txtfinOKA;
    }
    else {
        messageactions += txtdebutA + txtNoms[actMax] + txtfinDiffA;
    }
    document.write(messageactions);

}

/* Création des barres de composantes pour chaque vision de l'enseignement */
// bouton pour montrer/masquer le schéma
function showhide(croT, croA, croD, croS, croR, intT, intA, intD, intS, intR, actT, actA, actD, actS, actR) {
    var div = document.getElementById("cadreComp");
    var contenuBouton = document.getElementById("buttonsh");
    if (div.style.display !== "none") {
        //div.style.display = "none";
        //contenuBouton.innerHTML = "Plus de détails";
    }
    else {
        //div.style.display = "block";
        //contenuBouton.innerHTML = "Cacher le schéma";
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.arrayToDataTable([
                ["Vision", "Croyances", "Intentions", "Actions"],
                ["Transmission", parseInt(croT), parseInt(intT), parseInt(actT)],
                ["Apprenti", parseInt(croA), parseInt(intA), parseInt(actA)],
                ["Développement", parseInt(croD), parseInt(intD), parseInt(actD)],
                ["Soutien", parseInt(croS), parseInt(intS), parseInt(actS)],
                ["Changement social", parseInt(croR), parseInt(intR), parseInt(actR)],
            ]);

            // Set chart options
            var options = {
                "title": "Composantes des visions de l'enseignement",
                titlePosition: 'none',
                'width': 920,
                'height': 200,
                bar: {groupWidth: "90%"},
                legend: {position: "top", alignment: "center"},
                vAxis: {
                    viewWindowMode: 'pretty',
                    viewWindow: {
                        max: 15,
                        min: 2
                    }
                },
                seriesType: 'bars',
                series: {5: {type: 'line'}},
                colors: ['#FF7848', '#DD4814', '#BD2800'],
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    }
}


/* __________________________CROYANCES INTENTIONS ACTIONS __________________________ */

//fonction qui attribue un texte en fonction des différences entre deux sous-composantes (ex:croyances et intentions)
function txtComposantes(vision, diffComposantes, nomComp1, nomComp2) {
    var nbdiff = 0;
    var txtdiff = "";
    if (diffComposantes >= 4) {
        txtdiff += "Vos " + nomComp1 + " sont plus élevées que vos " + nomComp2 + " de " + diffComposantes + " points pour la vision " + vision + ". <br />";
        nbdiff++;
    }
    else if (diffComposantes <= -4) {
        txtdiff += "Vos " + nomComp2 + " sont plus élevées que vos " + nomComp1 + " de " + Math.abs(diffComposantes) + " points pour la vision " + vision + ". <br />";
        nbdiff++;
    }
    else {
        txtdiff = "";
    }
    return [txtdiff, nbdiff];
}

//fonction qui calcule la différence entre sous-composantes pour une vision et ajoute le texte approprié
function diffCompVision(vision, croyances, intentions, actions) {
    var ci = croyances - intentions;
    var ca = croyances - actions;
    var ia = intentions - actions;

    var testDiffVisionCi = txtComposantes(vision, ci, "croyances", "intentions");
    var testDiffVisionCa = txtComposantes(vision, ca, "croyances", "actions");
    var testDiffVisionIa = txtComposantes(vision, ia, "intentions", "actions");

    return [testDiffVisionCi, testDiffVisionCa, testDiffVisionIa];
}

//fonction pour afficher les textes
function texteIncoherences(croT, croA, croD, croS, croR, intT, intA, intD, intS, intR, actT, actA, actD, actS, actR) {

//analyse des différences vision par vision
    var diffTransmission = diffCompVision("de transmission", parseInt(croT), parseInt(intT), parseInt(actT));
    var diffApprenti = diffCompVision("d&#39;apprenti", parseInt(croA), parseInt(intA), parseInt(actA));
    var diffDeveloppement = diffCompVision("de développement", parseInt(croD), parseInt(intD), parseInt(actD));
    var diffSoutien = diffCompVision("de soutien", parseInt(croS), parseInt(intS), parseInt(actS));
    var diffReforme = diffCompVision("de changement social", parseInt(croR), parseInt(intR), parseInt(actR));

//affichage des textes des différences le cas échéant
//si le nb compté dans les objects est égal à 0 on affiche rien
    var messagedifferences = "";
    //pour la vision de transmission
    if (diffTransmission[0][1] == 1) {
        messagedifferences += diffTransmission[0][0];
    }
    if (diffTransmission[1][1] == 1) {
        messagedifferences += diffTransmission[1][0];
    }
    if (diffTransmission[2][1] == 1) {
        messagedifferences += diffTransmission[2][0];
    }
    //pour la vision d'apprenti
    if (diffApprenti[0][1] == 1) {
        messagedifferences += diffApprenti[0][0];
    }
    if (diffApprenti[1][1] == 1) {
        messagedifferences += diffApprenti[1][0];
    }
    if (diffApprenti[2][1] == 1) {
        messagedifferences += diffApprenti[2][0];
    }
    //pour la vision de développement
    if (diffDeveloppement[0][1] == 1) {
        messagedifferences += diffDeveloppement[0][0];
    }
    if (diffDeveloppement[1][1] == 1) {
        messagedifferences += diffDeveloppement[1][0];
    }
    if (diffDeveloppement[2][1] == 1) {
        messagedifferences += diffDeveloppement[2][0];
    }
    //pour la vision de soutien
    if (diffSoutien[0][1] == 1) {
        messagedifferences += diffSoutien[0][0];
    }
    if (diffSoutien[1][1] == 1) {
        messagedifferences += diffSoutien[1][0];
    }
    if (diffSoutien[2][1] == 1) {
        messagedifferences += diffSoutien[2][0];
    }
    //pour la vision de changement social (réforme)
    if (diffReforme[0][1] == 1) {
        messagedifferences += diffReforme[0][0];
    }
    if (diffReforme[1][1] == 1) {
        messagedifferences += diffReforme[1][0];
    }
    if (diffReforme[2][1] == 1) {
        messagedifferences += diffReforme[2][0];
    }

//vérification du message et affichage le cas échéant
    var diffPluriel = diffTransmission[0][1] + diffTransmission[1][1] + diffTransmission[2][1] + diffApprenti[0][1] + diffApprenti[1][1] + diffApprenti[2][1] + diffDeveloppement[0][1] + diffDeveloppement[1][1] + diffDeveloppement[2][1] + diffSoutien[0][1] + diffSoutien[1][1] + diffSoutien[2][1] + diffReforme[0][1] + diffReforme[1][1] + diffReforme[2][1];

    var titrediff = '<h3>Décalages entre croyances, intentions et actions</h3><div class="bloc920">';

    if (messagedifferences != "" && diffPluriel == 1) {
        document.write(titrediff);
        document.write(messagedifferences + '</div>' + "<br /><i>Comment expliquez vous ce décalage ? Est-il de votre fait, ou est-il lié à des impératifs imposés par votre établissement ?</i><br />");
    }
    else if (messagedifferences != "" && diffPluriel > 1) {
        document.write(titrediff);
        document.write(messagedifferences + '</div>' + "<br /><i>Comment expliquez vous ces décalages ? Sont-ils de votre fait, ou sont-ils liés à des impératifs imposés par votre établissement ?</i><br />");
    }
    else if (messagedifferences == "") {
        document.write(titrediff);
        document.write("Vos croyances, intentions et actions sont en harmonie.<br />" + '</div>' + "<br />Cela signifie que vous agissez en fonction de vos intentions et que vos comportements et vos croyances sont alignés.</i><br />");
    }

}


/* ______________________ CALCUL DES FORCES _________________________________*/


/* ______________________ PICTO DES FORCES _________________________________*/

var pictoCuri = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M91.329,22.491c-1.073-0.534-2.417-0.803-2.417-0.803c-0.475-0.104-1.55-0.261-2.323-0.261  c-5.649,0-11.607,5.012-14.827,12.473c-1.858,4.307-2.531,8.844-1.896,12.778c0.646,3.996,2.571,7.144,5.423,8.593l-2.966,6.578  c-0.623,0.182-1.235,0.427-1.805,0.804l-11.403,7.549c0,0-16.35-24.615-16.391-24.671c-1.925-3.451-8.056-6.879-13.947-5.225  C14.909,44.54,2.682,70.528,1.218,85.883l42.048,0.012l0.775-10.261L31.836,57.017c-0.353-0.538-0.203-1.259,0.335-1.612  c0.537-0.354,1.257-0.201,1.611,0.335l18.25,27.585c1.283,1.685,3.236,2.602,5.235,2.602c1.25,0,2.512-0.355,3.632-1.098  l16.896-11.185c3.035-2.009,3.867-6.099,1.856-9.134c-0.792-1.197-1.913-2.036-3.159-2.509l2.287-5.07  c1.039,0.336,2.105,0.506,3.182,0.506c2.303,0,4.646-0.766,6.861-2.271c3.197-2.174,6.026-5.847,7.966-10.342  C100.862,35.38,98.284,25.957,91.329,22.491z M90.956,42.182c-2.618,6.07-7.575,10.474-11.786,10.474  c-0.756,0-1.472-0.144-2.133-0.429c-2.025-0.872-3.412-3.031-3.906-6.079c-0.536-3.319,0.057-7.203,1.667-10.939  c2.62-6.069,7.578-10.475,11.791-10.475c0.753,0,1.47,0.144,2.126,0.426C93.094,27.051,94.12,34.846,90.956,42.182z"/><g><path d="M44.542,42.213c6.637,3.933,15.214,1.734,19.144-4.901c3.936-6.644,1.738-15.219-4.898-19.151   c-6.649-3.938-15.218-1.739-19.154,4.905C35.701,29.702,37.893,38.276,44.542,42.213z"/><path d="M82.688,32.412c1.217-1.181,2.465-1.683,3.422-1.377c0.559,0.176,1.031,0.62,1.401,1.319c0.27,0.504,0.893,0.698,1.4,0.428   c0.506-0.268,0.696-0.895,0.429-1.4c-0.626-1.179-1.527-1.981-2.605-2.322c-1.733-0.551-3.682,0.112-5.489,1.865   c-1.641,1.593-3.014,3.944-3.865,6.621c-0.522,1.651-0.821,3.358-0.864,4.936c-0.016,0.572,0.436,1.047,1.008,1.063   c0.009,0,0.019,0,0.027,0c0.56,0,1.019-0.445,1.034-1.008c0.038-1.387,0.303-2.896,0.77-4.365   C80.104,35.816,81.287,33.771,82.688,32.412z"/></g></svg>';
var pictoCrea = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><title>Artboard 23</title><path d="M60.91,87.34v2.85a4.46,4.46,0,0,1-3.84,4.43l-.69,2.56a3.25,3.25,0,0,1-3,2.36H46.46a3.07,3.07,0,0,1-3-2.36l-.69-2.56a4.46,4.46,0,0,1-3.84-4.43V87.34a2.75,2.75,0,0,1,2.75-2.75H58.26A2.8,2.8,0,0,1,60.91,87.34ZM46.36,4.11v9.44a3.64,3.64,0,0,0,7.28,0V4.11a3.64,3.64,0,0,0-7.28,0Zm-40,47.3h9.44a3.69,3.69,0,0,0,3.64-3.64,3.64,3.64,0,0,0-3.64-3.64H6.33a3.64,3.64,0,1,0,0,7.28Zm91-3.57a3.38,3.38,0,0,0-.91-2.56,3.69,3.69,0,0,0-2.73-1.14H84.22a3.64,3.64,0,1,0,0,7.28h9.44A3.62,3.62,0,0,0,97.3,47.84ZM19,82.39a3.65,3.65,0,0,0,2.56-1.07l6.69-6.69a3.65,3.65,0,0,0,0-5.22,3.73,3.73,0,0,0-5.09,0l-6.72,6.72A3.69,3.69,0,0,0,19,82.39Zm59.3-68.16-6.69,6.69a3.68,3.68,0,0,0-1.1,2.61,3.72,3.72,0,0,0,1.16,2.67,4.12,4.12,0,0,0,2.6,1,3.66,3.66,0,0,0,2.56-1.07l6.69-6.69a3.66,3.66,0,0,0,0-5.23A3.74,3.74,0,0,0,78.32,14.23Zm-62,0a3.66,3.66,0,0,0,0,5.23l6.78,6.69a3.66,3.66,0,1,0,5.12-5.23l-6.69-6.69A3.65,3.65,0,0,0,16.36,14.23Zm62,67.09a3.66,3.66,0,0,0,5.13-5.22l-6.59-6.69h0a3.74,3.74,0,0,0-5.22,0,3.65,3.65,0,0,0,0,5.22ZM63.1,74.85a6.47,6.47,0,0,1-6.35,5.42h-3a.23.23,0,0,1-.23-.26l1.89-12.76a3.85,3.85,0,0,0,2.39-3.11L58.95,55h0a4.45,4.45,0,0,0-4.43-5H52.93a.54.54,0,0,0-.42.2L50,53.39a.16.16,0,0,1-.26,0l-2.52-3.15a.54.54,0,0,0-.42-.2H45.27a4.45,4.45,0,0,0-4.43,5L42,64.13a3.81,3.81,0,0,0,2.31,3.09L46.24,80a.23.23,0,0,1-.23.26h-3a6.36,6.36,0,0,1-6.35-5.43A17.75,17.75,0,0,0,32,65.3,24.81,24.81,0,0,1,49.61,23.24h.19a24.81,24.81,0,0,1,18,42.07A17.4,17.4,0,0,0,63.1,74.85Zm-8-31.42a5.21,5.21,0,1,0-5.21,5.21A5.21,5.21,0,0,0,55.1,43.44Z"/></svg>';
var pictoIntS = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" style="enable-background:new 0 0 100 100;" xml:space="preserve"><circle cx="50" cy="5.9" r="1.7"/><path d="M50.9,8.1h-1.8c-1,0-1.6,0.8-1.7,1.7l-0.5,4.7c-0.1,0.8,0.8,1.5,1.6,1.7v2.7c0,0.7,0.6,1.3,1.3,1.3l0,0h0.6  c0.7,0,1.3-0.6,1.3-1.3l0,0v-2.7c0.8-0.2,1.7-0.9,1.6-1.7l-0.5-4.7C52.5,9,51.8,8.1,50.9,8.1z"/><ellipse transform="matrix(0.9511 -0.309 0.309 0.9511 -0.7211 11.6397)" cx="36.4" cy="8.1" rx="1.7" ry="1.7"/><path d="M37.9,9.9l-1.7,0.5c-0.9,0.3-1.3,1.2-1.1,2.2l0.9,4.6c0.2,0.8,1.2,1.2,2.1,1.1l0.8,2.5c0.2,0.7,0.9,1,1.6,0.8l0,0l0.5-0.2  c0.7-0.2,1-0.9,0.8-1.6l0,0l-0.8-2.6c0.7-0.4,1.3-1.4,1-2.1l-2-4.3C39.7,10.2,38.8,9.6,37.9,9.9z"/><ellipse transform="matrix(0.809 -0.5878 0.5878 0.809 -3.8344 16.9082)" cx="24.1" cy="14.4" rx="1.7" ry="1.7"/><path d="M26.1,15.6l-1.4,1c-0.8,0.6-0.9,1.6-0.4,2.4l2.3,4.1c0.4,0.7,1.5,0.8,2.3,0.4l1.6,2.2c0.4,0.6,1.2,0.7,1.8,0.3l0,0l0.5-0.3  c0.6-0.4,0.7-1.2,0.3-1.8l0,0l-1.6-2.2c0.6-0.6,0.8-1.7,0.3-2.3L28.5,16C27.9,15.3,26.9,15.1,26.1,15.6z"/><ellipse transform="matrix(0.5878 -0.809 0.809 0.5878 -13.5821 21.5483)" cx="14.4" cy="24.1" rx="1.7" ry="1.7"/><path d="M16.7,24.7l-1,1.4c-0.6,0.8-0.3,1.8,0.4,2.4l3.5,3.2c0.6,0.6,1.7,0.3,2.3-0.3L24,33c0.6,0.4,1.4,0.3,1.8-0.3l0,0l0.3-0.5  c0.4-0.6,0.3-1.4-0.3-1.8l0,0l-2.2-1.6c0.3-0.8,0.3-1.9-0.4-2.3l-4.1-2.3C18.3,23.8,17.2,23.9,16.7,24.7z"/><ellipse transform="matrix(0.309 -0.9511 0.9511 0.309 -29.0098 32.8413)" cx="8.1" cy="36.4" rx="1.7" ry="1.7"/><path d="M10.5,36.2l-0.5,1.7c-0.3,0.9,0.2,1.8,1.1,2.2l4.3,2c0.8,0.3,1.7-0.3,2.1-1l2.5,0.8c0.7,0.2,1.4-0.1,1.6-0.8l0,0l0.2-0.5  c0.2-0.7-0.1-1.4-0.8-1.6l0,0l-2.6-0.8c0.1-0.8-0.3-1.9-1.1-2.1l-4.6-0.9C11.7,34.9,10.8,35.3,10.5,36.2z"/><circle cx="5.9" cy="50" r="1.7"/><path d="M8.1,49.1v1.8c0,1,0.8,1.6,1.7,1.7l4.7,0.5c0.8,0.1,1.5-0.8,1.7-1.6h2.7c0.7,0,1.3-0.6,1.3-1.3l0,0v-0.6  c0-0.7-0.6-1.3-1.3-1.3l0,0h-2.7c-0.2-0.8-0.9-1.7-1.7-1.6l-4.7,0.5C9,47.5,8.1,48.2,8.1,49.1z"/><ellipse transform="matrix(0.9511 -0.309 0.309 0.9511 -19.262 5.6155)" cx="8.1" cy="63.6" rx="1.7" ry="1.7"/><path d="M9.9,62.1l0.5,1.7c0.3,0.9,1.2,1.3,2.2,1.1l4.6-0.9c0.8-0.2,1.2-1.2,1.1-2.1l2.5-0.8c0.7-0.2,1-0.9,0.8-1.6l0,0l-0.2-0.5  c-0.2-0.7-0.9-1-1.6-0.8l0,0l-2.6,0.8c-0.4-0.7-1.4-1.3-2.1-1l-4.3,2C10.2,60.3,9.6,61.2,9.9,62.1z"/><ellipse transform="matrix(0.809 -0.5878 0.5878 0.809 -41.8703 22.9327)" cx="14.4" cy="75.9" rx="1.7" ry="1.7"/><path d="M15.6,73.9l1,1.4c0.6,0.8,1.6,0.9,2.4,0.4l4.1-2.3c0.7-0.4,0.8-1.5,0.4-2.3l2.2-1.6c0.6-0.4,0.7-1.2,0.3-1.8l0,0l-0.3-0.5  c-0.4-0.6-1.2-0.7-1.8-0.3l0,0l-2.2,1.6c-0.6-0.6-1.7-0.8-2.3-0.3L16,71.5C15.3,72.1,15.1,73.1,15.6,73.9z"/><ellipse transform="matrix(0.5878 -0.809 0.809 0.5878 -59.3534 54.8035)" cx="24.1" cy="85.6" rx="1.7" ry="1.7"/><path d="M24.7,83.3l1.4,1c0.8,0.6,1.8,0.3,2.4-0.4l3.2-3.5c0.6-0.6,0.3-1.7-0.3-2.3L33,76c0.4-0.6,0.3-1.4-0.3-1.8l0,0l-0.5-0.3  c-0.6-0.4-1.4-0.3-1.8,0.3l0,0l-1.6,2.2c-0.8-0.3-1.9-0.3-2.3,0.4l-2.3,4.1C23.8,81.7,23.9,82.8,24.7,83.3z"/><ellipse transform="matrix(0.309 -0.9511 0.9511 0.309 -62.2644 98.1081)" cx="36.4" cy="91.9" rx="1.7" ry="1.7"/><path d="M36.2,89.5l1.7,0.5c0.9,0.3,1.8-0.2,2.2-1.1l2-4.3c0.3-0.8-0.3-1.7-1-2.1l0.8-2.5c0.2-0.7-0.1-1.4-0.8-1.6l0,0l-0.5-0.2  c-0.7-0.2-1.4,0.1-1.6,0.8l0,0l-0.8,2.6c-0.8-0.1-1.9,0.3-2.1,1.1l-0.9,4.6C34.9,88.3,35.3,89.2,36.2,89.5z"/><circle cx="50" cy="94.1" r="1.7"/><path d="M49.1,91.9h1.8c1,0,1.6-0.8,1.7-1.7l0.5-4.7c0.1-0.8-0.8-1.5-1.6-1.7v-2.7c0-0.7-0.6-1.3-1.3-1.3l0,0h-0.6  c-0.7,0-1.3,0.6-1.3,1.3l0,0v2.7c-0.8,0.2-1.7,0.9-1.6,1.7l0.5,4.7C47.5,91,48.2,91.9,49.1,91.9z"/><ellipse transform="matrix(0.9511 -0.309 0.309 0.9511 -25.2862 24.1564)" cx="63.6" cy="91.9" rx="1.7" ry="1.7"/><path d="M62.1,90.1l1.7-0.5c0.9-0.3,1.3-1.2,1.1-2.2L64,82.7c-0.2-0.8-1.2-1.2-2.1-1.1l-0.8-2.5c-0.2-0.7-0.9-1-1.6-0.8l0,0  l-0.5,0.2c-0.7,0.2-1,0.9-0.8,1.6l0,0l0.8,2.6c-0.7,0.4-1.3,1.4-1,2.1l2,4.3C60.3,89.8,61.2,90.4,62.1,90.1z"/><ellipse transform="matrix(0.809 -0.5878 0.5878 0.809 -35.8458 60.9686)" cx="75.9" cy="85.6" rx="1.7" ry="1.7"/><path d="M73.9,84.4l1.4-1c0.8-0.6,0.9-1.6,0.4-2.4l-2.3-4.1c-0.4-0.7-1.5-0.8-2.3-0.4l-1.6-2.2c-0.4-0.6-1.2-0.7-1.8-0.3l0,0  l-0.5,0.3c-0.6,0.4-0.7,1.2-0.3,1.8l0,0l1.6,2.2c-0.6,0.6-0.8,1.7-0.3,2.3l3.2,3.5C72.1,84.7,73.1,84.9,73.9,84.4z"/><ellipse transform="matrix(0.5878 -0.809 0.809 0.5878 -26.0982 100.5749)" cx="85.6" cy="75.9" rx="1.7" ry="1.7"/><path d="M83.3,75.3l1-1.4c0.6-0.8,0.3-1.8-0.4-2.4l-3.5-3.2c-0.6-0.6-1.7-0.3-2.3,0.3L76,67c-0.6-0.4-1.4-0.3-1.8,0.3l0,0l-0.3,0.5  c-0.4,0.6-0.3,1.4,0.3,1.8l0,0l2.2,1.6c-0.3,0.8-0.3,1.9,0.4,2.3l4.1,2.3C81.7,76.2,82.8,76.1,83.3,75.3z"/><ellipse transform="matrix(0.309 -0.9511 0.9511 0.309 3.0024 131.3627)" cx="91.9" cy="63.6" rx="1.7" ry="1.7"/><path d="M89.5,63.8l0.5-1.7c0.3-0.9-0.2-1.8-1.1-2.2l-4.3-2c-0.8-0.3-1.7,0.3-2.1,1L80,58.1c-0.7-0.2-1.4,0.1-1.6,0.8l0,0l-0.2,0.5  c-0.2,0.7,0.1,1.4,0.8,1.6l0,0l2.6,0.8c-0.1,0.8,0.3,1.9,1.1,2.1l4.6,0.9C88.3,65.1,89.2,64.7,89.5,63.8z"/><circle cx="94.1" cy="50" r="1.7"/><path d="M91.9,50.9v-1.8c0-1-0.8-1.6-1.7-1.7l-4.7-0.5c-0.8-0.1-1.5,0.8-1.7,1.6h-2.7c-0.7,0-1.3,0.6-1.3,1.3l0,0v0.6  c0,0.7,0.6,1.3,1.3,1.3l0,0h2.7c0.2,0.8,0.9,1.7,1.7,1.6l4.7-0.5C91,52.5,91.9,51.8,91.9,50.9z"/><ellipse transform="matrix(0.9511 -0.309 0.309 0.9511 -6.7453 30.1806)" cx="91.9" cy="36.4" rx="1.7" ry="1.7"/><path d="M90.1,37.9l-0.5-1.7c-0.3-0.9-1.2-1.3-2.2-1.1L82.7,36c-0.8,0.2-1.2,1.2-1.1,2.1l-2.5,0.8c-0.7,0.2-1,0.9-0.8,1.6l0,0  l0.2,0.5c0.2,0.7,0.9,1,1.6,0.8l0,0l2.6-0.8c0.4,0.7,1.4,1.3,2.1,1l4.3-2C89.8,39.7,90.4,38.8,90.1,37.9z"/><ellipse transform="matrix(0.809 -0.5878 0.5878 0.809 2.1901 54.9441)" cx="85.6" cy="24.1" rx="1.7" ry="1.7"/><path d="M84.4,26.1l-1-1.4c-0.6-0.8-1.6-0.9-2.4-0.4l-4.1,2.3c-0.7,0.4-0.8,1.5-0.4,2.3l-2.2,1.6c-0.6,0.4-0.7,1.2-0.3,1.8l0,0  l0.3,0.5c0.4,0.6,1.2,0.7,1.8,0.3l0,0l2.2-1.6c0.6,0.6,1.7,0.8,2.3,0.3l3.5-3.2C84.7,27.9,84.9,26.9,84.4,26.1z"/><ellipse transform="matrix(0.5878 -0.809 0.809 0.5878 19.6732 67.3196)" cx="75.9" cy="14.4" rx="1.7" ry="1.7"/><path d="M75.3,16.7l-1.4-1c-0.8-0.6-1.8-0.3-2.4,0.4l-3.2,3.5c-0.6,0.6-0.3,1.7,0.3,2.3L67,24c-0.4,0.6-0.3,1.4,0.3,1.8l0,0l0.5,0.3  c0.6,0.4,1.4,0.3,1.8-0.3l0,0l1.6-2.2c0.8,0.3,1.9,0.3,2.3-0.4l2.3-4.1C76.2,18.3,76.1,17.2,75.3,16.7z"/><ellipse transform="matrix(0.309 -0.9511 0.9511 0.309 36.257 66.0959)" cx="63.6" cy="8.1" rx="1.7" ry="1.7"/><path d="M63.8,10.5l-1.7-0.5c-0.9-0.3-1.8,0.2-2.2,1.1l-2,4.3c-0.3,0.8,0.3,1.7,1,2.1L58.1,20c-0.2,0.7,0.1,1.4,0.8,1.6l0,0l0.5,0.2  c0.7,0.2,1.4-0.1,1.6-0.8l0,0l0.8-2.6c0.8,0.1,1.9-0.3,2.1-1.1l0.9-4.6C65.1,11.7,64.7,10.8,63.8,10.5z"/><circle cx="50" cy="33.2" r="4.5"/><path d="M52.4,39.1h-4.7c-2.6,0-4.3,2-4.6,4.6l-1.4,12.5c-0.2,2.2,2.1,4.1,4.3,4.5v7.1c0,1.9,1.5,3.4,3.4,3.4l0,0h1.5  c1.9,0,3.4-1.5,3.4-3.4l0,0v-7.2c2.2-0.4,4.5-2.4,4.3-4.5L57,43.7C56.7,41.3,54.9,39.1,52.4,39.1z"/></svg>';
var pictoPtiv = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 106.28875000000001" enable-background="new 0 0 100 85.031" xml:space="preserve"><g><path d="M40.797,12.497v0.002c0.007,0,0.014-0.002,0.021-0.002c2.899,0,5.324,1.675,6.145,3.968   c0.869-0.504,1.842-0.796,2.875-0.796c1.042,0,2.024,0.297,2.899,0.81c0.817-2.299,3.246-3.981,6.15-3.981   c0.007,0,0.016,0.002,0.021,0.002v-0.002h4.691c0.071-0.005,0.144-0.007,0.217-0.014C62.324,6.631,56.703,2.277,49.976,2.277   c-6.734,0-12.357,4.361-13.844,10.219H40.797z"/><path d="M98.815,53.447L76.674,20.993c-0.273-0.401-0.593-0.748-0.936-1.063c0.578,1.41,0.903,2.95,0.903,4.565   c0,4.299-2.269,8.07-5.663,10.206l7.093,10.396l-9.557-3.24c-6.714-1.883-14.605-2.18-14.605-2.18   c2.231-0.816,4.18-2.299,5.628-4.244c-3.932-1.825-6.725-5.699-6.983-10.25c0,0-0.133-3.336-2.75-3.314   c-2.265,0.019-2.618,2.252-2.705,3.288c-0.002,4.744-2.717,8.188-6.712,10.154c1.467,2.015,3.461,3.547,5.753,4.375   c0,0-8.507,0.229-14.76,2.171l-9.556,3.24l7.024-10.296c-3.486-2.117-5.828-5.939-5.828-10.306c0-1.465,0.276-2.862,0.756-4.162   c-0.191,0.211-0.389,0.417-0.555,0.66L1.081,53.447c-1.506,2.207-1.433,5.131,0.184,7.261c1.198,1.578,3.044,2.456,4.951,2.456   c0.665,0,1.338-0.106,1.993-0.329l20.679-7.01v29.206h41.891V55.749l20.907,7.086c0.655,0.223,1.328,0.329,1.992,0.329   c1.907,0,3.754-0.878,4.951-2.456C100.246,58.578,100.32,55.654,98.815,53.447z"/></g><g><g><g><path d="M35.083,34.082c-5.286,0-9.587-4.299-9.587-9.586c0-5.286,4.301-9.587,9.587-9.587c5.287,0,9.589,4.301,9.589,9.587     C44.672,29.782,40.37,34.082,35.083,34.082L35.083,34.082z M35.083,19.856c-2.558,0-4.639,2.081-4.639,4.639     c0,2.557,2.082,4.639,4.639,4.639c2.559,0,4.641-2.082,4.641-4.639C39.724,21.938,37.642,19.856,35.083,19.856L35.083,19.856z"/></g><g><path d="M64.581,34.082c-5.287,0-9.588-4.299-9.588-9.586c0-5.286,4.301-9.587,9.588-9.587c5.286,0,9.587,4.301,9.587,9.587     C74.168,29.782,69.867,34.082,64.581,34.082L64.581,34.082z M64.581,19.856c-2.558,0-4.638,2.081-4.638,4.639     c0,2.557,2.08,4.639,4.638,4.639c2.557,0,4.638-2.082,4.638-4.639C69.219,21.938,67.138,19.856,64.581,19.856L64.581,19.856z"/></g></g></g></svg>';
var pictoPers = '<svg height="60" fill="rgb(221,72,20)" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 595.3 733.9" enable-background="new 0 0 595.3 733.9" xml:space="preserve"><g><path d="M279.2,180.9c10.1,0,18.2-8.1,18.2-18.2c0-10-8.1-18.2-18.2-18.2c-10,0-18.2,8.1-18.2,18.2		C261,172.7,269.1,180.9,279.2,180.9z M429.5,492.2l-8.4,23L324,341.8l21.6-140.3l14-20l-7.2-5.6l-3.4,3.8l3.8-24.7		c11.7-4.2,50.2-14.5,88.3,15.3c45.5,35.6,98.1,9.2,98.1,9.2l17.7-117.9c0,0-52.6,26.4-98.1-9.2c-45.5-35.6-91.9-13.8-91.9-13.8		L363,38l-23.4,152l-16.3,18l-29.8-18.4c-3.4-2.8-7.7-4.4-12.3-4.3c-3,0.1-5.8,0.9-8.3,2.1l-42.2,28l23.5,32.6l7.6-4.5L251.4,220		l11.1-7.5l0.8,40.8c0,1.7-2.8,42-2.8,42l-1.9,55.3l17,0.6l-63.6,101.2l-14.6-27.2L32.8,705.5h529.7L429.5,492.2z M277.9,347.5		l1.7-50.8l2.4-24.5c0.1,0,0.3,0,0.5,0c0.1,0,0.3,0,0.4,0c0.7,0,14.2,12,14.2,12l1.1,31.1L277.9,347.5z M316,275.9		c0,0-14.2-20.6-14.3-23.3l-0.8-40.7l25.8,16.6l8.9-12.7l-17.7,114.9L316,275.9z"/></g></svg>';
var pictoHonn = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path fill="#000000" d="M119.798,42.973c0.12,0.336,0.206,0.687,0.259,1.046C120.003,43.66,119.918,43.31,119.798,42.973z"/><path fill="#000000" d="M120.067,44.079c0.023,0.167,0.035,0.337,0.043,0.509C120.103,44.417,120.091,44.246,120.067,44.079z"/><path fill="#000000" d="M120.117,44.681c0.005,0.177,0.001,0.357-0.01,0.538C120.117,45.038,120.123,44.858,120.117,44.681z"/><path fill="#000000" d="M124.355,21.073c-0.079,0.289-0.18,0.573-0.3,0.851C124.176,21.646,124.276,21.362,124.355,21.073z"/><path fill="#000000" d="M124.545,20.085c-0.032,0.292-0.088,0.581-0.159,0.866C124.457,20.666,124.513,20.377,124.545,20.085z"/><path fill="#000000" d="M124.574,19.151c0.012,0.298,0.007,0.598-0.023,0.895C124.581,19.748,124.586,19.45,124.574,19.151z"/><path fill="#000000" d="M124.453,18.111c0.061,0.292,0.096,0.586,0.114,0.882C124.549,18.697,124.514,18.402,124.453,18.111z"/><path fill="#000000" d="M123.769,16.282c0.148,0.265,0.278,0.537,0.387,0.816C124.047,16.819,123.917,16.547,123.769,16.282z"/><path fill="#000000" d="M124.193,17.208c0.1,0.271,0.181,0.547,0.241,0.827C124.374,17.754,124.293,17.479,124.193,17.208z"/><path fill="#000000" d="M119.691,47.189c-0.077,0.211-0.164,0.423-0.262,0.637C119.527,47.612,119.614,47.4,119.691,47.189z"/><path fill="#000000" d="M120.03,45.915c-0.034,0.199-0.077,0.399-0.13,0.601C119.953,46.314,119.997,46.114,120.03,45.915z"/><path fill="#000000" d="M119.893,46.547c-0.055,0.206-0.119,0.414-0.194,0.623C119.773,46.961,119.838,46.753,119.893,46.547z"/><path fill="#000000" d="M120.104,45.293c-0.014,0.188-0.036,0.379-0.067,0.572C120.068,45.673,120.092,45.482,120.104,45.293z"/><g><path d="M57.864,78.869c-0.192,0.061-0.383,0.121-0.579,0.178C57.481,78.99,57.672,78.93,57.864,78.869z"/><path d="M48.694,26.799c0.085-0.038,0.171-0.074,0.257-0.107C48.865,26.726,48.779,26.761,48.694,26.799z"/><path d="M49.157,26.618c0.084-0.027,0.167-0.052,0.252-0.075C49.324,26.566,49.241,26.591,49.157,26.618z"/><path d="M48.223,27.039c0.088-0.05,0.176-0.099,0.264-0.143C48.398,26.94,48.311,26.989,48.223,27.039z"/><path d="M47.239,27.719c0.103-0.085,0.206-0.169,0.31-0.246C47.445,27.549,47.342,27.633,47.239,27.719z"/><path d="M51.606,26.594c0.048,0.017,0.097,0.034,0.145,0.052C51.703,26.627,51.654,26.61,51.606,26.594z"/><path d="M50.877,26.424c0.049,0.006,0.097,0.015,0.146,0.022C50.974,26.438,50.926,26.43,50.877,26.424z"/><path d="M51.247,26.489c0.05,0.012,0.1,0.025,0.147,0.039C51.347,26.514,51.297,26.5,51.247,26.489z"/><path d="M46.606,28.288c0.157-0.157,0.313-0.301,0.471-0.438C46.92,27.986,46.763,28.131,46.606,28.288z"/><path d="M50.496,26.398c0.043,0,0.087,0.005,0.133,0.007C50.583,26.403,50.54,26.398,50.496,26.398z"/><path d="M49.613,26.493c0.082-0.018,0.164-0.032,0.246-0.044C49.777,26.461,49.695,26.475,49.613,26.493z"/><path d="M50.057,26.42c0.084-0.009,0.167-0.013,0.249-0.016C50.223,26.408,50.142,26.411,50.057,26.42z"/><path d="M47.741,27.341c0.093-0.064,0.186-0.127,0.279-0.186C47.927,27.213,47.834,27.276,47.741,27.341z"/><path d="M41.018,77.646c-0.181-0.083-0.359-0.173-0.538-0.262C40.659,77.473,40.837,77.562,41.018,77.646z"/><path d="M42.062,78.101c-0.181-0.075-0.361-0.152-0.541-0.23C41.702,77.948,41.882,78.025,42.062,78.101z"/><path d="M43.121,78.503c-0.181-0.065-0.361-0.132-0.542-0.2C42.759,78.371,42.94,78.438,43.121,78.503z"/><path d="M44.189,78.853c-0.181-0.055-0.361-0.11-0.541-0.17C43.828,78.742,44.009,78.798,44.189,78.853z"/><path d="M35.181,73.795c-0.298-0.27-0.591-0.547-0.877-0.834C34.59,73.248,34.882,73.525,35.181,73.795z"/><path d="M39.989,77.137c-0.18-0.095-0.357-0.193-0.535-0.292C39.632,76.943,39.809,77.042,39.989,77.137z"/><path d="M38.98,76.575c-0.18-0.104-0.357-0.216-0.535-0.329C38.623,76.359,38.8,76.471,38.98,76.575z"/><path d="M36.09,74.571c-0.202-0.164-0.398-0.336-0.595-0.506C35.692,74.235,35.888,74.407,36.09,74.571z"/><path d="M37.991,75.963c-0.181-0.119-0.359-0.245-0.536-0.368C37.632,75.718,37.811,75.844,37.991,75.963z"/><path d="M37.027,75.293c-0.186-0.135-0.366-0.279-0.549-0.421C36.661,75.014,36.841,75.158,37.027,75.293z"/><path d="M86.008,42.528c-0.083,0.062-0.163,0.128-0.241,0.198l-0.062,0.062C85.804,42.696,85.904,42.607,86.008,42.528z"/><path d="M86.104,42.458c0.15-0.106,0.304-0.204,0.465-0.286C86.408,42.255,86.255,42.352,86.104,42.458z"/><path d="M86.582,42.167c0.163-0.083,0.334-0.153,0.505-0.212C86.916,42.014,86.745,42.083,86.582,42.167z"/><path d="M80.668,18.725c0.062-0.083,0.123-0.168,0.178-0.255c-0.056,0.09-0.121,0.175-0.185,0.26L80.668,18.725z"/><path d="M51.951,26.734c0.047,0.022,0.093,0.044,0.139,0.067C52.044,26.778,51.998,26.756,51.951,26.734z"/><path d="M87.69,41.796c-0.185,0.033-0.366,0.08-0.546,0.138C87.324,41.876,87.506,41.829,87.69,41.796z"/><path d="M64.178,75.396c-0.622,0.541-1.289,1.03-1.992,1.476c1.021-0.646,1.969-1.388,2.814-2.232l25.328-25.331   c0.681-0.68,1.161-1.371,1.473-2.045c-0.764,1.095-1.63,2.141-2.606,3.117L64.178,75.396z"/><path d="M80.307,13.565c0.103,0.103,0.198,0.21,0.287,0.32C80.504,13.775,80.408,13.667,80.307,13.565z"/><path d="M80.624,13.928c0.079,0.101,0.154,0.204,0.221,0.31C80.778,14.132,80.703,14.029,80.624,13.928z"/><path d="M52.284,26.914c0.044,0.026,0.087,0.051,0.128,0.08C52.371,26.965,52.328,26.94,52.284,26.914z"/><path d="M52.612,27.139c0.033,0.026,0.069,0.052,0.104,0.079C52.682,27.19,52.646,27.165,52.612,27.139z"/><path d="M45.267,79.151c-0.179-0.046-0.359-0.092-0.54-0.143C44.907,79.06,45.088,79.105,45.267,79.151z"/><path d="M62.122,76.914c-0.195,0.12-0.394,0.235-0.593,0.354C61.729,77.149,61.927,77.034,62.122,76.914z"/><path d="M52.592,79.843c-0.107,0.009-0.214,0.015-0.32,0.019C52.378,79.857,52.484,79.852,52.592,79.843z"/><path d="M51.533,79.887c-0.087,0-0.172,0.003-0.259,0.003C51.361,79.89,51.446,79.887,51.533,79.887z"/><path d="M53.604,79.759c-0.116,0.014-0.231,0.023-0.348,0.034C53.373,79.782,53.488,79.772,53.604,79.759z"/><path d="M56.514,79.253c-0.114,0.027-0.232,0.053-0.348,0.079C56.281,79.306,56.399,79.28,56.514,79.253z"/><path d="M59.676,78.191c-0.178,0.077-0.354,0.151-0.534,0.223C59.321,78.343,59.498,78.269,59.676,78.191z"/><path d="M58.798,78.545c-0.172,0.065-0.345,0.13-0.519,0.188C58.453,78.675,58.626,78.61,58.798,78.545z"/><path d="M54.594,79.633c-0.119,0.016-0.239,0.033-0.36,0.049C54.354,79.666,54.475,79.648,54.594,79.633z"/><path d="M60.52,77.804c-0.18,0.088-0.363,0.174-0.547,0.256C60.156,77.978,60.34,77.892,60.52,77.804z"/><path d="M55.563,79.464c-0.12,0.023-0.241,0.044-0.362,0.065C55.322,79.508,55.443,79.487,55.563,79.464z"/><path d="M50.687,79.882c-0.17-0.005-0.338-0.006-0.508-0.013C50.349,79.876,50.517,79.877,50.687,79.882z"/><path d="M61.335,77.376c-0.185,0.103-0.372,0.202-0.561,0.3C60.963,77.578,61.15,77.479,61.335,77.376z"/><path d="M46.351,79.398c-0.18-0.037-0.359-0.074-0.539-0.115C45.992,79.324,46.171,79.361,46.351,79.398z"/><path d="M49.607,79.835c-0.172-0.012-0.344-0.02-0.518-0.036C49.263,79.815,49.435,79.823,49.607,79.835z"/><path d="M47.438,79.595c-0.178-0.028-0.356-0.057-0.535-0.089C47.081,79.538,47.259,79.566,47.438,79.595z"/><path d="M48.523,79.74c-0.176-0.021-0.351-0.039-0.527-0.062C48.172,79.701,48.347,79.72,48.523,79.74z"/><path d="M94.993,29.357c-0.013-0.184-0.034-0.367-0.072-0.548c-0.003-0.017-0.008-0.031-0.011-0.048   c-0.039-0.173-0.089-0.345-0.15-0.513c-0.009-0.023-0.015-0.046-0.023-0.068c-0.067-0.173-0.148-0.342-0.241-0.506   c-0.015-0.027-0.031-0.054-0.048-0.081c-0.09-0.151-0.191-0.298-0.302-0.439c-0.012-0.015-0.02-0.03-0.03-0.043v0.009   c-0.085-0.105-0.17-0.21-0.268-0.307c-1.543-1.541-4.039-1.541-5.583,0L65.289,49.792l-0.001-0.002l-0.02,0.02   c-0.156,0.156-0.36,0.233-0.564,0.233c-0.205,0-0.408-0.078-0.562-0.233c-0.312-0.312-0.312-0.816,0-1.128l21.402-21.401   l3.686-3.688c1.304-1.55,1.229-3.865-0.229-5.326c-1.541-1.541-4.043-1.539-5.58,0.001l-2.573,2.573v0L58.584,43.103l-0.02-0.021   l-0.001,0.001c-0.155,0.156-0.359,0.233-0.563,0.233c-0.205,0-0.408-0.078-0.563-0.233c-0.312-0.311-0.312-0.816,0-1.128   L80.661,18.73c0.063-0.085,0.129-0.17,0.185-0.26c0,0,0.001,0,0.001,0l0,0c0.819-1.287,0.819-2.941,0-4.228v0   c-0.001-0.001-0.001-0.002-0.002-0.002c-0.066-0.106-0.142-0.209-0.221-0.31c-0.01-0.014-0.02-0.029-0.03-0.043   c-0.089-0.11-0.185-0.218-0.287-0.32c-0.771-0.771-1.78-1.157-2.792-1.157c-0.948,0-1.896,0.346-2.648,1.028L43.24,45.063   c-0.156,0.156-0.36,0.233-0.564,0.233c-0.205,0-0.408-0.077-0.564-0.233c-0.311-0.312-0.311-0.817,0-1.127l10.582-10.581   c1.645-1.744,1.816-4.371,0.309-5.88c-0.093-0.091-0.188-0.177-0.285-0.258c-0.035-0.027-0.071-0.053-0.104-0.079   c-0.067-0.051-0.133-0.1-0.2-0.145c-0.041-0.028-0.084-0.053-0.128-0.08c-0.063-0.039-0.128-0.078-0.194-0.112   c-0.046-0.023-0.092-0.045-0.139-0.067c-0.066-0.031-0.132-0.062-0.2-0.088c-0.048-0.019-0.097-0.036-0.145-0.052   c-0.071-0.025-0.141-0.047-0.212-0.066c-0.048-0.014-0.098-0.027-0.147-0.039c-0.073-0.017-0.149-0.031-0.224-0.042   c-0.05-0.008-0.097-0.017-0.146-0.022c-0.082-0.01-0.165-0.015-0.248-0.019c-0.046-0.002-0.09-0.006-0.133-0.007   c-0.015,0-0.03-0.002-0.045-0.002c-0.048,0-0.097,0.007-0.145,0.009c-0.081,0.003-0.164,0.006-0.249,0.016   c-0.065,0.006-0.132,0.017-0.199,0.028c-0.082,0.012-0.164,0.026-0.246,0.044c-0.067,0.015-0.137,0.032-0.204,0.051   c-0.084,0.022-0.167,0.047-0.252,0.075c-0.068,0.023-0.137,0.048-0.206,0.074c-0.086,0.033-0.172,0.069-0.257,0.107   c-0.069,0.03-0.138,0.062-0.208,0.097c-0.088,0.044-0.176,0.093-0.264,0.143c-0.068,0.039-0.135,0.075-0.203,0.117   c-0.093,0.058-0.186,0.121-0.279,0.186c-0.064,0.044-0.128,0.085-0.192,0.132c-0.104,0.077-0.207,0.161-0.31,0.246   c-0.054,0.044-0.108,0.084-0.162,0.131c-0.157,0.136-0.314,0.281-0.471,0.438L34.304,40.59v0.001c-8.939,8.943-8.938,23.43,0,32.37   c0.286,0.287,0.579,0.564,0.877,0.834c0.104,0.093,0.21,0.178,0.314,0.271c0.197,0.17,0.393,0.342,0.595,0.506   c0.127,0.105,0.259,0.202,0.388,0.301c0.183,0.142,0.363,0.286,0.549,0.421c0.141,0.103,0.285,0.202,0.429,0.302   c0.177,0.123,0.355,0.249,0.536,0.368c0.15,0.097,0.302,0.189,0.454,0.283c0.178,0.113,0.354,0.225,0.535,0.329   c0.157,0.094,0.315,0.181,0.475,0.27c0.177,0.099,0.354,0.197,0.535,0.292c0.163,0.086,0.326,0.166,0.491,0.247   c0.179,0.089,0.357,0.179,0.538,0.262c0.167,0.076,0.335,0.151,0.503,0.225c0.18,0.078,0.36,0.155,0.541,0.23   c0.172,0.071,0.344,0.137,0.516,0.202c0.181,0.068,0.361,0.135,0.542,0.2c0.176,0.061,0.352,0.121,0.528,0.18   c0.18,0.06,0.36,0.115,0.541,0.17c0.179,0.055,0.358,0.105,0.538,0.156c0.18,0.051,0.361,0.097,0.54,0.143   c0.183,0.047,0.364,0.089,0.545,0.132c0.18,0.041,0.359,0.078,0.539,0.115c0.184,0.039,0.368,0.074,0.552,0.107   c0.178,0.032,0.356,0.061,0.535,0.089c0.187,0.028,0.373,0.059,0.559,0.083c0.176,0.023,0.351,0.042,0.527,0.062   c0.188,0.021,0.377,0.042,0.566,0.059c0.174,0.017,0.346,0.024,0.518,0.036c0.191,0.015,0.381,0.026,0.572,0.034   c0.17,0.007,0.338,0.008,0.508,0.013c0.155,0.005,0.313,0.011,0.469,0.011c0.04,0,0.079,0,0.118-0.003   c0.087,0,0.172-0.003,0.259-0.003c0.246-0.005,0.492-0.011,0.738-0.025c0.106-0.004,0.213-0.01,0.32-0.019   c0.223-0.014,0.445-0.029,0.665-0.05c0.116-0.011,0.231-0.021,0.348-0.034c0.212-0.022,0.42-0.047,0.629-0.077   c0.121-0.016,0.241-0.033,0.36-0.049c0.204-0.032,0.406-0.066,0.607-0.104c0.121-0.021,0.242-0.042,0.362-0.065   c0.202-0.042,0.402-0.086,0.603-0.132c0.115-0.026,0.233-0.052,0.348-0.079c0.259-0.062,0.517-0.133,0.771-0.206   c0.196-0.057,0.387-0.117,0.579-0.178c0.138-0.045,0.278-0.087,0.415-0.136c0.174-0.059,0.347-0.123,0.519-0.188   c0.114-0.044,0.23-0.084,0.344-0.131c0.18-0.071,0.356-0.146,0.534-0.223c0.099-0.043,0.199-0.087,0.297-0.132   c0.184-0.082,0.367-0.168,0.547-0.256c0.085-0.044,0.171-0.086,0.255-0.128c0.188-0.098,0.376-0.197,0.561-0.3   c0.065-0.037,0.13-0.073,0.194-0.108c0.199-0.118,0.397-0.233,0.593-0.354c0.021-0.015,0.043-0.029,0.063-0.043   c0.703-0.445,1.37-0.935,1.992-1.476L89.194,50.38c0.977-0.977,1.843-2.022,2.606-3.117c0,0,0,0,0-0.001   c0.001-0.001,0.001-0.002,0.002-0.004c0.062-0.132,0.115-0.265,0.162-0.396c0.002-0.003,0.003-0.008,0.004-0.012   c0.047-0.13,0.087-0.259,0.12-0.387c0.003-0.007,0.004-0.012,0.005-0.02c0.033-0.125,0.061-0.249,0.08-0.372   c0.003-0.011,0.005-0.021,0.006-0.031c0.02-0.12,0.032-0.238,0.041-0.355c0.001-0.016,0.001-0.031,0.003-0.046   c0.006-0.113,0.009-0.225,0.005-0.334c0-0.02-0.003-0.039-0.003-0.058c-0.006-0.106-0.014-0.211-0.026-0.316   c-0.004-0.013-0.006-0.024-0.009-0.038c-0.032-0.222-0.085-0.44-0.158-0.648c-0.003-0.006-0.004-0.012-0.006-0.017   c-0.179-0.497-0.469-0.949-0.86-1.338c-0.944-0.945-2.251-1.309-3.476-1.094l0,0c-0.185,0.033-0.366,0.08-0.546,0.138   c-0.02,0.006-0.038,0.013-0.058,0.02c-0.171,0.059-0.342,0.129-0.505,0.212c-0.004,0.001-0.008,0.003-0.013,0.005   c-0.161,0.083-0.314,0.18-0.465,0.286c-0.031,0.022-0.063,0.045-0.097,0.07c-0.104,0.079-0.204,0.168-0.304,0.26l-13.729,13.73   c-0.152,0.155-0.358,0.233-0.561,0.233c-0.205,0-0.41-0.078-0.563-0.233c-0.313-0.313-0.313-0.817,0-1.128l16.84-16.843   l6.203-6.201c0.177-0.183,0.326-0.381,0.459-0.587h0.01c0.108-0.165,0.198-0.337,0.279-0.511c0.011-0.025,0.022-0.048,0.032-0.072   c0.074-0.172,0.138-0.349,0.187-0.527c0.008-0.025,0.013-0.051,0.02-0.076c0.043-0.177,0.079-0.356,0.099-0.538   c0-0.008,0.002-0.016,0.004-0.024c0.019-0.185,0.021-0.371,0.013-0.556C94.994,29.422,94.994,29.389,94.993,29.357z"/><path d="M56.771,26.057L71.45,11.379c-5.323,0.362-10.542,2.576-14.611,6.646l-4.71,4.71c1.344,0.313,2.587,0.997,3.603,2.011   C56.135,25.148,56.482,25.589,56.771,26.057z"/><path d="M31.573,37.859l12.304-12.303c1.735-1.735,3.448-2.517,4.877-2.833l-4.698-4.698c-8.935-8.935-23.42-8.935-32.355,0   c-8.934,8.934-8.934,23.42,0,32.355l12.834,12.834C22.369,54.415,24.714,44.722,31.573,37.859z"/><path d="M44.173,82.854l5.533,5.532h0.004c0.194,0.181,0.451,0.291,0.736,0.291c0.284,0,0.541-0.11,0.732-0.291h0.002l0.003,0.005   l5.153-5.153c-1.676,0.338-3.411,0.516-5.181,0.516C48.787,83.753,46.441,83.442,44.173,82.854z"/></g></svg>';
var pictoGent = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><g><rect x="-2015.5" y="24.803" fill="none" width="308.059" height="239.395"/><rect x="-1763.778" y="263.5" fill="none" width="698.278" height="73.738"/><path d="M-669.303,543.272c11.71-6.344,19.663-18.739,19.663-32.994c0-20.712-16.788-37.5-37.5-37.5   s-37.5,16.788-37.5,37.5c0,14.439,8.165,26.964,20.125,33.23c-18.819,10.765-32.194,38.076-32.194,70.086   c0,0.136,0.006,0.27,0.007,0.405h80.255c3.291-12.326,8.341-23.536,14.75-33.091C-647.292,563.607-657.189,550.021-669.303,543.272   z"/><path d="M-448.303,543.272c11.71-6.344,19.663-18.739,19.663-32.994c0-20.712-16.788-37.5-37.5-37.5   s-37.5,16.788-37.5,37.5c0,14.439,8.165,26.964,20.125,33.23c-11.81,6.755-21.47,20.023-27.03,36.886   c6.573,9.674,11.754,21.068,15.125,33.605h79.704c0.001-0.136,0.007-0.27,0.007-0.405   C-415.709,581.356-429.271,553.876-448.303,543.272z"/><path d="M-505.42,614c-3.371-12.537-8.552-23.932-15.125-33.605c-8.193-12.058-18.549-21.435-30.251-27.02   c14.752-8.693,24.656-24.734,24.656-43.097c0-27.614-22.386-50-50-50s-50,22.386-50,50c0,18.448,9.998,34.551,24.864,43.216   c-11.803,5.676-22.223,15.189-30.422,27.415c-6.409,9.555-11.459,20.765-14.75,33.091c-2.804,10.501-4.334,21.808-4.334,33.595   c0,0.136,0.076,0.27,0.076,0.405H-501C-501,636.08-502.561,624.63-505.42,614z"/><path opacity="0.2" d="M-510.857-214.241c-50.819-8.452-86.949-6.474-91.338,7.403   c-6.82,21.566,65.597,63.7,161.75,94.107c96.152,30.407,179.627,37.573,186.448,16.006c4.91-15.527-31.255-41.716-87.776-66.513   c-28.021-2.634-59.797-9.097-92.672-19.493C-462.698-191.665-488.614-202.51-510.857-214.241z"/><ellipse transform="matrix(-0.3015 0.9535 -0.9535 -0.3015 -86.9541 -265.8626)" opacity="0.2" cx="53.904" cy="-164.781" rx="40.957" ry="182.598"/><ellipse cx="-852.013" cy="-64.329" rx="125" ry="75"/><g><path d="M-370.875,698.062c-10.211-18.645-69.457-11.633-130.082,19.377c0.157,1.178,0.164,2.352,0.014,3.521    c-2.396,18.622-44.074,28.719-91.758,22.654l-0.009,0.08l-76.222-9.807l49.321,2.978l27.29,0.854    c8.672-0.349,64.104,1.847,79.312-14.498c2.389-2.568,1.73-8.229,1.579-9.396c-2.26-17.488-35.891-31.724-79.751-37.538    c-1.768-0.233-3.505-0.604-5.245-0.835l-64.068-8.49c-1.741-0.231-3.512-0.324-5.279-0.56    c-12.464-1.651-21.466-2.258-33.267-2.321c-13.751-1.012-25.466-0.395-37.511,4.24c-47.963,16.135-70.761,26.064-115.307,50.237    c-5.078,2.757-10.135,5.472-15.135,8.153l51.611,91.174c4.025-2.465,8.155-5.059,12.417-7.82    c34.202-22.163,44.788-32.38,56.143-31.416c13.093-0.396,62.116,9.105,92.246,16.207c30.812,7.263,36.362,9.297,67.087,18.052    c42.642,12.508,37.33,8.162,72.205-9.097c21.644-12.235,26.293-15.376,40.365-23.878    C-393.047,730.47-357.799,721.941-370.875,698.062z"/><path d="M-867.192,726.818c0.066-0.035,0.134-0.07,0.2-0.106l-0.003-0.005L-867.192,726.818z"/></g><path d="M40.373,29.833c2.105-1.139,3.532-3.366,3.532-5.926c0-3.719-3.014-6.735-6.734-6.735   c-3.72,0-6.735,3.016-6.735,6.735c0,2.593,1.333,4.843,3.48,5.968C30.535,31.809,28,36.714,28,42.462C28,42.487,28,42,28,42h14.684   c0.592-2,1.499-3.959,2.65-5.676C44.327,33.216,42.551,31.045,40.373,29.833z"/><path d="M80.106,29.833c2.104-1.139,3.513-3.366,3.513-5.926c0-3.719-3.026-6.735-6.747-6.735   c-3.72,0-6.739,3.016-6.739,6.735c0,2.593,1.464,4.843,3.612,5.968c-2.121,1.214-3.858,3.329-4.856,6.357   C70.068,37.97,70.998,40,71.604,42H86c0,0,0,0.487,0,0.462C86,36.673,83.524,31.738,80.106,29.833z"/><path d="M69.808,42.715c-0.604-2.253-1.535-4.388-2.716-6.126c-1.471-2.166-3.331-3.895-5.433-4.897   c2.648-1.561,4.429-4.464,4.429-7.762c0-4.959-4.022-8.992-8.981-8.992s-8.356,3.437-8.979,8.974   c-0.37,3.292,1.795,6.203,4.466,7.759c-2.12,1.019-3.991,2.726-5.464,4.922c-1.15,1.716-2.058,3.729-2.648,5.942   c-0.505,1.887-0.779,4.096-0.779,6.213c0,0.025,0.014,0.251,0.014,0.251h26.887C70.602,46,70.322,44.623,69.808,42.715z"/><g><path d="M92.5,61.25c-1.834-3.349-10.002-2.706-20.89,2.863c0.028,0.211,0.028,0.422,0.002,0.632    c-0.431,3.345-7.362,4.671-24.779,0.171l2.667,0.25l5.917,0.75C57.841,66.035,67.271,67.185,70,64.25    c0.43-0.461,0.278-2.124,0.25-2.333c-0.406-3.141-3.436-3.373-11.312-4.417c-0.317-0.043-6.5-1.834-6.812-1.875    c-4.688-1.291-6.188-1.625-9.562-2.375c-3.916-0.87-4.944-0.739-7.062-0.75c-2.813,0.245-4.337,0.293-6.5,1.125    c-8.615,2.897-12.411,5.348-20.413,9.689c-0.911,0.495-1.819,0.983-2.717,1.464l9.269,16.376c0.723-0.443,1.465-0.909,2.23-1.405    c6.143-3.98,10.093-7.422,12.131-7.249c2.352-0.071,8.606,2.667,14.52,4.517c5.427,1.697,6.531,1.67,12.05,3.243    c7.657,2.246,6.704,1.466,12.968-1.634c3.886-2.198,4.721-2.762,7.25-4.289C90.99,65.453,94.849,65.54,92.5,61.25z"/><path d="M4.834,62.797c0.011-0.006,0.024-0.012,0.036-0.02v0L4.834,62.797z"/></g></g><g display="none"><rect x="-2039.5" y="104.5" display="inline" fill="#000000" stroke="#00FF00" stroke-miterlimit="10" width="1000" height="80"/><rect x="-1255.5" y="-0.5" display="inline" fill="#000000" stroke="#00FF00" stroke-miterlimit="10" width="190" height="288"/><rect x="-1445.5" y="-0.5" display="inline" fill="#000000" stroke="#00FF00" stroke-miterlimit="10" width="190" height="288"/><rect x="-1635.5" y="-0.5" display="inline" fill="#000000" stroke="#00FF00" stroke-miterlimit="10" width="190" height="288"/><rect x="-1825.5" y="-0.5" display="inline" fill="#000000" stroke="#00FF00" stroke-miterlimit="10" width="190" height="288"/><rect x="-2015.5" y="25.5" display="inline" fill="#000000" stroke="#00FF00" stroke-miterlimit="10" width="950" height="238"/></g></svg>';
var pictoAmou = '<svg height="60" fill="rgb(221,72,20)" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 1820.5869 1836.8898749999998" version="1.1" x="0px" y="0px"><g transform="translate(12598.513,4922.2038)"><path style="" d="m -11361.756,-3460.1362 c -14.658,-17.9964 -25.787,-29.8399 -62.117,-66.1024 -51.834,-51.7388 -90.292,-87.1161 -183.882,-169.1501 -68.289,-59.8567 -168.248,-159.9335 -211.167,-211.4162 -18.415,-22.0891 -40.823,-57.6065 -53.346,-84.5579 -12.696,-27.3204 -19.591,-48.6875 -26.967,-83.5671 -4.696,-22.2044 -6.451,-42.1224 -6.724,-50 -0.21,-6.0577 -0.844,-22.5285 1.439,-40.5948 1.816,-14.3764 6.129,-29.6336 9.303,-42.3918 9.215,-37.0358 36.943,-96.3413 82.652,-141.9631 28.364,-28.3102 47.373,-39.5629 82.338,-56.9859 12.239,-6.099 25.651,-12.1886 40.314,-16.6006 25.296,-7.6112 51.843,-11.7117 64.708,-12.9376 5.968,-0.5687 14.593,-1.4546 24.402,-1.7337 16.505,-0.4696 35.676,0.092 46.173,1.7637 38.748,6.1712 80.514,18.4886 112.994,36.8792 24.018,13.5992 48.328,31.9531 80.744,63.5207 l 21.417,20.8562 17.735,-17.4866 c 24.233,-23.8941 32.928,-31.6849 46.963,-42.0782 18.791,-13.9162 37.612,-24.584 64.056,-36.3074 29.694,-13.1641 37.527,-15.8791 60.245,-20.8803 11.295,-2.4865 29.03,-5.2823 45.437,-5.9027 14.387,-0.544 26.518,-0.1294 32.184,0.018 5.947,0.1544 13.554,0.6159 20.826,1.553 3.043,0.3921 8.916,1.3266 15.155,2.4078 7.589,1.3154 15.66,3.4728 19.072,4.5094 6.674,2.0275 24.256,6.9668 47.727,17.1912 40.702,17.7303 63.684,35.0748 97.767,68.3952 21.615,21.1316 30.539,31.6531 42.952,50.6432 21.461,32.8321 39.267,77.4778 47.275,118.5387 5.284,27.0887 5.579,88.1538 0.592,122.0863 -4.363,29.6795 -8.017,44.4105 -15.193,61.25 -7.434,17.4447 -21.796,45.8162 -27.547,54.4164 -1.94,2.9006 -4.612,7.0311 -5.938,9.1788 -5.092,8.246 -18.031,25.7166 -28.83,38.9284 -6.192,7.5755 -13.743,17.0297 -16.779,21.0094 -9.254,12.1315 -63.976,68.2845 -100.865,103.5033 -66.958,63.9264 -104.507,96.748 -163.614,143.014 -9.625,7.5339 -31.002,24.6672 -47.505,38.0739 -61.311,49.8094 -141.675,112.9421 -142.693,113.7509 -1.113,0.8847 -13.516,9.2874 -13.818,9.5373 0,0 -9.315,6.3103 -12.422,7.0759 -1.02,-1.488 -2.006,-3.6913 -5.063,-7.4446 z m -155.987,-77.939 c 0.432,-0.6987 1.309,-0.9467 1.949,-0.5512 1.734,1.0715 1.41,1.8216 -0.785,1.8216 -1.072,0 -1.596,-0.5716 -1.164,-1.2704 z m -533.624,-400.9172 c -8.389,-8.5848 -44.156,-51.6587 -88.053,-93.7348 -38.424,-36.8304 -64.243,-60.4618 -123.961,-113.4604 -75.329,-66.8537 -90.585,-81.1464 -149.397,-139.9643 -76.537,-76.5445 -96.476,-98.7898 -118.719,-132.4495 -25.273,-38.2454 -42.039,-65.8303 -54.574,-113.9535 l -8.047,-38.8751 -2.814,-26.2729 -1.581,-27.9442 1.905,-26.9949 4.823,-21.041 c 1.356,-5.9152 8.339,-26.8337 9.728,-30.5686 7.345,-19.7533 18.613,-41.2824 35.842,-67.5534 24.277,-37.018 61.347,-74.4926 96.688,-97.7444 28.725,-18.8983 48.65,-30.443 94.58,-42.569 l 13.13,-3.4504 15.772,-2.8398 11.806,-1.7503 9.2,-1.1807 5.627,-0.4874 6.65,-0.307 10.535,-0.07 10.782,0.5083 8.77,0.5917 20.529,2.549 29.567,7.3072 c 11.632,2.875 23.597,6.4903 26.691,7.6309 3.094,1.1406 7.312,2.5266 9.375,3.0801 8.388,2.2507 41.866,17.8728 54.051,25.2224 26.408,15.9277 57.414,41.4348 76.536,62.963 6.985,7.863 13.223,14.2964 13.864,14.2964 0.64,0 11.995,-10.4545 25.232,-23.2322 26.446,-25.529 44.065,-39.5845 65.942,-52.6057 16.631,-9.8991 16.465,-9.8136 33.75,-17.3853 29.424,-12.8898 32.658,-15.7143 60.239,-21.7962 8.459,-1.8652 14.22,-3.3021 25.202,-4.2821 8.006,-0.7146 18.787,-1.1863 35.41,-1.404 39.204,-0.5136 53.562,2.9592 53.562,2.9592 0,0 9.056,1.8513 11.929,2.4016 6.427,1.2307 11.565,2.233 16.613,3.4619 17.852,4.3456 27.716,7.7239 37.045,11.4558 12.227,4.8914 15.776,7.529 24,12.0732 24.116,13.3249 32.664,19.5629 51.625,34.7021 12.666,10.1129 46.418,43.7269 56.761,56.5272 20.135,24.9217 41.993,64.911 52.044,95.2175 14.213,42.8566 21.31,132.0157 13.784,173.1571 -2.589,14.1491 -7.632,35.9604 -8.909,37.3038 0,0 -32.449,-7.6465 -35.888,-8.4223 -14.983,-3.3796 -27.24,-6.4026 -53.167,-9.146 -12.274,-1.2988 -27.469,-2.04 -44.977,-1.8209 -20.319,0.2544 -40.221,1.2155 -52.722,3.2315 -27.449,4.4268 -51.313,9.1719 -72.936,17.3864 -28.641,10.8809 -59.196,26.4006 -75.433,36.4219 -17.4,10.7388 -34.681,20.4673 -59.78,45.6341 -21.121,21.1777 -32.387,34.9472 -41.397,50.2203 -6.239,10.5762 -17.606,28.2821 -24.688,43.1203 -6.745,14.1299 -19.108,46.4277 -19.755,47.7833 -0.424,0.8891 -7.064,24.6561 -10.251,36.9942 -2.074,8.0278 -8.75,27.6526 -10.312,71.0434 -0.715,19.8629 -0.329,38.5995 1.591,56.3606 2.459,22.7334 8.936,41.6902 13.766,60.6303 3.718,10.9061 4.55,13.763 11.025,29.7018 0,0 -8.65,11.2285 -43.877,39.3716 -31.557,25.2114 -51.256,35.8732 -51.256,35.8732 l -3.485,-3.875 z"/></g></svg>';
var pictoTrvE = '<svg height="60" fill="rgb(221,72,20)" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 92.02809 118.74944375" version="1.1" x="0px" y="0px"><g transform="translate(-244.57422,-531.98271)"><path style="color:#000000;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000000;letter-spacing:normal;word-spacing:normal;text-transform:none;direction:ltr;block-progression:tb;writing-mode:lr-tb;baseline-shift:baseline;text-anchor:start;white-space:normal;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#000000;solid-opacity:1;fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1.79999995;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate" d="m 289.2776,533.23271 c -0.8139,0.0956 -1.37482,0.36837 -1.68493,0.78351 -0.30546,0.40897 -0.41415,1.03572 -0.25483,1.90553 l 5.14607,3.67604 c 0.70847,0.50876 -0.0518,1.5724 -0.76259,1.06687 l -5.38759,-3.84719 -0.004,-0.004 -0.008,-0.004 -2.69285,-1.92264 c -0.84016,0.40442 -1.55569,0.81049 -1.99491,1.36734 -0.45212,0.57318 -0.71647,1.35982 -0.81014,2.47605 l 7.38249,5.27349 c 0.67498,0.51314 -0.0557,1.53805 -0.76069,1.06687 l -7.7096,-5.5074 -0.004,-0.002 -0.74928,-0.53629 c -1.41255,0.43454 -2.79363,2.05903 -3.1968,4.60218 l 7.42815,5.30582 c 0.71377,0.50787 -0.0509,1.5777 -0.7626,1.06687 l -7.78186,-5.55875 -0.002,-0.002 -1.01552,-0.72456 c -1.29772,0.4308 -2.21784,1.07813 -2.79364,1.93026 -0.57094,0.84494 -0.8226,1.91419 -0.82915,3.13975 l 13.17136,9.40974 4.5166,3.22724 c 0,0 0.0402,0.0281 0.078,0.0647 0.019,0.0183 0.041,0.0403 0.0704,0.0799 0.0147,0.0197 0.0492,0.0739 0.0494,0.0742 1.5e-4,3.1e-4 0.0513,0.12141 0.0513,0.12171 1.4e-4,3.1e-4 0.0304,0.18798 0.0304,0.18828 0,3e-4 -0.0417,0.24123 -0.0418,0.24152 -1.1e-4,2.9e-4 -0.12909,0.21272 -0.12932,0.21299 -2.6e-4,2.7e-4 -0.15173,0.12147 -0.15214,0.12171 -4e-4,2.2e-4 -0.0905,0.0452 -0.12551,0.0571 -0.0351,0.012 -0.0642,0.0197 -0.0894,0.0247 -0.0505,0.01 -0.0834,0.0107 -0.1122,0.0114 -0.23,0.006 -0.24213,-0.026 -0.39366,-0.0666 -0.30305,-0.0811 -0.89622,-0.26511 -2.18698,-0.70554 -0.10944,-0.0374 -0.11006,-0.15355 -0.19398,-0.22631 -0.004,0.011 -0.007,0.01 -0.0114,0.0209 -0.19607,0.51027 -0.36819,1.14616 -0.50396,1.7591 -0.2673,1.20663 -0.39309,2.27987 -0.39746,2.3144 l 4.60598,1.26084 c 5.45291,1.49328 19.62875,6.28614 20.51393,6.58569 l 7.33687,-12.69594 -1.8637,-6.87284 c -0.54956,-2.02682 -2.37022,-4.43352 -4.83419,-6.81008 -2.4639,-2.37651 -5.55037,-4.74045 -8.56723,-6.82715 -5.86804,-4.05882 -11.27143,-6.9617 -11.57391,-7.12387 z m -19.09334,17.04518 -5.48648,1.69634 c -1.98209,0.69378 -4.25158,2.67937 -6.44495,5.30772 -2.19339,2.62835 -4.32938,5.87803 -6.19393,9.03701 -3.62627,6.14379 -6.13323,11.74046 -6.2738,12.05505 0.15382,0.80489 0.46699,1.34651 0.90332,1.62597 0.42955,0.27512 1.06183,0.33868 1.91694,0.11791 l 3.2995,-5.399 c 0.46182,-0.72133 1.55037,-0.0548 1.11822,0.68462 l -3.45164,5.65003 -0.006,0.0114 -0.002,0.002 -1.72487,2.82216 c 0.464,0.80967 0.92075,1.49199 1.50807,1.89032 0.60447,0.40996 1.40837,0.61643 2.5293,0.62947 l 4.72959,-7.74193 c 0.45614,-0.74633 1.57436,-0.0617 1.11822,0.68462 l -5.41992,8.87536 c 0.53517,1.37733 2.2542,2.63687 4.81897,2.85639 l 4.75812,-7.78947 c 0.45614,-0.74633 1.57626,-0.0617 1.12012,0.68462 l -5.63862,9.22908 c 0.52292,1.26304 1.23689,2.13232 2.12803,2.64531 0.88302,0.5083 1.96569,0.68168 3.1873,0.60094 l 8.88867,-14.74599 c 0.83858,-0.90985 1.70822,-2.59647 2.44562,-3.80345 0,0 0.0252,-0.0415 0.059,-0.0818 0.0168,-0.0202 0.0407,-0.0439 0.078,-0.0761 0.0186,-0.0161 0.0702,-0.055 0.0704,-0.0552 2.8e-4,-1.4e-4 0.1138,-0.0588 0.1141,-0.0589 2.9e-4,-7e-5 0.18607,-0.0437 0.18637,-0.0437 2.9e-4,0 0.24503,0.0227 0.24532,0.0228 3e-4,9e-5 0.22031,0.11578 0.2206,0.11601 2.9e-4,2.2e-4 0.13286,0.14224 0.13313,0.14263 2.1e-4,4e-4 0.0521,0.0838 0.0666,0.1179 0.0144,0.0341 0.0219,0.0626 0.0285,0.0875 0.0134,0.0497 0.018,0.0855 0.0209,0.1141 0.0218,0.22901 -0.007,0.24152 -0.0361,0.39556 -0.0591,0.30809 -0.20116,0.91165 -0.5477,2.23073 -0.12163,0.46296 -0.0204,0.75342 0.24722,1.09159 0.26766,0.33816 0.73905,0.66771 1.25705,0.92424 0.81185,0.40206 1.37481,0.50202 1.72106,0.58193 l 0.63137,-1.36544 1.00792,-5.09093 c 1.09249,-5.52022 4.01059,-16.28497 4.21232,-17.02806 l -13.5422,-9.65127 z m 48.82684,9.74635 c -0.28795,-0.007 -0.5864,0.004 -0.89191,0.0304 l -10.93873,18.78526 -0.006,-0.002 c -0.002,0.002 -0.0285,0.0532 -0.0285,0.0532 -0.48561,0.67639 -1.51699,0.009 -1.0992,-0.71124 l 0.0571,-0.0989 c 0.46961,-1.15261 1.24132,-3.09174 0.75879,-4.11344 l -3.69316,-1.13153 -0.56291,1.91504 -0.90712,5.14988 c -0.99712,5.66091 -2.81266,16.71428 -2.81266,16.71428 -0.0238,0.14229 -0.0943,0.27237 -0.19968,0.37084 -0.66274,0.62321 -1.62824,1.13542 -2.28207,1.60315 -0.29091,0.20811 -0.46231,0.38722 -0.53819,0.48304 l 11.93904,10.87408 c 0.0879,-0.0485 0.30828,-0.24842 0.53439,-0.54009 0.457,-0.58954 0.94612,-1.47035 1.52518,-2.0843 0.0687,-0.0732 0.15317,-0.12824 0.24723,-0.16355 l 6.92609,-2.59015 c 1.96706,-0.7353 4.1932,-2.76885 6.33085,-5.44274 2.13762,-2.67389 4.20605,-5.96882 6.00375,-9.16632 3.49648,-6.21901 5.88338,-11.86555 6.01706,-12.18247 -0.17071,-0.80145 -0.49545,-1.33673 -0.93755,-1.60696 -0.43559,-0.26623 -1.06745,-0.3155 -1.91884,-0.0761 l -3.18349,5.46556 c -0.44804,0.72359 -1.54227,0.0865 -1.13343,-0.6599 l 3.33183,-5.72229 0.01,-0.0114 1.66591,-2.86019 c -0.48084,-0.79953 -0.95255,-1.47217 -1.54801,-1.85799 -0.61277,-0.39705 -1.42026,-0.58853 -2.5407,-0.57813 l -4.56415,7.83892 c -0.44004,0.75572 -1.5752,0.0959 -1.13532,-0.65985 l 4.76763,-8.18503 0.006,-0.01 0.46022,-0.79112 c -0.5633,-1.36633 -2.30826,-2.58992 -4.87794,-2.7556 l -4.59457,7.88836 c -0.43998,0.75596 -1.57359,0.0959 -1.13343,-0.6599 l 4.81327,-8.263 0.62948,-1.08209 c -0.54935,-1.25172 -1.27957,-2.10744 -2.18128,-2.60156 -0.6712,-0.36779 -1.45054,-0.54486 -2.31441,-0.56481 z m -45.16792,21.18334 c -0.774,1.40538 -0.73915,1.3077 -0.774,1.40538 l -8.34478,13.84267 0.7721,5.54163 c 0.29036,2.07983 1.7929,4.69407 3.93848,7.36159 2.14558,2.66751 4.91061,5.40085 7.64114,7.85033 5.30984,4.76329 10.30303,8.323 10.58501,8.52354 0.81984,0.008 1.41246,-0.19186 1.77241,-0.56482 0.35432,-0.36712 0.54091,-0.97582 0.49255,-1.85798 l 0,-0.002 -4.64402,-4.2941 c -0.60726,-0.59472 0.25048,-1.52214 0.89001,-0.96228 l 4.86082,4.49569 0.004,0.004 0.006,0.006 2.4304,2.24784 c 0.88506,-0.29568 1.64481,-0.61124 2.15086,-1.10871 0.52074,-0.51192 0.88114,-1.25821 1.11441,-2.35433 l -6.65985,-6.1578 c -0.61087,-0.59374 0.24943,-1.52574 0.89001,-0.96417 l 6.95462,6.43164 0.68081,0.62947 c 1.45584,-0.2536 3.02853,-1.693 3.74831,-4.16478 l -6.69979,-6.19583 c -0.61087,-0.59374 0.24753,-1.52575 0.88811,-0.96417 l 7.02118,6.49249 0.0171,0.0171 0.0133,0.0133 0.89001,0.81965 c 1.34175,-0.26419 2.33392,-0.7902 3.01234,-1.56322 0.67285,-0.76668 1.0563,-1.79688 1.2171,-3.01234 L 292.75206,597.9637 c 0,0 -0.0356,-0.0313 -0.0685,-0.0723 -0.0165,-0.0205 -0.0367,-0.0465 -0.0609,-0.0894 -0.012,-0.0214 -0.0379,-0.0815 -0.038,-0.0818 -8e-5,-3.2e-4 -0.0361,-0.1252 -0.0361,-0.12552 l -0.006,-0.19017 c 0,-3e-4 0.0722,-0.23363 0.0723,-0.23391 1.4e-4,-2.7e-4 0.15567,-0.19565 0.15594,-0.19588 2.7e-4,-2.4e-4 0.16501,-0.1025 0.16545,-0.10269 4.3e-4,-1.5e-4 0.0931,-0.0344 0.12932,-0.0418 0.0362,-0.008 0.0675,-0.01 0.0932,-0.0114 0.0514,-0.003 0.0854,-0.001 0.1141,0.002 0.22885,0.0237 0.23702,0.0568 0.38225,0.11601 0.29044,0.11857 0.42746,0.0397 1.6526,0.63898 0.43,0.21028 0.99841,-0.0571 0.99841,-0.0571 0.41743,-0.10841 1.16228,-0.59423 1.51567,-1.05166 0.55409,-0.71719 0.24734,-1.09708 0.39366,-1.42059 l -0.51533,-0.67516 -4.79235,-1.9873 c -5.30424,-2.20125 -15.67046,-6.36511 -15.68925,-6.37269 l -0.0152,-0.008 c -0.12202,-0.0487 -0.22692,-0.13266 -0.30047,-0.24152 z"/></g></svg>';
var pictoImpa = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><title>Artboard 23</title><path d="M60,11.23a10,10,0,1,1-10-10A10,10,0,0,1,60,11.23ZM87.25,25.68,60.64,24l-4.41-.08a.4.4,0,0,0-.32.15l-5.19,6.49a.9.9,0,0,1-1.45,0L44.08,24a.4.4,0,0,0-.32-.15L39.36,24l-26.6,1.71a3.47,3.47,0,0,0-3.23,3.85,3.61,3.61,0,0,0,3.42,3.09l23.57,1.52a.45.45,0,0,1,.42.4l4.65,43.53,1.94,17.8a3.29,3.29,0,0,0,3.27,2.92h6.42a3.29,3.29,0,0,0,3.27-2.92l1.94-17.8,4.65-43.53a.45.45,0,0,1,.42-.4l23.57-1.52a3.61,3.61,0,0,0,3.42-3.09A3.47,3.47,0,0,0,87.25,25.68ZM96.33,59H72.12a2.36,2.36,0,0,0-2.36,2.36,14.47,14.47,0,0,0,28.93,0A2.36,2.36,0,0,0,96.33,59ZM84.23,35.88a2.72,2.72,0,0,0-2.32,1.29L72.4,52.39a2.74,2.74,0,0,0,2.32,4.19,2.77,2.77,0,0,0,.62-.07A2.72,2.72,0,0,0,77,55.29l7.18-11.5,7.18,11.5a2.74,2.74,0,0,0,4.64-2.9l-9.5-15.22A2.72,2.72,0,0,0,84.23,35.88Zm-68.46,0a2.72,2.72,0,0,0-2.32,1.29L3.95,52.39a2.74,2.74,0,0,0,4.64,2.9l7.18-11.5L23,55.29a2.74,2.74,0,1,0,4.64-2.9l-9.5-15.22A2.72,2.72,0,0,0,15.77,35.88Zm0,39.94A14.48,14.48,0,0,0,30.24,61.35,2.36,2.36,0,0,0,27.88,59H3.67a2.36,2.36,0,0,0-2.36,2.36A14.48,14.48,0,0,0,15.77,75.82Z"/></svg>';
var pictoLead = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px"><title>Artboard 11</title><path d="M50,9a2,2,0,0,1-2-2V3.16a2,2,0,1,1,4,0V7A2,2,0,0,1,50,9ZM30,21.12a2,2,0,0,0,2,2h3.89a2,2,0,0,0,2-2,2,2,0,0,0-2-2H32A2,2,0,0,0,30,21.12Zm37.94-2H64.08a2,2,0,0,0,0,4H68a2,2,0,0,0,1.42-.59A2,2,0,0,0,70,21.15a1.87,1.87,0,0,0-.51-1.4A2,2,0,0,0,68,19.12ZM62.73,6.38A2,2,0,0,0,61.29,7L58.54,9.72a2,2,0,0,0,0,2.89,2.23,2.23,0,0,0,1.42.56,2,2,0,0,0,1.41-.59l2.75-2.75a2,2,0,0,0-1.43-3.45ZM38.66,7A2,2,0,1,0,35.8,9.83l2.79,2.75a2,2,0,0,0,2.82-2.87Zm2.78,14.44A8.56,8.56,0,1,0,50,12.85,8.56,8.56,0,0,0,41.45,21.41ZM15,49.75l1.76,15.53a5.15,5.15,0,0,0,3.35,4.25l3,27.22a2.35,2.35,0,0,0,2.34,2.09h4.71a2.35,2.35,0,0,0,2.34-2.09l3-27.18a5.16,5.16,0,0,0,1.87-1.15l-.22-2a10.08,10.08,0,0,1-4.22-7.14l-1.7-15-2.8,3.5a.74.74,0,0,1-1.15,0l-3.71-4.64a.3.3,0,0,0-.23-.11H21A6.06,6.06,0,0,0,15,49.75Zm5.66-16.44a7.17,7.17,0,0,0,7.17,7.17,7.09,7.09,0,0,0,2.87-.61,11,11,0,0,1,3.89-8.93,7.16,7.16,0,0,0-13.93,2.37ZM79,43H76.67a.3.3,0,0,0-.23.11l-3.71,4.64a.74.74,0,0,1-1.15,0l-2.71-3.38L67.18,59.25a10.18,10.18,0,0,1-4.36,7.22l-.2,1.84a5.13,5.13,0,0,0,1.87,1.23l3,27.22a2.35,2.35,0,0,0,2.34,2.09H74.5a2.35,2.35,0,0,0,2.34-2.09l3-27.18a5.14,5.14,0,0,0,3.47-4.29L85,49.75A6.06,6.06,0,0,0,79,43ZM72.2,26.15a7.16,7.16,0,0,0-6.76,4.8,11,11,0,0,1,3.89,8.93,7.09,7.09,0,0,0,2.87.61,7.17,7.17,0,1,0,0-14.34Zm-9,32.65,2.1-18.54a7.23,7.23,0,0,0-7.19-8H55.33a.36.36,0,0,0-.28.13l-4.43,5.53a.88.88,0,0,1-1.37,0l-4.43-5.53a.35.35,0,0,0-.28-.13H41.88a7.23,7.23,0,0,0-7.19,8L36.8,58.8a6.15,6.15,0,0,0,4,5.08l3.54,32.48a2.81,2.81,0,0,0,2.79,2.49h5.62a2.81,2.81,0,0,0,2.79-2.49l3.54-32.44A6.14,6.14,0,0,0,63.2,58.8Z"/></svg>';
var pictoGrat = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 90 112.5" enable-background="new 0 0 90 90" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M44.65,40.85c-0.033-0.167-0.066-0.317-0.1-0.45  c-0.066,0.133-0.117,0.267-0.15,0.4c-0.267,0.9-0.4,2-0.4,3.3c0,0.133,0.017,0.25,0.05,0.35c0,1.399,0.167,2.833,0.5,4.3  C44.85,47.316,45,45.9,45,44.5c0-0.1,0-0.217,0-0.35C45,42.85,44.883,41.75,44.65,40.85z M44.55,23.55  c-0.167,0.333-0.333,0.7-0.5,1.1c-0.466,1.033-0.75,1.667-0.85,1.9v0.05c-0.034,0.133-0.05,0.367-0.05,0.7  c0,0.733-0.066,1.583-0.2,2.55c-0.133,0.767-0.2,1.433-0.2,2c0,0.4,0,0.883,0,1.45c0.633,0.233,1.15,0.717,1.55,1.45  c0.067,0.133,0.15,0.3,0.25,0.5c0.067-0.2,0.15-0.367,0.25-0.5c0.4-0.733,0.934-1.2,1.601-1.4c-0.101-0.6-0.15-1.083-0.15-1.45  c0-0.566-0.033-1.25-0.1-2.05c-0.167-0.934-0.25-1.75-0.25-2.45c0-0.4,0-0.667,0-0.8c-0.167-0.267-0.467-0.883-0.9-1.85  C44.8,24.283,44.65,23.883,44.55,23.55z M42.55,18.5c0-0.367-0.017-0.667-0.05-0.9c-0.4,0.733-1.2,2.217-2.4,4.45  c-0.567,1.034-1.3,2.417-2.2,4.15c-0.767,1.533-1.283,2.566-1.55,3.1c-0.133,0.3-0.383,1-0.75,2.1v0.05  c-0.267,0.867-0.6,1.917-1,3.15c-0.867,2.767-1.55,6.117-2.05,10.05c-0.066,0.433-0.133,0.883-0.2,1.35  c-0.533,4.767-0.934,7.583-1.2,8.45v0.05c-0.167,0.866-0.9,1.866-2.2,3H28.9c-0.367,0.333-0.783,0.667-1.25,1  c-1.9,1.366-4.183,2.517-6.85,3.45c-0.966,0.333-2.083,0.666-3.35,1c-0.133,0.033-0.65,0.184-1.55,0.45  c1.7,3.366,4.067,6.149,7.1,8.35c1.1-0.667,2.55-1.533,4.35-2.6c0.6-0.367,1.267-0.75,2-1.15c2.967-1.7,5.133-3.083,6.5-4.15  c2.066-1.5,3.617-3.066,4.65-4.699c1.167-1.867,1.75-3.967,1.75-6.301c0-0.6-0.05-1.199-0.15-1.8V51  c-0.033-0.233-0.133-0.783-0.3-1.65c-0.333-1.633-0.533-3.233-0.6-4.8c0-0.133,0-0.283,0-0.45c0-1.567,0.183-2.917,0.55-4.05  c0.133-0.466,0.217-0.816,0.25-1.05c0.067-0.4,0.1-0.883,0.1-1.45c0-0.6-0.1-1.083-0.3-1.45c0-0.1-0.05-0.167-0.15-0.2  c-0.1,0-0.183,0.017-0.25,0.05h-0.05c-1.133,0.333-2,1.667-2.6,4c-0.233,0.9-0.483,2.167-0.75,3.8c0,0.367-0.033,0.683-0.1,0.95  c-0.133,1.033-0.267,1.7-0.4,2c-0.133,0.333-0.383,0.583-0.75,0.75c-0.333,0.166-0.683,0.184-1.05,0.05  c-0.333-0.134-0.6-0.366-0.8-0.7c-0.167-0.366-0.183-0.717-0.05-1.05c0.066-0.233,0.167-0.733,0.3-1.5c0.033-0.3,0.083-0.6,0.15-0.9  c0.267-1.767,0.534-3.133,0.8-4.1c0.8-3.2,2.066-5.133,3.8-5.8c0.033-0.667,0.05-1.184,0.05-1.55c0-0.7,0.083-1.517,0.25-2.45  c0.066-0.8,0.117-1.517,0.15-2.15c0-1,0.133-1.683,0.4-2.05c0.1-0.267,0.35-0.817,0.75-1.65c0.333-0.833,0.583-1.533,0.75-2.1  C42.45,20.6,42.55,19.6,42.55,18.5z M44.45,13.3c0.064,0.129,0.098,0.246,0.1,0.35c0.001-0.103,0.018-0.203,0.05-0.3  c0.367-2.267,1.317-3.317,2.85-3.15c1.434-0.233,3.316,3.117,5.649,10.05c0.601,1.867,1.267,4.033,2,6.5  c0.367,1.233,0.717,2.583,1.051,4.05c0.267,0.833,0.6,1.883,1,3.15c0.866,2.867,1.566,6.35,2.1,10.45c0.1,0.5,0.167,0.984,0.2,1.45  c0.533,4.567,0.916,7.267,1.149,8.101c0.233,0.633,1.067,1.467,2.5,2.5c1.7,1.233,3.717,2.283,6.051,3.149  c0.966,0.334,2.033,0.684,3.199,1.051H72.4c0.233,0.033,1.25,0.316,3.05,0.85c0.267,0.066,0.483,0.2,0.649,0.4  c0.2,0.233,0.334,0.466,0.4,0.699c0.033,0.267,0,0.534-0.1,0.801c-2.034,4.8-5.233,8.633-9.601,11.5c-0.233,0.199-0.5,0.3-0.8,0.3  c-0.267-0.033-0.517-0.134-0.75-0.3c-1.4-0.967-3.7-2.417-6.9-4.351c-3.1-1.8-5.366-3.233-6.8-4.3c-2.399-1.8-4.184-3.65-5.35-5.55  c-0.767-1.233-1.317-2.517-1.65-3.851c-0.367,1.334-0.933,2.601-1.7,3.801c-1.167,1.866-2.934,3.683-5.3,5.449  c-1.433,1.067-3.716,2.517-6.85,4.351c-0.7,0.399-1.35,0.767-1.95,1.1c-2.2,1.3-3.833,2.334-4.9,3.101  C23.583,74.783,23.3,74.85,23,74.85c-0.267,0-0.517-0.066-0.75-0.199c-4.367-2.9-7.567-6.784-9.6-11.65  c-0.066-0.267-0.1-0.517-0.1-0.75c0.067-0.3,0.184-0.533,0.35-0.7c0.2-0.2,0.434-0.35,0.7-0.45c1.833-0.466,2.867-0.733,3.1-0.8  c1.2-0.366,2.25-0.7,3.15-1c2.4-0.833,4.45-1.85,6.15-3.05c0.433-0.3,0.817-0.6,1.15-0.9c0.733-0.633,1.184-1.149,1.35-1.55  c0.2-0.866,0.567-3.566,1.1-8.1c0.066-0.5,0.133-0.983,0.2-1.45c0.5-4.133,1.2-7.617,2.1-10.45c0.4-1.267,0.75-2.316,1.05-3.15  c0.3-1.433,0.633-2.767,1-4c0.767-2.467,1.45-4.633,2.05-6.5c2.333-6.9,4.217-10.233,5.65-10  C43.183,10.017,44.117,11.067,44.45,13.3z M41.8,14.65c0-0.333-0.017-0.617-0.05-0.85c-0.067-0.433-0.117-0.716-0.15-0.85  c-0.133,0.167-0.583,1.3-1.35,3.4C40.85,15.517,41.367,14.95,41.8,14.65z M47.45,13c0,0.133-0.033,0.4-0.101,0.8  c-0.033,0.233-0.066,0.517-0.1,0.85c0.434,0.333,0.934,0.9,1.5,1.7C48.05,14.25,47.616,13.133,47.45,13z M46.55,17.65  c-0.033,0.233-0.05,0.517-0.05,0.85c0,1.1,0.1,2.117,0.3,3.05c0.2,0.6,0.45,1.284,0.75,2.05c0.4,0.867,0.667,1.417,0.8,1.65  c0.233,0.367,0.351,1.083,0.351,2.15c0,0.6,0.066,1.283,0.2,2.05c0.133,0.966,0.199,1.8,0.199,2.5c0,0.4,0.051,0.933,0.15,1.6  c1.7,0.7,2.95,2.633,3.75,5.8c0.233,1,0.483,2.35,0.75,4.05c0.033,0.367,0.083,0.684,0.15,0.95c0.1,0.8,0.199,1.3,0.3,1.5  c0.1,0.334,0.083,0.684-0.05,1.051c-0.167,0.366-0.434,0.616-0.801,0.75c-0.366,0.1-0.733,0.066-1.1-0.101  c-0.3-0.166-0.533-0.416-0.7-0.75c-0.1-0.3-0.233-0.967-0.399-2v-0.05c-0.067-0.267-0.117-0.583-0.15-0.95  c-0.233-1.6-0.467-2.85-0.7-3.75c-0.6-2.333-1.434-3.667-2.5-4c-0.033-0.033-0.066-0.066-0.1-0.1c-0.101,0-0.2,0-0.3,0  c-0.067,0-0.134,0.05-0.2,0.15c-0.167,0.367-0.25,0.85-0.25,1.45c0,0.567,0.05,1.05,0.149,1.45c0.034,0.233,0.117,0.583,0.25,1.05  c0.301,1.133,0.45,2.5,0.45,4.1c0,0.133,0,0.267,0,0.4c0,1.601-0.166,3.2-0.5,4.8c-0.2,0.867-0.316,1.434-0.35,1.7  c-0.101,0.601-0.15,1.2-0.15,1.8c0,2.334,0.584,4.434,1.75,6.301c1.033,1.666,2.584,3.267,4.65,4.8  c1.399,1.066,3.566,2.483,6.5,4.25c2.767,1.6,4.866,2.883,6.3,3.85c3.1-2.166,5.483-4.934,7.15-8.3c-0.9-0.267-1.4-0.417-1.5-0.45  H71.6c-1.267-0.366-2.399-0.717-3.399-1.05c-2.634-0.967-4.9-2.134-6.8-3.5c-2.167-1.6-3.351-2.967-3.551-4.1  c-0.233-0.9-0.616-3.7-1.149-8.4c-0.066-0.5-0.134-1-0.2-1.5c-0.5-3.933-1.184-7.267-2.05-10c-0.367-1.267-0.7-2.317-1-3.15  c0-0.033,0-0.067,0-0.1c-0.367-1.1-0.617-1.783-0.75-2.05c-0.267-0.534-0.767-1.567-1.5-3.1c-0.9-1.767-1.634-3.184-2.2-4.25  C47.8,19.867,46.983,18.383,46.55,17.65z"/></svg>';
var pictoOpti = '<svg height="60" fill="rgb(221,72,20)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 125" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M55.8,0.9c-15.6,0-29.6,9.8-34.9,24.5c0,0-0.5,1.6-0.5,1.6L8.8,61.7c-0.2,0.6-0.1,1.3,0.3,1.8c0.4,0.5,1,0.8,1.6,0.8h6.7  c0,1.6,0,3.9,0.5,6.4h11.2c0,0-1.3,5.2-8.1,8.4c0.5,0.8,1.1,1.5,1.7,2.3C26,85,30.6,87,36.3,87.4v9.3c0,1.1,0.9,2,2,2h38.2  c1.1,0,2-0.9,2-2V67.3c9.1-7.1,14.4-17.8,14.4-29.3C92.9,17.5,76.2,0.9,55.8,0.9z M63.5,47.6l-18.6,7.2l3.9-7.9c-4-2-7.3-5.4-9-9.8  c-3.7-9.4,1-20.1,10.4-23.7c9.4-3.7,20.1,1,23.7,10.4C77.6,33.3,73,43.9,63.5,47.6z"/><polygon points="64.1,27.7 59.1,27.7 59.1,22.8 54.6,22.8 54.6,27.7 49.6,27.7 49.6,32.3 54.6,32.3 54.6,37.2 59.1,37.2 59.1,32.3   64.1,32.3 "/></svg>';
var pictoEnth = '<svg height="60" fill="rgb(221,72,20)" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"><path d="m 18.55349,5.0001487 c -1.50502,0 -3.00926,0.57646 -4.16249,1.72968 -2.30645,2.30646 -2.30645,6.0213503 0,8.3278103 l 21.1584,21.15558 c 0.21036,0.21036 0.43211,0.40176 0.66375,0.57375 -1.8e-4,0.0206 0,0.0412 0,0.0619 l 0,19.63402 c 0,0.50872 0.0422,1.00676 0.12656,1.49062 -0.0819,0.39264 -0.12656,0.80015 -0.12656,1.21782 l 0,29.92213 c 0,3.26182 2.62755,5.88655 5.88936,5.88655 3.26182,0 5.88656,-2.62473 5.88656,-5.88655 l 0,-24.07496 4.02186,0 0,24.07496 c 0,3.26182 2.62474,5.88655 5.88656,5.88655 3.26181,0 5.88936,-2.62473 5.88936,-5.88655 l 0,-29.92213 c 0,-0.42074 -0.0463,-0.83095 -0.12937,-1.22625 0.0834,-0.48133 0.12937,-0.97629 0.12937,-1.48219 l 0,-19.63402 c 0,-0.0206 1.8e-4,-0.0413 0,-0.0619 0.23168,-0.17201 0.45335,-0.36335 0.66375,-0.57375 L 85.609,15.057639 c 2.30645,-2.30646 2.30645,-6.0213503 0,-8.3278103 -2.30646,-2.30645 -6.02135,-2.30645 -8.3278,0 L 56.1228,27.888239 c -0.1351,0.13509 -0.26041,0.27487 -0.37969,0.41906 -0.17026,-0.01 -0.34182,-0.0169 -0.51468,-0.0169 l -10.45686,0 c -0.17286,0 -0.34442,0.007 -0.51468,0.0169 -0.11928,-0.14419 -0.24741,-0.28397 -0.3825,-0.41906 L 22.7188,6.7298287 c -1.15323,-1.15322 -2.66028,-1.72968 -4.16531,-1.72968 z m 30.9487,0.31782 c -5.65053,0 -10.23186,4.58132 -10.23186,10.2318503 0,5.65053 4.58133,10.23186 10.23186,10.23186 5.65052,0 10.22904,-4.58133 10.22904,-10.23186 0,-5.6505303 -4.57852,-10.2318503 -10.22904,-10.2318503 z" style="color:#000000;enable-background:accumulate;" stroke="none" marker="none" visibility="visible" display="inline" overflow="visible"/></svg>';


/* ______________________ RADAR DES FORCES _________________________________*/

function radForces(curi, crea, inteS, ptiv, pers, honn, gent, amou, trvE, impa, lead, grat, opti, enth) {

    Chart.defaults.global.legend.display = false;
    var radarData = {
        labels: ["Curiosité", "Créativité", "Intelligence sociale", "Perspective", "Persévérance", "Honnêteté / Intégrité", "Gentillesse et génrosité", "Capacité d'aimer et d'être aimé•e", "Travail d'équipe / Fidélité", "Impartialité / Équité", "Leadership", "Gratitude", "Optimisme / Anticipation", "Enthousiasme / Vigueur"],
        datasets: [
            {
                label: [],
                backgroundColor: "rgba(255,120,72, 0.5)",
                borderColor: "#DD4814",
                pointBackgroundColor: "#DD4814",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#DD4814",
                pointHoverBorderColor: "rgba(179,181,198,1)",
                data: [curi, crea, inteS, ptiv, pers, honn, gent, amou, trvE, impa, lead, grat, opti, enth]
            },
        ],
    };

    //initialisation de la légende
    var notations = {
        0: "",
        1: "",
        2: "",
        3: "",
        4: "",
        5: "",
        6: "",
        7: "",
        8: "",
        9: "",
        10: "",
        11: "",
        12: "",
        13: "",
        14: "",
        15: "",
        16: "",
        17: "",
        18: "",
        19: "",
        20: "",
        21: "",
        22: "",
        23: "",
        24: "",
        25: "",
        26: "",
    }

    //Tracé du schéma
    var schemaF = document.getElementById("radarForces").getContext("2d");
    var radarF = new Chart(schemaF, {
        type: "radar",
        data: radarData,
        options: {
            responsive: false,
            pointDot: false,
            scaleShowLabels: false,
            scaleOverride: true,
            scaleSteps: 10,
            scaleStepWidth: 2,
            scaleStartValue: 0,
            animation: false,
            scale: {
                pointLabels: {
                    fontSize: 8,
                },
                ticks: {
                    beginAtZero: false,
                    min: 1,
                    max: 21,
                    fixedStepSize: 2,
                    stepSize: 11,
                    userCallback: function (value, index, values) {
                        return notations[value];

                    }

                }

            }

        }
    });
}

/* ______________________ TEXTES DES FORCES _________________________________*/


//création des objets de type force
function Force(nomforce, scoreforce, pictoforce) {
    this.nom = nomforce;
    this.score = scoreforce;
    this.picto = pictoforce;
}
//regroupement de l'ensemble des éléments de forces en une fonction pour passer les scores des forces
function texteForces(curilime, crealime, intSlime, ptivlime, perslime, honnlime, gentlime, amoulime, trvElime, impalime, leadlime, gratlime, optilime, enthlime) {


//creation des objets force pour les 14 forces évaluées
    var Curiosite = new Force("Curiosité", parseInt(curilime), pictoCuri);
    var Creativite = new Force("Créativité", parseInt(crealime), pictoCrea);
    var IntellS = new Force("Intelligence sociale", parseInt(intSlime), pictoIntS);
    var Perspective = new Force("Perspective", parseInt(ptivlime), pictoPtiv);
    var Perseverance = new Force("Persévérance", parseInt(perslime), pictoPers);
    var Honnetete = new Force("Honnêteté", parseInt(honnlime), pictoHonn);
    var Gentillesse = new Force("Gentillesse", parseInt(gentlime), pictoGent);
    var Amour = new Force("Amour", parseInt(amoulime), pictoAmou);
    var TravEquip = new Force("Travail d'équipe", parseInt(trvElime), pictoTrvE);
    var Impartialite = new Force("Impartialité", parseInt(impalime), pictoImpa);
    var Leadership = new Force("Leadership", parseInt(leadlime), pictoLead);
    var Gratitude = new Force("Gratitude", parseInt(gratlime), pictoGrat);
    var Optimisme = new Force("Optimisme", parseInt(optilime), pictoOpti);
    var Enthousiasme = new Force("Enthousiasme", parseInt(enthlime), pictoEnth);

//creation des textes pour les 14 forces
    var curiTxt = "Vous vous intéressez à tout. Vous vous ennuyez rarement et êtes capable de focaliser votre attention. Vous faites preuve de grandes qualités d’écoute et de conversation, vous apportez des perspectives nouvelles. Vous aimez apprendre et résoudre des problèmes et prenez plaisir à découvrir de nouvelles choses.";
    var creaTxt = "Vous avez des idées et des comportements nouveaux et inhabituels qui apportent une contribution positive à votre vie ou à celle des autres. Vous ne vous contentez jamais de faire les choses de manière conventionnelle si une meilleure option est possible.";
    var intSTxt = "Vous êtes conscient•e de vos sentiments, de vos motivations et de ceux des autres. Vous êtes capable de bien cerner les gens et savez les mettre à l'aise. Vous savez vous adapter à différents contextes sociaux et créez des liens et des contacts facilement.";
    var ptivTxt = "Vous arrivez facilement à comprendre le point de vue des autres et vous savez voir au-delà des faits. Les autres se tournent régulièrement vers vous quand ils ont besoin de conseils. Vous êtes capable d’expliquer le « pourquoi » des choses d’une manière qui fait sens pour vous et les autres.";
    var persTxt = "Vous allez au bout des choses malgré les obstacles. Vous êtes résilient•e, plein•e d’espoir et travailleur•euse. Vous prenez plaisir à &quot;abattre du travail&quot; et ne vous laissez pas distraire.";
    var honnTxt = "Vous êtes honnête et vous attendez la même chose de la part des autres. Vous vivez votre vie de manière sincère et authentique et vous savez garder les pieds sur terre. Vous assumez vos sentiments et vos comportements. Vos objectifs représentent avec justesse vos valeurs et vos intérêts implicites.";
    var gentTxt = "Vous aimez faire des choses pour les autres et vous sentir utile. Vous êtes généreux•se et faites preuve de compassion. Votre compagnie est particulièrement appréciée et vous êtes un véritable soutien pour les autres. Vous faites preuve d'altruisme et d'empathie et êtes toujours prêt•e à rendre service.";
    var amouTxt = "Vous accordez de l'importance aux relations proches et intimes avec les autres, d'autant plus lorsqu'elles sont réciproques en termes de partage et d’attentions. Vous êtes à l’aise lorsqu’il s’agit exprimer l’affection avec des mots, des attentions ou des gestes.";
    var trvETxt = "Il est essentiel pour vous de faire « votre part » et d’apporter votre contribution. Vous avez un vrai sens des responsabilités sociales et vous êtes un membre fiable des équipes, groupes ou communautés auxquels vous appartenez. Vous êtes un•e camarade fidèle et dédié•e.";
    var impaTxt = "Vous avez un véritable sens de la justice et un fort attachement à cette dernière. Vous cherchez à traiter tout le monde de manière équitable. Vous ne laissez pas vos sentiments personnels aboutir à des décisions biaisées et donnez à chacun sa chance. Vous savez vous mettre dans la peau des autres pour comprendre leur raisonnement.";
    var leadTxt = "Vous encouragez les autres à accomplir des choses et vous maintenez de bonnes relations avec ceux que vous guidez. Vous êtes une source d'inspiration et avez de l’influence. Vous savez organiser des groupes pour les mener à des objectifs tout en maintenant l'harmonie en leur sein.";
    var gratTxt = "Vous êtes conscient•e des bonnes choses qui vous arrivent et de votre « chance ». Vous prenez toujours le temps de remercier les autres et ne considérez jamais rien comme vous étant dû. Vous appréciez les feedbacks des autres, et appréciez quand il leur arrive des choses positives.";
    var optiTxt = "Vous êtes optimiste au sujet des possibilités offertes par la vie. Pour vous, le positif est toujours possible et le négatif n'est que transitoire et temporaire. Vous êtes enthousiaste au sujet de l’avenir et travaillez à faire du lendemain un endroit meilleur. Vous aimez faire des plans, établir des objectifs et pensez être en mesure d'avoir un impact sur les événements.";
    var enthTxt = "Vous prenez la vie avec enthousiasme et refusez de faire les choses à moitié. Vous considérez la plupart du temps la vie comme une aventure et vous cherchez à vous sentir &quot;vivant•e&quot;. Vous êtes engagé•e et impliqué•e dans ce que vous faites et ne faites pas les choses à moitié.";


//creation du tableau de résultats pour les forces
    forcesScores = [Curiosite, Creativite, IntellS, Perspective, Perseverance, Honnetete, Gentillesse, Amour, TravEquip, Impartialite, Leadership, Gratitude, Optimisme, Enthousiasme];

//réorganisation tu tableau de la force la plus élevée à celle la moins élevée
    forcesScores.sort(function (a, b) {
        return b.score - a.score
    });


//affichage du nom des forces principales
    document.write('<h3>Vos 4 forces principales</h3><div class="bloc920">');
    document.write('<table id="4forces"><tr>');
    for (i = 0; i < 4; i++) {
        document.write('<td>' + forcesScores[i].picto + '</td><td width="157px">' + forcesScores[i].nom + '</td>');
    }
    document.write("<tr/></table></div>");

//affichage du profil en fonction des forces principales
    document.write('<h3>Votre profil</h3><table id="tabforces" style="width:920px; margin-left:auto; margin-right:auto;">');
    for (i = 0; i < 4; i++) {
        switch (forcesScores[i].nom) {
            case "Curiosité" :
                document.write('<tr><td width="80px">' + pictoCuri + '</td><td>' + curiTxt + "</td></tr>");
                break;
            case "Créativité" :
                document.write('<tr><td width="80px">' + pictoCrea + '</td><td>' + creaTxt + "</td></tr>");
                break;
            case "Intelligence sociale" :
                document.write('<tr><td width="80px">' + pictoIntS + '</td><td>' + intSTxt + "</td></tr>");
                break;
            case "Perspective" :
                document.write('<tr><td width="80px">' + pictoPtiv + '</td><td>' + ptivTxt + "</td></tr>");
                break;
            case "Persévérance" :
                document.write('<tr><td width="80px">' + pictoPers + '</td><td>' + persTxt + "</td></tr>");
                break;
            case "Honnêteté" :
                document.write('<tr><td width="80px">' + pictoHonn + '</td><td>' + honnTxt + "</td></tr>");
                break;
            case "Gentillesse" :
                document.write('<tr><td width="80px">' + pictoGent + '</td><td>' + gentTxt + "</td></tr>");
                break;
            case "Amour" :
                document.write('<tr><td width="80px">' + pictoAmou + '</td><td>' + amouTxt + "</td></tr>");
                break;
            case "Travail d'équipe" :
                document.write('<tr><td width="80px">' + pictoTrvE + '</td><td>' + trvETxt + "</td></tr>");
                break;
            case "Impartialité" :
                document.write('<tr><td width="80px">' + pictoImpa + '</td><td>' + impaTxt + "</td></tr>");
                break;
            case "Leadership" :
                document.write('<tr><td width="80px">' + pictoLead + '</td><td>' + leadTxt + "</td></tr>");
                break;
            case "Gratitude" :
                document.write('<tr><td width="80px">' + pictoGrat + '</td><td>' + gratTxt + "</td></tr>");
                break;
            case "Optimisme" :
                document.write('<tr><td width="80px">' + pictoOpti + '</td><td>' + optiTxt + "</td></tr>");
                break;
            case "Enthousiasme" :
                document.write('<tr><td width="80px">' + pictoEnth + '</td><td>' + enthTxt + "</td></tr>");
                break;
            default:
                document.write("Nous avons rencontré un problème.");
        }
    }
    document.write('</table><br /></div>');
}

/* ______________________ FORCES & VISIONS _________________________________*/

//------------------------------------------------------------------------------
//Creation des textes pour les 14 forces en fonction des visions d'enseignement
//------------------------------------------------------------------------------
//-----------------TRANSMISSION------------------------//
var curiT = "Votre curiosité peut vous aider à enrichir sans cesse vos cours pour qu'ils restent actuels et intéressants.";
var creaT = "Votre créativité est une ressource précieuse pour présenter le contenu de vos cours de manière originale et captivante.";
var intST = "En vous appuyant sur cet atout, vous pouvez facilement adapter vos cours à différentes classes.";
var ptivT = "Votre capacité de mise en perspective peut vous aider à expliquer et à transmettre plus facilement ce que vous enseignez.";
var persT = "Que ce soit pour préparer vos cours ou pour corriger des examens, votre persévérance peut vous aider à dépasser le périodes de travail chargées.";
var honnT = "Votre honnêteté peut vous aider à facilement accepter ce que vous savez et ce que vous ne savez pas. De même, cela peut vous aider à rendre vos attentes en termes d'évaluation transparentes.";
var gentT = "Votre gentillesse est un atout qui peut vous aider à faire le maximum pour aider vos élèves lors de vos cours, en leur préparant par exemple des documents supplémentaires.";
var amouT = "Cette force peut vous aider à faire attention aux réactions des élèves pendant vos cours.";
var trvET = "Votre esprit d'équipe peut constituer un atout pour intégrer vos cours dans le cursus des élèves, en échangeant avec vos collègues par exemple.";
var impaT = "Votre soucis de l'équité peut vous aider à adapter le contenu de vos cours au niveau et aux difficultés de chacun de vos élèves.";
var leadT = "Votre côté leader•euse est un atout non négligeable pour garder vos élèves mobilisés dans vos cours.";
var gratT = "L'expression de votre reconnaissance devant les efforts de vos élèves peut constituer un levier intéressant pour faciliter la transmission des connaissances.";
var optiT = "Votre anticipation des difficultés et votre positivité sont un véritable atout pour améliorer vos cours en permanence et ne pas vous laisser décourager par des contre-temps.";
var enthT = "Votre enthousiasme peut vous aider à rendre vos cours captivants et toujours intéresssants, que ce soit pour vous ou pour vos élèves.";
//--------------------APPRENTI-------------------------//
var curiA = "Vous pouvez vous appuyer sur votre curiosité pour rechercher activement les meilleures manières de montrer et d'expliquer les choses aux élèves.";
var creaA = "Votre créativité peut vous aider à inventer des exercices concrets permettant aux élèves de gagner rapidement en autonomie.";
var intSA = "Votre capacité à cerner vos élèves est un atout qui peut vous aider à les faire progresser dans les différentes tâches que vous leur proposez.";
var ptivA = "Cette force peut vous aider à expliquer aux élèves pourquoi il est plus intéressant de faire les choses d'une certaine manière.";
var persA = "Votre persévérance peut vous aider à poursuivre vos efforts pour aider les élèves à aller vers plus d'autonomie, même si vous devez vous y reprendre à plusieurs fois.";
var honnA = "Votre honnêteté peut vous aider à reconnaître que certaines manières de faire chez vos élèves ne sont pas forcément mauvaises mais simplement différentes.";
var gentA = "L'aide que vous apportez aux élèves et le temps passé à reprendre les choses avec eux peut leur permettre de progresser et de se responsabiliser à leur rythme.";
var amouA = "Votre capacité à créer des liens avec vos élèves peut les aider à prendre confiance et à progresser vers une meilleure maîtrise et une plus grande autonomie.";
var trvEA = "Votre sens des responsabilités et l'envie d'apporter votre contribution peut vous aider à  travailler à l'autonomisation des élèves avec vos collègues.";
var impaA = "En vous appuyant sur cette force, vous pouvez aider chaque élève à progresser vers l'autonomie.";
var leadA = "Votre exemple peut être une source d'inspiration pour les élèves et les aider à accomplir les tâches que vous leur proposez.";
var gratA = "En exprimant votre reconnaissance vis-à-vis des efforts des élèves, vous pouvez les encourager à progresser vers une plus grande autonomie.";
var optiA = "Votre optimisme et votre planification peuvent vous aider à montrer les choses de manière optimale à vos élèves pour les rendre autonomes.";
var enthA = "Votre enthousiasme peut être un réel soutien aux élèves pour soutenir leur réussite et favoriser leur autonomie progressive.";
//------------------DEVELOPPEMENT----------------------//
var curiD = "Votre curiosité peut vous aider à comprendre vos élèves et à poser les bonnes questions pour les faire progresser à leur rythme.";
var creaD = "Votre créativité peut vous aider à adapter votre enseignement au niveau de chaque élève très rapidement.";
var intSD = "En mettant les élèves à l'aise et en comprenants leurs motivations et leurs sentiments vous êtes en mesure de mieux les faire avancer.";
var ptivD = "Votre point de vue et votre analyse peuvent vous aider à comprendre comment fonctionnent vos élèves et vous permettre de leur donner des conseils pertinents pour mieux se comprendre.";
var persD = "Vous pouvez vous appuyer sur votre persévérance pour aider les élèves à se poser les bonnes questions pour progresser, même si c'est parfois difficile.";
var honnD = "Votre honnêteté peut vous aider à établir le contact avec vos élèves face à leurs difficultés.";
var gentD = "Votre empathie et votre altruisme sont des atouts pour comprendre les difficultés de vos élèves et les faire progresser.";
var amouD = "Votre attention envers vos élèves peut constituer un réel soutien à leur développement.";
var trvED = "En travaillant en équipe avec vos collègues intelligemment, vous pouvez aider vos élèves à faire des progrès et construire des parcours individualisés.";
var impaD = "Votre sens de la justice vous incite à vous mettre dans la peau de vos élèves pour comprendre leur raisonnement et aider de manière équitable chacun•e d'entre eux•elles.";
var leadD = "Vous pouvez grâce à votre sens du leadership inspirer et mieux guider vos élèves vers des connaissances et des raisonnement plus complexes.";
var gratD = "En reconnaissant les efforts de vos élèves, vous pouvez valoriser leurs progrès et les aider à avancer.";
var optiD = "Votre optimisme peut vous aider à faire prendre conscience aux élèves que l'erreur fait partie de l'apprentissage.";
var enthD = "Votre enthousiasme peut être communicatif et encourager les élèves à progresser en se posant les bonnes questions sans avoir peur du jugement ou de l'échec.";
//---------------------SOUTIEN-------------------------//
var curiS = "Votre curiosité peut vous aider à comprendre vos élèves et leur histoire personnelle pour mieux les aider.";
var creaS = "Vos idées créatives peuvent vous aider à trouver des façons de rendre le climat de classe positif et de dynamiser vos élèves.";
var intSS = "Vous pouvez vous appuyer sur votre compréhension des autres pour &quot;parler&quot; facilement à chacun de vos élèves et cerner leurs motivations.";
var ptivS = "En mettant les choses en perspective, vous êtes en mesure de mieux comprendre la situation de chaque élève.";
var persS = "Même si les choses sont difficiles, vous pouvez vous aider de votre persévérance pour tenter sans relâche d'améliorer les choses dans votre classe.";
var honnS = "Vous êtes sincère et cela peut vous aider à instaurer un climat de confiance propice aux apprentissages.";
var gentS = "En étant à l'écoute de vos élèves, vous pouvez les aider à apprendre dans de meilleures conditions.";
var amouS = "Le fait d'établir des relations individuelles fortes avec chacun de vos élèves peut être un véritable soutien à leurs progrès.";
var trvES = "Vous pouvez vous appuyer sur votre sens de la loyauté pour apporter votre contribution à la vie de vos élèves, malgré les obstacles. Vous ne perdez pas de vue votre objectif de faire réussir toute votre classe.";
var impaS = "En traitant tous les élèves de manière équitable, vous pouvez créer un climat de classe positif où les élèves sauront qu'il n'y aura pas de discriminations.";
var leads = "Vous pouvez vous appuyer sur votre sens du leadership pour inspirer vos élèves et instaurer ainsi un climat de classe favorable à l'apprentissage.";
var gratS = "Le fait de remercier les élèves pour leurs efforts et leur travail peut leur offrir une reconnaissance qui soutient leurs efforts.";
var optiS = "Votre vision positive des choses peut vous aider à toujours chercher le meilleur dans vos élèves.";
var enthS = "Votre enthousiasme peut vous aider à créer une dynamique émotionnelle positive qui soutient l'apprentissage.";
//-----------------REFORME SOCIALE---------------------//
var curiR = "En vous interrogeant sur ce qui est pris pour acquis, vous pouvez aider vos élèves à développer leur esprit critique.";
var creaR = "Votre créativité peut vous aider à reconsidérer les choses et à remettre en question la manière &quot;classique&quot; de faire.";
var intSR = "En mettant vos élèves à l'aise et en vous adaptant à la situation, vous pouvez trouver les meilleurs leviers pour mobiliser les élèves et les pousser à se poser des questions, à réfléchir.";
var ptivR = "Votre faculté à expliquer le &quot;pourquoi&quot; de choses peut aider vos élèves à aller plus loin.";
var persR = "Vous pouvez vous appuyer sur votre persévérance pour poursuivre vos efforts, même quand votre vision est à contre-courant, et ce au bénéfice de vos élèves.";
var honnR = "La connaissance de vos propres biais et partis pris peut vous aider à être plus juste et plus efficace dans votre classe. Les élèves peuvent ainsi vous faire plus facilement confiance et vous suivre lorsque vous sollicitez leur esprit critique et les poussez à remettre les choses en question.";
var gentR = "Pour vous, il est de votre responsabilité de faire preuve d'empathie envers vos élèves et de les soutenir. Cet altruisme peut vous aider à les mettre plus facilement au défi dans un climat bienveillant.";
var amouR = "Vos relations proches avec les élèves peuvent constituer un atout pour les pousser plus loin dans leurs raisonnements et leurs efforts de réflexion.";
var trvER = "Votre sens des responsabilités en tant qu'enseignant•e peut vous aider à faire votre part pour aider vos élèves à progresser. Votre capacité à être un membre actif d'une équipe pédagogique peut constituer un levier d'action supplémentaire pour transformer l'enseignement et la société.";
var impaR = "Votre sens de la justice peut être un vecteur de mobilisation des élèves, en créant un climat où ceux-ci savent que tout le monde est traité de manière équitable. Ceci peut les inciter à faire de même et à transformer positivement la société.";
var leadR = "Vous pouvez vous appuyer sur votre sens du leadership pour pousser vos élèves à se dépasser et à se poser les bonnes questions pour progresser et transformer leur rapport au monde.";
var gratR = "Exprimer votre appréciation des comportements positifs et des progrès des élèves peut leur permettre de s'exprimer ou de faire des erreurs sans avoir peur de se mettre en danger (par rapport à leurs pairs ou à leurs enseignants).";
var optiR = "Votre optimisme peut vous aider à rester mobilisé•e en pensant que vos efforts avec vos élèves aujourd'hui vont vous permettre de changer la société de demain.";
var enthR = "Votre enthousiasme peut renforcer votre crédibilité et peut permettre aux élèves de vous suivre dans ce que vous leur proposez.";

//fonction d'affichage des textes
function texteVisionsForces(transDSR, transScore, appreDSR, appreScore, develDSR, develScore, soutiDSR, soutiScore, reforDSR, reforScore) {
//-----------------------TABLEAU DES VISIONS--------------------------//
//création des objets de type vision
    function Vision(nomVision, dsrVision, scoreVision) {
        this.nom = nomVision;
        this.dsr = parseInt(dsrVision);
        this.score = parseInt(scoreVision);
    }

//création des objets vision pour les 5 visions d'enseignement
    var Transmission = new Vision("de transmission", transDSR, transScore);
    var Apprenti = new Vision("du maître et de l&#39;apprenti", appreDSR, appreScore);
    var Developpement = new Vision("de développement", develDSR, develScore);
    var Soutien = new Vision("de soutien émotionnel", soutiDSR, soutiScore);
    var Reforme = new Vision("de changement social", reforDSR, reforScore);

    var visionsScores = [Transmission, Apprenti, Developpement, Soutien, Reforme];

//initialisation de la variable stockant le nom de la vision dominante
    var visionDomi = "";

//initialisation de la variable s'assurant qu'une vision dominante existe
    var visionDomiOK = false;

//Recherche de la vision dominante
    for (i = 0; i < 5; i++) {
        var nVisDomi;
        if (visionDomiOK == false) {
            if (visionsScores[i].dsr == 2) {
                visionDomi = visionsScores[i].nom;
                visionDomiOK = true;
                nVisDomi = i;
            }
        }
        if (visionDomiOK == true) {
            if (visionsScores[i].score > visionsScores[nVisDomi].score) {
                visionDomi = visionsScores[i].nom;
                visionDomiOK = true;
                nVisDomi = i;
            }
        }
    }

//s'il n'y a pas de vision dominante, recherche de la vision au score le plus élevé
    if (visionDomiOK == false) {
        visionsScores.sort(function (a, b) {
            return b.score - a.score
        });
        visionDomi = visionsScores[0].nom;
    }


//affichage du profil en fonction des forces principales et de la vision
    document.write('Utiliser vos forces dans une vision ' + visionDomi + ' de l&#39;enseignement :<br /><div class="bloc920">');
    if (visionDomi == "de transmission") {
        for (i = 0; i < 4; i++) {
            switch (forcesScores[i].nom) {
                case "Curiosité" :
                    document.write("<b>Curiosité : </b>" + curiT + "<br />");
                    break;
                case "Créativité" :
                    document.write("<b>Créativité : </b>" + creaT + "<br />");
                    break;
                case "Intelligence sociale" :
                    document.write("<b>Intelligence sociale : </b>" + intST + "<br />");
                    break;
                case "Perspective" :
                    document.write("<b>Perspective : </b>" + ptivT + "<br />");
                    break;
                case "Persévérance" :
                    document.write("<b>Persévérance : </b>" + persT + "<br />");
                    break;
                case "Honnêteté" :
                    document.write("<b>Honnêteté / Intégrité : </b>" + honnT + "<br />");
                    break;
                case "Gentillesse" :
                    document.write("<b>Gentillesse et générosité : </b>" + gentT + "<br />");
                    break;
                case "Amour" :
                    document.write("<b>Capacité d'aimer et d'être aimé•e : </b>" + amouT + "<br />");
                    break;
                case "Travail d'équipe" :
                    document.write("<b>Travail d'équipe / Fidélité : </b>" + trvET + "<br />");
                    break;
                case "Impartialité" :
                    document.write("<b>Impartialité / Équité : </b>" + impaT + "<br />");
                    break;
                case "Leadership" :
                    document.write("<b>Leadership : </b>" + leadT + "<br />");
                    break;
                case "Gratitude" :
                    document.write("<b>Gratitude : </b>" + gratT + "<br />");
                    break;
                case "Optimisme" :
                    document.write("<b>Optimisme / Anticipation : </b>" + optiT + "<br />");
                    break;
                case "Enthousiasme" :
                    document.write("<b>Enthousiasme / Vigueur : </b>" + enthT + "<br />");
                    break;
                default:
                    document.write("Nous avons rencontré un problème.");
            }
        }
    }
    if (visionDomi == "du maître et de l&#39;apprenti") {
        for (i = 0; i < 4; i++) {
            switch (forcesScores[i].nom) {
                case "Curiosité" :
                    document.write("<b>Curiosité : </b>" + curiA + "<br />");
                    break;
                case "Créativité" :
                    document.write("<b>Créativité : </b>" + creaA + "<br />");
                    break;
                case "Intelligence sociale" :
                    document.write("<b>Intelligence sociale : </b>" + intSA + "<br />");
                    break;
                case "Perspective" :
                    document.write("<b>Perspective : </b>" + ptivA + "<br />");
                    break;
                case "Persévérance" :
                    document.write("<b>Persévérance : </b>" + persA + "<br />");
                    break;
                case "Honnêteté" :
                    document.write("<b>Honnêteté / Intégrité : </b>" + honnA + "<br />");
                    break;
                case "Gentillesse" :
                    document.write("<b>Gentillesse et générosité : </b>" + gentA + "<br />");
                    break;
                case "Amour" :
                    document.write("<b>Capacité d'aimer et d'être aimé•e : </b>" + amouA + "<br />");
                    break;
                case "Travail d'équipe" :
                    document.write("<b>Travail d'équipe / Fidélité : </b>" + trvEA + "<br />");
                    break;
                case "Impartialité" :
                    document.write("<b>Impartialité / Équité : </b>" + impaA + "<br />");
                    break;
                case "Leadership" :
                    document.write("<b>Leadership : </b>" + leadA + "<br />");
                    break;
                case "Gratitude" :
                    document.write("<b>Gratitude : </b>" + gratA + "<br />");
                    break;
                case "Optimisme" :
                    document.write("<b>Optimisme / Anticipation : </b>" + optiA + "<br />");
                    break;
                case "Enthousiasme" :
                    document.write("<b>Enthousiasme / Vigueur : </b>" + enthA + "<br />");
                    break;
                default:
                    document.write("Nous avons rencontré un problème.");
            }
        }
    }
    if (visionDomi == "de développement") {
        for (i = 0; i < 4; i++) {
            switch (forcesScores[i].nom) {
                case "Curiosité" :
                    document.write("<b>Curiosité : </b>" + curiD + "<br />");
                    break;
                case "Créativité" :
                    document.write("<b>Créativité : </b>" + creaD + "<br />");
                    break;
                case "Intelligence sociale" :
                    document.write("<b>Intelligence sociale : </b>" + intSD + "<br />");
                    break;
                case "Perspective" :
                    document.write("<b>Perspective : </b>" + ptivD + "<br />");
                    break;
                case "Persévérance" :
                    document.write("<b>Persévérance : </b>" + persD + "<br />");
                    break;
                case "Honnêteté" :
                    document.write("<b>Honnêteté / Intégrité : </b>" + honnD + "<br />");
                    break;
                case "Gentillesse" :
                    document.write("<b>Gentillesse et générosité : </b>" + gentD + "<br />");
                    break;
                case "Amour" :
                    document.write("<b>Capacité d'aimer et d'être aimé•e : </b>" + amouD + "<br />");
                    break;
                case "Travail d'équipe" :
                    document.write("<b>Travail d'équipe / Fidélité : </b>" + trvED + "<br />");
                    break;
                case "Impartialité" :
                    document.write("<b>Impartialité / Équité : </b>" + impaD + "<br />");
                    break;
                case "Leadership" :
                    document.write("<b>Leadership : </b>" + leadD + "<br />");
                    break;
                case "Gratitude" :
                    document.write("<b>Gratitude : </b>" + gratD + "<br />");
                    break;
                case "Optimisme" :
                    document.write("<b>Optimisme / Anticipation : </b>" + optiD + "<br />");
                    break;
                case "Enthousiasme" :
                    document.write("<b>Enthousiasme / Vigueur : </b>" + enthD + "<br />");
                    break;
                default:
                    document.write("Nous avons rencontré un problème.");
            }
        }
    }
    if (visionDomi == "de soutien émotionnel") {
        for (i = 0; i < 4; i++) {
            switch (forcesScores[i].nom) {
                case "Curiosité" :
                    document.write("<b>Curiosité : </b>" + curiS + "<br />");
                    break;
                case "Créativité" :
                    document.write("<b>Créativité : </b>" + creaS + "<br />");
                    break;
                case "Intelligence sociale" :
                    document.write("<b>Intelligence sociale : </b>" + intSS + "<br />");
                    break;
                case "Perspective" :
                    document.write("<b>Perspective : </b>" + ptivS + "<br />");
                    break;
                case "Persévérance" :
                    document.write("<b>Persévérance : </b>" + persS + "<br />");
                    break;
                case "Honnêteté" :
                    document.write("<b>Honnêteté / Intégrité : </b>" + honnS + "<br />");
                    break;
                case "Gentillesse" :
                    document.write("<b>Gentillesse et générosité : </b>" + gentS + "<br />");
                    break;
                case "Amour" :
                    document.write("<b>Capacité d'aimer et d'être aimé•e : </b>" + amouS + "<br />");
                    break;
                case "Travail d'équipe" :
                    document.write("<b>Travail d'équipe / Fidélité : </b>" + trvES + "<br />");
                    break;
                case "Impartialité" :
                    document.write("<b>Impartialité / Équité : </b>" + impaS + "<br />");
                    break;
                case "Leadership" :
                    document.write("<b>Leadership : </b>" + leadS + "<br />");
                    break;
                case "Gratitude" :
                    document.write("<b>Gratitude : </b>" + gratS + "<br />");
                    break;
                case "Optimisme" :
                    document.write("<b>Optimisme / Anticipation : </b>" + optiS + "<br />");
                    break;
                case "Enthousiasme" :
                    document.write("<b>Enthousiasme / Vigueur : </b>" + enthS + "<br />");
                    break;
                default:
                    document.write("Nous avons rencontré un problème.");
            }
        }
    }
    if (visionDomi == "de changement social") {
        for (i = 0; i < 4; i++) {
            switch (forcesScores[i].nom) {
                case "Curiosité" :
                    document.write("<b>Curiosité : </b>" + curiR + "<br />");
                    break;
                case "Créativité" :
                    document.write("<b>Créativité : </b>" + creaR + "<br />");
                    break;
                case "Intelligence sociale" :
                    document.write("<b>Intelligence sociale : </b>" + intSR + "<br />");
                    break;
                case "Perspective" :
                    document.write("<b>Perspective : </b>" + ptivR + "<br />");
                    break;
                case "Persévérance" :
                    document.write("<b>Persévérance : </b>" + persR + "<br />");
                    break;
                case "Honnêteté" :
                    document.write("<b>Honnêteté / Intégrité : </b>" + honnR + "<br />");
                    break;
                case "Gentillesse" :
                    document.write("<b>Gentillesse et générosité : </b>" + gentR + "<br />");
                    break;
                case "Amour" :
                    document.write("<b>Capacité d'aimer et d'être aimé•e : </b>" + amouR + "<br />");
                    break;
                case "Travail d'équipe" :
                    document.write("<b>Travail d'équipe / Fidélité : </b>" + trvER + "<br />");
                    break;
                case "Impartialité" :
                    document.write("<b>Impartialité / Équité : </b>" + impaR + "<br />");
                    break;
                case "Leadership" :
                    document.write("<b>Leadership : </b>" + leadR + "<br />");
                    break;
                case "Gratitude" :
                    document.write("<b>Gratitude : </b>" + gratR + "<br />");
                    break;
                case "Optimisme" :
                    document.write("<b>Optimisme / Anticipation : </b>" + optiR + "<br />");
                    break;
                case "Enthousiasme" :
                    document.write("<b>Enthousiasme / Vigueur : </b>" + enthR + "<br />");
                    break;
                default:
                    document.write("Nous avons rencontré un problème.");
            }
        }
    }
    document.write("</div>")
}