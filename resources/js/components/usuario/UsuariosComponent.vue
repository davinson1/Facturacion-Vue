<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="abiriModal">
        <i class="fas fa-plus-circle" v-if="$can('crear usuario')"></i> Registrar Usuarios
        </button>
        <h3 class="tile-title"> Listado de Usuarios</h3>
        <!-- Modal registrar-->
        <div class="modal fade bd-example-modal-lg" id="exampleModal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle fa-lg" ></i>{{tituloModal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="agregar" enctype="multipart/form-data" >
                  <div class="text-center" v-if="imagenUsuario">
                    <img class="rounded mb-3" :src="this.imagenUsuario" style="width: 200px; height: 200px;">
                  </div>
                  <div class="form-group">
                   <div class="row mb-3">
                    <div class="col-6">
                      <label for="nombreUsusario">Seleccione tipo de documento (*)</label>
                      <select  v-model="crearusuarios.idtipoDocumento" class="form-control">
                      <option v-for="tipoDocumento in tiposDocumentos" v-bind:value="tipoDocumento.id" >{{ tipoDocumento.nombre }}</option>
                      </select>
                    </div>
                    <div class="col-6">
                      <label for="apellidoUsusario">Seleccione el municipio (*)</label>
                      <select  v-model="crearusuarios.idMunicipio" class="form-control">
                     <option v-for="municipio in municipios" v-bind:value="municipio.id" >{{ municipio.nombre }}</option>
                    </select>
                   </div>
                  </div>

                    <div class="row mb-3">
                    <div class="col-6">
                      <label>Nombres del usuario (*)</label>
                      <input v-model="crearusuarios.nombre" class="form-control" type="text" placeholder="Escriba los nombres completos" required="">
                    </div>
                    <div class="col-6">
                      <label>Apellido del usuario (*)</label>
                      <input v-model="crearusuarios.apellido"  class="form-control" type="text" placeholder="Escriba los apellidos" required="" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="documentoUsusario">Número de documento (*)</label>
                      <input id="documentoUsusario" v-model="crearusuarios.documento"  class="form-control" type="number" placeholder="Escriba el número de documento" required="">
                    </div>
                    <div class="col-6">
                      <label for="direccionUsusario">Dirección</label>
                      <input id="direccionUsusario" v-model="crearusuarios.direccion"  class="form-control" type="text" placeholder="Escriba la dirreción">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="emailUsusario">Correo electrónico (*)</label>
                      <input id="emailUsusario" v-model="crearusuarios.email" class="form-control" type="email" placeholder="Escriba el correo electronico" required="">
                    </div>
                    <div class="col-6">
                      <label>Teléfono Móvil</label>
                      <input v-model="crearusuarios.telefono" class="form-control" type="number" placeholder="Escriba el numero telefonico">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="copiaDocumento">Copia de documento</label>
                      <input id="copiaDocumento"  accept="application/pdf" @change="documentoUsuario" class="form-control" type="file" ref="documentoFile">
                      <small class="form-text text-muted" v-if="copia"><a :href="this.copia" target="_black">Ver Archivo <i class="fas fa-external-link-alt"></i></a></small>
                    </div>
                    <div class="col-6">
                      <label for="claveUsusario">Contraseña (*)</label>
                      <input id="claveUsusario" v-model="crearusuarios.contrasena" class="form-control" type="password" placeholder="Escriba la contraseña del usuario" required="">
                    </div>
                  </div>

                    <h5>Roles:</h5>

                  <div class="animated-checkbox">
                      <label v-for="rol in roles">
                        <input type="checkbox" v-model="arrayRoles" :value="rol.id">
                        <span class="label-text">{{rol.name}}</span>
                      </label>
                  </div>

                  </div>


                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" v-if='btnCrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
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
	                <th>No. Documento</th>
	                <th>Email</th>
	                <th>Direccion</th>
	                <th>Fecha de Creación</th>
	                <th>Acciones</th>
                  <th>rol</th>
	              </tr>
	            </thead>
	            <tbody>
	              <tr v-for="item in usuarios">
	                <td>{{item.id}}</td>
	                <td>{{item.name}} {{item.apellido}}</td>
	                <td>{{item.numero_documento}}</td>
	                <td>{{item.email}}</td>
	                <td>{{item.direccion}}</td>
	                <td>{{$fecha(item.created_at)}}</td>
	                <td>
	                  <button class="btn btn-primary btn-sm"  @click="editarUsuarios(item)" type="button" v-if="$can('editar usuario')"><i class="fas fa-edit"></i></button>
	                  <button class="btn btn-danger btn-sm" @click="eliminarUsuario(item)" type="button" v-if="$can('eliminar usuario')"><i class="fas fa-trash"></i></button>
	                </td>
                  <td ><p v-for="rol in item.roles">{{rol.name}}</p></td>
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
      this.getUsuarios()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {
        usuarios: [],
        tiposDocumentos: [],
        municipios: [],
        roles:[],
<<<<<<< HEAD
        crearusuarios:{idtipoDocumento:'',idMunicipio:'',nombre:'',apellido:'',
        documento:'',direccion:'',email:'',copiasDocumento:'',contrasena:''},
=======
        crearusuarios:{idtipoDocumento:'1',idMunicipio:'1',nombre:'',apellido:'',
        documento:'',direccion:'',email:'',telefono:'',copiasDocumento:'',contrasena:''},
>>>>>>> 42e1b5ee9ba64d4b67daca6e20da430c0d68ad4d
        arrayRoles:[],
        tituloModal:'',
        btnCrear:true,
        btnEditar:false,
        idMunicipio:'',
        idUsuarios:'',
        rolesUsuario:'',
        copia:'',
        imagenUsuario:'',
      }
    },
    methods:{
      documentoUsuario(e){
          let documento = e.target.files[0]
          this.crearusuarios.copiasDocumento = documento
      },
      abiriModal(){
        this.tituloModal=' Crear Usuarios'
        this.btnEditar=false
        this.btnCrear=true
        this.crearusuarios.nombre=''
        this.copia = false
        this.imagenUsuario = false
        this.limpiarCampos()
        $('#exampleModal').modal('show')
      },
      getUsuarios(){
       axios.get('usuarios/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.usuarios = res.data.usuarios
          this.tiposDocumentos = res.data.tiposDocumentos
          this.crearusuarios.idtipoDocumento = res.data.tiposDocumentos[0].id

          this.municipios = res.data.municipios
          this.crearusuarios.idMunicipio = res.data.municipios[0].id

          this.roles = res.data.roles
          this.$tablaGlobal()
        });
      },
      agregar(){
        let formData = new FormData();
        formData.append('idTipoDocumento',this.crearusuarios.idtipoDocumento)
        formData.append('idMunicipio',this.crearusuarios.idMunicipio)
        formData.append('nombre',this.crearusuarios.nombre)
        formData.append('apellido',this.crearusuarios.apellido)
        formData.append('documento',this.crearusuarios.documento)
        formData.append('direccion',this.crearusuarios.direccion)
        formData.append('email',this.crearusuarios.email)
        formData.append('telefono',this.crearusuarios.telefono)
        formData.append('copiaDocumento',this.crearusuarios.copiasDocumento)
        formData.append('contrasena',this.crearusuarios.contrasena)
        formData.append('rol',this.arrayRoles)
        let size = this.crearusuarios.copiasDocumento.size
      if (size > 3000000){
          swal("Ohhh vaya!", "El campo Copia de Documento, no puede superar el peso de 3MB", "warning");
          }
        else {
        axios.post('usuarios',formData).then((res) =>{
          this.getUsuarios()
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()

          swal("Muy bien!", "Usuario creado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });}
      },

      limpiarCampos(){
        this.crearusuarios.nombre=''
        this.crearusuarios.apellido=''
        this.crearusuarios.documento=''
        this.crearusuarios.direccion=''
        this.crearusuarios.email=''
        this.crearusuarios.telefono=''
        this.crearusuarios.copiasDocumento=''
        this.crearusuarios.contrasena=''
        this.arrayRoles=[]
      },

      editarUsuario(item){
        this.tituloModal=' Editar Usuarios'
        this.btnEditar=true
        this.btnCrear=false
        this.copia = true
        this.$refs.documentoFile.value=''
        this.idUsuarios = item.id
        this.crearusuarios.idtipoDocumento = item.tipo_documento.id
        this.crearusuarios.idMunicipio = item.id_municipio
        this.crearusuarios.nombre = item.name
        this.crearusuarios.apellido = item.apellido
        this.crearusuarios.documento = item.numero_documento
        this.crearusuarios.direccion = item.direccion
        this.crearusuarios.email = item.email
        this.crearusuarios.telefono = item.telefono
        this.copia = item.copia_documento
        this.imagenUsuario = item.foto
        this.arrayRoles = []
        $('#exampleModal').modal('show')
        for(let r in item.roles){
          this.arrayRoles.push(item.roles[r].id)
          }
      },
      editar(){
        let formData = new FormData();
        formData.append('_method', 'PUT')
        formData.append('idUsuario',this.idUsuarios)
        formData.append('idTipoDocumento',this.crearusuarios.idtipoDocumento)
        formData.append('idMunicipio',this.crearusuarios.idMunicipio)
        formData.append('nombre',this.crearusuarios.nombre)
        formData.append('apellido',this.crearusuarios.apellido)
        formData.append('documento',this.crearusuarios.documento)
        formData.append('direccion',this.crearusuarios.direccion)
        formData.append('email',this.crearusuarios.email)
        formData.append('telefono',this.crearusuarios.telefono)
        formData.append('copiaDocumento',this.crearusuarios.copiasDocumento)
        formData.append('contrasena',this.crearusuarios.contrasena)
        formData.append('rol',this.arrayRoles)
        let size = this.crearusuarios.copiasDocumento.size
      if (size > 3000000){
          swal("Ohhh vaya!", "El campo Copia de Documento, no puede superar el peso de 3MB", "warning");
          }
        else {
        axios.post('usuarios/'+this.idUsuarios,formData).then((res) =>{
          this.getUsuarios()
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          swal("Muy bien!", "Usuario Editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });}
      },

      eliminarUsuario(item){
	      swal({
          title: "¿Está seguro de eliminar a "+item.name+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
          	axios.delete('usuarios/'+item.id).then((res)=>{
	            this.getUsuarios()
	            swal("Eliminado", "usurio "+item.name+" eliminado correctamente.", "success");
		        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));		        });
	        }
	      });
	    },
    }
  }
</script>
