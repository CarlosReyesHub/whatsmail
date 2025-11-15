<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class InternalSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'app_name',
        'logo',
        'white_logo',
        'icon',
        'meta_keyword',
        'meta_description',
        'register',
        'frontend',
        'blog',
        'pricing',
        'contact',
        'copyright',
        'footer_description',
        'tax',
        'email_contact',
        'phone_contact',
        'contact_address',
        'footer_web',
        'web_template',
        'footer_1',
        'footer_2',
        'footer_3',
        'loader',
        'currency',
        'currency_position'
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
}
