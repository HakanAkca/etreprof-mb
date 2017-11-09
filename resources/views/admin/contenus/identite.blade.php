@extends('admin.layout')


@section('content')
	

	@include('admin.contenus.form-nav', ['etape' => 'identite'])

	<h1>Identité / <strong>{{ $contenu->titre }}</strong></h1>

	<div id="vue">

	<div class="jumbotron">
	@include('admin.contenus.preview', ['contenu' => $contenu])
	</div>

		{!! Form::model($contenu, ['class' => 'form-horizontal']) !!}
		{!! csrf_field() !!}

			<fieldset>
				<legend>Identité</legend>

				@include('form.element', [ 'element' => [
					'Titre du contenu',
					Form::text('titre', null, [
					'class' => 'form-control',
					'placeholder' => ""
					]),
					'De quoi parle ce contenu? Proposez un titre accrocheur et descriptif'
				]])

				@include('form.element', [ 'element' => [
					'Nom de l\'auteur',
					Form::text('auteur', null, [
					'class' => 'form-control',
					'placeholder' => ""
					])
				]])

				@include('form.element', [ 'element' => [
					'Site Web de l\'auteur (blog, profil Youtube...)',
					Form::text('source_url', null, [
					'class' => 'form-control',
					'placeholder' => ""
					])
				]])


				@include('form.element', [ 'element' => [
					'Durée de consultation',
					'<div class="row"><div class="col-sm-4"><div class="input-group">' . Form::text('duree_minutes', null, [
					'class' => 'form-control',
					'placeholder' => ""
					]) . '<div class="input-group-addon">mn</div></div></div></div>'
				]])


				@include('form.element', [ 'element' => [
					'Description du contenu',
					Form::textarea('description', null, [
					'class' => 'form-control',
					'id' => 'description_textarea',
					'placeholder' => ""
					]),
					"Présenter le contenu, son intérêt, ses points forts et ses points faibles. Vous pouvez ajouter une note personnelle en expliquant comment vous l’utilisez en classe, ce qu’il vous apporte et si vous avez des adaptations ou précautions à conseiller quant à sa mise en oeuvre."
				]])

				<fieldset v-for="categorie in categories">

					<legend>@{{ categorie.name }}</legend>

					<div class="categorie" >


							<div class="cols3">
								<div v-for="terme in categorie.terms">
									<label><input type="checkbox" :name="'vocabulary[' + terme.vocabulary_id + '][]'" @change="applyToChildren(terme)" v-model="checked" :value="terme.id"> @{{ terme.name }}</label>


									<div v-for="sub in terme.terms" style="padding-left:30px">
										<label><input type="checkbox" :name="'vocabulary[' + terme.vocabulary_id + '][]'" v-model="checked" :value="sub.id"> @{{ sub.name }}</label>

									</div>
								</div>
							</div>




					</div>



				</fieldset>

				<div class="well">

					<div>
						@include('form.element', [ 'element' => [
							'Mots-clés',
							Form::text('tags', null, [

							'av-model' => 'lien.tags',
								'class' => 'form-control',
								'placeholder' => ""
							]),
							"<p>Ne PAS répéter les infos déjà saisies plus hauts (discipline, niveau de classe...). Mettre en avant les spécificités du contenu en se limitant à 3 ou 4 mots clés. Par exemple, vous pouvez préciser : </p><ul>
								<li>Le champ disciplinaire spécifique: lecture, numération...</li>
								<li>Les compétences travaillées par les élèves: coopérer, écoute active...</li>
								<li>Le sujet précis: cycle de l’eau, Vercingétorix, châteaux forts...</li>
								<li>Le type d’activité : exercice, atelier, fichier autonomie, bricolage...</li>
								<li>Le type de démarche : pédagogie active, Montessori...</li>
								<li>Le  type de public : élèves dyslexiques, ULIS, enseignants débutants...</li>
								<li>Si ce contenu n’est pas destiné aux élèves, qu’est-ce que c’est ? : programmation, réforme, ceintures d’évaluation...</li>
							</ul>"
						]])

					</div>
				</div>


			</fieldset>


		<div class="text-center">

				<input type="submit" class="btn btn-lg btn-primary" value="Continuer">

				</div>
		{!! Form::close() !!}

		</div>

		@include('admin.contenus.supprimer')
		<!-- #vue -->
	</div>

	

    <script>
    var categories = {!! json_encode($categories) !!};
	var contenuTermes = {!! json_encode($contenu->termsIds()) !!};

	var vue = new Vue({
		 el: '#vue',
		 created : function() {
		 },
		 computed: {
		 	categories: function() {
				var cats = this.cats.map(function(cat) {
					var childrenTerms = cat.terms
						.map(function(i) {
							//console.log(contenuTermes);
							i.checked = (contenuTermes.indexOf(i.id) != -1) ? true : false;
							return i;
						})
						.filter(function(i) {
							return i.parent != 0;
					});
					cat.terms = cat.terms.filter(function(t) {
						return t.parent == 0;
					}).map(function(t) {
						t.terms = childrenTerms.filter(function(c) {
							return c.parent == t.id;
						});
						return t;
					});

					return cat;
				});
				return cats;
			}
		 },
		 methods : {
		 	applyToChildren: function(terme) {
				console.log('terme', terme.id);
				var parent = terme;
				terme.terms.map(function(sub) {
					console.log('sub', sub.id);
					//sub.name = 'SubTruc';
					var parentIndex = vue.checked.indexOf(parent.id);
					var subIndex = vue.checked.indexOf(sub.id);

					if (parentIndex != -1) {
						if (subIndex == -1) {
							console.log('add ', sub.id);
							vue.checked.push(sub.id);
						}
					} else {
						if (subIndex != -1) {
							console.log('remove ', sub.id);
							console.log('remove ', subIndex);
							vue.checked.splice(subIndex, 1);
						}
					}
					console.log('AFTER',vue.checked);
					//console.log(parent);
					return sub;
				});
				//return terme;
			}
		 },
		 data: {
		 	//terms : terms
		 	cats: categories,
		 	checked: contenuTermes
		 }
	});
    </script>

	@if (Auth::user()->possedeDroit('contenus_editeur_full'))
    	@include('editeur.full', ['id' => 'description_textarea'])
	@else
		@include('editeur.standard', ['id' => 'description_textarea'])
	@endif
@endsection