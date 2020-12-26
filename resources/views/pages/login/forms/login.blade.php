<div class="login-signin">
    <div class="mb-20">
        <h3 class="opacity-40 font-weight-normal">Войти</h3>
        <p class="opacity-40">Введите свои данные для входа в свою учетную запись:</p>
    </div>
    <div id="app">
    </div>
    <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('sign_in') }}">
        @csrf
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                   value="{{old('email')}}" type="text" placeholder="Email" name="email" autocomplete="off"/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8"
                   value="{{old('password')}}" type="password" placeholder="Password" name="password"/>
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
            <div class="checkbox-inline">
                <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                    <input type="checkbox" name="remember"/>
                    <span></span>Remember me</label>
            </div>
            <a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Forget Password ?</a>
        </div>
        <div class="form-group text-center mt-10">
            <button id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">
                Sign In
            </button>
        </div>
    </form>
    <div class="mt-10">
        <span class="opacity-40 mr-4">Don't have an account yet?</span>
        <a href="javascript:;" id="kt_login_signup" class="text-white opacity-30 font-weight-normal">Sign Up</a>
    </div>
</div>
