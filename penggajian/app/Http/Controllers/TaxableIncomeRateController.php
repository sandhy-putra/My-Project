<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxableIncomeRate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaxableIncomeRateController extends Controller
{
    function index()
    {
        return view('taxableincomerate/main',[
            "title" => "Master Penghasilan Kena Pajak",
            "tableid" => "taxableincomeratetable",
            "taxableincomerate" => TaxableIncomeRate::All()
        ]);
    }

    function getTir(Request $request){
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

        return view('taxableincomerate/settir', [
            "title" => "Edit Data",
            "tableid" => "settir",
            "tirr" => TaxableIncomeRate::where('id', $id)->firstOrFail()// Jika perlu mengembalikan data lainnya
        ]);

    }

    function storeTaxableIncomeRate(Request $request)
    {
        // Memulai transaksi
        DB::beginTransaction();

        try {

            TaxableIncomeRate::create([
                'min_taxable_income' => str_replace(',','',$request->mintaxableincome),
                'max_taxable_income' => str_replace(',','',$request->maxtaxableincome),
                'taxable_income_rate' => $request->taxableincomerate,
                // tambahkan kolom lainnya sesuai kebutuhan
            ]);
            DB::commit();
            return response()->json(['message' => 'Data telah disimpan','refresh' =>'/tir' ,'icon' => 'success','succes' => 'Berhasil !']);
 
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/tir', 'icon' => 'error', 'success' => 'Gagal !']);
        }
  
      }

      function updateTir(Request $request){

        // Memulai transaksi
        DB::beginTransaction();

        try {

            $id = $request->input("id");

            if (is_null($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Missing required parameters'
                ], 400);
            }
            // Temukan record berdasarkan non_taxable_income_id
            $tir = TaxableIncomeRate::where('id', $id)->first();

            if ($tir) {
                // Hapus record yang ditemukan
                $tir->min_taxable_income=str_replace(',','',$request->input("mintaxableincome"));
                $tir->max_taxable_income=str_replace(',','',$request->input("maxtaxableincome"));
                $tir->taxable_income_rate=$request->input("taxableincomerate");
                $tir->save();
                
                // Commit transaksi jika semua data berhasil disimpan
                DB::commit();
                return response()->json(['message' => 'Data telah diperbarui','refresh' =>'/tir' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                // Rollback transaksi jika terjadi kesalahan
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/tir', 'icon' => 'error', 'success' => 'Gagal !']);
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
             $tir = TaxableIncomeRate::where('id', $id);

             if ($tir) {
                // Hapus record yang ditemukan
                $tir->delete();
                DB::commit();
                return response()->json(['message' => 'Data telah dihapus','refresh' =>'/tir' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/tir', 'icon' => 'error', 'success' => 'Gagal !']);
        }
      
    }
}
