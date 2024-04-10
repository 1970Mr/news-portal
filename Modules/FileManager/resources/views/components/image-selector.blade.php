<div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" class="form-control" id="selectedImageId">
                <input type="text" class="form-control cursor-pointer" id="selectedImage" readonly onclick="showModal()" placeholder="یک تصویر انتخاب کنید...">
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">انتخاب تصویر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center gap-3">
                        @foreach($images as $image)
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->alt_text }}" class="img-thumbnail img-fluid custom-img"
                                 onclick="selectImage('{{ asset('storage/' . $image->file_path) }}', '{{ $image->id }}')">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Function to select image
        function selectImage(imageSrc, imageId) {
            document.getElementById('selectedImage').value = imageSrc;
            document.getElementById('selectedImageId').value = imageId;
            $('#imageModal').modal('hide');
        }

        // Function to show modal
        function showModal() {
            $('#imageModal').modal('show');
        }
    </script>
@endpush

@push('styles')
    <style>
        .custom-img {
            object-fit: cover;
            width: auto;
            height: 200px;
            margin-bottom: 10px;
        }
    </style>
@endpush
