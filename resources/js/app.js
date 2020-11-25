/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import datatable from 'datatables.net-bs4'
require('datatables.net-buttons/js/dataTables.buttons')
require('datatables.net-buttons/js/buttons.html5')
import print from 'datatables.net-buttons/js/buttons.print'
import jszip from 'jszip/dist/jszip'
import pdfMake from 'pdfmake/build/pdfmake'
import pdfFonts from 'pdfmake/build/vfs_fonts'
import swal from 'sweetalert'
import select2 from 'select2'
import moment from 'moment'

pdfMake.vfs = pdfFonts.pdfMake.vfs
window.JSZip = jszip

window.Vue = require('vue');

Vue.prototype.$can = function(permissionName){
  return Permissions.indexOf(permissionName) !== -1;
}
Vue.prototype.$fecha = function(d){
  return moment(d).locale('es').format('LL');
}

Vue.prototype.$tablaGlobal = function () {
	this.$nextTick(() => {
    $('.select2').select2({width: '100%'});       
    $('#listado-tabla').DataTable({
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
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Componentes de usuarios
Vue.component('rol-component', require('./components/usuario/RolComponent.vue').default);
// Componentes de ubicacion
Vue.component('pais-component', require('./components/ubicacion/PaisComponent.vue').default);
Vue.component('departamento-component', require('./components/ubicacion/DepartamentoComponent.vue').default);
Vue.component('municipio-component', require('./components/ubicacion/MunicipioComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
