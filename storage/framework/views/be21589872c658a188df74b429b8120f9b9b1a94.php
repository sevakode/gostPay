<!--begin::Login Sign up form-->
<div class="login-signup">
    <div class="mb-20">
        <h3 class="opacity-40 font-weight-normal">Регистрация</h3>
        <p class="opacity-40">Введите свои данные, чтобы создать учетную запись</p>
    </div>
    <form class="form text-center" id="kt_login_signup_form" method="POST" action="<?php echo e(route('sign_up')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text"
                   placeholder="Имя" name="first_name" />
        </div>
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text"
                   placeholder="Фамилия" name="last_name" />
        </div>
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text"
                   placeholder="Email" name="email" autocomplete="off" />
        </div>
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password"
                   placeholder="Пароль" name="password" />
        </div>
        <div class="form-group">
            <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="password"
                   placeholder="Подтвердите пароль" name="password_confirmation"/>
        </div>
        <div class="form-group text-left px-8">
            <div class="checkbox-inline">
                <label class="checkbox checkbox-outline checkbox-white opacity-60 text-white m-0">
                    <input type="checkbox" name="agree" />
                    <span></span>Я согласен
                    <a href="#" class="text-white font-weight-bold ml-1">с условиями</a>.</label>
            </div>
            <div class="form-text text-muted text-center"></div>
        </div>
        <div class="form-group">
            <button id="kt_login_signup_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Создать учетную запись</button>
            <button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Назад</button>
        </div>
    </form>
</div>
<!--end::Login Sign up form-->
<?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/login/forms/register.blade.php ENDPATH**/ ?>