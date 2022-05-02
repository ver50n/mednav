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
      <label>@lang('common.address')</label>
      <textarea class="form-control form-control-sm"
        name="address"
        rows="5"
        placeholder="@lang('common.address')">{{old('address')}}</textarea>
      <span class="c_form__error-block">{{$errors->first('address')}}</span>
    </div>
    <div class="form-group">
      <label>@lang('common.desc')</label>
      <textarea class="form-control form-control-sm"
        name="desc"
        rows="5"
        placeholder="@lang('common.desc')">{{old('desc')}}</textarea>
      <span class="c_form__error-block">{{$errors->first('desc')}}</span>
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