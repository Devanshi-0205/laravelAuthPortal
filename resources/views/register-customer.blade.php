<!doctype html>
<html lang="en">

<head>
    <title>Sign Up</title>
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

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible mt-3 mx-2">
            <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session()->get('error') }}
        </div>
    @endif

    <div class="container">
        <h1 class="text-center mb-5">Sign Up</h1>
        <form action="{{ route('register.customer') }}" method="post" novalidate id="registrationForm">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Ex.: John"
                        value="{{ old('fname') }}">
                    <div class="text-danger">
                        @error('fname')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Ex.: Doe"
                        value="{{ old('lname') }}">
                    <div class="text-danger">
                        @error('lname')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="Ex.: john@example.com" value="{{ old('email') }}">
                    <div class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <div class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="c_password">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="c_password"
                    placeholder="Confirm Password">
                <div class="text-danger">
                    @error('password_confirmation')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        @if (!Auth::user())
            <div>
                <span style="position:relative; top:10px;">Already an user? <a href="{{ route('login.customer') }}">
                        Login
                        from here </a></span>
            </div>
        @endif
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
            $("#registrationForm").validate({
                rules: {
                    fname: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    },
                    lname: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    gender: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        pattern: /^(?=.*[A-Z])(?=.*[a-z])(?=.*[@$!%*#?&]).+$/
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    fname: {
                        required: "Please enter your first name",
                        minlength: "First name must be at least 5 characters long",
                        maxlength: "First name cannot exceed 20 characters"
                    },
                    lname: {
                        required: "Please enter your last name",
                        minlength: "Last name must be at least 5 characters long",
                        maxlength: "Last name cannot exceed 20 characters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                        maxlength: "Email address cannot exceed 20 characters"
                    },
                    gender: {
                        required: "Please select your gender"
                    },
                    address: {
                        required: "Please enter your address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 8 characters long",
                        pattern: "Password must contain an uppercase letter, a lowercase letter, and a special character."
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                },
                errorElement: 'span',
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "gender") {
                        error.insertAfter(element.closest('.form-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {},
                unhighlight: function(element, errorClass, validClass) {}
            });
        });
    </script>
</body>

</html>
