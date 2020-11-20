<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="abirimodal" v-if="can('crear departamento')">
          <i class="fas fa-plus-circle"></i> Registrar Departamento
        </button>
        <h3 class="tile-title"> Listado de departamentos</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle fa-lg" ></i>{{tituloModal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form >
                  <div class="form-group">
                    <label class="control-label" for="pais">Seleccione un país</label>
                    <select id="pais" v-model="crearDepartamento.idPais" class="form-control select2">
                     <option v-for="pais in paises" v-bind:value="pais.id" >{{ pais.nombre }}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label" for="nombre">Nombre del departamento</label>
                    <input id="nombre" class="form-control focus" type="text" placeholder="Escriba el nombre del departamento" v-model="crearDepartamento.nombre">
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
	                <th>#</th>
	                <th>País</th>
	                <th>Nombre Departamento</th>
	                <th>Fecha</th>
	                <th>Acciones</th>
	              </tr>
	            </thead>
	            <tbody>
	              <tr v-for="item in departamentos">
	                <td>{{item.id}}</td>
	                <td>{{item.pais.nombre}}</td>
	                <td>{{item.nombre}}</td>
	                <td>{{fecha(item.updated_at)}}</td>
	                <td>
	                  <button class="btn btn-primary btn-sm"  @click="editarDepartamento(item)" type="button" v-if="can('editar departamento')"><i class="fas fa-edit"></i></button>
	                  <button class="btn btn-danger btn-sm" @click="eliminarDepartamento(item)" type="button" v-if="can('eliminar departamento')"><i class="fas fa-trash"></i></button>
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
      this.getDepartamentos()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {
        departamentos: [],
        paises: [],
        crearDepartamento:{idPais:'1',nombre:''},
        tituloModal:'',
        btnCrear:true,
        btnEditar:false,
        idDepartamento:''
      }
    },
    methods:{
      abirimodal(){
        this.tituloModal=' Crear Departamento'
        this.btnEditar=false
        this.btnCrear=true
        this.crearDepartamento.nombre=''
        $('#exampleModal').modal('show')
      },
      getDepartamentos(){
       axios.get('departamentos/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.departamentos = res.data.departamentos
          this.paises = res.data.paises
          this.$tablaGlobal()
        });
      },
      agregar(){
        axios.post('departamentos', this.crearDepartamento).then((res) =>{
          this.getDepartamentos()
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          swal("Muy bien!", "Departamento creado correctamente", "success")
          this.crearDepartamento.selected='1'
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
          this.getDepartamentos()
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
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
          	axios.delete('departamentos/'+item.id).then((res)=>{
	            this.getDepartamentos()
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
