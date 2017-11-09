@extends('layout')

@section('title', $contenu->titre)
@section('description', trim(strip_tags($contenu->description)))

@section('content')

    <div id="vue" class="row">

        <div class="col-md-9">

            @include('admin.boutons-editer', [
                'if' => Auth::user()->possedeDroit('publier_contenu'),
                'url' => action('Admin\ContenusController@identite', [ $contenu->id])
            ])


            <div class="waell">


                <div class="player">
                    {!! $contenu->player(847,450) !!}
                </div>

                @if (minimum_version('1.0.0'))
                    @include('contenus.section-score')
                @else
                    @include('contenus.section-votes')
                @endif
                <h1>{{ $contenu->titre }}</h1>

                <h4>
                    @if ($contenu->auteur) Créé par {{ $contenu->auteur }} &mdash; @endif
                    Repéré @if ($contenu->proposePar) par {{ $contenu->proposePar->name }} @endif
                    sur <a href="{{ $contenu->url }}"
                           target="_blank">{{ ($url = explode('/', $contenu->url)) ? $url[2] : '-' }}</a></h4>

                {!! $contenu->description !!}

                <p>@foreach ($contenu->termes as $related)
                        <a href="{{ action('IndexController@categorie', [$related->term->id, str_slug($related->term->name)]) }}"
                           class="label label-default">{{ $related->term->name }}</a>

                    @endforeach
                </p>


                @foreach ($contenu->avis as $avis)
                    @if ($avis->commentaires)
                        <div class="">
                            <h4>Avis de {{ $avis->evaluateur->name }}</h4>
                            <p>Commentaire : {{ $avis->commentaires }}</p>
                        </div>
                    @endif
                @endforeach


            </div><!-- .well -->

            @include('contenus.section-commentaires')

            @include('contenus.section-champ-commentaire')

            @include('contenus.section-similaires')

        </div><!-- .col-md-9 -->


        <!-- #vue -->

        <div class="col-md-3">
            @include('contenus.recommandations')
        </div><!-- .col-md-3 -->
    </div><!-- .row -->


@endsection