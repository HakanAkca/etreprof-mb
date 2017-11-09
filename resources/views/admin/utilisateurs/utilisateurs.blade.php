@extends ('layout')

@section('content')
	{!!  csrf_field() !!}

	<table class="table table-bordered table-striped">


	@foreach ($groupes as $groupe => $utilisateurs)

	<tr>
		<td colspan="3"><h3>{!! ($utilisateurs[0]->role) ? $utilisateurs[0]->role->nom . ' <small>(' . $utilisateurs[0]->role->code . ')</small>' : 'Aucun rôle' !!}</h3></td>
	</tr>
	<tr>

		<th>#</th>
		<th>Utilisateur</th>
		<th>E-mail</th>
		<th>Périmètre</th>
		<th>Dernière action</th>
		<th>Dernière connexion</th>
		<th>Action</th>


	</tr>


		@foreach ($utilisateurs as $utilisateur)
			<tr>
				<td>{{ $utilisateur->id }}</td>
				<td>
				<strong>{{ $utilisateur->nom_complet }}</strong>
				<small>{{ $utilisateur->username }}</small>
				</td>
				<td>{{ $utilisateur->email }}</td>
				<td>{{ $utilisateur->liste_organisations  }}</td>

				<td><small>{{ date('d M Y H:i', strtotime($utilisateur->updated_at)) }}</small></td>
				<td><small>{{ date('d M Y H:i', strtotime($utilisateur->last_login)) }}</small></td>
				<td>
				@if ($utilisateur_peut_affecter_roles)
					<a href="/admin/droits-utilisateur/<?= $utilisateur->id; ?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span> Droits</a>
				@endif
				</td>
			</tr>
		@endforeach
	@endforeach
	</table>

	<script>
	$(function() {
		$('.box').click(function() {
			console.log(this);
			$.post('/admin/droits', { id: $(this).attr('data-id'), val : $(this).is(':checked'), _token : $('[name="_token"]').val() });
		});
	});
	</script>

@endsection