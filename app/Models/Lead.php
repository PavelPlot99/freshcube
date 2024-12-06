<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable =
        [
            'name',
            'external_id',
            'price',
        ];

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'lead_contact', 'lead_id','contact_id');
    }
}
