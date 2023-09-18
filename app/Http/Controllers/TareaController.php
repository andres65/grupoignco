<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class TareaController
 * @package App\Http\Controllers
 */
class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::paginate();

        return view('tarea.index', compact('tareas'))
            ->with('i', (request()->input('page', 1) - 1) * $tareas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarea = new Tarea();
        $usuarios = User::pluck('name','id');
        $etiquetas = Etiqueta::all();
        return view('tarea.create', compact('tarea','usuarios', 'etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tarea::$rules);

        $tarea = Tarea::create($request->all());

        // Se recuperar los IDs de etiquetas seleccionadas
        $etiquetasSeleccionadas = $request->input('etiquetas', []);
        // Se asocia las etiquetas seleccionadas con la tarea
        $tarea->etiquetas()->sync($etiquetasSeleccionadas);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea creada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$tarea = Tarea::find($id);
        //Se buscan todas las etiquetas de la tarea
        $tarea = Tarea::with('etiquetas')->find($id);
        $usuarios = User::where('id', $tarea->user_id)->pluck('name')->first();
        $etiquetas = Etiqueta::all();

        return view('tarea.show', compact('tarea','usuarios', 'etiquetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Se buscan todas las etiquetas de la tarea
        $tarea = Tarea::with('etiquetas')->find($id);
        $usuarios = User::pluck('name','id');
        $etiquetas = Etiqueta::all();

        return view('tarea.edit', compact('tarea','usuarios', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tarea $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate(Tarea::$rules);
        $tarea = Tarea::find($id);
        $tarea->name = $request->input('name');
        $tarea->description = $request->input('description');
        $tarea->creation_date = $request->input('creation_date');
        $tarea->expiration_date = $request->input('expiration_date');
        $tarea->user_id  = $request->input('user_id');
        $tarea->save();

        $tarea->etiquetas()->sync($request->input('etiquetas', []));
        //$tarea->update($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea Actualizada con Éxito.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id);
        // Elimina las etiquetas asociadas a la tarea
        $tarea->etiquetas()->detach();
        // Elimina la tarea
        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea Eliminada.');
    }
}
