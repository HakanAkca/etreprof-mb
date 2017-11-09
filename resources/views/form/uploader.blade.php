<div>
    <ul class="fichiers hidden">

        @php
            /*@if ($fichiers)

            @foreach ($fichiers as $fichier)
                <li data-id="{{ $fichier->id }}" data-effacable="{{ $fichier->effacable }}">{{ $fichier->nom }}</li>
            @endforeach

        @endif*/
        @endphp
    </ul>
</div>

<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<div id="container">
    <a id="pickfiles" name="image" href="javascript:;" class="btn btn-warning">{{ $bouton or 'Ajouter un fichier' }}</a>
    <!--a id="uploadfiles" href="javascript:;">[Upload files]</a-->
</div>


<script type="text/javascript" src="/js/plupload-2.3.1/js/plupload.full.min.js"></script>


<script type="text/javascript">
    $(function () {
        fichiers.maj();

        $('.fichiers').on('click', '.delete', function (e) {
            //console.log(e.target);
            var fichier = $(e.target).parents('li:first');
            var id = $(fichier).attr('data-id');
            var msg = 'Etes-vous sûr(e) de vouloir supprimer le fichier ' + id + ' ? Cette action est irréversible.';
            if (confirm(msg)) {
                //var self = this;
                fichiers.effacer(id).then(function (ret) {
                    if (ret.success) {
                        $(fichier).css('background', 'red').fadeOut();
                    } else {
                        alert(ret.droit);
                        //console.log(ret);
                    }
                });
                //console.log('Suppression');
            }
        });
    });
    // Custom example logic
    var fichiers = {
        maj: function () {
            $('.fichiers li').each(function () {
                $(this).find('.delete').remove();
                if ($(this).attr('data-effacable') == '1') {
                    $(this).append('&nbsp;<span class="glyphicon glyphicon-remove delete"></span>');
                }
            });
        },
        effacer: function (id) {
            return $.post('/piece-jointe/effacer',
                {
                    id: id,
                    _token: $('[name="_token"]').val()
                });
        }
    };

    /*var next = {
     callback: '',
     callCallback: function(callback, arg) {
     callback(arg);
     },
     };*/

    var folder = '{{$folder or ''}}';

    var extensions = {
        images: '{{ $images or '' }}',
        zip: '{{ $zip or '' }}',
        documents: '{{ $documents or '' }}'
    };


    var uploader = new plupload.Uploader({
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: 'pickfiles', // you can pass an id...
        container: document.getElementById('container'), // ... or DOM Element itself
        url: '/upload/envoyer',
        resize: {
            width: 500,
            height: 500,
        },
        flash_swf_url: '/js/plupload-2.3.1/js/Moxie.swf',
        silverlight_xap_url: '/js/plupload-2.3.1/js/js/Moxie.xap',

        filters: {
            max_file_size: '20mb',
            mime_types: [
                {title: "Images", extensions: extensions.images},
                {title: "Archive Zip", extensions: extensions.zip},
                {title: "Documents", extensions: extensions.documents},
            ]
        },

        multipart_params: {!! json_encode(array_merge(['folder' => $folder], [ '_token' => csrf_token() ])) !!},

        init: {
            PostInit: function () {
                $('#filelist').html('');

                /*document.getElementById('uploadfiles').onclick = function() {
                 uploader.start();
                 return false;
                 };*/
            },

            FilesAdded: function (up, files) {
                plupload.each(files, function (file) {
                    //document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                    $('.fichiers').append('<li id="' + file.id + '">' + file.name + '<b></b></li>');
                    uploader.start();
                });
            },

            /*UploadProgress: function(up, file) {
             //console.log('progress up', up);
             //console.log('progress file', file);
             //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
             $('#' + file.id + ' b').html('<span>' + file.percent + '%</span>');
             },*/

            FileUploaded: function (up, file, result) {
                //console.log('UploadComplete up', up);
                console.log('UploadComplete result', result);
                var response = JSON.parse(result.response);
                var fichier = response.result;
                console.log('UploadComplete fichier', fichier);
                $('#' + file.id).attr('data-id', fichier.id)
                    .attr('data-effacable', (fichier.effacable) ? 1 : 0);
                //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                fichiers.maj();
                //next.callCallback(next.callback, fichier);
                uploaderCallback(fichier);

            },

            Error: function (up, err) {
                //console.log('error');
                //console.log("Error #" + err.code + ": ", err);
                if (err.code == '-601') {
                    //console.log(this);
                    var formats = this.settings.filters.mime_types.map(function (i) {
                        return ( i.extensions.length) ? '- ' + i.title + ' (' + i.extensions + ')' : '';
                    });
                    //console.log(formats);
                    $('#filelist').append('Le format du fichier ' + err.file.name + ' n\'est pas correct. Vous pouvez envoyer des fichiers aux formats suivants :<br>' + formats.join('<br>'));
                }
            }
        }
    });

    uploader.init();

</script>