<template>
    <div class="form-group">
        <label>Date and time range:</label>

        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-clock"></i></span>
        </div>
        <input type="text" class="form-control float-right" id="reservationtime" v-model="rango">
        <br/>
        
        </div>
           <p>El mensaje es: {{ rango }}</p>       <!-- /.input group -->
    </div>
</template>

<script>
export default {
            data()
        {
            return {
                rango:'',
            }
        },
        mounted() {
            console.log("Date range")

        }


}
</script>