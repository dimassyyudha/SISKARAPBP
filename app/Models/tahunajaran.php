<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahunajaran extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun';
    public $incrementing = false;
    public $timestamps = false;

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id_tahun',
        'tahun_ajaran'
    ];

    // Relasi dengan model Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_tahun', 'id_tahun');
    }

    public function usulanRuangKuliah()
    {
        return $this->hasMany(UsulanRuangKuliah::class, 'id_tahun', 'id_tahun');
    }
}

