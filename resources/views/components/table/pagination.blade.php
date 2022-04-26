@php
  $rowPerPage = !empty(Session::get('rowPerPage')) ? Session::get('rowPerPage') : 15;
  $rowPerPageOptions = [1, 5, 15, 30 ,50];
@endphp
<section class="component__grid-pagination">
	<div class="row">
  	<div class="col-sm">
  		<select class="form-control form-control-sm grids-control-records-per-page"
				style="display: inline; width: 80px; margin-right: 10px;">
      @foreach($rowPerPageOptions as $rppo)
			  <option value="{{ $rppo }}" @php echo ($rppo == $rowPerPage) ? "selected" : "";  @endphp>{{ $rppo }}</option>
      @endforeach
  		</select>Row Per Page
    </div>
  	<div class="col-sm">
      {{$data->withQueryString()->links("pagination::bootstrap-4")}}
    </div>
    <div class="col-sm">
  		<span>
  			Total {{$data->total()}} Record
  		</span>
  	</div>
  </div>
</section>