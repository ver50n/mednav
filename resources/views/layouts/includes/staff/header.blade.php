<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<link rel="icon" sizes="any" href="/images/favicon.png" type="image/svg+xml">
<link rel="mask-icon" href="/images/favicon.png" color="black">

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
  integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
  crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js" crossorigin="anonymous"></script>


<script>
  function setThousandSeparator(el) {
    el.val(parseInt($(el).val()).toLocaleString('ja'));
  }
  function renderSimulationData(data) {
    resetSimulator();
    id = data['id'];
    user = data['user'];
    period = data['period'];
    place = data['place'];
    jobtype = data['jobtype'];
    shift = data['shift'];
    transportFee = data['transportFee'];
    timeStart = data['timeStart'];
    timeEnd = data['timeEnd'];
    actualTimeStart = data['actualTimeStart'];
    actualTimeEnd = data['actualTimeEnd'];
    workingShiftWithRestOvertimeCalculation = [];
    wageCalculation = [];

    $('#id').html(id);
    $('#user').html(user);
    $('#period').html(period);
    $('#place').html(place);
    $('#jobtype').html(jobtype);
    $('#transportFee').html(transportFee.toLocaleString('ja'));
    $('#shift').html(shift);
    $('#timeStart').html(timeStart);
    $('#timeEnd').html(timeEnd);
    $('#actualTimeStart').html(actualTimeStart);
    $('#actualTimeEnd').html(actualTimeEnd);

    shifts = ['day','evening','overnight'];
    shiftsTrans = ['@lang('application-constant.WORKING_SHIFT.day')','@lang('application-constant.WORKING_SHIFT.evening')','@lang('application-constant.WORKING_SHIFT.overnight')'];
    totalNormal = 0;
    totalOvertime = 0;
    stringBuilder = "";
    for(i = 0; i < shifts.length; i++) {
      stringBuilder += "<tr>";
      stringBuilder += "<td>"+shiftsTrans[i]+"</td>";
      currShift = shifts[i]

      if(data.wageCalculation[currShift] == undefined) {
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
      } else {
        stringBuilder += "<td>"+data.workingShiftWithRestOvertimeCalculation[currShift].normal.toLocaleString('ja')+"</td>";
        stringBuilder += "<td>"+data.workingShiftWithRestOvertimeCalculation[currShift].overtime.toLocaleString('ja')+"</td>";
        stringBuilder += "<td>"+((data.restShiftCalculation[currShift] == undefined) ? '-' : data.restShiftCalculation[currShift])+"</td>";
        stringBuilder += "<td>"+data.wageCalculation[currShift].normal.toLocaleString('ja')+"</td>";
        stringBuilder += "<td>"+data.wageCalculation[currShift].overtime.toLocaleString('ja')+"</td>";

        totalNormal += data.wageCalculation[currShift].normal
        totalOvertime += data.wageCalculation[currShift].overtime

      }
      stringBuilder += "</tr>";
    }
    $('.items-container').html(stringBuilder);
    $('#totalWorkingHourPayment').html(totalNormal.toLocaleString('ja'));
    $('#totalOvertimeHourPayment').html(totalOvertime.toLocaleString('ja'));
    $('#grandtotal').html((totalNormal + totalOvertime + parseInt(transportFee)).toLocaleString('ja'));
  }

  function resetSimulator() {
    shifts = ['day','evening','overnight'];
    shiftsTrans = ['@lang('application-constant.WORKING_SHIFT.day')','@lang('application-constant.WORKING_SHIFT.evening')','@lang('application-constant.WORKING_SHIFT.overnight')'];
    totalNormal = 0;
    totalOvertime = 0;
    stringBuilder = "";
    for(i = 0; i < shifts.length; i++) {
      stringBuilder += "<tr>";
      stringBuilder += "<td>"+shiftsTrans[i]+"</td>";
      currShift = shifts[i]
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
        stringBuilder += "<td>-</td>";
      stringBuilder += "</tr>";
    }
    
    console.log(stringBuilder);
    $('.items-container').html(stringBuilder);
    $('#totalWorkingHourPayment').html(totalNormal.toLocaleString('ja'));
    $('#totalOvertimeHourPayment').html(totalOvertime.toLocaleString('ja'));
    $('#grandtotal').html((totalNormal + totalOvertime + parseInt(transportFee)).toLocaleString('ja'));
  }
  $(function($) {
    var changeRowPerPage = function (rpp) {
      $.ajax({
        url: '{{ route("helpers.change-row-per-page") }}',
        data: {rpp: rpp},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        success: function () {
          location.reload();
        }
      });
    }
    $('.grids-control-records-per-page').change(function() {
      var rpp = $(this).val();
      changeRowPerPage(rpp);
    });
    $('.grid-table .sortable').click(function() {
      var url = new URL(window.location.href);
      var sort_name = $(this).attr("data-key");
      var sort_type = $(this).attr("data-type");
      
      url.searchParams.set('sort[sort_name]', sort_name);
      url.searchParams.set('sort[sort_type]', sort_type);
      
      window.location.href = url
    });

    $(".price-field").blur(function() {
      setThousandSeparator($(this));
    });
    $(".price-field").focus(function() {
      $(this).val($(this).val().replaceAll(',', ''));
    });

    $(".price-field").each(function() {
      setThousandSeparator($(this));
    });
    
    $('.go-top').click( function() {
      $('html,body').animate({ scrollTop: 0 }, 'slow');
    });
    $('.go-bottom').click( function() {
      $("html, body").animate({ scrollTop: $(document).height() }, 'slow');
    });

    $("form").submit(function() {
      $(".price-field").each(function() {
        $(this).val($(this).val().replaceAll(',', ''));
      });
      return true;
    })
  });
</script>
@yield('javascript')