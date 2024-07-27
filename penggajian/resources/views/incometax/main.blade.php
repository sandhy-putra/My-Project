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
                <form action="incometax_view" method="POST">
                <div class="form-row">
                    @csrf
                    <div class="form-group col-md-3">
                      <label for="mperiod">Bulan</label>
                        <select class="form-control" id="mperiod" name="mperiod"> 
                          <option value="" selected></option>
                          <option value="01">JANUARI</option>
                          <option value="02">PEBRUARI</option>
                          <option value="03">MARET</option>
                          <option value="04">APRIL</option>
                          <option value="05">MEI</option>
                          <option value="06">JUNI</option>
                          <option value="07">JULI</option>
                          <option value="08">AGUSTUS</option>
                          <option value="09">SEPTEMBER</option>
                          <option value="10">OKTOBER</option>
                          <option value="11">NOPEMBER</option>
                          <option value="12">DESEMBER</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="yperiod">Tahun</label>
                      <select class="form-control" id="yperiod" name="yperiod"> 
                        <option value="" selected></option>
                        @for ($i = 2020; $i < date('Y')+2; $i++)
                          <option value="{{ $i }}" >{{ $i }}</option>  
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-success">View</button>
                    </div>                  
                  </div>

                </form>
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

</script>