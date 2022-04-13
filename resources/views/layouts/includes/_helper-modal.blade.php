
<!-- Modal -->
<div class="modal fade"
  id="helper-modal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="helper-modal"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">@lang('common.help')</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body helper">
        <div class="nav-group">
          <span class="nav-title">@lang('common.about-wagokoro')</span>
          <ul>
            <li><a href="{{ route('pages.about') }}">@lang('common.wagokoro')</a></li>
            <li><a href="{{ route('pages.contact') }}">@lang('common.contact')</a></li>
            <li><a href="{{ route('pages.profile', ['slug' => 'kurosawa-kazuko']) }}">@lang('common.see-leader-profile')</a></li>
          </ul>
        </div>

        <span class="nav-title">@lang('common.wagokoro-activity')</span>
          <ul>
            <li><a href="{{ route('pages.service') }}">@lang('common.service')</a></li>
            <li><a href="{{ route('pages.schedule') }}">@lang('common.schedule')</a></li>
            <li><a href="{{ route('pages.article') }}">@lang('common.article')</a></li>
            <li><a href="{{ route('pages.gallery') }}">@lang('common.gallery')</a></li>
            <li><a href="{{ route('pages.customer-voice') }}">@lang('common.customer-voice')</a></li>
          </ul>
        </span>
        <div class="nav-group">
          <span class="nav-title">@lang('common.sns')</span>
          <ul>
            <li>
              <div class="sns-wrapper">
                <style>
                  .sns-share-button {
                    margin: 5px !important;
                    margin-right: 0px !important;
                  }
                </style>
                @include('components.sns-share-buttons',[
                  'fbUrl' => 'https://www.facebook.com/wagokoro111',
                  'instagramUrl' => 'https://www.instagram.com/wa_gokoro111/',
                  'webUrl' => config('app.url')
                ])
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>