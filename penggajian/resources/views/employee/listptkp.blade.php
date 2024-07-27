
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
                <table id="{{ $tableid }}" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Status</th>
                    <th>Shortname</th>
                    <th>Kategori TER</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach ($ptkp as $p)
                        <tr>
                        <td>{{ $p->non_taxable_income_id }}</td>
                        <td>{{ $p->non_taxable_income_status_shortname }}</td>
                        <td>{{ $p->non_taxable_income_status_name }}</td>
                        <td>{{ $p->effective_average_tax_rate_category }}</td>
                        <td> <button class="btn btn-info" data-dismiss="modal" onclick="setValue('{{ $p->non_taxable_income_id }}','{{ $p->non_taxable_income_status_name }}','{{ $p->effective_average_tax_rate_category }}')" ><i class="fa fa-check"></i></button>
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
  function setValue(a,b,c)
  {
    document.querySelectorAll('.nontaxableincomeid').forEach(element => {
        element.value = a;
      });
    document.querySelectorAll('.nontaxableincomeshortname').forEach(element => {
        element.value = b;
      });
    document.querySelectorAll('.tercategory').forEach(element => {
        element.value = c;
      });
  }
  </script>
