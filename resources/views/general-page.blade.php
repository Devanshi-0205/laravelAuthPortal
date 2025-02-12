<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="container text-center">
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

        <div class="card shadow-lg p-4" style="max-width: 400px; margin: auto;">
            <div class="card-body">
                <h4 class="card-title">Register as</h4>
                <div class="d-grid gap-2">
                    <a id="adminbutton" class="btn btn-primary" href="{{ route('register.admin') }}" role="button">Admin</a>
                    <a id="customerbutton" class="btn btn-secondary" href="{{ route('register.customer') }}" role="button">Customer</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>