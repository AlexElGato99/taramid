<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Spatie\Analytics\OrderBy;
use Google\Analytics\Data\V1beta\Metric as RealtimeMetric;

class IndexController extends Controller
{

    public function index()
    {
        $config = [
            'title' => __('Dashboard'),
            'heading' => __('Dashboard'),
            'nav' => 'dashboard',
        ];

        $data = [];

        $credentialsPath = config('analytics.service_account_credentials_json');
        if ($credentialsPath && file_exists($credentialsPath) && config('analytics.property_id')) {

            $data['liveVisitors'] = Cache::remember('analytic-liveVisitors', now()->addMinutes(1), function () {
                try {
                    $client = app(\Spatie\Analytics\AnalyticsClient::class)->getAnalyticsService();
                    $propertyId = config('analytics.property_id');
                    $response = $client->runRealtimeReport([
                        'property' => "properties/{$propertyId}",
                        'metrics' => [new RealtimeMetric(['name' => 'activeUsers'])],
                    ]);
                    $total = 0;
                    foreach ($response->getRows() as $row) {
                        foreach ($row->getMetricValues() as $value) {
                            $total += (int) $value->getValue();
                        }
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['todayVisitors'] = Cache::remember('analytic-todayVisitors', now()->addHours(1), function () {
                try {
                    $today = Analytics::get(
                        period: Period::create(now()->startOfDay(), now()),
                        metrics: ['activeUsers'],
                    );
                    $total = 0;
                    foreach ($today as $visitor) {
                        $total += $visitor['activeUsers'];
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['last7Days'] = Cache::remember('analytic-last7Days', now()->addHours(6), function () {
                try {
                    $week = Analytics::get(
                        period: Period::days(7),
                        metrics: ['activeUsers'],
                    );
                    $total = 0;
                    foreach ($week as $visitor) {
                        $total += $visitor['activeUsers'];
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['yearToDate'] = Cache::remember('analytic-yearToDate', now()->addHours(24), function () {
                try {
                    $ytd = Analytics::get(
                        period: Period::create(now()->startOfYear(), now()),
                        metrics: ['activeUsers'],
                    );
                    $total = 0;
                    foreach ($ytd as $visitor) {
                        $total += $visitor['activeUsers'];
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['lastYear'] = Cache::remember('analytic-lastYear', now()->addDays(7), function () {
                try {
                    $lastYear = Analytics::get(
                        period: Period::create(now()->subYear()->startOfYear(), now()->subYear()->endOfYear()),
                        metrics: ['activeUsers'],
                    );
                    $total = 0;
                    foreach ($lastYear as $visitor) {
                        $total += $visitor['activeUsers'];
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['lifetimeVisitors'] = Cache::remember('analytic-lifetimeVisitors', now()->addDays(7), function () {
                try {
                    $lifetime = Analytics::get(
                        period: Period::create(now()->subYears(5), now()),
                        metrics: ['totalUsers'],
                    );
                    $total = 0;
                    foreach ($lifetime as $visitor) {
                        $total += $visitor['totalUsers'];
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['last30Days'] = Cache::remember('analytic-last30Days', now()->addHours(12), function () {
                try {
                    $month = Analytics::get(
                        period: Period::days(30),
                        metrics: ['activeUsers'],
                    );
                    $total = 0;
                    foreach ($month as $visitor) {
                        $total += $visitor['activeUsers'];
                    }
                    return $total;
                } catch (\Exception $e) {
                    return 0;
                }
            });

            $data['sessions'] = Cache::remember('analytic-sessions', now()->addHours(12), function () {
                $sessions = Analytics::get(
                    period: Period::months(1),
                    metrics: ['activeUsers'],
                );
                $total = null;
                foreach ($sessions as $session) {
                    $total = $total+$session['activeUsers'];
                }
                return $total;
            });
            $data['pageViews'] = Cache::remember('analytic-pageViews', now()->addHours(12), function () {
                $sessions = Analytics::get(
                    period: Period::months(1),
                    metrics: ['screenPageViews'],
                );
                $total = null;
                foreach ($sessions as $session) {
                    $total = $total+$session['screenPageViews'];
                }
                return $total;
            });
            $data['bounceRate'] = Cache::remember('analytic-bounceRate', now()->addHours(12), function () {
                $sessions = Analytics::get(
                    period: Period::months(1),
                    metrics: ['bounceRate'],
                );
                $total = null;
                foreach ($sessions as $session) {
                    $total = $total+$session['bounceRate'];
                }
                return $total;
            });
            $data['newSessions'] = Cache::remember('analytic-newSessions', now()->addHours(12), function () {
                $newsessions = Analytics::get(
                    period: Period::months(1),
                    metrics: ['newUsers'],
                );
                $total = null;
                foreach ($newsessions as $session) {
                    $total = $total+$session['newUsers'];
                }
                return $total;
            });
            $data['popular'] = Cache::remember('analytic-popular', now()->addHours(12), function () {
                return Analytics::fetchMostVisitedPages(Period::months(1), 10);
            });
            $data['countries'] = Cache::remember('analytic-countries', now()->addHours(12), function () {
                try {
                    $orderBy = [
                        OrderBy::metric('activeUsers', true),
                    ];
                    $results = Analytics::get(
                        Period::days(30),
                        ['activeUsers'],
                        ['country'],
                        10,
                        $orderBy
                    );

                    $countryCodeMap = [
                        'united states' => 'us', 'united kingdom' => 'gb', 'canada' => 'ca', 'germany' => 'de',
                        'france' => 'fr', 'spain' => 'es', 'italy' => 'it', 'netherlands' => 'nl',
                        'australia' => 'au', 'brazil' => 'br', 'india' => 'in', 'japan' => 'jp',
                        'mexico' => 'mx', 'sweden' => 'se', 'norway' => 'no', 'denmark' => 'dk',
                        'finland' => 'fi', 'belgium' => 'be', 'switzerland' => 'ch', 'austria' => 'at',
                        'portugal' => 'pt', 'ireland' => 'ie', 'poland' => 'pl', 'turkey' => 'tr',
                        'türkiye' => 'tr', 'south korea' => 'kr', 'korea' => 'kr',
                        'china' => 'cn', 'russia' => 'ru', 'south africa' => 'za',
                        'argentina' => 'ar', 'colombia' => 'co', 'chile' => 'cl', 'peru' => 'pe',
                        'egypt' => 'eg', 'saudi arabia' => 'sa', 'united arab emirates' => 'ae',
                        'israel' => 'il', 'nigeria' => 'ng', 'kenya' => 'ke', 'morocco' => 'ma',
                        'indonesia' => 'id', 'thailand' => 'th', 'vietnam' => 'vn', 'philippines' => 'ph',
                        'malaysia' => 'my', 'singapore' => 'sg', 'new zealand' => 'nz', 'pakistan' => 'pk',
                        'bangladesh' => 'bd', 'ukraine' => 'ua', 'romania' => 'ro',
                        'czech republic' => 'cz', 'czechia' => 'cz',
                        'greece' => 'gr', 'hungary' => 'hu', 'croatia' => 'hr', 'bulgaria' => 'bg',
                        'slovakia' => 'sk', 'slovenia' => 'si', 'lithuania' => 'lt', 'latvia' => 'lv',
                        'estonia' => 'ee', 'serbia' => 'rs', 'algeria' => 'dz', 'tunisia' => 'tn',
                        'iraq' => 'iq', 'jordan' => 'jo', 'lebanon' => 'lb', 'kuwait' => 'kw',
                        'qatar' => 'qa', 'bahrain' => 'bh', 'oman' => 'om', 'libya' => 'ly',
                        'iran' => 'ir', 'afghanistan' => 'af', 'nepal' => 'np', 'sri lanka' => 'lk',
                        'myanmar' => 'mm', 'myanmar (burma)' => 'mm', 'cambodia' => 'kh', 'laos' => 'la',
                        'mongolia' => 'mn', 'taiwan' => 'tw', 'hong kong' => 'hk', 'macau' => 'mo',
                        'north korea' => 'kp', 'uzbekistan' => 'uz', 'kazakhstan' => 'kz',
                        'georgia' => 'ge', 'armenia' => 'am', 'azerbaijan' => 'az',
                        'cyprus' => 'cy', 'malta' => 'mt', 'luxembourg' => 'lu', 'iceland' => 'is',
                        'albania' => 'al', 'north macedonia' => 'mk', 'montenegro' => 'me',
                        'bosnia and herzegovina' => 'ba', 'bosnia & herzegovina' => 'ba',
                        'moldova' => 'md', 'belarus' => 'by',
                        'costa rica' => 'cr', 'panama' => 'pa', 'ecuador' => 'ec',
                        'venezuela' => 've', 'uruguay' => 'uy', 'paraguay' => 'py', 'bolivia' => 'bo',
                        'dominican republic' => 'do', 'guatemala' => 'gt', 'honduras' => 'hn',
                        'el salvador' => 'sv', 'cuba' => 'cu', 'jamaica' => 'jm', 'haiti' => 'ht',
                        'trinidad and tobago' => 'tt', 'trinidad & tobago' => 'tt',
                        'puerto rico' => 'pr', 'nicaragua' => 'ni',
                        'ghana' => 'gh', 'cameroon' => 'cm', 'ivory coast' => 'ci',
                        "côte d'ivoire" => 'ci', 'senegal' => 'sn', 'ethiopia' => 'et',
                        'tanzania' => 'tz', 'uganda' => 'ug', 'mozambique' => 'mz',
                        'zimbabwe' => 'zw', 'angola' => 'ao', 'sudan' => 'sd',
                        'democratic republic of the congo' => 'cd', 'congo - kinshasa' => 'cd',
                        'republic of the congo' => 'cg', 'congo - brazzaville' => 'cg',
                        'rwanda' => 'rw', 'zambia' => 'zm', 'botswana' => 'bw',
                        'namibia' => 'na', 'madagascar' => 'mg', 'mali' => 'ml',
                        'burkina faso' => 'bf', 'niger' => 'ne', 'chad' => 'td',
                        'somalia' => 'so', 'libya' => 'ly', 'mauritius' => 'mu',
                        'palestine' => 'ps', 'palestinian territories' => 'ps',
                        'syria' => 'sy', 'yemen' => 'ye',
                    ];

                    return $results->map(function ($item) use ($countryCodeMap) {
                        $name = $item['country'] ?? 'Unknown';
                        $code = $countryCodeMap[strtolower(trim($name))] ?? null;
                        $item['countryCode'] = $code;
                        return $item;
                    });
                } catch (\Exception $e) {
                    return collect();
                }
            });
            $data['visitor'] = Cache::remember('analytic-visitors', 60 * 24, function () {
                $orderBy = [
                    OrderBy::dimension('date', false),
                    OrderBy::metric('activeUsers', false),
                ];
                return Analytics::get(
                    Period::days(15),
                    ['activeUsers'],
                    ['date'],
                    30,
                    $orderBy
                );

            });
        } else {
            $data['liveVisitors'] = 0;
            $data['todayVisitors'] = 0;
            $data['last7Days'] = 0;
            $data['yearToDate'] = 0;
            $data['lastYear'] = 0;
            $data['lifetimeVisitors'] = 0;
            $data['last30Days'] = 0;
            $data['sessions'] = 0;
            $data['pageViews'] = 0;
            $data['bounceRate'] = 0;
            $data['newSessions'] = 0;
            $data['popular'] = [];
            $data['countries'] = [];
            $data['visitor'] = [];
            $data['visitors'] = [];
            $data['date'] = [];
        }


        $data['date'] = [];
        $data['visitors'] = [];

        if (!empty($data['visitor']) && is_iterable($data['visitor'])) {
            foreach ($data['visitor'] as $visitor) {
                $data['date'][] = date('d M', strtotime($visitor['date'] ?? 'now'));
            }
            foreach ($data['visitor'] as $visitor) {
                $data['visitors'][] = $visitor['activeUsers'] ?? 0;
            }
        }

        $data['user'] = User::count();

        return view('admin.home.index', compact('config', 'data'));
    }

    public function liveVisitors()
    {
        $credentialsPath = config('analytics.service_account_credentials_json');
        if (!$credentialsPath || !file_exists($credentialsPath) || !config('analytics.property_id')) {
            return response()->json(['count' => 0]);
        }

        $count = Cache::remember('analytic-liveVisitors', now()->addMinutes(1), function () {
            try {
                $client = app(\Spatie\Analytics\AnalyticsClient::class)->getAnalyticsService();
                $propertyId = config('analytics.property_id');
                $response = $client->runRealtimeReport([
                    'property' => "properties/{$propertyId}",
                    'metrics' => [new RealtimeMetric(['name' => 'activeUsers'])],
                ]);
                $total = 0;
                foreach ($response->getRows() as $row) {
                    foreach ($row->getMetricValues() as $value) {
                        $total += (int) $value->getValue();
                    }
                }
                return $total;
            } catch (\Exception $e) {
                return 0;
            }
        });

        return response()->json(['count' => $count]);
    }
}
