<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1.0"/>

    <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Lang" content="fr">
    <meta name="author" content="">
    <meta http-equiv="Reply-to" content="@.com">
    <meta name="generator" content="PhpED 8.0">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="">
    <meta name="creation-date" content="09/06/2012">
    <meta name="revisit-after" content="15 days">
    <title>@yield('title', 'Etre Prof')</title>
    <link rel="stylesheet" type="text/css" href="/css/public.css?m={{ filemtime(public_path('css/public.css')) }}">
    @stack('css')
    <script src="/js/app.js?m={{ filemtime(public_path('js/app.js')) }}"></script>
    @include('cookie-consent')
</head>
<body class="@yield('class')">
<div id="publicVue">
    {!! csrf_field() !!}


    <div class="main">

        <div class="contaaaainer">
            <div class="page-header">

                <div class="nav navbar">

                    <div id="logo"><a href="/"><img src="/img/logo-violet.png" alt="Accueil"></a></div>

                    <div class="">
                        <div class="">
                            @include('menu', ['menu' => $menuHaut, 'id' => 'identite', 'class' => 'menu-haut', 'append' => '<li><a href="/profil">'. ((!empty($user->name)) ? $user->name : 'anonyme') . '</a></li>
                            <li><a href="/quitter" class="logout">Quitter</a></li>'])
                        </div>

                        @if (!empty($user) AND $user->possedeDroit('acces_front'))
                            <div style="clear:right">
                                @include('menu', ['menu' => $menuPrincipal, 'id' => 'menu-principal', 'class' => 'menu-haut'])
                            </div>
                        @endif
                        <div class="boutons text-center">

                        </div>


                    </div>

                </div><!-- .page-header -->
            </div><!-- .container -->


            @include('recherche.bandeau')

            <div class="container">


                <!--div class="panel">
                    <div class="panel-body"-->

                @include('flash-message')

                <div id="content">
                    @section('content')

                    @show
                </div>
                <!--/div>
            </div-->
            </div>

            @if (!empty($user) && $user->possedeDroit('acces_front'))
                <div id="footer" class="menu-footer">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-3 col-sm-6 hidden-xs" id="footer-col1">
                                @include('bloc', ['bloc' => 'footer-col1'])
                            </div>

                            @foreach ($menusFooter as $i => $menu)
                                <div class="col-md-3 col-sm-6" id="footer-col{{ (2 + $i) }}">
                                    @include('bloc', ['bloc' => 'footer-col' . (2 + $i++)])
                                    @include('menu', ['menu' => $menu])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="subfooter">
                <div class="text-center text-muted">
                    @include('bloc', ['bloc' => 'footer-credits'])
                </div>
            </div>

        </div><!-- .container -->
    </div><!-- .main -->

    <div id="feedbackVue">
        <modal-container></modal-container>
        <feedback-button></feedback-button>
    </div>

</div><!-- #publicVue -->

@if (minimum_version('1.0.0') AND empty($masquerChat))
    @include('discussions.popup')
    @include('discussions.discussion')
@endif
@include('analytics')
</body>

@stack('scripts')

</html>
