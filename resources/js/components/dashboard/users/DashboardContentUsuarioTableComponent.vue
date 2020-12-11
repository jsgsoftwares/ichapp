<template>
    <tr>
        <overlay
            :opened="opened_"
            :visible="visible_"
            @closed="opened_ = visible_ = false"
        >
            <center>
                <b-spinner
                    style="width: 3rem; height: 3rem;"
                    label="Large Spinner"
                    type="grow"
                ></b-spinner>
            </center>
        </overlay>
        <td>
            <b-badge :variant="estado">{{ estado_u }}</b-badge>
        </td>
        <td class="product-name">{{ name }}</td>
        <td class="product-category">{{ email }}</td>
        <td>{{ rol }}</td>

        <td class="product-action">
            <a @click="edit(id)" class="p-2">
                <span class="action-edit"
                    ><i class="feather icon-edit"></i
                ></span>
            </a>
        </td>
        <td class="product-action">
            <a>
                <b-form-checkbox
                    class="action-edit"
                    v-model="checked"
                    @change="activarDesactivar(id)"
                    switch
                >
                </b-form-checkbox>
            </a>
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
        creador: Number
    },
    data() {
        return {
            opened: false,
            visible: false,
            opened_: false,
            visible_: false,
            checked: false,
            Upendientes: 0,
            Uactivos: 0,
            estado_u: "online"
        };
    },
    mounted() {
        this.estado_u = this.estado_user;
        if (this.estado_user == "online") {
            this.checked = true;
        } else if (this.estado_user == "disabled") {
            this.checked = false;
        }
    },
    methods: {
        UsuariosSubscritos() {
            return this.$store.dispatch("PostUsuariosSubscritos").then(() => {
                this.Uactivos = this.usuariosSubscrito.CantusuariosSubscrito;
                this.Upendientes = this.usuariosSubscrito.usuariosPendientes;
                this.$store
                    .dispatch("getUserCompanie_dash", this.$store.state.user_id)
                    .then(() => {});
                /* console.log('PENDIENTES',this.usuariosSubscrito.usuariosPendientes);
                 */
            });
        },
        activarDesactivar(id) {
            this.opened_ = true;
            this.visible_ = true;

            this.UsuariosSubscritos().then(() => {
                if (this.Upendientes < 1 && this.checked == true) {
                    //ACTIVAR menor a 1
                    this.opened_ = false;
                    this.visible_ = false;
                    this.$swal({
                        title: `To activate the user you must make a subscription or replace it with another subscribed`,
                        text: "Do you want to subscribe a new user?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, go subscribe!"
                    }).then(result => {
                        if (result.isConfirmed) {
                            this.UsuariosSubscritos();
                        } else {
                            this.checked = false;
                        }
                    });
                } else if (this.Upendientes > 0 && this.checked == true) {
                    //activar mayor a 1
                    const parametros = { user_id: id };

                    this.$store
                        .dispatch("PostUsuariosEnabled", parametros)
                        .then(() => {
                            this.opened_ = false;
                            this.visible_ = false;
                            this.estado_u = "online";
                            this.UsuariosSubscritos();
                        });
                } else if (this.checked == false) {
                    //DESACTIVAR mayor a 1
                    const parametros = { user_id: id };

                    this.$store
                        .dispatch("PostUsuarioDisable", parametros)
                        .then(() => {
                            this.estado_u = "disabled";
                            this.opened_ = false;
                            this.visible_ = false;
                            this.UsuariosSubscritos();
                        });
                }
            });
        },
        edit(id) {
            if (this.estado_user == "online") {
                this.checked = true;
                this.$store.dispatch("getuserporid", id).then(() => {
                    this.$store.dispatch("setpaginas", "edituser");
                });
            } else {
                this.checked = false;
                this.$swal({
                    title: "<strong>Pending close</strong>",
                    icon: "info",
                    html:
                        "If the removal is after the first 5 days of the month, it will be pending closing until the next billing closing.",
                    showCloseButton: true,

                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!'
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
                    confirmButtonText: "Yes, Stop!"
                }).then(result => {
                    if (result.isConfirmed) {
                        const params = {
                            user_id: id
                        };
                        this.$store
                            .dispatch("PostDeleteUser", params)
                            .then(() => {
                                this.$store
                                    .dispatch(
                                        "getUserCompanie_dash",
                                        this.$store.state.user_id
                                    )
                                    .then(() => {
                                        Swal.fire(
                                            "Deleted!",
                                            "User deleted successfully",
                                            "success"
                                        );
                                        this.$store.dispatch(
                                            "setpaginas",
                                            "usuarios"
                                        );
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

                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!'
                });
            } else {
                this.$swal({
                    title: "<strong>Pending close</strong>",
                    icon: "info",
                    html:
                        "If the removal is after the first 5 days of the month, it will be pending closing until the next billing closing.",
                    showCloseButton: true,

                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!'
                });
            }
        }
    },
    computed: {
        estado() {
            let color = "danger";
            if (this.estado_u == "online") {
                color = "success";
            }
            return color;
        },
        usuariosSubscrito() {
            return this.$store.state.usuariossubscritos;
        }
    }
};
</script>
