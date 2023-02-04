<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Business-Book</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
</head>

<body>

    @yield('content')
    @if ($errors->any())
        <div class="custom-float-alert alert alert-danger">
            <ul class="errorstyle">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('message'))
        <div class="custom-float-alert alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    @if (Session::has('error'))
        <div class="custom-float-alert alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif


    <script type="text/javascript">
        setTimeout(function() {
            $('.alert').fadeOut(1000, function() {
                $(this).alert('close');
            });
            $('.text-danger').fadeOut(1000, function() {
                $(this).alert('close');
            });
        }, 5000);
    </script>

</body>

</html>
