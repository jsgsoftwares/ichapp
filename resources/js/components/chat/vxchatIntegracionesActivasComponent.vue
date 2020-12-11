<template>
   <div>
       <b-row>
            <b-col class="mt-2 m-1">
                Channels:
             </b-col>
            <b-col>
                <img class="mt-1" v-if="dialogflowA" src="/assets/icons/dialogflow.png"  height="28px" width="28px"/>
                <img class="mt-1" v-else src="/assets/icons/dialogflow.png" style="filter: grayscale(1);" height="28px" width="28px"/>
            </b-col>
            <b-col>
                <img class="mt-1" v-if="whatsappactiveA" src="/assets/icons/whatsapp.png" height="28px" width="28px"/>
                <img class="mt-1" v-else src="/assets/icons/whatsapp.png" style="filter: grayscale(1);" height="28px" width="28px"/>
            </b-col>
            <b-col>
                <img class="mt-1" v-if="telegramactiveA" src="/assets/icons/telegram.png" height="25px" width="25px"/>
                <img class="mt-1" v-else src="/assets/icons/telegram.png" style="filter: grayscale(1);" height="28px" width="28px"/>
            </b-col>
            <b-col>
                <img class="mt-1" v-if="messengeractiveA" src="/assets/icons/facebook.png" height="28px" width="28px"/>
                <img class="mt-1" v-else src="/assets/icons/facebook.png" style="filter: grayscale(1);"  height="28px" width="28px"/>
            </b-col>

            <b-col v-if="twitteractiveA">
                <img class="mt-1" v-if="twitteractiveA"  src="/assets/icons/twitter.png" height="28px" width="28px"/>
                <img class="mt-1" v-else src="/assets/icons/twitter.png" style="filter: grayscale(1);"  height="28px" width="28px"/>
            </b-col>
            <b-col v-if="instagramactiveA">
                <img class="mt-1" v-if="instagramactiveA" src="/assets/icons/instagram.png" height="28px" width="28px"/>
                <img class="mt-1" v-else src="/assets/icons/instagram.png" style="filter: grayscale(1);"  height="28px" width="28px"/>
            </b-col>
         <!--    <b-col>
            <img src="/assets/icons/dialogflow.png" height="28px" width="28px"/>
            </b-col> -->
       </b-row>
       </div> 
</template>
<script>
export default {
      data() {
    return {
      show: false,
      state:{
          dialogactive:false,
          whatsappactive:false,
          telegramactive:false,
          messengeractive:false,
          twitteractive:false,
          instagramactive:false,
          }
    };
  },
  mounted() {
  
      

       if(this.subscripcion.length>0){

            this.subscripcion.map((res) => {
                /*  PRODUCTOS

                1=USUARIOS
                2=Dialogflow
                3=Waping
                4=telegram
                5=facebook
                */
              
                if (res.product_id== 2 && res.enabled==1) {
                    this.state.dialogactive = true;
                }
                if (res.product_id== 3 && res.enabled==1) {
                    this.state.whatsappactive = true;
                } 
                if (res.product_id== 4 && res.enabled==1) {
                    this.state.telegramactive = true;
                } 
                if (res.product_id== 5 && res.enabled==1) {
                    this.state.messengeractive = true;
                } 
            });
            
       }

   },

    computed: {
        dialogflowA(){
            return this.state.dialogactive;
        },
        whatsappactiveA(){
            return this.state.whatsappactive;
        },
        telegramactiveA(){
            return this.state.telegramactive;
        },
        messengeractiveA(){
            return this.state.messengeractive;
        },
        twitteractiveA(){
            return this.state.twitteractive;
        },
        instagramactiveA(){
            return this.state.instagramactive;
        },
        subscripcion(){
            
            return this.$store.state.subscripcion
        }

    },
}
</script>