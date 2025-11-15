<?php

namespace App\Models\Merchant;

use App\Models\Package\PackageTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Merchant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'merchant_category_id',
        'owner_id',
        'address',
        'zip_code',
        'status'
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->withoutGlobalScopes();
    }

    public function category()
    {
        return $this->belongsTo(MerchantCategory::class, 'merchant_category_id');
    }

    public function package_transaction()
    {
        return $this->hasMany(PackageTransaction::class, 'merchant_id')->orderBy("created_at", "desc");
    }

    public function transaction()
    {
        return $this->hasMany(PackageTransaction::class, 'merchant_id')->where("status","success")->orderBy("created_at", "desc");
    }

    public function package_active()
    {
        return $this->hasOne(PackageTransaction::class, 'merchant_id')->where("status", "success")->where("expire_date", ">=", now())->orderBy("created_at", "desc");
    }

    public function getTransactionPackagePendingAttribute()
    {
        $status = true;

        if (count($this->package_transaction->where("status", "pending")) > 0) {
            $status = false;
        }

        return $status;
    }
}
