<div class="evaluation row">
    <div id="evaluation">
        <div class="membres col-xs-6 col-sm-6">
            <div class="br-wrapper br-theme-fontawesome-stars-o">
                <select id="example">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <p id="ma-note"></p>
        </div>
        <div class="public col-xs-6 col-sm-6">
            @include('contenus.section-favori')
        </div>
    </div>
</div>
{!! csrf_field() !!}

@push('scripts')
<script>

    var note = {!! $contenu->note !!}

    $(function () {
            $('#example').barrating({
                theme: 'fontawesome-stars',
                initialRating: note,
                onSelect: function (value, text, event) {
                    //console.log(value);
                    $('#ma-note').text('Votre note : ' + value);
                    $.post('/contenus/noter', {
                        'id': id,
                        'note': value,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function (json) {
                            console.log(json);
                        });
                }
            });
        });
</script>
@endpush