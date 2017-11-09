@extends ('layout')

@section('content')

    @if ($r)
        @include('bloc', ['bloc' => 'profil-intro', 'default' => '<h2>Encore une petite minute...</h2><p>Aidez-nous à mieux vous connaître en répondant aux quelques questions ci-dessous. Cela nous aidera à vous proposer des contenus plus adaptés.</p>'])
    @endif

    @if (minimum_version('1.0.0'))
    <div class="panel panel-info" id="profil">

        <div class="panel-heading">
            <h1>Votre photo</h1>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="thumbnail" id="image">
                        <div class="avatar"
                             v-bind:style="{'background-image': 'url(' + currentImage + ')'}">
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" v-if="image" @click="majImage()">Enregistrer</button>
                            <button class="btn btn-default" v-if="image" @click="annuler()">Annuler</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    @include('form.uploader', ['folder' => 'user', 'bouton' => 'Envoyer une image', 'images' => 'jpg,png,jpeg,gif,svg'])
                </div>
            </div>
        </div>
    </div>
    @endif

    <div id="vue">
        {!! Form::model($user, ['url' => action('ProfilController@modifier', ['r' => $r]), 'class' => 'form-horizontal']) !!}

        <div class="panel panel-info">

            <div class="panel-heading">
                <h1>Votre profil</h1>
            </div>

            <div class="panel-body">


                @include('form.element', [ 'element' => [
                    'Prénom',
                    Form::text('prenom', null, [
                        'class' => 'form-control'
                    ])
                ]])


                @include('form.element', [ 'element' => [
                    'Nom',
                    Form::text('nom', null, [
                        'class' => 'form-control'
                    ])
                ]])

                @include('form.element', [ 'element' => [
                    'Code postal',
                    Form::text('codepostal', null, [
                        'class' => 'form-control'
                    ])
                ]])

                @include('form.element', [ 'element' => [
                    'Pays',
                    Form::text('pays', null, [
                        'class' => 'form-control'
                    ])
                ]])

                <div class="form-group">

                    <label class="col-sm-4 control-label">
                        Votre niveau de classe
                    </label>

                    <div class="col-sm-7" id="niveaux">
                        @foreach ($niveaux as $niveau)
                            @if ($niveau->parent == 0)
                                <div class="row" id="niveau_{{ str_slug($niveau->name) }}">
                                    <div class="col-md-3"><label class="control-label">{{ $niveau->name }}</label>
                                    </div>
                                    <div class="col-md-9">
                                        @foreach ($niveau->childrens as $classe)
                                            {!! Form::checkbox('niveau[]', $classe->id, null) !!}
                                            <span>{!! $classe->name !!}</span> &nbsp; &nbsp; &nbsp; &nbsp;
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div id="profil-secondaire" class="alert alert-info" style="display:none">

                    @include('bloc', ['bloc' => 'profil-secondaire', 'default' => '<p>Dans la version bêta du site etreprof, les ressources ont été sélectionnées par et pour des enseignant·e·s du primaire. Il est donc possible que vous ne trouviez pas votre bonheur tout de suite...</p>
                    <p>Attendez ! Le site EtreProf propose de nombreuses ressources transverses. Et, à terme, il couvrira aussi le secondaire. Si vous souhaitez contribuer à enrichir le site de ressources pour le secondaire, il vous suffit de compléter votre profil puis de cliquer sur "rejoignez-nous".</p>'])

                </div>

            </div>
        </div>

        @if (minimum_version('0.9.2'))
            @foreach ($questions as $question)
                <div class="panel panel-info form-garoup form-{{ $question['code'] }}">

                    <div class="panel-heading">
                        <h3 class="col-sm- conatrol-label">
                            {{ $question['question'] }}

                        </h3>
                    </div>
                    <div class="panel-body">
                        @if (!empty($question['description']))
                            <p>
                                <small>{!! $question['description'] !!}</small>
                            </p>
                        @endif

                        <div class="col-asm-8">

                            @if ($question['format'] == "select")

                                <label>
                                    {!! Form::select('profil[' . $question['code'] . ']', $question['reponses'], null, ['class' => 'form-control', 'required' => (!empty($question['required'])) ? true : null]) !!}
                                </label>

                            @elseif ($question['format'] == "image")

                                <select name="profil[{{ $question['code'] }}]" class="image-picker"
                                        @if (!empty($question['required'])) required="true" @endif>
                                    <option></option>
                                    @foreach ($question['reponses'] as $key => $val)

                                        <option data-img-src="{{ $val }}" data-img-class=""
                                                data-img-alt="{{ $key }}"
                                                value="{{ $key }}"
                                                @if (!empty($user->profil[$question['code']]) && $user->profil[$question['code']] == $key) selected @endif>{{ $key }}</option>

                                    @endforeach
                                </select>

                            @elseif ($question['format'] == "checkbox")
                                {!! Form::hidden('profil['. $question['code'] . '][99]', null) !!}
                                @foreach ($question['reponses'] as $key => $val)

                                    <label>
                                        {!! Form::checkbox('profil[' . $question['code'] . '][]', $key, null, ['required' => (!empty($question['required'])) ? true : null]) !!}
                                        <span>{!! $val !!}</span> &nbsp;
                                        @if ($key == 'autre')
                                            {!! Form::text('profil[' . $question['code'] . '_autre]', null, ['class' => '']) !!}
                                        @endif
                                        &nbsp; &nbsp; &nbsp;
                                    </label>

                                @endforeach

                            @elseif ($question['format'] == "rank")

                                <div class="col-xs-12 col-sm-8">{{ $question['notice'] }}</div>
                                @foreach ($question['scores'] as $score => $label)
                                    <label class="col-xs-3 col-sm-1">
                                        {!! $label !!}
                                    </label>
                                @endforeach

                                @foreach ($question['reponses'] as $key => $val)

                                    <h4 class="col-xs-12 col-sm-8">{{ $val }}</h4>
                                    @foreach ($question['scores'] as $score => $label)
                                        <label class="col-xs-3 col-sm-1">
                                            {!! Form::radio('profil['. $question['code'] . '][' . $key . ']', $score, null, [
                                                'required' => (!empty($question['required'])) ? true : null,
                                                'class' => 'rank-grid',
                                                'data-unique' => $question['code']]) !!}
                                            &nbsp;

                                        </label>
                                    @endforeach

                                @endforeach

                            @else

                                @foreach ($question['reponses'] as $key => $val)

                                    <label>
                                        {!! Form::radio('profil['. $question['code'] . ']', $key, null, ['required' => (!empty($question['required'])) ? true : null]) !!}
                                        <span>{!! $val !!}</span> &nbsp;
                                        @if ($key == 'autre')
                                            {!! Form::text('profil[' . $question['code'] . '_autre]', null, ['class' => '']) !!}
                                        @endif
                                        &nbsp; &nbsp; &nbsp;
                                    </label>

                                @endforeach

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        @endif

        <div class="text-center">

            <input type="submit" class="btn btn-primary btn-lg" value="Enregistrer">

        </div>
        {!! Form::close() !!}
    </div>

    @if (minimum_version('1.0.0'))
    <!--div class="panel panel-info" id="profil">

        <div class="panel-heading">
            <h1>Vos test</h1>
            <button class="btn btn-primary"><a href="/diagnostic/resultat">Mes diagnostics</a></button>
        </div>
    </div-->
    @endif

    <script src="/image-picker/image-picker.min.js"></script>
    <link rel="stylesheet" href="/image-picker/image-picker.css">
    <script>
        $(function () {
            $('.image-picker').imagepicker();

            $('.rank-grid').click(function () {

                var val = $(this).val();
                var key = $(this).attr('data-unique');
                console.log(this, key, val);
                $('.rank-grid[data-unique="' + key + '"]').not(this).each(function () {
                    console.log($(this).val());
                    if ($(this).val() == val) {
                        $(this).prop('checked', false);
                    }
                });
            });

            $('#niveaux').on('click change', 'input', function () {
                if ($('#niveau_college input:checked').length + $('#niveau_lycee input:checked').length > 0) {
                    $('#profil-secondaire').slideDown();
                } else {
                    $('#profil-secondaire').slideUp();
                }
            });
            $('#niveaux input:first').change();
        });

        var defaultImage = '{{$user->image}}';

        var imageVue = new Vue({
            'el': '#image',
            'data': {
                defaultImage: defaultImage,
                image: null
            },
            computed: {
                currentImage: function () {
                    return this.image ? this.image : this.defaultImage;
                }
            },
            methods: {
                majImage: function () {
                    var that = this;
                    $.post(
                        '/profil/maj-image', {
                            image: this.image,
                            '_token': $('input[name="_token"]').val()
                        })
                        .done(function () {
                            that.defaultImage = that.image;
                            that.image = null
                        });
                },
                annuler: function () {
                    this.image = null;
                }
            }
        });

        function uploaderCallback(msg) {
            console.log(msg);
            imageVue.image = msg;
        }
    </script>

@endsection


