<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'positions';

    /**
    * fillable
    *
    * @var array
    */
    protected $fillable = ['name', 'admin_created_id', 'admin_updated_id', 'created_at', 'updated_at'];

    /**
    * Get the emlpoyees of this position.
    */
    public function employees() {
        return $this->hasMany(Employee::class);
    }

    /**
    * Get the admin who created this position.
    */
    public function adminCreated(){
        return $this->belongsTo(User::class, 'admin_created_id');
    }

    /**
    * Get the admin who updated this position.
    */
    public function adminUpdated(){
        return $this->belongsTo(User::class, 'admin_updated_id');
    }
}
