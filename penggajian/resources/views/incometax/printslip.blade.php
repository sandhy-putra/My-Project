<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .card {
            width: 300px; /* Approximate ATM card width */
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 1em;
        }
        .section {
            margin-top: 10px;
        }
        .section .title {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-bottom: 5px;
            font-size: 0.9em;
        }
        .section .content {
            font-size: 0.8em;
        }
        .content .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .item span {
            display: inline-block;
            min-width: 80px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1>Slip Gaji</h1>
            <p>Periode: {{ $month }} {{ $year }}</p>
        </div>

        <div class="section">
            <div class="title">Data Karyawan</div>
            <div class="content">
                <div class="item">
                    <span>ID. Karyawan:</span>
                    <span>{{ $it->employee_id }}</span>
                </div>
                <div class="item">
                    <span>Nama:</span>
                    <span>{{ $it->Employee->name }}</span>
                </div>
            </div>
        </div>
        @php
            $bruto= $it->basic_salary + $it->bonus + $it->bpjs_health + $it->bpjs_employment + $it->other_deductions;
        @endphp

        <div class="section">
            <div class="title">Rincian Gaji</div>
            <div class="content">
                <div class="item">
                    <span>Gaji Pokok:</span>
                    <span>Rp. {{ number_format($it->basic_salary) }}</span>
                </div>
                <div class="item">
                    <span>Bonus:</span>
                    <span>Rp. {{ number_format($it->bonus) }}</span>
                </div>
                <div class="item">
                    <span>Ket:{{ $it->bonus_remark }}</span>
                    <span></span>
                </div>
                <div class="item">
                    <span>Potongan BPJS Kes:</span>
                    <span>( Rp. {{ number_format($it->bpjs_health) }})</span>
                </div>
                <div class="item">
                    <span>Potongan BPJS Ket:</span>
                    <span>( Rp. {{ number_format($it->bpjs_employment) }})</span>
                </div>
                <div class="item">
                    <span>Potongan lain:</span>
                    <span>( Rp. {{ number_format($it->other_deductions) }})</span>
                </div>
                <div class="item">
                    <span>Ket:  {{ $it->other_deductions_remark  }}</span>
                    <span></span>
                </div>
                <div class="item">
                    <span>Total Gaji Bersih:</span>
                    <span>Rp {{ number_format($bruto) }}</span>
                </div>
                <div class="item">
                    <span>Potongan PPh21:</span>
                    <span>( Rp. {{ number_format($it->income_tax_value) }})</span>
                </div>
                
                <center><a href="#" onclick="window.print()">Print</a></center>
            </div>
        </div>
    </div>
</body>
</html>
