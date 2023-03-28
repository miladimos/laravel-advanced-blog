<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory,
        HasUUID;

    protected $table = 'profiles';

    ///    protected $fillable = [
    ////        'telegram', 'twitter', 'instagram', 'github', 'gitlab', 'virgol', 'atbox',
    ////        'phone', 'facebook', 'linkedin', 'avatar'
    ////    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
