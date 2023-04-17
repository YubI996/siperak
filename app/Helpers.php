<?php
    use App\Models\Recipient as P;
    use App\Models\Pokmas as Po;
    use App\Models\Log as l;
    use Carbon\Carbon;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    use Illuminate\Support\Facades\DB;

    function logit($ket){
        $logger = l::create([
                'action' => $ket,
                'actor' => Auth::id()
                ]);
    }
    function random_slug(int $length = 15,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    // status penerimaan bantuan terbaru berdasarkan slug
    function get_status_trima($slug):String
    {
        return P::where("slug", $slug)->first()->Histories()->latest()->first()->status_trima;
    }

    // jumlah penerima bantuan aktif
    function count_active_recipient():int
    {
        return P::where('status_trima', 'Menerima')->count();
    }

    function get_penyakit_count() {
    $penyakit_count = P::where('status_trima', 'Menerima')
                                    ->selectRaw('penyakit, count(*) as count')
                                    ->groupBy('penyakit')
                                    ->get()
                                    ->pluck('count', 'penyakit')
                                    ->toArray();
    return $penyakit_count;
    }

    function getMonthlyCounts($status_trima){
        // Get the oldest and newest history records
        $oldestHistory = DB::table('histories')
            ->orderBy('created_at', 'asc')
            ->first();
        $newestHistory = DB::table('histories')
            ->orderBy('created_at', 'desc')
            ->first();

        // Determine the starting and ending months for the count
        $startingMonth = new DateTime($oldestHistory->created_at);
        $endingMonth = new DateTime($newestHistory->created_at);
        $currentMonth = new DateTime();

            // Initialize an empty array to store the monthly counts
            $monthlyCounts = [];

            while ($startingMonth <= $endingMonth && $startingMonth <= $currentMonth) {
                // Format the month as a string
                $monthName = $startingMonth->format('F Y');

                // Count the number of 'Menerima' statuses for the given month
                $count = DB::table('histories')
                    ->where('status_trima', $status_trima)
                    ->whereMonth('created_at', '=', $startingMonth->format('m'))
                    ->count();

                // If there is no data for a month, use the count from the previous month
                if ($count == 0 && count($monthlyCounts) > 0) {
                    $lastMonthName = array_key_last($monthlyCounts);
                    $count = $monthlyCounts[$lastMonthName];
                }

                // Add the count to the array
                $monthlyCounts[$monthName] = $count;

                // Move to the next month
                $startingMonth->modify('+1 month');

                // If there is no data for a month, use the count from the previous month
                if ($count == 0 && count($monthlyCounts) > 1) {
                    end($monthlyCounts);
                    $lastMonthCount = current($monthlyCounts);
                    $monthlyCounts[$monthName] = $lastMonthCount;
                }
            }

            return $monthlyCounts;
        }

        function getStatusRumahCounts() {
            $counts = DB::table('recipients')
                        ->select('status_rumah', DB::raw('count(*) as count'))
                        ->where('status_trima', 'Menerima')
                        ->groupBy('status_rumah')
                        ->get();

            $data = [];
            foreach ($counts as $count) {
                // $data["asa"] = $count->count;
                $data[$count->status_rumah] = $count->count;
            }
            return $data;
        }


    // Jumlah penerima Laki-laki
    function count_laki()
    {
        return P::where('status_trima', 'Menerima')->where('jenkel', 'Laki-laki')->count();
    }

    // Jumlah penerima Perempuan
    function count_bini():int
    {
        return P::where('status_trima', 'Menerima')->where('jenkel', 'Perempuan')->count();
    }

    // rata-rata umur PENERIMA
    function avg_age(){
        $rs = P::where('status_trima', 'Menerima')->get();
        if($rs->count()<1)
        {
            return 0;
        }
        $avgAge = $rs->avg(function ($r) {
            return $r->getAge();
        });

        return round($avgAge);
    }

    function get_pokmas():int
    {
        return Po::count();
    }

    function count_kel():int
    {
        return P::where('status_trima', 'Menerima')->get()->groupBy('Rts.Kelurahan')->count();
    }

    function QrIt($data)
    {
        return QrCode::size(300)->errorCorrection('H')->generate(url('/penerima/qr/'+$data));
    }
?>
