<div class="evaluation row">
    <div id="evaluation">
        <div class="membres col-xs-6 col-sm-6">
            <div class="stars">
                <div class="stars-on" :style="{width: percent + '%'}"></div>
            </div>
        </div>
        <div class="public col-xs-6 col-sm-6">
            <p>Ce contenu m'a été utile :
                <button @click="vote('up')" class="vote btn btn-sm btn-primary clickevent"
                        data-event="contenu:vote:utile" data-origin="{{ url()->full() }}">OUI (@{{up}})
                </button>
                <button @click="vote('down')" class="vote btn btn-sm btn-info clickevent"
                        data-event="contenu:vote:inutile" data-origin="{{ url()->full() }}">NON (@{{down}})
                </button>
            </p>
        </div>
    </div>
</div>
{!! csrf_field() !!}

@push('scripts')

<script>

    var up = {!! $contenu->score_upvote !!},
        down = {!! $contenu->score_downvote !!},
        avis = {!! $contenu->score_avis !!},
        id = {!! $contenu->id !!};

    var voteVue = new Vue({
        el: '#evaluation',
        data: {
            up: up,
            down: down,
            avis: avis,
            id: id
        },
        computed: {
            percent: function () {
                return this.avis / 5 * 100;
            }
        },
        methods: {
            vote: function (val) {
                var that = this;
                that.$data[val] += 1;
                $.post('/contenus/voter', {
                    'id': id,
                    'vote': val,
                    '_token': $('input[name="_token"]').val()
                })
                    .done(function (json) {
                        if (typeof(json.avis) !== 'undefined') {
                            that.up = json.up;
                            that.down = json.down;
                            that.avis = json.avis;
                        }
                        console.log(json);
                    });
            }
        }
    });
</script>
@endpush