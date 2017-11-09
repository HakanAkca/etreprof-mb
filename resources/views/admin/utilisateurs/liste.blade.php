@extends('admin.layout')


@section('content')

	<div id="liste">

		<h1>Membres (@{{ tableData.length }})</h1>

	  <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
	</div>


	<script>
	var q = {};
	$.getJSON('/admin/utilisateurs/liste.json', q)
		.then(function(data) {
			if (typeof(data.users) != 'undefined') {
				liste.$data.tableData = data.users.map(function(i) {
					i.date_derniere_action = (i.date_derniere_action != '1970-01-01') ? moment(i.date_derniere_action) : '';
					i.created_at = moment(i.created_at);
					return i;

				});
			}
			console.log(data);
		});
	Vue.use(VueTables.ClientTable, {

	  compileTemplates: true,
	  perPage:100,
	  perPageValues:[20,50,100,500]
	});


	var liste = new Vue({
	  el:"#liste",
	  methods: {

	  },
	  data: {
	  	columns:['created_at', 'date_derniere_action', 'name', 'email', 'roleNom', 'stats', 'nb_contributions','score', 'modifier'],
		tableData : [],

	    options: {
	      dateColumns: [ 'created_at', 'date_derniere_action' ],
    	  sortable: ['date_derniere_action','created_at','name','email','roleNom','nb_contributions'],
		  dateFormat : 'DD MMM YYYY à HH:mm',
		  //toMomentFormat : 'DD/MM/YYYY',
	      headings: {
	        created_at: 'Inscrit·e le',
	        date_derniere_action: 'Dernière action',
			name: 'Membre',
			email: 'E-mail',
			roleNom: 'Profil',
			modifier: ''
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
	           column:'date_derniere_action',
	           ascending:false
		  },

		  templates: {
		  	name: function(h,row) {
		  		return h('strong', {},
					[h('a', {
						attrs : {
							"class" : "text-bold",
							"href" : "/admin/utilisateurs/modifier/" + row.id
						}
					}, row.name)]
				);
			},
			modifier: function(h, row) {
				return h('a', {
					attrs : {
						"class" : "glyphicon glyphicon-circle-arrow-right text-warning",
						"href" : "/admin/utilisateurs/modifier/" + row.id
					}
				});
			},
			stats: function(h, row) {
				return h('a', {
					attrs : {
						"class" : "glyphicon glyphicon-stats",
						"target" : "_blank",
						"href" : "https://clicky.com/stats/visitors?site_id=101040726&date=last-28-days&custom[email]=" + row.email
					}
				});
			},
			email: function(h, row) {
				return h('a', {
					attrs : {
						"class" : "",
						"href" : "mailto:" + row.email
					}
				}, row.email);
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