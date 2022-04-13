@extends('layouts.manage-layout')

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
        <a href="{{route($routePrefix.'.create')}}">
          <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-plus menu-icon"></i> @lang('common.create')
          </button>
        </a>
      </div>
      <div class="grid-action">
        <form action="{{route('helpers.export').'?'.http_build_query(Request::query())}}" method="POST">
          @csrf
          <input type="hidden" name="model" value="Callcenter" />
          
          <button class="btn btn-outline-secondary">
            <i class="c_icon fas fa-file-export menu-icon"></i> @lang('common.export')
          </button>
        </form>
      </div>
    </div>
    <table class="grid-table table table-striped table-bordered table-responsive-sm">
    @include('components.table.header',[
      'headers' => [
        'action' => ['sortable' => false, 'title' => trans('common.action')],
        'name' => ['sortable' => true, 'title' => trans('common.name')],
        'place' => ['sortable' => true, 'title' => trans('common.place')],
        'working_hour' => ['sortable' => false, 'title' => trans('common.working_hour')],
        'actual_working_wage' => ['sortable' => true, 'title' => trans('common.actual_working_wage')],
        'transport_fee' => ['sortable' => true, 'title' => trans('common.transport_fee')],
        'handling_fee' => ['sortable' => true, 'title' => trans('common.handling_fee')],
        'user_payment' => ['sortable' => true, 'title' => trans('common.user_payment')],
        'actual_payment' => ['sortable' => true, 'title' => trans('common.actual_payment')],
        'is_active' => ['sortable' => true, 'title' => trans('common.is_active')],
        'created_at' => ['sortable' => true, 'title' => trans('common.created_at')],
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
          <td>{{$row->user_id}}</td>
          <td>{{$row->place_id}}</td>
          <td>
            @lang('common.time_start') : {{$row->time_start}}<br />
            @lang('common.time_end') : {{$row->time_end}}<br />
            @lang('common.time_rest') : {{$row->time_rest}}<br />
            @lang('common.actual_working_hour') : {{$row->actual_working_hour}}
          </td>
          <td>{{$row->actual_working_wage}}</td>
          <td>{{$row->handling_fee}}</td>
          <td>{{$row->transport_fee}}</td>
          <td>{{$row->user_payment}}</td>
          <td>{{$row->actual_payment}}</td>
          <td>
            <form action="{{route('helpers.activation')}}"
              id="grid-action-activation-{{$row->id}}"
              method="POST"
            >
              @csrf
              <input type="hidden" name="model" value="Callcenter"/>
              <input type="hidden" name="id" value="{{$row->id}}"/>
            </form>
            @if($row->is_active == 0)
            <button class="btn btn-success"
              onClick="document.getElementById('grid-action-activation-{{$row->id}}').submit()">
              <i class="c_icon fas fa-check menu-icon"></i> @lang('common.activate')
            </button>
            @else
            <button class="btn btn-danger"
              onClick="document.getElementById('grid-action-activation-{{$row->id}}').submit()">
              <i class="c_icon fas fa-times menu-icon"></i> @lang('common.disactivate')
            </button>
            @endif
          </td>
          <td>{{$row->created_at}}</td>
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
