<ul class="nav">
  <li class="{{ (request()->is('admin/user*')) ? 'active' : '' }}">
    <a href="{{ route('admin.user.index') }}">
      <i class="ti-panel"></i>
      <p>Users</p>
    </a>
  </li>
</ul>