<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label>@lang('common.name')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="name"
        value="{{old('name') ? old('name') : $obj->name}}"
        placeholder="@lang('common.name')" />
      <span class="c_form__error-block">{{$errors->first('name')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('common.email')</label> <span class="e_required">*</span>
      <input class="form-control form-control-sm"
        name="email"
        value="{{old('email') ? old('email') : $obj->email}}"
        placeholder="@lang('common.email')" />
      <span class="c_form__error-block">{{$errors->first('email')}}</span>
    </div>

    <div class="form-group">
      <label>@lang('common.password')</label>
      <input class="form-control form-control-sm"
        type="password"
        name="password"
        placeholder="@lang('common.password')" />
      <span class="c_form__error-block">{{$errors->first('password')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.confirm_password')</label>
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