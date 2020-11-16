<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" @click="abrirModal">
          <i class="fas fa-plus-circle"></i> Registrar País
        </button>
        <h3 class="tile-title">Listado de países registrados</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary">
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
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="pais in paises">
                  <td>{{pais.id}}</td>
                  <td>{{pais.nombre}}</td>
                  <td>{{pais.updated_at}}</td>
                  <td>
                    <button class="btn btn-primary btn-sm"  @click="editarPais(pais)" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminarpais(pais)" type="button"><i class="fas fa-trash"></i></button>
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
  var id_pais = ''
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
        btnEditar:false
      }
    },
    methods:{
      abrirModal(){
        this.titulomodal=' Crear País';
        this.btnEditar=false
        this.btncrear=true
        this.paiscrear.nombre=''
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
            $('#exampleModal').hide()
            $('#exampleModal').modal('hide')
            $('.modal-backdrop').hide()
            swal("Muy bien!", "País creado correctamente", "success")
          }).catch(function (error) {
              console.log(error.response.data.errors.nombre)
              swal("Ooohhh vaya!", ""+error.response.data.errors.nombre,"error")
          });  
      },
      editarPais(pais){
        this.titulomodal=' Editar País'
        this.btnEditar=true
        this.btncrear=false
        this.paiscrear.nombre = pais.nombre
        id_pais = pais.id
      },
      editar(){
        axios.put('paises/'+id_pais,this.paiscrear).then((res)=>{
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          this.getPais()
          swal("Muy bien!", "País editado correctamente", "success")
        }).catch(function (error) {
            console.log(error)
        });
      },
      eliminarpais(pais){
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
