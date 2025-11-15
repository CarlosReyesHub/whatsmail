<?php

namespace App\Models\Store;

use App\Models\Master\Category;
use App\Models\Master\District;
use App\Models\Merchant\Merchant;
use App\Models\Scopes\FilterByMerchantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class Store extends Model
{
    use HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'district_id',
        'name',
        'phone',
        'address',
        'pemilik',
        'status',
        'prospek',
        'email',
        'scrapping_id',
        'merchant_id'
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

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class,'merchant_id');
    }
}
