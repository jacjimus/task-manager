<!doctype html>
<html class="no-js">
<head>
        <!-- Meta, title, CSS, favicons, etc. -->
                <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>LOGIN::TM)</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!--<link rel="shortcut icon" href="/favicon.ico">-->
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="{{ url('/') }}/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/dist/css/veneto-admin.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/demo/css/demo.css">
        <link rel="stylesheet" href="{{ url('/') }}/dist/assets/font-awesome/css/font-awesome.css">


        <!--[if lt IE 9]>
        <script src="dist/assets/libs/html5shiv/html5shiv.min.js"></script>
        <script src="dist/assets/libs/respond/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="body-sign-in">
    <div class="container">
        <div class="panel panel-default form-container">
            <div class="panel-body">
                <form role="form" action='{{ url('/verifyuser') }}' method='post'>
                    <h3 class="text-center margin-xl-bottom">Tasks Manager</h3>

                    <div class="form-group text-center">
                        <label class="sr-only" for="email">Email Address</label>
                        <input type="email" name='email' class="form-control input-lg" id="email" placeholder="Email Address">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="password">Password</label>
                        {{ csrf_field() }}
                        <input type="password" name='password' class="form-control input-lg" id="password" placeholder="Password">
                    </div>

                    <button type="submit" name="Login" class="btn btn-primary btn-block btn-lg">Login</button>
                </form>
                
                <br />
                
                    {!! session('err') !!}
                
            </div>
            <div class="panel-body text-center">
                <div class="margin-bottom">
                    <a class="text-muted text-underline" href="javascript:;">Forgot Password?</a>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
