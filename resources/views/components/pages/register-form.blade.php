<section class="c_login-form">
  <form action="{{route('register-post')}}" method="POST">
    @csrf
    <div class="form-wrapper">
      <h4>登録</h4>
      <div class="e_separator-line"></div>
      <div class="form-group">
        <label>@lang('validation.attributes.name') </label> <span class="e_required">*</span>
        <input class="form-control input-sm"
          type="text"
          name="name"
          value="{{old('name')}}"
          placeholder="@lang('validation.attributes.name')"
          autocomplete="off"/>
        <span class="c_form__error-block">{{$errors->first('name')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.email') </label> <span class="e_required">*</span>
        <input class="form-control input-sm"
          type="text"
          name="email"
          value="{{old('email')}}"
          placeholder="@lang('validation.attributes.email')"
          autocomplete="off"/>
        <span class="c_form__error-block">{{$errors->first('email')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.password') </label> <span class="e_required">*</span>
        <input class="form-control input-sm"
          type="password"
          name="password"
          value="{{old('password')}}"
          placeholder="@lang('validation.attributes.password')"
          autocomplete="off"/>
        <span class="c_form__error-block">{{$errors->first('password')}}</span>
      </div>
      <div class="form-group">
        <label>@lang('validation.attributes.confirm_password') </label> <span class="e_required">*</span>
        <input class="form-control input-sm"
          type="password"
          name="confirm_password"
          value="{{old('confirm_password')}}"
          placeholder="@lang('validation.attributes.confirm_password')"
          autocomplete="off"/>
        <span class="c_form__error-block">{{$errors->first('confirm_password')}}</span>
      </div>
      <div>
        <div style="float: left;">
          <button class="btn btn-outline-primary">登録</button>
        </div>
        <div style="float: right;">
          <small class="form-text text-muted">
            <a href="{{ route('login') }}">
              すでに登録した方に
            </a>
          </small>
        </div>
      </div>
    </div>
  </form>
</section>