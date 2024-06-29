<button class="btn btn-sm btn-secondary btn-icon round d-flex justify-content-center align-items-center copy-link-button"
        data-url="{{ $url }}"
        rel="tooltip" aria-label="کپی لینک" data-bs-original-title="کپی لینک">
    <i class="far fa-copy"></i>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.copy-link-button').forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                navigator.clipboard.writeText(url).then(() => {
                    swal.fire({
                        icon: 'success',
                        title: 'کپی شد!',
                        text: 'لینک با موفقیت کپی شد.',
                        confirmButtonText: 'باشه'
                    });
                }).catch(err => {
                    Sweetalert2.fire({
                        icon: 'error',
                        title: 'خطا!',
                        text: 'کپی کردن لینک با خطا مواجه شد.',
                        confirmButtonText: 'باشه'
                    });
                });
            });
        });
    });
</script>
