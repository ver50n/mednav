<section class="component__hourly-wage-form">
  <form action="{{route($routePrefix.'.updateWagePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="place_id" value="{{ $id }}" />
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
      <thead>
        <th>@lang('common.jobtype')</th>
        <th>@lang('common.day_wage')</th>
        <th>@lang('common.evening_wage')</th>
        <th>@lang('common.overnight_wage')</th>
        <th>@lang('common.overtime_overnight_wage')</th>
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
              <input class="form-control form-control-sm day-wage price-field"
                name="day[]"
                value="{{old('day') ? old('day') : $wage->day}}"
                placeholder="@lang('common.day')" />
              <span class="c_form__error-block">{{$errors->first('day')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm evening-wage price-field"
                name="evening[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['evening'] }}"
                value="{{old('evening') ? old('evening') : $wage->evening}}"
                placeholder="@lang('common.evening')" />
              <span class="c_form__error-block">{{$errors->first('evening')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm overnight-wage price-field"
                name="overnight[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overnight'] }}"
                value="{{old('overnight') ? old('overnight') : $wage->overnight}}"
                placeholder="@lang('common.overnight')" />
              <span class="c_form__error-block">{{$errors->first('overnight')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm overnight-overtime-wage price-field"
                name="overtime_overnight[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime_overnight'] }}"
                value="{{old('overtime_overnight') ? old('overtime_overnight') : $wage->overtime_overnight}}"
                placeholder="@lang('common.overtime_overnight')" />
              <span class="c_form__error-block">{{$errors->first('overtime_overnight')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm overtime-wage price-field"
                name="overtime[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}"
                value="{{old('overtime') ? old('overtime') : $wage->overtime}}"
                placeholder="@lang('common.overtime')" />
              <span class="c_form__error-block">{{$errors->first('overtime')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm holiday-wage price-field"
                name="holiday[]"
                rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}"
                value="{{old('holiday') ? old('holiday') : $wage->holiday}}"
                placeholder="@lang('common.holiday')" />
              <span class="c_form__error-block">{{$errors->first('holiday')}}</span>
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
        <input class="form-control form-control-sm day-wage price-field"
          name="day[]"
          value="0"
          placeholder="@lang('common.day')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm evening-wage price-field"
          name="evening[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['evening'] }}"
          value="0"
          placeholder="@lang('common.evening')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm overnight-wage price-field"
          name="overnight[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overnight'] }}"
          value="0"
          placeholder="@lang('common.overnight')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm overtime-overnight-wage price-field"
          name="overtime_overnight[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime_overnight'] }}"
          value="0"
          placeholder="@lang('common.overtime_overnight')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm overtime-wage price-field"
          name="overtime[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}"
          value="0"
          placeholder="@lang('common.overtime')" />
        <span class="c_form__error-block">{{$errors->first('overtime')}}</span>
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm holiday-wage price-field"
          name="holiday[]"
          rate="{{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}"
          value="0"
          placeholder="@lang('common.holiday')" />
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