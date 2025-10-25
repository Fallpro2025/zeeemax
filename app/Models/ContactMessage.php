<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'sujet',
        'message',
        'statut',
        'lu_le',
        'notes_admin'
    ];

    protected $casts = [
        'lu_le' => 'datetime'
    ];

    /**
     * Scope pour récupérer les messages non lus
     */
    public function scopeNonLu($query)
    {
        return $query->where('statut', 'nouveau');
    }

    /**
     * Scope pour récupérer les messages lus
     */
    public function scopeLu($query)
    {
        return $query->where('statut', 'lu');
    }

    /**
     * Scope pour récupérer les messages archivés
     */
    public function scopeArchive($query)
    {
        return $query->where('statut', 'archive');
    }

    /**
     * Marquer comme lu
     */
    public function marquerCommeLu()
    {
        $this->update([
            'statut' => 'lu',
            'lu_le' => Carbon::now()
        ]);
    }

    /**
     * Archiver le message
     */
    public function archiver()
    {
        $this->update(['statut' => 'archive']);
    }

    /**
     * Accesseur pour le nom complet
     */
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Scope pour ordonner par date décroissante
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
