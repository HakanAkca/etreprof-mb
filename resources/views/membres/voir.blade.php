@extends('layout')


@section('content')
    <div id="vuemembre">
        <button class="btn btn-primary pull-right" v-if="!estContact" @click="ajouterContact(membreId)">
            Ajouter contact
        </button>

        <button class="btn btn-primary pull-right" v-if="estContact"  @click="supprimerContact(membreId)">
            Retirer de mes contact
        </button>

        <button class="pull-right btn btn-warning" @click="discussion(membreId)">Envoyer un message</button>

        <div class="thumbnail pull-left">
            <div class="thumb" style="background-image: url({{ $membre->image }});"></div>
        </div>

        <h1>{{ $membre->name }}
            @if (Auth::user()->possedeDroit('roles_utilisateurs'))
                <a href="{{ action('Admin\UtilisateursController@modifier', $membre->id) }}"
                   class="btn btn-sm btn-default">Administrer</a>
            @endif
        </h1>

        <div class="acol-sm-5">
            <div class="well">
                <p>Inscrit·e le {{ Date::parse($membre->created_at)->format('j F Y H:i') }} </p>

                <h3>Niveaux </h3>
                @foreach ($membre->related as $related)
                    <big><span class="label label-warning">{{ $related->term->name }}</span></big>
                @endforeach
            </div>
        </div>

    </div><!-- #vuemembre -->
    <script>
        var membreId = {{ $membre->id }};
        var estContact = {!! $contact !!};

        var vuemembre = new Vue({
            el: '#vuemembre',
            data: {
                membreId: membreId,
                estContact: estContact
            },
            methods: {
                discussion: function (membreId) {
                    $.post('/discussions/demarrer', {'user_id': membreId})
                        .done(function (data) {
                            if (data.discussion_url) {
                                window.location = data.discussion_url;
                            }
                        });
                },
                ajouterContact: function (id) {
                    var that = this;
                    $.post('/membres/ajouter-contact', {
                        'id': id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function () {
                            that.estContact = 1;
                        });
                },
                supprimerContact: function (id) {
                    var that = this;
                    $.post('/membres/supprimer-contact', {
                        'id': id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function () {
                            that.estContact = 0;
                        });
                }
            }
        })
    </script>

@endsection