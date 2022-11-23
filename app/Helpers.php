<?php
    use App\Models\Recipient as P;
    use App\Models\Pokmas as Po;
    use Carbon\Carbon;




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
        return P::whereHas('getPenerima')->count();
    }

    // Jumlah penerima Laki-laki
    function count_laki():int
    {
        // return P::all()->groupBy('jenkel')->map->count()->toArray();
        return P::where('jenkel', 'Laki-laki')->count();
    }

    // Jumlah penerima Perempuan
    function count_bini():int
    {
        return P::where('jenkel', 'Perempuan')->count();
    }

    // rata-rata umur PENERIMA
    function avg_age(){
        $rs = P::whereHas('getPenerima')->get();
        return $rs->avg(function ($r) {
            return $r->getAge();
        });
    }

    function get_pokmas():int
    {
        return Po::count();
    }
?>
