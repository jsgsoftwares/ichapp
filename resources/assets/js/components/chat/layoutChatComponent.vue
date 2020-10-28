<template>
    <div>
        <spinner/>
    </div>
</template>
<script>
export default {
    props: {
        user_id: Number,
        url_app: String,
    },
    data() {
        return {
         
        };
    },
    components: {
        chat: {
        template: "<messenger_Component/>",
        },
        spinner:{
            template: "<spinner/>"
        },
        },
    mounted() {
        this.$store.commit("setUser", this.user_id);
        this.$store.commit("setUrl", this.url_app);
       
       this.$router.push({name:'wait'})
        this.$store.dispatch("getSubscripciones", this.user_id).then(()=>{
            this.$router.push({name:'chatid'})
            // this.$store.dispatch("setpaginas", "chat");
        })
        

                
    },
    methods: {
        cargarChat(){
           
        }
    },
  computed: {
    currentView() {
      //console.log("estado", this.$store.state.paginascontent);
      return this.$store.state.paginascontent;
    },
  },
}
</script>