<template>  
  <div class="row user w-100 m-0">
    <div class="col-md-12">
      <div class="profile">
        <div class="info">          
          <img class="user-img" :src="this.imagenSeleccionada">
          <h4>{{this.actualizarUsuario.nombre+' '+this.actualizarUsuario.apellido}}</h4>
          <p v-for="rol in roles">{{rol.name}}</p>
        </div>
        <div class="cover-image"></div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
          <li class="nav-item"><a class="nav-link active" href="#user-datos" data-toggle="tab">Datos</a></li>
          <li class="nav-item"><a class="nav-link" href="#user-editar" data-toggle="tab">Editar</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content">
        <div class="tab-pane active" id="user-datos">
          <div class="timeline-post">              
            <div class="post-content">
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Documento</th>
                    <td>{{this.tipoDocumento.nombre+' '+this.datosUsuario.numero_documento}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Ciudad</th>
                    <td>{{this.municipio.nombre}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Dirección</th>
                    <td>{{this.datosUsuario.direccion}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Teléfono</th>
                    <td>{{this.datosUsuario.telefono}}</td>
                  </tr>
                  <tr>
                    <th scope="row">E-Mail</th>
                    <td>{{this.datosUsuario.email}}</td>                  
                  </tr>
                  <tr>
                    <th scope="row">Fecha de creación</th>
                    <td>{{$fecha(this.datosUsuario.created_at)}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="user-editar">
          <div class="tile user-settings">
            <h4 class="line-head">Actualizar perfil</h4>
            <form @submit.prevent="editar" enctype="multipart/form-data">
              <div class="row">
                <div class="col-6 mb-3 mx-auto">
                  <img :src="this.imagenSeleccionada" class="rounded mx-auto d-block" alt="Foto del usuario" height="200">
                  <div class="custom-file">
                    <label class="custom-file-label" for="customFileLang">Cambiar foto</label>
                    <input type="file" class="custom-file-input" id="customFileLang" lang="es" accept="image/png, .jpeg, .jpg, image/gif" @change="obtenerFoto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label>Nombres (<span class="text-danger">*</span>)</label>
                  <input class="form-control" type="text" v-model="actualizarUsuario.nombre" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label>Apellidos (<span class="text-danger">*</span>)</label>
                  <input class="form-control" type="text" v-model="actualizarUsuario.apellido" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label>Tipo de documento (<span class="text-danger">*</span>)</label>                    
                  <select class="form-control select2" v-model="actualizarUsuario.tipo_documento" required="">
                    <option v-for="tip_doc in tiposDocumentos" v-bind:value="tip_doc.id">{{tip_doc.nombre}}</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Número de documento (<span class="text-danger">*</span>)</label>
                  <input class="form-control" type="text" v-model="actualizarUsuario.numero_documento" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label>Municipio (<span class="text-danger">*</span>)</label>                    
                  <select class="form-control select2" v-model="actualizarUsuario.municipio" required="">
                    <option v-for="muni in municipios" v-bind:value="muni.id">{{muni.nombre}}</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label>Dirección (<span class="text-danger">*</span>)</label>
                  <input class="form-control" type="text" v-model="actualizarUsuario.direccion" required="">
                </div>                  
                <div class="col-md-6 mb-3">
                  <label>E-Mail (<span class="text-danger">*</span>)</label>
                  <input class="form-control" type="email" v-model="actualizarUsuario.email" required="">
                </div>                  
                <div class="col-md-6 mb-3">
                  <label>Teléfono (<span class="text-danger">*</span>)</label>
                  <input class="form-control" type="text" v-model="actualizarUsuario.telefono" required="">
                </div>
                <div class="col-md-6 mb-3">
                  <label>Nueva contraseña</label>
                  <input class="form-control" type="password" placeholder="Nueva contraseña." v-model="actualizarUsuario.contrasenia" name="password">
                </div>
                <div class="col-md-6 mb-3">
                  <label>Confirmar contraseña</label>
                  <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar la contraseña." v-model="actualizarUsuario.contrasenia_confirmation">
                </div>
                <!-- <div class="clearfix"></div> No se para que es esto-->
              </div>
              <div class="row mb-10">
                <div class="col-md-12">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Actualizar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    mounted(){
      this.getUsuarioDatos()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {
        imagenSeleccionada:'',
        datosUsuario: [],
        tipoDocumento: [],
        municipio: [],
        roles:[],
        tiposDocumentos: [],
        municipios: [],
        actualizarUsuario:{nombre:'',apellido:'',tipo_documento:'',numero_documento:'',municipio:'',direccion:'',email:'',foto:'',telefono:'',contrasenia:'',contrasenia_confirmation:''},
        idUsuario:''
      }
    },
    methods:{
      getUsuarioDatos(){
       axios.get('perfil/create').then(res=>{          
          this.datosUsuario = res.data.usuario[0]
          this.tipoDocumento = res.data.usuario[0].tipo_documento
          this.municipio = res.data.usuario[0].municipio
          this.roles = res.data.roles
          this.tiposDocumentos = res.data.documentos
          this.municipios = res.data.municipios
          this.idUsuario = res.data.usuario[0].id

          //Asignar los valores a los campos
          this.actualizarUsuario.nombre = this.datosUsuario.name
          this.actualizarUsuario.apellido = this.datosUsuario.apellido
          this.actualizarUsuario.tipo_documento = this.datosUsuario.id_tipo_documento
          this.actualizarUsuario.numero_documento = this.datosUsuario.numero_documento
          this.actualizarUsuario.municipio = this.datosUsuario.id_municipio
          this.actualizarUsuario.direccion = this.datosUsuario.direccion
          this.actualizarUsuario.email = this.datosUsuario.email
          this.imagenSeleccionada = this.datosUsuario.foto
          this.actualizarUsuario.telefono = this.datosUsuario.telefono
        });
      },
      obtenerFoto(img){
        let file = img.target.files[0]
        this.actualizarUsuario.foto = file
        let reader = new FileReader()
        reader.onload = (e) => {
          this.imagenSeleccionada = e.target.result
        }
        reader.readAsDataURL(file)
      },
      editar(){
        let formData = new FormData();
        formData.append('_method', 'PUT')
        formData.append('nombre',this.actualizarUsuario.nombre)
        formData.append('apellido',this.actualizarUsuario.apellido)
        formData.append('tipo_documento',this.actualizarUsuario.tipo_documento)
        formData.append('numero_documento',this.actualizarUsuario.numero_documento)
        formData.append('municipio',this.actualizarUsuario.municipio)
        formData.append('direccion',this.actualizarUsuario.direccion)
        formData.append('email',this.actualizarUsuario.email)
        formData.append('imagen',this.actualizarUsuario.foto)
        formData.append('telefono',this.actualizarUsuario.telefono)
        formData.append('contrasenia',this.actualizarUsuario.contrasenia)

        axios.post('perfil/'+this.idUsuario,formData).then((res)=>{
          this.actualizarUsuario.password = ''
          this.actualizarUsuario.password_confirmation = ''
          this.getUsuarioDatos()
          swal("Muy bien!", "Perfil de usuario editado correctamente.", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      }
    }
  }
</script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                