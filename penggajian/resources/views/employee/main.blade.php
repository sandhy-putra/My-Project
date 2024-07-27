@extends('layouts.main')
@section('container')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
      <div class="container-fluid" id="table-data-value">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
                <button class="btn btn-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  <i class="fa fa-plus"></i> Tambah Data
                </button>
                <!--<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal-xl" onclick="baca();"><i class="fa fa-plus"></i> Modal</button>-->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <form id="standarform">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="employeename">NIK</label>
                          <input type="text" class="form-control" id="idcardnumber" name="idcardnumber" placeholder="NIK">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="employeename">Nama Lengkap</label>
                          <input type="text" class="form-control" id="employeename" name="employeename" oninput="toUppercase(this)" placeholder="Nama Lengkap">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="birthdate">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="birthdate" name="birthdate">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="joindate">Tanggal Bergabung</label>
                          <input type="date" class="form-control" id="joindate" name="joindate">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="nontaxableincomeid">Status PTKP</label>
                          <input type="hidden" class="form-control nontaxableincomeid" id="nontaxableincomeid" name="nontaxableincomeid" readonly>
                          <input type="text" class="form-control nontaxableincomeshortname" id="nontaxableincomeshortname" name="nontaxableincomeshortname" data-toggle="modal" data-target="#modal-xl" onclick="openNonTaxableIncomes();" readonly>
                           
                        </div>
                        <div class="form-group col-md-6">
                          <label for="dependentscount">Kategori TER</label>
                          <input type="text" class="form-control tercategory" id="tercategory" name="tercategory" readonly>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="taxid">NPWP</label>
                          <input type="text" class="form-control" id="taxid" name="taxid">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="healthbpjs">Gaji Pokok</label>
                          <input type="text" class="form-control" id="basicsalary" name="basicsalary" oninput="formatInput(this)">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="healthbpjs">BPJS Kesehatan</label>
                          <input type="text" class="form-control" id="healthbpjs" name="healthbpjs" oninput="formatInput(this)">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="employmentbpjs">BPJS Ketenaga Kerjaan</label>
                          <input type="text" class="form-control" id="employmentbpjs" name="employmentbpjs" oninput="formatInput(this)">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary" onclick="saveform(event,'/employee_store/',null);"><i class="fa fa-save"></i> Save</button>
                    </form>
                  </div>
                </div>

                <table id="{{ $tableid }}" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Act</th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tgl. Bergabung</th>
                    <th>Tgl. Lahir</th>
                    <th>Status PTKP</th>
                    <th>Kategori TER</th>
                    <th>NPWP</th>
                    <th>Resign</th>
                    <th>Gaji Pokok</th>
                    <th>BPJS Kes.</th>
                    <th>BPJS Ket.</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($employees as $employee)
                      @php
                        if ($employee->is_employee_resign==false) {
                          $resign="-";
                          $display="block";
                        }else{
                          $resign="Resign";
                          $display="none";
                        }
                     
                      @endphp  
                      <tr>
                        <td>
                          <button style="display:{{ $display }}" class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#modal-xl" onclick="openEdit('{{ $employee->employee_id }}');"><i class="fa fa-edit"></i></button>
                          <button style="display:{{ $display }}" class="btn btn-warning btn-sm m-1 del-btn"  onclick="resign(event,'/employee_resign','{{ $employee->employee_id }}')"><i class="fa fa-user"></i></button>
                          <button style="display:{{ $display }}" class="btn btn-danger btn-sm m-1 del-btn"  onclick="deleteData(event,'/employee_destroy','{{ $employee->employee_id }}')"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->id_card_number }}</td>
                        <td>{{ $employee->join_date }}</td>
                        <td>{{ $employee->birthdate }}</td>
                        <td>{{ $employee->nonTaxableIncome->non_taxable_income_status_shortname }}</td>
                        <td>{{ $employee->nonTaxableIncome->effective_average_tax_rate_category }}</td>
                        <td>{{ $employee->tax_identification_number }}</td>
                        <td>{{ $resign }}</td>
                        <td>{{ number_format($employee->basic_salary) }}</td>
                        <td>{{ number_format($employee->bpjs_health) }}</td>
                        <td>{{ number_format($employee->bpjs_employment) }}</td> 
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
 

function openNonTaxableIncomes()
{
  url = '/employee_getNonTaxableIncomes/';
  arrParams = null;
  openList(url,arrParams);
}

function openEdit(id)
{
  url = '/employee_getEmployee/';
  arrParams = {id:id};
  openList(url,arrParams);
}

function resign(e,url,id)
{
  arrParams = {id:id};
  destroyData(e,url,arrParams);
}

function deleteData(e,url,id)
{
  arrParams = {id:id};
  destroyData(e,url,arrParams);
}
</script>