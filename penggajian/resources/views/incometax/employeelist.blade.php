
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>
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
                <table id="{{ $tableid }}" class="table table-bordered table-striped" >
                  <thead>
                  <tr>
                    <th>Id Karyawan</th>
                    <th>Name</th>
                    <th>Status PTKP</th>
                    <th>Action</th>
                </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($employees as $emp)
                        <tr>
                        <td>{{ $emp->employee_id }}</td>
                        <td>{{ $emp->empname }}</td>
                        <td>{{ $emp->ptkp }}</td>
                        <td> <button class="btn btn-info" data-dismiss="modal" onclick="setValue('{{ $emp->employee_id }}','{{ $emp->empname }}','{{ $emp->sumgross_income }}','{{$emp->sumbpjs_health }}','{{ $emp->summbpjs_employment }}','{{ $emp->ptkp }}','{{ $emp->ptkpval }}','{{ $emp->sumincome_tax_value }}','{{ $emp->sumdeductions }}','{{ $emp->non_taxable_income_id }}','{{ $emp->tercategory }}','{{ $emp->basic_salary }}','{{ $emp->bpjs_health }}','{{ $emp->bpjs_employment }}','{{ $emp->gross_income }}','{{ $emp->tax_rate }}','{{$emp->income_tax_value  }}')"><i class="fa fa-check"></i></button></td>
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
<script>
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
  function setValue(a,b,c,d,e,f,g,h,ded,ptkpid,tercategory,basicsalary,bpjshealth,bpjsemployment,grossincome,taxrate,incometaxval)
  {

    //bijabatan=6000000+780000;
    bijabatan=0;

    nettincome= parseFloat(c)-parseFloat(d)-parseFloat(e)-parseFloat(bijabatan)-parseFloat(ded);
    pkp= nettincome - g;
    jmlpkp=parseFloat(document.getElementById("jmlpkp").value);
    //pkp=118020000;
    
    sisapkp=pkp;
    totalpph=0;

    for(i=1;i<=jmlpkp;i++)
    {
      min=parseFloat(document.getElementById('minpkp'+i).value);
      max=parseFloat(document.getElementById('maxpkp'+i).value);
      pkprate=parseFloat(document.getElementById('pkprate'+i).value)/100;
      //totalpph=0;
      
      if((i==1) && (sisapkp-max>=0)){
        pph = pkprate * max;
        totalpph = totalpph + pph;
        sisapkp = sisapkp - max; 
        //alert(pph);
        document.getElementById("pph"+i).value=toNumber(pph);
        document.getElementById("sisapkp"+i).value=toNumber(max);   
      }else if((i>1) && (sisapkp>0)){
        document.getElementById("sisapkp"+i).value=toNumber(sisapkp);
        pph = pkprate * sisapkp;
        totalpph = totalpph + pph;
        sisapkp = sisapkp - max;
        //alert(pph);
        document.getElementById("pph"+i).value=toNumber(pph);
      }else{
        document.getElementById("pph"+i).value=0;
        document.getElementById("sisapkp"+i).value=0;
      }
    }

    nettincome=toNumber(nettincome);
    pkp=toNumber(pkp);
    pphakhir=parseFloat(totalpph)-parseFloat(h);
    
    document.getElementById('employeeid').value=a;
    document.getElementById('employeename').value=b;
    document.getElementById('sumincome').value=tocurrency(c);
    document.getElementById('sumbpjshealth').value=tocurrency(d);
    document.getElementById('sumbpjsemp').value=tocurrency(e);
    document.getElementById('bijabatan').value=toNumber(bijabatan);
    document.getElementById('nettincome').value=nettincome;
    document.getElementById('ptkpstatus').value=f;
    document.getElementById('ptkpvalue').value=tocurrency(g);
    document.getElementById('pkpvalue').value=pkp;
    document.getElementById('pphumum').value=toNumber(totalpph);
    document.getElementById('sumincometax').value=tocurrency(h);
    document.getElementById('pphakhir').value=toNumber(pphakhir);
    document.getElementById('sumotherdeduction').value=toNumber(ded);
    document.getElementById('ptkpid').value=ptkpid;
    document.getElementById('tercategory').value=tercategory;
    document.getElementById('basicsalary').value=basicsalary;
    document.getElementById('bpjshealth').value=bpjshealth;
    document.getElementById('bpjsemployment').value=bpjsemployment;
    document.getElementById('grossincome').value=grossincome;
    document.getElementById('taxrate').value=taxrate;
    document.getElementById('incometaxval').value=incometaxval;   
  }
</script>