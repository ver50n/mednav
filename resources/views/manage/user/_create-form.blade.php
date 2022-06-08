<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="name"
        value="{{old('name')}}"
        placeholder="@lang('common.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('common.username')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="username"
        value="{{old('username')}}"
        placeholder="@lang('common.username')" />
      <span class="c_form__error-block">{{$errors->first('username')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('common.email')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="email"
        value="{{old('email')}}"
        placeholder="@lang('common.email')" />
      <span class="c_form__error-block">{{$errors->first('email')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('common.is_outsource')</label> <span class="e_required">*</span>
      <select name="is_outsource"
        id="is_outsource"
        class="form-control form-control-sm">
      @foreach(App\Helpers\ApplicationConstant::YES_NO as $key => $value)
        <option value="{{$key}}" {{ $value == old('is_outsource') ? 'selected' : '' }}>
          @lang('application-constant.YES_NO.'.$value)
        </option>
      @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>@lang('common.outsource_name')</label>
      <input class="form-control form-control-sm"
        name="outsource_name"
        value="{{old('outsource_name')}}"
        placeholder="@lang('common.outsource_name')" />
      <span class="c_form__error-block">{{$errors->first('outsource_name')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('common.password')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="password"
        name="password"
        placeholder="@lang('common.password')" />
      <span class="c_form__error-block">{{$errors->first('password')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('common.confirm_password')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        type="password"
        name="confirm_password"
        placeholder="@lang('common.confirm_password')" />
      <span class="c_form__error-block">{{$errors->first('confirm_password')}}</span>
    </div>
    
    <div>
      <button type="submit" class="btn btn-outline-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </span>
      </button>
    </div>
  </form>
</section>