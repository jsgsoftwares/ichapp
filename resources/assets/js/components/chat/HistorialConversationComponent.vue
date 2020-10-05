<template >
  <div>
    <div class="outgoing_msg" style="overflow:hidden; margin:26px 0 26px;" variant="success">
      <div class="sent_msg" style="float: right;width: 76% ;">
        <p
          style=" background: #109EA0;none repeat scroll 0 0;border-radius: 10px;color:black;font-size: 14px;padding: 10px 10px 10px 12px;"
        >{{consulta}}</p>
        <span
          style="
        color: #747474;
        display: block;
        font-size: 12px;
        margin: 8px 0 0;"
        >{{usuario}} | {{lasTime}} | {{hora_sent}}</span>
      </div>
    </div>
  </div>
</template>
<style >
.card_style {
  max-height: calc(100vh - 70px);
  overflow-y: auto;
}
</style>
<script>
export default {
  props: {
    consulta: String,
    hora: Date,
    usuario: "",
    hora: "",
  },
  data() {
    return {
      content: "abc",
    };
  },

  mounted() {
    console.log("valor de horad.", this.hora);
  },
  computed: {
    lasTime() {
      return moment(this.hora, "YYYY-MM-DD hh:mm:ss").locale("es").fromNow();
    },
    hora_sent() {
      return moment(this.hora, "YYYY-MM-DD hh:mm:ss").format("LT");
    },
  },
};
</script>
