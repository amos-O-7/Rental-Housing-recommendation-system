<header>

  <div style="background-color: ghostwhite" class="container-fluid">
    <div  class="row">
      <div class="col-xs-12">
        <div>
          <a href="{{ route('welcome') }}"> <img src="{{ asset('frontend/img/png/logo-no-background.png') }}"
              style="height: 135px; width: 190px" alt="logo" class="my-2 mx-2 text-center">
          </a>
            <span>
            <a onMouseOver="this.style.color='red'"
               onMouseOut="this.style.color='green'"
                style="color: black" class="span1" href="{{ route('welcome') }}">
                Home
            </a>
            <a onMouseOver="this.style.color='red'"
               onMouseOut="this.style.color='green'"
                style="color: black" class="span1" href="{{ route('house.bedSitters') }}">
                Bedsitters
            </a>
            <a onMouseOver="this.style.color='red'"
               onMouseOut="this.style.color='green'"
                style="color: black" class="span1" href="{{ route('house.oneBedrooms') }}">
                One-Bedrooms
            </a>
            <a onMouseOver="this.style.color='red'"
               onMouseOut="this.style.color='green'"
                style="color: black" class="span1" href="{{ route('house.twoBedrooms') }}">
                Two-Bedrooms
            </a>
            <a onMouseOver="this.style.color='red'"
               onMouseOut="this.style.color='green'"
                style="color: black" class="span1" href="{{ route('house.threeBedrooms') }}">
                Three-Bedrooms
            </a>
            <a onMouseOver="this.style.color='red'"
               onMouseOut="this.style.color='green'"
                style="color: black" class="span1" href="{{ route('house.singles') }}">
                Single-rooms
            </a>

            </span>


{{--           <div class="mb-3" style="margin-left: 12px;" id="time"></div>--}}
        </div>
      </div>
          <div style="float: right; margin-left: 100px; text-align: right" class="col-xs-12 text-right">
              <div class="dropdown">
                  <button onMouseOver="this.style.color='red'" style="border: none;  margin-top: 50px" class="dropbtn" type="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-user"></i>
                      My Account <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a onMouseOver="this.style.color='red'"
                         onMouseOut="this.style.color='green'" class="dropdown-item" href="{{ route('welcome') }}">
                          <i class="fa fa-tachometer-alt"></i>
                          Home</a>
                      <a onMouseOver="this.style.color='red'"
                         onMouseOut="this.style.color='green'" class="dropdown-item" href="{{ route('house.all') }}">
                          <i class="fa fa-home" aria-hidden="true"></i>
                          All Houses</a>
                      @guest
                          <a onMouseOver="this.style.color='red'"
                             onMouseOut="this.style.color='green'" class="dropdown-item" href="{{ route('login') }}">
                              <i class="fa fa-sign-in-alt" aria-hidden="true"></i>
                              Sign in</a>
                          <a onMouseOver="this.style.color='red'"
                             onMouseOut="this.style.color='green'" class="dropdown-item" href="{{ route('register') }}">
                              <i class="fa fa-user-plus" aria-hidden="true"></i>
                              Sign up</a>
                      @else
                          @if (Auth::user()->role_id == 2)
                              <a class="dropdown-item" href="{{ route('landlord.dashboard') }}">Dashboard</a>
                          @endif
                          @if (Auth::user()->role_id == 3)
                                  <a class="dropdown-item" href="{{ route('renter.dashboard') }}">Dashboard</a>
                              @endif
                              @if (Auth::user()->role_id == 1)
                                  <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                              @endif
                      @endguest
                  </div>
              </div>
          </div>
    </div>
  </div>
</header>

<script type="text/javascript">
  var date = new Date();
  var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  var months = ["January","February","March","April","May","June","July","August","September", "October", "November", "December"];
  document.getElementById("time").innerHTML = '<strong>' + days[date.getDay()] + '</strong>' + ', ' + months[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear();


</script>
