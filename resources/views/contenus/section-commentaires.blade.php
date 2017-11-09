@if (minimum_version('1.0.0'))
    <section>
        <h3>@include('bloc', ['bloc' => 'commentaires-titre', 'default' => 'Commentaires'])</h3>
        <div>
            @if ($commentaires->count() > 10)
                <a href="#com_form">Poster un commentaire</a>
            @endif
            @foreach ($commentaires as $i => $commentaire)

                <a name="c{{$commentaire->id}}"></a>
                <div class="row">
                    <div class="col-xs-2 text-center">
                        @if ($commentaire->auteur->urlPublique())
                            <a href="{{$commentaire->auteur->urlPublique()}}">
                            @endif
                            <!--partie commune-->

                                <div class="thumbnail">
                                    <img src="{{$commentaire->auteur->image}}">
                                    <div class="caption text-primary">{{ $commentaire->auteur->name}}</div>

                                </div>
                                @if ($commentaire->auteur->urlPublique())
                            </a>
                        @endif
                    </div>

                    <div class="col-xs-5">
                        <div class="panel panel-default">
                            <p class="panel-heading text-muted">
                                Posté le {{ Date::parse($commentaire->created_at)->format('j F Y à H:i') }}


                                @if (Auth::check() && Auth::user()->possedeDroit('moderer_commentaires') )
                                    {{ Form::open(['url' => action('Admin\CommentairesController@postSupprimer'), 'class'=> 'supprimer_com']) }}
                                    {!! csrf_field() !!}

                                    {!! Form::hidden('id',  $commentaire->id) !!}

                                    {!! Form::hidden('contenu_id', $commentaire->contenu_id) !!}

                                    {!! Form::submit('Supprimer',[
                                            'class'=>'btn btn-primary pull-right btn-sm'
                                         ])

                                    !!}

                                    {{ Form::close() }}
                                @endif
                            </p>

                            <p class="panel-body">{{ $commentaire->commentaire }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif

@push('scripts')
<script>
    $(function () {
        $(document).on('submit', '.supprimer_com', function () {
            var msg = 'Etes-vous sûr-e de vouloir supprimer ce commentaire ?';

            if (confirm(msg)) {
                return true;
            }
            return false;
        })
    });
</script>
@endpush