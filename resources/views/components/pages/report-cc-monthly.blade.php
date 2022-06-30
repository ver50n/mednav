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
    font-size: 10pt;
    border: 0.1mm solid;
  }
  .header {
    height: 10mm;
    font-weight: 600;
    text-align: center;
    border-bottom: 2px solid;
    font-size: 20pt;
    background: #CCC;
  }
  .agent-info {
    height: 25mm;
    display: flex;
    justify-content: space-between;
    margin-top: 3mm;
  }
  .user-info {
    width: 110mm;
    font-size: 30pt;
    font-weight: 600;
  }
  .user-name {
    width: 100%;
    border-bottom: 1px solid;
  }
  .company-info {
  }
  .period-info {
    height: 20mm;
    width: 110mm;
  }
  .total-wage {
    height: 10mm;
    width: 110mm;
    border-bottom: 1px solid;
    font-size: 20pt;
    font-weight: 600;
    margin-top: 8mm;
    display: flex;
    justify-content: space-between;
  }
  .wage-amount {
    text-align:right;
  }
  .tax-detail {
    min-height: 50mm;
  }
  .no-tax-detail {
    min-height: 50mm;
  }
  .item-list {

  }
  .items {
    width: 100%;
    border: 1px solid #dee2e6;
    border-collapse: collapse;
    margin-top: 10mm;
    font-size: 8pt;
  }
  .items th, td {
    border: 1px solid #dee2e6;
    padding: 2mm;
  }
</style>

<div class="summary-wrapper a4">
  <div class="header">
    @lang('common.wage-report')
  </div>
  <div class="agent-info">
    <div class="user-info">
      <div class="user-name">
        {{ \App\Models\User::find($obj->user_id)->name }}
      </div>
    </div>
    <div class="company-info">
      <img src="/images/logo.gif"><br /><br />
      <b>有限会社 メディカルナビゲーター</b><br />
      東京都新宿区西早稲田２−２０−１５<br />
      高田馬場アクセス１１F
    </div>
  </div>
  <div class="period-info">
    {{date('m月', strtotime($obj->date_period_start))}}分の報酬明細書は下記のどおりですのでご確認ください<br />
    報酬計算期間 : {{date('Y年m月d日', strtotime($obj->date_period_start))}} 〜 {{date('Y年m月d日', strtotime($obj->date_period_end))}}<br />
    振込日 : {{date('Y年m月20日', strtotime("+1 month", strtotime($obj->date_period_start)))}}<br />
    発行日 : {{date('Y年m月25日', strtotime("+1 month", strtotime($obj->date_period_start)))}}<br />
  </div>
  <div class="total-wage">
    <div class="wage-label">
      支給金額
    </div>
    <div class="wage-amount">
      {{ App\Utils\NumberUtil::currencyFormat($data['summary']['grand_total']) }} 円
    </div>
  </div>
  <div class="tax-detail">
    <table class="items">
      <thead>
        <tr>
          <th>シフト</th>
          <th>自給制</th>
          <th>数量</th>
          <th>金額</th>
        </tr>
      </thead>
      <tbody class="items-container">
        @php
        foreach($data['detail'] as $shift => $detail) {
        @endphp
        <tr>
          <td rowspan="2">@lang('application-constant.WORKING_SHIFT.'.$shift)</td>
          <td>普通</td>
          <td>{{ $detail['normal']['duration'] }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($detail['normal']['wage']) }}</td>
        </tr>
        <tr>
          <td>残業</td>
          <td>{{ $detail['overtime']['duration'] }}</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($detail['overtime']['wage']) }}</td>
        </tr>
        @php
        }
        @endphp
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">小計</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($data['summary']['total']) }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="no-tax-detail">
    <table class="items">
      <thead>
        <tr>
          <th>費用</th>
          <th>金額</th>
        </tr>
      </thead>
      <tbody class="items-container">
        <tr>
          <td>@lang('common.transport_fee')</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($data['summary']['total_transport_fee']) }}</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>小計</td>
          <td>{{ App\Utils\NumberUtil::currencyFormat($data['summary']['total_transport_fee']) }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>