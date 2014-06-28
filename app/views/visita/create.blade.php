@extends('layout.base')

@section('css_js')

    @parent
    
    {{HTML::style('css/bootstrap-datetimepicker.min.css')}}
    {{HTML::style('css/bootstrap-select.min.css')}}
    {{HTML::script('js/moment-2.4.0.js')}}
    {{HTML::script('js/bootstrap-datetimepicker.js')}}
    {{HTML::script('js/locales/bootstrap-datetimepicker.es.js')}}
    {{HTML::script('js/bootstrap-select.min.js')}}

@stop

@section('content')

<div class="col-md-12">
    
    @if (Session::has('message'))
        @foreach (Session::get('message') as $level => $messages)
            
            @foreach ($messages as $message)
            
                <div class="alert alert-{{$level}}">{{$message}}</div>
        
            @endforeach
        
        @endforeach

    @endif

    <h1>Nueva visita</h1>

    {{ Form::open(array('route' => 'visita.store')) }}

        <fieldset class="form-group">

            <!-- Persona -->

            <div class="col-md-6 {{ ($errors->has('personas_id')) ? 'has-error' : '' }}">
                {{ Form::label('personas_id', 'Persona / Amo de casa:') }}

                @if($errors->has('personas_id'))
                {{Form::label('personas_id', $errors->first('personas_id'), array('class' => 'label label-danger'))}}
                @endif

                <div class='input-group'>
                    <select class="form-control selectpicker show-tick" id="personas_id" name="personas_id" data-live-search="true" data-size="5" data-container="body">
                        <option value="">Seleccione</option>
                        @foreach(Persona::all() as $persona)  
                            <?php $id_old_persona = (isset($id_persona)) ? $id_persona : Input::old('personas_id'); ?>
                        <option value="{{ $persona->id }}" data-title="{{ $direccion = Direccion::getStringDireccion($persona->direcciones_id, ',<br>') }}" data-subtext="{{ $direccion }}" {{($persona->id == $id_old_persona) ? 'selected' : ''}}>
                            #{{$persona->id}} {{ $persona->getNombreCompleto() }}
                        </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" title="Nuevo registro" data-toggle="modal" data-target="#crearPersona">
                            <span class="glyphicon glyphicon-new-window"></span>
                        </button>
                    </span>
                </div>
            </div>

            <!-- Publicador -->

            <div class="col-md-6 {{ ($errors->has('publicadores_id')) ? 'has-error' : '' }}">
                 {{ Form::label('publicadores_id', 'Publicador:') }}

                @if($errors->has('publicadores_id'))
                {{Form::label('publicadores_id', $errors->first('publicadores_id'), array('class' => 'label label-danger'))}}
                @endif

                <div class='input-group'>
                    {{ Form::select('publicadores_id', Publicador::getListPublicadores(), Input::old('publicadores_id'), array('class' => 'form-control selectpicker show-tick', 'data-live-search' => 'true', 'data-size' => '5', 'data-container' => 'body')) }}
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" title="Nuevo registro" data-toggle="modal" data-target="#crearPublicador">
                            <span class="glyphicon glyphicon-new-window"></span>
                        </button>
                    </span>
                </div>
            <div>
        </fieldset>

        <fieldset class="form-group">

            <!-- Tipo de registro -->

            <div class="col-md-6 {{ ($errors->has('tipo')) ? 'has-error' : '' }}">
                {{ Form::label('tipo', 'Tipo de registro:') }}

                @if($errors->has('tipo'))
                {{Form::label('tipo', $errors->first('tipo'), array('class' => 'label label-danger'))}}
                @endif

                {{ Form::select('tipo', Visita::$tipos, Input::old('tipo'), array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}
            </div>

            <!-- Condicion -->

            <div class="col-md-6 {{ ($errors->has('condicion')) ? 'has-error' : '' }}">
                 {{ Form::label('condicion', 'Condicion:') }}

                @if($errors->has('condicion'))
                {{Form::label('condicion', $errors->first('condicion'), array('class' => 'label label-danger'))}}
                @endif


                 {{ Form::select('condicion', Visita::$condiciones, Input::old('condicion'), array('class' => 'form-control selectpicker show-tick', 'data-container' => 'body')) }}
            <div>
        </fieldset>

        <fieldset class="form-group">

            <!-- Fecha -->

            <div class="col-md-6 {{ ($errors->has('fecha')) ? 'has-error' : '' }}">
                {{ Form::label('fecha', 'Fecha:') }}    

                @if($errors->has('fecha'))
                {{Form::label('fecha', $errors->first('fecha'), array('class' => 'label label-danger'))}}
                @endif
<!--
                <div class='input-group date' id='datepicker'>
                    {{ Form::text('fecha', NULL, array('class' => 'form-control picker')) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
-->
                <div class='input-group date datepicker'>
                    {{ Form::text('fecha', NULL, array('class' => 'form-control picker')) }}
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" title="Fecha">
                            <span class="glyphicon glyphicon-new-calendar"></span>
                        </button>
                    </span>
                </div>
            </div>

            <!-- Hora -->

            <div class="col-md-6 {{ ($errors->has('hora')) ? 'has-error' : '' }}">
                {{ Form::label('hora', 'Hora:') }}  

                @if($errors->has('hora'))
                {{Form::label('hora', $errors->first('hora'), array('class' => 'label label-danger'))}}
                @endif

                <div class='input-group date timepicker'>
                    {{ Form::text('hora', NULL, array('class' => 'form-control picker')) }}
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

                @if($errors->has('publicacion'))
                {{Form::label('publicacion', $errors->first('publicacion'), array('class' => 'label label-danger'))}}
                @endif
       
                
                {{ Form::text('publicacion', NULL, array('class' => 'form-control')) }}
            </div>

            <!-- Tema -->

            <div class="col-md-6 {{ ($errors->has('tema')) ? 'has-error' : '' }}">
                {{ Form::label('tema', 'Tema:') }}    

                @if($errors->has('tema'))
                {{Form::label('tema', $errors->first('tema'), array('class' => 'label label-danger'))}}
                @endif

                {{ Form::text('tema', NULL, array('class' => 'form-control')) }}
            </div>
        </fieldset>
        <div class="col-md-12">

            <!-- Observacion -->

            <fieldset class="form-group {{ ($errors->has('observacion')) ? 'has-error' : '' }}">
                {{ Form::label('observacion', 'Observacion:') }}    

                @if($errors->has('observacion'))
                {{Form::label('observacion', $errors->first('observacion'), array('class' => 'label label-danger'))}}
                @endif
       
                {{ Form::textarea('observacion', NULL, array('class' => 'form-control')) }}
            </fieldset>

            <!-- Tipo de registro -->

            <fieldset class="form-group">
                {{ Form::submit('Guardar', array('class' => 'btn btn-primary', 'name' => "guardar")) }}
                {{ Form::submit('Guardar y agregar otra', array('class' => 'btn btn-primary', 'name' => "guardar-otro")) }}
                <a href="{{ URL::previous() }}" class="btn btn-default">Volver</a>
            </fieldset>
        </div>

    {{ Form::close() }}

</div>

<div class="modal fade" id="crearPersona">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Registrar nueva persona</h4>
            </div>
            <div class="modal-body">
                @include('persona.create-partial')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submit">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="crearPublicador">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Registrar nuevo publicador</h4>
            </div>
            <div class="modal-body">
                @include('publicador.create-partial')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submit">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')

    <style>
        .tooltip-inner {
            white-space:pre;
            max-width:none;
        }

        ul.selectpicker li small.muted{
            display: none;
        }
    </style>
    
    <script>

        function refresh_selectpicker_title(id){

            $(id +'.selectpicker option').each(function(i){

                var titleHTML = $(this).data('title');

                $('ul.selectpicker li').eq(i).tooltip({
                    placement:'top', 
                    title: titleHTML,
                    html: true
                });
            });

        }

        $(function () {

            $('.datepicker').datetimepicker({
                pickTime: false,
                language:'es', 
            });

            $('.timepicker').datetimepicker({
                pickDate: false, 
            });

            $('.picker').click(function(){
                $(this).next().click();
            })

            /*$('form').submit(function(){
                
                var t_date = moment($("#datepicker :text").val(),'MM/DD/YYYY').format('YYYY-MM-DD');
                var t_time = moment($("#timepicker :text").val(),'hh:mm:ss A').format('HH:mm:ss');    

                $("#datepicker :text").val(t_date)

            });*/

            $('.selectpicker').selectpicker();

            refresh_selectpicker_title('#personas_id');


        });

        $(function(){

            $('#crearPersona button.submit').click(function(){

               $.post(base_url + '/persona/ajax_store', $('#createPersona').serialize(), function(data){

                    $('#errors-ajax-persona').empty().hide();
                    if (data.errors)
                    {
                        for (var i in data.errors)
                        {
                            for (var j in data.errors[i])
                            {
                                $('#errors-ajax-persona').append("<div class='alert alert-danger'>" + data.errors[i][j] + "</div>").show();
                            }
                        }
                    }
                    else
                    {

                        var nombre = $.trim(data.persona.nombre + ' ' + data.persona.apellido) || '(Sin nombre)';

                        $('#personas_id').append('<option value="' + data.persona.id + '" data-title="' + data.persona.direccion + '" data-subtext="' + data.persona.direccion + '">' + nombre + '</option>').selectpicker('val', data.persona.id).selectpicker('refresh');
                        
                        refresh_selectpicker_title('#personas_id');

                        $('#crearPersona').modal('hide');
                    }

                }, 'json');

                //$('#createPersona').attr('action', 'http://localhost/sisri/persona/ajax_store').attr('method', 'POST').submit();

            })


            $('#crearPublicador button.submit').click(function(){

               $.post(base_url + '/publicador/ajax_store', $('#createPublicador').serialize(), function(data){

                    $('#errors-ajax-publicador').empty().hide();
                    console.log(data);
                    if (data.errors)
                    {
                        for (var i in data.errors)
                        {
                            for (var j in data.errors[i])
                            {
                                $('#errors-ajax-publicador').append("<div class='alert alert-danger'>" + data.errors[i][j] + "</div>").show();
                            }
                        }
                    }
                    else
                    {

                        var nombre = $.trim(data.publicador.nombre + ' ' + data.publicador.apellido);

                        $('#publicadores_id').append('<option value="' + data.publicador.id + '">' + nombre + '</option>').selectpicker('val', data.publicador.id).selectpicker('refresh');

                        $('#crearPublicador').modal('hide');
                    }

                }, 'json')

                //$('#createPersona').attr('action', 'http://localhost/sisri/persona/ajax_store').attr('method', 'POST').submit();

                $(document).ajaxStart(function(){
                    
                    $('.modal-footer button.submit').prop('disabled', true)

                }).ajaxStop(function(){
                    
                    $('.modal-footer button.submit').prop('disabled', false)
                    
                })

            })


        });

    </script>   

    @parent

@stop


