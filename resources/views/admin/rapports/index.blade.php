@extends('layouts.admin-sidebar')

@section('title', 'Rapports - ZEEEMAX')
@section('page-title', 'Rapports & Statistiques')
@section('page-description', 'Analysez les performances de votre site')

@section('content')
<div class="space-y-6">
    <!-- Filtre par période -->
    <div class="glass dark:glass-dark rounded-2xl p-6">
        <form method="GET" action="{{ route('admin.rapports.index') }}" class="flex items-center gap-4">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Période:</label>
            <select name="period" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                <option value="7" {{ $period == 7 ? 'selected' : '' }}>7 derniers jours</option>
                <option value="30" {{ $period == 30 ? 'selected' : '' }}>30 derniers jours</option>
                <option value="60" {{ $period == 60 ? 'selected' : '' }}>60 derniers jours</option>
                <option value="90" {{ $period == 90 ? 'selected' : '' }}>90 derniers jours</option>
            </select>
        </form>
    </div>

    <!-- Statistiques principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total visites -->
        <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Visites</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_visites']) }}</p>
                    @if($evolution != 0)
                    <p class="text-sm {{ $evolution > 0 ? 'text-green-600' : 'text-red-600' }} dark:{{ $evolution > 0 ? 'text-green-400' : 'text-red-400' }} flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $evolution > 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}"></path>
                        </svg>
                        {{ number_format(abs($evolution), 1) }}% {{ $evolution > 0 ? 'hausse' : 'baisse' }}
                    </p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Visiteurs uniques -->
        <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Visiteurs Uniques</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['visiteurs_uniques']) }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pages vues -->
        <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pages Vues</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['pages_vues']) }}</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Temps moyen de réponse -->
        <div class="glass dark:glass-dark rounded-2xl p-6 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Temps Réponse</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['temps_moyen'] ?? 0, 0) }}ms</p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-green-700 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique visites par jour -->
    <div class="glass dark:glass-dark rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Visites par Jour (30 derniers jours)</h3>
        <div class="h-64 flex items-end justify-between gap-1">
            @php
                $maxVisites = $visites_par_jour->max() ?? 1;
            @endphp
            @for($i = 29; $i >= 0; $i--)
                @php
                    $date = now()->subDays($i)->format('Y-m-d');
                    $count = $visites_par_jour[$date] ?? 0;
                    $height = $maxVisites > 0 ? ($count / $maxVisites * 100) : 0;
                @endphp
                <div class="flex-1 flex flex-col items-center group relative">
                    <div class="w-full bg-gradient-to-t from-blue-600 to-blue-400 rounded-t hover:from-blue-700 hover:to-blue-500 transition-all cursor-pointer" 
                         style="height: {{ max($height, 2) }}%" 
                         title="{{ $date }}: {{ $count }} visites">
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 transform -rotate-45 origin-left whitespace-nowrap hidden md:block">{{ \Carbon\Carbon::parse($date)->format('d/m') }}</span>
                    <div class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap z-10">
                        {{ $date }}<br>{{ $count }} visites
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Deux colonnes: Pages populaires et Répartition -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pages les plus visitées -->
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pages les Plus Visitées</h3>
            <div class="space-y-3">
                @forelse($pages_plus_visitees as $page)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate" title="{{ $page->url }}">
                                {{ Str::limit($page->url, 50) }}
                            </p>
                        </div>
                        <span class="ml-4 px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-semibold">
                            {{ $page->count }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">Aucune visite enregistrée</p>
                @endforelse
            </div>
        </div>

        <!-- Routes les plus visitées -->
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Routes les Plus Visitées</h3>
            <div class="space-y-3">
                @forelse($routes_plus_visitees as $route)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate" title="{{ $route->route_name }}">
                                {{ $route->route_name ?? 'N/A' }}
                            </p>
                        </div>
                        <span class="ml-4 px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-semibold">
                            {{ $route->count }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">Aucune route visitée</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Répartition par appareil, navigateur et plateforme -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Répartition par appareil -->
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Par Appareil</h3>
            <div class="space-y-3">
                @php
                    $totalAppareils = $appareils->sum();
                @endphp
                @foreach($appareils as $device => $count)
                    @php
                        $percentage = $totalAppareils > 0 ? ($count / $totalAppareils * 100) : 0;
                        $colors = [
                            'mobile' => 'from-green-500 to-green-600',
                            'desktop' => 'from-blue-500 to-blue-600',
                            'tablet' => 'from-purple-500 to-purple-600'
                        ];
                        $color = $colors[$device] ?? 'from-gray-500 to-gray-600';
                    @endphp
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ ucfirst($device ?? 'Inconnu') }}</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($percentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r {{ $color }} h-2 rounded-full transition-all" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $count }} visites</span>
                    </div>
                @endforeach
                @if($appareils->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">Aucune donnée</p>
                @endif
            </div>
        </div>

        <!-- Répartition par navigateur -->
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Par Navigateur</h3>
            <div class="space-y-3">
                @php
                    $totalNav = $navigateurs->sum('count');
                @endphp
                @foreach($navigateurs as $nav)
                    @php
                        $percentage = $totalNav > 0 ? ($nav->count / $totalNav * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $nav->browser }}</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($percentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $nav->count }} visites</span>
                    </div>
                @endforeach
                @if($navigateurs->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">Aucune donnée</p>
                @endif
            </div>
        </div>

        <!-- Répartition par plateforme -->
        <div class="glass dark:glass-dark rounded-2xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Par Plateforme</h3>
            <div class="space-y-3">
                @php
                    $totalPlat = $plateformes->sum('count');
                @endphp
                @foreach($plateformes as $plat)
                    @php
                        $percentage = $totalPlat > 0 ? ($plat->count / $totalPlat * 100) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $plat->platform }}</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($percentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-pink-500 to-pink-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $plat->count }} visites</span>
                    </div>
                @endforeach
                @if($plateformes->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center py-8">Aucune donnée</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Visites récentes -->
    <div class="glass dark:glass-dark rounded-2xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Visites Récentes</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Date/Heure</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">URL</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Appareil</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Navigateur</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">IP</th>
                        <th class="text-right py-3 px-4 text-sm font-semibold text-gray-700 dark:text-gray-300">Temps</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visites_recentes as $visit)
                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-3 px-4 text-sm text-gray-900 dark:text-white">
                                {{ $visit->visited_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400 truncate max-w-xs" title="{{ $visit->url }}">
                                {{ Str::limit($visit->url, 40) }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ ucfirst($visit->device_type ?? 'N/A') }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ $visit->browser ?? 'N/A' }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400 font-mono">
                                {{ $visit->ip_address }}
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400 text-right">
                                {{ $visit->response_time ?? 'N/A' }}ms
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500 dark:text-gray-400">Aucune visite récente</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

