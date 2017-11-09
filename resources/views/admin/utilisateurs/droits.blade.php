@extends ('admin.layout')

@section('content')
	{!!  csrf_field() !!}

	<table class="table table-bordered table-striped text-center">


	@foreach ($groupes_droits as $groupe => $droits)

	<tr>
		<td colspan="{{ count($roles) +1 }}"><h3>{{ $groupe }}</h3></td>
	</tr>
	<tr>

		<th>Droit</th>
		@foreach ($roles as $role)

			<th>{{ $role->nom }}<br><small class="text-muted">{{ $role->code }}</small></th>

		@endforeach
	</tr>


		@foreach ($droits as $droit)
			<tr>

				<th>{{ $droit->description }}<br><small class="text-muted">{{ $droit->code }}</small></th>
				@foreach ($roles as $role)

					<td><input type="checkbox" class="box" data-id="{{ $role->id . '-' . $droit->id }}"
					@if (!empty($droits_roles[$role->id . '-' . $droit->id]))
						checked
					@endif
					>
					</td>

				@endforeach
			</tr>
		@endforeach
	@endforeach
	</table>

	<script>
	$(function() {
		$('.box').click(function() {
			console.log(this);
			$.post('/admin/utilisateurs/droits', { id: $(this).attr('data-id'), val : $(this).is(':checked'), _token : $('[name="_token"]').val() });
		});
	});
	</script>

@endsection