<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear tipo-factura')">
          <i class="fas fa-plus-circle"></i> Registrar tipo de factura
        </button>
        <h3 class="tile-title">Listado de tipos de facturas registradas</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i :class="icono"></i>{{tituloModal}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="valor" class="control-label">Nombre tipo de factura (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el nombre de tipo de factura" v-model="tipoFactura.nombre" required="">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" @click.prevent="crear" v-if='btnCrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
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
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Fecha creación</th>                  
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tipoFactura in tiposFacturas">
                  <td scope="row">{{tipoFactura.id}}</td>
                  <td>{{tipoFactura.nombre}}</td>
                  <td>{{$fecha(tipoFactura.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(tipoFactura)" type="button" v-if="$can('editar tipo-factura')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(tipoFactura)" type="button" v-if="$can('eliminar tipo-factura')"><i class="fas fa-trash"></i></button>
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
      this.getTipoFacturas()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        tiposFacturas: [],
        tipoFactura:{nombre:''},
        btnCrear:true,
        btnEditar:false,
        idTipoFactura:''
      }
    },
    methods:{
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear tipo de factura'
        this.btnEditar=false
        this.btnCrear=true
        this.tipoFactura.nombre=''
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar tipo de factura'
        this.btnEditar=true
        this.btnCrear=false
        this.tipoFactura.nombre = datos.nombre
        this.idTipoFactura = datos.id
        $('#exampleModal').modal('show')
      },
      getTipoFacturas(){
       axios.get('tipoFacturas/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.tiposFacturas = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('tipoFacturas', this.tipoFactura).then((res) =>{
          this.getTipoFacturas()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Tipo de factura creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('tipoFacturas/'+this.idTipoFactura,this.tipoFactura).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idTipoFactura = ''
          this.getTipoFacturas()
          swal("Muy bien!", "Tipo de factura editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar el tipo de factura "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('tipoFacturas/'+dato.id).then((res)=>{
              this.getTipoFacturas()
              swal("Eliminado", "Tipo de factura "+dato.nombre+", fue eliminada correctamente.", "success");
            }).catch(function (error) {
              var array = Object.values(error.response.data.errors);
              array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
            });
          } 
        });
      },
    }
  }
</script>