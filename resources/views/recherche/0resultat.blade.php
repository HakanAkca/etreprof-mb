<div class="alert alert-info">
	@include('bloc', ['bloc' => 'recherche-pas-resultat'])
	<br>

			{!! Form::open(['url' => action('RechercheController@postDemande'), 'id' => 'demande_recherche', 'class' => 'form-horizontal']) !!}

				<div class="text-center">
					<div class="col-sm-5">
					</div>

					<div class="col-sm-3">
					</div>

					{!! Form::hidden('recherche', $recherche) !!}
					{!! Form::hidden('url', url()->full()) !!}
					<button type="submit" class="btn btn-info btn-lg"><big>OUI</big><small>, envoyez-moi une sélection de contenus sur ce thème</small></button>
					<br><small>(C'est gratuit !)</small>
				</div>


			{!! Form::close() !!}
		</div>

@push('scripts')

	<script>
	$(function() {
		$('#demande_recherche').submit(function() {
			var msg = "Votre requête sera envoyée à l'équipe qui vous recontactera prochainement. Voulez-vous l'envoyer ?";
			if (confirm(msg)) {
				return true;
			}
			return false;
		});
	});
	</script>

@endpush