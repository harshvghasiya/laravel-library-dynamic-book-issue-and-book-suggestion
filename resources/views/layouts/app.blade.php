<!DOCTYPE html>
<html>
    @include('layouts.head')
<body>
    @include('layouts.header')
    @yield('content')  
    @include('layouts.footer')
    @yield('javascript')
</body>
</html>
