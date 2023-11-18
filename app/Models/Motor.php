<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Motor extends Model {
    protected $table = 'motors';
    protected $primaryKey = 'mt_id';
    protected $fillable = [
        'mt_name',
        'mt_descr',
        'mt_width',
        'mt_height',
        'mt_length',
        'mt_weight',
        'mt_seat_height',
        'mt_fuel',
        'mt_consumption',
        'mt_cc',
        'type_id',
        'mt_sample_img',
        'mt_ground_clearance',
        'mt_price'
    ];

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function colors(): HasMany {
        return $this->hasMany(Color::class, 'mt_id');
    }

    public function images(): HasMany {
        return $this->hasMany(Image::class, 'mt_id');
    }

    public function views(): HasMany {
        return $this->hasMany(View::class, 'mt_id');
    }
}