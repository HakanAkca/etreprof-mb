@extends('admin.layout')

@section('content')


    <div id="vue">
        <v-server-table url="/admin/evenements/liste.json" :columns="columns" :options="options"></v-server-table>
    </div>


    <script>
        Vue.use(VueTables.ServerTable, {

            //compileTemplates: true,
            perPage: 100,
            perPageValues: [20, 50, 100, 500]
        });

        var dataVue = new Vue({
            el: "#vue",
            data: {
                columns: ['date_debut', 'titre', 'description', 'statut', 'nb_interesses', 'action','supprimer'],
                options: {
                    headings: {
                        created_at: 'Date',
                        propose_par_name: 'Proposé par',
                        evenement: 'Evenements',
                        nb_interesses: 'Interesses'

                    },
                    params : {
                        'x' : 'y'
                    },
                    // see the options API,
                    texts: {
                        count: 'Résultats {from} à {to} sur {count}|{count} résultats|1 résultat',
                        filter: 'Recherche rapide :',
                        filterPlaceholder: 'Par nom, structure, etc',
                        limit: 'Dossiers par page:',
                        noResults: 'Aucun résultat',
                        page: 'Page:', // for dropdown pagination,
                        filterBy: 'Filtrer par {column}', // Placeholder for search fields when filtering by column
                        loading: 'Loading...', // First request to server
                        defaultOption: 'Select {column}' // default option for list filters
                    },
                    templates: {
                        titre: function (h, row) {
                            return h('a', {
                                attrs: {
                                    "class": "text-warning",
                                    "href": row.url,
                                    "target": '_blank'
                                }
                            }, row.titre);
                        },

                        created_at: function (h, row) {
                            return dateFormat(h, row.created_at);
                        },

                        action: function (h, row) {
                            var boutons = [], render = [];
                            switch (row.etat) {
                                default :
                                    boutons.push(['/admin/evenements/modifier/' + row.id , 'btn-info', 'glyphicon-pencil', 'Modifier']);
                            }
                            for (var i in boutons) {
                                render.push([h('a', {
                                    attrs: {
                                        href: boutons[i][0],
                                        class: 'btn btn-sm ' + boutons[i][1]
                                    }
                                }, [
                                    h('span', {attrs: {class: 'glyphicon ' + boutons[i][2]}}), ' ',
                                    boutons[i][3], ' '
                                ])
                                ]);

                            }

                            return render;
                        },
                    }
                }
            },
            methods: {
                supprimer: function(id) {
                    var that = this;
                    $.post('/admin/evenements/supprimer', {'id' : id, '_token' : $('[name="_token"]').val()})
                        .done(function() {
                            console.log('supprimé', id);
                            that.$children[0].refresh();
                        });
                }
            }

        });
    </script>
@endsection