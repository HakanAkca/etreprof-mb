@extends('admin.layout')


@section('content')
    <a href="{{ action('Admin\EvenementsController@index') }}"><span class="glyphicon glyphicon-arrow-left"></span>
        Revenir à la liste</a>

    <h1>Modifier l'evenement</h1>
    <h3><a href="{{ $evenement->url() }}" target="_blank">{{ $evenement->titre }}</a></h3>

    <div id="vue">
        {!! Form::model($evenement,  ['action' => ['Admin\EvenementsController@postModifier', $evenement->id]]) !!}

        @include('form.element', [ 'element' => [
            'Date de début',
            Form::text('date_debut', null, [
                'class' => 'form-control',
                'placeholder' => '2017-06-03 03:02:38',
            ])
        ]])

        @include('form.element', [ 'element' => [
            'Date de fin',
            Form::text('date_fin', null, [
                'class' => 'form-control',
                'placeholder' => '2017-06-03 03:02:38'
            ])
        ]])
        @include('form.element', [ 'element' => [
            'Titre',
            Form::text('titre', null, [
                'class' => 'form-control'
            ])
        ]])

        @include('form.element', [ 'element' => [
            'Description',
            Form::textarea('description', null, [
                'class' => 'form-control'
            ])
        ]])
        @include('form.element', [ 'element' => [
            'Lien vidéo',
            Form::textarea('code_integration', null, [
                'class' => 'form-control'
            ])
        ]])

        @include('form.element', [ 'element' => [
            'Statut',
            Form::select('statut',[
                'brouillon' => 'Brouillon : en attente',
                'publie' => 'Publié',
                'corbeille' => 'Corbeille'
            ],[
                'class' => 'form-control'
            ])
        ]])


        <div class="text-center">

            <input type="submit" class="btn btn-primary btn-lg" value="Enregistrer">

        </div>
        {!! Form::close() !!}
    </div>


@endsection