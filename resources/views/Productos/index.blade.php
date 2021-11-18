@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">

  <button type="button" class="btn btn-primary btn-agregar"><i class="fa fa-plus"></i> Agregar</button>
        <br>  <br>


        <div class="table-responsive-md">
            <table id="productos_table" class="table">

<thead>
    <th>Tipo de Dispositivo</th>
    <th>Marca</th>
    <th>Nombre de dispositivo</th>
    <th>Precio</th>
    <th>Estado</th>
    <th>Acciones</th>
</thead>
<tbody>
<tr>

    <td>linea blanca</td>
    <td>electrolux</td>
    <td>refrigerador 2054</td>
    <td>999</td>
    <td>activo</td>
    <td>    <button

        class="btn btn-primary btn-sm btn-actualizar">
        <i class="fa fa-pencil"></i>
        </button>
        <button

        class="btn btn-danger btn-sm btn-eliminar">
        <i class="fa fa-trash"></i>
        </button></td>
</tr>

</tbody>


            </table>

      </div>

    </div>
</div>
</div>

 <form id="agregar_pregunta" method="POST" autocomplete="off">


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
                    <label for="">Estado </label>
                    <select name="" class="form-control" id="">
                        <option value="">--Seleccione--</option>
                        <option value="">activo</option>
                        <option value="">inactivo</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">TIPO</label>

           <input type="text" class="pregunta form-control" name="pregunta" id="pregunta">
                </div>
            </div>
            <div class="col-md-12">

                <div class="form-group">
                    <label for="">Gama</label>
           <select name="" class="form-control" id="">
               <option value="">--Seleccione--</option>
               <option value="">Alta</option>
               <option value="">Media</option>
               <option value="">Baja</option>
           </select>
                </div>
            </div>
            <div class="col-md-12">

                <div class="form-group">
                    <label for="">Marca</label>
           <select name="" class="form-control" id="">
               <option value="">--Seleccione--</option>
               <option value="">Sony </option>
               <option value="">Electroluz</option>
               <option value="">akita</option>
               <option value="">Panasonic</option>
           </select>
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">RESPUESTA</label>
                <textarea name="respuesta" class="respuesta form-control" name="respuesta" id="respuesta" cols="10" rows="5"></textarea>
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">URL</label>

           <input type="text" class="pregunta form-control" name="" id="">
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">Imagen</label>

           <input type="file" class="pregunta form-control" name="" id="">
                </div>
            </div>

            <div class="col-md-12">

                <div class="form-group">
                    <label for="">Precio</label>

           <input type="text" class="pregunta form-control" name="pregunta" id="pregunta">
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
  $('#productos_table').DataTable();

  $(document).on('click','.btn-actualizar',function(){

$('.btn-submit').html('Editar');
$('.modal-title').html('Actualizar');
$('#modal-agregar').modal('show');
id= $(this).data('id');


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


$(document).on('click','.btn-agregar',function(){
    $('#modal-agregar').modal('show');
    $('.modal-title').html('Agregar');
    $('.btn-submit').html('Agregar');
    $('#agregar_pregunta')[0].reset();
});

</script>
@endsection
