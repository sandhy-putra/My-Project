@extends('layouts.main')
@section('container')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
      <div class="container-fluid" id="table-data-value">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
                &nbsp;
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                
                  <div class="card card-body">
                    <form id="standarform">
                      @csrf
                      <div class="form-row">
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
                      
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Kalkulasi Pajak Penghasilan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th style="font-size:8pt;width:100px">No</th>
                                <th style="font-size:8pt;width:100px">ID Karyawan</th>
                                <th style="font-size:8pt;width:100px" >Nama Karyawan</th>
                                <th style="font-size:8pt;width:100px">Status PTKP</th>
                                <th style="font-size:8pt;width:100px">Kategori TER</th>
                                <th style="font-size:8pt;width:100px">Gaji Pokok</th>
                                <th style="font-size:8pt;width:100px">BPJS Kes.</th>
                                <th style="font-size:8pt;width:100px">BPJS Ket.</th>
                                <th style="font-size:8pt;width:100px">Bonus</th>
                                <th style="font-size:8pt;width:100px">Remark</th>
                                <th style="font-size:8pt;width:100px">Potongan Lain</th>
                                <th style="font-size:8pt;width:100px">Remark</th>
                                <th style="font-size:8pt;width:100px">Penghasilan Bruto</th>
                                <th style="font-size:8pt;width:100px">%TER</th>
                                <th style="font-size:8pt;width:100px">PPh</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                                  $i=0;
                                  
                              @endphp
                              @foreach ($employees as $employee)
                              @php
                                  $i++;
                                  $grossincome= $employee->basic_salary + $employee->bpjs_health + $employee->bpjs_employment;
                              @endphp
                              <tr>
                                <td><input class="form-control" style="font-size:8pt;width:40px;" type="text"  name="no{{ $i }}" id="no{{ $i }}" value="{{ $i }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:100px" type="text"  name="employeeid{{ $i }}" id="employeeid{{ $i }}" value="{{ $employee->employee_id }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:120px" type="text"  name="employeename{{ $i }}" id="employeename{{ $i }}" value="{{ $employee->name }}"></td>
                                <td>
                                  <input class="form-control" style="font-size:8pt;width:50px" type="text"  name="nontaxableincomestatusshortname{{ $i }}" id="nontaxableincomestatusshortname{{ $i }}" value="{{ $employee->nonTaxableIncome->non_taxable_income_status_shortname }}">
                                  <input type="hidden"  name="nontaxableincomesid{{ $i }}" id="nontaxableincomesid{{ $i }}" value="{{ $employee->non_taxable_income_id }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:40px" type="text"  name="tercategory{{ $i }}" id="tercategory{{ $i }}" value="{{ $employee->nonTaxableIncome->effective_average_tax_rate_category }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:90px" type="text"  name="basicsalary{{ $i }}" id="basicsalary{{ $i }}" value="{{ number_format($employee->basic_salary) }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:70px" type="text"  name="bpjshealth{{ $i }}" id="bpjshealth{{ $i }}" value="{{ number_format($employee->bpjs_health) }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:70px" type="text"  name="bpjsemployment{{ $i }}" id="bpjsemployment{{ $i }}" value="{{ number_format($employee->bpjs_employment) }}"></td>
                                <td><input class="form-control" style="font-size:8pt;width:90px" type="text"  name="bonus{{ $i }}" id="bonus{{ $i }}" oninput="formatInput(this)" onkeyup="setGrossIncome('{{ $i }}')" value="0" ></td>
                                <td><input class="form-control" placeholder="Keterangan" style="font-size:8pt;width:100px" type="text"  name="bonusremark{{ $i }}" id="bonusremak{{ $i }}" oninput="toUppercase(this)" value=""></td>
                                <td><input class="form-control" style="font-size:8pt;width:70px" type="text"  name="otherdeductions{{ $i }}" id="otherdeductions{{ $i }}" oninput="formatInput(this)" onkeyup="setGrossIncome('{{ $i }}')" value="0"></td>
                                <td><input class="form-control" placeholder="Keterangan" style="font-size:8pt;width:100px" type="text"  name="otherdeductionsremark{{ $i }}" id="otherdeductionsremark{{ $i }}" oninput="toUppercase(this)" value=""></td>                                
                                <td>
                                    <input class="form-control" style="font-size:8pt;width:120px" type="text"  name="grossincome{{ $i }}" id="grossincome{{ $i }}" value="{{ number_format($grossincome) }}">
                                    <input class="form-control" style="font-size:8pt;width:120px" type="hidden"  name="grossincomef{{ $i }}" id="grossincomef{{ $i }}" value="{{ number_format($grossincome) }}">
                                </td>
                                <td><input class="form-control" style="font-size:8pt;width:50px" type="text"  name="tervalue{{ $i }}" id="tervalue{{ $i }}" value=""></td>
                                <td><input class="form-control" style="font-size:8pt;width:100px" type="text"  name="incometax{{ $i }}" id="incometax{{ $i }}" value=""></td>
                              </tr>
                              
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                    </div>
                    <center>
                       <input type="hidden" id="jml" name="jml" value="{{ $i }}">
                       <button type="button" class="btn btn-success" onclick="getTer()"><i class="fa fa-calculator"></i> Hitung</button>
                       <button type="submit" class="btn btn-primary" onclick="saveform(event,'/storeincometax',null);"><i class="fa fa-save"></i> Save</button>
                    </center>
                      </form>
                  </div>
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
function cek(){
ofbutton('tes','success')
}
  /*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
*/

  function getTer() {
    let jml = parseFloat(document.getElementById('jml').value);

    for (let i = 1; i <= jml; i++) {
        let gincome = document.getElementById('grossincome' + i).value;
        gi = toNormalNumber(gincome);

        let grossincome = parseFloat(gi);
        let tercategory = document.getElementById('tercategory' + i).value;
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Membuat penutupan untuk mengatasi masalah asinkron
        (function(index) {
            $.ajax({
                url: '/gettaxrate', // Ganti dengan URL endpoint Anda
                method: 'POST',
                data: {
                    grossincome: grossincome,
                    tercategory: tercategory,
                    _token: csrfToken
                },
                success: function(response) {
                    if (index <= jml) {
                        document.getElementById('tervalue' + index).value = response.result;
                        document.getElementById('incometax' + index).value = toNumber(grossincome * (response.result/100));
                        
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        })(i);
    }
}

function setGrossIncome(i)
{
  let tgrossincome= toNormalNumber(document.getElementById('grossincomef'+i).value);
  let tbonus= toNormalNumber(document.getElementById('bonus'+i).value);
  let totherdeductions= toNormalNumber(document.getElementById('otherdeductions'+i).value);
  
  tgrossincome=parseFloat(tgrossincome);
  tbonus=parseFloat(tbonus);
  totherdeductions=parseFloat(totherdeductions);
  
  grossincome = tgrossincome + tbonus - totherdeductions;
  document.getElementById('grossincome'+i).value = toNumber(grossincome);
}
</script>