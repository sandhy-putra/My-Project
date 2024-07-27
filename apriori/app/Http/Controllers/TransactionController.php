<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\FrequentItemset;
use App\Models\AssociationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    function index(){
        return view('transaction/main',[
            "title" => "Transaction",
            "tableid" => "transactiontable",
            //"trans" => Transaction::All()
        ]);
    }

    function recapTransaction(){
        return view('transaction/recap',[
            "title" => "Transaction",
            "tableid" => "transactiontable",
            "transaction" => Transaction::select('period', DB::raw('count(*) as total'))
            ->groupBy('period')
            ->get()

        ]);
    }

    function analyzeTransaction(){
        return view('transaction/analyze',[
            "title" => "Analisis",
            "tableid" => "analisistable",
        ]);
    }

    function visualyzeApriori(){
        return view('transaction/visualyze',[
            "title" => "Visualisasi Data",
            "tableid" => "visualtable",
        ]);
    }

    function getApriori(Request $request){
        $period= $request->yperiod . $request->mperiod;
        return view('transaction/visualyzeapriori',[
            "title" => "Visualisasi Data",
            "tableid" => "visualtable",
            "fis" => FrequentItemset::where('period',$period)->get(),
            "arule" => AssociationRule::where('period',$period)->get()
        ]);
    }

    function storeTransaction(Request $request){
        // Memulai transaksi
        DB::beginTransaction();

        $jml=$request->input("jml");

        try {

            for($i=1;$i<=$jml;$i++){

                Transaction::create([
                    'transaction_id' => $request->input("transaction_".$i."_item_0"),
                    'period' => $request->input("transaction_".$i."_item_1"),
                    'item' =>str_replace('|',',',$request->input("transaction_".$i."_item_2")) ,
                    //'qty' => $request->input("transaction_".$i."_item_3"),
                    // tambahkan kolom lainnya sesuai kebutuhan
                ]);            
            }
        DB::commit();
        return response()->json(['message' => 'Data telah disimpan','refresh' =>'/transaction' ,'icon' => 'success','succes' => 'Berhasil !']);
 
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'/transaction', 'icon' => 'error', 'success' => 'Gagal !']);
        }
  
      }

      public function executeApriori(Request $request)
{
    $mperiod = $request->mperiod;
    $yperiod = $request->yperiod;
    $period = $yperiod . $mperiod;

    // Memulai transaksi
    DB::beginTransaction();

    try {
        $this->generateFrequentItemsets($period);
        $this->generateAssociationRules($period);

        DB::commit();
        return response()->json(['message' => 'Analisa Selesai\nData telah disimpan', 'refresh' => '/transaction_analyze', 'icon' => 'success', 'success' => 'Berhasil!']);

    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        DB::rollBack();

        // Logging error
        Log::error('Error saving data: ' . $e->getMessage());
        return response()->json(['message' => 'Terjadi Kesalahan!', 'refresh' => '/transaction_analyze', 'icon' => 'error', 'success' => 'Gagal!']);
    }
}

public function generateFrequentItemsets($period)
{
    $minSupport = 2; // minimum support count   

    // Step 1: Generate candidate itemsets of size 1
    $candidateItemsets = Transaction::selectRaw('item')
        ->where('period', $period)
        ->get()
        ->flatMap(function ($transaction) {
            return explode(',', $transaction->item);
        })
        ->unique()
        ->toArray();

    // Step 2: Generate frequent itemsets
    $frequentItemsets = [];
    $currentCandidateItemsets = $candidateItemsets;

    while (!empty($currentCandidateItemsets)) {
        $newCandidateItemsets = [];

        foreach ($currentCandidateItemsets as $itemset) {
            $support = Transaction::whereRaw("FIND_IN_SET('$itemset', item) > 0")
                ->where('period', $period)
                ->count();

            if ($support >= $minSupport) {
                $frequentItemsets[] = [
                    'period' => $period,
                    'itemset' => $itemset,
                    'support_count' => $support,
                ];

                $newCandidateItemsets = array_merge($newCandidateItemsets, $this->generateNextCandidateItemsets($itemset));
            }
        }

        $currentCandidateItemsets = array_unique($newCandidateItemsets);
    }

    // Save frequent itemsets to database
    foreach ($frequentItemsets as $itemset) {
        FrequentItemset::create($itemset);
    }
}

public function generateAssociationRules($period)
{
    $minConfidence = 0.5; // minimum confidence

    // Step 1: Generate association rules
    $frequentItemsets = FrequentItemset::where('period', $period)->get();

    foreach ($frequentItemsets as $itemset1) {
        $antecedentItems = explode(',', $itemset1->itemset);

        foreach ($frequentItemsets as $itemset2) {
            if ($itemset1->id != $itemset2->id) {
                $consequentItems = explode(',', $itemset2->itemset);

                // Check if antecedent and consequent overlap
                if (count(array_intersect($antecedentItems, $consequentItems)) == 0) {
                    $combinedItems = array_unique(array_merge($antecedentItems, $consequentItems));
                    $combinedItemsStr = implode(',', $combinedItems);

                    // Calculate support for antecedent union consequent
                    $support = Transaction::where(function ($query) use ($combinedItems) {
                        foreach ($combinedItems as $item) {
                            $query->whereRaw("FIND_IN_SET('$item', item) > 0");
                        }
                    })
                    ->where('period', $period)
                    ->count();

                    $confidence = $support / $itemset1->support_count;

                    if ($confidence >= $minConfidence) {
                        $associationRule = new AssociationRule();
                        $associationRule->antecedent = implode(',', $antecedentItems);
                        $associationRule->consequent = implode(',', $consequentItems);
                        $associationRule->confidence = $confidence;
                        $associationRule->period = $period;
                        $associationRule->save();
                    }
                }
            }
        }
    }

    return 'Association rules generated and saved successfully!';
}

private function generateNextCandidateItemsets($itemset)
{
    $items = explode(',', $itemset);
    $nextCandidateItemsets = [];

    for ($i = 0; $i < count($items); $i++) {
        for ($j = $i + 1; $j < count($items); $j++) {
            $nextItemset = implode(',', array_unique(array_merge(array_slice($items, 0, $i), [$items[$j]], array_slice($items, $i + 1))));
            if (!in_array($nextItemset, $nextCandidateItemsets)) {
                $nextCandidateItemsets[] = $nextItemset;
            }
        }
    }

    return $nextCandidateItemsets;
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
             $period = $params['period'] ?? null;
           
             if (is_null($period)) {
                 return response()->json([
                     'status' => 'error',
                     'message' => 'Missing required parameters'
                 ], 400);
             }
             // Temukan record berdasarkan non_taxable_income_id
             $fis = FrequentItemset::where('period', $period);
             $arule = AssociationRule::where('period', $period);
             $tc = Transaction::where('period', $period);

             if($fis){
                $fis->delete();
             }

             if($arule){
                $arule->delete();
             }

             if ($tc) {
                // Hapus record yang ditemukan
                $tc->delete();
                DB::commit();
                return response()->json(['message' => 'Data telah dihapus','refresh' =>'transaction_recap' ,'icon' => 'success','succes' => 'Berhasil !']);
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e){
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Logging error
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan!','refresh' =>'transaction_recap', 'icon' => 'error', 'success' => 'Gagal !']);
        }
      
    }


      
}
