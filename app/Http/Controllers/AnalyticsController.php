<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Analytics;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use AkkiIo\LaravelGoogleAnalytics\Facades\LaravelGoogleAnalytics;

use Spatie\Analytics\Period as SpatiePeriod;
use AkkiIo\LaravelGoogleAnalytics\Period as AkkiIoPeriod;

class AnalyticsController extends Controller
{
    public function index($periode = 1)
    {
        $analyticsData = Analytics::fetchVisitorsAndPageViews(SpatiePeriod::days($periode));

        $googleAnalyticsData = LaravelGoogleAnalytics::getTotalViewsByDate(AkkiIoPeriod::days($periode));

        // Data Dummy untuk mengetes
        // $googleAnalyticsData = [
        //     [
        //         'date' => '2023-08-19',
        //         'pageViews' => 319,
        //     ],
        //     [
        //         'date' => '2023-08-20',
        //         'pageViews' => 9,
        //     ],
        //     [
        //         'date' => '2023-08-21',
        //         'pageViews' => 15,
        //     ],
        //     [
        //         'date' => '2023-08-22',
        //         'pageViews' => 145,
        //     ],
        //     [
        //         'date' => '2023-08-23',
        //         'pageViews' => 160,
        //     ],
        //     [
        //         'date' => '2023-08-24',
        //         'pageViews' => 134,
        //     ],
        // ];

        $filteredAnalyticsData = collect($analyticsData)->where('pageTitle', 'Portal Investasi Berbasis Spasial')->toArray();

        foreach ($googleAnalyticsData as &$item) {
            if (!isset($item['screenPageViews']) || $item['screenPageViews'] === null || $item['screenPageViews'] == 0 || $item['screenPageViews'] == '') {
                $item['screenPageViews'] = 1;
            }
        }


        $googleAnalyticsDataArray = collect($googleAnalyticsData)->toArray();


        $mergedData = array_merge_recursive($filteredAnalyticsData, $googleAnalyticsDataArray);


        $data_associative = [];

        // Proses data dari $mergedData
        foreach ($mergedData as $item) {
            if (isset($item['date']) && (isset($item['screenPageViews']) || isset($item['pageViews']))) {
                $date = date('Y-m-d', strtotime($item['date']));
                $value = $item['screenPageViews'] ?? $item['pageViews'] ?? 0;
                // Jika tanggal sudah ada, tambahkan nilai; jika tidak, inisialisasi dengan nilai tersebut
                $data_associative[$date] = ($data_associative[$date] ?? 0) + $value;
            }
        }
        // Dapatkan tanggal saat ini menggunakan fungsi date() dan strtotime()
        $todayTimestamp = strtotime(date('Y-m-d'));

        // Tambahkan tanggal yang hilang dengan jumlah 1
        for ($i = 0; $i <= $periode; $i++) {
            $date = date('Y-m-d', $todayTimestamp - ($i * 86400)); // 86400 adalah jumlah detik dalam satu hari
            if (!isset($data_associative[$date])) {
                $data_associative[$date] = 1; // Inisialisasi dengan 1
            }
        }

        // Konversi associative array ke array biasa
        $data_tanggal = array_keys($data_associative);
        $data_jumlah = array_values($data_associative);

        // dd($data_tanggal, $data_jumlah);


        // Opsional: Urutkan berdasarkan tanggal
        array_multisort($data_tanggal, SORT_ASC, $data_jumlah);

        // dd($data_tanggal, $data_jumlah);

        $data = [
            'tanggal' => $data_tanggal,
            'jumlah' => $data_jumlah,
        ];

        // dd($data);

        return $data;
    }





    public function auth_log($periode = 1)
    {
        // dd($periode);

        // 8
        // $authLogData = DB::connection('pgsql')->select("SELECT count(*), DATE(time) as date FROM admin.tbl_loging_auth WHERE time BETWEEN NOW() - INTERVAL '$periode days' AND NOW() GROUP BY DATE(time) ORDER BY DATE(time)");

        // 7
        $authLogData = DB::connection('pgsql')->select("SELECT count(*), DATE(time) as date FROM admin.tbl_loging_auth WHERE time BETWEEN DATE(NOW()) - INTERVAL '$periode days' AND NOW() GROUP BY DATE(time) ORDER BY DATE(time)");


        // dd($authLogData);

        $data_tanggal = [];
        $data_jumlah = [];
        $data = [];
        foreach ($authLogData as $a) {
            array_push($data_tanggal, $a->date);
            array_push($data_jumlah, $a->count);
        }
        array_push($data, $data_tanggal);
        array_push($data, $data_jumlah);


        // dd($data);

        return $data;
    }
}
