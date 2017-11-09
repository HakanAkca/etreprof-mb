@extends('layout')

@section('content')
    <section>
        <div class="row">
            @foreach($evenements as $evenement)

                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-default">
                        <h3 class="panel-heading">
                            <a href="{{ $evenement->url() }}">
                                {{ $evenement->titre }}
                            </a>
                        </h3>
                        <div class="panel text-center">
                            {{ Date::parse($evenement->date_debut)->format('j F Y à H:i') }}
                        </div>
                        <p class="panel-body text-center">{{ $evenement->description }}</p>
                        <p>{{ $evenement->nb_interesses }} intéressé{{$evenement->nb_interesses > 1 ? 's' : '' }}</p>
                    </div>
                </div>

            @endforeach
        </div>
    </section>
@endsection