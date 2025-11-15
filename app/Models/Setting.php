<?php

namespace App\Models;

use App\Models\Scopes\FilterByMerchantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gmap_key', 
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_encryption',
        'mail_from_name',
        'whatsapp_sender_notif', 
        'timezone',
        'scrapp_phone',
        'scrapp_phone_whatsapp',
        'phone_country_code',
        'default_lang',
        'open_ai_key',
        'local_api_key',
        'merchant_id',
        'scrapp_counter',
        'whatsapp_sender',
        'email_sender',
        'api_device_use',
        'ai_option',
        'google_text_to_audio', 
    ];

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
        static::addGlobalScope(new FilterByMerchantScope);
        static::creating(function ($model) {
            $model->id  = Uuid::uuid4()->toString();
            $user       = auth()->user();
            if ($user && $user->role == 'user' && $user->merchant_id != null) {
                $model->merchant_id = $user->merchant_id;
            }
        });
    }
}
