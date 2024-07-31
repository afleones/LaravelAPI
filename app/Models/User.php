<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class User extends Authenticatable implements JWTSubject 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';  // Especifica el nombre de la tabla
    
    protected $fillable = [
        'name', 'type_document_id', 'identification_number', 'email', 'password', // Agrega los campos name, email y password aquí
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');
    }    

    // valida el rol del usuario al iniciar sesion
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_user');
    }
    
    public static function createUser(array $data)
    {
        // Crear el usuario
        $user = static::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Asignar el rol por defecto (#2: "customer")
        $role = Role::find(2); // Obtener el rol con ID #2
        if ($role) {
            $user->roles()->attach($role);
        }

        return $user;
    }
}
