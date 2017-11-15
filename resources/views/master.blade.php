<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    @include('partials.head')

    <body>
        <div class="w3-content">

            @include('partials.nav')

            @include('partials.header')

            <div id="master_title" class="w3-container">
                <h1 class="w3-text-green w3-border-bottom w3-border-green">@yield('main_title')</h1>
            </div>

            <div id="all-content" class="w3-container">
                <div class="w3-row">
                    <div class="w3-col s12">

                        @yield('content')
                    </div>

                </div>
            </div>

        </div>

        @include('partials.footer')

    </body>
</html>