@extends('Layouts.app')

@section('content')
<div id="body-div" class="card card-custom gutter-b">
 <div class="card-header">
  <div class="card-title">
   <h3 class="card-label">
   Tools
    <small>Tools page</small>
   </h3>


  </div>
 </div>
 <div id="card-body" class="card-body">
     <a href="/tools-department" class="btn btn-primary">Departments</a>
     <a href="/tools-classification" class="btn btn-primary">Classification</a>
     <a href="/tools-issue" class="btn btn-primary">Issue</a>
 </div>
</div>
@endsection

@section('script')

<script>
@if(isset($department->result))
Swal.fire(
  'Add Succeded',
  '{{$department->result}}',
  'success'
)
setTimeout(function() {
  window.location.href = "/add-department";
}, 1200);

@endif
</script>
@endsection
