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
                  class="form-control form-control-sm">
                @foreach(App\Models\User::get() as $each)
                  <option value="{{$each['id']}}" {{ $oldValue == $each['id'] ? 'selected' : '' }}>
                    {{ $each['name'] }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.place_id')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('place_id') ? old('place_id') : $obj->place_id;
                @endphp
                <select name="place_id"
                  id="place_id"
                  class="form-control form-control-sm">
                @foreach(App\Models\Place::get() as $each)
                  <option value="{{$each['id']}}" {{ $oldValue == $each['id'] ? 'selected' : '' }}>
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
                  value="{{old('date_period') ? old('date_period') : $obj->date_period}}"
                  placeholder="@lang('common.date_period')" />
                <span class="c_form__error-block">{{$errors->first('date_period')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.status')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('status') ? old('status') : $obj->status;
                @endphp
                <select name="status"
                  id="status"
                  class="form-control form-control-sm">
                @foreach(App\Helpers\ApplicationConstant::CALLCENTER_STATUS as $key => $value)
                  <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
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
                  value="{{ old('time_start') ? old('time_start') : $obj->time_start->format('Y-m-d H:i') }}"
                  placeholder="@lang('common.time_start')" />
                <span class="c_form__error-block">{{$errors->first('time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.time_end')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="time_end"
                  id="time_end"
                  readOnly
                  value="{{ old('time_end') ? old('time_end') : $obj->time_end->format('Y-m-d H:i') }}"
                  placeholder="@lang('common.time_end')" />
                <span class="c_form__error-block">{{$errors->first('time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.working_hour')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="working_hour"
                  id="working_hour"
                  readOnly
                  value="{{ old('working_hour') ? old('working_hour') : $obj->working_hour }}"
                  placeholder="@lang('common.working_hour')" />
                <span class="c_form__error-block">{{$errors->first('working_hour')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.shift')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('shift') ? old('shift') : $obj->shift;
                @endphp
                <select name="shift"
                  id="shift"
                  readOnly
                  class="form-control form-control-sm">
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
                <label>@lang('common.actual_time_start')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="actual_time_start"
                  id="actual_time_start"
                  readOnly
                  value="{{ old('actual_time_start') ? old('actual_time_start') : $obj->actual_time_start->format('Y-m-d H:i') }}"
                  placeholder="@lang('common.actual_time_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_end')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="actual_time_end"
                  id="actual_time_end"
                  readOnly
                  value="{{ old('actual_time_end') ? old('actual_time_end') : $obj->actual_time_end->format('Y-m-d H:i') }}"
                  placeholder="@lang('common.actual_time_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_rest')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="actual_time_rest"
                  id="actual_time_rest"
                  readOnly
                  value="{{ old('actual_time_rest') ? old('actual_time_rest') : $obj->actual_time_rest }}"
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
                <label>@lang('common.handling_fee')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm price-field"
                  name="handling_fee"
                  id="handling_fee"
                  value="{{ old('handling_fee') ? old('handling_fee') : $obj->handling_fee }}"
                  placeholder="@lang('common.handling_fee')" />
                <span class="c_form__error-block">{{$errors->first('handling_fee')}}</span>
              </div>

              <div class="form-group">
                <label>@lang('common.transport_fee')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm price-field"
                  name="transport_fee"
                  id="transport_fee"
                  value="{{ old('transport_fee') ? old('transport_fee') : $obj->transport_fee }}"
                  placeholder="@lang('common.transport_fee')" />
                <span class="c_form__error-block">{{$errors->first('transport_fee')}}</span>
              </div>
              
              <div class="form-group">
                <label>@lang('common.note')</label>
                <textarea class="form-control form-control-sm"
                  name="note"
                  id="note"
                  placeholder="@lang('common.note')">{{ old('note') ? old('note') : $obj->note }}</textarea>
                <span class="c_form__error-block">{{$errors->first('note')}}</span>
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
                      <input class="form-control form-control-sm"
                        name="actual_working_hour"
                        id="actual_working_hour"
                        value="{{ old('actual_working_hour') ? old('actual_working_hour') : $obj->actual_working_hour }}"
                        readOnly
                        placeholder="@lang('common.actual_working_hour')" />
                      <span class="c_form__error-block">{{$errors->first('actual_working_hour')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.actual_overtime')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm"
                        name="actual_overtime"
                        id="actual_overtime"
                        value="{{ old('actual_overtime') ? old('actual_overtime') : $obj->actual_overtime }}"
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
                    <th><label><label>@lang('common.morning_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="morning_wage"
                        id="morning_wage"
                        value="{{ old('morning_wage') ? old('morning_wage') : $obj->morning_wage }}"
                        readOnly
                        placeholder="@lang('common.morning_wage')" />
                      <span class="c_form__error-block">{{$errors->first('morning_wage')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.noon_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="noon_wage"
                        id="noon_wage"
                        value="{{ old('morning_wage') ? old('noon_wage') : $obj->noon_wage }}"
                        readOnly
                        placeholder="@lang('common.noon_wage')" />
                      <span class="c_form__error-block">{{$errors->first('noon_wage')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.night_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="night_wage"
                        id="night_wage"
                        value="{{ old('night_wage') ? old('night_wage') : $obj->night_wage }}"
                        readOnly
                        placeholder="@lang('common.night_wage')" />
                      <span class="c_form__error-block">{{$errors->first('night_wage')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.night_overtime_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="night_overtime_wage"
                        id="night_overtime_wage"
                        value="{{ old('night_overtime_wage') ? old('night_overtime_wage') : $obj->night_overtime_wage }}"
                        readOnly
                        placeholder="@lang('common.night_overtime_wage')" />
                      <span class="c_form__error-block">{{$errors->first('night_overtime_wage')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.overtime_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="overtime_wage"
                        id="overtime_wage"
                        value="{{ old('overtime_wage') ? old('overtime_wage') : $obj->overtime_wage }}"
                        readOnly
                        placeholder="@lang('common.overtime_wage')" />
                      <span class="c_form__error-block">{{$errors->first('overtime_wage')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.holiday_wage')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="holiday_wage"
                        id="holiday_wage"
                        value="{{ old('holiday_wage') ? old('holiday_wage') : $obj->holiday_wage }}"
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
                    <th><label><label>@lang('common.actual_working_hour_payment')</label></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="actual_working_hour_payment"
                        id="actual_working_hour_payment"
                        value="{{ old('actual_working_hour_payment') ? old('actual_working_hour_payment') : $obj->actual_working_hour_payment }}"
                        readOnly
                        placeholder="@lang('common.actual_working_hour_payment')" />
                      <span class="c_form__error-block">{{$errors->first('actual_working_hour_payment')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.actual_overtime_hour_payment')</label></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="actual_overtime_hour_payment"
                        id="actual_overtime_hour_payment"
                        value="{{ old('actual_overtime_hour_payment') ? old('actual_overtime_hour_payment') : $obj->actual_overtime_hour_payment }}"
                        readOnly
                        placeholder="@lang('common.actual_overtime_hour_payment')" />
                      <span class="c_form__error-block">{{$errors->first('actual_overtime_hour_payment')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.user_payment')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="user_payment"
                        id="user_payment"
                        value="{{ old('user_payment') ? old('user_payment') : $obj->user_payment }}"
                        readOnly
                        placeholder="@lang('common.user_payment')" />
                      <span class="c_form__error-block">{{$errors->first('user_payment')}}</span>
                    </label></td>
                  </tr>
                  <tr>
                    <th><label><label>@lang('common.invoice_payment')</label> <span class="e_required">*</span></label></th>
                    <td><label>
                      <input class="form-control form-control-sm price-field"
                        name="invoice_payment"
                        id="invoice_payment"
                        value="{{ old('invoice_payment') ? old('invoice_payment') : $obj->invoice_payment }}"
                        readOnly
                        placeholder="@lang('common.invoice_payment')" />
                      <span class="c_form__error-block">{{$errors->first('invoice_payment')}}</span>
                    </label></td>
                  </tr>
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
    morningWage = {{ $obj->morning_wage }};
    noonWage = {{ $obj->noon_wage }};
    nightWage = {{ $obj->night_wage }};
    overtimeWage = {{ $obj->overtime_wage }};
    nightOvertimeWage = {{ $obj->night_overtime_wage }};
    holidayWage = {{ $obj->holiday_wage }};
    shift = "{{ $obj->shift }}";

    normalWage = 0;
    otWage = 0;
    normalWagePerMinute = 0;
    otWagePerMinute = 0;
    setWage();

    $('#date_period').datepicker({
      dateFormat: "yy-mm-dd"
    });
    
    $('#time_end, #actual_time_start, #actual_time_end').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm",
      stepMinute: 15,
    });

    $('#actual_time_rest').timepicker({
      timeFormat: "HH:mm",
      stepMinute: 15,
    });

    $("#place_id").change(function() {
      getWages();
    });

    $("#time_start").datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm",
      stepMinute: 15,
      onSelect: function() {
        getShift();
      }
    });

    $('#date_period, #time_start, #time_end, #actual_time_start, #actual_time_end, #actual_time_rest, #transport_fee, #handling_fee').change(function() {
      calculateWorkingHour();
    });


    function getWages() {
      placeId = $("#place_id").val();
      jobtype = "callcenter";

      $.ajax({
        url: "/manage/place/"+placeId+"/get-wages",
        data: {
          place_id: placeId,
          jobtype: jobtype,
        },
        success: function(res) {
          res = JSON.parse(res);

          morningWage = res["morning_wage"];
          noonWage = res["noon_wage"];
          nightWage = res["night_wage"];
          overtimeWage = res["night_overtime_wage"];
          nightOvertimeWage = res["overtime_wage"];
          holidayWage = res["holiday_wage"];

          $("#morning_wage").val(res["morning_wage"]).blur();
          $("#noon_wage").val(res["noon_wage"]).blur();
          $("#night_wage").val(res["night_wage"]).blur();
          $("#night_overtime_wage").val(res["night_overtime_wage"]).blur();
          $("#overtime_wage").val(res["overtime_wage"]).blur();
          $("#holiday_wage").val(res["holiday_wage"]).blur();
          setWage();
        }
      });
    }
    
    function getShift() {
      placeId = $("#place_id").val();
      timeStart = $("#time_start").val();

      $.ajax({
        url: "/manage/place/"+placeId+"/get-shift",
        data: {
          place_id: placeId,
          timeStart: timeStart,
        },
        success: function(res) {
          res = JSON.parse(res);

          shift = res["shift"];

          $("#shift").val(res["shift"]).blur();
          setWage();
        }
      });
    }

    function setWage() {
      if(shift == "morning") {
        normalWage = morningWage;
        otWage = overtimeWage;
      } else if(shift == "noon") {
        normalWage = noonWage;
        otWage = overtimeWage;
      } else {
        normalWage = nightWage;
        otWage = nightOvertimeWage;
      }
      normalWagePerMinute = normalWage / 60;
      otWagePerMinute = otWage / 60;
    }

    function calculateWorkingHour() {
      transportFee = parseInt($("#transport_fee").val().replace(/,/g, ''));
      handlingFee = parseInt($("#handling_fee").val().replace(/,/g, ''));
      start = $("#time_start").val();
      momentStart = moment(start+":00");
      end = $("#time_end").val();
      momentEnd = moment(end+":00");
      actualStart = $("#actual_time_start").val();
      momentActualStart = moment(actualStart+":00");
      actualEnd = $("#actual_time_end").val();
      momentActualEnd = moment(actualEnd+":00");
      actualRest = $("#actual_time_rest").val();
      momentActualRest = moment.duration(actualRest+":00");
      
      workingDuration = getTimeDiff(momentStart,momentEnd);
      $("#working_hour").val(workingDuration[0]+":"+workingDuration[1]);

      endSubstractRestDuration = momentActualEnd.subtract(momentActualRest);
      actualWorkingDuration = getTimeDiff(moment(actualStart),endSubstractRestDuration);

      actualWorkingDurationHour = actualWorkingDuration[0];
      actualWorkingDurationMinute = actualWorkingDuration[1];
      actualOvertimeHour = 0;
      actualOvertimeMinute = 0;
      if(actualWorkingDuration[0] > 8) {
        actualWorkingDurationHour = 8;
        actualWorkingDurationMinute = 0;
        actualOvertimeMinute = actualWorkingDuration[1];
        actualOvertimeHour = actualWorkingDuration[0] - actualWorkingDurationHour;
      }

      $("#actual_working_hour").val(actualWorkingDurationHour+":"+actualWorkingDurationMinute);
      $("#actual_overtime").val(actualOvertimeHour+":"+actualOvertimeMinute);

      actualWorkingHourPayment = normalWage * actualWorkingDurationHour;
      actualWorkingHourPayment += normalWagePerMinute * actualWorkingDurationMinute;
      actualOvertimeHourPayment = otWage * actualOvertimeHour;
      actualOvertimeHourPayment += otWagePerMinute * actualOvertimeMinute;

      $("#actual_working_hour_payment").val(actualWorkingHourPayment).blur();
      $("#actual_overtime_hour_payment").val(actualOvertimeHourPayment).blur();
      userPayment = actualWorkingHourPayment + actualOvertimeHourPayment + transportFee;
      $("#user_payment").val(userPayment).blur();
      invoicePayment = userPayment + handlingFee;
      $("#invoice_payment").val(invoicePayment).blur();
    }

    function getTimeDiff(t1, t2) {

      var diff = t2.diff(t1);
      var tempTime = moment.duration(diff);

      day = tempTime._data.days
      hour = tempTime._data.hours
      minute = tempTime._data.minutes

      if (day > 0)
        hour = hour + (day * 24);

      return [hour, minute]
    }
  });
</script>
@endsection