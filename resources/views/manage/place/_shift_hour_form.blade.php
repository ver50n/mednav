<section class="component__shift-hour-form">
  <form action="{{route($routePrefix.'.updateShiftPost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="place_id" value="{{ $id }}" />
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
      <thead>
        <th>@lang('common.shift')</th>
        <th>@lang('common.start_hour')</th>
        <th>@lang('common.end_hour')</th>
        <th>@lang('common.action')</th>
      </thead>
      <tbody class="shift-info">
        @foreach($obj->placeShiftHours as $shift)
        <tr>
          <td>
            <div class="form-group">
              <input type="hidden" name="id[]" value="{{$shift->id}}" />
              <select name="shift[]"
                class="form-control form-control-sm">
              @php
                $oldValue = old('shift') ? old('shift') : $shift->shift;
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
              <input class="form-control form-control-sm start-hour"
                class="start-hour"
                name="start_hour[]"
                readOnly
                value="{{old('start_hour') ? old('start_hour') : $shift->start_hour->format('H:i')}}"
                placeholder="@lang('common.start_hour')" />
              <span class="c_form__error-block">{{$errors->first('start_hour')}}</span>
            </div>
          </td>
          <td>
            <div class="form-group">
              <input class="form-control form-control-sm end-hour"
                class="end-hour"
                name="end_hour[]"
                readOnly
                value="{{old('end_hour') ? old('end_hour') : $shift->end_hour->format('H:i')}}"
                placeholder="@lang('common.end_hour')" />
              <span class="c_form__error-block">{{$errors->first('end_hour')}}</span>
            </div>
          </td>
          <td>
            <div class="icon-wrapper add-shift-clone">
              <span class="action-icon">
                <i class="c_icon icon fas fa-plus menu-icon" title="add"></i>
              </span>
            </div>
            <div class="icon-wrapper remove-shift-clone">
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
  <tr class="clone-shift-source">
    <td>
      <div class="form-group">
        <select name="shift[]"
          class="form-control form-control-sm">
        @foreach(App\Helpers\ApplicationConstant::WORKING_SHIFT as $key => $value)
          <option value="{{$key}}">
            @lang('application-constant.WORKING_SHIFT.'.$value)
          </option>
        @endforeach
        </select>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm start-hour"
          name="start_hour[]"
          readOnly
          value="00:00"
          placeholder="@lang('common.start_hour')" />
      </div>
    </td>
    <td>
      <div class="form-group">
        <input class="form-control form-control-sm end-hour"
          name="end_hour[]"
          readOnly
          value="00:00"
          placeholder="@lang('common.end_hour')" />
      </div>
    </td>
    <td>
      <div class="icon-wrapper add-shift-clone">
        <span class="action-icon">
          <i class="c_icon icon fas fa-plus menu-icon" title="add"></i>
        </span>
      </div>
      <div class="icon-wrapper remove-shift-clone">
        <span class="action-icon">
          <i class="c_icon icon fas fa-trash menu-icon" title="remove"></i>
        </span>
      </div>
    </td>
  </tr>
</table>