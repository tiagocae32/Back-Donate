<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = "users";

    const ALLRELATIONS = [
        'campañas',
        'campañas.comentarios',
        'campañas.comentarios.user',
        'campañas.user',
        'campañas.imagenes'    
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
        'rol_id'    
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
    public function rol() {
        return $this->belongsTo('App\Models\User\Rol', 'rol_id', 'id');
    }
    
    public function campañas(){
        return $this->hasMany('App\Models\Campaña\Campaña', 'user_id', 'id')->orderBy("created_at", "desc");
    }

    public function comentarios(){
        return $this->hasMany('App\Models\Campaña\Comentario', 'user_id', 'id');
    }

    public function donaciones(){
        return $this->hasMany('App\Models\Campaña\Donacion', 'user_id', 'id');
    }

    public static function permisos(){
        return DB::table('permisos')
                ->select('permisos.permiso')
                ->join('roles_permisos', 'permisos.id', '=', 'roles_permisos.permiso_id')
                ->join('roles','roles.id','=','roles_permisos.rol_id')
                ->join('users','users.rol_id','=','roles.id')
                ->where('users.id', Auth::id())
                ->get();
    }

    public static function datosLogin(){
        $user = User::select(['id', "email", "name", "rol_id"])->with([
            'campañas',
            'campañas.comentarios',
            'campañas.comentarios.user',
            'campañas.user',
            'campañas.imagenes'       
        ])->where('id' , Auth::id())->get()->first();
        /*if($user->rol_id == 2){
            $user->load(self::ALLRELATIONS);
            $user["permisos"] = self::permisos();
        }*/
        $user["permisos"] = self::permisos();
        return $user;
    }

    //Scopes
    public static function scopeUser($query, $username){
        return $query->where('id', '!=', 1)->where('name', 'like', '%' . $username . '%')->with(["campañas"])->get();
    }
}