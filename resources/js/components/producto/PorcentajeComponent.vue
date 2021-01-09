<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear porcentaje')">
          <i class="fas fa-plus-circle"></i> Registrar porcentaje
        </button>
        <h3 class="tile-title">Listado de porcentajes registrados</h3>
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
                  <div class="form-group">
                    <label for="valor" class="control-label">Nombre del porcentaje (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el nombre del porcentaje" v-model="porcentaje.nombre" required="">
                  </div>
                  <div class="form-group">
                    <label for="descripcion">Descripción (<span class="text-danger">*</span>)</label>
                    <textarea id="descripcion" class="form-control" rows="3" placeholder="Agregue una descripción" v-model="porcentaje.descripcion" required=""></textarea>
                  </div>
                  <div class="form-group">
                    <label for="porcentaje"> Porcentaje (<span class="text-danger">*</span>)</label>
                    <input id="porcentaje" class="form-control" type="text" placeholder="Porcentaje" v-model="porcentaje.porcentaje" required="">
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
                  <th scope="col">Descripción</th>
                  <th scope="col">Porcentaje</th>
                  <th scope="col">Fecha creación</th>                  
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="porcentaje in porcentajes">
                  <td scope="row">{{porcentaje.id}}</td>
                  <td>{{porcentaje.nombre}}</td>
                  <td>{{porcentaje.descripcion}}</td>
                  <td>{{porcentaje.porcentaje}}%</td>
                  <td>{{$fecha(porcentaje.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(porcentaje)" type="button" v-if="$can('editar porcentaje')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(porcentaje)" type="button" v-if="$can('eliminar porcentaje')"><i class="fas fa-trash"></i></button>
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
      this.getPorcentajes()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        icono:'',
        tituloModal:'',
        porcentajes: [],
        porcentaje:{nombre:'', descripcion:'', porcentaje:''},
        btnCrear:true,
        btnEditar:false,
        idPorcentaje:''
      }
    },
    methods:{
      limpiar(){
        this.porcentaje.nombre=''
        this.porcentaje.descripcion=''
        this.porcentaje.porcentaje=''
      },
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear porcentaje'
        this.btnEditar=false
        this.btnCrear=true
        this.limpiar()
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar porcentaje'
        this.btnEditar=true
        this.btnCrear=false
        this.porcentaje.nombre=datos.nombre
        this.porcentaje.descripcion=datos.descripcion
        this.porcentaje.porcentaje=datos.porcentaje
        this.idPorcentaje = datos.id
        $('#exampleModal').modal('show')
      },
      getPorcentajes(){
       axios.get('porcentajes/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.porcentajes = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('porcentajes', this.porcentaje).then((res) =>{
          this.getPorcentajes()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Porcentaje creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        axios.put('porcentajes/'+this.idPorcentaje,this.porcentaje).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idPorcentaje = ''
          this.getPorcentajes()
          swal("Muy bien!", "Porcentaje editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar el porcentaje "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('porcentajes/'+dato.id).then((res)=>{
              this.getPorcentajes()
              swal("Eliminado", "Porcentaje "+dato.nombre+", fue eliminado correctamente.", "success");
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