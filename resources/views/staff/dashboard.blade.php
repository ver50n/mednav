@extends('layouts.staff-layout')

@section('content')

<div class="container-wrapper">
  <section class="container">
    <div class="subcontainer dashboard">
      <div class="jumbotron">
        <h1>@lang('common.brand')の管理画面へようこそ！</h1>
        <p>ここから内容を管理できます。</p>
      </div>
    </div>

    <div class="subcontainer upcoming-cc">
      <table class="grid-table table table-striped table-bordered table-responsive-sm">
      @include('components.table.header',[
        'headers' => [
          'action' => ['sortable' => false, 'title' => trans('common.action')],
          'date_period' => ['sortable' => true, 'title' => trans('common.date_period')],
          'user_id' => ['sortable' => true, 'title' => trans('common.user_id')],
          'place' => ['sortable' => true, 'title' => trans('common.place')],
          'status' => ['sortable' => true, 'title' => trans('common.status')],
        ]
      ])
        <tbody>
        @foreach($ccThisMonth as $row)
          <tr>
            <td>
              <div class="icon-wrapper">
                <a href="{{route('staff.callcenter.view', ['id' => $row->id])}}">
                  <span class="action-icon">
                    <i class="c_icon icon fas fa-eye menu-icon" title="view"></i>
                  </span>
                </a>
              </div>
            </td>
            <td>{{$row->date_period}}</td>
            <td>{{$row->user->name}}</td>
            <td>{{$row->place->name}}</td>
            <td>{{ \Lang::get('application-constant.CALLCENTER_STATUS.'.$row->status) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </section>
</div>
@endsection

@section('title')
  @include('layouts.includes.title', ['title' => \Lang::get('common.dashboard')])
@endsection