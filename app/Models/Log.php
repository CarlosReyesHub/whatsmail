<?php

namespace App\Models;

use App\Models\Scopes\FilterByMerchantScope;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'type',
        'status',
        'error',
        'merchant_id',
        'store_id',
        'sending',
        'text',
        'device_id',
        'phone'
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


    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
 
    public function device()
    {
        return $this->belongsTo(WhatsappDevice::class, 'device_id');
    }
    
}
