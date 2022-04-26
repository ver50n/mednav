<section class="component__filter-form">
  <button type="button"
    class="btn btn-outline-secondary"
    data-toggle="modal"
    data-target="#filter-popup">
    <span class="action-icon">
      <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')
    </span>
  </button>
  <div class="modal fade" id="filter-popup"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card">
          <div class="card-header"><i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')</div>
          <div class="card-body">
            <form action="{{route($routePrefix.'.list')}}" method="GET">
              <div class="form-group">
                <label>@lang('common.user_id')</label>
                @php
                  $oldValue = old('user_id') ? old('user_id') : $obj->user_id;
                @endphp
                <select name="filters[user_id]"
                  class="form-control form-control-sm">
                  <option value=""></option>
                @foreach(App\Models\User::get() as $each)
                  <option value="{{$each['id']}}" {{ $oldValue == $each['id'] ? 'selected' : '' }}>
                    {{ $each['name'] }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.place_id')</label>
                @php
                  $oldValue = old('place_id') ? old('place_id') : $obj->place_id;
                @endphp
                <select name="filters[place_id]"
                  class="form-control form-control-sm">
                  <option value=""></option>
                @foreach(App\Models\Place::get() as $each)
                  <option value="{{$each['id']}}" {{ $oldValue == $each['id'] ? 'selected' : '' }}>
                    {{ $each['name'] }}
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.shift')</label>
                @php
                  $oldValue = old('shift') ? old('shift') : $obj->shift;
                @endphp
                <select name="filters[shift]"
                  class="form-control form-control-sm">
                  <option value=""></option>
                @foreach(App\Helpers\ApplicationConstant::WORKING_SHIFT as $each => $value)
                  <option value="{{$each}}" {{ $oldValue == $each ? 'selected' : '' }}>
                    @lang('application-constant.WORKING_SHIFT.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.date_period')</label>

                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <input class="form-control form-control-sm"
                      name="filters[date_period_start]"
                      id="date_period_start"
                      value="{{old('date_period_start') ? old('date_period_start') : $obj->date_period_start}}" />
                  </div>
                  <div class="col-md-4 mb-3">
                    <input class="form-control form-control-sm"
                      name="filters[date_period_end]"
                      id="date_period_end"
                      value="{{old('date_period_end') ? old('date_period_end') : $obj->date_period_end}}" />
                  </div>
                </div>
              </div>

              <div>
                <button type="submit" class="btn btn-success">
                  <span class="action-icon">
                    <i class="c_icon fas fa-filter menu-icon"></i> @lang('common.filter')
                  </span>
                </button>
                <a href="{{route($routePrefix.'.list')}}">
                  <button type="button" class="btn btn-outline-secondary reset-filter">
                    <span class="action-icon">
                      <i class="c_icon fas fa-sync-alt menu-icon"></i> @lang('common.reset')
                    </span>
                  </button>
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@section('javascript')
<script>
  $( function() {
    $('#date_period_start, #date_period_end').datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
</script>
@endsection