@extends('layout')


@section('content')
    <div id="vuemembres">

        <h1>Communauté</h1>

        <div class="row membres">

            <div class="col-xs-3 item" v-for="membre in membres">

                <button class="btn btn-primary" v-if="!estContact(membre.id)" @click="ajouterContact(membre.id)">Ajouter
                    contact
                </button>

                <button class="btn btn-primary" v-if="estContact(membre.id)" @click="supprimerContact(membre.id)">
                    Retirer de mes contact
                </button>

                <a :href="membre.url" class="carre">
                    <div class="thumb" :style="{ backgroundImage : 'url(' + membre.image + ')'}"></div>
                    <h2>@{{ membre.name }}</h2>

                </a>

            </div>
        </div>

    </div><!-- #vuemembre -->

    <script>
        var membres = {!! json_encode( $membres) !!};
        var contacts = {!! json_encode($contacts) !!};

        var vuemembre = new Vue({
            el: '#vuemembres',
            data: {
                membres: membres,
                contacts: contacts
            },
            methods: {
                ajouterContact: function (id) {
                    var that = this;
                    $.post('/membres/ajouter-contact', {
                        'id': id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function () {
                            that.contacts.push(id);
                        });
                },
                supprimerContact: function (id) {
                    var that = this;
                    $.post('/membres/supprimer-contact', {
                        'id': id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function () {
                            that.contacts.splice(that.contacts.indexOf(id), 1);
                        });
                },
                estContact: function (id) {
                    console.log(id, this.contacts, this.contacts.indexOf(id));
                    return (this.contacts.indexOf(id) != -1) ? true : false;
                }
            }


        })
    </script>

@endsection

