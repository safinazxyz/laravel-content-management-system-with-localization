<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.dashboard')}}" class="nav-link">{{trans('admin/sidebar.home')}}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.logout') }}"><i
                    class="fas fa-sign-out-alt"> {{trans('admin/sidebar.logout')}}</i></a>
        </li>
    </ul>
    <div class="btn-group">
        <button type="button"
                class="btn btn-link"
                id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            {{ ucwords(str_replace('_', '-', app()->getLocale())) }}
            <i class="fas fa-chevron-down"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="list-unstyled">
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
