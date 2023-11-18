<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model {
    protected $table = 'types';
    protected $primaryKey = 'type_id';
    protected $fillable = [
        'type_name'
    ];

    public function motors(): HasMany {
        return $this->hasMany(Motor::class, 'type_id');
    }
}