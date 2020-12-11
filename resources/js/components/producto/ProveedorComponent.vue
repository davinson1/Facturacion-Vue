<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear proveedor')">
          <i class="fas fa-plus-circle"></i> Registrar proveedor
        </button>
        <h3 class="tile-title">Listado de proveedores registrados</h3>
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
                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="idEmpresa">Empresa (<span class="text-danger">*</span>)</label>
                      <select id="idEmpresa" class="form-control" v-model="proveedor.id_empresa" required="">
                        <option v-for="empresa in empresas" v-bind:value="empresa.id" >{{ empresa.nombre }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="nombre">Nombre (<span class="text-danger">*</span>)</label>
                      <input id="nombre" class="form-control focus" type="text" placeholder="Nombre del proveedor" v-model="proveedor.nombre" required="">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="telefono">Teléfono</label>
                      <input id="telefono" class="form-control" type="number" placeholder="Teléfono del proveedor" v-model="proveedor.telefono">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="descripcion">Descripción del proveedor</label>
                      <textarea id="descripcion" class="form-control" rows="3" placeholder="Agregue una especificación" v-model="proveedor.descripcion"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3" v-if="estado">
                    <div class="col-12 text-center">
                      <label>Estado del proveedor</label>
                      <div class="toggle-flip mr-2">
                        <label class="toggle-flip m-0">
                        <input type="checkbox" v-model="proveedor.estado"><span class="flip-indecator" data-toggle-on="Activo" data-toggle-off="Inactivo"></span>
                        </label>
                      </div>
                    </div>
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
                  <th scope="col">Empresa</th>
                  <th scope="col">Creado por</th>
                  <th scope="col">Modificado por</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Fecha creación</th>                  
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="proveedor in proveedores">
                  <td scope="row">{{proveedor.id}}</td>
                  <td>{{proveedor.empresa.nombre}}</td>
                  <td>{{proveedor.usuario.name}}</td>
                  <td v-if="proveedor.id_usuario_modifica === null"> Sin modificar</td>
                  <td v-else="proveedor.id_usuario_modifica">{{proveedor.usuario_modifica.name}}</td>
                  <td>{{proveedor.nombre}}</td>
                  <td>{{proveedor.telefono}}</td>
                  <td>{{proveedor.descripcion}}</td>
                  <td>
                    <span class="badge badge-success" v-if="proveedor.estado === 1">Activo</span>
                    <span class="badge badge-danger" v-if="proveedor.estado === 0">Inactivo</span>
                  </td>
                  <td>{{$fecha(proveedor.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(proveedor)" type="button" v-if="$can('editar proveedor')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(proveedor)" type="button" v-if="$can('eliminar proveedor')"><i class="fas fa-trash"></i></button>
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
      this.getProveedores()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        proveedores: [],
        empresas: [],
        estado: false,
        proveedor:{id_empresa:'', nombre:'', telefono:'', descripcion:'', estado:{}},
        btnCrear:true,
        btnEditar:false,
        idProveddor:''
      }
    },
    methods:{
      limpiar(){
        this.proveedor.id_empresa=''
        this.proveedor.nombre=''
        this.proveedor.telefono=''
        this.proveedor.descripcion=''
        this.proveedor.estado=''
      },
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear proveedor'
        this.estado=false
        this.btnEditar=false
        this.btnCrear=true
        this.limpiar()
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar proveedor'
        this.estado=true
        this.btnEditar=true
        this.btnCrear=false
        this.proveedor.id_empresa = datos.id_empresa
        this.proveedor.nombre = datos.nombre
        this.proveedor.telefono = datos.telefono
        this.proveedor.descripcion = datos.descripcion
        this.proveedor.estado = datos.estado
        this.idProveddor = datos.id
        $('#exampleModal').modal('show')
      },
      getProveedores(){
       axios.get('proveedores/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.proveedores = res.data.proveedor
          this.empresas = res.data.empresa
          console.log(this.proveedores)
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('proveedores', this.proveedor).then((res) =>{
          this.getProveedores()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Proveedor creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('proveedores/'+this.idProveddor,this.proveedor).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idProveddor = ''
          this.getProveedores()
          swal("Muy bien!", "Proveedor editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar el Proveedor "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('proveedores/'+dato.id).then((res)=>{
              this.getProveedores()
              swal("Eliminado", "Proveedor "+dato.nombre+", fue eliminado correctamente.", "success");
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