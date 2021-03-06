@extends('layouts.staff-layout')

@section('content')
<div class="container-wrapper">
  <div class="subcontainer callcenter">
    <div class="content-wrapper">
    <h4>@lang('common.callcenter')@lang('common.list')</h4>

    <div class="grid-action-wrapper">
      <div class="grid-action">
        @include($viewPrefix.'._filter', ['obj' => $obj])
      </div>
      
      <div class="grid-action">
        <a href="{{route($routePrefix.'.report')}}">
          <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-file-export menu-icon"></i> @lang('common.wage-report')
          </button>
        </a>
      </div>
    </div>
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
      @include('components.table.header',[
        'headers' => [
          'action' => ['sortable' => false, 'title' => trans('common.action')],
          'date_period' => ['sortable' => true, 'title' => trans('common.date_period')],
          'user_id' => ['sortable' => true, 'title' => trans('common.user_id')],
          'place' => ['sortable' => true, 'title' => trans('common.place')],
          'working_hour' => ['sortable' => false, 'title' => trans('common.working-info')],
          'actual_working_hour' => ['sortable' => false, 'title' => trans('common.actual-working-info')],
          'actual_payment_1' => ['sortable' => false, 'title' => trans('common.actual-payment-info')],
          'actual_payment' => ['sortable' => false, 'title' => trans('common.actual-summary-info')],
          'status' => ['sortable' => true, 'title' => trans('common.status')],
        ]
      ])
      <tbody>
      @foreach($data as $row)
        <tr>
          <td>
            <div class="icon-wrapper">
              <a href="{{route($routePrefix.'.view', ['id' => $row->id])}}">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-eye menu-icon" title="view"></i>
                </span>
              </a>
            </div>
            <div class="icon-wrapper">
              <a href="{{route($routePrefix.'.update', ['id' => $row->id])}}">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-edit menu-icon" title="edit"></i>
                </span>
              </a>
            </div>
            <div class="icon-wrapper">
            <form class="form-grid-delete"
              id="form-grid-delete"
              action="{{ route('manage.callcenter.delete', ['id' => $row->id]) }}"
              method="POST"
              style="display: none;">
            @csrf
            </form>
              <a href="#" class="grid-delete" onClick="document.getElementById('form-grid-delete').submit()">
                <span class="action-icon">
                  <i class="c_icon icon fas fa-trash menu-icon" title="delete"></i>
                </span>
              </a>
            </div>
          </td>
          <td>{{$row->date_period}}</td>
          <td>{{$row->user->name}}</td>
          <td>{{$row->place->name}}</td>
          <td>
            <b>@lang('common.time_start')</b><br />
            {{$row->time_start}}<br />
            <b>@lang('common.time_end')</b><br />
            {{$row->time_end}}<br />
          </td>
          <td>
            <b>@lang('common.actual_working_hour_day_shift')</b><br />
            <b>(@lang('common.normal')) {{$row->actual_working_hour_day_shift}}</b><br />
            <b>(@lang('common.overtime')) {{$row->actual_overtime_hour_day_shift}}</b><br />

            <b>@lang('common.actual_working_hour_evening_shift')</b><br />
            <b>(@lang('common.normal')) {{$row->actual_working_hour_evening_shift}}</b><br />
            <b>(@lang('common.overtime')) {{$row->actual_overtime_hour_evening_shift}}</b><br />

            <b>@lang('common.actual_working_hour_overnight_shift')</b><br />
            <b>(@lang('common.normal')) {{$row->actual_working_hour_overnight_shift}}</b><br />
            <b>(@lang('common.overtime')) {{$row->actual_overtime_hour_overnight_shift}}</b><br />

            <br />
            <b>@lang('common.actual_time_start')</b><br />
            {{$row->actual_time_start}}<br />
            <b>@lang('common.actual_time_rest')</b><br />
            (1) {{$row->actual_time_rest_start}} ~ <br />
            {{$row->actual_time_rest_end}}<br />
            (2) {{$row->actual_time_rest_start2}} ~ <br />
            {{$row->actual_time_rest_end2}}<br />
            <b>@lang('common.actual_time_end')</b><br />
            {{$row->actual_time_end}}<br />
          </td>
          <td>
            <b>@lang('common.actual_payment_day')</b><br />
            <b>(@lang('common.normal')) {{$row->actual_payment_normal_day}}</b><br />
            <b>(@lang('common.overtime')) {{$row->actual_payment_overtime_day}}</b><br />

            <b>@lang('common.actual_payment_evening')</b><br />
            <b>(@lang('common.normal')) {{$row->actual_payment_normal_evening}}</b><br />
            <b>(@lang('common.overtime')) {{$row->actual_payment_overtime_evening}}</b><br />

            <b>@lang('common.actual_payment_overnight')</b><br />
            <b>(@lang('common.normal')) {{$row->actual_payment_normal_overnight}}</b><br />
            <b>(@lang('common.overtime')) {{$row->actual_payment_overtime_overnight}}</b><br />
          </td>

          <td>
            <b>@lang('common.actual_working_hour_payment')</b><br />
            {{ App\Utils\NumberUtil::currencyFormat($row->actual_working_hour_payment, $currency = 'JPY', $options = []) }}<br />
            <b>@lang('common.actual_overtime_hour_payment')</b><br />
            {{ App\Utils\NumberUtil::currencyFormat($row->actual_overtime_hour_payment, $currency = 'JPY', $options = []) }}<br />
            <b>@lang('common.transport_fee')</b><br />
            {{ App\Utils\NumberUtil::currencyFormat($row->transport_fee, $currency = 'JPY', $options = []) }}<br />
            <b>@lang('common.handling_fee')</b><br />
            {{ App\Utils\NumberUtil::currencyFormat($row->handling_fee, $currency = 'JPY', $options = []) }}<br />
            <b>@lang('common.user_payment')</b><br />
            <b>{{ App\Utils\NumberUtil::currencyFormat($row->user_payment, $currency = 'JPY', $options = []) }}</b><br />
          </td>
          <td>{{ \Lang::get('application-constant.CALLCENTER_STATUS.'.$row->status) }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    @include('components.table.pagination', ['data' => $data])
    </div>
  </div>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.callcenter') . \Lang::get('common.list')])
@endsection
