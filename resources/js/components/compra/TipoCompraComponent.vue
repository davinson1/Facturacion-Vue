<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear tipo-compra')">
          <i class="fas fa-plus-circle"></i> Registrar tipo de compra
        </button>
        <h3 class="tile-title">Listado de tipo de compras registradas</h3>
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
                    <label for="valor" class="control-label">Nombre tipo de compra (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el nombre del tipo de compra." v-model="tipoCompra.nombre" required="">
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Descripción (<span class="text-danger">*</span>)</label>
                    <textarea id="descripcion" class="form-control" rows="3" placeholder="Agregue una descripción" v-model="tipoCompra.descripcion"></textarea>
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
                  <th scope="col">Descripción</th>
                  <th scope="col">Fecha creación</th>                  
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="tipoCompra in tiposCompras">
                  <td scope="row">{{tipoCompra.id}}</td>
                  <td>{{tipoCompra.nombre}}</td>
                  <td>{{tipoCompra.descripcion}}</td>
                  <td>{{$fecha(tipoCompra.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(tipoCompra)" type="button" v-if="$can('editar tipo-compra')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(tipoCompra)" type="button" v-if="$can('eliminar tipo-compra')"><i class="fas fa-trash"></i></button>
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
      this.getTipoCompra()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        tiposCompras: [],
        tipoCompra:{nombre:'', descripcion:''},
        btnCrear:true,
        btnEditar:false,
        idTipoCompra:''
      }
    },
    methods:{
      limpiar(){
        this.tipoCompra.nombre=''
        this.tipoCompra.descripcion=''
      },
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear tipo de compra'
        this.btnEditar=false
        this.btnCrear=true
        this.limpiar()
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar tipo de compra'
        this.btnEditar=true
        this.btnCrear=false
        this.tipoCompra.nombre=datos.nombre
        this.tipoCompra.descripcion=datos.descripcion
        this.idTipoCompra = datos.id
        $('#exampleModal').modal('show')
      },
      getTipoCompra(){
       axios.get('tipoCompras/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.tiposCompras = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('tipoCompras', this.tipoCompra).then((res) =>{
          this.getTipoCompra()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Tipo de compra creada correctamente.", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('tipoCompras/'+this.idTipoCompra,this.tipoCompra).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idTipoCompra = ''
          this.getTipoCompra()
          swal("Muy bien!", "Tipo de compra editada correctamente.", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar la tipo de compra "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('tipoCompras/'+dato.id).then((res)=>{
              this.getTipoCompra()
              swal("Eliminado", "Tipo de compra "+dato.nombre+", fue eliminada correctamente.", "success");
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