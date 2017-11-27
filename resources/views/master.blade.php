<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    @include('partials.head')

    <body>

        <div class="container">
            @include('partials.nav')
            
            @include('partials.header')

            <div id="all-content">
                <div class="row row-offcanvas row-offcanvas-right">
                    <div class="col-xs-12 col-sm-9">
                        <p class="pull-right visible-xs">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                        </p>
                        <div id="master_title" class="">
                            <h1 class="well">@yield('main_title')</h1>
                        </div>

                        @yield('content')

                    </div>

                    <div class="col-sm-3 sidebar-offcanvas" id="sidebar">
                        @include('partials.sidebar')
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </body>
</html>