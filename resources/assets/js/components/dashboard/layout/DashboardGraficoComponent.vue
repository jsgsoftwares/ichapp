<template>
    <div>
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Consultas atendidas</h3>
                  
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">400</span>
                    <span>Tipo de consultas</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Ultima semana</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <GChart
                      type="AreaChart"
                      :data="chartData"
                      :options="chartOptions"
                    />
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>
              </div>
            </div>
    </div>
</template>



<script>
export default {
  data () {
    return {
      // Array will be automatically processed with visualization.arrayToDataTable function
      chartData: [
        ['Dia', 'Whatsapp', 'Facebook', 'Instagram','Twitter','Telegram'],
        ['20/02', 1000, 400, 200,100,403],
        ['21/02', 1170, 460, 250,930,202],
        ['22/02', 660, 1120, 300,302,292],
        ['23/02', 1030, 540, 350,293,250]
      ],
      chartOptions: {
        chart: {
          title: '',
          subtitle: '',
        }
      }
    }
  }
}
</script>