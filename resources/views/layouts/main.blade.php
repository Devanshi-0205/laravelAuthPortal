@include('layouts.header')
<div class="container-fluid">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible mt-3 mx-2">
            <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session()->get('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-success alert-dismissible mt-3 mx-2">
            <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session()->get('error') }}
        </div>
    @endif
    @yield('content')
</div>
@include('layouts.footer')
@stack('scripts')
@stack('successMessage')