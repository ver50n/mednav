<section class="component__update-form">
  <form action="{{route($routePrefix.'.updatePost', ['id' => $obj->id])}}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="place_id" id="place_id" value="{{ $obj->place_id }}" />
    <input type="hidden" name="date_period" id="period" value="{{ $obj->date_period }}" />
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
                  value="{{ old('actual_time_start') ? old('actual_time_start') : $obj->actual_time_start }}"
                  placeholder="@lang('common.actual_time_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_start')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_end') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_end"
                  id="actual_time_end"
                  readOnly
                  value="{{ old('actual_time_end') ? old('actual_time_end') : $obj->actual_time_end }}"
                  placeholder="@lang('common.actual_time_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_end')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_rest_start') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_rest_start"
                  id="actual_time_rest_start"
                  readOnly
                  value="{{ old('actual_time_rest_start') ? old('actual_time_rest_start') : $obj->actual_time_rest_start }}"
                  placeholder="@lang('common.actual_time_rest_start')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_start')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_rest_end') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_rest_end"
                  id="actual_time_rest_end"
                  readOnly
                  value="{{ old('actual_time_rest_end') ? old('actual_time_rest_end') : $obj->actual_time_rest_end }}"
                  placeholder="@lang('common.actual_time_rest_end')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_end')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_rest_start2') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_rest_start2"
                  id="actual_time_rest_start2"
                  readOnly
                  value="{{ old('actual_time_rest_start2') ? old('actual_time_rest_start2') : $obj->actual_time_rest_start2 }}"
                  placeholder="@lang('common.actual_time_rest_start2')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_start2')}}</span>
              </div>
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">@lang('common.actual_time_rest_end2') <span class="e_required">*</span></label>
                <input class="form-control form-control-sm col-sm-2"
                  name="actual_time_rest_end2"
                  id="actual_time_rest_end2"
                  readOnly
                  value="{{ old('actual_time_rest_end2') ? old('actual_time_rest_end2') : $obj->actual_time_rest_end2 }}"
                  placeholder="@lang('common.actual_time_rest_end2')" />
                <span class="c_form__error-block">{{$errors->first('actual_time_rest_end2')}}</span>
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
    $('#actual_time_start, #actual_time_end, #actual_time_rest_start, #actual_time_rest_start2, #actual_time_rest_end, #actual_time_rest_end2').datetimepicker({
      dateFormat: "yy-mm-dd",
      timeFormat: "HH:mm:ss",
      stepMinute: 15,
    });

    $('.simulation').click(function() {
      $.ajax({
        url: '{{ route("staff.callcenter.simulation") }}',
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