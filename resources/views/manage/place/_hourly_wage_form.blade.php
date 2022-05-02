<section class="component__hourly-wage-form">
  <form action="{{route($routePrefix.'.updateWagePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="place_id" value="{{ $id }}" />
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
      <thead>
        <th>@lang('common.jobtype')</th>
        <th>@lang('common.morning_wage')</th>
        <th>@lang('common.noon_wage')</th>
        <th>@lang('common.night_wage')</th>
        <th>@lang('common.night_overtime_wage')</th>
        <th>@lang('common.overtime_wage')</th>
        <th>@lang('common.holiday_wage')</th>
        <th>@lang('common.action')</th>
      </thead>
      <tbody class="wage-info">
        @foreach($obj->placeHourlyWages as $wage)
        <tr>
          <td>
            <div class="form-group">
              <input type="hidden" name="id[]" value="{{$wage->id}}" />
              <select name="jobtype[]"
                class="form-control form-control-sm">
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
              <input class="form-control form-control-sm morning-wage price-field"
                name="morning_wage[]"
                value="{{old('morning_wage') ? old('morning_wage') : $wage->morning_wage}}"
                placeholder="@lang('common.morning_wage')" />
              <span class="c_form__error-block">{{$errors->first('morning_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm noon-wage price-field"
                name="noon_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['noon'] }}"
                value="{{old('noon_wage') ? old('noon_wage') : $wage->noon_wage}}"
                placeholder="@lang('common.noon_wage')" />
              <span class="c_form__error-block">{{$errors->first('noon_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm night-wage price-field"
                name="night_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night'] }}"
                value="{{old('night_wage') ? old('night_wage') : $wage->night_wage}}"
                placeholder="@lang('common.night_wage')" />
              <span class="c_form__error-block">{{$errors->first('night_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm night-overtime-wage price-field"
                name="night_overtime_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night_overtime'] }}"
                value="{{old('night_overtime_wage') ? old('night_overtime_wage') : $wage->night_overtime_wage}}"
                placeholder="@lang('common.night_overtime_wage')" />
              <span class="c_form__error-block">{{$errors->first('night_overtime_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm overtime-wage price-field"
                name="overtime_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}"
                value="{{old('overtime_wage') ? old('overtime_wage') : $wage->overtime_wage}}"
                placeholder="@lang('common.overtime_wage')" />
              <span class="c_form__error-block">{{$errors->first('overtime_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm holiday-wage price-field"
                name="holiday_wage[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}"
                value="{{old('holiday_wage') ? old('holiday_wage') : $wage->holiday_wage}}"
                placeholder="@lang('common.holiday_wage')" />
              <span class="c_form__error-block">{{$errors->first('holiday_wage')}}</span>
            </div>
          </td>
          <td>
            <div class="icon-wrapper add-wage-clone">
              <span class="action-icon">
                <i class="c_icon icon fas fa-plus menu-icon" title="add"></i>
              </span>
            </div>
            <div class="icon-wrapper remove-wage-clone">
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
  <tr class="clone-wage-source">
    <td>
      <div class="form-group">
        <select name="jobtype[]"
          class="form-control form-control-sm">
        @foreach(App\Helpers\ApplicationConstant::JOBTYPE as $key => $value)
          <option value="{{$key}}">
            @lang('application-constant.JOBTYPE.'.$value)
          </option>
        @endforeach
        </select>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm morning-wage price-field"
          name="morning_wage[]"
          value="0"
          placeholder="@lang('common.morning_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm noon-wage price-field"
          name="noon_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['noon'] }}"
          value="0"
          placeholder="@lang('common.noon_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm night-wage price-field"
          name="night_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night'] }}"
          value="0"
          placeholder="@lang('common.night_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm night-overtime-wage price-field"
          name="night_overtime_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['night_overtime'] }}"
          value="0"
          placeholder="@lang('common.night_overtime_wage')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm overtime-wage price-field"
          name="overtime_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}"
          value="0"
          placeholder="@lang('common.overtime_wage')" />
        <span class="c_form__error-block">{{$errors->first('overtime_wage')}}</span>
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm holiday-wage price-field"
          name="holiday_wage[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}"
          value="0"
          placeholder="@lang('common.holiday_wage')" />
      </div>
    </td>
    <td>
      <div class="icon-wrapper add-wage-clone">
        <span class="action-icon">
          <i class="c_icon icon fas fa-plus menu-icon" title="add"></i>
        </span>
      </div>
      <div class="icon-wrapper remove-wage-clone">
        <span class="action-icon">
          <i class="c_icon icon fas fa-trash menu-icon" title="remove"></i>
        </span>
      </div>
    </td>
  </tr>
</table>