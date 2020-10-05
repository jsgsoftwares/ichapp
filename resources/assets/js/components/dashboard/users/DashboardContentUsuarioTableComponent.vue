<template>
  <tr>
    <td></td>
    <td class="product-name">{{ name }}</td>
    <td class="product-category">{{ email }}</td>
    <td>{{ rol }}</td>

    <td class="product-action">
      <a @click="edit(id)"
        ><span class="action-edit"><i class="feather icon-edit"></i></span
      ></a>
      <a @click="eliminar(id)"
        ><span class="action-delete"><i class="feather icon-trash"></i></span
      ></a>
    </td>
  </tr>
</template>
<script>
export default {
  props: {
    name: String,
    email: String,
    rol: String,
    rol_id: Number,
    id: Number,
  },
  methods: {
    edit(id) {
      alert(id);
    },
    eliminar(id) {
      alert(id);
    },
  },
};
</script>