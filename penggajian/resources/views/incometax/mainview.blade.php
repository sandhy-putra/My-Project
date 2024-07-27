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
                    <th>Status PTKP</th>
                    <th>TER</th>
                    <th>Gaji Pokok</th>
                    <th>Bonus</th>
                    <th>Potongan</th>
                    <th>BPJS Kes.</th>
                    <th>BPJS Ket.</th>
                    <th>Penghasilan Bruto</th>
                    <th>PPh</th>
                    <th>Masa Pajak Terakhir</th>

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
                     @if ($row->is_last_period==true)
                      @php
                        $akhir="Yes";    
                      @endphp
                                                                      
                     @else
                      @php
                          $akhir="No";
                      @endphp   
                     @endif
                     <tr>
                        <td>
                          <button class="btn btn-danger btn-sm m-1 del-btn" onclick="deleteData(event,'/incometax_destroy','{{ $row->tax_period }}','{{ $row->employee_id }}','{{ $row->non_taxable_income_id }}')" ><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ $row->tax_period }}</td>
                        <td>{{ $row->employee_id }}</td>
                        <td>{{ $row->employee->name }}</td>
                        <td>{{ $row->nonTaxableIncome->non_taxable_income_status_shortname }}</td> 
                        <td>{{ $row->effective_average_tax_rate_category }}</td>
                        <td>{{ number_format($row->basic_salary) }}</td>
                        <td>{{ number_format($row->bonus) }}</td>
                        <td>{{ number_format($row->other_deductions) }}</td>
                        <td>{{ number_format($row->bpjs_health) }}</td>
                        <td>{{ number_format($row->bpjs_employment) }}</td>
                        <td>{{ number_format($row->gross_income) }}</td>
                        <td>{{ number_format($row->income_tax_value) }}</td>
                        <td>{{ $akhir}}</td>
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
</script>