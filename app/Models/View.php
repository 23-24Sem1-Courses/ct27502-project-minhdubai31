<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model {
    protected $table = 'views';
    protected $primaryKey = 'view_id';
    protected $fillable = [
        'mt_id'
    ];

    public function motor(): BelongsTo {
        return $this->belongsTo(Motor::class, 'motor_id');
    }
}