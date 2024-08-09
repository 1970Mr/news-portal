<script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/ckeditor.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/ckeditor5-document-editor/translations/fa.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/UploadAdapter.js') }}"></script>

<script>
    function CustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new UploadAdapter(loader, '{{ route(config('app.panel_prefix', 'panel') . '.images.upload') }}', '{{ csrf_token() }}');
        };
    }

    $(document).ready(function () {
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [CustomUploadAdapterPlugin],
                language: 'fa',
                direction: 'rtl',
                fontFamily: {
                    'default': 'IranSans, Arial, sans-serif',
                },
            })
            .then(editor => {
                editor.setData('{!! old('body') !!}');
                editor.model.document.on('change:data', () => {
                    document.querySelector('input[name="body"]').value = editor.getData();
                });
                const toolbarContainer = document.querySelector('#toolbar-container');
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
