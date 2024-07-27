@extends('layouts.main')
@section('container')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <style>
      .transaction-input {
          margin-bottom: 5px;
          margin-right: 10px;
      }
    </style>
      <div class="container-fluid" id="table-data-value">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form id="standarform">
                  <input type="file" id="csvFile" accept=".csv">
                  <br><br>
                  <div id="transactionInputs"></div>
                  <br>
                  <input type="hidden" id="jml" name="jml">
                  <button class="btn btn-info btn-sm" type="submit" onclick="saveform(event,'/transaction_store/',null);"><i class="fa fa-save"></i> Save</button>
              </form>
              <script>
                document.getElementById('jml').value=0;
                document.getElementById('csvFile').addEventListener('change', function(event) {
                  
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const contents = e.target.result;
                                    const rows = contents.split('\n');
                                    const transactionInputs = document.getElementById('transactionInputs');
                                    transactionInputs.innerHTML = '';
                                    
                
                                    rows.forEach((row, index) => {
                                        if (row.trim() !== '') { // Skip empty rows
                                            const columns = row.split(',');
                
                                            columns.forEach((column, colIndex) => {
                                                const input = document.createElement('input');
                                                input.type = 'text';
                                                //input.name = `transaction_${index}_item_${colIndex}`;
                                                input.name = `transaction_${index}_item_${colIndex}`;
                                                input.value = column.trim();
                                                input.classList.add('transaction-input');
                                                transactionInputs.appendChild(input);
                                                input.readOnly=true;
                                            });
                
                                            const br = document.createElement('br');
                                            transactionInputs.appendChild(br);
                                            document.getElementById('jml').value=index;
                                        }
                                        
                                    });
                                };
                                reader.readAsText(file);
                            }
                            
                        });
                /*
                        document.getElementById('standarform').addEventListener('submit', function(event) {
                            event.preventDefault();
                            const formData = new FormData(document.getElementById('standarform'));
                            const data = {};
                            formData.forEach((value, key) => {
                                data[key] = value;
                            });
                            console.log("Transaction Data:", data);
                            // Here you can handle the form submission, like sending data to the server
                        });*/
                </script>               
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

