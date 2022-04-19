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
                  id="place_id"
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
                  id="shift"
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
                <input class="form-control input-sm"
                  name="time_start"
                  id="time_start"
                  value="{{ old('time_start') ? old('time_start') : date('Y-m-d 00:00') }}"
                  placeholder="@lang('common.time_start')" />
                <span class="c_form__error-block">{{$errors->first('time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.time_end')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="time_end"
                  id="time_end"
                  value="{{ old('time_end') ? old('time_end') : date('Y-m-d 00:00') }}"
                  placeholder="@lang('common.time_end')" />
                <span class="c_form__error-block">{{$errors->first('time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.working_hour')</label> <span class="e_required">*</span>
                <input class="form-control input-sm"
                  name="working_hour"
                  id="working_hour"
                  readOnly
                  value="{{ old('working_hour') ? old('working_hour') : '00:00' }}"
                  placeholder="@lang('common.working_hour')" />
                <span class="c_form__error-block">{{$errors->first('working_hour')}}</span>
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
    
    <div class="row">
      <div class="col-6">
        <section class="card components__card-section-wrapper">
          <div class="card-header">
            <a data-toggle="collapse" href="#collapse-view__actual-working-info"
              aria-expanded="true"
              aria-controls="collapse-view__actual-working-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.actual-working-info')</i>
            </a>
          </div>
          <div id="collapse-view__actual-working-info" class="collapse show">
            <div class="card-body">
              <div class="form-group">
                <label>@lang('common.actual_time_start')</label> <span class="e_required">*</span> (a)
                <input class="form-control input-sm"
                  name="actual_time_start"
                  id="actual_time_start"
                  value="{{ old('actual_time_start') ? old('actual_time_start') : date('Y-m-d 00:00') }}"
                  placeholder="@lang('common.actual_time_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_end')</label> <span class="e_required">*</span> (b)
                <input class="form-control input-sm"
                  name="actual_time_end"
                  id="actual_time_end"
                  value="{{ old('actual_time_end') ? old('actual_time_end') : date('Y-m-d 00:00') }}"
                  placeholder="@lang('common.actual_time_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_rest')</label> <span class="e_required">*</span> (c)
                <input class="form-control input-sm"
                  name="actual_time_rest"
                  id="actual_time_rest"
                  value="{{ old('actual_time_rest') ? old('actual_time_rest') : '00:00' }}"
                  placeholder="@lang('common.actual_time_rest')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest')}}</span>
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
                  type="number"
                  name="handling_fee"
                  id="handling_fee"
                  value="{{ old('handling_fee') ? old('handling_fee') : 0 }}"
                  placeholder="@lang('common.handling_fee')" />
                <span class="c_form__error-block">{{$errors->first('handling_fee')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('common.transport_fee')</label> <span class="e_required">*</span> (e)
                <input class="form-control input-sm"
                  type="number"
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

    <div class="row">
      <div class="col-12">
        <section class="card components__card-section-wrapper">
          <div class="card-header">
            <a data-toggle="collapse" href="#collapse-view__actual-summary-info"
              aria-expanded="true"
              aria-controls="collapse-view__actual-summary-info"
              id="view" class="d-block">
              <i class="c_icon fa fa-chevron-down pull-right"> @lang('common.actual-summary-info')</i>
            </a>
          </div>
          <div id="collapse-view__actual-summary-info" class="collapse show">
            <div class="card-body">
              <h5>労働時間まとめ</h5>
              <table class="table table-bordered table-striped table-hover table-condensed">
                <tbody>
                  <tr>
                    <th><label><label>@lang('common.actual_working_hour')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm"
                        name="actual_working_hour"
                        id="actual_working_hour"
                        value="{{ old('actual_working_hour') ? old('actual_working_hour') : '00:00' }}"
                        readOnly
                        placeholder="@lang('common.actual_working_hour')" />
                      <span class="c_form__error-block">{{$errors->first('actual_working_hour')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.actual_overtime_start')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm"
                        name="actual_overtime_start"
                        id="actual_overtime_start"
                        value="{{ old('actual_overtime_start') ? old('actual_overtime_start') : '00:00' }}"
                        readOnly
                        placeholder="@lang('common.actual_overtime_start')" />
                      <span class="c_form__error-block">{{$errors->first('actual_overtime_start')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.actual_overtime_end')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm"
                        name="actual_overtime_end"
                        id="actual_overtime_end"
                        value="{{ old('actual_overtime_end') ? old('actual_overtime_end') : '00:00' }}"
                        readOnly
                        placeholder="@lang('common.actual_overtime_end')" />
                      <span class="c_form__error-block">{{$errors->first('actual_overtime_end')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.actual_overtime')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm"
                        name="actual_overtime"
                        id="actual_overtime"
                        value="{{ old('actual_overtime') ? old('actual_overtime') : '00:00' }}"
                        readOnly
                        placeholder="@lang('common.actual_overtime')" />
                      <span class="c_form__error-block">{{$errors->first('actual_overtime')}}</span>
                    </label></td>
                  </tr>
                </tbody>
              </table>

              <h5>時給まとめ</h5>
              <table class="table table-bordered table-striped table-hover table-condensed">
                <tbody>
                  <tr>
                    <th><label><label>@lang('common.normal_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="normal_wage"
                        id="normal_wage"
                        value="{{ old('normal_wage') ? old('normal_wage') : '0' }}"
                        readOnly
                        placeholder="@lang('common.normal_wage')" />
                      <span class="c_form__error-block">{{$errors->first('normal_wage')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.night_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="night_wage"
                        id="night_wage"
                        value="{{ old('night_wage') ? old('night_wage') : '0' }}"
                        readOnly
                        placeholder="@lang('common.night_wage')" />
                      <span class="c_form__error-block">{{$errors->first('night_wage')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.late_night_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="late_night_wage"
                        id="late_night_wage"
                        value="{{ old('late_night_wage') ? old('late_night_wage') : '0' }}"
                        readOnly
                        placeholder="@lang('common.late_night_wage')" />
                      <span class="c_form__error-block">{{$errors->first('late_night_wage')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.overtime_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="overtime_wage"
                        id="overtime_wage"
                        value="{{ old('overtime_wage') ? old('overtime_wage') : '0' }}"
                        readOnly
                        placeholder="@lang('common.overtime_wage')" />
                      <span class="c_form__error-block">{{$errors->first('overtime_wage')}}</span>
                    </label></td>
                  </tr>
                  </tr>
                    <th><label><label>@lang('common.holiday_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="holiday_wage"
                        id="holiday_wage"
                        value="{{ old('holiday_wage') ? old('holiday_wage') : '0' }}"
                        readOnly
                        placeholder="@lang('common.holiday_wage')" />
                      <span class="c_form__error-block">{{$errors->first('holiday_wage')}}</span>
                    </label></td>
                  </tr>
                </tbody>
              </table>
              
              <h5>計算まとめ</h5>
              <table class="table table-bordered table-striped table-hover table-condensed">
                <tbody>
                  <tr>
                    <th><label><label>@lang('common.user_payment')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="user_payment"
                        id="user_payment"
                        value="{{ old('user_payment') ? old('user_payment') : '0' }}"
                        readOnly
                        placeholder="@lang('common.user_payment')" />
                      <span class="c_form__error-block">{{$errors->first('user_payment')}}</span>
                    </label></td>
                  <tr>
                  </tr>
                    <th><label><label>@lang('common.actual_payment')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control input-sm price-field"
                        name="actual_payment"
                        id="actual_payment"
                        value="{{ old('actual_payment') ? old('actual_payment') : '0' }}"
                        readOnly
                        placeholder="@lang('common.actual_payment')" />
                      <span class="c_form__error-block">{{$errors->first('actual_payment')}}</span>
                    </label></td>
                  <tr>
                </tbody>
              </table>

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
    
    $('#time_start, #time_end,#actual_time_start, #actual_time_end').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm",
      stepMinute: 15,
    });

    $('#actual_time_rest').timepicker({
      timeFormat: "HH:mm",
      stepMinute: 15,
    });

    $("#place_id, #shift").change(function() {
      getWages();
    });

    $('#date_period, #time_start, #time_end, #actual_time_start, #actual_time_end, #actual_time_rest').change(function() {
      calculateWorkingHour();
    });
    init();

    function init() {
      calculateWorkingHour();
    }

    function getWages() {
      placeId = $("#place_id").val();
      shift = $("#shift").val();
      jobtype = "callcenter";

      $.ajax({
        url: "/manage/place/"+placeId+"/get-wages",
        data: {
          place_id: placeId,
          jobtype: jobtype,
          shift: shift
        },
        success: function(res) {
          res = JSON.parse(res);
          $("#normal_wage").val(res["normal_wage"]).blur();
          $("#night_wage").val(res["night_wage"]).blur();
          $("#late_night_wage").val(res["late_night_wage"]).blur();
          $("#overtime_wage").val(res["overtime_wage"]).blur();
          $("#holiday_wage").val(res["holiday_wage"]).blur();
        }
      });
    }

    function calculateWorkingHour() {
      start = $("#time_start").val();
      end = $("#time_end").val();
      actualStart = $("#actual_time_start").val();
      actualEnd = $("#actual_time_end").val();
      actualRest = $("#actual_time_rest").val();

      workingDuration = getTimeDiff(start,end);
      actualWorkingDuration = getTimeDiff(actualStart,actualEnd);
      overtimeStartDuration = getTimeDiff(actualStart,start);
      $("#actual_overtime_start").val(zeroPad(overtimeStartDuration._data.hours,2)+":"+zeroPad(overtimeStartDuration._data.minutes,2));
      overtimeEndDuration = getTimeDiff(end,actualEnd);
      $("#actual_overtime_end").val(zeroPad(overtimeEndDuration._data.hours,2)+":"+zeroPad(overtimeEndDuration._data.minutes);

      $("#total_actual_overtime").val((overtimeStartDuration._data.hours+overtimeEndDuration._data.hours)+":"+(overtimeStartDuration._data.minutes+overtimeEndDuration._data.minutes));
      $("#working_hour").val(zeroPad(workingDuration._data.hours,2)+":"+zeroPad(workingDuration._data.minutes,2));
      $("#actual_working_hour").val(zeroPad(actualWorkingDuration._data.hours,2)+":"+zeroPad(actualWorkingDuration._data.minutes,2));

      var restDuration = actualRest.split(':');
      restDurationHour = parseInt(restDuration[0]);
      restDurationMinute = parseInt(restDuration[1]);
    }

    function getTimeDiff(t1, t2) {
      t1 = moment(t1);
      t2 = moment(t2);

      var diff = t2.diff(t1);
      var tempTime = moment.duration(diff);

      return tempTime
    }
  });
</script>
@endsection