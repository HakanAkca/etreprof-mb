@extends('admin.layout')


@section('content')

	<div id="liste">

		<!--div class="pull-right">
		Jour : <input type="date" v-model="date">
		<input type="button" class="btn btn-sm btn-default" value="ok" @click="changeDate()">
		<input type="submit" class="btn btn-sm btn-default" value="aujourd'hui" @click="date='';changeDate()">
		</div-->
		<a class="pull-right btn btn-primary" href="{{ action('Admin\ArticlesController@modifier', $type) }}">+ Créer un contenu</a>

		<h1>{{ $titre }}</h1>

	  <v-server-table url="/admin/articles/liste-{{ $type }}.json" :columns="columns" :options="options"></v-server-table>
	</div>


	<!--div id="vue">
		<table class="table table-striped">

		<tr>
			<th>1ère visite</th>
			<th>Dernière action</th>
			<th>Pseudo</th>
			<th>Profil</th>
			<th>Nombre de pages vues</th>
			<th>Nombre de recherches</th>

			<th>Statut</th>
		</tr>

		<tr v-for="membre in membres" :class="">
			<td>@{{membre.created_at }}</td>
			<td>@{{membre.updated_at }}</td>
			<td><strong><a v-bind:href="'/admin/utilisateurs/modifier/' + membre.id">@{{membre.name }}</a></strong></td>
			<td>@{{ (membre.role) ? membre.role.nom : '-' }}</td>

			<td></td>
			<td></td>
			<td><strong><a v-bind:href="'/admin/utilisateurs/modifier/' + membre.id" class="btn btn-sm btn-primary">Modifier</a></strong></td>

		</tr>

		</table>
	</div-->
	<script>
	var type = '{{ $type }}';

	Vue.use(VueTables.ServerTable, {

	  //compileTemplates: true,
	  perPage:100,
	  perPageValues:[20,50,100,500]
	});

	var dataVue = new Vue({
	  el:"#liste",
	  ready: function() {

	  },
	  data: {
	  	  type: type,
	  	columns:['updated_at', 'title', 'status', 'excerpt', 'voir'],

	    options: {
	      dateColumns: [ 'updated_at' ],
    	  sortable: ['updated_at','title','status'],
		  dateFormat : 'DD MMM YYYY à HH:mm',
		  //toMomentFormat : 'DD/MM/YYYY',
	      headings: {
	        updated_at: 'Mis à jour',
	        title : 'Titre',
	        excerpt : (type == 'block') ? 'Code' : 'Extrait',
	        status : 'Statut',
			voir: 'Voir'
		  },
	      // see the options API,
		  texts:{
			count:'Résultats {from} à {to} sur {count}|{count} résultats|1 résultat',
			filter:'Recherche rapide :',
			filterPlaceholder:'Par nom, structure, etc',
			limit:'Dossiers par page:',
			noResults:'Aucun résultat',
			page:'Page:', // for dropdown pagination,
			filterBy: 'Filtrer par {column}', // Placeholder for search fields when filtering by column
			loading:'Loading...', // First request to server
			defaultOption:'Select {column}' // default option for list filters
			},
		  orderBy: {
	           column:'updated_at',
	           ascending:false
		  },

		  templates: {
		  	title: function(h,row) {
		  		return h('strong', {},
					[h('a', {
						attrs : {
							"class" : "text-bold",
							"href" : "/admin/articles/" + this.type + "/" + row.id
						}
					}, row.title)]
				);
			},
			voir: function(h, row) {
				return h('a', {
					attrs : {
						"class" : "glyphicon glyphicon-circle-arrow-right text-warning",
						"href" : row.link,
						"target" : '_blank'
					}
				});
			},
			excerpt: function(h, row) {
				if (row.type == 'block') {
					return row.url;
				}
				if (row.excerpt) {
					return row.excerpt.substring(0,120) + '...';
				}
				return row.text.substring(0,120) + '...';

			}
		  }
		}
	  }
	});
	</script>
	<!--script>
	var vue = new Vue({
		 el: '#vue',
		 created: function() {
		 	this.getData();
		 },

		 methods: {
		 	getData: function() {
		 		var q = {};
				$.getJSON('/admin/utilisateurs/liste.json', q)
					.then(function(data) {
						if (typeof(data.users) != 'undefined') {
							vue.$data.membres = data.users.map(function(i) {
								return i;

							});
						}
						console.log(data);
					});
			}

		 },
		 data : {
		 	membres : []
		 }

	});
	</script-->

@endsection