<template>  
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" @click="abrirModal">
          <i class="fas fa-plus-circle"></i> Registrar municipio
        </button>
        <h3 class="tile-title">Municipio</h3>
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
                    <label for="idDepartamento">Seleccione el departamento</label>
                    <select class="form-control selectdepar" v-model="crearMunicipio.idDepartamento" v-for="departamento in departamentos">
                      <option>{{departamento.nombre}}</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nombre del Municipio</label>
                    <input class="form-control focus" type="text" placeholder="Ecriba el nombre del Municipio" v-model="crearMunicipio.nombre">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" @click.prevent="crear" v-if='btncrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
                    <button type="submit" @click.prevent="editar" v-if="btnEditar" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">          
          <table class="table table-hover" id="tableMunicipios">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in municipios">
                <td>{{item.id}}</td>
                <td>{{item.nombre}}</td>
                <td>{{item.updated_at}}</td>
                <td>
                  <button class="btn btn-primary btn-sm"  @click="editarPais(item)" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fas fa-edit"></i></button>
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

  var id_municipio = ''

  export default {
    mounted(){
      this.$idTabla = '#tableMunicipios'
      this.getMunicipios()
      $('#exampleModal').on('shown.bs.modal', function (e){
        $('.focus').focus();
      });
    },
    data() {
      return {
        municipios: [],
        departamentos: [],
        crearMunicipio:{idDepartamento:'',nombre:''},
        tituloModal:'',
        btncrear:true,
        btnEditar:false
      }
    },
    methods:{
      abrirModal(){
        this.tituloModal=' Crear Municipio';
        this.btnEditar=false;
        this.btncrear=true;
        this.crearMunicipio.nombre='';          
      },      
      getMunicipios(){
       axios.get('listar_municipios').then(res=>{
          $('#tableMunicipios').DataTable().destroy()
          this.municipios = res.data;
          this.$tablaGlobal('#tableMunicipios')
        });
      },
      crear(){
        const datos = {
          idDepartamento: '1',
          nombre:this.crearMunicipio
        };
        this.crearMunicipio = {nombre: ''};
        axios.post('municipios_crear', datos).then((res) =>{            
            this.getMunicipios()
            $('#exampleModal').hide()
            $('#exampleModal').modal('hide')
            $('.modal-backdrop').hide();
            swal("Muy bien!", "Municipio creado correctamente", "success")
          }).catch(function (error) {
              console.log(error.response.data.errors.nombre);
              swal("ooohhh Vaya!", ""+error.response.data.errors.nombre,"error");
          });  
      },
      editarPais(item){
        this.tituloModal=' Editar Municipio';
        this.btnEditar=true;
        this.btncrear=false;
        this.crearMunicipio.nombre = item.nombre;
        id_pais = item.id;
      },
      editar(){
        axios.put('/pais_editar',{
          'id':id_pais,
          'nombre':this.crearMunicipio.nombre,
        }).then((res)=>{
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          this.getMunicipios()
          swal("Muy bien!", "Municipio editado correctamente", "success")
        }).catch(function (error) {
            console.log(error);
        });
      },           
      eliminarpais(item){
       swal({
          title: "esta seguro de eliminar a "+item.nombre,
          text: "Si preciona OK se eliminara permanentemente",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {                 
          axios.delete('/municipios_eliminar/'+item.id).then((res)=>{            
            this.getMunicipios()
            swal("Eliminado", "Municipio "+item.nombre+" eliminado correctamente", "success");
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
