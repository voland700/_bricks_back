@include('front.layouts.header')
<div class="container">
    <h1 class="title">@yield('h1')</h1>
    @yield('breadcrumbs')
    @yield('content')


</div>
@include('front.layouts.footer')
