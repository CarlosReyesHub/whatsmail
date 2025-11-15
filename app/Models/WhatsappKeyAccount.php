<?php

namespace App\Models;

use App\Models\ChatBot\FineTunnel;
use App\Models\Master\MessageTemplate;
use App\Models\Scopes\FilterByMerchantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class WhatsappKeyAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'whatsapp_key',
        'whatsapp_session',
        'limit_per_day',
        'daily_send',
        'status',
        'auto_reply_method',
        'fine_tunnel_id',
        'daily_limit',
        'auto_reply_certain_day',
        'days',
        'auto_reply_certain_time',
        'start_time',
        'end_time',
        'webhook',
        'auto_read_before_autorespon',
        'reply_any_chat',
        'reply_method',
        'template_id',
        'reply_text',
        'auto_reply_option',
        'merchant_id',
        'meta_data'
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
 

    public function templates()
    {
        return $this->hasMany(MessageTemplate::class, 'waba_device_id');
    }
}
