<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Charts</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav w-75 m-auto d-flex justify-content-around">

      <li class= "{{Str::startsWith(Route::currentRouteName(), 'line') ? 'active' : '' }} nav-item" >
        <a class="nav-link"  href="/line">Line</a>
      </li>
      <li class="{{Str::startsWith(Route::currentRouteName(), 'bar') ? 'active' : '' }} nav-item" >
        <a class="nav-link" href="/bar">Bar</a>
      </li>
      <li class="{{Str::startsWith(Route::currentRouteName(), 'pie') ? 'active' : '' }} nav-item" >
        <a class="nav-link" href="/pie">Pie</a>
      </li>
      <li class="{{Str::startsWith(Route::currentRouteName(), 'trend') ? 'active' : '' }} nav-item" >
        <a class="nav-link" href="/trend">Trend</a>
      </li>
      <li class="{{Str::startsWith(Route::currentRouteName(), '') ? 'active' : '' }} nav-item" >
        <a class="nav-link" href="#">Bar-total</a>
      </li>
      <li class="{{Str::startsWith(Route::currentRouteName(), '') ? 'active' : '' }} nav-item" >
        <a class="nav-link" href="auto-bar">Bar-auto</a>
      </li>
      <li class="{{Str::startsWith(Route::currentRouteName(), 'qrcode') ? 'active' : '' }} nav-item" >
        <a class="nav-link" href="/qrcode">Qrcode </a>
      </li>
    </ul>
  </div>
</nav>