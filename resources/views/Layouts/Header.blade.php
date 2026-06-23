@push('styles')

    <style>
        .rate-ticker {
            width: 100%;
            background: linear-gradient(90deg, #ffd2d2, #f5e6b3);
            color: #4a3b00;
            overflow: hidden;
            white-space: nowrap;
            padding: 10px 0;
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 6px;
        }

        .ticker-content {
            display: inline-block;
            padding-left: 100%;
            animation: scrollTicker 18s linear infinite;
        }

        @keyframes scrollTicker {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .gold-text {
            color: #d4af37;
            font-weight: 600;
        }

        .silver-text {
            color: #8e9eab;
            font-weight: 600;
        }

        .rate-ticker i {
            margin-right: 5px;
        }

        /* .profile-circle {
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: #d1d5db;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
            }

            .profile-circle i {
                font-size: 22px;
                color: #ffffff;
            } */
    </style>

@endpush

<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">

            <!-- LEFT -->
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none">
                    <span></span>
                </button>

                <div class="header-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close">
                            <i class="ik ik-x"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-addon search-btn">
                            <i class="ik ik-search"></i>
                        </span>
                    </div>
                </div>

                <button type="button" id="navbar-fullscreen" class="nav-link">
                    <i class="ik ik-maximize"></i>
                </button>
            </div>


            <div class="top-menu d-flex align-items-center">


                <div class="rate-ticker">
                    <div class="ticker-content" id="rateTicker">
                        Loading rates...
                    </div>
                </div>

                <!-- User -->
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <!-- <img src="{{ asset('img/user.jpg') }}" class="avatar" alt="User"> -->
                        <img src="{{ Auth::user()->avatar ?? asset('uploads/Logo/Logo_Person.jpg') }}" class="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            <i class="ik ik-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="ik ik-settings"></i> Settings
                        </a>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ik ik-power"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        $(document).ready(function () {

            $.ajax({
                url: APP_URL + "/get-today-rate",
                type: "GET",
                success: function (res) {

                    let text = "";

                    // GOLD
                    if (res.gold && res.gold.length > 0) {

                        res.gold.forEach(function (item) {

                            text += `
                            <i class="fas fa-circle gold-text"></i> 
                            <span class="gold-text">
                                Gold ${item.Purity}
                            </span> :
                            ₹${item.Gram}/gm → ₹${item.Rate}
                            &nbsp;&nbsp;&nbsp;
                        `;
                        });
                    }

                    // SILVER
                    if (res.silver && res.silver.length > 0) {

                        res.silver.forEach(function (item) {

                            text += `
                            <i class="fas fa-circle silver-text"></i> 
                            <span class="silver-text">
                                Silver ${item.Purity}
                            </span> :
                            ₹${item.Gram}/gm → ₹${item.Rate}
                            &nbsp;&nbsp;&nbsp;
                        `;
                        });
                    }

                    $("#rateTicker").html(text);
                }
            });

        });
@endpush