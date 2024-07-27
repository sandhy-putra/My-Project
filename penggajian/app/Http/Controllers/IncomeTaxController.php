<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\IncomeTax;
use App\Models\Employee;
use App\Models\TaxCategory;
use App\Models\TaxableIncomeRate;

class IncomeTaxController extends Controller
{
    function index()
    {
        return view('incometax/main',[
            "title" => "Recap Potongan Pajak Penghasilan Pasal 21",
            "tableid" => "incometaxtable",
        ]);
    }
    
    function view(Request $request)
    {
        $mperiod=$request->input("mperiod");
        $yperiod=$request->input("yperiod");        
        $period=$yperiod.$mperiod;
        return redirect()->route('viewlist', ['period' => $period]);
    }

    function viewlist(Request $request)
    {
        $period=$request->query('period');
        return view('incometax/mainview',[
            "title" => "Recap Potongan Pajak Penghasilan Pasal 21",
            "tableid" => "incometaxtable",
            "incometaxes" => IncomeTax::where('tax_period',$period)->get()
        ]);
    }

    function openslip()
    {
        return view('incometax/mainslip',[
            "title" => "Slip Gaji",
            "tableid" => "incometaxtable",
        ]);
    }

    function viewslip(Request $request)
    {
        $mperiod=$request->input("mperiod");
        $yperiod=$request->input("yperiod");        
        $period=$yperiod.$mperiod;
        return redirect()->route('viewlistslip', ['period' => $period]);
    }

    function viewlistslip(Request $request)
    {
        $period=$request->query('period');
        return view('incometax/mainviewslip',[
            "title" => "Slip Gaji",
            "tableid" => "incometaxtable",
            "incometaxes" => IncomeTax::where('tax_period',$period)->get()
        ]);
    }

    function printSlip($a, $b, $c)
    {
        $year = substr($a, 0, 4);
        $month = substr($a, 4, 2);
    
        // Daftar nama bulan
        $months = [
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        ];

        return view('incometax/printslip',[
            "title" => "Slip Gaji",
            "tableid" => "incometaxtable",
            "year" => $year,
            "month" => $months[$month],
            "it" => IncomeTax::where('tax_period',$a)
                                        ->where('employee_id',$b)
                                        ->where('non_taxable_income_id',$c)
                                        ->first()
                                        
        ]);
    }


    function setTax()
    {
        return view('incometax/maintax',[
            "title" => "Form Potongan Pajak Penghasilan Pasal 21",
            "tableid" => "incometaxtable",
            "employees" => Employee::All()
        ]);
    }

    function setLastPeriodTax()
    {
        return view('incometax/mainlasttax',[
            "title" => "Form Potongan Pajak Penghasilan Pasal 21 (Masa Pajak Terakhir)",
            "tableid" => "incometaxtable",
            "pkp" => TaxableIncomeRate::All()
        ]);
    }

    function getTaxRate(Request $request)
    {
        $grossIncome = $request->input('grossincome');
        $tercategory = $request->input('tercategory');

        // Mengambil tax rate berdasarkan kategori dan gross income
        $taxRate = TaxCategory::where('effective_average_tax_rate_category', $tercategory)
                    ->where('min_gross_income', '<=', $grossIncome)
                    ->where('max_gross_income', '>=', $grossIncome)
                    ->first();

         // Mengambil nilai tax rate atau berikan nilai default 0.00 jika tidak ditemukan
         $taxRateValue = $taxRate ? $taxRate->tax_rate : 0.00;

         // Mengembalikan hasil sebagai respons JSON
         return response()->json(['result' => $taxRateValue]);
    }

