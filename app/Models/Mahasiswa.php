<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Mahasiswa extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim', 'nama', 'angkatan', 'password', 'prodi_id',
    ];

    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthIdentifierName()
    {
        return 'nim';
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function matakuliahs()
    {
        return $this->belongsToMany(Matakuliah::class, 'mahasiswa_matakuliah', 'mhsNim', 'mkId');
    }
}