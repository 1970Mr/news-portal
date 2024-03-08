<!-- BEGIN JS -->
<script src="{{ asset('admin/assets/plugins/jquery/dist/jquery-3.6.1.min.js') }}"></script>
<script>
    {{--  Prevent change display to none when click on the dropdown menu  --}}
    $(document).ready(function () {
        $(".custom-dropdown-menu").on("click", function (e) {
            e.stopPropagation();
        });
    });
</script>
<script src="{{ asset('admin/assets/plugins/bootstrap/bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/metisMenu/dist/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/paper-ripple/dist/PaperRipple.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/screenfull/dist/screenfull.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/switchery/dist/switchery.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/jquery-validation/src/localization/messages_fa.js') }}"></script>
<script src="{{ asset('admin/assets/js/core.js') }}"></script>
