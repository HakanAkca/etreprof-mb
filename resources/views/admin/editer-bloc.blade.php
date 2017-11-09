@include('admin.boutons-editer',
	['if' => Auth::user() && Auth::user()->possedeDroit('modifier_structure'),
	'url' => action('Admin\ArticlesController@modifier', ['block', ($bloc) ? $bloc->id : null])
	])
