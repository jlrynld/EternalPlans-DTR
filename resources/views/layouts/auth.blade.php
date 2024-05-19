<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTR</title>

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class ="mb-2 bg-body text-black">
    
<div class="align-items-center">
        <nav class="p-4 bg-dark">
            <div class="text-center">
                <a href="{{ route('sign-in.index') }}">
                    <img class="mx-auto logo" src="css/logo/ETERNALLOGO.png" alt="index">
                         </a>
                            <h1 class="mx-auto header text-white">Eternal Plans, Inc. DTR </h1>
                </div>
                     <div class="signup">
                         </div>
        </nav>
</div>

@yield('contents')
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="{{ asset('js/showPassword.js') }}"></script>
        <script src="{{ asset('js/validations.js') }}"></script>
</body>
