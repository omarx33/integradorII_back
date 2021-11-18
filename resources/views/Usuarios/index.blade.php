@extends('layouts.app')

@section('content')




<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">





        <div class="table-responsive-md">
            <table id="usuario" class="table">





            </table>

      </div>


    </div>
</div>
</div>


{{-- modal --}}
<form id="agregar_user" method="POST" autocomplete="off">

    <!-- Modal -->
    <div class="modal fade" id="modal-agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
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

            <div class="col-md-6">

                <div class="form-group">
                    <label for="">Nombres</label>
                    <input type="text" class="nombre form-control" name="nombre" id="nombre">
                </div>
            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" class="apellidos form-control" name="apellidos" id="apellidos">
                </div>
            </div>

            </div>

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="">Empresa</label>
                        <input type="text" class="empresa form-control" name="empresa" id="empresa">
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" class="correo form-control" name="correo" id="correo">
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
  var ruta = '{{ route('usuarios.index')}}';
$(document).ready(function() {
    loadData();
} );


function loadData(){
    $('#usuario').DataTable({
        "language":{

"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"

},
        destroy:true, // refrescar la tabla
        iDisplayLength: 10, //cambiar la cantidad de filas a mostrar
        deferRender:true,//para que carge en paralelo de 10 en 10 pagnacion los 2
        bProcessing: true,//para que carge en paralelo de 10 en 10 pagnacion
        bAutoWidth: false, //para que funcione el responsive
       // order:[[0,'asc']], //en forma ascendente en minuscula 0 es el orden de las columnas donde 0 es id
            ajax:{
                url:ruta,
                type:'GET'
            },

            columns:[
              {title:'Nombre',data:'nombre'},
             {title:'Apellido',data:'apellido'},

             {title:'Empresa',data:'empresa'},
             {title:'Correo',data:'email'},
             {title:'Estado',data:'estado'},
             {title:'Rol',data:'rol'},


            {title:'Acciones',data:null,render:function(data){


            if( data.estado == 'activo' ){
                btn_active = `<button
                data-id = "${data.id}"
                data-active = "${data.estado}";
                class="btn btn-success btn-sm btn-eliminar"><i class="fa fa-thumbs-up"></i></button>`;
            }else{
                btn_active = `<button
                data-id = "${data.id}"
                data-active = "${data.estado}";
                class="btn btn-danger btn-sm btn-eliminar"><i class="fa fa-thumbs-down"></i></button>`;
            }


             return `

                     <button
                     data-id="${data.id}"
                     class="btn btn-primary btn-sm btn-actualizar">
                     <i class="fa fa-pencil"></i>
                     </button>


                     ${btn_active}

                       `;
              }}

            ]



    });
}




$(document).on('click','.btn-eliminar',function(){

id= $(this).data('id');
active = $(this).data('active');



Swal.fire({
title: 'Estas seguro?',
text: "el Usuario se desactivara!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Confirmar!',
cancelButtonText : 'Cancelar'
}).then((result) => {
if (result.isConfirmed) {

/*  */
let url = '{{ route('usuarios.destroy',':id')}}';
  url = url.replace(':id',id); // reemplazando el id

 $.ajax({
      url:url,
      type:'DELETE',
     data:{'id':id,'active':active,'_token':'{{ csrf_token() }}'},

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


//actualizar


$(document).on('click','.btn-actualizar',function(){
    $('.btn-submit').html('Editar');
    $('.modal-title').html('Actualizar');
 $('#modal-agregar').modal('show');
 id= $(this).data('id');
  url = '{{ route('usuarios.edit',':id')}}';
 url = url.replace(':id',id); // reemplazando el id

 $.ajax({
        url:url,
        type:'GET',
        data:{},// ya no se pasa se manda por el url
        dataType:'JSON',
        success:function(e){
            $('.id').val(e.id);
       $('.nombre').val(e.nombre);
       $('.apellidos').val(e.apellido);
       $('.empresa').val(e.empresa);
       $('.correo').val(e.email);

        }

     });

});



 $(document).on('submit','#agregar_user',function(e){
    var ruta_agrega = '{{ route('usuarios.store')}}';
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

  </script>

@endsection
