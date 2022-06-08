<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
  }
  hr {
    border-color: #378805;
    width: 100%;
  }
  .a4 {
    margin-left: 10px;
    margin-top: 10px;
    width: 210mm;
    height: 297mm;
    padding: 10mm;
    font-size: 9pt;
    border: 0.1mm solid;
  }

  .header {
    height: 70mm;
  }
  .mycompany {
    width: 60mm;
    height: 100%;
    float: left;
  }
  .mycompany-logo {
    width: 100%;
    height: 20mm;
    margin-bottom: 2mm;
    background: url('/images/logo.gif');
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
  }
  .mycompany-info {
    width: 100%;
    height: 40mm;
  }
  .mycompany-info div{
    margin-bottom: 1mm;
  }
  .mycompany-name {
    font-size: 14pt;
    font-weight: 700;
  }
  .doc {
    text-align: right;
    float: right;
  }
  .doc-name {
    font-size: 24pt;
  }
  .doc-info {
    width: 100mm;
    text-align: left;
  }
  .item-list {

  }
  .items {
    width: 100%;
    border: 1px solid #dee2e6;
    border-collapse: collapse;
    font-size: 8pt;
  }
  .items th, td {
    border: 1px solid #dee2e6;
    padding: 2mm;
  }
</style>
<div class="summary-wrapper a4">
  <div class="header">
    <div class="mycompany">
      <div class="mycompany-logo">
      </div>
      <hr />
      <div class="mycompany-info">
        <div class="mycompany-name">
          Medical Navigation
        </div>

        <div class="mycompany-address">
          〒169-0051<br />
          東京都新宿区西早稲田2-20-15<br />
          高田馬場アクセス11F(オフィス) ・12F(セミナールーム)
        </div>

        <div class="mycompany-contact">
          電話 03-6427-4802<br />
          FAX 03-6427-4803<br />
          HP: medi-navi.co.jp
        </div>
      </div>
    </div>
    <div class="doc">
      <div class="doc-name">
        勤務明細書
      </div>
      <hr />
      <div class="doc-info">
        <div class="doc-id">
          データID : <span id="id">{{ $obj->id }}</span>
        </div>
        <div class="viewer-target">
          <div class="target-name">
            送信先 : <span id="user">{{ $obj->user->name }}</span>
          </div>
        </div>
        <div class="period-date">
          Period : <span id="period">{{ date_format(date_create($obj->date_period), 'Y年m月d日 ') }} ({{ Lang::get('application-constant.DAY_OF_WEEK.'.date_format(date_create($obj->date_period), 'N')) }})</span>
        </div>
        <div class="place">
          職場 : <span id="place">{{ $obj->place->name }}</span>
        </div>
        <div class="jobtype">
          業務内容 : <span id="jobtype">@lang('common.callcenter')</span>
        </div>
        <div class="shift">
          シフト : <span id="shift">{{ $obj->shift }}</span><br />
          
          業務期間(予定) :<br />
          @if($obj->time_start && $obj->time_end)
          <span id="timeStart">{{ date_format(date_create($obj->time_start), 'Y年m月d日 H:i') }}</span> ~ <span id="timeEnd">{{ date_format(date_create($obj->time_end), 'Y年m月d日 H:i') }}</span><br />
          @else
          <span id="timeStart"></span> ~ <span id="timeEnd"></span>
          @endif

          業務期間(本番) :<br />
          @if($obj->actual_time_start && $obj->actual_time_end)
          <span id="actualTimeStart">{{ date_format(date_create($obj->actual_time_start), 'Y年m月d日 H:i') }}</span> ~ <span id="actualTimeEnd">{{ date_format(date_create($obj->actual_time_end), 'Y年m月d日 H:i') }}</span><br />
          @else
          <span id="actualTimeStart"></span> ~ <span id="actualTimeEnd"></span>
          @endif
        </div>

      </div>
    </div>
  </div>
  <hr />

  <h4>業務データ</h4>
  <div class="item-list">
    <table class="items">
      <thead>
        <tr>
          <th>シフト</th>
          <th colspan="2">実動時間<br />
            <div style="float: left;width: 50%;">
              普通
            </div>
            <div style="float: right;width: 50%;">
              残業
            </div>
          </th>
          <th>休憩時間</th>
          <th colspan="2">時給計算<br />
            <div style="float: left;width: 50%;">
              普通
            </div>
            <div style="float: right;width: 50%;">
              残業
            </div>
          </th>
        </tr>
      </thead>
      <tbody class="items-container">
        <tr>
          <td>@lang('application-constant.WORKING_SHIFT.day')</td>
          <td>{{ $obj->actual_working_hour_day_shift }}</td>
          <td>{{ $obj->actual_overtime_hour_day_shift }}</td>
          <td>{{ $obj->actual_rest_hour_day_shift }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($obj->actual_payment_normal_day) }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($obj->actual_payment_overtime_day) }}</td>
        </tr>
        <tr>
          <td>@lang('application-constant.WORKING_SHIFT.evening')</td>
          <td>{{ $obj->actual_working_hour_evening_shift }}</td>
          <td>{{ $obj->actual_overtime_hour_evening_shift }}</td>
          <td>{{ $obj->actual_rest_hour_evening_shift }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($obj->actual_payment_normal_evening) }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($obj->actual_payment_overtime_evening) }}</td>
        </tr>
        <tr>
          <td>@lang('application-constant.WORKING_SHIFT.overnight')</td>
          <td>{{ $obj->actual_working_hour_overnight_shift }}</td>
          <td>{{ $obj->actual_overtime_hour_overnight_shift }}</td>
          <td>{{ $obj->actual_rest_hour_overnight_shift }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($obj->actual_payment_normal_overnight) }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($obj->actual_payment_overtime_overnight) }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5">@lang('common.total-normal')</td>
          <td><span id="totalWorkingHourPayment">{{ App\Utils\NumberUtil::currencyFormat($obj->actual_working_hour_payment) }}</span></td>
        </tr>
        <tr>
          <td colspan="5">@lang('common.total-overtime')</td>
          <td><span id="totalOvertimeHourPayment">{{ App\Utils\NumberUtil::currencyFormat($obj->actual_overtime_hour_payment) }}</span></td>
        </tr>
        <tr>
          <td colspan="5">@lang('common.transport_fee')</td>
          <td><span id="transportFee">{{ App\Utils\NumberUtil::currencyFormat($obj->transport_fee) }}</span></td>
        </tr>
        <tr>
          <td colspan="5">@lang('common.total')</td>
          <td><span id="grandtotal">{{ App\Utils\NumberUtil::currencyFormat($obj->user_payment) }}</span></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="summary">
    <hr />
    <div class="shift-info">
      <h6>シフト参照</h6>
      <table class="items">
        <thead>
          <tr>
            <th><label>@lang('common.shift')</label></th>
            <th><label>@lang('common.start_hour')</label></th>
            <th><label>@lang('common.end_hour')</label></th>
          </tr>
        </thead>
        <tbody>
          @foreach($obj->place->placeShiftHours as $shiftHour)
          <tr>
            <td><label>@lang('application-constant.WORKING_SHIFT.'.$shiftHour->shift)</label></td>
            <td><label>{{ $shiftHour->start_hour }}</label></td>
            <td><label>{{ $shiftHour->end_hour }}</label></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="wage-info">
      <hr />
      <h6>時給参照</h6>
      <table class="items">
        <thead>
          <tr>
            <th><label>@lang('common.day_wage')</label></th>
            <th><label>@lang('common.evening_wage')</label></th>
            <th><label>@lang('common.overnight_wage')</label></th>
            <th><label>@lang('common.overtime_overnight_wage')</label></th>
            <th><label>@lang('common.overtime_wage')</label></th>
            <th><label>@lang('common.holiday_wage')</label></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->day_wage) }} <small class="disabled">({{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['day'] }}x)</small></label></td>
            <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->evening_wage) }} <small class="disabled">({{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['evening'] }}x)</small></label></td>
            <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->overnight_wage) }} <small class="disabled">({{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overnight'] }}x)</small></label></td>
            <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->overtime_overnight_wage) }} <small class="disabled">({{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime_overnight'] }}x)</small></label></td>
            <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->overtime_wage) }} <small class="disabled">({{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['overtime'] }}x)</small></label></td>
            <td><label>{{ \App\Utils\NumberUtil::currencyFormat($obj->holiday_wage) }} <small class="disabled">({{ App\Helpers\ApplicationConstant::EXCEPTION_WAGE_RATE['holiday'] }}x)</small></label></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="notes">
  </div>
</div>