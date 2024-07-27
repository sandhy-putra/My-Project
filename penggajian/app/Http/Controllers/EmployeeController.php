<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\NonTaxableIncome;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{

   
    function index(){
        return view('employee/main',[
            "title" => "Master Data Karyawan",
            "tableid" => "employeetable",
            "employees" => Employee::All()
        ]);
    }

    function getNonTaxableIncomes(){
        return view('employee/listptkp',[
            "title" => "Status PTKP",
            "tableid" => "ptkplist",
            "ptkp" => NonTaxableIncome::All()
        ]);
    }

    function getEmployee(Request $request){
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

        return view('employee/setemployee', [
            "title" => "Edit Data",
            "tableid" => "setemployee",
            "employees" => Employee::where('employee_id', $id)->firstOrFail()// Jika perlu mengembalikan data lainnya
        ]);

    }

    function storeEmployee(Request $request){
        // Memulai transaksi
        DB::beginTransaction();

        try {
            $joindate = $request->input("joindate");
            $employeeid = Employee::generateEmployeeCode($joindate);
            $employeename = $request->input("employeename");
            $birthdate = $request->input("birthdate");
            $idcardnumber = $request->input("idcardnumber");
            $taxid = $request->input("taxid");
            $nontaxableincomeid = $request->input("nontaxableincomeid");
            $basicsalary = str_replace(',','',$request->input("basicsalary"));
            $bpjshealth = str_replace(',','',$request->input("healthbpjs"));
            $bpjsemployment = str_replace(',','',$request->input("employmentbpjs"));
            
            Employee::create([
                'employee_id'=> $employeeid,
                'name' => $employeename,
                'birthdate' => $birthdate,
                'join_date' =>$joindate,
                'id_card_number' => $idcardnumber,
                'tax_identification_number' => $taxid,
                'non_taxable_income_id' =>$nontaxableincomeid,
                'basic_salary' => $basicsalary,
                'bpjs_health' => $bpjshealth,
                'bpjs_employment' => $bpjsemployment
                // tambahkan kolom lainnya sesuai kebutuhan
            ]);
            // Commit transaksi jika semua data berhasil disimpan
            DB::commit(); 
            return response()->json(['message' => 'Data telah disimpan','refresh' =>'/employee' ,'icon' => 'success','succes' => 'Berhasil !']);
 
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/employee', 'icon' => 'error', 'success' => 'Gagal !']);
        }


    }

    function destroy(Request $request){
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
            $Employee = Employee::where('employee_id', $id);

            if ($Employee) {
                // Hapus record yang ditemukan
                $Employee->delete();
                DB::commit();
                return response()->json(['message' => 'Data telah dihapus','refresh' =>'/employee' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/employee', 'icon' => 'error', 'success' => 'Gagal !']);
        }
    }

    function resign(Request $request){
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
            //$employee = Employee::where('employee_id', $id);
            $employee = Employee::where('employee_id', $id)->first();

            if ($employee) {
                // Hapus record yang ditemukan
                $employee->is_employee_resign=1;
                $employee->save();
                DB::commit();
                return response()->json(['message' => 'Data telah non aktif','refresh' =>'/employee' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/employee', 'icon' => 'error', 'success' => 'Gagal !']);
        }
    }

    function updateEmployee(Request $request){

        // Memulai transaksi
        DB::beginTransaction();

        try {

            $id = $request->input("employeeid");

            if (is_null($id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Missing required parameters'
                ], 400);
            }
            // Temukan record berdasarkan non_taxable_income_id
            //$employee = Employee::where('employee_id', $id);
            $employee = Employee::where('employee_id', $id)->first();

            if ($employee) {
                // Hapus record yang ditemukan
                $employee->birthdate=$request->input("birthdate");
                $employee->join_date=$request->input("joindate");
                $employee->non_taxable_income_id=$request->input("nontaxableincomeid");
                $employee->basic_salary=str_replace(',','',$request->input("basicsalary"));
                $employee->bpjs_health=str_replace(',','',$request->input("healthbpjs"));
                $employee->bpjs_employment=str_replace(',','',$request->input("employmentbpjs"));
                $employee->save();
                
                // Commit transaksi jika semua data berhasil disimpan
                DB::commit();
                return response()->json(['message' => 'Data telah diperbarui','refresh' =>'/employee' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                // Rollback transaksi jika terjadi kesalahan
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/employee', 'icon' => 'error', 'success' => 'Gagal !']);
        }
            
    }

}
