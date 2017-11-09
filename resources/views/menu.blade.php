<ul id="{{ $id or ''}}" class="{{ $class or ''}}">
	{!! $prepend or '' !!}
	@foreach ($menu as $item)
		<li role="presentation" class="{{ ((!empty($activeMenu) && $activeMenu == $item->url) || (!empty($activeMenuTrail) && $activeMenuTrail == $item->url)) ? 'active' : '' }}"><a href="{{ $item->url }}" target="{{ $item->target or ''}}">{!! $item->text !!}</a>
		@if (count($item->children) > 0)
		<ul class="">
			@foreach ($item->children as $child)
				<li class="{{ (!empty($activeMenu) && $activeMenu == $child->url) ? 'active' : '' }}"><a href="{{ $child->url }}" target="{{ $item->target or ''}}">{!! $child->text !!}</a></li>
			@endforeach
		</ul>
		@endif
		</li>
	@endforeach
	{!! $append or '' !!}
</ul>
