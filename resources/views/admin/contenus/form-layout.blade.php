@extends('admin.layout')


<ul class="nav nav-tabs">
<?php $etapes = array(
    'liens' => 'Liens',
    'identite' => 'Fiche d\'identité',
    'avis' => 'Votre avis',
    'publier' => 'Publier',
    );
    $i = 1;
     ?>
    @foreach ($etapes as $action => $titre)
        <li class="etape @if(!empty($etape) && $etape == $action)
        active
        @endif
        "><a href="/admin/contenus/{{ $action }}"><span class="nb">{{ $i++ }}</span> {{ $titre }}</a></li>
    @endforeach
</ul>

@include('form.errors')

@section('content')

@endsection