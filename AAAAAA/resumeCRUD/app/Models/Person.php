<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $FIO
 * @property int $staff_id
 * @property string $Phone
 * @property int $Stage
 * @property string $Image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Firm|null $staff
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFIO($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Person extends Model
{
    use HasFactory;
    protected $fillable = ['FIO','staff_id','Phone','Stage','Image'];
    protected $guarded = ['id'];
    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
