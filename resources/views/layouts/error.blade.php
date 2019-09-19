@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
        swal("{{ $error }}")
        @endforeach
    </script>
@endif
