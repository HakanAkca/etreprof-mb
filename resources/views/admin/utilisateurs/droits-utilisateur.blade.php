@extends ('layout')

@section('content')
<h1>Droits de l'utilisateur</h1>

<section>

<fieldset id="fieldset-role">
	<legend>Rôle</legend>

		{!! Form::open(['class' => 'form-horizontal']) !!}
		@each('demande.sub-form-element', [
			[
				'Rôle',
				Form::select('role_id', $roles, $user->role_id, ['required' => true, 'class' => 'form-control']),
				null
			]

		], 'element')

		@foreach ($organisations as $organisation)
			@include('demande.sub-form-element', [ 'element' =>
				[
					$organisation->nom,
					Form::checkbox('organisation_id[]', $organisation->id, in_array($organisation->id, $user->organisationsIds())),
					null
				]
			])
		@endforeach

		<div class="text-center row">
			<input type="submit" value="Enregistrer" class="btn btn-info btn-lg">
		</div>

		{!! Form::close() !!}
</section>


@endsection