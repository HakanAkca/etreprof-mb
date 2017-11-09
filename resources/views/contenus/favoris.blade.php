@extends('layout')

@section('content')
    <h2>Mes favoris</h2>
    @foreach($favoris as $contenu)
        <div class="col-sm-3">
            <a href="{{ $contenu->url() }}" class="clickevent" data-event="{{ $event or null}}"
               data-origin="{{ $origin or null}}">
                <div class="bloc-carre" style="background-image:url({{ $contenu->image }}); background-size:cover">

                    <div class="">

                        <div class="bloc-titre">

                            <h3>{{ $contenu->titre }}</h3>

                            <p>Repéré le {{Date::parse($contenu->pivot->created_at)->format('j F Y à H:i')}}</p>
                            <div class="show-on-hover">
                                <div class="label label-warning pull-right">{{ ($contenu->proposePar) ? $contenu->proposePar->name : '' }}</div>

                                <p>{{ truncate(strip_tags(html_entity_decode($contenu->description)), 150) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endsection