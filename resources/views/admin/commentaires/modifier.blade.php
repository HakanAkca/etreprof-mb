@extends('admin.layout')


@section('content')
    <a href="{{ action('Admin\CommentairesController@index') }}"><span class="glyphicon glyphicon-arrow-left"></span> Revenir à la liste</a>

    <h1>Modifier le commentaire</h1>
    <h3><a href="{{$commentaire->url()}}" target="_blank">{{$commentaire->contenu->titre}}</a></h3>

    <div id="vue">
        {!! Form::model($commentaire,  ['action' => ['Admin\CommentairesController@postModifier', $commentaire->id]]) !!}
        @include('form.element', [ 'element' => [
                            'Texte du commentaire',
                            Form::textarea('commentaire', null, [
                                'class' => 'form-control',
                                'rows' => '5'
                            ])
                        ]])


        <div class="text-center">

            <input type="submit" class="btn btn-primary btn-lg" value="Enregistrer">

        </div>
        {!! Form::close() !!}
    </div>


@endsection