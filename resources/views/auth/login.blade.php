<!DOCTYPE html>
<html>

<head>
    <!-- CSS only -->

    <!--chatbot -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>How to install Botman Chatbot in Laravel 5? - ItSolutionStuff.com</title> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!--/chatbot -->


    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flags.css') }}" />
    <title>{{config("app.name")}} - Login</title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1 id="title" class="text-center">{{config("app.name")}}</h1>
            {{-- <p id="description" class="description text-center">
            Login to proceed
        </p> --}}
            <h2 id="title" class="text-center">Techno Brain BPO ITES</h2>
        </header>
        <form method="POST" action="{{ route('loginUser') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email Address') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="password">{{ __('Password') }}</label>
                    </div>

                </div>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required autocomplete="current-password">
                    <input type="checkbox" onclick="myPass()">Show Password

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if($errors->any())
                <div class="error" >
                    <p>{{$errors->first()}}</p>
                </div>
            @endif
            <div class="form-group text-center">
                <button type="submit" class=" submit-button">
                    {{ __('login') }}
                </button>
            </div>

            <div class="account-footer">
                <p>Forgot your password?<br>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"> {{ __(' Reset here') }} </a>
                    @endif
            </div>



        </form><div class="docgrid">
                <div id="flags8">
                    <flag-ke id="f3"></flag-ke>
                    <flag-rw id="f1"></flag-rw>
                    <flag-zm id="f2"></flag-zm>
                    <flag-ug id="f4"></flag-ug>
                    <flag-tz id="f5"></flag-tz>
                    <flag-gh id="f6"></flag-gh>
                    <flag-et id="f7"></flag-et>
                    <flag-mw id="f8"></flag-mw>

                </div>
            </div>
    </div>
    <script src="{{asset("js/elements.flagmeister.js")}}"></script>
    <script>
        document.body.style.visibility = "initial";
    </script>
    <script>
        function myPass() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
        </script>
</body>

    <!--chatbot -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
<script>
    var botmanWidget = {
        aboutText: 'ssdsd',
        introMessage: "✋ Hi! Welcome to TechnoBrain BPO ITES!"
    };
</script>

<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

</html>
