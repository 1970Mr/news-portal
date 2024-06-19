{{--<x-common-error-messages />--}}

@if(session()->has('errors'))
    <div {{ $attributes->merge(['class' => 'alert alert-danger fade show']) }}>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="icon-close"></i>
        <strong>خطا!</strong>
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
