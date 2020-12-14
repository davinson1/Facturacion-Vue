<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear empresa')">
          <i class="fas fa-plus-circle"></i> Registrar empresa
        </button>
        <h3 class="tile-title">Listado de empresas registradas</h3>
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
                    <div class="col-6">
                      <label for="idTipoTributario">Seleccione tipo tributario (<span class="text-danger">*</span>)</label>
                      <select id="idTipoTributario" class="form-control" required="" v-model="empresa.id_tipo_tributario">
                        <option v-for="tipoTributario in tiposTributarios" v-bind:value="tipoTributario.id" >{{ tipoTributario.nombre }}</option>
                      </select>
                    </div>
                    <div class="col-6">
                      <label for="idMunicipios">Seleccione el municipio (<span class="text-danger">*</span>)</label>
                      <select id="idMunicipios" class="form-control" required="" v-model="empresa.id_municipio">
                        <option v-for="municipio in municipios" v-bind:value="municipio.id" >{{ municipio.nombre }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="nombreEmpresa">Nombre de la empresa (<span class="text-danger">*</span>)</label>
                      <input id="nombreEmpresa" class="form-control focus" type="text" required="" v-model="empresa.nombre">
                    </div>
                    <div class="col-6">
                      <label for="numeroEmpresa">Nit (<span class="text-danger">*</span>)</label>
                      <input id="numeroEmpresa" class="form-control" type="text" required="" v-model="empresa.numero">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="direccionEmpresa">Dirección (<span class="text-danger">*</span>)</label>
                      <input id="direccionEmpresa" class="form-control" type="text" required="" v-model="empresa.direccion">
                    </div>
                    <div class="col-6">
                      <label for="telefonoEmpresa">Teléfono fijo (<span class="text-danger">*</span>)</label>
                      <input id="telefonoEmpresa" class="form-control" type="text" required="" v-model="empresa.telefono">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="celularEmpresa">Celular de la empresa (<span class="text-danger">*</span>)</label>
                      <input id="celularEmpresa" class="form-control" type="text" required="" v-model="empresa.celular">
                    </div>
                    <div class="col-6">
                      <label for="nombreJefeEmpresa">Nombre del jefe (<span class="text-danger">*</span>)</label>
                      <input id="nombreJefeEmpresa" class="form-control" type="text" required="" v-model="empresa.nombre_jefe">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="celularJefeEmpresa">Celular del jefe (<span class="text-danger">*</span>)</label>
                      <input id="celularJefeEmpresa" class="form-control" type="text" required="" v-model="empresa.celular_jefe">
                    </div>
                    <div class="col-6">
                      <label for="fechaCreadaEmpresa">Fecha de creación de la empresa (<span class="text-danger">*</span>)</label>
                      <input id="fechaCreadaEmpresa" class="form-control" type="date" required="" :max="$fechaHoy" v-model="empresa.fecha_creacion">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="descripcionEmpresa">Descripción:</label>
                    <textarea id="descripcionEmpresa" class="form-control" v-model="empresa.descripcion"></textarea>
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
                  <th scope="col">Dirección</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Jefe</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Fecha creación</th>                  
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="empresa in empresas">
                  <td scope="row">{{empresa.id}}</td>
                  <td>{{empresa.nombre}}</td>
                  <td>{{empresa.direccion}}</td>
                  <td>{{empresa.telefono}}</td>
                  <td>{{empresa.nombre_jefe}}</td>
                  <td>{{empresa.estado}}</td>
                  <td>{{$fecha(empresa.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(empresa)" type="button" v-if="$can('editar empresa')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(empresa)" type="button" v-if="$can('eliminar empresa')"><i class="fas fa-trash"></i></button>
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
      this.getEmpresas()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        empresas: [],
        tiposTributarios: [],
        municipios: [],
        empresa:{id_tipo_tributario:'', id_municipio:'', nombre:'', numero:'', direccion:'', telefono:'', celular:'', nombre_jefe:'', celular_jefe:'', fecha_creacion:''},
        btnCrear:true,
        btnEditar:false,
        idEmpresa:''
      }
    },
    methods:{
      limpiar(){
        this.empresa.nombre=''
        this.empresa.numero=''
        this.empresa.direccion=''
        this.empresa.telefono=''
        this.empresa.celular=''
        this.empresa.nombre_jefe=''
        this.empresa.celular_jefe=''
        this.empresa.fecha_creacion=''
      },
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear empresa'
        this.btnEditar=false
        this.btnCrear=true
        this.limpiar()
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar empresa'
        this.btnEditar=true
        this.btnCrear=false
        this.empresa.id_tipo_tributario=datos.id_tipo_tributario
        this.empresa.id_municipio=datos.id_municipio
        this.empresa.nombre=datos.nombre
        this.empresa.numero=datos.numero
        this.empresa.direccion=datos.direccion
        this.empresa.telefono=datos.telefono
        this.empresa.celular=datos.celular
        this.empresa.nombre_jefe=datos.nombre_jefe
        this.empresa.celular_jefe=datos.celular_jefe
        this.empresa.fecha_creacion=datos.fecha_creacion
        this.idEmpresa = datos.id
        $('#exampleModal').modal('show')
      },
      getEmpresas(){
       axios.get('empresa/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.empresas = res.data.empresa
          this.tiposTributarios = res.data.tipoTributario
          this.municipios = res.data.municipios
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('empresa', this.empresa).then((res) =>{
          this.getEmpresas()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Empresa creada correctamente.", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('empresa/'+this.idEmpresa,this.empresa).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idEmpresa = ''
          this.getEmpresas()
          swal("Muy bien!", "Empresa editada correctamente.", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar la empresa "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('empresa/'+dato.id).then((res)=>{
              this.getEmpresas()
              swal("Eliminado", "Empresa "+dato.nombre+", fue eliminada correctamente.", "success");
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