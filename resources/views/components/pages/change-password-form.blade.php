<section class="c_login-form">
  <form action="{{ $postUrl }}" method="POST">
    @csrf
    <div class="form-wrapper">
      <h4>@lang('common.change-password')</h4>
      <div class="e_separator-line"></div>
      <div class="form-group">
        <label>@lang('common.password') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="password"
          name="password"
          value="{{old('password')}}"
          placeholder="@lang('common.password') "
          autocomplete="off"/>
        <small class="c_form__error-block">{{$errors->first('password')}}</small>
      </div>
      <div class="form-group">
        <label>@lang('common.confirm_password') </label> <span class="e_required">*</span>
        <input class="form-control form-control-sm"
          type="password"
          name="confirm_password"
          value="{{old('confirm_password')}}"
          placeholder="@lang('common.confirm_password')"
          autocomplete="off"/>
        <small class="c_form__error-block">{{$errors->first('confirm_password')}}</small>
      </div>
      <div class="form-group">
        <small class="form-text text-muted" style="float: left;">
          <div>
            <button class="btn btn-outline-primary">@lang('common.save')</button>
          </div>
        </small>
      </div>
    </div>
    <br />
  </form>
</section>