<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'pendidikan',
        'tanggal_lahir',
    ];

    /**
     * Get the user that owns the pegawai.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
