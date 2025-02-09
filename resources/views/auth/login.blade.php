<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    
  <meta name="format-detection" content="telephone=no">
    <title>Login</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
  <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">

       

            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                            

                                <div class="auth-form">
                  
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form class="pt-3" method="POST" action="{{ route('login') }}">
                                      @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class="form-control " id="exampleInputEmail1" placeholder="Email">
                                            @error('email')

                                                <label class="text-danger" role="alert" style="margin-top: 8px;">
                                                    <strong>{{ $message }}</strong>
                                                </label>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" required class="form-control " id="exampleInputPassword1" placeholder="Password">
                                            @error('password')
                                                <label class="text-danger" role="alert" style="margin-top: 8px;">
                                                    <strong>{{ $message }}</strong>
                                                </label>
                                            @enderror
                                        </div>

                                        @if ($errors->any())
                                            <div style="color: red;">
                                                @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
  <script src="{{asset('assets/js/deznav-init.js')}}"></script>
    
    
</body>
</html>