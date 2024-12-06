<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'last_name',
        'first_name',
        'external_id'
    ];

    public function leads(): BelongsToMany
    {
        return $this->belongsToMany(Lead::class, 'lead_contact', 'contact_id', 'lead_id');
    }
}
