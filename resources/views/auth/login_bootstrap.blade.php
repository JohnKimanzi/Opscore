
<!DOCTYPE html>
<html>
  <head>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset("css/login.css")}}" />
  </head>
  <body>
    <div class="container">
      <header class="header">
        <h1 id="title" class="text-center">Opscore</h1>
        {{-- <p id="description" class="description text-center">
            Login to proceed
        </p> --}}
        <h2 id="title" class="text-center">Techno Brain BPO ITES</h2>
        </header>
      <form method="POST" action="{{ route('loginUser') }}">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
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
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
        
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
        
                <div class="">
                    <img src="{{asset("/img/flags/kenya_flag.png")}}" alt="Kenya" >
                    <div class="carousel-caption">
                        <h3>Kenya</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
                <div class="item ">
                    <img src="{{asset("/img/flags/uganda_flag.png")}}" alt="Uganda" >
                    <div class="carousel-caption">
                        <h3>Uganda</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
                <div class="item ">
                    <img src="{{asset("/img/flags/tanzania_flag.png")}}" alt="Tanzania" >
                    <div class="carousel-caption">
                        <h3>Tanzania</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
                <div class="item ">
                    <img src="{{asset("/img/flags/malawi_flag.png")}}" alt="Malawi" >
                    <div class="carousel-caption">
                        <h3>Malawi</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
                <div class="item ">
                    <img src="{{asset("/img/flags/ghana_flag.png")}}" alt="Ghana" >
                    <div class="carousel-caption">
                        <h3>Ghana</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
                <div class="item ">
                    <img src="{{asset("/img/flags/zambia_flag.png")}}" alt="Zambia" >
                    <div class="carousel-caption">
                        <h3>Zambia</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
                <div class="item ">
                    <img src="{{asset("/img/flags/ethiopia_flag.png")}}" alt="Ethiopia" >
                    <div class="carousel-caption">
                        <h3>Ethiopia</h3>
                        {{-- <p>The atmosphere in Chania has a touch of Florence and Venice.</p> --}}
                    </div>
                </div>
          
            </div>
        
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
            
    </form>

      
    </div>

 
  </body>
</html>
