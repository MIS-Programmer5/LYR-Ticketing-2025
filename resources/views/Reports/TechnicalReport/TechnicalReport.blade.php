<!DOCTYPE html>
<html>
<head>
    <title>
        testing
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<!DOCTYPE html>
<html>
<head>
<style>
  * {
    margin: 0;
    padding: 0;
    text-indent: 0;
  }

  .s1,
  .s4,
  .s7 {
    color: #FFF;
    font-family: Arial, sans-serif;
    font-weight: bold;
    text-decoration: none;
    font-size:10px;
  }

  .s2,
  .s3,
  .s5,
  .s6,
  .s8 {
    color: black;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 10px;
    text-align: center
  }

  .s5 {
    font-style: italic;
    font-weight: bold;
  }

  table,
  tbody {
    vertical-align: top;
    overflow: visible;
  }
  td{
    border:solid 1pt black !important;
    /* font-size: 16px; */
  }
  #logs-data{
    font-size: 12px !important;
  }
   #logs-header{
    font-size: 12px;
    background-color: gray;
    border:solid 1pt black !important;
  }
</style>
</head>
<body>
    <br>
    <br>
    <br>
    <div height="200px" style="border:solid 1pt white !important;" > <br></div>
    <br>
  <table style="" cellspacing="0">

    <tr style="height:3pt">
      <td class="s1" style="width:90pt;" bgcolor="#4185F4">Name</td>
      <td class="s2" style="width:166pt;" colspan="5">{!! $name !!}</td>
      <td class="s1" style="width:90pt;" bgcolor="#4185F4">Position</td>
      <td class="s2" style="width:166pt;" colspan="5">{!! $position !!}</td>
    </tr>
    <tr style="height:14pt">
      <td class="s1" style="width:90pt;" bgcolor="#4185F4">Branch</td>
      <td class="s2" style="width:166pt;" colspan="5">{!! $requester !!}</td>
      <td class="s1" style="width:90pt;" bgcolor="#4185F4">Date of Issue</td>
      <td class="s2" style="width:166pt;" colspan="5">{!! $date !!}</td>
    </tr>
    <tr style="height:13pt">
      <td class="s1" style="width:90pt;" bgcolor="#4185F4">Priority Level</td>
      <td class="s2" style="width:166pt;" colspan="3">{!! $prio !!}</td>
      <td class="s1" style="width:256pt;" colspan="5" bgcolor="#4185F4">Resolution Time</td>
    </tr>
    <tr style="height:13pt">
      <td class="s1" style="width:90pt;" bgcolor="#4185F4">Ticket Ref</td>
      <td class="s3" style="width:166pt;" colspan="3">{!! $tcode !!}</td>
      <td class="s1" style="width:256pt;" colspan="4">&nbsp;</td>
    </tr>
    <tr style="height:13pt">
      <td class="s4" style="width:256pt;" colspan="4" bgcolor="#4185F4">Technical Description</td>
      <td class="s1" style="width:256pt;" colspan="4" bgcolor="#4185F4">Issue Description</td>
    </tr>
    <tr style="">
      <td  style="width:256pt;font-size: 8pt" height="100px" colspan="4"><p style="white-space: pre-wrap">{!! $tech_description !!}</p>
      </td>
      <td style="width:256pt;font-size: 8pt" colspan="4"><p style="white-space: pre-wrap; ">{!! $description !!}</p>
      </td>
    </tr>
    <tr style="height:13pt">
      <td class="s1" style="width:512pt;" colspan="8" bgcolor="#4185F4">Actions Taken</td>
    </tr>
    <tr bgcolor="silver"  style="height:13pt;font-style: italic;font-weight: bold;">
      <td   colspan="2">Date</td>
      <td  colspan="2">Encoder Name</td>
      <td  colspan="3">Action Taken</td>
      <td  colspan="1">Status</td>
    </tr>
    @foreach ($logs as $data)
    @if ($data->id != 8)
      <tr id="logs-data" style="height:13pt;">
        <td  @if ($data->id == 9) style="color: #1BC5BD;"  @endif class="s2" colspan="2">{{date('M d,Y H:i a',strtotime($data->dateRecord))}}</td>
        <td  @if ($data->id == 9) style="color: #1BC5BD;"  @endif class="s2" colspan="2">{{$data->name}}</td>
        <td  @if ($data->id == 9) style="color: #1BC5BD;"  @endif class="s2" colspan="3"><p style="white-space: pre-wrap;">{{strip_tags($data->Remarks)}}</p></td>
        <td  @if ($data->id == 9) style="color: #1BC5BD;"  @endif class="s2" colspan="1">{{$data->state}}</td>
      </tr>
    @endif

    @endforeach
     <tr style="height:13pt">
      <td class="s1" style="width:512pt;" colspan="8" bgcolor="#4185F4">Additional Recommendations</td>
    </tr>
    <tr style="height:13pt">
      <td  height="70px" class="s1" style="width:512pt;color:black" colspan="8" >{!! $recommendation !!}</td>
    </tr>
    <tr style="height:13pt; border:solid 1pt white !important">
      <th  height="10px" class="s1" style="width:512pt;" colspan="8" ></th>
    </tr>
    <tr style="height:13pt">
      <td class="s1" style="width:100pt;text-align: center;white-space: pre-wrap;" rowspan="2" bgcolor="#4185F4">Technician: </td>
      <td height="20px" class="s1" style="width:156pt;color:black;text-align:center;" colspan="2" >{!! $assignee !!}</td>
      <td class="s1" style="width:100pt;text-align: center;white-space: pre-wrap;" rowspan="2" bgcolor="#4185F4">Reviewed By:</td>
      <td height="20px" class="s1" style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >VICENTE S. CLAUD JR</td>
    </tr>

    <tr style="height:13pt">

      <td height="20px" class="s1" style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >TECH & FACILITY SUPPORT STAFF</td>

      <td height="20px" class="s1" style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >QA OFFICER</td>
    </tr>
     <tr style="height:13pt; border:solid 1pt white !important">
      <th  height="10px" class="s1" style="width:512pt;" colspan="8" ></th>
    </tr>
    <tr style="height:13pt">
      <td class="s1" style="width:100pt;text-align: center;white-space: pre-wrap;" rowspan="2" bgcolor="#4185F4"><p>Approved By: </p></td>
      <td height="20px" class="s1" style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >RANNIE ALVIN JAY S. ABSIN</td>
      <td class="s1" style="width:100pt;text-align: center;white-space: pre-wrap;" rowspan="2" bgcolor="#4185F4">Received By :</td>
      <td height="20px" class="s1" style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >
</td>
    </tr>

    <tr style="height:13pt">

      <td height="20px"  style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >IT OPERATIONS HEAD</td>

      <td height="20px"  style="width:156pt;color:black;font-size:8px;text-align:center" colspan="2" >
</td>
    </tr>
    <tr style="height:13pt;border:solid 1pt white !important;">
          <td height="20px"  style="border: solid 1pt white !important" colspan="8" ></td>
    </tr>

    <tr style="height:13pt;border:solid 1pt white !important;">
        <td height="20px"  style="border: solid 1pt white !important" colspan="8" ><h4>Date Printed:{{ Carbon\Carbon::parse($date_printed)->format('M d, Y H:i:s A')}}</h4></td>
    </tr>

    </table>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>
