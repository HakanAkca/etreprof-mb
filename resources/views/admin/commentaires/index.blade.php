@extends('admin.layout')

@section('content')


    <div id="vue">
        <v-server-table url="/admin/commentaires/liste.json" :columns="columns" :options="options"></v-server-table>
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
                columns: ['created_at', 'commentaire', 'propose_par_name', 'voir', 'action','supprimer'],
                options: {
                    headings: {
                        created_at: 'Date',
                        propose_par_name: 'Proposé par',
                        commentaire: 'Commentaire'
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
                        voir: function (h, row) {
                            return h('a', {
                                attrs: {
                                    "class": "text-warning",
                                    "href": row.url,
                                    "target": '_blank'
                                }
                            }, row.contenu_titre);
                        }, 
                        supprimer: function (h, row) {
                            return h('button', {
                                attrs: {
                                    "class": "btn btn-sm btn-primary"
                                },
                                on: {
                                    click : function() { dataVue.supprimer(row.id) ; }
                                }
                            }, [h('span', {'attrs' : { 'class' : 'glyphicon glyphicon-remove'}}, '')]);
                        },
                        created_at: function (h, row) {
                            return dateFormat(h, row.created_at);
                        },

                        action: function (h, row) {
                            var boutons = [], render = [];
                            switch (row.etat) {
                                default :
                                    boutons.push(['/admin/commentaires/modifier/' + row.id , 'btn-info', 'glyphicon-pencil', 'Modifier']);
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
                    $.post('/admin/commentaires/supprimer', {'id' : id, '_token' : $('[name="_token"]').val()})
                    .done(function() {
                        console.log('supprimé', id);
                        that.$children[0].refresh();
                    });
                }
            }

        });
    </script>
@endsection