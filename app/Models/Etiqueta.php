<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Etiqueta
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property EtiquetaTarea[] $etiquetaTareas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Etiqueta extends Model
{

    static $rules = [
		'name' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function etiquetaTareas()
    {
        return $this->hasMany('App\Models\EtiquetaTarea', 'label_id', 'id');
    }

    /**
     * Relacion muchos a muchos Etiquetas-Tareas
    */
    public function tareas(){
        return $this->belongsToMany(Tarea::class);
    }


}
