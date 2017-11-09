
	<h2>Historique / <strong>{{ $user->nom }}</strong></h2>

	<div id="historique">
	  <v-client-table :data="tableData" :columns="columns" :options="options"></v-server-table>
	</div>


	<script>
	Vue.use(VueTables.ClientTable, {

	  compileTemplates: true,
	  perPage:100,
	  perPageValues:[20,50,100,500]
	});

	var historique = {!! json_encode($historique) !!}.map(function(i) {
		i.date = moment(i.date);
		i.contenu_titre = i.contenu.titre;
		return i;
	})	;

	var dataVue = new Vue({
	  el:"#historique",
	  data: {
	  	columns:['date', 'text', 'contenu'],
		tableData : historique,
	    options: {
	      dateColumns: [
      		'date'
	      ],
    	  dateFormat : 'DD MMM YYYY à HH:mm',

	      headings: {
	        date: 'Date',
			text: 'Action'
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

