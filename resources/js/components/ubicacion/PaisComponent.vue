<template>    
  <div class="container">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">pais</h3>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody v-for="(item, index) in pais" :key="index" >
            <tr>
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
</template>

<script>  
  export default {
    mounted() {
      console.log('Component mounted.')
    }
  }
</script>
<script>
export default {
  data() {
    return {
      pais: [],
    }
  },
  created(){
    axios.get('/pais').then(res=>{
      this.pais = res.data;
    })
  }
}
</script>
