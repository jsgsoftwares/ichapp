<template>
    <div>
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Usuarios atendidos</h3>
                  
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">{{usuarios}}</span>
                    <span>Cantidad usuarios</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                   <!--  <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span> -->
                    <span class="text-muted">Ultima semana</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <GChart
                      type="ColumnChart"
                      :data="chartData"
                      :options="chartOptions"
                    />
                </div>

                <!-- <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div> -->
              </div>
            </div>
    </div>
</template>



<script>
export default {
  data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartData: [],
      usuarios:0,
      chartOptions: {
        chart: {
          title: '',
          subtitle: '',
        }
      }
    }
  },
        mounted() {
          this.$store.dispatch('getDashboardusuarios').then(()=>{

             
            this.inicio();
          }
            
          
          );
         
            //this.getConversation()
            
           //this.chartData=this.datos;
        },
        methods:{

            inicio()
            {
              this.chartData=this.datos;
              for (var i = 1; i <this.datos.length ; i++) {
                   for (var j = 1; j <this.datos[i].length ; j++) {
                   
                   this.usuarios+=this.datos[i][j];
                   //console.log(this.datos[i][j]);
                    
                  }
                   
                    
                  }
            }
        },
        computed:
        {
            datos()
            {
                return this.$store.state.Dashboardusuarios;
            }
        }
}
</script>