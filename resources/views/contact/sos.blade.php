@extends('layout')

@section('content')

    {{ Form::model(Auth::user()) }}
    {!! csrf_field() !!}

    @include('form.errors')

    <div class="row">
        <div class="col-sm-6">
            <h1>@include('bloc', ['bloc' => 'sos-titre', 'default' => 'SOS : j\'ai besoin d\'aide'])</h1>

            <div class="form-group">
                {!! Form::label('Type d\'urgence') !!}
                {!! Form::select('select', array(
                        'stress' => 'Contôle du stress',
                        'aide' => 'besoin d\'aide'
                        ),null, [
                        'class'=>'form-control',
                        'required' => true
                    ])
                !!}
            </div>

            <div class="form-group">
                {!! Form::label('Objet') !!}
                {!! Form::text('objet', null,[
                        'class'=>'form-control',
                        'required' => true
                    ])
                !!}
            </div>

            @if (Auth::user())

                <div class="form-group">
                    {!! Form::hidden('nom', null,[
                            'class'=>'form-control',
                            'required' => true
                        ])
                    !!}
                </div>

                <div class="form-group">
                    {!! Form::hidden('email', null,[
                            'class'=>'form-control',
                            'required' => true
                        ])
                    !!}
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('Numéro de téléphone') !!}
                {!! Form::tel('numero', null,[
                        'class'=>'form-control',
                        'placeholder' => '(facultatif) Si vous souhaitez être rappelé-e',
                        //'pattern' => '^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$'
                    ])
                !!}
            </div>

            <div class="form-group">
                {!! Form::label('Votre message') !!}
                {!! Form::textarea('message', null,[
                        'class'=>'form-control',
                        'required' => true
                    ])
                !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Envoyer le message',[
                        'class'=>'btn btn-primary'
                     ])
                !!}
            </div>
        </div>
        <div class="col-sm-5">
            @include('bloc', ['bloc' => 'sos-coordonnees', 'default' => '<h3>Notre e-mail</h3> <p><a href="mailto:contact@etreprof.fr">contact@etreprof.fr</a></p>'])
        </div>
    </div>

    {{ Form::close() }}

@endsection