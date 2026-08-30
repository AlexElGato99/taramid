@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="mb-4 grid grid-cols-2 lg:grid-cols-5 gap-3">
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-16 h-16 bg-green-500/5 dark:bg-green-500/10 rounded-bl-[3rem]"></div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{__('Live Now')}}</p>
                </div>
                <h3 id="live-visitor-count" class="text-2xl font-bold text-gray-900 dark:text-white">{{$data['liveVisitors'] ?? 0}}</h3>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{__('Active visitors')}}</p>
            </div>

            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">{{__('Today')}}</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{$data['todayVisitors'] ?? 0}}</h3>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{__('Visitors')}}</p>
            </div>

            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">{{__('7 Days')}}</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{$data['last7Days'] ?? 0}}</h3>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{__('Visitors')}}</p>
            </div>

            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">{{__('30 Days')}}</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{$data['last30Days'] ?? 0}}</h3>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{__('Visitors')}}</p>
            </div>

            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">{{__('Total Users')}}</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{$data['user']}}</h3>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{__('Registered')}}</p>
            </div>
        </div>

        @if(!empty($data['visitors']))
        <div class="mb-4 grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2 bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4 lg:p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{__('Visitor Traffic')}}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{__('Last 15 days')}}</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs">
                        <div class="flex items-center gap-3 px-3 py-1.5 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div>
                                <span class="text-gray-400 dark:text-gray-500">{{__('Page Views')}}</span>
                                <span class="ml-1.5 font-semibold text-gray-900 dark:text-white">{{ number_format($data['pageViews'] ?? 0) }}</span>
                            </div>
                            <div class="w-px h-4 bg-gray-200 dark:bg-gray-700"></div>
                            <div>
                                <span class="text-gray-400 dark:text-gray-500">{{__('Sessions')}}</span>
                                <span class="ml-1.5 font-semibold text-gray-900 dark:text-white">{{ number_format($data['sessions'] ?? 0) }}</span>
                            </div>
                            <div class="w-px h-4 bg-gray-200 dark:bg-gray-700"></div>
                            <div>
                                <span class="text-gray-400 dark:text-gray-500">{{__('Bounce')}}</span>
                                <span class="ml-1.5 font-semibold text-gray-900 dark:text-white">{{ floor(($data['bounceRate'] ?? 0) * 100) }}%</span>
                            </div>
                            <div class="w-px h-4 bg-gray-200 dark:bg-gray-700"></div>
                            <div>
                                <span class="text-gray-400 dark:text-gray-500">{{__('New')}}</span>
                                <span class="ml-1.5 font-semibold text-gray-900 dark:text-white">{{ number_format($data['newSessions'] ?? 0) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="home-chart"></div>

                <div class="grid grid-cols-4 gap-4 mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <div class="text-center">
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">{{__('Year to Date')}}</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($data['yearToDate'] ?? 0) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">{{__('Last Year')}}</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($data['lastYear'] ?? 0) }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">{{__('Lifetime')}}</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($data['lifetimeVisitors'] ?? 0) }}</p>
                    </div>
                </div>
            </div>

            @if(isset($data['popular']) && count($data['popular']) > 0)
            <div class="bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4 lg:p-5 flex flex-col">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-gray-100 dark:border-gray-800">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{__('Top Pages')}}</h3>
                    <span class="text-xs text-gray-400 dark:text-gray-500">{{__('Last 30 days')}}</span>
                </div>
                <div class="flex justify-between text-[11px] font-medium text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 px-1">
                    <span>{{__('Page')}}</span>
                    <span>{{__('Views')}}</span>
                </div>
                <div class="flex-1 overflow-y-auto space-y-1.5">
                    @php $max = $data['popular'][0]['screenPageViews']; @endphp
                    @foreach($data['popular'] as $page)
                    <div class="relative px-3 py-2 group">
                        <div class="absolute inset-0 bg-blue-50 dark:bg-blue-500/10 rounded-lg transition-all" style="width: {{ ($page['screenPageViews'] / $max) * 100 }}%;"></div>
                        <div class="relative flex items-center justify-between">
                            <a href="{{ 'https://' . $page['fullPageUrl'] }}" target="_blank" class="text-sm text-gray-700 dark:text-gray-300 truncate max-w-[80%] hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                {{ Str::limit($page['fullPageUrl'], 40) }}
                            </a>
                            <span class="text-xs font-semibold text-gray-900 dark:text-white ml-2">{{ number_format($page['screenPageViews']) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        @if(!empty($data['countries']) && count($data['countries']) > 0)
        <div class="mb-4 bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-4 lg:p-5">
            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{__('Visitors by Country')}}</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{__('Last 30 days')}}</p>
                </div>
                <span class="text-xs text-gray-400 dark:text-gray-500">{{__('Top 10 countries')}}</span>
            </div>
            @php
                $maxCountryVisitors = $data['countries']->first()['activeUsers'] ?? 1;
                $totalCountryVisitors = $data['countries']->sum('activeUsers');
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2">
                @foreach($data['countries'] as $country)
                @php
                    $countryName = $country['country'] ?? 'Unknown';
                    $visitors = $country['activeUsers'] ?? 0;
                    $percentage = $totalCountryVisitors > 0 ? round(($visitors / $totalCountryVisitors) * 100, 1) : 0;
                    $flagCode = $country['countryCode'] ?? null;
                @endphp
                @if($countryName === '(not set)' || $countryName === 'Unknown')
                    @continue
                @endif
                <div class="flex items-center gap-3 py-2">
                    <div class="flex-shrink-0 w-7 text-center">
                        @if($flagCode)
                            <img src="https://flagcdn.com/w40/{{ $flagCode }}.png" 
                                 srcset="https://flagcdn.com/w80/{{ $flagCode }}.png 2x"
                                 width="24" height="18" 
                                 alt="{{ $countryName }}" 
                                 class="inline-block rounded-sm shadow-sm"
                                 loading="lazy">
                        @else
                            <span class="inline-flex items-center justify-center w-6 h-[18px] bg-gray-100 dark:bg-gray-700 rounded-sm text-[9px] font-bold text-gray-400 dark:text-gray-500">{{ strtoupper(substr($countryName, 0, 2)) }}</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate">{{ $countryName }}</span>
                            <div class="flex items-center gap-2 ml-2 flex-shrink-0">
                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $percentage }}%</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white w-10 text-right">{{ number_format($visitors) }}</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-full h-1.5">
                            <div class="h-1.5 rounded-full transition-all" 
                                 style="width: {{ ($visitors / $maxCountryVisitors) * 100 }}%; background-color: {{ config('settings.color', '#8871FD') }};">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="hidden lg:block bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-gray-800 p-3">
            <div class="flex items-center justify-between gap-6 text-xs">
                @php
                    $serverChecks = [
                        ['label' => 'PHP', 'value' => phpversion(), 'ok' => true],
                        ['label' => 'allow_url_fopen', 'value' => ini_get('allow_url_fopen') ? 'Active' : 'Disabled', 'ok' => ini_get('allow_url_fopen')],
                        ['label' => 'GD', 'value' => extension_loaded('gd') ? 'Active' : 'Disabled', 'ok' => extension_loaded('gd')],
                        ['label' => 'cURL', 'value' => extension_loaded('curl') ? 'Active' : 'Disabled', 'ok' => extension_loaded('curl')],
                        ['label' => 'mbstring', 'value' => extension_loaded('mbstring') ? 'Active' : 'Disabled', 'ok' => extension_loaded('mbstring')],
                        ['label' => 'openssl', 'value' => extension_loaded('openssl') ? 'Active' : 'Disabled', 'ok' => extension_loaded('openssl')],
                        ['label' => 'JSON', 'value' => extension_loaded('json') ? 'Active' : 'Disabled', 'ok' => extension_loaded('json')],
                    ];
                @endphp
                @foreach($serverChecks as $check)
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full {{ $check['ok'] ? 'bg-green-500' : 'bg-red-500' }}"></div>
                    <span class="text-gray-400 dark:text-gray-500">{{ $check['label'] }}</span>
                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $check['value'] }}</span>
                </div>
                @if(!$loop->last)
                <div class="w-px h-4 bg-gray-200 dark:bg-gray-700"></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    @push('javascript')

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            var newUsersData = @json($data['visitors']);
            var labels = @json($data['date']);
            var isDark = document.documentElement.classList.contains('dark') || window.matchMedia('(prefers-color-scheme: dark)').matches;
            var themeColor = '{{config('settings.color', '#8871FD')}}';
        </script>
        <script>

            var options = {
                series: [{
                    name: '{{__('Visitors')}}',
                    data: newUsersData
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: 320,
                    toolbar: { show: false },
                    background: 'transparent'
                },
                theme: {
                    mode: isDark ? 'dark' : 'light'
                },
                legend: { show: false },
                dataLabels: { enabled: false },
                colors: [themeColor],
                fill: {
                    colors: [themeColor],
                    type: 'gradient',
                    gradient: {
                        type: 'vertical',
                        shadeIntensity: 0.1,
                        opacityFrom: 0.35,
                        opacityTo: 0.05,
                        stops: [0, 95, 100]
                    }
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 2.5,
                    colors: [themeColor]
                },
                xaxis: {
                    categories: labels,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    tickAmount: 6,
                    labels: {
                        rotate: 0,
                        rotateAlways: false,
                        show: true,
                        style: {
                            colors: isDark ? '#6b7280' : '#9ca3af',
                            fontSize: '11px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: { color: isDark ? '#374151' : '#e5e7eb', width: 1, dashArray: 4 }
                    },
                    tooltip: { enabled: false }
                },
                yaxis: {
                    tickAmount: 4,
                    labels: {
                        show: true,
                        style: {
                            colors: isDark ? '#6b7280' : '#9ca3af',
                            fontSize: '11px'
                        },
                        formatter: function(val) { return Math.round(val); }
                    }
                },
                states: {
                    normal: { filter: { type: 'none' } },
                    hover: { filter: { type: 'none' } },
                    active: { allowMultipleDataPointsSelection: false, filter: { type: 'none' } }
                },
                tooltip: {
                    style: { fontSize: '12px' },
                    y: { formatter: function (val) { return val + ' {{__('visitors')}}'; } },
                    theme: isDark ? 'dark' : 'light'
                },
                grid: {
                    borderColor: isDark ? '#1f2937' : '#f3f4f6',
                    strokeDashArray: 4,
                    yaxis: { lines: { show: true } },
                    xaxis: { lines: { show: false } },
                    padding: { left: 10, right: 10 }
                },
                markers: {
                    size: 0,
                    strokeColors: themeColor,
                    strokeWidth: 2,
                    hover: { size: 5 }
                }
            };

            var chart = new ApexCharts(document.querySelector("#home-chart"), options);
            chart.render();

        </script>
        <script>
            function refreshLiveVisitors() {
                fetch('{{ route("admin.live-visitors") }}', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    var el = document.getElementById('live-visitor-count');
                    if (el && data.count !== undefined) {
                        var oldVal = parseInt(el.textContent) || 0;
                        var newVal = parseInt(data.count) || 0;
                        if (oldVal !== newVal) {
                            el.textContent = newVal;
                            el.style.transition = 'color 0.3s';
                            el.style.color = newVal > oldVal ? '#16a34a' : '#ef4444';
                            setTimeout(function() { el.style.color = ''; }, 1500);
                        }
                    }
                })
                .catch(function() {});
            }
            setInterval(refreshLiveVisitors, 60000);
        </script>
    @endpush
@endsection
