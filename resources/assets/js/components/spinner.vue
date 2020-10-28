
<template>

      <div class="container text-center h-100  d-flex justify-content-center align-items-center">
        <div class="col-3 bg-white" ><h4 style="color:rgb(115, 103, 240)">Loading</h4></div>
        <div class="col-3 bg-white"><fold></fold></div>
        <div class="col-3 bg-white"><h4 style="color:rgb(115, 103, 240)">Cargando</h4></div>
    </div>
</template>
<script>
export default {
data(){
return {
      isLoading: true
    }
  }
}
</script>