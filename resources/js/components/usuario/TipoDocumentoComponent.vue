<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="abrirModal" v-if="$can('crear pais')">
          <i class="fas fa-plus-circle"></i> Registrar
        </button>
        <h3 class="tile-title">Listado de tipos de documentos</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i :class="icono" ></i>{{tituloModal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form >
                  <div class="form-group">
                    <label for="nombre" class="control-label">Nombre (*)</label>
                    <input id="nombre" class="form-control focus" type="text" placeholder="Escriba el nombre del tipo documento" v-model="tipoDocumentocrear.nombre">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" @click.prevent="agregar" v-if='btncrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
                    <button type="submit" @click.prevent="editar" v-if="btnEditar" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="listado-tabla">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Fecha de Creciacón</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tipoDocumento in tiposDocumentos">
                  <td scope="row">{{tipoDocumento.id}}</td>
                  <td>{{tipoDocumento.nombre}}</td>
                  <td>{{$fecha(tipoDocumento.created_at)}}</td>
                  <td>
                    <button class="btn btn-primary btn-sm" @click="editarTipoDocumento(tipoDocumento)" type="button" v-if="$can('editar pais')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminarTipoDocumento(tipoDocumento)" type="button" v-if="$can('eliminar pais')"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    mounted(){
      this.getPais()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {
        tiposDocumentos: [],
        tipoDocumentocrear:{nombre:''},
        icono:'',
        tituloModal:'',
        btncrear:true,
        btnEditar:false,
        idTipoDocumento:''
      }
    },
    methods:{
      abrirModal(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear Tipo Documento';
        this.btnEditar=false
        this.btncrear=true
        this.tipoDocumentocrear.nombre=''
        $('#exampleModal').modal('show')
      },
      getPais(){
       const listar = axios.get('tipoDocumentos/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.tiposDocumentos = res.data
          this.$tablaGlobal()
        });
      },
      agregar(){
        axios.post('tipoDocumentos', this.tipoDocumentocrear).then((res) =>{
          this.getPais()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Tipo de documento creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editarTipoDocumento(tipoDocumento){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar Tipo de Documento'
        this.btnEditar=true
        this.btncrear=false
        this.tipoDocumentocrear.nombre = tipoDocumento.nombre
        this.idTipoDocumento = tipoDocumento.id
        $('#exampleModal').modal('show')
      },
      editar(){
        axios.put('tipoDocumentos/'+this.idTipoDocumento,this.tipoDocumentocrear).then((res)=>{
          $('#exampleModal').modal('hide')
          this.getPais()
          this.idTipoDocumento=''
          swal("Muy bien!", "Tipo de documento editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminarTipoDocumento(tipoDocumento){
        swal({
          title: "¿Está seguro de eliminar a "+tipoDocumento.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('tipoDocumentos/'+tipoDocumento.id).then((res)=>{
              this.getPais()
              swal("Eliminado", "Tipo documento "+tipoDocumento.nombre+" eliminado correctamente.", "success");
            }).catch(function (error) {
              swal("Ooohhh vaya!","No se pudo eliminar tipo documento, ya está asociado a un usuarios", "error");
            });
          }
        });
      },
    }
  }
</script>
