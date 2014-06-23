<form id="createPersona">

<h3>Datos principales</h3>

<div id="errors-ajax-persona"></div>

<fieldset class="form-group">

    <!-- Idioma -->

    <div class="col-md-6">

        {{ Form::label('persona[idiomas_id]', 'Idioma:') }}
        {{ Form::select('persona[idiomas_id]', Idioma::getListIdiomas(NULL), NULL, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}

    </div>

    <!-- Proveniente -->

    <div class="col-md-6">

        {{ Form::label('persona[proveniente]', 'Proveniente:') }}
        {{ Form::text ('persona[proveniente]', NULL, array('class' => 'form-control')) }}

    </div>

</fieldset>

<fieldset class="form-group">

    <!-- Nombre -->

    <div class="col-md-6">

        {{ Form::label('persona[nombre]', 'Nombre:') }}
        {{ Form::text ('persona[nombre]', NULL, array('class' => 'form-control')) }}
    
    </div>

    <!-- Apellido -->

    <div class="col-md-6">

        {{ Form::label('persona[apellido]', 'Apellido:') }}
        {{ Form::text ('persona[apellido]', NULL, array('class' => 'form-control')) }}
    
    </div>

</fieldset>   

<fieldset class="form-group">

    <!-- Genero -->

    <div class="col-md-6">

        {{ Form::label('persona[genero]', 'Genero:') }}
        {{ Form::select('persona[genero]', Persona::$generos, NULL, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}
    
    </div>

    <!-- Tipo de registro -->

    <div class="col-md-6">
        
        {{ Form::label('persona[tipo_reg]', 'Tipo de registro:') }}
        {{ Form::select('persona[tipo_reg]', Persona::$tipo_registros, NULL, array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}
    
    <div>

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
