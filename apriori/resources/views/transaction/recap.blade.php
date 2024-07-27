@extends('layouts.main')
@section('container')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
      <div class="container-fluid" id="table-data-value">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                   
                <table id="{{ $tableid }}" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Act</th>
                    <th>Period</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($transaction as $tc)
                      <tr>
                        <td>
                            <button class="btn btn-danger btn-sm m-1 del-btn"  onclick="deleteData(event,'/transaction_destroy','{{ $tc->period }}')"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ $tc->period }}</td>
                      </tr>
                            
                    @endforeach
                  
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
  
  <!-- Page specific script -->

  @endsection

<script>

function deleteData(e,url,id)
{
  arrParams = {period:id};
  destroyData(e,url,arrParams);
}
         
</script>