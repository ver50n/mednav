<section class="c_login-form">
  <form action="{{ $loginUrl }}" method="POST">
    @csrf
    <div class="form-wrapper">
      <h4>ログイン</h4>
      <div class="e_separator-line"></div>
      <div class="form-group">
        <label>@lang('common.username') </label> <span class="e_required">*</span>
        <input class="form-control input-sm"
          type="text"
          name="username"
          value="{{old('username')}}"
          placeholder="@lang('common.username') "
          autocomplete="off"/>
        <small class="c_form__error-block">{{$errors->first('username')}}</small>
      </div>
      <div class="form-group">
        <label>@lang('common.password') </label> <span class="e_required">*</span>
        <input class="form-control input-sm"
          type="password"
          name="password"
          value="{{old('password')}}"
          placeholder="@lang('common.password')"
          autocomplete="off"/>
        <small class="c_form__error-block">{{$errors->first('password')}}</small>
      </div>
      <div class="form-group">
        <small class="form-text text-muted" style="float: left;">
          <div>
            <button class="btn btn-outline-primary">ログイン</button>
          </div>
        </small>
      </div>
    </div>
    <br />
  </form>
</section>