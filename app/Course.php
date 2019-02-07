<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['course_code', 'course_description', 'department_id'];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }
}
