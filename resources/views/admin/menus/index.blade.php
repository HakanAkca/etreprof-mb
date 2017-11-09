@extends('admin.layout')


@section('content')

	<h1>Menus</h1>

	<div id="vue">
		<div class="alert alert-warning" v-show="modif">
		<h4>Modifications non enregistrées</h4>
		<p>N'oubliez pas d'enregistrer vos modifications pour mettre à jour les menus.</p>
		</div>

		<div class="row">

			<div class="col-sm-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Ajouter un lien</h3>
					</div>

					<div class="panel-body">
						<input type="hidden" v-model="lien_id">
						<label>Intitulé : </label><input type="text" class="form-control" v-model="lien_text">
						<label>Adresse : </label><input type="text" class="form-control" v-model="lien_url">
						<label>Poids : </label><input type="number" class="form-control" v-model="lien_ordre">
						<label>Ouvrir dans : 
							<input type="radio" value="_self" v-model="lien_target"> la même fenêtre<br>
							<input type="radio" value="_blank" v-model="lien_target"> une nouvelle fenêtre</label><br>
						<label>Rattacher à : </label><select class="form-control" v-model="lien_parent_id">
							<option value="null">-- Racine -- </option>
							<option v-for="lien in listeliens" :value="lien.id" :style="{ fontWeight: (lien.parent_id) ? 'normal' : 'bold', textTransform: (lien.parent_id) ? 'none' : 'uppercase', background: (lien.parent_id) ? '' : '#444', color: (lien.parent_id) ? '' : '#fff' }">@{{ lien.text }}</option>
						</select>
						<label>Droits associés : </label><select class="form-control" v-model="lien_droit_id">
							<option value="0">-- Aucun -- </option>
							<option v-for="droit in droits" :value="droit.id">@{{ droit.description }}</option>
						</select>
						<button @click="ajouterLien()" class="btn btn-default">Créer un nouveau lien</button>
						<button @click="modifierLien()" v-if="lien_i" class="btn btn-primary">Modifier le lien</button>
					</div>
				</div>
			</div>

			<div class="col-sm-5">

				<ul>
					<div class="panel panel-primary" v-for="menu in menusTree">
						<div class="panel-heading">
							<button class="btn btn-default pull-right" @click="enregistrer(menu)">Enregistrer</button>
							<h2 class="panel-title"><a href="#" @click="edit(menu)">@{{ menu.text }}</a></h2>
						</div>

						<ul class="list-group">
							<li class="list-group-item" v-for="lien in menu.liens"><a href="#" @click="edit(lien)">@{{ lien.text}}</a><span class="pull-right text-muted glyphicon glyphicon-remove" v-if="!lien.liens.length" @click="supprimer(lien)"></span>
								<ul class="alist-group">
									<li class="alist-group-item" v-for="sublien in lien.liens"> <a href="#" @click="edit(sublien)" class="">@{{ sublien.text}}</span><span class="pull-right text-muted glyphicon glyphicon-remove" v-if="!sublien.liens.length" @click="supprimer(sublien)"></span></li>
								</ul>
							</li>
						</ul>
					</div>

					</li>
				</ul>
			</div>
		</div>

	</div>

	<script>

	var menus = {!! json_encode($menus) !!};
	var droits = {!! json_encode($droits) !!};

	var vue = new Vue({
		 el: '#vue',
		 created: function() {
		 	 //console.log(this.menus);
		 	 this.listeliens = menus;
		 	 this.rebuildTree();
		 },

		 methods: {
		 	edit: function(lien) {
				this.lien_i = lien.i;
				this.lien_id = lien.id;
				this.lien_text = lien.text;
				this.lien_url = lien.url;
				this.lien_parent_id = lien.parent_id;
				this.lien_target = lien.target;
				this.lien_ordre = lien.ordre;
				this.lien_droit_id = lien.droit_id;
			},
			supprimer: function (lien) {
				var msg = 'Voulez-vous supprimer le lien ' + lien.text + ' ?';
				var that = this;
				if (confirm(msg)) {
					$.post('/admin/menus/supprimer', { id : lien.id, '_token' : $('[name="_token"]').val() })
						.done(function(ret) {

							that.listeliens.forEach(function (l, index) {
							    if (l.id === lien.id) {
							      that.listeliens.splice(index, 1);
							    }
							  });
							that.rebuildTree();
						});
				}
			},
			enregistrer : function(menu) {
				var that = this;
				$.post('/admin/menus/enregistrer', { 'tree' : this.listeliens, '_token' : $('[name="_token"]').val() }, function(ret) {
					that.modif = false;
					console.log('Ajax post:', ret);

				});
			},
		 	rebuildTree: function() {
		 		var menusTree = [];
				var listeliens = JSON.parse(JSON.stringify(this.listeliens));
				var i = 0;
				listeliens.map(function(m) {
					m.i = i++;
					m.liens = listeliens.filter(function(i) { return m.id != null && i.parent_id == m.id});
				});
				menusTree = listeliens.filter(function(i) { return i.parent_id == null });

				this.menusTree = menusTree;

			},

			ajouterLien: function() {
				var lien = {
					i : null,
					id : null,
					text : this.lien_text,
					url : this.lien_url,
					parent_id : this.lien_parent_id,
					target : this.lien_target,
					ordre : this.lien_ordre,
					droit_id : this.lien_droit_id,
				};
				console.log(lien);
				this.listeliens.push(lien);
				this.rebuildTree();
			},

			modifierLien: function() {

				this.listeliens = this.listeliens.map(function(l) {
					console.log(vue.lien_id);
					if (l.id == vue.lien_id) {
						console.log('update',l);
						l = {
							id : vue.lien_id,
							text : vue.lien_text,
							url : vue.lien_url,
							parent_id : vue.lien_parent_id,
							target : vue.lien_target,
							ordre : vue.lien_ordre,
							droit_id : vue.lien_droit_id,
						};
					}
					return l;
				});
				this.modif = true;
				this.rebuildTree();
			}

		 },
		 data : {
		 	listeliens : [],
		 	menusTree : [],
		 	droits: droits,
		 	lien_i : null,
		 	lien_id : null,
		 	lien_text : '',
		 	lien_url: '',
		 	lien_ordre: 0,
		 	lien_target: '_self',
		 	lien_droit_id: 0,
		 	lien_parent_id: null,
		 	modif: false
		 }

	});
	</script>

@endsection