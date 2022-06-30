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
                <input class="form-control form-control-sm"
                  id="user-label"
                  value="{{ old('user_label') ? old('user_label') : $obj->user->name }}"
                  placeholder="@lang('common.user_id')" />
                <input type="hidden" id="user_id" value="{{ old('user_id') ? old('user_id') : $obj->user_id }}" />
              </div>
              <div class="form-group">
                <label>@lang('common.place_id')</label> <span class="e_required">*</span>
                <input type="hidden" name="place_id" value="{{ $obj->place_id}}">
                <input class="form-control form-control-sm"
                  id="place-label"
                  readOnly
                  disabled
                  value="{{ $obj->place->name }}"
                  placeholder="@lang('common.place_id')" />
              </div>
              <div class="form-group">
                <label>@lang('common.date_period')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  id="date_period"
                  readOnly
                  disabled
                  value="{{ $obj->date_period }}" />
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
                  value="{{ old('time_start') ? old('time_start') : $obj->time_start }}"
                  placeholder="@lang('common.time_start')" />
                <span class="c_form__error-block">{{$errors->first('time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.time_end')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="time_end"
                  id="time_end"
                  readOnly
                  value="{{ old('time_end') ? old('time_end') : $obj->time_end }}"
                  placeholder="@lang('common.time_end')" />
                <span class="c_form__error-block">{{$errors->first('time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.shift')</label> <span class="e_required">*</span>
                @php
                  $oldValue = old('shift') ? old('shift') : $obj->shift;
                @endphp
                <select name="shift"
                  id="shift"
                  disabled
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
                  value="{{ old('actual_time_start') ? old('actual_time_start') : $obj->actual_time_start }}"
                  placeholder="@lang('common.actual_time_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_end')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm"
                  name="actual_time_end"
                  id="actual_time_end"
                  readOnly
                  value="{{ old('actual_time_end') ? old('actual_time_end') : $obj->actual_time_end }}"
                  placeholder="@lang('common.actual_time_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_rest_start')</label> <span class="e_required">*</span> (a)
                <input class="form-control form-control-sm"
                  name="actual_time_rest_start"
                  id="actual_time_rest_start"
                  readOnly
                  value="{{ old('actual_time_rest_start') ? old('actual_time_rest_start') : $obj->actual_time_rest_start }}"
                  placeholder="@lang('common.actual_time_rest_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_start')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_rest_end')</label> <span class="e_required">*</span> (b)
                <input class="form-control form-control-sm"
                  name="actual_time_rest_end"
                  id="actual_time_rest_end"
                  readOnly
                  value="{{ old('actual_time_rest_end') ? old('actual_time_rest_end') : $obj->actual_time_rest_end }}"
                  placeholder="@lang('common.actual_time_rest_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_end')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_rest_start2')</label> <span class="e_required">*</span> (a)
                <input class="form-control form-control-sm"
                  name="actual_time_rest_start2"
                  id="actual_time_rest_start2"
                  readOnly
                  value="{{ old('actual_time_rest_start2') ? old('actual_time_rest_start2') : $obj->actual_time_rest_start2 }}"
                  placeholder="@lang('common.actual_time_rest_start2')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_start2')}}</span>
              </div>
              <div class="form-group">
                <label>@lang('common.actual_time_rest_end2')</label> <span class="e_required">*</span> (b)
                <input class="form-control form-control-sm"
                  name="actual_time_rest_end2"
                  id="actual_time_rest_end2"
                  readOnly
                  value="{{ old('actual_time_rest_end2') ? old('actual_time_rest_end2') : $obj->actual_time_rest_end2 }}"
                  placeholder="@lang('common.actual_time_rest_end2')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_end2')}}</span>
              </div>
              
              <div>
                <button type="button" class="btn btn-outline-primary simulation">
                  <span class="action-icon">
                    <i class="c_icon fas fa-save menu-icon"></i> @lang('common.simulation')
                  </span>
                </button>
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

              <div class="form-group">
                <label>@lang('common.actual_payment')</label> <span class="e_required">*</span>
                <input class="form-control form-control-sm price-field"
                  name="actual_payment"
                  id="actual_payment"
                  value="{{ old('actual_payment') ? old('actual_payment') : $obj->actual_payment }}"
                  placeholder="@lang('common.actual_payment')" />
                <span class="c_form__error-block">{{$errors->first('actual_payment')}}</span>
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
              @include("components.pages.calculation-summary", $obj)
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
    $('#time_start, #time_end, #actual_time_start, #actual_time_end, #actual_time_rest_start, #actual_time_rest_start2, #actual_time_rest_end, #actual_time_rest_end2').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm:ss",
      stepMinute: 15,
    });

    $("#user-label").autocomplete({
      source: {!! $userList !!},
      select: function (event, ui) {
        $("#user_id").val(ui.item.value)
        $('#user-label').val(ui.item.label);
        return false;
      },
      minLength: 1
    });
    
    $('.simulation').click(function() {
      $.ajax({
        url: '{{ route("manage.callcenter.simulation") }}',
        data: {
          id: {{ $obj->id }},
          place_id: $('#place_id').val(),
          period: $('#period').val(),
          transport_fee: $('#transport_fee').val().replaceAll(',', ''),
          actual_time_start: $('#actual_time_start').val(),
          actual_time_end: $('#actual_time_end').val(),
          actual_time_rest_start: $('#actual_time_rest_start').val(),
          actual_time_rest_end: $('#actual_time_rest_end').val(), 
          actual_time_rest_start2: $('#actual_time_rest_start2').val(),
          actual_time_rest_end2: $('#actual_time_rest_end2').val()
        },
        success: function(data) {
          renderSimulationData(JSON.parse(data));
        }
      });
    });
  });
</script>
@endsection