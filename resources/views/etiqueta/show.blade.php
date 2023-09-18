@extends('layouts.app')

@section('template_title')
    {{ $etiqueta->name ?? "{{ __('Show') Etiqueta" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Etiqueta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('etiquetas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $etiqueta->name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $etiqueta->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
