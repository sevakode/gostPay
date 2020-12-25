<!--begin::Tab-->
<div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-2"></div>
        <div class="col-xl-7 my-2">
            <!--begin::Row-->
            <div class="row">
                <label class="col-3"></label>
                <div class="col-9">
                    <h6 class="text-dark font-weight-bold mb-10">Информация о клиенте:</h6>
                </div>
            </div>
            <!--end::Row-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-form-label col-3 text-lg-right text-left">Avatar</label>
                <div class="col-9">
                    <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar"
                         style="background-image: url({{asset('assets/media/users/blank.png')}})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                               data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="profile_avatar_remove"/>
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																			<i class="ki ki-bold-close icon-xs text-muted"></i>
																		</span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="remove" data-toggle="tooltip" title="Remove avatar">
																			<i class="ki ki-bold-close icon-xs text-muted"></i>
																		</span>
                    </div>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-form-label col-3 text-lg-right text-left">Имя</label>
                <div class="col-9">
                    <input class="form-control form-control-lg form-control-solid" type="text" value=""/>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-form-label col-3 text-lg-right text-left">Фамилия</label>
                <div class="col-9">
                    <input class="form-control form-control-lg form-control-solid" type="text" value=""/>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-form-label col-3 text-lg-right text-left">Название компании</label>
                <div class="col-9">
                    <input class="form-control form-control-lg form-control-solid" type="text" value=""/>
                    <span class="form-text text-muted">
                        Если вы хотите, чтобы ваши счета были адресованы компании.
                        Оставьте поле пустым, чтобы использовать свое полное имя.
                    </span>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-form-label col-3 text-lg-right text-left">Контактный телефон</label>
                <div class="col-9">
                    <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
                        </div>
                        <input type="text" class="form-control form-control-lg form-control-solid" value=""
                               placeholder="Phone"/>
                    </div>
                    <span class="form-text text-muted">Мы никогда никому не передадим вашу электронную почту.</span>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
            <div class="form-group row">
                <label class="col-form-label col-3 text-lg-right text-left">Адрес электронной почты</label>
                <div class="col-9">
                    <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-at"></i>
																			</span>
                        </div>
                        <input type="text" class="form-control form-control-lg form-control-solid"
                               value="" placeholder="Email"/>
                    </div>
                </div>
            </div>
            <!--end::Group-->
            <!--begin::Group-->
{{--            <div class="form-group row">--}}
{{--                <label class="col-form-label col-3 text-lg-right text-left">Сайт компании</label>--}}
{{--                <div class="col-9">--}}
{{--                    <div class="input-group input-group-lg input-group-solid">--}}
{{--                        <input type="text" class="form-control form-control-lg form-control-solid"--}}
{{--                               placeholder="Username" value=""/>--}}
{{--                        <div class="input-group-append">--}}
{{--                            <span class="input-group-text">.com</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--end::Group-->
        </div>
    </div>
    <!--end::Row-->
</div>
<!--end::Tab-->
