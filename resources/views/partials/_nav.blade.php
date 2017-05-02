<!-- Default bootstrap navbar-->

  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{route('house')}}">OpenAug</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            
            <li class="{{ Request::is('about') ? "active" : "" }}"><a href="{{route('house')}}/about">About</a></li>
            <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="{{route('house')}}/contact">Contact</a></li>
            
          </ul>
          <form class="navbar-form navbar-left"  class="form-control" action="{{route('search.result')}}">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search..." id="auto" name="query">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">

            @if(Auth::check())

            <li class="{{ Request::is('categories') ? "active" : "" }}"><a href="{{ route('categories.index') }}">Categories</a></li>
<!-- 
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Actions <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/augments">Augments</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
            

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('user.profile', ['userid' => Auth::user()->id] )}}"><i class="fa fa-user" aria-hidden="true"></i> Your profile</a></li>
              <!--   <li role="separator" class="divider"></li>
                
                <li><a href="{{ route('tags.index') }}">Tags</a></li> -->
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a></li>
              </ul>
            </li>

            @else

            <li class="{{ Request::is('login') ? "active" : "" }}"><a href="{{route('login') }}">Login</a></li>
             <li class="{{ Request::is('register') ? "active" : "" }}"><a href="{{route('register') }}">Register</a></li>

            @endif

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>