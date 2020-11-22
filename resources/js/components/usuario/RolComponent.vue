<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
      <!-- v-if="$can('crear rol')" -->

        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg" @click="modalCrear">
        <i class="fas fa-plus-circle"></i> Registrar rol
        </button>

        <h3 class="tile-title">Listado de roles registrados</h3>
        <!-- Modal registrar-->
        <div class="modal fade bd-example-modal-lg" id="modalForm">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle fa-lg" ></i>{{tituloModal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="nombre" class="control-label">Nombre del rol (*)</label>
                    <input id="nombre" class="form-control focus" type="text" placeholder="Escriba el nombre del Rol" v-model="rolCrear.nombre">
                  </div>
                  <h5>Permisos por módulos:</h5>
                  <div class="card m-0" v-for="categoria in categorias">
                    <div class="card-header border-0">
                      <div class="row row-cols-2">
                        <div class="col">
                          <b>Permisos de {{categoria.categoria}}:</b>
                        </div>
                        <div class="col">
                          <a class="float-right" data-toggle="collapse" :href="'#collapse-'+categoria.categoria" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fas fa-plus-circle fa-2x" aria-hidden="true"></i>
                          </a>
                          <div class="toggle-flip float-right mr-2">
                            <label class="toggle-flip float-right m-0">
                              <input type="checkbox" v-model="selectAll" @click="select(categoria.categoria)"><span class="flip-indecator" data-toggle-on="Todos" data-toggle-off="No"></span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="collapse" :id="'collapse-'+categoria.categoria">
                      <div class="card card-body">
                        <div class="toggle-flip">
                          <div class="row row-cols-2" v-for="permiso in permisos" v-if="permiso.categoria === categoria.categoria">
                            <div class="col">
                              <p>{{permiso.name}}</p>
                            </div>
                            <div class="col">
                              <label class="toggle-flip float-right m-0">
                                <input type="checkbox" :value="permiso.id" v-model="selected"><span class="flip-indecator" data-toggle-on="Sí" data-toggle-off="No"></span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" @click.prevent="agregar" v-if='btnCrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
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
                <tr v-for="rol in roles">
                  <td scope="row">{{rol.id}}</td>
                  <td>{{rol.name}}</td>
                  <td>{{$fecha(rol.created_at)}}</td>
                  <td>
                    <button class="btn btn-primary btn-sm" @click="editarRol(rol)" type="button" v-if="$can('editar rol')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminarRol(rol)" type="button" v-if="$can('eliminar rol')"><i class="fas fa-trash"></i></button>
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
      this.getRol()
      $('#modalForm').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {
        roles: [],
        permisos: [],
        categorias: [],
        rolCrear:{nombre:''},
        tituloModal:'',
        btnCrear:true,
        btnEditar:false,
        idRol:'',
        selected: [],
        selectAll: false
      }
    },
    methods:{
      select(catego) {
        this.selected = [];
        if (!this.selectAll)
        {
          for (let i in this.permisos)
          {
            this.selected.push(this.permisos[i].id);
          }          
        }
      },
      modalCrear(){
        this.tituloModal=' Crear Rol';
        this.btnEditar=false
        this.btnCrear=true
        this.rolCrear.nombre=''
        $('#modalForm').modal('show')
      },
      getRol(){
       const listar = axios.get('roles/create').then(res=>{
          this.roles = res.data.roles
          this.permisos = res.data.permisos
          this.categorias = res.data.categorias
          this.$tablaGlobal()
        });
      },
      agregar(){
        axios.post('Roles', this.rolCrear).then((res) =>{
          this.getRol()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Rol creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editarRol(Rol){
        this.tituloModal=' Editar Rol'
        this.btnEditar=true
        this.btnCrear=false
        this.rolCrear.nombre = Rol.nombre
        this.idRol = Rol.id
        $('#exampleModal').modal('show')
      },
      editar(){
        axios.put('Roles/'+this.idRol,this.rolCrear).then((res)=>{
          $('#exampleModal').modal('hide')
          this.getRol()
          swal("Muy bien!", "Rol editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminarRol(Rol){
        swal({
          title: "¿Está seguro de eliminar a "+Rol.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('Roles/'+Rol.id).then((res)=>{
              this.getRol()
              swal("Eliminado", "Rol "+Rol.nombre+" eliminado correctamente.", "success");
            }).catch(function (error) {
              swal("Ooohhh vaya!","No se pudo eliminar el Rol, ya está asociado a un departamento.", "error");
            });
          }
        });
      },
    }
  }
</script>
