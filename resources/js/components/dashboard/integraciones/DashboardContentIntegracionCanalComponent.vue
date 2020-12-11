<template>
    <div class="col-xl-4 col-md-6 col-sm-12 profile-card-1">
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
        <div class="card">
            <div class="card-header mx-auto" v-if="canal == 3">
                <div class="avatar avatar-xl">
                    <img
                        class="img-fluid"
                        :src="avatar"
                        alt="img placeholder"
                        v-bind:style="gray"
                    />
                </div>
                <i class="feather icon-refresh-cw"></i>

                <div class="avatar avatar-xl">
                    <img
                        class="img-fluid"
                        src="/assets/icons/whatsapp.jpg"
                        alt="img placeholder"
                        v-bind:style="gray"
                    />
                </div>
            </div>

            <div class="card-header mx-auto" v-else>
                <div class="avatar avatar-xl">
                    <img
                        class="img-fluid"
                        :src="avatar"
                        alt="img placeholder"
                        v-bind:style="gray"
                    />
                </div>
            </div>
            <div class="card-content">
                <div class="card-body text-center">
                    <h4>{{ name }}</h4>
                    <p class="">{{ description }}</p>
                    <div class="card-btns d-flex justify-content-between">
                        <button
                            class="btn "
                            v-bind:style="botongray"
                            @click="modal(name, canal)"
                            style
                        >
                            {{ botonConect }}
                        </button>
                    </div>
                    <hr class="my-1" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        id: Number,
        name: String,
        canal: Number,
        avatar: String,
        description: String
    },
    data() {
        return {
            opened_: false,
            visible_: false,
            gray: "filter: grayscale(1)",
            botongray: "background-color:rgb(115, 103, 240); color:white;",
            botonConect: "Subscribe",
            checked: false,
            telegram: [],
            token_telegram: "",
            callbackUrl: "Copy  Texts",
            state: {
                modalstate: "",
                canal: null,
                dialogactive: false,
                whatsappactive: false,
                telegramactive: false,
                messengeractive: false,
                twitteractive: false,
                instagramactive: false
            }
        };
    },
    components: {
        waping: {
            template: "<dashintegracionwaping_component/>"
        }
    },
    mounted() {
        this.$store.dispatch("getSubscripciones", 0).then(() => {
            if (this.subscription.length > 0) {
                this.subscription.map(res => {
                    /*  PRODUCTOS

                1=USUARIOS
                2=Dialogflow
                3=Waping
                4=telegram
                5=facebook
                */

                    if (
                        res.product_id == 2 &&
                        res.enabled == 1 &&
                        this.canal == 7
                    ) {
                        this.gray = "filter: grayscale(0)";
                        this.botongray = "background-color:green; color:white;";
                        this.botonConect = "Connect";
                        //this.state.dialogactive = true;
                    }

                    if (
                        res.product_id == 3 &&
                        res.enabled == 1 &&
                        this.canal == 3
                    ) {
                        this.gray = "filter: grayscale(0)";
                        this.botonConect = "Connect";
                        this.botongray = "background-color:green; color:white;";
                        //this.state.whatsappactive = true;
                    }
                    if (
                        res.product_id == 4 &&
                        res.enabled == 1 &&
                        this.canal == 2
                    ) {
                        this.gray = "filter: grayscale(0)";
                        this.botonConect = "Connect";
                        this.botongray = "background-color:green; color:white;";
                    }
                    if (
                        res.product_id == 5 &&
                        res.enabled == 1 &&
                        this.canal == 4
                    ) {
                        this.gray = "filter: grayscale(0)";
                        this.botonConect = "Connect";
                        this.botongray = "background-color:green; color:white;";
                    }
                });
            }
        });
    },
    methods: {
        modal(name, canal) {
            let thi = this;
            this.opened_ = true;
            this.visible_ = true;
            let encontrado = 0;
            this.$store
                .dispatch("PostIntegraciones", this.$store.state.user_id)
                .then(() => {
                    thi.opened_ = false;
                    thi.visible_ = false;
                    setTimeout(() => {
                        this.state.modalstate = name.toLowerCase().trim();
                        this.state.canal = canal;
                        if (this.state.canal == 2) {
                            this.subscription.map(function(res) {
                                if (res.product_id == 4 && res.enabled == 1) {
                                    encontrado = 1;
                                }
                            });
                            if (encontrado == 1) {
                                this.$store.dispatch(
                                    "setpaginas",
                                    "integraTelegram"
                                );
                            } else {
                                this.mensajeHabilitar("Telegram");
                            }
                        } else if (this.state.canal == 4) {
                            this.subscription.map(function(res) {
                                if (res.product_id == 5 && res.enabled == 1) {
                                    encontrado = 1;
                                    thi.opened_ = false;
                                    thi.visible_ = false;
                                }
                            });
                            if (encontrado == 1) {
                                this.$store.dispatch(
                                    "setpaginas",
                                    "integraFacebook"
                                );
                            } else {
                                this.mensajeHabilitar("Messenger");
                            }
                        } else if (this.state.canal == 7) {
                            this.subscription.map(function(res) {
                                if (res.product_id == 2 && res.enabled == 1) {
                                    encontrado = 1;
                                }
                            });
                            if (encontrado == 1) {
                                this.$store.dispatch(
                                    "setpaginas",
                                    "AIDialogflow"
                                );
                            } else {
                                this.mensajeHabilitar("DialogFlow");
                            }
                            // this.$store.dispatch("setpaginas", "AIDialogflow");
                        } else if (this.state.canal == 3) {
                            this.subscription.map(function(res) {
                                if (res.product_id == 3 && res.enabled == 1) {
                                    encontrado = 1;
                                }
                            });
                            if (encontrado == 1) {
                                this.$store.dispatch(
                                    "setpaginas",
                                    "integraWaping"
                                );
                            } else {
                                this.mensajeHabilitar("DialogFlow");
                            }
                            // this.$store.dispatch("setpaginas", "integraWaping");
                        }
                    }, 600);
                });
        },
        habilitarcanal() {
            this.$store.dispatch(
                "PostIntegraciones",
                this.$store.state.user_id
            );
            if (this.state.canal == 2) {
                const params = {
                    user_id: this.$store.state.user_id,
                    token: this.token_telegram,
                    enabled: 1
                };
                // console.log(params);
                this.$store.dispatch("PostUpdateTelegram", params);
            }

            this.$refs[this.state.modalstate].hide();
        },
        deshabilitarcanal() {
            this.$refs[this.state.modalstate].hide();
        },
        cambio() {
            if (!this.checked) {
                const params = {
                    user_id: this.$store.state.user_id,
                    token: this.token_telegram,
                    enabled: 1
                };
                // console.log(params);
                this.$store.dispatch("PostUpdateTelegram", params);
                this.$store.dispatch(
                    "PostIntegraciones",
                    this.$store.state.user_id
                );
            } else {
                const params = {
                    user_id: this.$store.state.user_id,
                    token: this.token_telegram,
                    enabled: 0
                };
                // console.log(params);
                this.$store.dispatch("PostUpdateTelegram", params);
                this.$store.dispatch(
                    "PostIntegraciones",
                    this.$store.state.user_id
                );
            }
        },
        clipboardSuccessHandler({ value, event }) {
            console.log("success", value);
        },
        clipboardErrorHandler({ value, event }) {
            console.log("error", value);
        },
        showAlert() {
            // Use sweetalert2
            this.$swal("Hello Vue world!!!");
        },
        mensajeHabilitar(canal) {
            this.$swal({
                title: `The channel ${canal} is not subscribed`,
                text: "Do you want to subscribe?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, go subscribe!"
            }).then(result => {
                if (result.isConfirmed) {
                    this.$store.dispatch("setpaginas", "upgrade");
                }
            });
        }
    },
    computed: {
        habilitado() {
            return !this.checked;
        },
        subscription() {
            return this.$store.state.subscripcion;
        },
        dialogflowA() {
            return this.state.dialogactive;
        },
        whatsappactiveA() {
            return this.state.whatsappactive;
        },
        telegramactiveA() {
            return this.state.telegramactive;
        },
        messengeractiveA() {
            return this.state.messengeractive;
        },
        twitteractiveA() {
            return this.state.twitteractive;
        },
        instagramactiveA() {
            return this.state.instagramactive;
        }
    }
};
</script>
