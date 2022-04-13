<thead>
@php
  $sort = Request::get('sort');
@endphp
@foreach($headers as $key => $header)
  <th>
    @if(isset($header['sortable']) && $header['sortable'])
      @if(!isset($sort) || $sort['sort_name'] !== $key)
        <i class="c_icon fas fa-sort menu-icon sortable" data-key="{{$key}}" data-type="ASC"></i>&nbsp;
      @else
        @if($sort['sort_type'] !== "ASC")
          <i class="c_icon fas fa-sort-up menu-icon sortable" data-key="{{$key}}" data-type="ASC"></i>&nbsp;
        @else
          <i class="c_icon fas fa-sort-down menu-icon sortable" data-key="{{$key}}" data-type="DESC"></i>&nbsp;
        @endif
      @endif
    @endif
    {{ isset($header['title']) ? $header['title'] : $key }}
  </th>
@endforeach
</thead>