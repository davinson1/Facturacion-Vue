<template>  
  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" @click="abirimodal" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus-circle"></i> Registrar País
        </button>
        <h3 class="tile-title">pais</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle fa-lg" ></i>{{titulomodal}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form >
                  <div class="form-group">
                  <label class="control-label">Nombre del país</label>
                  <input class="form-control" type="text" placeholder="Ecriba el nombre del país" v-model="paiscrear.nombre">
                  <input type="hidden"  v-model="paiscrear.id">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarmodal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="button" @click.prevent="agregar" v-if='btncrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
                    <button type="button" @click.prevent="editar" v-if="btneditar" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button>
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
                  <button class="btn btn-primary btn-sm"  @click="editarpais(item)" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" @click="eliminarpais(item)" type="button"><i class="fas fa-trash"></i></button>
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
  import bootstrapTable from 'datatables.net-bs4'
  import swal from 'sweetalert';
  export default {
    mounted(){      
      this.getPais()
    },
    data() {
      return {
        paises: [],
        paiscrear:{id:'',nombre:''},
        titulomodal:'',
        btneditar:false,
        btncrear:false,
      }
    },
    methods:{
      editar(item){
          
                axios.put('/pais_editar',{
                    'id':this.paiscrear.id,
                    'nombre':this.paiscrear.nombre,
                }).then((res)=>{
                      $('#myTable').DataTable().destroy()            
                      this.paises = res.data
                      this.tabla()
                      $('#exampleModal').modal('hide')
                      $('.modal-backdrop').hide()
                      console.log(res)
                      swal("Muy bien!", "País editado correctamente", "success")

                })
                .catch(function (error) {
                    console.log(error);
                });

      },
      editarpais(item){
        this.titulomodal=' Editar País';
        this.btneditar=true;
        this.btncrear=false;
        this.paiscrear.nombre = item.nombre;
        this.paiscrear.id = item.id;

      },
      abirimodal(){
        this.titulomodal=' Crear País';
          this.btneditar=false;
          this.btncrear=true;
          this.paiscrear.nombre='';
          
      },

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
       const listar = axios.get('/listar_paises').then(res=>{
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
          }).catch(function (error) {
                  console.log(error.response.data.errors.nombre);
               swal("ooohhh Vaya!", ""+error.response.data.errors.nombre,"error");
          });  
      },
        eliminarpais(item){
         swal({
            title: "esta seguro de eliminar a "+item.nombre,
            text: "Si preciona OK se eliminara permanentemente",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
        .then((willDelete) => {
            if (willDelete) {
                 
     axios.delete('/paises_eliminar/'+item.id)
          .then((res)=>{
              $('#myTable').DataTable().destroy()            
            this.paises = res.data
            this.tabla()
             swal("País "+item.nombre+" eliminado correctamente" , {
                  icon: "success",
                  });
           
          })  
          .catch(function (error) {
                  console.log(error);
                  swal("ooohhh Vaya!","no se pudo eliminar el pais, ya esta asociado a un departamento", "error");
          });   
          } 
        });
    },


    }
  }
</script>
