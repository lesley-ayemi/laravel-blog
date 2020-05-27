@include('includes.front_header')

    <!-- Navigation -->

    @include('includes.front_nav')

    <!-- Page Content -->

    @include('includes.flash_messages')



    @yield('content')
    
        <!-- /.row -->

 @include('includes.front_footer')