<?php

namespace App\Models\Package;

use App\Models\Merchant\Merchant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class PackageTransaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'merchant_id',
        'package_id',
        'price',
        'expire_date',
        'tax',
        'other_charge',
        'final_total',
        'add_days',
        'limit_user_option',
        'users_limit',
        'limit_whatsapp_option',
        'limit_whatsapp_priode',
        'whatsapp_limit',
        'limit_email_option',
        'limit_email_priode',
        'email_limit',
        'limit_scrapp_option',
        'limit_scrapp_priode',
        'scrapp_limit',
        'limit_device',
        'device_limit',
        'limit_template',
        'template_limit',
        'limit_ai_training',
        'ai_training_limit',
        'limit_chatbot',
        'chatbot_limit',
        'status',
        'ref_no',
        'invoice'
    ];

    protected $dates = [
        'expire_date',
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
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function payment()
    {
        return $this->hasOne(PackageTransactionPayment::class,'package_transaction_id');
    }
}
