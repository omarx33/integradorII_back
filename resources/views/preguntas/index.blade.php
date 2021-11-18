@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">


        <button type="button" class="btn btn-primary btn-agregar"><i class="fa fa-plus"></i> Agregar</button>
        <br>  <br>


        <div class="table-responsive-md">
            <table id="preguntas_table" class="table">





            </table>

      </div>


    </div>
</div>
</div>

<form id="agregar_pregunta" method="POST" autocomplete="off">

    <!-- Modal -->
    <div class="modal fade" id="modal-agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog " role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

           @csrf
            <div class="row">

                <input type="hidden" name="id" class="id">

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">PREGUNTA</label>
                    <input type="text" class="pregunta form-control" name="pregunta" id="pregunta">
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">RESPUESTA</label>
                <textarea name="respuesta" class="respuesta form-control" name="respuesta" id="respuesta" cols="10" rows="5"></textarea>
                </div>
            </div>

            </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn-submit btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>


<script>
  var ruta = '{{ route('preguntas.index')}}';
$(document).ready(function() {
    loadData();
} );

function loadData(){
    $('#preguntas_table').DataTable({
        "language":{

"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"

},
        destroy:true, // refrescar la tabla
        iDisplayLength: 10, //cambiar la cantidad de filas a mostrar
        deferRender:true,//para que carge en paralelo de 10 en 10 pagnacion los 2
        bProcessing: true,//para que carge en paralelo de 10 en 10 pagnacion
        bAutoWidth: false, //para que funcione el responsive
       // order:[[0,'asc']], //en forma ascendente en minuscula 0 es el orden de las comunas donde 0 es id
            ajax:{
                url:ruta,
                type:'GET'
            },

            columns:[
                {title:'#',data:'id'},
              {title:'Pregunta',data:'pregunta'},
             {title:'Respuesta',data:'respuesta'},
             {title:'Acciones',data:null,render:function(data){


return `

        <button
        data-id="${data.id}"
        class="btn btn-primary btn-sm btn-actualizar">
        <i class="fa fa-pencil"></i>
        </button>
        <button
         data-id="${data.id}"
        class="btn btn-danger btn-sm btn-eliminar">
        <i class="fa fa-trash"></i>
        </button>

          `;
 }}
            ]



    });
}

$(document).on('click','.btn-agregar',function(){
    $('#modal-agregar').modal('show');
    $('.modal-title').html('Agregar');
    $('.btn-submit').html('Agregar');
    $('#agregar_pregunta')[0].reset();
});




$(document).on('submit','#agregar_pregunta',function(e){
    var ruta_agrega = '{{ route('preguntas.store')}}';
parametros = $(this).serialize();
 $.ajax({

url:ruta_agrega,
type:'POST',
data:parametros,
dataType:'JSON',
beforeSend:function(){
Swal.fire({
title:'Cargando..',
text:'Espere un momento'

})
},

success:function(data){


    if (data.icon == 'success') {
   loadData();
   $('#modal-agregar').modal('hide');
}


    Swal.fire({
title : data.title,
text : data.text,
icon : data.icon,
timer : 2000,
showConfirmButton : true


            });

}

});

e.preventDefault();

});




$(document).on('click','.btn-actualizar',function(){

$('.btn-submit').html('Editar');
$('.modal-title').html('Actualizar');
$('#modal-agregar').modal('show');
id= $(this).data('id');
url = '{{ route('preguntas.edit',':id')}}';
url = url.replace(':id',id); // reemplazando el id



$.ajax({
    url:url,
    type:'GET',
    data:{},// ya no se pasa se manda por el url
    dataType:'JSON',
    success:function(e){
        $('.id').val(e.id);
   $('.pregunta').val(e.pregunta);
   $('.respuesta').val(e.respuesta);


    }

 });


});




$(document).on('click','.btn-eliminar',function(){

id= $(this).data('id');



Swal.fire({
title: 'Estas seguro?',
text: "el registro se eliminara",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Confirmar!',
cancelButtonText : 'Cancelar'
}).then((result) => {
if (result.isConfirmed) {

/*  */
let url = '{{ route('preguntas.destroy',':id')}}';
  url = url.replace(':id',id); // reemplazando el id

 $.ajax({
      url:url,
      type:'DELETE',
      data:{'_token':'{{ csrf_token() }}'},
      dataType:'JSON',
      beforeSend:function(){

Swal.fire({
title:'Cargando..',
text:'Espere un momento'

})

},

success:function(data){

 if (data.icon == 'delete') {
loadData();

}


 Swal.fire({
title : data.title,
text : data.text,
icon : data.icon,
timer : 2000,
showConfirmButton : true


         });

}


 });


}
})



});
</script>
@endsection
