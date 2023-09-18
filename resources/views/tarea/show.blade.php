@extends('layouts.app')

@section('template_title')
    {{ $tarea->name ?? "{{ __('Show') Tarea" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            {{-- <span class="card-title">{{ __('Show') }} Tarea</span> --}}
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning" href="{{ route('tareas.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $tarea->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $tarea->description }}
                        </div>
                        <div class="form-group">
                            <strong>Creation Date:</strong>
                            {{ $tarea->creation_date }}
                        </div>
                        <div class="form-group">
                            <strong>Expiration Date:</strong>
                            {{ $tarea->expiration_date }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Usuario:</strong>
                            {{ $usuarios }}
                        </div>

                        <div class="form-group">
                            <hr>
                            <strong>ETIQUETAS</strong>
                            <br><br>
                            @foreach ($etiquetas as $etiqueta)
                                @if($tarea->etiquetas->contains($etiqueta->id))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="etiquetas[]" id="{{$etiqueta->id}}" value="{{$etiqueta->id}}" checked disabled>
                                        <label class="form-check-label" for="{{$etiqueta->id}}">
                                            {{$etiqueta->name}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
