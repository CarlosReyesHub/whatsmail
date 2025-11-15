<?php

namespace App\Models\ChatBot;

use App\Models\Master\MessageTemplate;
use App\Models\Scopes\FilterByMerchantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;  

class ChatBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'keyword',
        'select_device',
        'reply_method',
        'template_id',
        'message'
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

    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    public function details()
    {
        return $this->hasMany(ChatBotImage::class,'chatbot_id');
    }
}
