<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear tipo-tributario')">
          <i class="fas fa-plus-circle"></i> Registrar tipo tributario
        </button>
        <h3 class="tile-title">Listado de tipos tributarios registrados</h3>
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
                    <label for="valor" class="control-label">Nombre tipo tributario (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el nombre de tipo tributario" v-model="tipoTributario.nombre" required="">
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
                <tr v-for="tipoTributario in tiposTributarios">
                  <td scope="row">{{tipoTributario.id}}</td>
                  <td>{{tipoTributario.nombre}}</td>
                  <td>{{$fecha(tipoTributario.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(tipoTributario)" type="button" v-if="$can('editar tipo-tributario')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(tipoTributario)" type="button" v-if="$can('eliminar tipo-tributario')"><i class="fas fa-trash"></i></button>
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
      this.getTipoTributarios()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        tiposTributarios: [],
        tipoTributario:{nombre:''},
        btnCrear:true,
        btnEditar:false,
        idTipoTributario:''
      }
    },
    methods:{
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear tipo tributario'
        this.btnEditar=false
        this.btnCrear=true
        this.tipoTributario.nombre=''
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar tipo tributario'
        this.btnEditar=true
        this.btnCrear=false
        this.tipoTributario.nombre = datos.nombre
        this.idTipoTributario = datos.id
        $('#exampleModal').modal('show')
      },
      getTipoTributarios(){
       axios.get('tipoTributarios/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.tiposTributarios = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('tipoTributarios', this.tipoTributario).then((res) =>{
          this.getTipoTributarios()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Tipo tributario creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('tipoTributarios/'+this.idTipoTributario,this.tipoTributario).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idTipoTributario = ''
          this.getTipoTributarios()
          swal("Muy bien!", "Tipo tributario editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar el tipo tributario "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('tipoTributarios/'+dato.id).then((res)=>{
              this.getTipoTributarios()
              swal("Eliminado", "Tipo tributario "+dato.nombre+", fue eliminado correctamente.", "success");
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