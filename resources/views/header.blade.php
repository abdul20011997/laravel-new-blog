<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/blog" style="flex-grow:1">Blog</a>
  <div class="collapse navbar" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/blog">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Categories</a>
      </li>
      @if(Session::has('user'))
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
      @endif
    </ul>
  </div>
  
</nav>