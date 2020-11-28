<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg" @click="abirimodal">
        <i class="fas fa-plus-circle" v-if="$can('crear pais')"></i> Registrar Usuarios
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
                <form @submit.prevent="agregar" enctype="multipart/form-data">
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
                      <label for="nombreUsusario">Nombre del usuario (*)</label>
                      <input id="nombreUsusario" v-model="crearusuarios.nombre" class="form-control" type="text" name="nombreUsusario" required="">
                    </div>
                    <div class="col-6">
                      <label for="apellidoUsusario">Apellido del usuario (*)</label>
                      <input id="apellidoUsusario" v-model="crearusuarios.apellido"  class="form-control" type="text" name="apellidoUsusario" required="" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="documentoUsusario">Número de documento (*)</label>
                      <input id="documentoUsusario" v-model="crearusuarios.documento"  class="form-control" type="number" name="documentoUsusario" required="">
                    </div>
                    <div class="col-6">
                      <label for="direccionUsusario">Dirección</label>
                      <input id="direccionUsusario" v-model="crearusuarios.direccion"  class="form-control" type="text" name="direccionUsusario">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="emailUsusario">Correo electrónico (*)</label>
                      <input id="emailUsusario" v-model="crearusuarios.email" class="form-control" type="email" name="emailUsusario" required="">
                    </div>
                    <div class="col-6">
                      <label for="fotoUsuario">Foto del usuario</label>
                      <input id="fotoUsuario" @change="fotoUsuario" class="form-control" type="file" name="fotoUsuario" accept="image/png, .jpeg, .jpg, image/gif" >
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="copiaDocumento">Copia de documento</label>
                      <input id="copiaDocumento"  accept="application/pdf" @change="documentoUsuario" class="form-control" type="file" name="copiaDocumento">
                    </div>
                    <div class="col-6">
                      <label for="claveUsusario">Contraseña (*)</label>
                      <input id="claveUsusario" v-model="crearusuarios.contrasena" class="form-control" type="password" name="claveUsusario" required="">
                    </div>
                  </div>





                    <h5>Roles:</h5>
                      <label v-for="rol in roles">
                        <input type="checkbox" @change="rolesu" v-model="crearusuarios.rol">
                        <span class="label-text">{{rol.name}}</span>
                      </label>


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
	                  <button class="btn btn-primary btn-sm"  @click="editarDepartamento(item)" type="button" v-if="$can('editar departamento')"><i class="fas fa-edit"></i></button>
	                  <button class="btn btn-danger btn-sm" @click="eliminarDepartamento(item)" type="button" v-if="$can('eliminar departamento')"><i class="fas fa-trash"></i></button>
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
        crearusuarios:{idtipoDocumento:'1',idMunicipio:'1',nombre:'',apellido:'',
        documento:'',direccion:'',email:'',foto:'',copiaDocumento:'',contrasena:'',rol:[]},
        tituloModal:'',
        btnCrear:true,
        btnEditar:false,
        idDepartamento:'',
      }
    },
    methods:{
      fotoUsuario(e){
          let foto = e.target.files[0]
          this.crearusuarios.foto = foto;
          console.log(foto)
      },
      rolesu(e){
        let rol = this.crearusuarios.rol = rol
        console.log(rol)
      },
      documentoUsuario(e){
          let documento = e.target.files[0]
          this.crearusuarios.copiasDocumento = documento;
          console.log(documento)
      },
      abirimodal(){
        this.tituloModal=' Crear Usuarios'
        this.btnEditar=false
        this.btnCrear=true
        this.crearusuarios.nombre=''
        $('#exampleModal').modal('show')
        console.log(this.crearusuarios.rol)
      },
      getUsuarios(){
       axios.get('usuarios/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.usuarios = res.data.usuarios
          this.tiposDocumentos = res.data.tiposDocumentos
          this.municipios = res.data.municipios
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
        let foto = formData.append('foto',this.crearusuarios.foto)
        formData.append('copiaDocumento',this.crearusuarios.copiaDocumento)
        formData.append('contrasena',this.crearusuarios.contrasena)
        formData.append('rol',this.crearusuarios.rol)
        axios.post('usuarios', formData).then((res) =>{
          this.getUsuarios()
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          swal("Muy bien!", "Usuario creado correctamente", "success")
          // this.crearDepartamento.selected='1'
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      editarDepartamento(item){
        this.tituloModal=' Editar País'
        this.btnEditar=true
        this.btnCrear=false
        this.crearDepartamento.idPais = item.pais.id
        this.crearDepartamento.nombre = item.nombre
        this.idDepartamento = item.id
        $('#exampleModal').modal('show')
      },
      editar(){
        axios.put('departamentos/'+this.idDepartamento,this.crearDepartamento).then((res)=>{
          this.getUsuarios()
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          swal("Muy bien!", "Departamento editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminarDepartamento(item){
	      swal({
          title: "¿Está seguro de eliminar a "+item.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
          	axios.delete('departamentos/'+item.id).then((res)=>{
	            this.getUsuarios()
	            swal("Eliminado", "País "+item.nombre+" eliminado correctamente.", "success");
		        }).catch(function (error) {
		          swal("Ooohhh vaya!","No se pudo eliminar el departamento, ya está asociado a un municipio.", "error");
		        });
	        }
	      });
	    },
    }
  }
</script>
