<!DOCTYPE html>
<html lang="en">
    <head>
        @section('title', "Login")        
        @include('admin.includes.head')
    </head>
    <body>
                
        <!-- page wrapper -->
        <div class="dev-page dev-page-login">
                      
            <div class="dev-page-login-block">
                <a class="dev-page-login-block__logo">Intuitive</a>
                <div class="dev-page-login-block__form">
                    <div class="title"><strong>Welcome</strong>, please login</div>
                    @if($errors->any())
                    <span class="help-block" style="color: red">
                        <strong>{{ $errors->first() }}</strong>
                    </span>
                    @endif
                    <form action="{{ url('/login') }}" method="post">  
                        {{ csrf_field() }}                      
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Login">
                            </div>
                            @if ($errors->has('username'))
                                <span class="help-block" style="color: red">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block" style="color: red">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group no-border margin-top-20">
                            <button class="btn btn-success btn-block">Login</button>
                        </div>
                        <p><a href="#">Forgot Password?</a></p>                        
                    </form>
                </div>
                <div class="dev-page-login-block__footer">                    
                    © 2015 <strong>Aqvatarius</strong>. All rights reserved.
                </div>
            </div>
            
        </div>
        <!-- ./page wrapper -->                
        
        <!-- javascript -->
        <script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>       
        <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
        @yield('scripts')
        <!-- ./javascript -->
    </body>
</html>
