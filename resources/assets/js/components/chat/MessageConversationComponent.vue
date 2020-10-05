<template >
<div>
<div v-if="receptor">
    <div class="outgoing_msg" style="overflow:hidden; margin:26px 0 26px;" variant="success">
      <div class="sent_msg" style="float: right;width: 76% ;">
        <p style=" background: #109EA0;none repeat scroll 0 0;border-radius: 10px;color: #fffff;font-size: 14px;padding: 10px 10px 10px 12px;">{{dialogo}}</p>
        <span 
        style="
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;"> 
        {{hora_sent}}    |    {{lasTime}}
        </span>
       </div>
    </div>
</div>

 <div v-else>
    <div class="incoming_msg" style="overflow:hidden; margin:26px 0 26px;">
    <div class="incoming_msg_img" style="display: inline-block;width: 6%;">
      <!-- <b-img :src="icono" alt="sunil" width="29px" height="29px"></b-img> -->
    </div>
      <div class="received_msg" style="display: inline-block; padding: 0 0 0 10px;vertical-align: top; width: 92%;">
        <div class="received_withd_msg">
            <p style="background: #ebebeb  none repeat scroll 0 0;border-radius: 10px;color: #fffff;font-size: 14px;margin: 0;padding: 10px 10px 10px 12px;width: 100%;">{{dialogo}}</p>
            <span 
            style="
            color: #747474;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;"> 
            {{hora_sent}}    |    {{lasTime}}
            </span>
            </div>
      </div>
  </div>
 </div>
</div>


</template>
 
 
<script>
    export default {
      props: {
              'receptor':Boolean,
              'variant':'',
              'icono':'',
              dialogo:String,
              hora:''

    },
        data()
        {
          return{
            content:'abc',
            state:{
                lasTime_message:'',
            },

          };

        },

        mounted() {
          this.state.lasTime_message= moment(this.hora , "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();
                setInterval(() => 
                { 
                this.lasTime_message_metodo();
                }, 
                1000)
        },
        methods:{
          lasTime_message_metodo()
          {
              this.state.lasTime_message= moment(this.hora , "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();
              
          },
          alinear()
          {
             
            if(receptor)
            {
              return "Right image"
            }
            else
            {
              return "Left image"
            }
          }
        },
          computed:
        {
            lasTime()
            {
               return this.state.lasTime_message;
                //return moment(this.hora , "YYYY-MM-DD hh:mm:ss").locale('es').fromNow();
            },
            hora_sent()
            {
              return moment(this.hora , "YYYY-MM-DD hh:mm:ss").format('LT');
            }
        }
    }
</script>
