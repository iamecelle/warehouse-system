<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

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
    protected $fillable = ['id_number', 'first_name', 'last_name', 'gender', 'course_id'];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function getFullNameAttribute()
    {
        return $this->last_name.', '.$this->first_name;
    }

    public function getFullNameAndIdAttribute()
    {
        return  $this->id_number.' - '.$this->last_name.', '.$this->first_name;
    }
    
}
