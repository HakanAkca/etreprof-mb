@extends ('layout')

@section('content')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>

    <script src="/js/diagnostic.js"></script>

    @foreach($htmlMessage as $html)

        <p>{!! $html->message !!}</p>

    @endforeach

    <a class="btn btn-primary telecharger" id="telecharger" href="{{action('DiagnosticController@pdf', [$id, str_random(16)])}}">Generer votre PDF</a>

@endsection

@push('scripts')
<script>
        $('#telecharger').click(function () {
            $('#telecharger').attr('disabled', 'disabled');
            return true;
        });

</script>
<script>
    document.getElementById('cadreComp').style.display = 'block';
</script>

@endpush