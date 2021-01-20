<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Registrar compra</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <form>
                  <div class="row">
                    <div class="col-6">
                      <label for="buscador">Buscar producto</label>
                      <input id="buscador" type="text" class="form-control" placeholder="Buscar producto" required="" v-model="nombre" autocomplete="off" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-on:keyup="autocompletar">
                      <div class="dropdown-menu" style="width:92%" >
                        <a class="dropdown-item m-0 " href="#" v-for="producto in resultados" @click="seleccion(producto)">
                          <div>
                          <img :src="producto.foto" height='50px' width='50px' class='float-left mr-3'/>
                          <span class="badge badge-info float-right">{{producto.cantidad}}</span>
                          <div>
                            <span class="text-dark h5" >{{producto.nombre}}</span><br>
                          </div>
                        </div>
                        </a>
                      </div>
                    </div>
                    <div class="col" v-if="disponible">
                      <label for="cantidad_compra">Cantidad a comprar (<span class="text-danger">*</span>)</label>
                      <input id="cantidad_compra" class="form-control" type="number" value="1" required="" v-model="datosProducto.cantidad_producto">
                    </div>
                  </div>
                  <div class="row mb-3" v-if="disponible">
                    <div class="col">
                      <label for="precio_compra">Precio de compra (<span class="text-danger">*</span>)</label>
                      <input id="precio_compra" class="form-control" type="number" placeholder="2000" required="" v-model="datosProducto.precio_compra">
                    </div>
                    <div class="col">
                      <label for="precio_venta">Precio de venta (<span class="text-danger">*</span>)</label>
                      <input id="precio_venta" class="form-control" type="number" placeholder="2000" required="" data-toggle="tooltip" data-placement="top" title="Precio con el que se va a vender el producto" v-model="datosProducto.precio_venta">
                    </div>
                  </div>
                  <div class="row" v-if="disponible">
                    <div class="col text-center">
                      <button class="btn btn-primary btn-sm" type="submit" @click.prevent="agregar"><i class="fas fa-plus"></i> Agregar</button>
                    </div>
                  </div>
                </form>
                <div class="table-responsive shadow rounded p-0 mt-3">
                  <table class="table table-sm table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Venta</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="temporal in compraTemporal">
                        <td>{{temporal.id_producto}}</td>
                        <td>{{temporal.nombre_producto}}</td>
                        <td><img id="img1" :src="temporal.foto" class="rounded mx-auto d-block " alt="Foto del producto" width="30" height="30"></td>
                        <td>{{temporal.codigo_barras}}</td>
                        <td>{{temporal.descripcion_producto}}</td>
                        <td>{{temporal.cantidad_producto}} ({{temporal.precio_compra}})</td>
                        <td>{{temporal.cantidad_producto * temporal.precio_compra}}</td>
                        <td>{{temporal.precio_venta}}</td>
                        <td class="text-center">
                          <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-descartar-producto" @click.prevent="descartarProducto(temporal)">
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                    <tfoot class="text-right font-weight-bold">
                      <!-- Condenido de Ajax -->
                      <tr>
                        <td colspan="7" class="text-right">Total $</td>
                        <td id="total" class="text-right">{{totales}}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-4 shadow rounded p-0">
                <div class="widget-small primary mb-2"><i class="icon fa fa-dollar-sign fa-3x"></i>
                  <div class="info">
                    <h4>Total</h4>
                    <p><b>{{totales}}</b></p>
                  </div>
                </div>
                <!-- form start -->
                <form class="p-2" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="idProveedor">Proveedor (<span class="text-danger">*</span>)</label>
                      <select id="idProveedor" class="form-control" v-model="compra.id_proveedor" required="">
                        <option v-for="provedor in proveedores" v-bind:value="provedor.id" >{{ provedor.nombre }}</option>
                      </select>
                    </div>
                    <div class="row mb-3">
                      <div class="col-6">
                        <label for="idTipoCompra">Tipo de compra (<span class="text-danger">*</span>)</label>
                        <select id="idTipoCompra" class="form-control" v-model="compra.id_tipo_compra" required="">
                          <option v-for="tipoCompra in tiposCompras" v-bind:value="tipoCompra.id" >{{ tipoCompra.nombre }}</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label for="idFormaPago">Forma de pago (<span class="text-danger">*</span>)</label>
                        <select id="idFormaPago" class="form-control" v-model="compra.id_forma_pago" required="">
                          <option v-for="formaPago in formasPagos" v-bind:value="formaPago.id" >{{ formaPago.nombre }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="custom-file">
                      <label id="file" class="custom-file-label text-truncate" for="scannerCompra">{{nombreArchivo}}</label>
                      <input id="scannerCompra" type="file" class="custom-file-input" lang="es" accept="image/png, .jpeg, .jpg, image/gif, .pdf" @change="obtenerScanner">
                    </div>

                    <div class="form-group">
                      <label for="descripcionCompra">Descripción (<span class="text-danger">*</span>)</label>
                      <textarea class="form-control" name="descripcionCompra" rows="3" placeholder="Descripción de compra" required="" v-model="compra.descripcion"></textarea>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <input id="total3" type="hidden" name="totalCompra">
                </form>
                <div class="box-footer">
                  <button id="btnAnular" class="btn btn-danger btn-lg float-left" type="button" @click.prevent="descartarCompra"><i class="fas fa-ban"></i> Anular</button>
                  <button id="registrarCompra" class="btn btn-primary btn-lg float-right" type="submit" @click.prevent="comprar"><i class="fas fa-save"></i> Comprar</button>
                  <!-- <button type="submit" id="crearCompra" class="btn btn-success "><i class="fas fa-save"></i> Comprar</button> -->
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- ./card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.content -->
</template>
<script>
  import select2 from 'select2'
  export default {
    mounted(){
      this.getDatos()
      $('.select-producto').select2({width: '100%'})
    },
    data() {
      return {
        productos:[],
        proveedores: [],
        tiposCompras: [],
        formasPagos: [],
        compraTemporal: [],
        resultados: [],
        nombre:'',
        nombreArchivo:'Soporte de compra',
        filtros:[],
        disponible: false,
        datosProducto: {accion:'', id_producto:'', nombre_producto:'', foto:'', cantidad_producto:'', precio_compra:'', precio_venta:'', codigo_barras:'', descripcion_producto:''},
        compra: {id_usuario:'', id_proveedor:'', id_tipo_compra:'', id_forma_pago:'', scanner:'', total:'', descripcion:''},
      }
    },
    methods:{
      getDatos(){
       axios.get('compras/create').then(res=>{
          this.proveedores = res.data.proveedores
          this.compra.id_proveedor = res.data.proveedores[0].id

          this.tiposCompras = res.data.tiposCompras
          this.compra.id_tipo_compra = res.data.tiposCompras[0].id

          this.formasPagos = res.data.formasPagos
          this.compra.id_forma_pago = res.data.formasPagos[0].id

          this.compraTemporal = res.data.compraTemporal
          this.productos = res.data.productos
        });
      },
      seleccion(datos){
        this.nombre = datos.nombre
        this.datosProducto.id_producto = datos.id
        this.datosProducto.nombre_producto = datos.nombre
        this.datosProducto.foto = datos.foto
        this.datosProducto.cantidad_producto = datos.cantidad
        this.datosProducto.codigo_barras = datos.codigo_barras
        this.datosProducto.descripcion_producto = datos.descripcion
        this.disponible = true
        console.log(this.total)
      },
      limpiar(){
        this.nombre = ''
        this.datosProducto.id_producto = ''
        this.datosProducto.nombre_producto = ''
        this.datosProducto.foto = ''
        this.datosProducto.cantidad_producto = ''
        this.datosProducto.codigo_barras = ''
        this.datosProducto.precio_venta = ''
        this.datosProducto.precio_compra = ''
        this.datosProducto.descripcion_producto = ''
        this.disponible = false
      },
      agregar(){
        if(parseInt(this.datosProducto.precio_venta) < parseInt(this.datosProducto.precio_compra)){
          swal("Ooohh vaya!", "El precio de la venta no puede ser menor al de compra", "warning")
        }else {
        if(this.datosProducto.cantidad_producto <= 0){
          swal("Ooohh vaya!", "La cantidad del producto no puede ser cero o menor", "warning")
        }else{
        this.datosProducto.accion = 'producto_temporal'
        axios.post('compras', this.datosProducto).then(res=>{
          this.compraTemporal = res.data
          this.limpiar()
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });}}
      },
      descartarProducto(datos){
        axios.delete('compras/'+datos.id).then(res=>{
          this.compraTemporal = res.data
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      obtenerScanner(scanner){
        this.compra.scanner = scanner.target.files[0]
        this.nombreArchivo = scanner.target.files[0].name
      },
      comprar(){
        let formData = new FormData();
        formData.append('accion','comprar_producto')
        formData.append('id_proveedor',this.compra.id_proveedor)
        formData.append('id_tipo_compra',this.compra.id_tipo_compra)
        formData.append('id_forma_pago',this.compra.id_forma_pago)
        formData.append('scanner',this.compra.scanner)
        formData.append('total_compra',this.compra.total)
        formData.append('descripcion',this.compra.descripcion)

        axios.post('compras', formData).then(res=>{
          this.compraTemporal = res.data
          swal("Muy bien!", "Compra creada correctamente.", "success")
          this.compra.scanner = ''
          this.compra.total = ''
          this.compra.descripcion = ''
          this.limpiar()
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      descartarCompra(){
        axios.delete('compras/10-50').then(res=>{
          this.compraTemporal = res.data
          this.limpiar()
          this.compra.scanner = ''
          this.compra.total = ''
          this.compra.descripcion = ''
          swal("Muy bien!", "Compra anulada correctamente.", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      autocompletar(){
        if(this.nombre.length >= 2){
          this.resultados = this.productos.filter((producto) => {return producto.nombre.includes(this.nombre) || producto.codigo_barras.includes(this.nombre)})
        }
      },
    },
    computed:{
      totales(){
        var suma = 0
        this.compraTemporal.forEach((el)=>{
          var total = el.cantidad_producto * el.precio_compra
          var total2 =  parseInt(total)
          suma+=total2
        })
        this.compra.total = suma
        return suma
      }
    }
  }
</script>
