<template>
<div>
  <b-navbar toggleable="lg" variant="light">
    <b-navbar-brand href="#">
      <b-col cols="12" md="1" class="text-center mr-auto">
       <div>
  <b-button>Button</b-button>
  <b-button variant="danger">Button</b-button>
  <b-button variant="success">Button</b-button>
  <b-button variant="outline-primary">Button</b-button>
</div>
      </b-col>

    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav >
            <b-navbar-nav>
                <b-col cols="12" align-self="center" class="d-none d-md-block">
                    <p class="mb-1 font-weight-bold">{{contactName}}</p>
                    <p class="text-mute small mb-2">Activo hace 10 min</p>
                </b-col>
            </b-navbar-nav>

      <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">

                        <b-nav-item href="#">Trasferir</b-nav-item>
                        <b-nav-item href="#" >video</b-nav-item>
                        <b-nav-item href="#" >Info</b-nav-item>
                   
  
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</div >
  
<!-- 
  <b-media :right-align="receptor" vertical-align="center" class="mb-2" >
        <template v-slot:aside class="w-80">
          <b-img  rounded="circle" alt="Circle image" width="50" heigth="50" :src="icono"></b-img> 
          </template>
        <b-card class="rounded-pill" :bg-variant="variant" >
              {{dialogo}}    
        </b-card >

  </b-media> -->

<!-- <div class="clearfix" >
  <div class="border" style="background-color:red">
   
    <b-img  :right="receptor" rounded="circle" alt="Circle image" width="50" heigth="50" :src="icono" ></b-img>
    <p :right="receptor" class="border" style="background-color:green">
      {{dialogo}}
    </p>

  </div>

  
  
</div> -->
</template>
<style >

.card_style {
    max-height : calc(100vh - 70px);
    overflow-y : auto;
}
</style>
<script>
    export default {
      props:
      {
        contactId:Number,
        contactName:String
      },
      data(){

        return{
      
          newMessage:'',
        
        };
      },
        mounted() {
            //this.getMessages();
            
        }
      

    }
</script>
