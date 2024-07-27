<style>

    #chart {

      width: 100%;

      height: 200px;

      border: 1px solid #ddd;

    }

    .bar {

      width: 50px;

      height: 0;

      background-color: #4CAF50;

      margin: 2px;

      display: inline-block;

      position: relative;

    }

    .bar-label {

      position: absolute;

      bottom: 0;

      left: 0;

      font-size: 12px;

      color: #fff;

      text-align: center;

      width: 100%;

    }

  </style>
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
                <h3>Frequent Item Set</h3><hr>
                <div id="chart"></div>
                <script>

                    const data = [
                    @foreach ($fis as $fs)
                      { value: {{ $fs->support_count }}, label: '{{ $fs->itemset }}' },
                
                    @endforeach
                    ];
                
                    const chart = document.getElementById('chart');
                
                    const maxValue = Math.max(...data.map(d => d.value));
                
                    const scale = 200 / maxValue;
                
                
                    data.forEach((item, index) => {
                
                      const bar = document.createElement('div');
                
                      bar.className = 'bar';
                
                      bar.style.height = `${item.value * scale}px`;
                
                      chart.appendChild(bar);
                
                
                      const label = document.createElement('div');
                
                      label.className = 'bar-label';
                
                      label.textContent = item.label;
                
                      bar.appendChild(label);
                
                    });
                
                  </script>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Set</th>
                            <th>Support Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fis as $f)
                            <tr>
                                <td>{{ $f->itemset }}</td>
                                <td>{{ $f->support_count }}</td>
                            </tr>    
                        @endforeach
                        
                    </tbody>                  
                </table>

                <br><br>

                <h3>Association Rules</h3><hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Antecedent</th>
                            <th>Consequent</th>
                            <th>Confidence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arule as $rule)
                            <tr>
                                <td>{{ $rule->antecedent }}</td>
                                <td>{{ $rule->consequent }}</td>
                                <td>{{ $rule->confidence }}</td>
                            </tr>
                        @endforeach
                    </tbody>               
                </table>

                <br><br>
                  <h2>Strategi Bisnis yang Dapat Diambil</h2>
                  <ul class="list-group">
                      <li class="list-group-item">
                          <strong>Promosi Bundling:</strong> Menggabungkan produk yang sering dibeli bersama dalam satu paket promosi.
                      </li>
                      <li class="list-group-item">
                          <strong>Penempatan Produk:</strong> Menempatkan produk yang sering dibeli bersama dalam rak yang berdekatan untuk meningkatkan penjualan.
                      </li>
                      <li class="list-group-item">
                          <strong>Inventarisasi:</strong> Memastikan stok untuk produk-produk yang sering dibeli bersama selalu tersedia untuk menghindari kehabisan stok dan kehilangan penjualan potensial.
                      </li>
                  </ul>
                  <p class="mt-3">
                      Dengan analisis ini, Anda dapat membuat keputusan bisnis yang lebih baik berdasarkan pola pembelian yang ditemukan dari data transaksi.
                  </p>
              



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

