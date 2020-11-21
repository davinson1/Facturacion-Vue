<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="abrirModal" v-if="$can('crear pais')">
          <i class="fas fa-plus-circle"></i> Registrar País
        </button>
        <h3 class="tile-title">Listado de países registrados</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle fa-lg" ></i>{{titulomodal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form >
                  <div class="form-group">
                    <label for="nombre" class="control-label">Nombre del país</label>
                    <input id="nombre" class="form-control focus" type="text" placeholder="Escriba el nombre del país" v-model="paiscrear.nombre">
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
                  <th scope="col">Fecha</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="pais in paises">
                  <td scope="row">{{pais.id}}</td>
                  <td>{{pais.nombre}}</td>
                  <td>{{$fecha(pais.created_at)}}</td>
                  <td>
                    <button class="btn btn-primary btn-sm" @click="editarPais(pais)" type="button" v-if="$can('editar pais')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminarPais(pais)" type="button" v-if="$can('eliminar pais')"><i class="fas fa-trash"></i></button>
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
        paises: [],
        paiscrear:{nombre:''},
        titulomodal:'',
        btncrear:true,
        btnEditar:false,
        idPais:''
      }
    },
    methods:{
      abrirModal(){
        this.titulomodal=' Crear País';
        this.btnEditar=false
        this.btncrear=true
        this.paiscrear.nombre=''
        $('#exampleModal').modal('show')
      },
      getPais(){
       const listar = axios.get('paises/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.paises = res.data
          this.$tablaGlobal()
        });
      },
      agregar(){
        axios.post('paises', this.paiscrear).then((res) =>{
          this.getPais()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "País creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });  
      },
      editarPais(pais){
        this.titulomodal=' Editar País'
        this.btnEditar=true
        this.btncrear=false
        this.paiscrear.nombre = pais.nombre
        this.idPais = pais.id
        $('#exampleModal').modal('show')
      },
      editar(){
        axios.put('paises/'+this.idPais,this.paiscrear).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.getPais()
          swal("Muy bien!", "País editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminarPais(pais){
        swal({
          title: "¿Está seguro de eliminar a "+pais.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('paises/'+pais.id).then((res)=>{
              this.getPais()
              swal("Eliminado", "País "+pais.nombre+" eliminado correctamente.", "success");
            }).catch(function (error) {
              swal("Ooohhh vaya!","No se pudo eliminar el país, ya está asociado a un departamento.", "error");
            });
          } 
        });
      },
    }
  }
</script>
