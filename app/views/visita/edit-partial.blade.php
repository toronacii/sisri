<form method="post" action="{{url('visita/update/' . $visita->id)}}">

<fieldset class="form-group">

    <!-- Persona -->

    <!-- Publicador -->

    <div class="col-md-6">
       {{ Form::label('publicadores_id', 'Publicador:') }}
       {{ Form::select('publicadores_id', Publicador::getListPublicadores(NULL), $visita->publicadores_id, array('class' => 'form-control selectpicker show-tick', 'data-live-search' => 'true', 'data-size' => '5', 'data-container' => 'body')) }}
   </div>

</fieldset>

<fieldset class="form-group">

    <!-- Tipo de registro -->

    <div class="col-md-6">
        {{ Form::label('tipo', 'Tipo de registro:') }}

        {{ Form::select('tipo', Visita::getListTipos(NULL), $visita->tipo, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}
    </div>

    <!-- Condicion -->

    <div class="col-md-6">
       {{ Form::label('condicion', 'Condicion:') }}

       {{ Form::select('condicion', Visita::$condiciones, $visita->condicion, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}
   </div>
</fieldset>

<fieldset class="form-group">

    <!-- Fecha -->

    <div class="col-md-6">
        {{ Form::label('fecha', 'Fecha:') }}    

        <div class='input-group date datepicker'>
            {{ Form::text('fecha', $visita->fecha, array('class' => 'form-control picker')) }}
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" title="Fecha">
                    <span class="glyphicon glyphicon-calendar"></span>
                </button>
            </span>
        </div>
    </div>

    <!-- Hora -->

    <div class="col-md-6">
        {{ Form::label('hora', 'Hora:') }}  

        <div class='input-group date timepicker'>
            {{ Form::text('hora', $visita->hora, array('class' => 'form-control picker')) }}
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" title="Hora">
                    <span class="glyphicon glyphicon-time"></span>
                </button>
            </span>
        </div>
    </div>
</fieldset>

<fieldset class="form-group">

    <!-- Publicacion -->

    <div class="col-md-6 {{ ($errors->has('publicacion')) ? 'has-error' : '' }}">
        {{ Form::label('publicacion', 'Publicacion:') }}    

        {{ Form::text('publicacion', $visita->publicacion, array('class' => 'form-control')) }}
    </div>

    <!-- Tema -->

    <div class="col-md-6">
        {{ Form::label('tema', 'Tema:') }}    

        {{ Form::text('tema', $visita->tema, array('class' => 'form-control')) }}
    </div>
</fieldset>
<div class="col-md-12">

    <!-- Observacion -->

    <fieldset class="form-group {{ ($errors->has('observacion')) ? 'has-error' : '' }}">
        {{ Form::label('observacion', 'Observacion:') }}    

        {{ Form::textarea('observacion', $visita->observacion, array('class' => 'form-control')) }}
    </fieldset>

</div>

</form>

<script>

$('.datepicker').datetimepicker({
    pickTime: false,
    language:'es', 
});

$('.timepicker').datetimepicker({
    pickDate: false, 
});

$('.picker').click(function(){
    $(this).next().click();
});

$('.selectpicker').selectpicker();

</script>
