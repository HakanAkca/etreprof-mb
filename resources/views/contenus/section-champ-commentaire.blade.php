@if (minimum_version('1.0.0'))
<a name="com_form"></a>
    <section>
        {{ Form::open(['url' => action('ContenusController@postCommentaire'), 'class' => 'envoyer_com']) }}
        {!! csrf_field() !!}

        @include('form.errors')

        <div class="row">
        <div class="col-sm-9">
                <h1>Laisser un commentaire</h1>

                <div class="form-group">
                    {!! Form::textarea('message', null,[
                            'class'=>'form-control',
                            'rows' =>'5'

                        ])
                    !!}
                </div>

                <div class="form-group" id="commentaire">
                    {!! Form::submit('Envoyer le message',[
                            'class'=>'btn btn-primary',
                            'id' =>'envoyer_com'
                         ])
                    !!}
                </div>
                {!! form::hidden('contenu_id', $contenu->id) !!}
            </div>
        </div>

        {{ Form::close() }}
    </section>

    @push('scripts')
    <script>
        $(function () {
            $(document).on('submit', '.envoyer_com', function () {

               return ($('#envoyer_com').attr('disabled', 'disabled'));
            })
        });
    </script>
    @endpush

@endif
