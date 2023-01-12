<nav class="navbar navbar-expand-lg">
              <div class="container">
                <div class="navbar-translate">
                  <a class="navbar-brand text-dark" href="/">{{ trans('panel.site_title') }}</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#example-navbar-danger" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                  </button>
                </div>
                <div class="collapse navbar-collapse" id="example-navbar-danger">
                  <ul class="navbar-nav ml-auto">
                  @if(request()->is('email/verify'))

                  @else
                    @if (Auth::user())
                     
                      @can('admin_access')
                        <li class="nav-item">
                          <a class="nav-link text-dark {{ request()->is('admin/home')  ? 'active' : '' }}" href="/admin/home">
                            <p>HOME</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark {{ request()->is('admin/complaints')  ? 'active' : '' }}" href="/admin/complaints">
                            <p>COMPLAINTS</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark {{ request()->is('admin/users')  ? 'active' : '' }}" href="/admin/users">
                            <p>USERS</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-dark {{ request()->is('admin/complaint_history')  ? 'active' : '' }}" href="/admin/complaint_history">
                            <p>COMPLAINTS HISTORY</p>
                          </a>
                        </li>
                      @endcan
                    
                    @else
                      <li class="nav-item">
                        <a class="nav-link text-dark {{ request()->is('login') || request()->is('login/*') ? 'active' : '' }}" href="/login">
                          <p>Login</p>
                        </a>
                      </li>
                    @endif
                    
                      
                      @if (Auth::user())
                        <li class="nav-item dropdown ml-4">
                          <a href="#" class="nav-link text-dark dropdown-toggle font-weight-bold" id="navbarDropdownMenuLink" data-toggle="dropdown">
                           {{Auth::user()->application->name ?? 'ADMIN'}}
                            <i class="now-ui-icons ui-1_settings-gear-63" aria-hidden="true"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/admin/change_password">Change Password?</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a>
                          </div>
                        </li>
                      @endif
                  @endif   
                  </ul>
                </div>
              </div>
            </nav>