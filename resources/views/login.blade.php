<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login Page</title>
</head>

<body>
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card w-25">
            <div class="card card-header fw-bold fs-4">
                <div class="d-flex justify-content-center">
                    Login Page
                </div>
            </div>
            <div class="card card-body p-3">
                <form method="POST" action="/login">
                    @csrf
                    <div class="d-grid gap-4">
                        <div class="d-grid gap-2">
                            <Label>Email</Label>
                            <input type="text" class="form-control" name="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <Label>Password</Label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Sign In" class="btn btn-primary">
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger mt-3">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
