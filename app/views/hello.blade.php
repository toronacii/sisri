@extends('layout.base')

@section('content')
	
	<button id="boton" class="btn btn-primary">Pulsa aca</button>

	<button id="boton2" class="btn btn-info">Pulsa aca</button>

	<div id="peticion">
		<div class="loading" style="display:none">Cargando...</div>
	</div>

@stop

@section('scripts')

<script>

	$(document).ready(function(){

		$('#boton').click(function(){

			$.post(base_url + '/ajax?datos3=3', {dato1 : "1", datos2 : "2"}, function(json){

				for (i in json['data'][0])
					$('#peticion').append(json[i] + "<br>");

			}, 'json');

		});

		$('#boton2').click(function(){
			$.ajax({

				url : base_url + '/ajax?datos3=3',
				data : {
					dato1 : "1", 
					datos2 : "2"
				},
				dataType : 'json',
				type : 'post',
				success : function(json){
					console.log(json.data[0]);
					for (i in json.data[0])
					$('#peticion').append(i + " : " + json.data[0][i] + "<br>");
				},
				beforeSend : function()
				{
					$('#peticion .loading').show();
				},
				complete: function(){
					$('#peticion .loading').hide();
				}


			});
		})

	});

</script>

@stop
    