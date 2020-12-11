<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear iva')">
          <i class="fas fa-plus-circle"></i> Registrar iva
        </button>
        <h3 class="tile-title">Listado de ivas registrados</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i :class="icono" ></i>{{tituloModal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="valor" class="control-label">Valor de iva (<span class="text-danger">*</span>)</label>
                    <input id="valor" class="form-control focus" type="text" placeholder="Escriba el valor de iva" v-model="ivas.valor_iva" required="">
                  </div>
                  <div class="form-group">
                    <label for="fechaFinIva">Fecha fin (<span class="text-danger">*</span>)</label>
                    <input id="fechaFinIva" class="form-control" type="date" placeholder="Fecha final de iva" v-model="ivas.fecha_fin" :min="$fechaHoy" required="">
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
                  <th scope="col">Valor de iva</th>
                  <th scope="col">Fecha creación</th>
                  <th scope="col">Fecha final</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="iva in getIvas">
                  <td scope="row">{{iva.id}}</td>
                  <td>{{iva.valor_iva}} %</td>
                  <td>{{$fecha(iva.created_at)}}</td>
                  <td>{{$fecha(iva.fecha_fin)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalEditar(iva)" type="button" v-if="$can('editar iva')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminarIva(iva)" type="button" v-if="$can('eliminar iva')"><i class="fas fa-trash"></i></button>
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
      this.getIva()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {        
        getIvas: [],
        ivas:{valor_iva:'', fecha_fin:''},
        tituloModal:'',
        icono:'',
        btnCrear:true,
        btnEditar:false,
        idIva:''
      }
    },
    methods:{
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear Iva'
        this.btnEditar=false
        this.btnCrear=true
        this.ivas.valor_iva=''
        $('#exampleModal').modal('show')
      },
      modalEditar(iva){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar Iva'
        this.btnEditar=true
        this.btnCrear=false
        this.ivas.valor_iva = iva.valor_iva
        this.ivas.fecha_fin = iva.fecha_fin
        this.idIva = iva.id
        $('#exampleModal').modal('show')
      },
      getIva(){
       axios.get('ivas/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.getIvas = res.data
          this.$tablaGlobal()
        });
      },
      crear(){
        axios.post('ivas', this.ivas).then((res) =>{
          this.getIva()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Iva creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });  
      },
      editar(){
        axios.put('ivas/'+this.idIva,this.ivas).then((res)=>{          
          $('#exampleModal').modal('hide')
          this.idIva = ''
          this.getIva()
          swal("Muy bien!", "Iva editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminarIva(iva){
        swal({
          title: "¿Está seguro de eliminar el iva con valor "+iva.valor_iva+"%?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('ivas/'+iva.id).then((res)=>{
              this.getIva()
              swal("Eliminado", "Iva con valor "+iva.valor_iva+"%, fue eliminado correctamente.", "success");
            }).catch(function (error) {
              swal("Ooohhh vaya!","No se pudo eliminar el iva, ya está asociado a un departamento.", "error");
            });
          } 
        });
      },
    }
  }
</script>