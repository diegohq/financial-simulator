<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SELIC is the brazilian basic interest rate
 *
 * @property int $id
 * @property float $value
 * @property string $announced_at
 */
class SelicHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'announced_at',
        'value',
    ];

    protected $casts = [
        'value' => 'float'
    ];

    protected $dates = [
        'deleted_at',
        'announced_at'
    ];
}
