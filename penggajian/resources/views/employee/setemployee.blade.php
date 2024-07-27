
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
                        <label for="employeename">NIK</label>
                        <input type="text" class="form-control" id="idcardnumber" name="idcardnumber" placeholder="NIK" value="{{ $employees->id_card_number }}" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employeename">Nama Lengkap</label>
                        <input type="text" class="form-control" id="employeename" name="employeename" placeholder="Nama Lengkap" value="{{ $employees->name }}" readonly>
                        <input type="hidden" class="form-control" id="employeeid" name="employeeid" value="{{ $employees->employee_id }}">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="birthdate">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $employees->birthdate }}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="joindate">Tanggal Bergabung</label>
                        <input type="date" class="form-control" id="joindate" name="joindate" value="{{ $employees->join_date }}">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="nontaxableincomeid">Status PTKP</label>
                        <input type="hidden" class="form-control nontaxableincomeid" id="nontaxableincomeid" name="nontaxableincomeid" value="{{ $employees->NonTaxableIncome->non_taxable_income_id }}" readonly>
                        <input type="text" class="form-control nontaxableincomeshortname" id="nontaxableincomeshortname" name="nontaxableincomeshortname" data-toggle="modal" data-target="#modal2" onclick="openNonTaxableIncomes2();" value="{{ $employees->NonTaxableIncome->non_taxable_income_status_shortname }}" readonly>
                         
                      </div>
                      <div class="form-group col-md-6">
                        <label for="dependentscount">Kategori TER</label>
                        <input type="text" class="form-control tercategory" id="tercategory" name="tercategory" value="{{ $employees->NonTaxableIncome->effective_average_tax_rate_category }}" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="taxid">NPWP</label>
                        <input type="text" class="form-control" id="taxid" name="taxid" value="{{ $employees->tax_identification_number }}" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="basicsalary">Gaji Pokok</label>
                        <input type="text" class="form-control" id="basicsalary" name="basicsalary" oninput="formatInput(this)" value="{{ number_format($employees->basic_salary) }}">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="healthbpjs">BPJS Kesehatan</label>
                        <input type="text" class="form-control" id="healthbpjs" name="healthbpjs" oninput="formatInput(this)" value="{{ number_format($employees->bpjs_health) }}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employmentbpjs">BPJS Ketenaga Kerjaan</label>
                        <input type="text" class="form-control" id="employmentbpjs" name="employmentbpjs" oninput="formatInput(this)" value="{{ number_format($employees->bpjs_employment) }}">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="saveform(event,'/employee_update/',1);"><i class="fa fa-save"></i> Save</button>
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