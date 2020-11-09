<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" @click="abirimodal">
          <i class="fas fa-plus-circle"></i> Registrar Departamento
        </button>
        <h3 class="tile-title">Departamentos</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                  <label class="control-label">Nombre del Departamento</label>
                  <input class="form-control focus" type="text" placeholder="Ecriba el nombre del departamento" v-model="departamentocrear.nombre">
                  <label class="control-label">Seleecione un país</label>


                    <select  v-model="sedit" class="form-control">
                    <option :value="optionvalue" v-model="option" v-show="selecteditar">{{option}}</option>
                     <option v-for="pais in paises"  v-bind:value="pais.id" v-text="pais.nombre"></option>
                    </select>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cerrar</button>
                    <button type="submit" @click.prevent="agregar" v-if='btncrear' class="btn btn-primary"><i class="fas fa-save"></i> Crear</button>
                    <button type="submit" @click.prevent="editar" v-if="btnEditar" class="btn btn-primary"><i class="fas fa-save"></i> Editar</button>
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
                <td>{{item.updated_at}}</td>
                <td>
                  <button class="btn btn-primary btn-sm"  @click="editarDepartamento(item)" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger btn-sm" @click="eliminarDepartamento(item)" type="button"><i class="fas fa-trash"></i></button>
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
  import datatable from 'datatables.net-bs4'
  require( 'datatables.net-buttons/js/dataTables.buttons' )
  require( 'datatables.net-buttons/js/buttons.html5')
  import print from 'datatables.net-buttons/js/buttons.print'
  import jszip from 'jszip/dist/jszip'
  import pdfMake from "pdfmake/build/pdfmake"
  import pdfFonts from "pdfmake/build/vfs_fonts"
  import swal from 'sweetalert'

  pdfMake.vfs = pdfFonts.pdfMake.vfs
  window.JSZip = jszip

  var id_pais = ''

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
        departamentocrear:{selected:'1',nombre:''},
        titulomodal:'',
        btncrear:true,
        btnEditar:false,
        optionvalue:'',
        option:'',
        selecteditar:false,
        sedit:''

      }
    },
    methods:{
      abirimodal(){
        this.titulomodal=' Crear Departamento';
        this.btnEditar=false;
        this.btncrear=true;
        this.departamentocrear.nombre='';
        this.sedit='1';
        this.selecteditar=false;
      },
      tabla(){
        this.$nextTick(() => {
          $('#myTable').DataTable({
              language: {
              search: " Buscar ",
              "lengthMenu":" Filtrar _MENU_ número de filas ",
               "info": "Página _PAGE_ de _PAGES_",
               "infoFiltered": "(Resultados encontrado de _MAX_ en total.)",
               paginate: {
                  first:      "Premier",
                  previous:   "Anterior",
                  next:       "Siguiente",
                  last:       "Dernier"
              }
            },
            dom: "<'row'<'col-sm-12 mb-3 text-center'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
              {
                "extend": "copyHtml5",
                "text": "<i class='fas fa-copy'></i> Copiar",
                "titleAttr": "Copiar filas",
                "className": "btn btn-secondary"
              },
              {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success"
              },
              {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger"
              },
              {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info"
              },
              {
                "extend": "print",
                "text": "<i class='fas fa-file-csv'></i> Imprimir",
                "titleAttr": "Imprimir archivo",
                "className": "btn btn-secondary"
              }
            ],
            "responsive": "true",
            "bDestroy": true,
            "iDisplayLength": 10,
            "order": [[0,"desc"]]
          });
        });
      },

      getDepartamentos(){
       const listar = axios.get('/listar_departamentos').then(res=>{
          $('#myTable').DataTable().destroy()
          this.departamentos = res.data;
          this.tabla()
        });
        axios.get('/select_pais').then(res=>{
        this.paises = res.data;
        });
      },

      agregar(){
        const deparnuevo = this.departamentocrear;
        this.departamentocrear = {selected:'',nombre: ''};
        console.log(deparnuevo)
        axios.post('/departamento_crear', deparnuevo).then((res) =>{
            this.getDepartamentos()
            $('#exampleModal').hide()
            $('#exampleModal').modal('hide')
            $('.modal-backdrop').hide();
            swal("Muy bien!", "Departamento creado correctamente", "success")
            this.departamentocrear.selected='1'
          }).catch(function (error) {
            var array = Object.values(error.response.data.errors);
            array.forEach(element => swal("ooohhh Vaya!", ""+element,"error"));

          });
      },
      editarDepartamento(item){
        this.titulomodal=' Editar País';
        this.btnEditar=true;
        this.btncrear=false;
        this.selecteditar=true;
        this.departamentocrear.nombre = item.nombre;
        this.optionvalue = item.pais.id;
        this.option = item.pais.nombre;
        id_pais = item.id;
        this.sedit= item.pais.id;
      },
      editar(){
        axios.put('/departamento_editar',{
          'id':id_pais,
          'id_pais':this.sedit,
          'nombre':this.departamentocrear.nombre,
        }).then((res)=>{
          $('#exampleModal').hide()
          $('#exampleModal').modal('hide')
          $('.modal-backdrop').hide()
          this.getDepartamentos()
          swal("Muy bien!", "Departamento editado correctamente", "success")
        }).catch(function (error) {
             var array = Object.values(error.response.data.errors);
            array.forEach(element => swal("ooohhh Vaya!", ""+element,"error"));
        });
      },
      eliminarDepartamento(item){
       swal({
          title: "esta seguro de eliminar a "+item.nombre,
          text: "Si preciona OK se eliminara permanentemente",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
          axios.delete('/departamento_eliminar/'+item.id).then((res)=>{
            this.getDepartamentos()
            swal("Eliminado", "País "+item.nombre+" eliminado correctamente", "success");
        })
        .catch(function (error) {
          console.log(error);
          swal("ooohhh Vaya!","no se pudo eliminar el departamento, ya esta asociado a un municipio", "error");
        });
        }
      });
    },

    }
  }
</script>
