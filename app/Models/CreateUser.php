<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mail;
use App\Mail\CreateUserMail;
use Hash;
use Laravel\Passport\HasApiTokens;
class CreateUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'create_user';

    protected $fillable = [
        'usertype',
        'name',
        'email',
        'contact_no',
        'create_user',
        'address',
        'can_add_shopping',
        'can_add_cleaner',
        'shopingcenter_id',
        'stutes',
        'role',
        'password',
        'is_created',
        'created_at',
        'updated_at',
    ];

    // public static function boot() {
  
    //     parent::boot();
  
    //     static::created(function ($item) {
            
    //         Mail::to($item->email)->send(new CreateUserMail($item));
    //         $item->password = Hash::make($item->password);
    //     });
    // }

    protected $hidden = [
        'password'
    ];

}
