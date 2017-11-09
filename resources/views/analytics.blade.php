@if (env('APP_ENV') != 'development')

	@if (Auth::user() AND Auth::user()->id)
	<script type="text/javascript">
		$('body').on('click', '.clickevent', function(e) {
			//e.preventDefault();
			var href = ($(this).attr('data-origin')) ? $(this).attr('data-origin') : this.href;
			var title = ($(this).attr('data-event')) ? $(this).attr('data-event') : this.this.innerText;
			console.log('clicky.log("' + href + '", "' + title+'")');
			return clicky.log(href, title);
			return false;
		});
	  var clicky_custom = {};
	  //clicky_custom.href = '/some/page?some=query';
	  //clicky_custom.title = 'Some page';
	  
	  clicky_custom.session = {
	    username: '{{ Auth::user()->name }}',
	    email: '{{ Auth::user()->email }}'
	  };
	  @if (!empty($profil)) 
	  	clicky_custom.session.profil = '{{ $profil }}';
	  @endif
	  clicky_custom.timer = 200;
	</script>
	@endif

	<a title="Real Time Analytics" href="http://clicky.com/101040726"><!--img alt="Real Time Analytics" src="//static.getclicky.com/media/links/badge.gif" border="0" /--></a>
	<script src="//static.getclicky.com/js" type="text/javascript"></script>
	<script type="text/javascript">try{ clicky.init(101040726); }catch(e){}</script>
	<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/101040726ns.gif" /></p></noscript>


	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-43049438-5', 'auto');
	  
	  @if (!empty($profil)) 
	  	ga('set', 'dimension1', '{{ $profil }}');
	  @endif

	  @if (!empty(Auth::user()))
	  ga('set', 'userId', '{{ Auth::user()->id }}'); // Set the user ID using signed-in user_id.
	  @endif

	  ga('send', 'pageview');
	  
	</script>
@endif

