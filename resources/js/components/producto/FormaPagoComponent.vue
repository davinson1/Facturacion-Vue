<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear forma-pago')">
          <i class="fas fa-plus-circle"></i> Registrar forma de pago
        </button>
        <h3 class="tile-title">Listado de formas de pago registrados</h3>
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
                    <label for="valor" class="control-label">Nombre formas de pago (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el nombre de forma de pago" v-model="formaPago.nombre" required="">
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
                <tr v-for="formaPago in formasPagos">
                  <td scope="row">{{formaPago.id}}</td>
                  <td>{{formaPago.nombre}}</td>
                  <td>{{$fecha(formaPago.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(formaPago)" type="button" v-if="$can('editar forma-pago')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(formaPago)" type="button" v-if="$can('eliminar forma-pago')"><i class="fas fa-trash"></i></button>
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
      this.getFormaPago()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        formasPagos: [],
        formaPago:{nombre:''},
        btnCrear:true,
        btnEditar:false,
        idFormaPago:''
      }
    },
    methods:{
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear forma de pago'
        this.btnEditar=false
        this.btnCrear=true
        this.formaPago.nombre=''
        $('#exampleModal').modal('show')
      },
      modalEditar(formaPago){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar forma de pago'
        this.btnEditar=true
        this.btnCrear=false
        this.formaPago.nombre = formaPago.nombre
        this.idFormaPago = formaPago.id
        $('#exampleModal').modal('show')
      },
      getFormaPago(){
       axios.get('formaPagos/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.formasPagos = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('formaPagos', this.formaPago).then((res) =>{
          this.getFormaPago()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Forma de pago creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('formaPagos/'+this.idFormaPago,this.formaPago).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idFormaPago = ''
          this.getFormaPago()
          swal("Muy bien!", "Forma de pago editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar la forma de pago "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('formaPagos/'+dato.id).then((res)=>{
              this.getFormaPago()
              swal("Eliminado", "Forma de pago "+dato.nombre+", fue eliminada correctamente.", "success");
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