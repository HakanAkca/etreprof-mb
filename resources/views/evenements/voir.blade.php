@extends('layout')

@section('content')
    <section id="evenement">
        <div class="row">

            <div class="col-xs-12">
                <div class="panel panel-default">
                    @if(Auth::user()->possedeDroit('rediger_evenements'))
                        <a class="btn btn-default pull-right"
                           href="{{action('Admin\EvenementsController@modifier', [$evenement->id])}}">Modifier
                            l'événement</a>
                    @endif
                    <h3 class="panel-heading">
                        {{ $evenement->titre }}
                    </h3>
                    <div class="panel text-center">
                        {{ Date::parse($evenement->date_debut)->format('j F Y à H:i') }}
                    </div>
                    <p class="panel-body text-center">{{ $evenement->description }}</p>
                    @if ($evenement->code_integration)
                        <div>
                            {!! $evenement->code_integration !!}
                        </div>
                    @endif
                </div>
                <p>@{{ nb_interesses }} intéressé@{{nb_interesses > 1 ? 's' : ''}} </p>
                <div>
                    <div>
                        <button @click="click()"
                                v-bind:class="{ 'btn-default' : !interesse, 'btn-primary': interesse }" class="btn">
                            Ca m'interesse
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    var evenement_id = {!! $evenement->id !!};
    var interesse = {{ $interesse }};
    var nb_interesses =
            {{ $evenement->nb_interesses }}

    var interesseVue = new Vue({
            el: '#evenement',
            data: {
                evenement_id: evenement_id,
                interesse: interesse,
                nb_interesses: nb_interesses

            },
            methods: {
                click: function () {
                    if (this.interesse) {
                        return this.plusInteresse();
                    }
                    return this.ajouterInteresse();
                },
                ajouterInteresse: function () {
                    var that = this;
                    $.post('/evenements/interesse/' + evenement_id, {
                        'id': this.evenement_id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function (json) {
                            that.interesse = 1;
                            that.nb_interesses = json.nb;
                        });
                },
                plusInteresse: function () {
                    var that = this;
                    $.post('/evenements/plus-interesse/' + evenement_id, {
                        'id': this.evenement_id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function (json) {
                            that.interesse = 0;
                            that.nb_interesses = json.nb;
                        });
                }
            }
        });
</script>
@endpush

