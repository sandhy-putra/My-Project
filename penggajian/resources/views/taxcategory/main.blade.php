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
                          <label for="mingrossincome">Minimal Penghasilan (Bruto)</label>
                          <input type="text" class="form-control" id="mingrossincome" name="mingrossincome" oninput="formatInput(this)" placeholder="Minimal Penghasilan (Netto)">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="maxgrossincome">Maximal Penghasilan (Bruto)</label>
                          <input type="text" class="form-control" id="maxgrossincome" name="maxgrossincome" oninput="formatInput(this)" placeholder="Maximal Penghasilan (Netto)">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="maxtaxableincome">Kategori TER</label>
                          <select class="form-control" id="tercategory" name="tercategory"> 
                            <option value="" selected></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                           </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="taxrate">Persetase Tarif TER</label>
                          <input type="text" class="form-control" id="taxrate" name="taxrate" oninput="formatInput(this)" placeholder="Maximal Penghasilan (Netto)">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary" onclick="saveform(event,'/tc_store/',null);"><i class="fa fa-save"></i> Save</button>
                    </form>
                  </div>
                </div>

                <table id="{{ $tableid }}" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Act</th>
                    <th>Id</th>
                    <th>Kategori TER</th>
                    <th>Minimal Penghasilan (Bruto)</th>
                    <th>Maximal Penghasilan (Bruto)</th>
                    <th>% Tarif Ter</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $i=0;
                    @endphp 
                    @foreach ($taxcategories as $tc)
                     
                     @php
                     $i++;
                         
                     @endphp 
                      <tr>
                        <td>
                            <button class="btn btn-info btn-sm m-1" data-toggle="modal" data-target="#modal-xl" onclick="openEdit('{{ $tc->tax_category_id }}');"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm m-1 del-btn"  onclick="deleteData(event,'/tc_destroy','{{ $tc->tax_category_id }}')"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ $tc->tax_category_id }}</td>
                        <td>{{ $tc->effective_average_tax_rate_category }}</td>
                        <td>{{ number_format($tc->min_gross_income) }}</td>
                        <td>{{ number_format($tc->max_gross_income) }}</td>
                        <td>{{ $tc->tax_rate }}</td>
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
  url = '/tc_getTc/';
  arrParams = {id:id};
  openList(url,arrParams);
}

function deleteData(e,url,id)
{
  arrParams = {id:id};
  destroyData(e,url,arrParams);
}
         
</script>