<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model {
    protected $table = 'images';
    protected $primaryKey = 'img_id';
    protected $fillable = [
        'img_path',
        'mt_id'
    ];

    public function motor(): BelongsTo {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}