<script src="{{ asset('admin/assets/plugins/tinymce7/tinymce.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/TinymceImageUploader.js') }}"></script>

<script>
    const uploader = new TinymceImageUploader('{{ route(config('app.panel_prefix', 'panel') . '.images.upload') }}', '{{ csrf_token() }}')

    tinymce.init({
        selector: '#tinymce-editor',
        plugins: 'lists advlist autolink link image charmap preview anchor searchreplace visualblocks visualchars code fullscreen insertdatetime media table code help wordcount accordion ' +
            'emoticons directionality pagebreak autoresize',
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | ltr rtl | bullist numlist outdent indent | link image media | code preview',
        language: 'fa',
        license_key: 'gpl',
        convert_urls: false,
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
        font_family_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans ' +
            'MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; IranSans="IranSans",Arial,sans-serif; Symbol=symbol; Tahoma=tahoma,arial,' +
            'helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats',
        content_style: "body { font-family: 'IranSans', Arial, sans-serif; }",
        content_css: '{{ asset('admin/assets/css/custom-font-styles.css') . ',' . asset('admin/assets/plugins/bootstrap/bootstrap5/css/bootstrap.rtl.min.css') }}',
        images_upload_handler: (blobInfo, progress) => uploader.uploadHandler(blobInfo, progress),
    });
</script>
