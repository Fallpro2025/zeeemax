<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Visit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'route_name',
        'method',
        'referer',
        'device_type',
        'browser',
        'platform',
        'country',
        'city',
        'status_code',
        'response_time',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
        'response_time' => 'integer',
        'status_code' => 'integer',
    ];

    /**
     * Scope pour filtrer par période
     */
    public function scopePeriod(Builder $query, $days = 30)
    {
        return $query->where('visited_at', '>=', now()->subDays($days));
    }

    /**
     * Scope pour exclure les routes admin
     */
    public function scopePublic(Builder $query)
    {
        return $query->where('url', 'not like', '%/admin%');
    }

    /**
     * Scope pour les visites uniques par IP
     */
    public function scopeUniqueVisitors(Builder $query)
    {
        return $query->selectRaw('DISTINCT ip_address, DATE(visited_at) as date');
    }
}
