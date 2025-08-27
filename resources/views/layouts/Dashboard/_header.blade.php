<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
{{--            <img src="assets/img/logo for my system.jpg" alt="">--}}
            <span class="d-none d-lg-block">VetCare</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

{{--    <div class="search-bar">--}}
{{--        <form class="search-form d-flex align-items-center" method="POST" action="#">--}}
{{--            <input type="text" name="query" placeholder="Search" title="Enter search keyword">--}}
{{--            <button type="submit" title="Search"><i class="bi bi-search"></i></button>--}}
{{--        </form>--}}
{{--    </div><!-- End Search Bar -->--}}

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

{{--            <li class="nav-item dropdown">--}}
{{--                @if(auth()->check() && isset($notifications))--}}
{{--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">--}}
{{--                    <i class="bi bi-bell"></i>--}}
{{--                    <span class="badge bg-primary badge-number">4</span>--}}
{{--                </a><!-- End Notification Icon -->--}}

{{--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">--}}
{{--                    <li class="dropdown-header">--}}
{{--                        You have {{ $notifications->count() }} new notifications--}}
{{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    @foreach ($notifications as $notification)--}}
{{--                        <li class="notification-item px-4 py-3 hover:bg-gray-100 transition duration-200 rounded-md shadow-sm mb-2" id="notification-{{ $notification->id }}">--}}
{{--                            <div class="flex items-start justify-between">--}}
{{--                                <div class="flex-1">--}}
{{--                                    <h4 class="text-md font-semibold text-gray-800">{{ $notification->discription }}</h4>--}}
{{--                                    <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($notification->appointment_time)->format('h:i A, d M Y') }}</p>--}}
{{--                                </div>--}}
{{--                                <button class="text-red-500 hover:text-red-700 focus:outline-none" data-id="{{ $notification->id }}">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
{{--                                    </svg>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}



{{--                    <li class="dropdown-footer">--}}
{{--                        <a href="#">Show all notifications</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}

{{--            </li><!-- End Notification Nav -->--}}
{{--            @endif--}}

{{--            <li class="nav-item dropdown">--}}

{{--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">--}}
{{--                    <i class="bi bi-chat-left-text"></i>--}}
{{--                    <span class="badge bg-success badge-number">3</span>--}}
{{--                </a><!-- End Messages Icon -->--}}

{{--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">--}}
{{--                    <li class="dropdown-header">--}}
{{--                        You have 3 new messages--}}
{{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="message-item">--}}
{{--                        <a href="#">--}}
{{--                            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">--}}
{{--                            <div>--}}
{{--                                <h4>Maria Hudson</h4>--}}
{{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
{{--                                <p>4 hrs. ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="message-item">--}}
{{--                        <a href="#">--}}
{{--                            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">--}}
{{--                            <div>--}}
{{--                                <h4>Anna Nelson</h4>--}}
{{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
{{--                                <p>6 hrs. ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="message-item">--}}
{{--                        <a href="#">--}}
{{--                            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">--}}
{{--                            <div>--}}
{{--                                <h4>David Muldon</h4>--}}
{{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
{{--                                <p>8 hrs. ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li class="dropdown-footer">--}}
{{--                        <a href="#">Show all messages</a>--}}
{{--                    </li>--}}

{{--                </ul><!-- End Messages Dropdown Items -->--}}

{{--            </li><!-- End Messages Nav -->--}}

{{--            <li class="nav-item dropdown pe-3">--}}

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                        <span>{{ Auth::user()->role->name }}</span>
                    </li>
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">--}}
{{--                            <i class="bi bi-person"></i>--}}
{{--                            <span>My Profile</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">--}}
{{--                            <i class="bi bi-gear"></i>--}}
{{--                            <span>Account Settings</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">--}}
{{--                            <i class="bi bi-question-circle"></i>--}}
{{--                            <span>Need Help?</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <hr class="dropdown-divider">--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="#">--}}
{{--                            <i class="bi bi-box-arrow-right"></i>--}}
{{--                            <span>Sign Out</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".close-btn").forEach(button => {
            button.addEventListener("click", function () {
                let notificationId = this.getAttribute("data-id");

                fetch(`/notifications/${notificationId}`, {
                    method: "POST",  // Laravel handles PUT via POST with _method
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ _method: "PUT" }) // Proper way to send PUT request in Laravel
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`notification-${notificationId}`).remove();
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });
</script>

