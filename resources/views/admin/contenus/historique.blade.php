@extends('admin.layout')


@section('content')

	@include('admin.contenus.form-nav', ['etape' => 'identite'])

	<h1>Historique / <strong>{{ $contenu->titre }}</strong></h1>

	<div id="historique">
	  <v-client-table :data="tableData" :columns="columns" :options="options"></v-server-table>
	</div>


	<script>
	Vue.use(VueTables.ClientTable, {

	  compileTemplates: true,
	  perPage:100,
	  perPageValues:[20,50,100,500]
	});

	var historique = {!! json_encode($historique) !!};

	var dataVue = new Vue({
	  el:"#historique",
	  data: {
	  	columns:['date', 'text', 'auteurNom'],
		tableData : historique,
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
		  }
		}
	  }
	});
	</script>


@endsection