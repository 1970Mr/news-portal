@extends('auth::layouts.master', ['title' => 'تایید ایمیل'])

@section('content')
    <p class="text-center m-t-30 m-b-40">
        <i class="icon-check border img-circle font-xxxlg p-20"></i>
    </p>
    <h2 class="text-center m-b-20">تایید ایمیل</h2>

    @if(session()->has('success'))
        <div class="alert alert-{{ session()->get('success')[1] ? 'success' : 'info'}}">
            <i class="icon-{{ session()->get('success')[1] ? 'check' : 'info'}}"></i>
            {{ session()->get('success')[1] }}
        </div>
    @endif

    <hr>

    <form id="form" class="m-t-30 m-b-30" action="{{ route('verification.send') }}" method="POST" role="form">
        @csrf

        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block m-t-20">
                <i class="icon-envelope-letter"></i>
                ارسال لینک تایید ایمیل
            </button>
        </div><!-- /.form-group -->
    </form>

    <hr class="m-b-30">
    <a href="{{ route('home.index') }}" class="btn btn-info btn-block m-b-10">
        <i class="icon-home"></i>
        بازگشت به خانه
    </a>
@endsection

@push('scripts')
    <!-- PAGE JAVASCRIPT -->
    <script src="{{ asset('admin/assets/js/pages/login.js') }}"></script>
    <!-- END PAGE JAVASCRIPT -->
@endpush
