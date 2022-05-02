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
      <label>@lang('common.address')</label>
      <textarea class="form-control form-control-sm"
        rows="5"
        name="address"
        placeholder="@lang('common.address')">{{ old('address') ? old('address') : $obj->address }}</textarea>
      <span class="c_form__error-block">{{$errors->first('address')}}</span>
    </div>
    
    <div class="form-group">
      <label>@lang('common.desc')</label>
      <textarea class="form-control form-control-sm"
        rows="5"
        name="desc"
        placeholder="@lang('common.desc')">{{ old('desc') ? old('desc') : $obj->desc }}</textarea>
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