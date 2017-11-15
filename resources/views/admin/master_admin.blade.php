<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    @include('admin.partials.head')

    <body class="w3-light-grey">


        <!-- Top container -->
        <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
            <a href="{{ route('home') }}" class="w3-bar-item w3-right">Home</a>
        </div>
        @include('admin.partials.sidebar')
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">

            @if(session()->has('success'))
            
                <div class="w3-container">
                    <div class="w3-panel w3-margin-top w3-green w3-padding w3-round">
                        <span onclick="this.parentElement.style.display = 'none'"
                              class="w3-btn w3-red w3-right">x</span>
                              <p class="w3-large">{{session()->get('success')}}<p>
                    </div>
                </div>
           
            @endif


            <div class="w3-container">
                @yield('content')

            </div>


            @include('admin.partials.footer')
        </div>

    </body>
</html>

