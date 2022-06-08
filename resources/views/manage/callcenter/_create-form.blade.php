<section class="component__create-form">
  <form action="{{route($routePrefix.'.createPost')}}"
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
                <select name="user_id"
                  class="form-control form-control-sm">
                @foreach(App\Models\User::get() as $each)
                  <option value="{{$each['id']}}" {{ $each['id'] == old('user_id') ? 'selected' : '' }}>
                    {{ $each['name'] }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.place_id')</label> <span class="e_required">*</span>
                <select name="place_id"
                  id="place_id"
                  class="form-control form-control-sm">
                @foreach(App\Models\Place::get() as $each)
                  <option value="{{$each['id']}}" {{ $each['id'] == old('place_id') ? 'selected' : '' }}>
                    {{ $each['name'] }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.date_period')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="date_period"
                  id="date_period"
                  readOnly
                  value="{{old('date_period') ? old('date_period') : date('Y-m-d')}}"
                  placeholder="@lang('common.date_period')" />
                <span class="c_form__error-block">{{$errors->first('date_period')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.status')</label> <span class="e_required">*</span>
                <select name="status"
                  disabled
                  id="status"
                  class="form-control form-control-sm">
                @foreach(App\Helpers\ApplicationConstant::CALLCENTER_STATUS as $key => $value)
                  <option value="{{$key}}" {{ $value == old('status') ? 'selected' : '' }}>
                    @lang('application-constant.CALLCENTER_STATUS.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
            </div>
          </div>
        </section>
      </div>
      
      <div class="col-6">
        <section class="card components__card-section-wrapper">
          <div class="card-header">
            <a data-toggle="collapse" href="#collapse-view__working-info"
              aria-expanded="true"
              aria-controls="collapse-view__working-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.working-info')</i>
            </a>
          </div>
          <div id="collapse-view__working-info" class="collapse show">
            <div class="card-body">
              <div class="form-group">
                <label>@lang('common.time_start')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="time_start"
                  id="time_start"
                  readOnly
                  value="{{ old('time_start') ? old('time_start') : date('Y-m-d 00:00:00') }}"
                  placeholder="@lang('common.time_start')" />
                <span class="c_form__error-block">{{$errors->first('time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.time_end')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="time_end"
                  id="time_end"
                  readOnly
                  value="{{ old('time_end') ? old('time_end') : date('Y-m-d 00:00:00') }}"
                  placeholder="@lang('common.time_end')" />
                <span class="c_form__error-block">{{$errors->first('time_end')}}</span>
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
@section('javascript')

<script>
  $( function() {
    $('#date_period').datepicker({
      dateFormat: "yy-mm-dd"
    });
    
    $('#time_start, #time_end').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm:ss",
      stepMinute: 15,
    });
  });
</script>
@endsection