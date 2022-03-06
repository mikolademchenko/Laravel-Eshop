<!DOCTYPE html>
<html lang="en">

@include('backend.layouts.head')
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('backend.layouts.sidebar')
<!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('backend.layouts.header')
        <!-- End of Topbar -->
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert-primary">{{ $error }}</div>
            @endforeach
        @endif
        <!-- Begin Page Content -->
        @yield('content')

        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
@include('backend.layouts.footer')

</body>

</html>
