<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NonTaxableIncome;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NonTaxableIncomeController extends Controller
{
    function index(){
        return view('nontaxableincome/main',[
            "title" => "Master Penghasilan Tidak Kena Pajak",
            "tableid" => "nontaxableincometable",
            "nontaxableincomes" => NonTaxableIncome::All()
        ]);
    }

    function getNti(Request $request){
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
        $id = $params['id'] ?? null;
       
        if (is_null($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ], 400);
        }

        return view('nontaxableincome/setnti', [
            "title" => "Edit Data",
            "tableid" => "setnti",
            "ntii" => NonTaxableIncome::where('non_taxable_income_id', $id)->firstOrFail()// Jika perlu mengembalikan data lainnya
        ]);

    }

    function storeNonTaxableIncome(Request $request){
        // Memulai transaksi
        DB::beginTransaction();

        try {

            NonTaxableIncome::create([
                'non_taxable_income_id' => NonTaxableIncome::generateNonTaxableIncomeCode(),
                'non_taxable_income_status_name' => $request->nontaxableincomestatusname,
                'non_taxable_income_status_shortname' => $request->nontaxableincomestatusshortname,
                'effective_average_tax_rate_category' => $request->effectiveaveragetaxratecategory,
                'non_taxable_income_status_value' => str_replace(',','',$request->nontaxableincomestatusvalue)               
                // tambahkan kolom lainnya sesuai kebutuhan
            ]);
            DB::commit();
            return response()->json(['message' => 'Data telah disimpan','refresh' =>'/nti' ,'icon' => 'success','succes' => 'Berhasil !']);
 
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/nti', 'icon' => 'error', 'success' => 'Gagal !']);
        }
  
      }

      function updateNti(Request $request){

        // Memulai transaksi
        DB::beginTransaction();

        try {

            $id = $request->input("nontaxableincomeid");

            if (is_null($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Missing required parameters'
                ], 400);
            }
            // Temukan record berdasarkan non_taxable_income_id
            $nti = NonTaxableIncome::where('non_taxable_income_id', $id)->first();

            if ($nti) {
                // Hapus record yang ditemukan
                $nti->non_taxable_income_status_shortname=$request->input("nontaxableincomestatusshortname");
                $nti->non_taxable_income_status_name=$request->input("nontaxableincomestatusname");
                $nti->effective_average_tax_rate_category=$request->input("effectiveaveragetaxratecategory");
                $nti->non_taxable_income_status_value=str_replace(',','',$request->input("nontaxableincomestatusvalue"));
                $nti->save();
                
                // Commit transaksi jika semua data berhasil disimpan
                DB::commit();
                return response()->json(['message' => 'Data telah diperbarui','refresh' =>'/nti' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                // Rollback transaksi jika terjadi kesalahan
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/nti', 'icon' => 'error', 'success' => 'Gagal !']);
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
             $id = $params['id'] ?? null;
 
             if (is_null($id)) {
                 return response()->json([
                     'status' => 'error',
                     'message' => 'Missing required parameters'
                 ], 400);
             }
             // Temukan record berdasarkan non_taxable_income_id
             $nti = NonTaxableIncome::where('non_taxable_income_id', $id);

             if ($nti) {
                // Hapus record yang ditemukan
                $nti->delete();
                DB::commit();
                return response()->json(['message' => 'Data telah dihapus','refresh' =>'/nti' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/nti', 'icon' => 'error', 'success' => 'Gagal !']);
        }
      
    }
}
