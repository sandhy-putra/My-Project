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
                    <th>Periode</th>
                    <th>Id Karyawan</th>
                    <th>Nama Karyawan</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=0;
                    @endphp 
                    @foreach ($incometaxes as $row)
                     @php
                     $i++;
                     @endphp 
                     <tr>
                        <td>
                          <button class="btn btn-success btn-sm m-1 del-btn" onclick="printslip(event,'{{ $row->tax_period }}','{{ $row->employee_id }}','{{ $row->non_taxable_income_id }}')" ><i class="fa fa-print"></i></button>
                        </td>
                        <td>{{ $row->tax_period }}</td>
                        <td>{{ $row->employee_id }}</td>
                        <td>{{ $row->employee->name }}</td>
                        
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
function deleteData(e,url,taxperiod,empid,ntiid)
{
  arrParams = {taxperiod:taxperiod,empid:empid,ntiid:ntiid};
  destroyData(e,url,arrParams);
}

function printslip(e,a,b,c)
{
    e.preventDefault();
            var width = 350;
            var height = 400;
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            window.open(
                '/incometax_printslip/'+a+'/'+b+'/'+c, // Ganti dengan URL yang diinginkan
                '_blank', 
                'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left
            );
        }
</script>