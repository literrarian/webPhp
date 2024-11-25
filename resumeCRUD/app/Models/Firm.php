<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $Name
 * @property string $Address
 * @property-read \App\Models\Vacancy|null $vacancy
 * @method static \Illuminate\Database\Eloquent\Builder|Firm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Firm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Firm query()
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Firm whereName($value)
 * @mixin \Eloquent
 */
class Firm extends Model
{
    use HasFactory;
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
