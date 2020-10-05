<template>
<div>
    <b-img rounded="circle" alt="Status" blank width="10" heigth="10"
                    :blank-color="online? 'green': 'gray' "
                    :title="online? 'Conectado': 'Desconectado' "
                    ></b-img>
</div>
</template>

<script>
    export default {
        props:{
            online:Boolean,
            }
            ,
        data()
        {
            return{
           
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
 
    }
</script>