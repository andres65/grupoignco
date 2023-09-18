<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name', 'NOMBRE DE LA TAREA', ['style' => 'font-weight: bold;']) }}
            {{ Form::text('name', $tarea->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'DESCRIPCIÓN', ['style' => 'font-weight: bold;']) }}
            {{ Form::text('description', $tarea->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '')]) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                {{ Form::label('creation_date', 'FECHA CREACIÓN', ['style' => 'font-weight: bold;']) }}
                {{ Form::date('creation_date', $tarea->creation_date, ['class' => 'form-control' . ($errors->has('creation_date') ? ' is-invalid' : '')]) }}
                {!! $errors->first('creation_date', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-md-6">
                {{ Form::label('expiration_date', 'FECHA VENCIMIENTO', ['style' => 'font-weight: bold;']) }}
                {{ Form::date('expiration_date', $tarea->expiration_date, ['class' => 'form-control' . ($errors->has('expiration_date') ? ' is-invalid' : '')]) }}
                {!! $errors->first('expiration_date', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('user_id', 'USUARIO', ['style' => 'font-weight: bold;']) }}
            {{ Form::select('user_id', $usuarios, $tarea->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : '')]) }}

            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <hr>
            {{ Form::label('etiqueta', 'ETIQUETAS', ['style' => 'font-weight: bold;']) }}
            <br><br>
            @foreach ($etiquetas as $etiqueta)

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="etiquetas[]" id="{{$etiqueta->id}}" value="{{$etiqueta->id}}" @if($tarea->etiquetas->contains($etiqueta->id)) checked @endif>
                    <label class="form-check-label" for="{{$etiqueta->id}}">
                        {{$etiqueta->name}}
                    </label>
                </div>
            @endforeach

        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
