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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <form id="standarform">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="nontaxableincomestatusname">Status Penghasilan Tidak Kena Pajak</label>
                          <input type="text" class="form-control" id="nontaxableincomestatusname" name="nontaxableincomestatusname" oninput="toUppercase(this)" placeholder="Status Penghasilan Tidak Kena Pajak">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="nontaxableincomestatusshortname">Shortname</label>
                          <input type="text" class="form-control" id="nontaxableincomestatusshortname" name="nontaxableincomestatusshortname" oninput="toUppercase(this)" placeholder="Singkatan">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="effectiveaveragetaxratecategory">Kategori Tarif Efektif Rata-rata (TER)</label>
                          <select class="form-control" id="effectiveaveragetaxratecategory" name="effectiveaveragetaxratecategory"> 
                            <option value="" selected></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                           </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="nontaxableincomestatusvalue">Nilai Penghasilan Tidak Kena Pajak (PTKP)</label>
                          <input type="text" class="form-control" id="nontaxableincomestatusvalue" oninput="formatInput(this)" name="nontaxableincomestatusvalue">
                        </div>
                      </div>
                       
                      <button type="submit" class="btn btn-primary" onclick="saveform(event,'/nti_store/',null);"><i class="fa fa-save"></i> Save</button>
                    </form>
                  </div>
                </div>

                <table id="{{ $tableid }}" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Act</th>
                    <th>Id</th>
                    <th>Status Penghasilan Tidak Kena Pajak (PTKP)</th>
                    <th>Shortname</th>
                    <th>Kategori Tarif Efektif Rata-Rata (TER)</th>
                    <th>Nilai Penghasilan Tidak Kena Pajak (PTKP)</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=0;
                    @endphp 
                    @foreach ($nontaxableincomes as $nti)
                     
                     @php
                     $i++;
                         
                     @endphp 
                      <tr>
                        <td>
                            <button class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#modal-xl" onclick="openEdit('{{ $nti->non_taxable_income_id }}');"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm m-1 del-btn"  onclick="deleteData(event,'/nti_destroy','{{ $nti->non_taxable_income_id }}')"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ $nti->non_taxable_income_id }}</td>
                        <td>{{ $nti->non_taxable_income_status_name }}</td>
                        <td>{{ $nti->non_taxable_income_status_shortname }}</td>
                        <td>{{ $nti->effective_average_tax_rate_category }}</td>
                        <td>{{ number_format($nti->non_taxable_income_status_value) }}</td>
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
function openEdit(id)
{
  url = '/nti_getNti/';
  arrParams = {id:id};
  openList(url,arrParams);
}

function deleteData(e,url,id)
{
  arrParams = {id:id};
  destroyData(e,url,arrParams);
}
         
</script>