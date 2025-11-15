<?php

namespace App\Models\Master;

use App\Models\Scopes\FilterByMerchantScope;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        return $this->hasMany(Store::class,'category_id');
    }
}
