
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
                      <label for="nontaxableincomestatusname">Status Penghasilan Tidak Kena Pajak</label>
                      <input type="text" class="form-control" id="nontaxableincomestatusname" name="nontaxableincomestatusname" oninput="toUppercase(this)" placeholder="Status Penghasilan Tidak Kena Pajak" value="{{ $ntii->non_taxable_income_status_name }}">
                      <input type="hidden" class="form-control" id="nontaxableincomeid" name="nontaxableincomeid" value="{{ $ntii->non_taxable_income_id }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nontaxableincomestatusshortname">Shortname</label>
                      <input type="text" class="form-control" id="nontaxableincomestatusshortname" name="nontaxableincomestatusshortname" oninput="toUppercase(this)" placeholder="Singkatan" value="{{ $ntii->non_taxable_income_status_shortname }}">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="effectiveaveragetaxratecategory">Kategori Tarif Efektif Rata-rata (TER)</label>
                      <select class="form-control" id="effectiveaveragetaxratecategory" name="effectiveaveragetaxratecategory"> 
                        <option value="{{ $ntii->effective_average_tax_rate_category }}" selected>{{ $ntii->effective_average_tax_rate_category }}</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                       </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nontaxableincomestatusvalue">Nilai Penghasilan Tidak Kena Pajak (PTKP)</label>
                      <input type="text" class="form-control" id="nontaxableincomestatusvalue" oninput="formatInput(this)" name="nontaxableincomestatusvalue" value="{{ number_format($ntii->non_taxable_income_status_value) }}">
                    </div>
                  </div>
                   
                  <button type="submit" class="btn btn-primary" onclick="saveform(event,'/nti_update/',1);"><i class="fa fa-save"></i> Save</button>
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