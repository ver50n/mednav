<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    
    <div class="row">
      <div class="col-12">
      </div>
    </div>

    <div class="row">
      <div class="col-12">
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
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_start') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_start"
                  id="actual_time_start"
                  readOnly
                  value="{{ old('actual_time_start') ? old('actual_time_start') : $obj->actual_time_start->format('Y-m-d H:i') }}"
                  placeholder="@lang('common.actual_time_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_start')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_end') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_end"
                  id="actual_time_end"
                  readOnly
                  value="{{ old('actual_time_end') ? old('actual_time_end') : $obj->actual_time_end->format('Y-m-d H:i') }}"
                  placeholder="@lang('common.actual_time_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_end')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_rest') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_rest"
                  id="actual_time_rest"
                  readOnly
                  value="{{ old('actual_time_rest') ? old('actual_time_rest') : $obj->actual_time_rest }}"
                  placeholder="@lang('common.actual_time_rest')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.transport_fee') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2 price-field"
                  name="transport_fee"
                  id="transport_fee"
                  value="{{ old('transport_fee') ? old('transport_fee') : $obj->transport_fee }}"
                  placeholder="@lang('common.transport_fee')" />
                <span class="c_form__error-block">{{$errors->first('transport_fee')}}</span>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.note')</label>
                <textarea class="form-control form-control-sm col-sm-2"
                  name="note"
                  id="note"
                  placeholder="@lang('common.note')">{{ old('note') ? old('note') : $obj->note }}</textarea>
                <span class="c_form__error-block">{{$errors->first('note')}}</span>
              </div>
            
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_working_hour') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_working_hour"
                  id="actual_working_hour"
                  readOnly
                  value="{{ old('actual_working_hour') ? old('actual_working_hour') : $obj->actual_working_hour }}"
                  placeholder="@lang('common.actual_working_hour')" />
                  <span class="c_form__error-block">{{$errors->first('actual_working_hour')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_overtime') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_overtime"
                  id="actual_overtime"
                  readOnly
                  value="{{ old('actual_overtime') ? old('actual_overtime') : $obj->actual_overtime }}"
                  placeholder="@lang('common.actual_overtime')" />
                <span class="c_form__error-block">{{$errors->first('actual_overtime')}}</span>
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
              <div>
                <button type="button" class="btn btn-outline-primary calculate">
                  <span class="action-icon">
                    <i class="c_icon fas fa-calculator menu-icon"></i> @lang('common.calculate')
                  </span>
                </button>
              </div>

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
                      <small id="emailHelp" class="form-text text-muted">
                        
                      </small>
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
                    <th><label><label>@lang('common.user_payment')</label></label></th>
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
  $(function() {
    morningWage = {{ $obj->morning_wage }};
    noonWage = {{ $obj->noon_wage }};
    nightWage = {{ $obj->night_wage }};
    overtimeWage = {{ $obj->overtime_wage }};
    nightOvertimeWage = {{ $obj->night_overtime_wage }};
    holidayWage = {{ $obj->holiday_wage }};
    shift = "{{ $obj->shift }}";

    normalWage = 0;
    otWage = 0;

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

    $('#actual_time_start, #actual_time_end').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm",
      stepMinute: 15,
    });
    $('#actual_time_rest').timepicker({
      timeFormat: "HH:mm",
      stepMinute: 15,
    });
    $('#actual_time_start, #actual_time_end, #actual_time_rest, #transport_fee').change(function() {
      console.log(1);
      calculateWorkingHour();
    });
    $(".calculate").click(function () {
      calculateWorkingHour();
    });

    function calculateWorkingHour() {
      transportFee = parseInt($("#transport_fee").val().replace(/,/g, ''));
      
      actualStart = $("#actual_time_start").val();
      momentActualStart = moment(actualStart+":00");
      actualEnd = $("#actual_time_end").val();
      momentActualEnd = moment(actualEnd+":00");
      actualRest = $("#actual_time_rest").val();
      momentActualRest = moment.duration(actualRest+":00");
      

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