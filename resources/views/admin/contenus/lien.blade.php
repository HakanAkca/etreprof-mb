@extends('admin.layout')


@section('content')

	@include('admin.contenus.form-nav', ['etape' => 'lien'])

	<h1>Contenu / <strong>Lien</strong></h1>

	<div id="vue">
		<form class="form-horizontal" method="post">
		{!! csrf_field() !!}
			<fieldset>
				<legend>Lien</legend>

				@include('form.element', [ 'element' => [
					'Adresse du lien',
					Form::text('url', null, [
						'v-model' => 'lien.url',
						'required' => true,
						'class' => 'form-control',
						'placeholder' => "http://"
					]) . '<input type="button" class="btn btn-warning" :value="labelBouton" @click="fetchUrl(lien.url)"> <span class="glyphicon glyphicon-arrow-left"></span> Récupérer les images, mots-clés et lien vers les vidéos du site'
				]])

				<div v-if="erreur" v-html="erreur"></div>

				<input type="hidden" name="lien_titre" v-model="lien.titre">

				<div class="well" v-if="lien.url">

					@if (Auth::user()->possedeDroit('contenus_editeur_full'))
						{!! Form::hidden('thumbnail', null, [ 'id' => 'thumbnail', 'disabled' => 'disabled']) !!}
						<a data-input="thumbnail" data-preview="holder" class="pull-right lfm_open btn btn-primary btn-sm">
						   <i class="fa fa-picture-o"></i> Choisir une image
						 </a>
					@endif
					<h2>Image du contenu</h2>
					<div v-if="lien.images">
						<p v-if="lien.images.length > 1">Cliquez sur une image pour la choisir</p>
						<span v-for="(image,i) in lien.images" style="display:inline-block;margin:5px" :style="{ border : (image == image_url) ? '3px solid red': null }">
							<img v-bind:src="image" style="max-width: 180px;max-height: 180px;height:auto;" @click="choisirImage(i)">
						</span>
					</div>


					<h3>Prévisualisation</h3>


					<div v-if="lien.player">
						<div v-html="lien.player"></div>
					</div>


					<input type="hidden" name="images[]" v-for="image in lien.images" v-model="image">
					<input type="hidden" name="image" v-model="image_url">
					<input type="hidden" name="embed_url" v-model="lien.embed_url">
					<input type="hidden" name="decoder" v-model="lien.decoder">
					<input type="hidden" name="duree_secondes" v-model="lien.duree_secondes">
					<input type="hidden" name="lien_description" v-model="lien.description">
					<input type="hidden" name="tags" v-model="lien.tags">
					<input type="hidden" name="auteur" v-model="lien.auteur">
					<input type="hidden" name="source_url" v-model="lien.source_url">

				</div>


			</fieldset>


			<div class="text-center">

				<button type="submit" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-arrow-right"></span> Continuer</button>

			</div>

		</form>

		</div><!-- #vue -->

		@include('admin.contenus.supprimer')


	<script>
	var images_defaut = {!! json_encode(explode(',', Option::get('images_defaut'))) !!};
	var lien = {!! json_encode($contenu) !!};

	var vue = new Vue({
		 el: '#vue',
		 created : function() {

		 },
		 methods: {
		 	fetchUrl : function(url) {
		 		vue.$data.erreur = '';

		 		if (!url) { return alert('Vous devez saisir une adresse de site commençant par http:// ou https://'); }
		 		vue.$data.labelBouton = 'Analyse en cours...';
		 		var id = (this.lien && this.lien.id) ? this.lien.id : null;
				$.post('/admin/contenus/fetch-url', {url : url, id:id, _token: $('[name="_token"]').val() }, 'JSON')
					.done(function(json) {
						if (json.error && json.error == 'existe_deja') {
							vue.$data.erreur = '<div class="alert alert-danger">Ce contenu a déjà été intégré. Cliquez sur le titre du contenu pour ajouter votre avis ou le modifier : <br><a href="/admin/contenus/avis/' + json.contenu.id + '">' + json.contenu.titre + '</a></div>';
							return;
						}
						else if (json.data.error)
						{
							vue.$data.erreur = '<div class="alert alert-danger">Erreur : impossible d\'analyser le lien. Vérifiez que le lien existe en ouvrant la page :  <br><a href="' + json.data.url + '" target="_blank">' + json.data.url + '</a><br>S\'il ne s\'ouvre pas, corrigez-le avant de continuer. Si le lien fonctionne, vous pouvez "forcer" la validation en cliquant sur Continuer ci-dessous.</div>';
							return;
						}

						vue.$data.lien = json.data;
						[].push.apply(vue.$data.lien.images, images_defaut);
						console.log(vue.lien);
						console.log(json);
					})
					.always(function() {
						vue.$data.labelBouton = vue.$data.defaultLabelBouton
					})
					;
			},
			choisirImage: function(i) {
				console.log(i, this.lien.images[i]);
				this.image_url = this.lien.images[i];
				$('.player-image').css('backgroundImage', 'url(' + this.lien.images[i] + ')');
			}

		 },
		 data : {
		 	lien : lien,
		 	image_url : '',
		 	erreur : '',
		 	defaultLabelBouton : 'Vérifier le lien',
		 	labelBouton : 'Vérifier le lien'
		 },
		 computed: {

		 }

	});
	</script>

	<script>
	$(function() {	    
	    $('.lfm_open').filemanager('image');
	    $('#thumbnail').change(function() {
	    	[].push.apply(vue.$data.lien.images, [$(this).val()]);
	    	vue.choisirImage(vue.$data.lien.images.length - 1);
	    	//alert($(this).val());
	    });
	});
	</script>
	
	<script src="/js/lfm-damien.js"></script>
@endsection