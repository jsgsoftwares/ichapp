<template>
  <tr>
    <td>
      <b-badge :variant="estado">{{ estado_user }}</b-badge>
    </td>
    <td class="product-name">{{ name }}</td>
    <td class="product-category">{{ email }}</td>
    <td>{{ rol }}</td>

    <td class="product-action">
      <a @click="edit(id)" class="mr-2"
        ><span class="action-edit"><i class="feather icon-edit"></i></span
      ></a>

      <a @click="eliminar(id)" class="mr-2"
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
    estado_user: String,
    creador: Number,
  },
  methods: {
    edit(id) {
      if (this.estado_user == "online") {
        this.$store.dispatch("getuserporid", id).then(() => {
          this.$store.dispatch("setpaginas", "edituser");
        });
      } else {
        this.$swal({
          title: "<strong>Pending close</strong>",
          icon: "info",
          html:
            "If the removal is after the first 5 days of the month, it will be pending closing until the next billing closing.",
          showCloseButton: true,

          confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
        });
      }
    },
    eliminar(id) {
      if (this.estado_user == "online" && this.creador != 1) {
        this.$swal({
          title: "Are you sure?",
          text: "User is deleted!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, Stop!",
        }).then((result) => {
          if (result.isConfirmed) {
            const params = {
              user_id: id,
            };
            this.$store.dispatch("PostDeleteUser", params).then(() => {
              this.$store
                .dispatch("getUserCompanie_dash", this.$store.state.user_id)
                .then(() => {
                  Swal.fire("Deleted!", "User deleted successfully", "success");
                  this.$store.dispatch("setpaginas", "usuarios");
                });
            });
          }
        });
      } else if (this.creador == 1) {
        this.$swal({
          title: "<strong>Original user</strong>",
          icon: "info",
          html: "Cannot delete original user",
          showCloseButton: true,

          confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
        });
      } else {
        this.$swal({
          title: "<strong>Pending close</strong>",
          icon: "info",
          html:
            "If the removal is after the first 5 days of the month, it will be pending closing until the next billing closing.",
          showCloseButton: true,

          confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
        });
      }
    },
  },
  computed: {
    estado() {
      let color = "danger";
      if (this.estado_user == "online") {
        color = "success";
      }
      return color;
    },
  },
};
</script>