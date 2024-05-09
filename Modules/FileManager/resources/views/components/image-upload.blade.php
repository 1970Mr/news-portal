{{--<x-file-manager-image-upload />--}}

<div>
    <!-- Button to open image upload modal -->
    <x-file-manager-image-upload-btn :hideBtn="$hideBtn" />

    <!-- Image Upload Modal -->
    <div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageUploadModalLabel">آپلود تصویر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="alert alert-danger fade show m-3" id="errorAlert" style="display: none;">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <i class="icon-close"></i>
                    <strong>خطا!</strong>
                    <div id="errorMessages"></div>
                </div>

                <form id="imageUploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group relative col-lg-6">
                                <label>تصویر <small>(ضروری)</small></label>
                                <div class="input-group round">
                                    <input type="text" class="form-control file-input" placeholder="برای آپلود کلیک کنید">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            آپلود تصویر</button>
                                    </span>
                                </div><!-- /.input-group -->
                                <input type="file" class="form-control" name="image" required>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="altText">متن جایگزین <small>(ضروری)</small></label>
                                <input id="altText" class="form-control" name="altText" type="text" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="title">عنوان</label>
                                <input id="title" class="form-control" name="title" type="text">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="description">توضیحات</label>
                                <input id="description" class="form-control" name="description" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-success">آپلود تصویر</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error').removeClass("has-success");
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass("has-success");
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("#imageUploadForm").validate();

        $(document).ready(function () {
            $('#imageUploadForm').submit(function (event) {
                event.preventDefault();

                if (!$(this).valid()) {
                    return false;
                }

                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route(config('app.panel_prefix', 'panel') . '.images.upload') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#imageUploadModal').modal('hide');
                        $('#imageUploadForm')[0].reset();
                        $('#errorAlert').hide();
                        $('.help-block').text('');
                        $('.has-error').removeClass("has-error")
                        $('.has-success').removeClass("has-success")
                    },
                    error: function(xhr, status, error) {
                        let errorMessages = xhr.responseJSON.errors;
                        $('#errorAlert').show();
                        let errorContainer = $('#errorMessages');
                        errorContainer.empty(); // Clear previous error messages
                        for (const [key, message] of Object.entries(errorMessages)) {
                            errorContainer.append('<p>' + message[0] + '</p>');
                        }
                    }
                });
            });
        });
    </script>
@endpush
