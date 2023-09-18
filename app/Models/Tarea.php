<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tarea
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $creation_date
 * @property $expiration_date
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property EtiquetaTarea[] $etiquetaTareas
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tarea extends Model
{

    static $rules = [
		'name' => 'required',
		'description' => 'required',
		'creation_date' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','creation_date','expiration_date','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etiquetaTareas()
    {
        return $this->hasMany('App\Models\EtiquetaTarea', 'task_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * Relacion uno a muchos Tareas-usuario
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * Relacion muchos a muchos Tareas-Etiquetas
    */
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }


}
