<div class="alert alert-default">
	<div id="recherche_ameliorer">
	@include('bloc', ['bloc' => 'recherche-ameliorer', 'default' => 'Ça ne répond pas à votre recherche ? On peut s’améliorer, <a href="#">dites-le nous</a> !'])

			{!! Form::open(['url' => action('RechercheController@postDemande'), 'id' => 'demande_recherche', 'class' => 'form-horizontal']) !!}

			{!! Form::hidden('recherche', $recherche) !!}
			{!! Form::hidden('url', url()->full()) !!}

			{!! Form::close() !!}
	</div>
</div>

@push('scripts')

	<script>
	$(function() {
		$('#recherche_ameliorer').click(function() {
			var msg = "Votre requête sera envoyée à l'équipe qui vous recontactera prochainement. Voulez-vous l'envoyer ?";
			if (confirm(msg)) {
				$(this).find('form').submit();
			}
			return false;
		});
	});
	</script>

@endpush