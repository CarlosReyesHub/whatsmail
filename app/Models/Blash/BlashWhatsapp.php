<?php

namespace App\Models\Blash;

use App\Models\Master\Category;
use App\Models\Master\City;
use App\Models\Master\District;
use App\Models\Master\MessageTemplate;
use App\Models\Scopes\FilterByMerchantScope;
use App\Models\WhatsappKeyAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class BlashWhatsapp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'city_id',
        'district_id',
        'name',
        'schedule',
        'status',
        'use',
        'template_id',
        'delay',
        'waba',
        'meta_id',
        'waba_id',
        'metadata',
        'file'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'schedule' => 'datetime',
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
        static::addGlobalScope(new FilterByMerchantScope);
        static::creating(function ($model) {
            $model->id  = Uuid::uuid4()->toString();
            $user       = auth()->user();
            if ($user && $user->role == 'user' && $user->merchant_id != null) {
                $model->merchant_id = $user->merchant_id;
            }
        });
    }

    public function details()
    {
        return $this->hasMany(BlashDetail::class, 'blash_whatsapp_id')->orderBy('created_at', 'desc');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    public function waba_device()
    {
        return $this->belongsTo(WhatsappKeyAccount::class,'waba_id');
    }
}
