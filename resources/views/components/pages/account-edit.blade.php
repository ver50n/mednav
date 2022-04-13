<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        アカウント
      </div>
      <div class="card-body">
        <form action="{{ route('account-post') }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>@lang('validation.attributes.name') <span class="e_required">*</span> </label>
            <input class="form-control input-sm"
              type="text"
              name="name"
              required
              maxlength="255"
              value="{{ old('name') ? old('name') : $user->name}}"
              placeholder="@lang('validation.attributes.name')"
              autocomplete="off"/>
            <small class="c_form__error-block">{{$errors->first('name')}}</small>
          </div>

          <div class="form-group">
            <label>@lang('validation.attributes.email') <span class="e_required">*</span> </label>
            <input class="form-control input-sm"
              type="email"
              name="email"
              required
              maxlength="255"
              value="{{ old('email') ? old('email') : $user->email}}"
              placeholder="@lang('validation.attributes.email')"
              autocomplete="off"/>
            <small class="c_form__error-block">{{$errors->first('email')}}</small>
          </div>

          <div class="form-group">
            <label>@lang('validation.attributes.is_active') <span class="e_required">*</span> </label><small id="isActiveHelp" class="form-text text-muted">アカウント無効化になるので、気を付けてください！</small>
            <select class="form-control input-sm" id="type"
              name="is_active">
              @foreach(\App\Helpers\ApplicationConstant::YES_NO as $value => $label)
              <option value="{{ $value }}"
                {{ ((old('is_active') ?? $user->is_active) === $value) ? 'selected' : '' }}>
                {{ $label }}
              </option>
              @endforeach
            </select>
          </div>

          <button class="btn btn-outline-primary">保存</button>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        パスワード変更
      </div>
      <div class="card-body">

        <form action="{{ route('change-password-post') }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>@lang('validation.attributes.password') <span class="e_required">*</span> </label>
            <input class="form-control input-sm"
              type="password"
              name="password"
              placeholder="@lang('validation.attributes.password')"
              autocomplete="off"/>
            <small class="c_form__error-block">{{$errors->first('password')}}</small>
          </div>
          <div class="form-group">
            <label>@lang('validation.attributes.new_password') <span class="e_required">*</span> </label>
            <input class="form-control input-sm"
              type="password"
              name="new_password"
              placeholder="@lang('validation.attributes.new_password')"
              autocomplete="off"/>
            <small class="c_form__error-block">{{$errors->first('new_password')}}</small>
          </div>
          <div class="form-group">
            <label>@lang('validation.attributes.new_password_confirmation') <span class="e_required">*</span> </label>
            <input class="form-control input-sm"
              type="password"
              name="new_password_confirmation"
              placeholder="@lang('validation.attributes.new_password_confirmation')"
              autocomplete="off"/>
            <small class="c_form__error-block">{{$errors->first('new_password_confirmation')}}</small>
          </div>
          <button class="btn btn-outline-primary">保存</button>
        </form>
      </div>
    </div>
  </div>
</div>