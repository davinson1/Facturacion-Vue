<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Listado compras registradas</h3>
<br>


    <form @submit.prevent="buscarCompras">
      <h5>Buscar por rango de fechas:</h5>
      <div class="row">
        <div class="col-4">
          <input type="date" class="form-control" v-model="buscar.fecha1" required>
        </div>
        <div class="col-4">
          <input type="date" class="form-control" v-model="buscar.fecha2" required>
        </div>
        <div class="col-4">
          <button type="submit" class="btn btn-primary"><i class="fas fa-search" aria-hidden="true"></i> Buscar</button>
          <button type="button" @click="btnLimpiar" class="btn btn-warning"><i class="fas fa-undo" aria-hidden="true"></i> Limpiar</button>
        </div>
      </div>
    </form>

<br>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped" id="listado-tabla">
              <thead>
                <tr class="text-center">
                  <th scope="col">#</th>
                  <th scope="col">Tipo compra</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Proveedor</th>
                  <th scope="col">Anexo</th>
                  <th scope="col">$total</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Fecha Compra</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in tiposCompras">
                  <td scope="row">{{item.id}}</td>
                  <td scope="row">{{item.tipo_compra.nombre}}</td>
                  <td scope="row">{{item.usuario.name}}</td>
                  <td scope="row" v-if="item.estato == '1'"><span class="badge badge-success">Activo</span></td>
                  <td scope="row" v-else=""><span class="badge badge-danger">Anulado</span></td>

                  <td scope="row">{{item.proveedor.nombre}}</td>
                  <td scope="row" v-if="item.scanner == null">Sin Anexo</td>
                  <td scope="row" v-else><a :href="item.scanner" target="_black">Ver Archivo <i class="fas fa-external-link-alt"></i></a></td>
                  <td scope="row">{{item.total_compra}}</td>
                  <td scope="row">{{item.descripcion}}</td>
                  <td>{{$fecha(tipoCompra.created_at)}}</td>
                  <td class="text-center">

                    <a  class="btn btn-primary btn-sm" :href="'consultarCompras/'+item.id+'/edit'" target="_black" alt="ver mas información"><i class="fas fa-info-circle"></i></a>
                    <button class="btn btn-danger btn-sm" @click="anularCompra(item)" type="button" ><i class="fas fa-ban"></i></button>
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
      this.getTipoCompra()

    },

    data() {
      return {
        tiposCompras: [],
        tipoCompra:{nombre:'', descripcion:''},
        buscar:{fecha1:'',fecha2:''},
        idTipoCompra:'',
        pdf:''
      }
    },
    methods:{
      anularCompra(item){

         swal({
          title: "¿Está seguro de anular la compra No. "+item.id+"?",
          text: "Si preciona OK se anulará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Anular"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.put('consultarCompras/'+item.id).then((res)=>{
              this.getTipoCompra()
              console.log(res.data)
              if(res.data == 'true') {
              swal("Anulado", "Compra "+item.id+" anulada correctamente.", "success");
              }else {
                swal("Anulado", "Compra "+item.id+" Ya se encuentra anulada", "error");
              }
            }).catch(function (error) {
              var array = Object.values(error.response.data.errors);
              array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
            });
          }
        });
      },

      btnLimpiar(){
        this.buscar.fecha1=''
        this.buscar.fecha2=''
        this.getTipoCompra()
        // $('#listado-tabla').DataTable().destroy()

      },
      buscarCompras(){
         axios.post('buscarCompras/', this.buscar).then((res) =>{
         $('#listado-tabla').DataTable().destroy()
          this.tiposCompras = res.data
          this.$tablaGlobal()
        }).catch(function (error) {
          //codigo en caso de error
        });
      },

      limpiar(){
        this.tipoCompra.nombre=''
        this.tipoCompra.descripcion=''
      },
      getTipoCompra(){
       axios.get('consultarCompras/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.tiposCompras = res.data
          this.$tablaGlobal()
        });
      },

        verDetalle(item){
          axios.get('consultarCompras/'+item.id+'/edit').then((res)=>{
            console.log(res)
          }).catch(function (error) {
            var array = Object.values(error.response.data.errors);
            array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
          });
        },


    }
  }
</script>
