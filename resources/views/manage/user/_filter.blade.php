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
                <label>@lang('common.id')</label>
                <input class="form-control form-control-sm"
                  name="filters[id]"
                  value="{{$obj->id}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.name')</label>
                <input class="form-control form-control-sm"
                  name="filters[name]"
                  value="{{$obj->name}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.username')</label>
                <input class="form-control form-control-sm"
                  name="filters[username]"
                  value="{{$obj->username}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.email')</label>
                <input class="form-control form-control-sm"
                  name="filters[email]"
                  value="{{$obj->email}}"
                  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>@lang('common.is_outsource')</label>
                <select name="is_outsource"
                  id="is_outsource"
                  class="form-control form-control-sm">
                  <option value=""> - </option>
                @foreach(App\Helpers\ApplicationConstant::YES_NO as $key => $value)
                  <option value="{{$key}}" {{ $value == old('is_outsource') ? 'selected' : '' }}>
                    @lang('application-constant.YES_NO.'.$value)
                  </option>
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>@lang('common.outsource_name')</label>
                <input class="form-control form-control-sm"
                  name="outsource_name"
                  value="{{old('outsource_name')}}" />
                <span class="c_form__error-block">{{$errors->first('outsource_name')}}</span>
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