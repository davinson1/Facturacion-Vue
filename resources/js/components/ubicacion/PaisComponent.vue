<template>    
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">pais</h3>
        <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus-circle"></i> Registrar País
        </button>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle fa-lg" ></i> Registrar País</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="agregar">
                  <div class="form-group">
                  <label class="control-label">Nombre del país</label>
                  <input class="form-control" type="text" placeholder="Ecriba el nombre del país" v-model="paiscrear.nombre">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarmodal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">          
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in paises">
                <td>{{item.id}}</td>
                <td>{{item.nombre}}</td>
                <td>{{item.updated_at}}</td>
                <td>
                  <button class="btn btn-primary btn-sm" type="button"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" type="button"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            </tbody>          
          </table>
        </div>
      </div>
    </div>    
  </div>
</template>
<script>
  import datatables from 'datatables.net-dt'
  import bootstrapTable from 'datatables.net-dt/js/dataTables.bootstrap4.js'
  import swal from 'sweetalert';
  export default {
    mounted(){      
      this.getPais()
    },
    data() {
      return {
        paises: [],
        paiscrear:{nombre:''},
      }
    },
    methods:{
      tabla(){
        this.$nextTick(() => {
          $('#myTable').DataTable({"responsive": "true",
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": [[0,"desc"]]
          });
        });
      },
      getPais(){
        axios.get('listar_paises').then(res=>{
          this.paises = res.data;
          this.tabla()
        });
      },
      agregar(){
        const paisnuevo = this.paiscrear;
        this.paiscrear = {nombre: ''};
        axios.post('/pais_crear', paisnuevo).then((res) =>{
            swal("Muy bien!", "País creado correctamente", "success")
            $('#exampleModal').modal('hide')
            $('.modal-backdrop').hide()
            $('#myTable').DataTable().destroy()            
            this.paises = res.data
            this.tabla()
          });
      },
    }
  }
</script>
