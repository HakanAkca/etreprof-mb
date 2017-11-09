@if (empty($blocs[$bloc]))
	@if ($blocs[$bloc] = App\Article::createBlock($bloc, (!empty($default) ? $default : null)))
	@endif
@endif

@include('admin.editer-bloc', ['bloc' => $blocs[$bloc]])
{!! $blocs[$bloc]->html !!}

