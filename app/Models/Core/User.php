<?php

namespace App\Models\Core;

use App\Models\DataProviders\Rol;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\UsersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, UsersTrait;

    protected $table = 'users';


    const USER_ID_ADMIN = 1;

    const ALLRELATIONS = [
        'campañas',
        'campañas.comentarios',
        'campañas.comentarios.user',
        'campañas.user',
        'campañas.imagenes',
    ];

    const RELATIONSUSERADMIN = [
        'campañas',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id');
    }

    public function campañas()
    {
        return $this->hasMany(Campaña::class, 'user_id', 'id')->orderBy('created_at', 'DESC');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'user_id', 'id');
    }

    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'user_id', 'id');
    }

    public static function permisos()
    {
        return DB::table('permisos')
            ->select('permisos.permiso')
            ->join('roles_permisos', 'permisos.id', '=', 'roles_permisos.permiso_id')
            ->join('roles', 'roles.id', '=', 'roles_permisos.rol_id')
            ->join('users', 'users.rol_id', '=', 'roles.id')
            ->where('users.id', Auth::id())
            ->get();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
