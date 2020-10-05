<template>

        <option :value="id"  >{{dato}}</option> 
        

</template>

<script>
    export default {
      props: {
              dato:String,
              id:0
        },
        data()
        {
            return {
                
            }
        },
        mounted() {
            //this.getConversation()
        },
        computed:
        {
            data()
            {
                return 
            }
        }
    }
</script>
