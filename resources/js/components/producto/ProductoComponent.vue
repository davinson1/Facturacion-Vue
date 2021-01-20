<template>
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
      <!-- Button modal registrar -->
        <button type="button" class="btn btn-primary float-right" @click="modalCrear" v-if="$can('crear producto')">
          <i class="fas fa-plus-circle"></i> Registrar producto
        </button>
        <h3 class="tile-title">Listado de productos registrados</h3>
        <!-- Modal registrar-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i :class="icono"></i>{{tituloModal}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="row mb-3">
                    <div class="col-6 mx-auto">
                      <img :src="this.imagenSeleccionada" class="mb-3 rounded mx-auto d-block " alt="Foto del producto" width="150" height="150">
                      <div class="custom-file">
                        <label class="custom-file-label" for="customFileLang">{{nombreArchivo}}</label>
                        <input type="file" class="custom-file-input" id="customFileLang" lang="es" accept="image/png, .jpeg, .jpg, image/gif" @change="obtenerFoto">
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="idTipoArticulo">Seleccione tipo de artículo (<span class="text-danger">*</span>)</label>
                      <select id="idTipoArticulo" class="form-control select-producto" v-model="producto.id_tipo_articulo" required="">
                        <option v-for="tipoArticulo in tiposArticulos" v-bind:value="tipoArticulo.id" >{{ tipoArticulo.nombre }}</option>
                      </select>
                    </div>
                    <div class="col-6">
                      <label for="idProveedor">Seleccione el proveedor (<span class="text-danger">*</span>)</label>
                      <select id="idProveedor" class="form-control select-producto" v-model="producto.id_proveedor" required="">
                        <option v-for="provedor in proveedores" v-bind:value="provedor.id" >{{ provedor.nombre }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="idCategoria">Seleccione la categoria</label>
                      <select id="idCategoria" class="form-control select-producto" v-model="producto.id_categoria" required="">
                        <option v-for="categoria in categorias" v-bind:value="categoria.id" >{{ categoria.nombre }}</option>
                      </select>
                    </div>
                    <div class="col-6">
                      <label for="idPorcentaje">Seleccione el porcentaje (<span class="text-danger">*</span>)</label>
                      <select id="idPorcentaje" class="form-control select-producto" v-model="producto.id_porcentaje" required="">
                        <option v-for="porcentaje in porcentajes" v-bind:value="porcentaje.id" >{{ porcentaje.nombre }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-6">
                      <label for="nombreProducto">Nombre del producto (<span class="text-danger">*</span>)</label>
                      <input id="nombreProducto" class="form-control focus" type="text" v-model="producto.nombre" required="">
                    </div>
                    <div class="col-6">
                      <label for="codigoBarrasProducto">Código de barras (<span class="text-danger">*</span>)</label>
                      <input id="codigoBarrasProducto" class="form-control" type="text" v-model="producto.codigo_barras" required="">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-12">
                      <label for="descripcionProducto">Descripción (<span class="text-danger">*</span>)</label>
                      <textarea id="descripcionProducto" class="form-control" v-model="producto.descripcion"></textarea>
                    </div>
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
                  <th scope="col">Foto</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Precio Venta</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Fecha creación</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="producto in productos">
                  <td scope="row">{{producto.id}}</td>
                  <td><img :src="producto.foto" class="mb-3 rounded mx-auto d-block " alt="Foto del producto" width="50" height="50"></td>
                  <td>{{producto.nombre}}</td>
                  <td>
                    <span class="badge badge-success" v-if="producto.cantidad >= 11">{{producto.cantidad}}</span>
                    <span class="badge badge-danger" v-if="producto.cantidad <= 10">{{producto.cantidad}}</span>
                  </td>
                  <td>{{producto.valor_venta}}</td>
                  <td>{{producto.descripcion}}</td>
                  <td>{{$fecha(producto.created_at)}}</td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" @click="modalDetalles(producto)" type="button" v-if="$can('ver producto')"><i class="fas fa-info-circle"></i></button>
                    <button class="btn btn-primary btn-sm" @click="modalEditar(producto)" type="button" v-if="$can('editar producto')"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" @click="eliminar(producto)" type="button" v-if="$can('eliminar producto')"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Modal ver detalles -->
        <div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-info-circle"></i> Detalles del producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered table-striped">
                    <tbody>
                      <tr>
                        <th scope="row">Foto</th>
                        <td><img :src="info.foto" class="mb-3 rounded mx-auto d-block " alt="Foto del producto" width="150" height="150"></td>
                      </tr>
                      <tr>
                        <th scope="row">Tipo de artículo</th>
                        <td>{{info.tipoArticulo}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Proveedor</th>
                        <td>{{info.proveedor}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Categoría</th>
                        <td>{{info.categoria}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Porcentaje</th>
                        <td>{{info.porcentaje}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Nombre</th>
                        <td>{{info.nombre}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Valor de venta</th>
                        <td>{{info.valorVenta}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Porcentaje mínimo</th>
                        <td>{{info.porcentajeMin}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Cantidad</th>
                        <td>{{info.cantidad}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Código de barras</th>
                        <td>{{info.codigoBarras}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Descripción</th>
                        <td>{{info.descripcion}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Fecha creación</th>
                        <td>{{$fecha(info.fechaCreacion)}}</td>
                      </tr>
                      <tr>
                        <th scope="row">Fecha actualización</th>
                        <td>{{$fecha(info.fechaUp)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    mounted(){
      this.getProductos()
      $('#exampleModal').on('shown.bs.modal', function (e) {
        $('.focus').focus();
      });
    },
    data() {
      return {
        icono:'',
        tituloModal:'',
        imagenSeleccionada:'',
        productos: [],
        info: {foto:'', tipoArticulo:'', proveedor:'', categoria:'', porcentaje:'',nombre:'', valorVenta:'', porcentajeMin:'', cantidad:'', codigoBarras:'', descripcion:'', fechaCreacion:'', fechaUp:''},
        tiposArticulos: [],
        proveedores: [],
        porcentajes: [],
        categorias: [],
        nombreArchivo: 'Foto del producto',
        producto:{foto:'',id_tipo_articulo:'', id_proveedor:'', id_categoria:'', id_porcentaje:'', nombre:'', codigo_barras:'', descripcion:''},
        btnCrear:true,
        btnEditar:false,
        idProducto:''
      }
    },
    methods:{
      modalDetalles(dato){
        console.log(dato)
        this.info.foto = dato.foto
        this.info.tipoArticulo = dato.tipo_articulos.nombre
        this.info.proveedor = dato.proveedor.nombre
        this.info.categoria = dato.categoria.nombre
        this.info.porcentaje = dato.porcentaje.nombre
        this.info.nombre = dato.nombre
        this.info.valorVenta = dato.valor_venta
        this.info.porcentajeMin = dato.porcentaje_minimo
        this.info.cantidad = dato.cantidad
        this.info.codigoBarras = dato.codigo_barras
        this.info.descripcion = dato.descripcion
        this.info.fechaCreacion = dato.created_at
        this.info.fechaUp = dato.updated_at
        $('#modalDetalle').modal('show')
      },
      limpiar(){
        this.imagenSeleccionada=''
        this.producto.nombre=''
        this.producto.codigo_barras=''
        this.producto.descripcion=''
      },
      obtenerFoto(img){
        let file = img.target.files[0]
        this.producto.foto = file
        this.nombreArchivo = file.name
        let reader = new FileReader()
        reader.onload = (e) => {
          this.imagenSeleccionada = e.target.result
        }
        reader.readAsDataURL(file)
      },
      modalCrear(){
        this.icono='fas fa-plus-circle fa-lg'
        this.tituloModal=' Crear producto'
        this.btnEditar=false
        this.btnCrear=true
        this.limpiar()
        $('#exampleModal').modal('show')
      },
      modalEditar(datos){
        this.icono='fas fa-edit fa-lg'
        this.tituloModal=' Editar producto'
        this.nombreArchivo = 'Foto del producto'
        this.btnEditar=true
        this.btnCrear=false
        this.imagenSeleccionada = datos.foto
        this.producto.id_tipo_articulo = datos.id_tipo_articulo
        this.producto.id_porcentaje = datos.id_porcentaje
        this.producto.id_categoria = datos.id_categoria
        this.producto.id_proveedor = datos.id_proveedor
        this.producto.nombre = datos.nombre
        this.producto.codigo_barras = datos.codigo_barras
        this.producto.descripcion = datos.descripcion
        this.idProducto = datos.id
        $('#exampleModal').modal('show')
      },
      getProductos(){
       axios.get('productos/create').then(res=>{
          $('#listado-tabla').DataTable().destroy()
          this.productos = res.data.productos
          this.tiposArticulos = res.data.tiposArticulos
          this.producto.id_tipo_articulo = res.data.tiposArticulos[0].id

          this.proveedores = res.data.proveedores
          this.producto.id_proveedor = res.data.proveedores[0].id

          this.porcentajes = res.data.porcentajes
          this.producto.id_porcentaje = res.data.porcentajes[0].id

          this.categorias = res.data.categorias
          this.producto.id_categoria = res.data.categorias[0].id

          this.$tablaGlobal()
        });
      },
      crear(){
        let formData = new FormData();
        formData.append('foto',this.producto.foto)
        formData.append('id_tipo_articulo',this.producto.id_tipo_articulo)
        formData.append('id_proveedor',this.producto.id_proveedor)
        formData.append('id_categoria',this.producto.id_categoria)
        formData.append('id_porcentaje',this.producto.id_porcentaje)
        formData.append('nombre',this.producto.nombre)
        formData.append('codigo_barras',this.producto.codigo_barras)
        formData.append('descripcion',this.producto.descripcion)

        axios.post('productos', formData).then((res) =>{
          this.getProductos()
          $('#exampleModal').modal('hide')
          swal("Muy bien!", "Producto creado correctamente", "success")
        }).catch(function (error) {
          $('#exampleModal').modal('hide')
          var array = Object.values(error.response.data.errors)
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"))
        });
      },
      editar(){
        let formData = new FormData();
        formData.append('_method','PUT')
        formData.append('foto',this.producto.foto)
        formData.append('id_tipo_articulo',this.producto.id_tipo_articulo)
        formData.append('id_proveedor',this.producto.id_proveedor)
        formData.append('id_categoria',this.producto.id_categoria)
        formData.append('id_porcentaje',this.producto.id_porcentaje)
        formData.append('nombre',this.producto.nombre)
        formData.append('codigo_barras',this.producto.codigo_barras)
        formData.append('descripcion',this.producto.descripcion)
        axios.post('productos/'+this.idProducto,formData).then((res)=>{
          $('#exampleModal').modal('hide')
          this.idProducto = ''
          this.getProductos()
          swal("Muy bien!", "Producto editado correctamente", "success")
        }).catch(function (error) {
          var array = Object.values(error.response.data.errors);
          array.forEach(element => swal("Ooohhh vaya!", ""+element,"error"));
        });
      },
      eliminar(dato){
        swal({
          title: "¿Está seguro de eliminar el producto "+dato.nombre+"?",
          text: "Si preciona OK se eliminará permanentemente.",
          icon: "warning",
          buttons: ["Cancelar", "Eliminar!"],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            axios.delete('productos/'+dato.id).then((res)=>{
              this.getProductos()
              swal("Eliminado", "Producto "+dato.nombre+", fue eliminado correctamente.", "success");
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
