<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaxCategoryController extends Controller
{
    function index()
    {
        return view('taxcategory/main',[
            "title" => "Master Tarif Kategori TER",
            "tableid" => "taxcategory",
            "taxcategories" => TaxCategory::All()
        ]);
    }

    function storeTaxCategory(Request $request){
        // Memulai transaksi
        DB::beginTransaction();

        try {

            TaxCategory::create([
                'tax_category_id' => TaxCategory::generateTaxCategoryCode($request->tercategory),
                'min_gross_income' => str_replace(',','',$request->mingrossincome),
                'max_gross_income' => str_replace(',','',$request->maxgrossincome),
                'effective_average_tax_rate_category' => $request->tercategory,
                'tax_rate' => $request->taxrate               
                // tambahkan kolom lainnya sesuai kebutuhan
            ]);
            DB::commit();
            return response()->json(['message' => 'Data telah disimpan','refresh' =>'/tc' ,'icon' => 'success','succes' => 'Berhasil !']);
 
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/tc', 'icon' => 'error', 'success' => 'Gagal !']);
        }
  
      }

      function getTc(Request $request){
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

        return view('taxcategory/settc', [
            "title" => "Edit Data",
            "tableid" => "settc",
            "tcc" => TaxCategory::where('tax_category_id', $id)->firstOrFail()// Jika perlu mengembalikan data lainnya
        ]);

    }

    function updateTc(Request $request){

        // Memulai transaksi
        DB::beginTransaction();

        try {

            $id = $request->input("taxcategoryid");

            if (is_null($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Missing required parameters'
                ], 400);
            }
            // Temukan record berdasarkan non_taxable_income_id
            $tc = TaxCategory::where('tax_category_id', $id)->first();

            if ($tc) {
                // Hapus record yang ditemukan
                $tc->min_gross_income=str_replace(',','',$request->input("mingrossincome"));
                $tc->max_gross_income=str_replace(',','',$request->input("maxgrossincome"));
                $tc->tax_rate=$request->input("taxrate");
                $tc->save();
                
                // Commit transaksi jika semua data berhasil disimpan
                DB::commit();
                return response()->json(['message' => 'Data telah diperbarui','refresh' =>'/tc' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                // Rollback transaksi jika terjadi kesalahan
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/tc', 'icon' => 'error', 'success' => 'Gagal !']);
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
             $tc = TaxCategory::where('tax_category_id', $id);

             if ($tc) {
                // Hapus record yang ditemukan
                $tc->delete();
                DB::commit();
                return response()->json(['message' => 'Data telah dihapus','refresh' =>'/tc' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/tc', 'icon' => 'error', 'success' => 'Gagal !']);
        }
      
    }
}
