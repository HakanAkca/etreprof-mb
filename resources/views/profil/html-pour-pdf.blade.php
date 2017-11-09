<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>

    <script src="/js/diagnostic.js"></script>
    <style>

        html {
            font-size: 80%;
        }
        * {
            max-width: 100%;
        }
        table {
            font-size: 8pt;
        }

    </style>
</head>
<body>

@foreach($htmlMessage as $html)

    <p>{!! $html->message !!}</p>

@endforeach

<script>
    document.getElementById('cadreComp').style.display = 'block';
</script>

</body>
</html>
