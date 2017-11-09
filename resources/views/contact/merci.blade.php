@extends('layout')

@section('content')

    {{ Form::open() }}
    {!! csrf_field() !!}

    @include('form.errors')

    <div class="row text-center">
        <div class="col-sm-12">

            <h1>
                @include('bloc', ['bloc' => 'contact-merci-titre', 'default' => 'Merci de votre message'])
            </h1>

            <p>
                @include('bloc', ['bloc' => 'contact-merci-text', 'default' => 'Nous vous recontacterons dès que possible.'])
            </p>

        </div>
    </div>

    {{ Form::close() }}

@endsection