<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'customer';

    protected $table = 'customer';
    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'id_customer', 'email', 'name', 'city', 'reset_password'
    ];

    protected $hidden = [
        'password'
    ];

    public function username()
    {
        return 'email';
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'customer_id', 'id_customer');
    }
}
