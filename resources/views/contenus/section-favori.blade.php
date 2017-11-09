    @push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    @endpush

    <div id="favori">
    <span>
            <span @click="click()">
                <i class="fa text-primary" v-bind:class="{ 'fa-heart-o' : !favori, 'fa-heart' : favori }"></i> <span class="text-primary">Favori</span>
            </span>
                    <a v-if="favori" href="{{action('ContenusController@favoris')}}"> | Mes Favoris</a>
    </span>
    </div>

    @push('scripts')
    <script>
        var contenu_id = {!! $contenu->id !!};
        var favori = {!! $favori !!} ;

        var favoriVue = new Vue({
            el: '#favori',
            data: {
                favori: favori,
                contenu_id: contenu_id
            },
            methods: {
                click: function () {
                    if (this.favori) {
                        return this.supprimerFavori();
                    }
                    return this.ajouterFavori();
                },
                ajouterFavori: function () {
                    var that = this;
                    $.post('/favori', {
                        'id': this.contenu_id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function () {
                            that.favori = 1;
                        });
                },
                supprimerFavori: function () {
                    var that = this;
                    $.post('/supprimer-favori', {
                        'id': this.contenu_id,
                        '_token': $('input[name="_token"]').val()
                    })
                        .done(function () {
                            that.favori = 0;
                        });
                },
            }
        });
    </script>
    @endpush

