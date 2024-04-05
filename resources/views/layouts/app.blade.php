<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script> --}}
    <link href="{{ asset('img/favi.png') }}" rel="icon" />
</head>

<body style="background: #18191A">

    <header class="header fixed-top header-scrolled" style="max-height: 170px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-9 text-left" id="name-header">
                    <h3 id="name-span-header">
                        Eternal Plans, Inc.
                    </h3>
                </div>
                <div class="col-sm-3 text-center" id="logo-header">
                    <!--ICON-->
                </div>
            </div>
        </div>

        <i class='bx bx-menu' id="header-menu-box" onclick="document.getElementById('menu-box').click()"
            style="font-size: 25px"></i>
    </header>

    @include('includes.sidebar')

    <section class="home-section">
        <br><br><br>

        @yield('contents')

        <br><br><br>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.js"></script>
    <script src="{{ asset('js/showPassword.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @yield('scripts')
    <script>
        let arrow = document.querySelectorAll(".arrow");
        let notificationTable = null;

        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; // Selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });

            // Add event listener to parent element
            let parentElement = arrow[i].parentElement.parentElement;
            parentElement.addEventListener("click", (e) => {
                if (!e.target.classList.contains('arrow')) { // Check if the click didn't happen on the arrow
                    parentElement.classList.toggle("showMenu");
                }
            });
        }

        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector("#menu-box");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        var mediaQuery = window.matchMedia('(max-width: 600px)');

        function handleMediaQueryChange(mediaQuery) {
            var nameElement = document.getElementById('name-span-header');

            if (mediaQuery.matches) {
                // Change h2 to h6
                if (nameElement && nameElement.tagName.toLowerCase() === 'h2') {
                    var h6Element = document.createElement('h6');
                    h6Element.id = 'name-span-header';
                    h6Element.innerHTML = nameElement.innerHTML;
                    nameElement.parentNode.replaceChild(h6Element, nameElement);
                }
            } else {
                // Change h6 to h2
                if (nameElement && nameElement.tagName.toLowerCase() === 'h6') {
                    var h2Element = document.createElement('h2');
                    h2Element.id = 'name-span-header';
                    h2Element.innerHTML = nameElement.innerHTML;
                    nameElement.parentNode.replaceChild(h2Element, nameElement);
                }
            }
        }

        mediaQuery.addEventListener('change', function() {
            handleMediaQueryChange(mediaQuery);
        });

        handleMediaQueryChange(mediaQuery);
    </script>
</body>

</html>
