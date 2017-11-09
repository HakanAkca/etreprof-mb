@extends('layout')

@section('content')

    {{ Form::open() }}
    {!! csrf_field() !!}

    @include('form.errors')

    <div class="row">
        <div class="col-sm-6">
            <h1>@include('bloc', ['bloc' => 'contact-titre', 'default' => 'Contactez-nous'])</h1>

            <div class="form-group">
                {!! Form::label('Objet') !!}
                {!! Form::text('objet', null,[
                        'class'=>'form-control',
                        'required' => true
                    ])
                !!}
            </div>

            <div class="form-group">
                {!! Form::label('Votre nom') !!}
                {!! Form::text('nom', null,[
                        'class'=>'form-control',
                        'required' => true
                    ])
                !!}
            </div>

            <div class="form-group">
                {!! Form::label('Votre adresse E-mail') !!}
                {!! Form::text('email', null,[
                        'required',
                        'class'=>'form-control',
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
                @include('bloc', ['bloc' => 'contact-coordonnees', 'default' => '<h3>Notre e-mail</h3> <p><a href="mailto:contact@etreprof.fr">contact@etreprof.fr</a></p>'])
        </div>
    </div>

    {{ Form::close() }}

@endsection
