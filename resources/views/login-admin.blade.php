<!doctype html>
<html lang="en">

<head>
    <title>Login</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible mt-3 mx-2">
        <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{ session()->get('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible mt-3 mx-2">
        <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong>
        @foreach ($errors->all() as $error)
        <p style="list-style:none;">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <div class="container">
        <h1 class="text-center mb-5 mt-3">Login</h1>
        <form action="{{ route('adminLogin') }}" method="post" id="loginForm" novalidate>
            @csrf
            <div class="col-md-6 mr-auto ml-auto">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-auto" style="margin-left: 47%;">Login as Admin</button>
            <div>
                <span class="text-center" style="margin-left: 39%; position: relative; top:10px">To create a new account<a
                        href="{{ route('register.admin') }}"> Register here</a></span>
            </div>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "{{ route('check.email.exists') }}",
                            type: "post",
                            data: {
                                email: function() {
                                    return $("#email").val();
                                },
                                _token: "{{ csrf_token() }}"
                            }
                        }
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 12,
                        pattern: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&]).*$/
                    },
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        maxlength: "Email address cannot exceed 20 characters",
                        remote: "Email does not exist in our records"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 8 characters long",
                        maxlength: "Password cannot exceed 12 characters",
                        pattern: "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character (@$!%*#?&)"
                    },
                },
                errorElement: 'span',
                errorClass: "text-danger",
                highlight: function(element, errorClass, validClass) {},
                unhighlight: function(element, errorClass, validClass) {}
            });
        });
    </script>
</body>

</html>