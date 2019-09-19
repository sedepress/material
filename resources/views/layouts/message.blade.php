<script>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        swal("{{ session()->get($msg) }}")
    @endif
    @endforeach
</script>
