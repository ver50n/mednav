<section class="component__hourly-wage-form">
  <form action="{{route($routePrefix.'.updateWagePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="place_id" value="{{ $id }}" />
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
      <thead>
        <th>@lang('common.shift')</th>
        <th>@lang('common.jobtype')</th>
        <th>@lang('common.normal_wage')</th>
        <th>@lang('common.night_wage')</th>
        <th>@lang('common.late_night_wage')</th>
        <th>@lang('common.overtime_wage')</th>
        <th>@lang('common.holiday_wage')</th>
        <th>@lang('common.action')</th>
      </thead>
      <tbody class="wage-info">
        @foreach($obj->placeHourlywages as $wage)
        <tr>
          <td>
            <div class="form-group">
              <input type="hidden" name="id[]" value="{{$wage->id}}" />
              <select name="shift[]"
                class="form-control input-sm">
              @php
                $oldValue = old('shift') ? old('shift') : $wage->shift;
              @endphp
              @foreach(App\Helpers\ApplicationConstant::WORKING_SHIFT as $key => $value)
                <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                  @lang('application-constant.WORKING_SHIFT.'.$value)
                </option>
              @endforeach
              </select>
          </td>
          <td>
            <div class="form-group">
              <select name="jobtype[]"
                class="form-control input-sm">
              @php
                $oldValue = old('jobtype') ? old('jobtype') : $wage->jobtype;
              @endphp
              @foreach(App\Helpers\ApplicationConstant::JOBTYPE as $key => $value)
                <option value="{{$key}}" {{ $oldValue == $key ? 'selected' : '' }}>
                  @lang('application-constant.JOBTYPE.'.$value)
                </option>
              @endforeach
              </select>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control input-sm normal-wage price-field"
                name="normal_wage[]"
                value="{{old('normal_wage') ? old('normal_wage') : $wage->normal_wage}}"
                placeholder="@lang('common.normal_wage')" />
              <span class="c_form__error-block">{{$errors->first('normal_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control input-sm night-wage price-field"
                name="night_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night'] }}"
                value="{{old('night_wage') ? old('night_wage') : $wage->night_wage}}"
                placeholder="@lang('common.night_wage')" />
              <span class="c_form__error-block">{{$errors->first('night_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control input-sm overtime-wage price-field"
                name="overtime_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}"
                value="{{old('overtime_wage') ? old('overtime_wage') : $wage->overtime_wage}}"
                placeholder="@lang('common.overtime_wage')" />
              <span class="c_form__error-block">{{$errors->first('overtime_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control input-sm late-night-wage price-field"
                name="late_night_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['late_night'] }}"
                value="{{old('late_night_wage') ? old('late_night_wage') : $wage->late_night_wage}}"
                placeholder="@lang('common.late_night_wage')" />
              <span class="c_form__error-block">{{$errors->first('late_night_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control input-sm holiday-wage price-field"
                name="holiday_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}"
                value="{{old('holiday_wage') ? old('holiday_wage') : $wage->holiday_wage}}"
                placeholder="@lang('common.holiday_wage')" />
              <span class="c_form__error-block">{{$errors->first('holiday_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="icon-wrapper add-clone">
              <span class="action-icon">
                <i class="c_icon icon fas fa-plus menu-icon" title="add"></i>
              </span>
            </div>
            <div class="icon-wrapper remove-clone">
              <span class="action-icon">
                <i class="c_icon icon fas fa-trash menu-icon" title="remove"></i>
              </span>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div>
      <button type="submit" class="btn btn-outline-primary">
        <span class="action-icon">
          <i class="c_icon fas fa-save menu-icon"></i> @lang('common.save')
        </span>
      </button>
    </div>
  </form>
</form>
<table style="display:none;">
  <tr class="clone-source">
    <td>
      <div class="form-group">
        <select name="shift[]"
          class="form-control input-sm">
        @foreach(App\Helpers\ApplicationConstant::WORKING_SHIFT as $key => $value)
          <option value="{{$key}}">
            @lang('application-constant.WORKING_SHIFT.'.$value)
          </option>
        @endforeach
        </select>
    </td>
    <td>
      <div class="form-group">
        <select name="jobtype[]"
          class="form-control input-sm">
        @foreach(App\Helpers\ApplicationConstant::JOBTYPE as $key => $value)
          <option value="{{$key}}">
            @lang('application-constant.JOBTYPE.'.$value)
          </option>
        @endforeach
        </select>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control input-sm normal-wage price-field"
          name="normal_wage[]"
          value="0"
          placeholder="@lang('common.normal_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control input-sm night-wage price-field"
          name="night_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night'] }}"
          value="0"
          placeholder="@lang('common.night_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control input-sm late-night-wage price-field"
          name="late_night_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['late_night'] }}"
          value="0"
          placeholder="@lang('common.late_night_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control input-sm overtime-wage price-field"
          name="overtime_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}"
          value="0"
          placeholder="@lang('common.overtime_wage')" />
        <span class="c_form__error-block">{{$errors->first('overtime_wage')}}</span>
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control input-sm holiday-wage price-field"
          name="holiday_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}"
          value="0"
          placeholder="@lang('common.holiday_wage')" />
      </div>
    </td>
    <td>
      <div class="icon-wrapper add-clone">
        <span class="action-icon">
          <i class="c_icon icon fas fa-plus menu-icon" title="add"></i>
        </span>
      </div>
      <div class="icon-wrapper remove-clone">
        <span class="action-icon">
          <i class="c_icon icon fas fa-trash menu-icon" title="remove"></i>
        </span>
      </div>
    </td>
  </tr>
</table>
@section('javascript')
<script>
  $( function() {
    targetClass = ".wage-info";
    cloneSourceClass = '.clone-source';
    init();

    $(targetClass).on('click','.add-clone', function() {
      addClone();
    });
    $(targetClass).on('click','.remove-clone', function() {
      removeClone($(this));
    });
    $(targetClass).on('change','.normal-wage', function() {
      updateExecptionalRate($(this));
    });

    function init() {
      {{count($obj->placeHourlywages) == 0 ? "addClone();" : "" }}
    }

    function updateExecptionalRate(el) {
      row = el.parent().parent().parent();
      normalWage = el.val();

      nightWage = row.find('.night-wage')
      nightWage.val(Math.floor(nightWage.attr('rate') * normalWage));
      setThousandSeparator(nightWage);
      
      lateNightWage = row.find('.late-night-wage')
      lateNightWage.val(Math.floor(lateNightWage.attr('rate') * normalWage));
      setThousandSeparator(lateNightWage);

      overtimeWage = row.find('.overtime-wage')
      overtimeWage.val(Math.floor(overtimeWage.attr('rate') * normalWage));
      setThousandSeparator(overtimeWage);

      holidayWage = row.find('.holiday-wage')
      holidayWage.val(Math.floor(holidayWage.attr('rate') * normalWage));
      setThousandSeparator(holidayWage);
    }

    function addClone() {
      cloneObj = $(cloneSourceClass).clone();
      cloneObj.removeClass('clone-source');
      $(targetClass).append(cloneObj);
    }

    function removeClone(el) {
      el.parent().parent().remove();
    }
  });
</script>
@endsection