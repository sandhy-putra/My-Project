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
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <label for="employeeid">ID Karyawan</label>
                            <input type="text" class="form-control" id="employeeid" name="employeeid" data-toggle="modal" data-target="#modal-xl" onclick="openEmployee();" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="employeename">Nama Karyawan</label>
                              <input type="text" class="form-control" id="employeename" name="employeename" data-toggle="modal" data-target="#modal-xl" onclick="openEmployee();" readonly>
                              <input type="hidden" class="form-control" id="ptkpid" name="ptkpid" readonly>
                              <input type="hidden" class="form-control" id="tercategory" name="tercategory" readonly>
                              <input type="hidden" class="form-control" id="basicsalary" name="basicsalary" readonly>
                              <input type="hidden" class="form-control" id="bpjshealth"   name="bpjshealth" readonly>
                              <input type="hidden" class="form-control" id="bpjsemployment" name="bpjsemployment" readonly>
                              <input type="hidden" class="form-control" id="grossincome" name="grossincome" readonly>
                              <input type="hidden" class="form-control" id="taxrate" name="taxrate" readonly>
                              <input type="hidden" class="form-control" id="incometaxval" name="incometaxval" readonly>
                              

                        
                            </div>
                      </div>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <h5>Total Penerimaan</h4>
                          </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>Pendapatan Bruto</b>
                        </div>
                        <div class="form-group col-md-5">
                              <input type="text" class="form-control" id="sumincome" name="sumincome" readonly>
                        </div>
                      </div>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <h5>Total Pengurangan</h4>
                          </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>Biaya Jabatan</b>
                        </div>
                        <div class="form-group col-md-5">
                              <input type="text" class="form-control" id="bijabatan" name="bijabatan" readonly>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>BPJS Kesehatan</b>
                        </div>
                        <div class="form-group col-md-5">
                              <input type="text" class="form-control" id="sumbpjshealth" name="sumbpjshealth" readonly>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>BPJS Ketenagakerjaan</b>
                        </div>
                        <div class="form-group col-md-5">
                              <input type="text" class="form-control" id="sumbpjsemp" name="sumbpjsemp" readonly>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>Potongan Lain - lain</b>
                        </div>
                        <div class="form-group col-md-5">
                              <input type="text" class="form-control" id="sumotherdeduction" name="sumotherdeduction" readonly>
                        </div>
                      </div>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>Pendapatan Netto</b>
                        </div>
                        <div class="form-group col-md-5">
                              <input type="text" class="form-control" id="nettincome" name="nettincome" readonly>
                        </div>
                      </div>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>Penghasilan Tidak Kena Pajak (PTKP) Wajib Pajak Pribadi</b>
                        </div>
                        <div class="form-group col-md-1">
                              <input type="text" class="form-control" id="ptkpstatus" name="ptkpstatus" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" id="ptkpvalue" name="ptkpvalue" readonly>
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>Penghasilan Kena Pajak (PKP)</b>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" id="pkpvalue" name="pkpvalue" readonly>
                      </div>
                      </div>
                      <hr>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <h5>PPh 21 Tarif Umum</h5>
                        </div>
                        <div class="form-group col-md-4">
                      </div>
                      </div>
                      @php
                         $jmlpkp=0;    
                      @endphp

                      @foreach ($pkp as $p)
                        @php
                          $jmlpkp++;    
                        @endphp
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          @if ($p->min_taxable_income==0)
                              @php
                                  $nilaipkp= 'PKP Sampai ' . 'Rp. ' .number_format($p->max_taxable_income);
                              @endphp  
                          @else
                            @php
                              $nilaipkp= 'PKP Rp. '.number_format($p->min_taxable_income).' s/d ' . 'Rp. ' .number_format($p->max_taxable_income);  
                            @endphp
                          @endif
                          <p style='font-size:8pt'><b>{{ $nilaipkp }}</b></p>
                        </div>
                        <div class="form-group col-md-1">
                            <input type="text" class="form-control" id="pkprate{{ $jmlpkp }}" name="pkprate{{ $jmlpkp }}" value="{{ $p->taxable_income_rate }}" readonly>
                        </div>
                        <div class="form-group col-md-1">
                          <b>%</b>
                      </div>
                        <div class="form-group col-md-2">
                          <input type="text" class="form-control" id="sisapkp{{ $jmlpkp }}" name="sisapkp{{ $jmlpkp }}" readonly>
                        </div>
                        <div class="form-group col-md-2">
                          <input type="hidden" class="form-control" id="minpkp{{ $jmlpkp }}" name="minpkp{{ $jmlpkp }}" value="{{ $p->min_taxable_income }}">
                          <input type="hidden" class="form-control" id="maxpkp{{ $jmlpkp }}" name="maxpkp{{ $jmlpkp }}" value="{{ $p->max_taxable_income }}">
                          <input type="text" class="form-control" id="pph{{ $jmlpkp }}" name="pph{{ $jmlpkp }}" readonly >
                      </div>
                      </div>
                      @endforeach
                      <input type="hidden" class="form-control" id="jmlpkp" name="jmlpkp" value="{{ $jmlpkp }}">
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>PPh 21 Tarif Umum</b>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" id="pphumum" name="pphumum" readonly>
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>PPh 21 Awal - Periode lalu</b>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" id="sumincometax" name="sumincometax" readonly>
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-3">
                          <b>PPh 21 Masa Pajak Terakhir</b>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" id="pphakhir" name="pphakhir" readonly>
                        </div>
                      </div>
                    </div>
                    <center>
                       <button type="submit" class="btn btn-primary" onclick="saveform(event,'/storelastincometax',null);"><i class="fa fa-save"></i> Save</button>
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
 

function openEmployee()
{
  url = '/incometax_getemployee/';
  yperiod=document.getElementById('yperiod').value;
  mperiod=document.getElementById('mperiod').value;
  arrParams = { year: yperiod, month: mperiod };
  openList(url,arrParams);
}
</script>