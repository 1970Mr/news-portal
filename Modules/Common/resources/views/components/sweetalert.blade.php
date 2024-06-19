<script>
    @foreach($types as $type)
    @if(session()->has($type))
    swal(
        '',
        '{{ session()->get($type) }}',
        '{{ $type }}',
    );
    @endif
    @endforeach
</script>
