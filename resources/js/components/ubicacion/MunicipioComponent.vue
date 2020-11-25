<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
        <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="abrirModal" v-if="$can('crear municipio')">
          <i class="fas fa-plus-circle"></i> Registrar municipio
        </button>
        <h3 class="tile-title">Listado de municipios</h3>
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
                <form>
                  <div class="form-group">
                    <label for="departamento">Seleccione el departamento</label>                    
                    <select id="departamento" class="form-control select2" v-model="crearMunicipio.idDepartamento">
                      <option v-for="departamento in departamentos" v-bind:value="departamento.id">{{departamento.nombre}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nombre del Municipio</label>
                    <input class="form-control focus" type="text" placeholder="Ecriba el nombre del Municipio" v-model="crearMunicipio.nombre">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" @click.prevent="crear" v-if='btncrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
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
                  <th>#</th>
                  <th>Departamento</th>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in municipios">
                  <td>{{item.id}}</td>
                  <td>{{item.relacion_departamentos.nombre}}</td>
                  <td>{{item.nombre}}</td>
                  <td>{{$fecha(item.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm"  @click="editarMunicipio(item)" type="button" v-if="$can('editar municipio')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminarMunicipio(item)" type="button" v-if="$can('eliminar municipio')"><i class="fas fa-trash"></i></button>
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
      this.getMunicipios()
      $('#exampleModal').on('shown.bs.modal', function (e){
        $('.focus').focus();
      });
    },
    data() {
      return {
        municipios: [],
        departamentos: [],
        crearMunicipio:{idDepartamento:'1',nombre:''},
        tituloModal:'',
        btncrear:true,
        btnEditar:false,
        idMunicipio:''
      }
    },
    methods:{
      abrirModal(){
        this.tituloModal=' Crear Municipio'
        this.btnEditar=false
        this.btncrear=true
        this.crearMunicipio.nombre=''
        $('#exampleModal').modal('show')
      },
      getMunicipios(){
        axios.get('municipios/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.municipios = res.data.municipios
          this.departamentos = res.data.departamentos
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('municipios', this.crearMunicipio).then((res) =>{
          this.getMunicipios()
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          swal("Muy bien!", "Municipio creado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      editarMunicipio(item){
        this.tituloModal=' Editar Municipio'
        this.btnEditar=true
        this.btncrear=false
        this.crearMunicipio.idDepartamento = item.relacion_departamentos.id
        this.crearMunicipio.nombre = item.nombre
        this.idMunicipio = item.id
        $('#exampleModal').modal('show')
      },
      editar(){
        axios.put('municipios/'+this.idMunicipio, this.crearMunicipio).then((res)=>{
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          this.getMunicipios()
          swal("Muy bien!", "Municipio editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      eliminarMunicipio(item){
        swal({
          title: "¿Está seguro de eliminar a "+item.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('municipios/'+item.id).then((res)=>{
              this.getMunicipios()
              swal("Eliminado", "Municipio "+item.nombre+" eliminado correctamente.", "success");
            }).catch(function (error) {
              console.log(error);
              swal("Ooohhh vaya!","No se pudo eliminar el municipio, ya está asociado a un usuario.", "error");
            });
          } 
        });
      },
    }
  }
</script>
