<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Merchant\Merchant;
use App\Models\Scopes\FilterByMerchantScope;
use App\Notifications\User\EmailVerificationNotification;
use App\Notifications\User\ForgetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'gender',
        'merchant_id',
        'phone',
        'role',
        'email_verified_at'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded          = ['id'];
    protected $primaryKey       = 'id';
    protected $keyType          = 'string';
    public $incrementing        = false;

    protected static function booted()
    {
        if (auth()->guard('web')->check()) {
            static::addGlobalScope(new FilterByMerchantScope);
        }

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
            $user = auth()->user();
            if ($user && $user->role == 'user' && $user->merchant_id != null) {
                $model->merchant_id = $user->merchant_id;
            }
        });
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function getImageDataAttribute()
    {
        if (file_exists($this->photo)) {
            return $this->photo;
        } else {
            return 'uploads/image.jpg';
        }
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification);
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token));
    }
}
