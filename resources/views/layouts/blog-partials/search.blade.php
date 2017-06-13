<form class="navbar-form navbar-right mr-10"
      action="/search"
      method="POST">
    {{ csrf_field() }}
    <input type="text"  class="form-control" name="q" placeholder="Search...">
</form>