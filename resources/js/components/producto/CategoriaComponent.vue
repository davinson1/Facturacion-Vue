<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear categoria')">
          <i class="fas fa-plus-circle"></i> Registrar categoría
        </button>
        <h3 class="tile-title">Listado de categorías registradas</h3>
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
                    <label for="valor" class="control-label">Nombre categoría (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el nombre de la categoría" v-model="categoria.nombre" required="">
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" class="form-control" rows="3" placeholder="Agregue una descripción" v-model="categoria.descripcion"></textarea>
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
                <tr v-for="categoria in categorias">
                  <td scope="row">{{categoria.id}}</td>
                  <td>{{categoria.nombre}}</td>
                  <td>{{categoria.descripcion}}</td>
                  <td>{{$fecha(categoria.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(categoria)" type="button" v-if="$can('editar categoria')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(categoria)" type="button" v-if="$can('eliminar categoria')"><i class="fas fa-trash"></i></button>
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
      this.getCategorias()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        categorias: [],
        categoria:{nombre:'', descripcion:''},
        btnCrear:true,
        btnEditar:false,
        idCategoria:''
      }
    },
    methods:{
      limpiar(){
        this.categoria.nombre=''
        this.categoria.descripcion=''
      },
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear categoria'
        this.btnEditar=false
        this.btnCrear=true
        this.limpiar()
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar categoria'
        this.btnEditar=true
        this.btnCrear=false
        this.categoria.nombre=datos.nombre
        this.categoria.descripcion=datos.descripcion
        this.idCategoria = datos.id
        $('#exampleModal').modal('show')
      },
      getCategorias(){
       axios.get('categorias/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.categorias = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('categorias', this.categoria).then((res) =>{
          this.getCategorias()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Categoría creada correctamente.", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('categorias/'+this.idCategoria,this.categoria).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idCategoria = ''
          this.getCategorias()
          swal("Muy bien!", "Categoría editada correctamente.", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar la categoría "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('categorias/'+dato.id).then((res)=>{
              this.getCategorias()
              swal("Eliminado", "Categoría "+dato.nombre+", fue eliminada correctamente.", "success");
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