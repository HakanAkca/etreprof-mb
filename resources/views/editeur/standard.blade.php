<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
	$(function() {
        CKEDITOR.replace( '{{ $id or 'ckeditor' }}' );
	});
    </script>