<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        .card{
            color:#0029ff;
            font-size:40px;
            font-weight:700;
            border:none;
        }
        .signin{
            font-size:30px;
            font-weight:600;
        }
        .btn1{
            border-radius:25px;
            background-color:#fff;
            color:#eee;
            height:50px;
            width:350px;
            border-color:#e7e9ec;
            font-size:18px;
        }
        .btn2{
            border-radius:25px;
            background-color:#0029ff;
            color:#eee;
            height:50px;
            width:200px;
            border-color:#e7e9ec;
            font-size:18px;
        }
        .forgot{
            font-size:30px;
            color:#94969a;
        }
        .account{
            font-size:22px;
            color:#000000;
            font-weight:500;
        }
        .signup{
            color:#0029ff;
            font-weight:700;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>




<body class="antialiased">
<div >


    <form method="POST" action="{{url('store')}}">
        @csrf
        <div class="form-group">
            <div class="row d-flex justify-content-center">

                <div class="col-md-6">
                    <div class="card p-3 px-5 py-5 mt-3 align-items-center">


                        <span class="signin mt-3">SIGN UP </span>
                        <label>
                            <input  class="form-control @error('first_name') is-invalid @enderror"   placeholder="Enter Your first name" name="first_name">
                            @error('first_name')

                            <div class="invalid-feedback" style="font-size: 12px" >{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <input  class="form-control @error('last_name') is-invalid @enderror"   placeholder="Enter Your last name" name="last_name">
                            @error('last_name')

                            <div class="invalid-feedback" style="font-size: 12px" >{{ $message }}</div>
                            @enderror
                        </label>
                        <label>
                            <input  class="form-control @error('username') is-invalid @enderror"   placeholder="Enter Your username" name="username">
                            @error('username')

                            <div class="invalid-feedback" style="font-size: 12px" >{{ $message }}</div>
                            @enderror
                        </label>
                        <label>
                            <input  class="form-control @error('email') is-invalid @enderror"   placeholder="Enter Your Email" name="email">
                            @error('email')

                            <div class="invalid-feedback" style="font-size: 12px" >{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"   placeholder="Enter Your password" name="password">
                            @error('password')

                            <div class="invalid-feedback" style="font-size: 12px" >{{ $message }}</div>
                            @enderror
                        </label>

                        <label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Enter Password Again" name="password_confirmation" />
                            @error('password')

                            <div class="invalid-feedback" style="font-size: 12px" >{{ $message }}</div>
                            @enderror
                        </label>

                        <button type="submit" class="btn btn2 btn-light mt-3">REGISTER</button>
                        <a href="{{ url('/') }}" class="btn btn2 btn-light mt-3">SIGN IN</a>
                        <span class="account mt-4">Don't Have a account?

                </span>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>


