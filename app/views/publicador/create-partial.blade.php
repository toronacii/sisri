<form id="createPublicador">

<h3>Datos principales</h3>

<div id="errors-ajax-publicador"></div>

<fieldset class="form-group">

    <!-- Nombre -->

    <div class="col-md-6">

        {{ Form::label('publicador[nombre]', 'Nombre:') }}
        {{ Form::text ('publicador[nombre]', NULL, array('class' => 'form-control')) }}
    
    </div>

    <!-- Apellido -->

    <div class="col-md-6">

        {{ Form::label('publicador[apellido]', 'Apellido:') }}
        {{ Form::text ('publicador[apellido]', NULL, array('class' => 'form-control')) }}
    
    </div>

</fieldset>   

<fieldset class="form-group">

    <!-- correo -->

    <div class="col-md-6">

        {{ Form::label('publicador[correo]', 'Correo:') }}
        {{ Form::text ('publicador[correo]', NULL, array('class' => 'form-control')) }}
    
    </div>

    <!-- Fecha bautismo -->

    <div class="col-md-6">
        
        {{ Form::label('publicador[fecha_bautismo]', 'Fecha de bautismo:') }}
        <div class='input-group date datepicker'>
            {{ Form::text('publicador[fecha_bautismo]', NULL, array('class' => 'form-control picker')) }}
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button" title="Fecha">
                    <span class="glyphicon glyphicon-new-calendar"></span>
                </button>
            </span>
        </div>
    
    <div>

</fieldset>

<fieldset class="form-group">

    <!-- congregacion -->

    <div class="col-md-6">

        {{ Form::label('publicador[congregaciones_id]', 'Congregacion:') }}
        {{ Form::select('publicador[congregaciones_id]', Congregacion::getListCongregaciones(), NULL, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body', 'data-live-search' => 'true')) }}
    
    </div>

</fieldset>

<h3>Dirección</h3>

<fieldset class="form-group">

    <!-- Zona -->

    <div class="col-md-6">

        {{ Form::label('direccion[zonas_id]', 'Zona:') }}
        {{ Form::select('direccion[zonas_id]', Zona::getListZonas(), NULL, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body', 'data-live-search' => 'true')) }}
    
    </div>

    <!-- Calle o avenida -->

    <div class="col-md-6">
        
        {{ Form::label('direccion[calle_avenida]', 'Calle o avenida:') }}
        {{ Form::text ('direccion[calle_avenida]', NULL, array('class' => 'form-control')) }}
    
    <div>

</fieldset>

<fieldset class="form-group">

    <!-- Cruce con -->

    <div class="col-md-6">

        {{ Form::label('direccion[cruce_con]', 'Cruce con:') }}
        {{ Form::text ('direccion[cruce_con]', NULL, array('class' => 'form-control')) }}
    
    </div>

    <!-- Casa o edificio -->

    <div class="col-md-6">
        
        {{ Form::label('direccion[casa_edificio]', 'N° de casa o nombre edificio:') }}
        {{ Form::text ('direccion[casa_edificio]', NULL, array('class' => 'form-control')) }}
    
    <div>

</fieldset>

<fieldset class="form-group">

    <!-- Piso -->

    <div class="col-md-6">

        {{ Form::label('direccion[piso]', 'Piso:') }}
        {{ Form::text ('direccion[piso]', NULL, array('class' => 'form-control')) }}
    
    </div>

    <!-- Apartamento -->

    <div class="col-md-6">
        
        {{ Form::label('direccion[apto]', 'Apartamento:') }}
        {{ Form::text ('direccion[apto]', NULL, array('class' => 'form-control')) }}
    
    <div>

</fieldset>

<fieldset class="form-group">

    <!-- Local -->

    <div class="col-md-6">

        {{ Form::label('direccion[local]', 'Local:') }}
        {{ Form::text ('direccion[local]', NULL, array('class' => 'form-control')) }}
    
    </div>

    <!-- Otra referencia -->

    <div class="col-md-6">
        
        {{ Form::label('direccion[ref]', 'Otra referencia:') }}
        {{ Form::text ('direccion[ref]', NULL, array('class' => 'form-control')) }}
    
    <div>

</fieldset>

</form>
