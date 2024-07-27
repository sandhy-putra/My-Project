
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
                      <label for="mingrossincome">Minimal Penghasilan (Bruto)</label>
                      <input type="text" class="form-control" id="mingrossincome" name="mingrossincome" oninput="formatInput(this)" placeholder="Minimal Penghasilan (Netto)" value="{{ number_format($tcc->min_gross_income)  }}">
                      <input type="hidden" class="form-control" id="taxcategoryid" name="taxcategoryid" value="{{ $tcc->tax_category_id  }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="maxgrossincome">Maximal Penghasilan (Bruto)</label>
                      <input type="text" class="form-control" id="maxgrossincome" name="maxgrossincome" oninput="formatInput(this)" placeholder="Maximal Penghasilan (Netto)" value="{{ number_format($tcc->max_gross_income)  }}">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="maxtaxableincome">Kategori TER</label>
                      <select class="form-control" id="tercategory" name="tercategory" disabled> 
                        <option value="{{ $tcc->effective_average_rate_category }}" selected>{{  $tcc->effective_average_tax_rate_category }}</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                       </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="taxrate">Persetase Tarif TER</label>
                      <input type="text" class="form-control" id="taxrate" name="taxrate" oninput="formatInput(this)" placeholder="Maximal Penghasilan (Netto)" value="{{ $tcc->tax_rate }}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" onclick="saveform(event,'/tc_update/',1);"><i class="fa fa-save"></i> Save</button>
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