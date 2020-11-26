<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg" @click="modalCrear" v-if="$can('crear rol')">
        <i class="fas fa-plus-circle"></i> Registrar rol
        </button>

        <h3 class="tile-title">Listado de roles registrados</h3>
        <!-- Modal registrar-->
        <div class="modal fade bd-example-modal-lg" id="modalForm">
          <div class="modal-dialog" role="document">
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
                    <input id="nombre" class="form-control focus" type="text" placeholder="Escriba el nombre del Rol" v-model="nombre">
                  </div>
                  <h5>Permisos por módulos:</h5>
                  <!-- Permisos con categorias ensayo -->
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
                              <input type="checkbox" v-model="selectAll[categoria.categoria]" @click="seleccionarTodo(categoria.categoria)"><span class="flip-indecator" data-toggle-on="Todos" data-toggle-off="No"></span>
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
                                <input type="checkbox" :value="permiso.id" v-model="seleccionPermisos[permiso.categoria]" @click="marcar(permiso)"><span class="flip-indecator" data-toggle-on="Sí" data-toggle-off="No"></span>
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
            <table class="table table-hover table-striped text-center" id="listado-tabla">
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
                    <button class="btn btn-primary btn-sm" @click="modalEditar(rol)" type="button" v-if="$can('editar rol')"><i class="fas fa-edit"></i></button>
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
        nombre:'',
        tituloModal:'',
        btnCrear:true,
        btnEditar:false,
        idRol:'',
        seleccionPermisos: [],
        selectAll: [],
        seleccionFinal:[]
      }
    },
    methods:{
      seleccionarTodo(catego) {
        this.seleccionPermisos[catego] = [];
        if (!this.selectAll[catego])
        {
          for (let i in this.permisos)
          {
            if (this.permisos[i].categoria == catego)
            {
              this.seleccionPermisos[catego].push(this.permisos[i].id)
            }
          }
        }
      },
      marcar(permiso){
        if (this.seleccionPermisos[permiso.categoria] == null)
        {
          this.seleccionPermisos[permiso.categoria] = []
        }
      },
      getRol(){
       const listar = axios.get('roles/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.roles = res.data.roles
          this.permisos = res.data.permisos
          this.categorias = res.data.categorias
          this.$tablaGlobal()
        });
      },
      modalCrear(){
        for (let c in this.categorias) {
          $('#collapse-'+this.categorias[c].categoria).collapse('hide')          
        }
        this.tituloModal=' Crear rol';
        this.btnEditar=false
        this.btnCrear=true
        this.nombre=''
        $('#modalForm').modal('show')
      },
      modalEditar(rol){
        for (let c in this.categorias) {
          $('#collapse-'+this.categorias[c].categoria).collapse('hide')          
        }
        axios.get('roles/'+rol.id+'/edit').then((res) =>{
          this.tituloModal=' Editar rol'
          this.btnEditar=true
          this.btnCrear=false
          this.nombre = rol.name
          this.idRol = rol.id
          for (let a in this.categorias)
          {
            this.seleccionPermisos[this.categorias[a].categoria] = []
          }
          for (let i in res.data)
          {
            if (res.data[i].categoria == res.data[i].categoria)
            {
              this.seleccionPermisos[res.data[i].categoria].push(res.data[i].id)
            }
          }
          $('#modalForm').modal('show')
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      agregar(){
        var totalSeleccion = this.seleccionFinal.concat(this.seleccionPermisos['ubicación'],this.seleccionPermisos['usuarios'],this.seleccionPermisos['compras'],this.seleccionPermisos['datos-empresa'],this.seleccionPermisos['inicio'],this.seleccionPermisos['productos'])
        
        axios.post('roles', {'nombre':this.nombre, 'permisos':totalSeleccion}).then((res) =>{          
          this.getRol()
          $('#modalForm').modal('hide')
          swal("Muy bien!", "Rol creado correctamente", "success")
        }).catch(function (error) {
          $('#modalForm').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        var totalSeleccion = this.seleccionFinal.concat(this.seleccionPermisos['ubicación'],this.seleccionPermisos['usuarios'],this.seleccionPermisos['compras'],this.seleccionPermisos['datos-empresa'],this.seleccionPermisos['inicio'],this.seleccionPermisos['productos'])
        axios.put('roles/'+this.idRol,{'nombre':this.nombre, 'permisos':totalSeleccionEditada}).then((res)=>{
          this.idRol=''
          $('#modalForm').modal('hide')
          this.getRol()
          swal("Muy bien!", "Rol editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminarRol(rol){
        swal({
          title: "¿Está seguro de eliminar el rol "+rol.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('roles/'+rol.id).then((res)=>{
              this.getRol()
              swal("Eliminado", "Rol "+rol.name+" eliminado correctamente.", "success");
            }).catch(function (error) {
              swal("Ooohhh vaya!","No se pudo eliminar el rol "+rol.name+", ya está asociado a un departamento.", "error");
            });
          }
        });
      },
    }
  }
</script>
