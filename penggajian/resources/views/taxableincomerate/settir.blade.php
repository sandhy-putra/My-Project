
<head>

</head>
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
                <form id="standarform1">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="mintaxableincome">Minimal Penghasilan (Netto)</label>
                      <input type="text" class="form-control" id="mintaxableincome" name="mintaxableincome" oninput="formatInput(this)" placeholder="Minimal Penghasilan (Netto)" value="{{ number_format($tirr->min_taxable_income) }}">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="maxtaxableincome">Maximal Penghasilan (Netto)</label>
                      <input type="text" class="form-control" id="maxtaxableincome" name="maxtaxableincome" oninput="formatInput(this)" placeholder="Maximal Penghasilan (Netto)" value="{{ number_format($tirr->max_taxable_income) }}">
                      <input type="hidden" class="form-control" id="id" name="id" value="{{ number_format($tirr->id) }}">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="taxableincomerate">Persentase Tarif PKP</label>
                      <input type="text" class="form-control" id="taxableincomerate" name="taxableincomerate" placeholder="Persentase Tarif PKP" value="{{ $tirr->taxable_income_rate }}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" onclick="saveform(event,'/tir_update/',1);"><i class="fa fa-save"></i> Save</button>
                </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>


<!-- Page specific script -->
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    var tabledatavalue = document.getElementById('table-data-value');
    if (tabledatavalue === null) {
      tabledatavalue='';
    }else{
      tabledatavalue=document.getElementById('table-data-value').innerHtml;
    }
    
    $(function () {
      if(tabledatavalue!=''){
        tableid= '#' + '{{ $tableid }}';
        $(tableid).DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": []
        }).buttons().container().appendTo(tableid+'_wrapper .col-md-6:eq(0)');
      }
  
      
    });
  </script>
<script>

function openNonTaxableIncomes2()
{
  url = '/employee_getNonTaxableIncomes/';
  arrParams = null;
  openList(url,arrParams,2);
}
</script>