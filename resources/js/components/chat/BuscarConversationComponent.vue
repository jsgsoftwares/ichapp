<template>

<div>
  <b-card no-body 

  header-text-variant="white"
  header-tag="header"
  header-bg-variant="dark"
  >
    <b-card-body class="card_style  ">
      <SearchConversation></SearchConversation>
    </b-card-body>

  </b-card>
</div>

</template>
<script>
  export default {
    props:
      {
      
      },
    data() {
      return {

      }
    },
    computed: {
     
    },
    mounted() {
      
    },
    methods: {
       /*    this.$store.dispatch('PostInfoClientecanal',conversation);
                this.$store.dispatch('PostInfoCliente',conversation); */
    }
  }
</script>