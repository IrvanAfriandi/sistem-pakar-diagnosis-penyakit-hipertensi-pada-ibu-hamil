<!DOCTYPE html>
<html lang="id">
<head>
     @include('includes.header')
</head>
<body>
    @if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ $message }}',
            timer: 5000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
        });
    </script>
@endif
@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ $message }}',
            timer: 5000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
        });
    </script>
@endif
    <div class="container-fluid">
        <div class="row">
          @include('includes.leftmenu')
          @yield('content')
        </div>
    </div>
  @include('includes.footer')
  @stack('scripts')
</body>
</html>
    