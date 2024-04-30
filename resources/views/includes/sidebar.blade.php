
<div class="sidebar close" id="sidebar">
    <ul class="nav-links">
        <li id="menuu">
            <i class='bx bx-menu' id="menu-box" style="font-size: 30px"></i>
        </li>
        <li class="inactive">
            <a href="{{ route('dashboard.index') }}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="{{ route('dashboard.index') }}">Dashboard</a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('dashboard.index') }}">
                <i class='bx bxs-user'></i>
                <span class="link_name">Profile</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Profile</a></li>
            </ul>
        </li>

        <li>
            <a href="{{ route('dashboard.index') }}">
                <i class='bx bx-history'></i>
                <span class="link_name">History</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">History</a></li>
            </ul>
        </li>

        {{-- <li>
            <div class="icon-link">
                <a href="#" onclick="openSidebar()">
                    <i class='bx bxs-edit'></i>
                    <span class="link_name">Data Entry</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu" style="font-weight: bold">
                <li><a class="link_name" href="#">Data Entry</a></li>
                <li><a href="#">SUB LINK</a></li>
                <li><a href="#">SUB LINK</a></li>
                <li><a href="#">SUB LINK</a></li>
            </ul>
        </li> --}}
        <li>
            <div class="icon-link">
                <a href="#" onclick="openSidebar()">
                    <i class='bx bxs-edit'></i>
                    <span class="link_name">Request</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu" style="font-weight: bold">
                <li><a class="link_name" href="#">Request</a></li>
                <li><a href="{{ route('dashboard.overtime') }}">Over Time</a></li>
                <li><a href="#">Vacation Leave</a></li>
                <li><a href="#">Sick Leave</a></li>
            </ul>
        </li>
        <li onclick="document.getElementById('signout').submit()">
            <a href="#">
                <i class='bx bx-log-out'></i>
                <span class="link_name">Logout</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Logout</a></li>
            </ul>
            <form action="{{ route('sign-out') }}" method="POST" id="signout">
                @csrf
            </form>
        </li>
        {{-- <li>
            <div class="profile-details">
                <div></div>
                <div class="name-job">
                    <div class="profile_name">Juan Dela Cruz</div>
                    <div class="job">Developer</div>
                </div>
            </div>
        </li> --}}
    </ul>
</div>

<script>
    function openSidebar() {
        let sidebar = document.getElementById('sidebar')

        if (sidebar.classList.contains('close')) {
            document.getElementById('menu-box').click()
        }
    }

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

    var session = "{{ auth()->check() ? 'true' : 'false' }}"
    if (!session)
        window.location.replace("{{ route('sign-in.index') }}")

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

