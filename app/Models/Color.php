<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Color extends Model {
    protected $table = 'colors';
    protected $primaryKey = 'color_id';
    protected $fillable = [
        'color_name',
        'color_hex',
        'mt_id'
    ];

    public function motor(): BelongsTo {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}