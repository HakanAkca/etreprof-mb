@if ($contenu->id && Auth::user()->peutSupprimerContenu($contenu))
<div class="text-center">
	{!! Form::open(['url' => 'admin/contenus/supprimer']) !!}
		{!! Form::hidden('id', $contenu->id) !!}
		<button type="submit" class="btn btn-small btn-link"><span class="glyphicon glyphicon-remove"></span> Effacer ce contenu</button>
	{!! Form::close() !!}
</div>
@endif