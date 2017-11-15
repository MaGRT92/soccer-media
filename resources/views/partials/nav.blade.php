<div class="w3-bar w3-green">
    <a href="{{ route('home') }}" class="w3-bar-item w3-button">Home</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small">Link 3</a>
    @guest
    <a href="{{ route('login') }}" class="w3-bar-item w3-button w3-hide-small w3-right">Login</a>
    <a href="{{ route('register') }}" class="w3-bar-item w3-button w3-hide-small w3-right">Register</a>
    @else
    <a href="{{ route('logout') }}" class="w3-bar-item w3-button w3-hide-small w3-right"
       onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
        Logout
    </a>
   
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    
     <a href="{{ route('admin.index') }}" class="w3-bar-item w3-button w3-hide-small w3-right">Go to Admin</a>

    @endguest
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
</div>

<div id="demo" class="w3-bar-block w3-red w3-hide w3-hide-large w3-hide-medium">
    <a href="#" class="w3-bar-item w3-button">Link 1</a>
    <a href="#" class="w3-bar-item w3-button">Link 2</a>
    <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>