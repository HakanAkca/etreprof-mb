<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
CKEDITOR.stylesSet.add( 'my_styles', [
    // Inline styles.
    { name: 'Violet', element: 'span', attributes: { 'class': 'text-violet' } },
    { name: 'Bleu', element: 'span', attributes: { 'class': 'text-bleu' } },
    { name: 'Orange', element: 'span', attributes: { 'class': 'text-orange' } },
    { name: 'Gris', element: 'span', attributes: { 'class': 'text-gris' } },

]);

  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
    font_names: 'Lato;titre;script;',
    extraAllowedContent : 'area[!href,shape,title,alt,!coords] map[id,name] img[usemap]',
    height: 450,
    contentsCss : '/css/public.css',
    stylesSet : 'my_styles',
    toolbarGroups : [
    	{ name: 'mode'},
	    { name: 'undo' },
	    //{ name: 'clipboard',   groups: [ 'clipboard',		    'undo' ] },
	    //{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
	    { name: 'links' },
	    { name: 'insert' },
	    //{ name: 'forms' },
	    { name: 'tools' },
	    //{ name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
	    //{ name: 'others' },
	    //'/',
	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', //'bidi'
	    ] },
	    { name: 'styles' },
	    { name: 'colors' },
	    { name: 'about' }
	]
  };
</script>
<script>
$(function() {
    CKEDITOR.replace( '{{ $id }}', options);
    $('.lfm_open').filemanager('image');
});
</script>
