<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
        デフォールト
      </div>
      <div class="card-body">
        <form action="{{ route('setting-post') }}" method="POST"
          enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label> テーブルの表示の行数</label>
            <select class="form-control form-control-sm" id="type"
              name="rpp">
              @foreach([1 => 1,5 => 5,15 => 15,30 => 30,50 => 50] as $value => $label)
              <option value="{{ $value }}"
                {{ $value === \Auth::user()->rpp ? 'selected' : '' }}>
                {{ $label }}
              </option>
              @endforeach
            </select>
          </div>

          <button class="btn btn-outline-primary">保存</button>
        </form>
      </div>
    </div>
  </div>
</div>