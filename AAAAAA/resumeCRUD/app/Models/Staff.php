<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $staff
 * @property-read \App\Models\Person|null $person
 * @property-read \App\Models\Vacancy|null $vacancy
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Staff whereStaff($value)
 * @mixin \Eloquent
 */
class Staff extends Model
{
    use HasFactory;
    public function vacancy(){
        return $this->belongsTo(Vacancy::class);
    }
    public function person(){
        return $this->belongsTo(Person::class);
    }
}
