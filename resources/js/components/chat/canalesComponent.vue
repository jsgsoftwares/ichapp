<template>
  <div>
    <li>
      <a href="#" class="facebook">
        <b-img rounded="circle" alt="Circle image" width="20" heigth="20" :src="icono"></b-img>
        <span class="mt-4" style="font-size:14px">{{data}}</span>
      </a>
    </li>
  </div>
</template>

<script>
export default {
  props: {
    dato: String,
    canal: String,
    icono: String,
    id: 0,
  },
  data() {
    return {};
  },
  mounted() {
    //this.getConversation()
  },
  computed: {
    data() {
      if (this.canal == "facebook") {
        return "facebook";
      } else {
        return this.dato;
      }
    },
  },
};
</script>
