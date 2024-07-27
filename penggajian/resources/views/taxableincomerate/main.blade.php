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
                          <label for="mintaxableincome">Minimal Penghasilan (Netto)</label>
                          <input type="text" class="form-control" id="mintaxableincome" name="mintaxableincome" oninput="formatInput(this)" placeholder="Minimal Penghasilan (Netto)">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="maxtaxableincome">Maximal Penghasilan (Netto)</label>
                          <input type="text" class="form-control" id="maxtaxableincome" name="maxtaxableincome" oninput="formatInput(this)" placeholder="Maximal Penghasilan (Netto)">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="taxableincomerate">Persentase Tarif PKP</label>
                          <input type="text" class="form-control" id="taxableincomerate" name="taxableincomerate" placeholder="Persentase Tarif PKP">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary" onclick="saveform(event,'/tir_store/',null);"><i class="fa fa-save"></i> Save</button>
                    </form>
                  </div>
                </div>

                <table id="{{ $tableid }}" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Act</th>
                    <th>Id</th>
                    <th>Minimal Penghasilan (Netto)</th>
                    <th>Maximal Penghasilan (Netto)</th>
                    <th>% Tarif PKP</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=0;
                    @endphp 
                    @foreach ($taxableincomerate as $tir)
                     
                     @php
                     $i++;
                         
                     @endphp 
                      <tr>
                        <td>
                            <button class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#modal-xl" onclick="openEdit('{{ $tir->id }}');"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm m-1 del-btn"  onclick="deleteData(event,'/tir_destroy','{{ $tir->id }}')"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ $tir->id }}</td>
                        <td>{{ number_format($tir->min_taxable_income) }}</td>
                        <td>{{ number_format($tir->max_taxable_income) }}</td>
                        <td>{{ $tir->taxable_income_rate }}</td>
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
  url = '/tir_getTir/';
  arrParams = {id:id};
  openList(url,arrParams);
}

function deleteData(e,url,id)
{
  arrParams = {id:id};
  destroyData(e,url,arrParams);
}
         
</script>