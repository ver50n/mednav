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
                  class="form-control input-sm">
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
                  class="form-control input-sm">
                @foreach(App\Models\Place::get() as $each)
                  <option value="{{$each['id']}}" {{ $each['id'] == old('place_id') ? 'selected' : '' }}>
                    {{ $each['name'] }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.date_period')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="date_period"
                  id="date_period"
                  value="{{old('date_period') ? old('date_period') : date('Y-m-d')}}"
                  placeholder="@lang('common.date_period')" />
                <span class="c_form__error-block">{{$errors->first('date_period')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.shift')</label> <span class="e_required">*</span>
                <select name="shift"
                  class="form-control input-sm">
                @foreach(App\Helpers\ApplicationConstant::WORKING_SHIFT as $key => $value)
                  <option value="{{$key}}" {{ $value == old('shift') ? 'selected' : '' }}>
                    @lang('application-constant.WORKING_SHIFT.'.$value)
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
            <a data-toggle="collapse" href="#collapse-view__summary-info"
              aria-expanded="true"
              aria-controls="collapse-view__summary-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.summary-info')</i>
            </a>
          </div>
          <div id="collapse-view__summary-info" class="collapse show">
            <div class="card-body">
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
    
    <div class="row">
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
                <label>@lang('common.time_start')</label> <span class="e_required">*</span> (a)
                <input class="form-control input-sm"
                  name="time_start"
                  id="time_start"
                  value="{{ old('time_start') ? old('time_start') : date('Y-m-d 00:00') }}"
                  placeholder="@lang('common.time_start')" />
                <span class="c_form__error-block">{{$errors->first('time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.time_end')</label> <span class="e_required">*</span> (b)
                <input class="form-control input-sm"
                  name="time_end"
                  id="time_end"
                  value="{{ old('time_end') ? old('time_end') : date('Y-m-d 00:00') }}"
                  placeholder="@lang('common.time_end')" />
                <span class="c_form__error-block">{{$errors->first('time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.time_rest')</label> <span class="e_required">*</span> (c)
                <input class="form-control input-sm"
                  name="time_rest"
                  id="time_rest"
                  value="{{ old('time_rest') ? old('time_rest') : '00:00' }}"
                  placeholder="@lang('common.time_rest')" />
                <span class="c_form__error-block">{{$errors->first('time_rest')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_working_hour')</label> <span class="e_required">*</span> (a + b - c)
                <input class="form-control input-sm"
                  name="actual_working_hour"
                  id="actual_working_hour"
                  value="{{ old('actual_working_hour') }}"
                  readOnly
                  placeholder="@lang('common.actual_working_hour')" />
                <span class="c_form__error-block">{{$errors->first('actual_working_hour')}}</span>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div class="col-6">
        <section class="card components__card-section-wrapper">
          <div class="card-header">
            <a data-toggle="collapse" href="#collapse-view__fee-info"
              aria-expanded="true"
              aria-controls="collapse-view__fee-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.fee-info')</i>
            </a>
          </div>
          <div id="collapse-view__fee-info" class="collapse show">
            <div class="card-body">
              
              <div class="form-group">
                <label>@lang('common.handling_fee')</label> <span class="e_required">*</span> (d)
                <input class="form-control input-sm"
                  name="handling_fee"
                  id="handling_fee"
                  value="{{ old('handling_fee') ? old('handling_fee') : 0 }}"
                  placeholder="@lang('common.handling_fee')" />
                <span class="c_form__error-block">{{$errors->first('handling_fee')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('common.transport_fee')</label> <span class="e_required">*</span> (e)
                <input class="form-control input-sm"
                  name="transport_fee"
                  id="transport_fee"
                  value="{{ old('transport_fee') ? old('transport_fee') : 0 }}"
                  placeholder="@lang('common.transport_fee')" />
                <span class="c_form__error-block">{{$errors->first('transport_fee')}}</span>
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
      timeFormat: "HH:mm"
    });

    $('#time_rest').timepicker({
      timeFormat: "HH:mm"
    });

    $('#date_period, #time_start, #time_end, #time_rest').change(function() {
      calculateWorkingHour();
    });
    init();

    function init() {
      calculateWorkingHour();
    }

    function calculateWorkingHour() {
      start = $("#time_start").val();
      end = $("#time_end").val();
      rest = $("#time_rest").val();
      workingHour = getTimeDiff(start,end);

      var restTime = rest.split(':');
      restMinuteToHour = Math.ceil(restTime[1]/100);
      restHour = parseInt(restTime[0]) + restMinuteToHour;
      $("#actual_working_hour").val(workingHour - restHour);
    }

    function getTimeDiff(timeStart, timeEnd) {
      timeStart = moment(timeStart);
      timeEnd = moment(timeEnd);

      var diff = timeEnd.diff(timeStart);
      var tempTime = moment.duration(diff);
      var hour = Math.round(tempTime.asHours());

      return hour
    }
  });
</script>
@endsection