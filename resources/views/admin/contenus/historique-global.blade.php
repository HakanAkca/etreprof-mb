@extends('admin.layout')


@section('content')

	<div id="historique">

		<div class="pull-right">
		Jour : <input type="date" v-model="date">
		<input type="button" class="btn btn-sm btn-default" value="ok" @click="changeDate()">
		<input type="submit" class="btn btn-sm btn-default" value="aujourd'hui" @click="date='';changeDate()">
		</div>

			<h1>Historique global</h1>

	  <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
	</div>


	<script>
	Vue.use(VueTables.ClientTable, {

	  compileTemplates: true,
	  perPage:100,
	  perPageValues:[20,50,100,500]
	});

	var historique = {!! json_encode($historique) !!};
	var curDate = {!! json_encode($date) !!};

	var dataVue = new Vue({
	  el:"#historique",
	  methods: {
			changeDate: function() {
				window.location = '/admin/contenus/historique-global/' + this.date;
			}
	  },
	  data: {
	  	columns:['date', 'contenu', 'text', 'auteurNom'],
		tableData : historique,
		date : curDate,

	    options: {
	      dateColumns: [
      		'date'
	      ],
    		//sortable: ['option'],

	      headings: {
	        date: 'Date',
			text: 'Action'
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
	           column:'date',
	           ascending:false
		  },

		  templates: {
		  	contenu: function(h,row) {
				return h('a', {
					attrs : {
						"class" : "",
						"href" : "/admin/contenus/identite/" + row.contenu_id
					}
				}, row.contenu.titre);
			}
		  }
		}
	  }
	});
	</script>


@endsection