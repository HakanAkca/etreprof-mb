@extends('admin.layout')


@section('content')


@include('admin.contenus.form-nav', ['etape' => 'publier'])

<h1>Publier / <strong>{{ $contenu->titre }}</strong></h1>

<div id="vue">

	<div class="jumbotron">
	@include('admin.contenus.preview', ['contenu' => $contenu])
	</div>

	{!! Form::model($contenu, ['class' => 'form-horizontal']) !!}
	{!! csrf_field() !!}


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




	<div class="text-center">

			<input type="submit" class="btn btn-lg btn-primary" value="Publier ce contenu">
			<br>
			<small>Il sera visible publiquement par tous les visiteurs du site</small>

	</div>

	{!! Form::close() !!}


	@include('admin.contenus.supprimer')

</div><!-- #vue -->

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

@endsection