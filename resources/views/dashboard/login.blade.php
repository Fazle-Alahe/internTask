
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

         <style>
/*             
        .toggle-password {
            float: right;
            cursor: pointer;
            margin-right: 10px;
            margin-top: -25px;
        } */
        
         </style>
    </head>


    <body>
        <div class="row">
            <div class="col-lg-4 m-auto">
                <h3>Login here...</h3>
                
                <form action="{{route('login.post')}}" method="POST">
                    @csrf

                    @if (session('exists'))
                        <strong class="text-danger">{{session('exists')}}</strong>
                    @endif

                    <div class="form-group">
                        <div class="col-12 mt-2">
                            <label class="form-label">Email address</label>
                            <input class="form-control" type="email" name="email">
                            @error('email')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12 mt-2">
                            <label class="form-label">Password</label>
                            <input class="form-control" type="password" name="password">
                            {{-- <i class="toggle-password fa fa-fw fa-eye-slash"></i> --}}
                            @error('password')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            
                            @if (session('wrong'))
                                <strong class="text-danger">{{session('wrong')}}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12 mt-3">
                            <button class="btn btn-primary" type="submit">Sign in</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </body>

    
{{-- <script>
	$(".toggle-password").click(function() {
		$(this).toggleClass("fa-eye fa-eye-slash");
		input = $(this).parent().find("input");
		if (input.attr("type") == "password") {
			input.attr("type", "text");
		} else {
			input.attr("type", "password");
		}
	});
</script> --}}
</html>