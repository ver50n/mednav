<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-6">
        <section class="card components__card-section-wrapper">
          <div class="card-header">
            <a data-toggle="collapse" href="#collapse-view__base-info"
              aria-expanded="true"
              aria-controls="collapse-view__base-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.basic-info')</i>
            </a>
          </div>
          <div id="collapse-view__base-info" class="collapse show">
            <div class="card-body">
              <div class="form-group">
                <label>@lang('common.user_id')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('user_id') ? old('user_id') : $obj->user_id;
                @endphp
                <select name="user_id"
                  class="form-control input-sm">
                @foreach(App\Models\User::get()  as $each)
                  <option value="{{$each['id']}}" {{ $oldValue == $each['id'] ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.place_id')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('userplace_id_id') ? old('place_id') : $obj->place_id;
                @endphp
                <select name="place_id"
                  class="form-control input-sm">
                @foreach(App\Models\Place::get()  as $each)
                  <option value="{{$each['id']}}" {{ $oldValue == $each['id'] ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.date_period')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="date_period"
                  id="date_period"
                  value="{{old('date_period') ? old('date_period') : $obj->date_period}}"
                  placeholder="@lang('common.date_period')" />
                <span class="c_form__error-block">{{$errors->first('date_period')}}</span>
                
                <script>
                $( function() {
                  $('#date_period').datepicker({
                    dateFormat: "yy-mm-dd"
                  });
                } );
                </script>
              </div>
              <div class="form-group">
                <label>@lang('common.shift')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('shift') ? old('shift') : $obj->shift;
                @endphp
                <select name="shift"
                  class="form-control input-sm">
                @foreach(App\Helpers\ApplicationConstant::WORKING_SHIFT as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                      @lang('application-constant.WORKING_SHIFT.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
              <div>
                <button type="submit" class="btn btn-outline-primary">
                  <span class="action-icon">
                    <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
                  </span>
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </form>
</section>