<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <h1>Job Search</h1>
    <div class="row">
      <div class="col-sm-12 bg-secondary">
        <form action="" id="">
          <div class="row align-items-end">
            <div class="col-md-3 col-sm-4">
              <label for="date" class="control-label">Job Name</label>
              <input type="text" name="search_job_name" id="job name" class="form-control form-control-sm rounded-0" value="{{request('search_job_name')}}">
            </div>
            <div class="col-md-3 col-sm-4">
              <label for="time" class="control-label">City</label>
              <input type="text" name="search_city" id="city" class="form-control form-control-sm rounded-0" value="{{request('search_city')}}">
            </div>
            <div class="col-md-3 col-sm-4">
              <button class="btn btn-flat btn-primary"><i class="fa fa-search"></i> Search</button>
              <a href="{{route('job-detail.index')}}" class="btn btn-flat btn-primary"><i class="fa fa-reset"></i> Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div>
      <button class="btn btn-flat btn-primary" id="selectAll">Select all</button>
      <button class="btn btn-flat btn-success selected-action" disabled id="unselectAll">Unselect all</button>
      <button type="submit" class="btn btn-flat btn-danger selected-action deleteSelected" data-url="{{ url('job-detailDeleteSelected') }}"><i class="fa fa-delete"></i> Delete Selected</button>

    </div>
    <table class="table table-bordered mt-3">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">SN</th>
          <th scope="col">Job id</th>
          <th scope="col">Job Name</th>
          <th scope="col">City</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($jobDetails as $jobDetail)
        <tr>
          <td><input type="checkbox" name="job_id_checkbox[]" value="{{$jobDetail->id}}"></td>
          <td>{{$jobDetail->id}}</td>
          <td>{{$jobDetail->job_id}}</td>
          <td>{{$jobDetail->job_name}}</td>
          <td>{{$jobDetail->city}}</td>
          <td>
            <form action="{{route('job-detail.destroy', $jobDetail->id)}}" onclick="return confirm('Are you sure?')" method="POST" style="display: inline">
              @csrf
              @method('DELETE')
              <input type="submit" value="Delete" class="btn btn-sm btn-danger">
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <!-- <tr> -->
    <div colspan="5">{{ $jobDetails->links() }}</div>
    <!-- </tr> -->
  </div>
  </div>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  $('[name="job_id_checkbox[]"]').click(function() {
    $(".selected-action").attr("disabled", !this.checked);
  });

  $("#selectAll").click(function() {
    $('[name="job_id_checkbox[]"]').prop('checked', true);
    $(".selected-action").attr("disabled", false);
  });

  $("#unselectAll").click(function() {
    $('[name="job_id_checkbox[]"]').prop('checked', false);
    $(".selected-action").attr("disabled", true);
  });

  $('.deleteSelected').on('click', function() {

    var allVals = [];
    $(":checkbox:checked").each(function() {
      allVals.push($(this).attr('value'));
    });

    if (allVals.length <= 0) {
      alert("Please select row.");
    } else {
      var check = confirm("Are you sure you want to delete this row?");
      if (check == true) {
        var join_selected_values = allVals.join(",");

        $.ajax({
          url: $(this).data('url'),
          type: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: 'ids=' + join_selected_values,
          success: function(data) {
            if (data['success']) {
              $(":checkbox:checked").each(function() {
                $(this).parents("tr").remove();
              });
              alert(data['success']);
            } else if (data['error']) {
              alert(data['error']);
            } else {
              alert('Whoops Something went wrong!!');
            }
          },
          error: function(data) {
            alert(data.responseText);
          }
        });

        $.each(allVals, function(index, value) {
          $('table tr').filter("[value='" + value + "']").remove();
        });
      }
    }
  });
</script>