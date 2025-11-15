<?php

namespace App\Models\Media;

use App\Models\Scopes\FilterByMerchantScope;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Folder extends Model
{

    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'folder_id',
        'name',
        'slug'
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


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }


    public function parent()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function subs()
    {
        return $this->hasMany(Folder::class, 'folder_id')->orderBy('name', 'asc');
    }

    public function media()
    {
        return $this->hasMany(MediaContent::class, 'folder_id')->orderBy('name', 'asc');
    }
}
