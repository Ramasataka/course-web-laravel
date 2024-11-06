<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;

class Courses extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        "nama_courses",
        "deskripsi_courses",
        "gambar",
        "mentor_id"
    ];

    public function mentor()
        {
            return $this->belongsTo(User::class, 'mentor_id');
        }

}
