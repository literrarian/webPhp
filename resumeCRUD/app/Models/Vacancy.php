<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $firm_id
 * @property int $staff_id
 * @property-read \App\Models\Firm|null $firm
 * @property-read \App\Models\Staff|null $staff
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereFirmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereStaffId($value)
 * @mixin \Eloquent
 */
class Vacancy extends Model
{
    use HasFactory;
    public function firm(){
        return $this->HasOne(Firm::class);
    }
    public function staff(){
        return $this->HasOne(Staff::class);
    }
}
