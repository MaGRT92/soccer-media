<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey w3-center w3-margin-top">
    &copy; 2017 MaGRT
</footer>

<!-- End page content -->
</div>

<script src="{{ asset('js/jquery.js') }}"></script>

<script>
// Get the Sidebar
    var mySidebar = $("#mySidebar");
// Get the DIV with overlay effect
    var overlayBg = $("#myOverlay");
// Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.css('display') === 'block') {
            mySidebar.hide();
            overlayBg.hide();
        } else {
            mySidebar.show();
            overlayBg.show();
        }
    }

// Close the sidebar with the close button
    function w3_close() {
        mySidebar.hide();
        overlayBg.hide();
    }
</script>

@yield('js')