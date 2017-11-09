<ul class="nav nav-tabs">
<?php $etapes = array(
    'lien' => 'Liens',
    'identite' => 'Fiche d\'identité',
    'avis' => 'Votre avis',
    'publier' => 'Publier',
    );
    if (Auth::user()->possedeDroit('voir_historique_contenu'))
    {
		$etapes['historique'] = 'Historique';
	}
    $i = 1;
     ?>
    @foreach ($etapes as $action => $titre)
        <li class="etape @if(!empty($etape) && $etape == $action)
        active
        @endif
        "><a href="{{ ($contenu->id) ?  '/admin/contenus/' . $action . '/'  . $contenu->id : '#' }}"><span class="nb">{{ $i++ }}</span> {{ $titre }}</a></li>
    @endforeach
     <li class="etape">
     	<a href="{{ ($contenu->url()) }}?preview" target="_blank"><span class="nb">{{ $i++ }}</span> Prévisualiser</a></li>
</ul>

@include('form.errors')