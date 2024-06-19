{{--<x-file-manager-image-selector/>--}}

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
                    <h5 class="modal-title" id="imageUploadModalLabel">آپلود تصویر</h5>
                    <x-file-manager-image-upload-btn/>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs mb-3" id="filterTabs">
                        <!-- Filter tabs will be loaded here -->
                    </ul>
                    <div class="row justify-content-center gap-3" id="imageContainer">
                        <!-- Images will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-file-manager-image-upload :hideBtn="true"/>

@push('scripts')
    <script>
        // Function to select image
        function selectImage(imageSrc, imageId) {
            document.getElementById('selectedImage').value = imageSrc;
            document.getElementById('selectedImageId').value = imageId;
            $('#imageModal').modal('hide');
        }

        // Function to show modal and fetch images based on selected filter
        function showModal(filter = null) {
            $('#imageModal').modal('show');
            removeActivateTabClass()
            activateFirstTab()
            fetchImages(filter);
        }

        // Function to fetch images via API based on selected filter
        function fetchImages(filter = null) {
            const url = filter ? "{{ route(config('app.panel_prefix', 'panel') . '.images.selector') }}?filter=" + filter : "{{ route('image.selector') }}";
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const imagesContainer = document.getElementById('imageContainer');
                    imagesContainer.innerHTML = ''; // Clear previous images

                    data.images.forEach(image => {
                        const img = document.createElement('img');
                        img.src = "{{ asset('storage/') }}" + image.file_path;
                        img.alt = image.alt_text;
                        img.classList.add('img-thumbnail', 'img-fluid', 'custom-img', 'cursor-pointer');
                        img.addEventListener('click', () => selectImage("{{ asset('storage') }}/" + image.file_path, image.id));
                        imagesContainer.appendChild(img);
                    });
                })
                .catch(error => console.error('Error fetching images:', error));
        }

        // Function to fetch filters via API
        function fetchFilters() {
            const url = "{{ route(config('app.panel_prefix', 'panel') . '.images.selector.filters') }}";
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    populateFilterTabs(data.filters);
                })
                .catch(error => console.error('Error fetching images:', error));
        }

        // Function to populate filter tabs
        function populateFilterTabs(filters) {
            const filterTabs = document.getElementById('filterTabs');
            if (!filters) {
                filterTabs.style.display = 'none'; // Hide filter tabs if filters are null
                return;
            }

            for (const [key, value] of Object.entries(filters)) {
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.classList.add('nav-link');
                // if(filters.all === value) {
                //     a.classList.add('active');
                // }
                a.classList.add('nav-link');
                a.href = "javascript:void(0)";
                a.textContent = value;
                a.addEventListener('click', () => showModal(key));
                a.addEventListener('click', (event) => activateTab(event.target));
                li.classList.add('nav-item');
                li.appendChild(a);
                filterTabs.appendChild(li);
            }
        }

        function activateTab(clickedTab) {
            removeActivateTabClass()
            clickedTab.classList.add('active');
        }

        function removeActivateTabClass() {
            const tabs = getAllTabs()
            tabs.forEach(tab => tab.classList.remove('active'));
        }

        function activateFirstTab() {
            const tabs = getAllTabs()
            tabs[0].classList.add('active');
        }

        function getAllTabs() {
            const filterTabs = document.getElementById('filterTabs');
            return filterTabs.querySelectorAll('.nav-link');
        }

        function showModalNextComponent() {
            $('#testtest').click();
        }

        $('#nextModalButton').on('click', function () {
            // $('#imageModal').modal('hide');
            // $('#imageModal').on('hidden.bs.modal', function (e) {
            //     $(this).removeData('bs.modal');
            // });
            $('button[data-bs-target="#imageUploadModal"]').click();
        });


        // Populate filter tabs on load
        window.onload = fetchFilters;
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
