<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a class="burger-btn d-block" href="#">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">

                </ul>
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600 text-capitalize">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600 text-capitalize">{{ Auth::user()->role }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ Auth::user()->foto ? asset('storage/foto/' . Auth::user()->foto . '') : asset('img/jpg/1.jpg') }}" />
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}!</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="icon-mid bi bi-person me-2"></i> My
                                Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('setting.index') }}"><i class="icon-mid bi bi-gear me-2"></i>
                                Settings</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
