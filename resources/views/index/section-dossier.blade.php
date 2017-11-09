@if (!empty($dossier_une))
	<div class="dossier-une">
	@include('admin.boutons-editer',
	['if' => Auth::user()->possedeDroit('modifier_structure'),
	'url' => action('Admin\ArticlesController@modifier', ['theme', $dossier_une->id])
	])

		<a href="{{ $dossier_une->geturl() }}" class="body" style="background:linear-gradient(rgba(255, 255, 255, 0), rgba(34, 3, 88, 0.7)) no-repeat border-box, transparent url({{ $dossier_une->thumbnail }}) no-repeat center center;background-size: cover;">
			<div class="title">
				<h2>{{ $dossier_une->title }}</h2>
				<h3>{{ $dossier_une->excerpt }}</h3>
			</div>
		</a>
	</div>
@endif