    public function getEmployee(Request $request)
    {
        // Mengambil parameter 'params' dari query string
        $paramsJson = $request->query('params', '[]');

        // Mendekodekan JSON menjadi array PHP
        $params = json_decode($paramsJson, true);

        // Memastikan bahwa decoding JSON berhasil
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid JSON format'
            ], 400);
        }

        // Pastikan parameter yang diharapkan ada di dalam array
        $year = $params['year'] ?? null;
        $month = $params['month'] ?? null;

        if (is_null($year) || is_null($month)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ], 400);
        }

        $bulan = $month; // Nilai awal variabel bulan
        // Mengubah nilai bulan menjadi integer
        $bulan_baru_int = (int)$bulan - 1;

        // Jika nilai bulan baru menjadi 0, set ke 12 (mengatasi kasus bulan Januari menjadi Desember)
        if ($bulan_baru_int == 0) {
            $bulan_baru_int = 12;
        }

        // Mengubah kembali nilai bulan baru menjadi string dengan format dua digit
        $lastmonth = str_pad((string)$bulan_baru_int, 2, '0', STR_PAD_LEFT);

        return view('incometax.employeelist', [
            "title" => "Employee",
            "tableid" => "employeelist",
            "employees" => IncomeTax::getIncomeTaxSummary($year, $lastmonth), // Jika perlu mengembalikan data lainnya
        ]);
    }

    function store(Request $request)
    {
        $periode = $request->yperiod.$request->mperiod;
        $jml = $request->jml;

        // Memulai transaksi
        DB::beginTransaction();

        try {

            for ($i = 1; $i <= $jml; $i++) {
                
                $employeeid=$request->input("employeeid{$i}");
                $nontaxableincomesid=$request->input("nontaxableincomesid{$i}");
                $tercategory=$request->input("tercategory{$i}");
                $basicsalary= str_replace(',','',$request->input("basicsalary{$i}")) ;
                $bpjshealth=str_replace(',','',$request->input("bpjshealth{$i}"));
                $bpjsemployment=str_replace(',','',$request->input("bpjsemployment{$i}"));
                $bonus=str_replace(',','',$request->input("bonus{$i}"));
                $bonusremark=$request->input("bonusremark{$i}");
                $otherdeductions=str_replace(',','',$request->input("otherdeductions{$i}"));
                $otherdeductionsremark=$request->input("otherdeductionsremark{$i}");
                $grossincome=str_replace(',','',$request->input("grossincome{$i}"));
                $tervalue=$request->input("tervalue{$i}");
                $incometax=str_replace(',','',$request->input("incometax{$i}"));
                
                
                IncomeTax::create([
                    'tax_period' => $periode,
                    'employee_id' => $employeeid,
                    'non_taxable_income_id' => $nontaxableincomesid,
                    'effective_average_tax_rate_category' => $tercategory,
                    'basic_salary' => $basicsalary,
                    'bpjs_health' => $bpjshealth,
                    'bpjs_employment' => $bpjsemployment,
                    'bonus' => $bonus,
                    'bonus_remark' => $bonusremark,
                    'other_deductions' => $otherdeductions,
                    'other_deductions_remark' =>$otherdeductionsremark,
                    'gross_income' => $grossincome,
                    'tax_rate' => $tervalue,
                    'income_tax_value' => $incometax
                ]);
            }

            // Commit transaksi jika semua data berhasil disimpan
            DB::commit();
            return response()->json(['message' => 'Data Tersimpan', 'refresh' =>'/settax','success'=>'Berhasil!','icon' => 'success']);

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());

            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data','refresh'=>'/settax' ,'success'=>'Gagal!','icon' => 'error'],500);
        }
    }

    function storeLastTax(Request $request)
    {
        $periode = $request->yperiod.$request->mperiod;
        // Memulai transaksi
        DB::beginTransaction();

        try {
                
                $employeeid=$request->input("employeeid");
                $nontaxableincomesid=$request->input("ptkpid");
                $tercategory=$request->input("tercategory");
                $basicsalary= str_replace(',','',$request->input("basicsalary")) ;
                $bpjshealth=str_replace(',','',$request->input("bpjshealth"));
                $bpjsemployment=str_replace(',','',$request->input("bpjsemployment"));
                $bonus=0;
                $bonusremark=null;
                $otherdeductions=0;
                $otherdeductionsremark=null;
                $grossincome=str_replace(',','',$request->input("grossincome"));
                $tervalue=$request->input("taxrate");
                $incometax=str_replace(',','',$request->input("pphakhir"));
                
                
                IncomeTax::create([
                    'tax_period' => $periode,
                    'employee_id' => $employeeid,
                    'non_taxable_income_id' => $nontaxableincomesid,
                    'effective_average_tax_rate_category' => $tercategory,
                    'basic_salary' => $basicsalary,
                    'bpjs_health' => $bpjshealth,
                    'bpjs_employment' => $bpjsemployment,
                    'bonus' => $bonus,
                    'bonus_remark' => $bonusremark,
                    'other_deductions' => $otherdeductions,
                    'other_deductions_remark' =>$otherdeductionsremark,
                    'gross_income' => $grossincome,
                    'tax_rate' => $tervalue,
                    'income_tax_value' => $incometax,
                    'is_last_period' => true
                ]);
            

            // Commit transaksi jika semua data berhasil disimpan
            DB::commit();
            return response()->json(['message' => 'Data Tersimpan', 'refresh' =>'/setlasttax','success'=>'Berhasil!','icon' => 'success']);

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());

            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data','refresh'=>'/settax' ,'success'=>'Gagal!','icon' => 'error'],500);
        }
    }

    function destroy(Request $request)
      {  
        // Memulai transaksi
        DB::beginTransaction();

        try {
             // Mengambil parameter 'params' dari query string
             $paramsJson = $request->query('params', '[]');

             // Mendekodekan JSON menjadi array PHP
             $params = json_decode($paramsJson, true);
 
             // Memastikan bahwa decoding JSON berhasil
             if (json_last_error() !== JSON_ERROR_NONE) {
                 return response()->json([
                     'status' => 'error',
                     'message' => 'Invalid JSON format'
                 ], 400);
             }
 
             // Pastikan parameter yang diharapkan ada di dalam array
             $taxperiod = $params['taxperiod'] ?? null;
             $empid = $params['empid'] ?? null;
             $ntiid = $params['ntiid'] ?? null;
             
 
             if (is_null($taxperiod) || is_null($empid) || is_null($ntiid)) {
                 return response()->json([
                     'status' => 'error',
                     'message' => 'Missing required parameters'
                 ], 400);
             }
             // Temukan record berdasarkan non_taxable_income_id
             $ic = IncomeTax::where('tax_period', $taxperiod)
                              ->where('employee_id',$empid)
                              ->where('non_taxable_income_id',$ntiid);

             if ($ic) {
                // Hapus record yang ditemukan
                $ic->delete();
                DB::commit();
                $refresh='/viewlist?period='.$taxperiod;
                return response()->json(['message' => 'Data telah dihapus','refresh' =>$refresh ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            $refresh='/viewlist?period='.$taxperiod;
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>$refresh, 'icon' => 'error', 'success' => 'Gagal !']);
        }
      
    }

}
