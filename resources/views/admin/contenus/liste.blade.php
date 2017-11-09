@extends('admin.layout')


@section('content')

	<div id="vue">

	<div class="alert alert-info" v-show="onglet_actif == 'aevaluer'">
	@include('bloc', ['bloc' => 'admin-contenus-evaluer-notice', 'default' => '
		<p>Bienvenue ! Vous avez cinq minutes devant vous ? Alors vous pouvez participer à l’évaluation des contenus pour faire avancer le projet et vous inspirer!</p>
<p>Il vous suffit de choisir une ressource à évaluer. Comment on fait ça ? Deux choix s’offrent à vous :</p>
<ul>
<li>soit vous cliquez sur le bouton « évaluer » d’une ressource, au hasard (vivons dangereusement)</li>
<li>soit vous pouvez affiner les critères pour trouver des ressources qui vous intéressent particulièrement (motivation et enthousiasme, il paraît que ça marche). Puis, cliquez sur le bouton « évaluer » de la ressource.</li>
</p>
<p>A vos avis, prêts, feu, évaluons !</p>'])
	</div>

	<ul class="nav nav-tabs">
		<li><h4><strong>Contenus</strong> &nbsp; &nbsp; </h4></li>
		<li v-for="(titre, etat) in onglets" :class="{'active' : etat == onglet_actif}" @click="onglet_actif = etat;"><a :href="'#etat-' + etat">@{{ titre }}</a></li>

	</ul>

	<div id="contenus">
	<div class="well">
		Filtrer par :
		<span v-for="categorie in categories">
			<select v-model="categoriesActives[categorie.id]" @change="majCategories()" class="form-control" style="width:170px;display:inline-block">
				<option value="">-@{{ categorie.name }}-</option>
				<option v-for="terme in categorie.terms" :value="terme.id">@{{ terme.name }}</option>
			</select>
		</span>
	</div>

	  <v-server-table url="/admin/contenus/liste.json" :columns="columns" :options="options"></v-server-table>
	</div>
	</div>

	<script>

	var onglets = {!! json_encode($onglets) !!};
	var categories = {!! json_encode($categories) !!};
	var categoriesActives = {};
	for (var i in categories) {
		categoriesActives[categories[i].id] = '';
	}

	Vue.use(VueTables.ServerTable, {

	  //compileTemplates: true,
	  perPage:100,
	  perPageValues:[20,50,100,500]
	});


var dataVue = new Vue({
  el:"#vue",
  ready: function() {
    this.$on('vue-tables.row-click', function(row) {
      console.log(row);
    });

    //this.onglet_actif = 'aevaluer';
	//bus.$emit('vue-tables.filter::etat', 'aevaluer');

  },
  methods: {
  	majCategories: function() {
		console.log('categories', this.categoriesActives);
		var terms = [], cats = this.categoriesActives;
		for (var i in cats) {
			if (cats[i] != "") {
				terms.push(cats[i]);
			}
		}
		console.log(terms);
		bus.$emit('vue-tables.filter::terms', terms);
	}
	/*refresh: function() {
		var self=this;
		$.getJSON('/admin/log.json', { month:this.$data.month, username : this.$data.username}, function(json) {
			self.$data.tableData = json;
		});
	},

	filterByUsername: function(username) {
		this.$data.username = username;
		this.refresh();
	}*/
  },
  data: {

    columns:['created_at', 'updated_at', 'etat', 'titre', 'propose_par_name', 'action'],
    options: {
      /*dateColumns: [
      	'created_at','updated_at'
      ],
      //dateFormat: 'DD MMM YYYY à HH:mm',
      //toMomentFormat:'DD MMM YYYY',
      responseAdapter: function(resp) {
		  return {
		    data: resp.data.map(function(i) {
				if (i.updated_at) {
					i.updated_at = moment(i.updated_at);
				}
				console.log(i.updated_at);
				return i;
			}),
		    count: resp.count
		  }
		},*/
    	//sortable: ['option'],
	  customFilters: ['etat','terms'],
      headings: {
        created_at: 'Proposé',
        updated_at: 'Modifié',
        propose_par_name: 'Proposé par',
		titre: 'Titre'
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
    //    }
	  templates:{
	  	action: function(h, row) {
	  		var boutons = [], render = [];
	  		switch (row.etat) {
	  			case 'en_construction' :
	  				boutons.push(['/admin/contenus/lien/' + row.id, 'btn-info', 'glyphicon-pencil', 'Compléter']);
	  				break;

	  			default :
	  				boutons.push(['/admin/contenus/identite/' + row.id, 'btn-info', 'glyphicon-pencil', 'Modifier']);
	  				boutons.push(['/admin/contenus/avis/' + row.id, 'btn-warning', 'glyphicon-comment', 'Evaluer']);
			}
			if (row.publier) {
				boutons.push(['/admin/contenus/publier/' + row.id, 'btn-primary', 'glyphicon-arrow-right', 'Publier']);
			}
			for (var i in boutons) {
				render.push([ h('a', { attrs: {
	  				href: boutons[i][0],
	  				class: 'btn btn-sm ' + boutons[i][1]
				}}, [
					h('span', { attrs: { class: 'glyphicon ' + boutons[i][2] } }), ' ',
					boutons[i][3], ' '
				])
				]);

			}

			return render;
		},

		titre: function(h,row) {
			var url = row.url.split('/');
			url = url[2];
			var termes = [];
			for (var i in row.termes) {
				termes.push(' ');
				termes.push(h('span', { attrs: {class  : "label label-default" }}, row.termes[i]));

			}
			return [
				h('strong', {}, row.titre),
				h('br'),
				h('small',{}, url),
				termes
				]
		},

		etat: function(h, row) {
			var etats = {
				'en_construction' : ['A compléter', 'default'],
				'propose' : ['A évaluer', 'danger'],
				'evalue' : ['A publier', 'warning'],
				'publie' : ['Publié', 'success'],
				'corbeille' : ['Corbeille', 'muted'],
				'efface' : ['Effacé', 'muted'],
			};
			return h('small', { attrs : { class: 'label label-' +  etats[row.etat][1]}},  etats[row.etat][0]);
		},

		updated_at: function(h,row) {
			return dateFormat(h,row.updated_at);
		},
		created_at: function(h,row) {
			return dateFormat(h,row.created_at);
		},
		propose_par_name: function(h,row) {
			return h('small', {}, row.propose_par_name);
		}
	  }
    },
    onglets: onglets,
    onglet_actif: 'aevaluer',
    categories:categories,
    categoriesActives: categoriesActives

  },
  watch: {
		onglet_actif: function(val) {
			console.log('onglet', val);
			for (var i in this.categoriesActives) {
				this.categoriesActives[i] = '';
			}
			bus.$emit('vue-tables.filter::etat', val);
		},


	}
});
	</script>

@endsection