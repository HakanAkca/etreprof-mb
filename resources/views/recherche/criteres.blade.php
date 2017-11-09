<div class="criteres">
	<div class="row">
		
		<div class="col-xs-6 col-sm-4 col-md-3">
			<label class=""><span class="hidden-xs hidden-sm">Par niveau :</span></label>
				{!! Form::select('niveau[]', $categories['niveaux_aplatis']->pluck('name','id'), (!empty($niveau) ? $niveau : null), ['class' => 'js-states form-control', 'multiple' => "multiple", 'id' => "niveau"]) !!}
		</div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par thématique :</span></label>
				{!! Form::select('thematique[]', $categories['thematique']->pluck('name','id'), (!empty($thematique) ? $thematique : null), ['class' => 'js-states forma-control', 'multiple' => "multiple", 'id' => "thematique"]) !!}
		</div>


		<div class="clearfix visible-xs"></div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par discipline :</span></label>
				{!! Form::select('discipline[]', $categories['discipline']->pluck('name','id'), (!empty($discipline) ? $discipline : null), ['class' => 'js-states form-control', 'multiple' => "multiple", 'id' => "discipline"]) !!}
		</div>


		<div class="clearfix visible-sm"></div>


		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par format :</span></label>
				{!! Form::select('format[]', $categories['format']->pluck('name','id'), (!empty($format) ? $format : null), ['class' => 'js-states form-control', 'multiple' => "multiple", 'id' => "format"]) !!}
		</div>

		<div class="clearfix visible-lg"></div>
		<div class="clearfix visible-md"></div>
		<div class="clearfix visible-xs"></div>


		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par durée de consultation :</span></label>
				{!! Form::select('duree', [ '' => '', '0-5' => 'Moins de 5 minutes', '6-15' => '6 à 15 minutes', '16-999' => 'Plus de 15 minutes' ], (!empty($duree) ? $duree : null), ['class' => 'js-states form-control', 'multple' => "multple", 'id' => "duree"]) !!}
		</div>


		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par usage :</span></label>
			
				{!! Form::select('usage[]', $categories['usage']->pluck('name','id'), (!empty($usage) ? $usage : null), ['class' => 'js-states form-control', 'multiple' => "multiple", 'id' => "usage"]) !!}
	
		</div>


		<div class="clearfix visible-xs"></div>
		<div class="clearfix visible-sm"></div>


		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par type d'activité :</span></label>
			
				{!! Form::select('groupe_individuel[]', $categories['groupe_individuel']->pluck('name','id'), (!empty($groupe_individuel) ? $groupe_individuel : null), ['class' => 'js-states form-control', 'multiple' => "multiple", 'id' => "groupe_individuel"]) !!}
	
		</div>

		<div class="col-xs-6 col-sm-4 col-md-3">
			<label><span class="hidden-xs hidden-sm">Par type de ressource :</span></label>
			
				{!! Form::select('theorique_pratique[]', $categories['theorique_pratique']->pluck('name','id'), (!empty($theorique_pratique) ? $theorique_pratique : null), ['class' => 'js-states form-control', 'multiple' => "multiple", 'id' => "theorique_pratique"]) !!}
	
		</div>

	</div>
</div>

@push('scripts')

	<script>
	function selectize() {
		$("#niveau").select2({
		  placeholder: "Tous les niveaux",
		  width: 'resolve',
		  'dropdownAutoWidth' : true
		});
		$("#thematique").select2({
		  placeholder: "Toutes les thématiques"
		});
		$("#discipline").select2({
		  placeholder: "Toutes les disciplines"
		});
		$("#format").select2({
		  placeholder: "Tous les formats"
		});
		$("#duree").select2({
		  placeholder: "Toutes les durées",
		  allowClear: true
		});
		$("#usage").select2({
		  placeholder: "Tous les usages"
		});
		$("#groupe_individuel").select2({
		  placeholder: "Tous les types d'activités"
		});
		$("#theorique_pratique").select2({
		  placeholder: "Tous les types de ressources"
		});
	}
	$('#criteres').on('shown.bs.collapse', function () {
	  	selectize();
	})
	$(function() {
		selectize();
	});
	</script>

@endpush