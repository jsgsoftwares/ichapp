<template>
    <div class="app-content content bg-white">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <overlay
            :opened="opened"
            :visible="visible"
            @closed="opened = visible = false"
        >
            <b-spinner label="Loading..."></b-spinner>
            Loading...
        </overlay>
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
        <div class="content-wrapper" v-if="!visible">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">
                                Subscritions
                            </h2>
                        </div>
                        <div class="col-12">
                            <h6
                                class="content-header-title float-left mb-0"
                            ></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="h-100  ">
                    <div class="container h-100">
                        <div class="row justify-content-center h-100 ">
                            <div class="col-sm-8 align-self-center text-center">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div
                                            action="#"
                                            class="icons-tab-steps checkout-tab-steps wizard-circle"
                                        >
                                            <div class=" bg-success">
                                                <div class="checkout-options">
                                                    <div class="card">
                                                        <div
                                                            class="card-content"
                                                        >
                                                            <div
                                                                class="card-body"
                                                            >
                                                                <p
                                                                    class="options-title"
                                                                >
                                                                    Plan
                                                                    {{ name }}
                                                                </p>

                                                                <hr />
                                                                <div
                                                                    class="price-details"
                                                                >
                                                                    <p></p>
                                                                </div>
                                                                <div
                                                                    class="detail"
                                                                >
                                                                    <div
                                                                        class="detail-title"
                                                                    >
                                                                        Users
                                                                    </div>

                                                                    <div
                                                                        class="detail-amt emi-details"
                                                                    >
                                                                        ${{
                                                                            usuarios_totales
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="detail"
                                                                >
                                                                    <div
                                                                        class="detail-title"
                                                                    >
                                                                        Telegram
                                                                    </div>

                                                                    <div
                                                                        class="detail-amt discount-amt"
                                                                    >
                                                                        $0
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="detail"
                                                                >
                                                                    <div
                                                                        class="detail-title"
                                                                    >
                                                                        Facebook
                                                                        messenger
                                                                    </div>

                                                                    <div
                                                                        class="detail-amt discount-amt"
                                                                    >
                                                                        $0
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="detail"
                                                                >
                                                                    <div
                                                                        class="detail-title"
                                                                    >
                                                                        DialogFlow
                                                                        Ai
                                                                    </div>

                                                                    <div
                                                                        class="detail-amt emi-details"
                                                                    >
                                                                        ${{
                                                                            dialog_totales
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="detail"
                                                                >
                                                                    <div
                                                                        class="detail-title"
                                                                    >
                                                                        Whatsapp
                                                                        with
                                                                        waping
                                                                    </div>

                                                                    <div
                                                                        class="detail-amt emi-details"
                                                                    >
                                                                        ${{
                                                                            waping_totales
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <hr />
                                                                <div
                                                                    class="detail"
                                                                >
                                                                    <div
                                                                        class="detail-title detail-total"
                                                                    >
                                                                        Total
                                                                    </div>
                                                                    <div
                                                                        class="detail-amt total-amt"
                                                                    >
                                                                        ${{
                                                                            totales
                                                                        }}
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <p
                                                                        class=" btn-block "
                                                                        v-if="
                                                                            finaliza
                                                                        "
                                                                    >
                                                                        Subscription
                                                                        ends the
                                                                        day
                                                                        <strong
                                                                            >{{
                                                                                subs
                                                                            }}</strong
                                                                        >
                                                                    </p>

                                                                    <button
                                                                        @click="
                                                                            cancelar()
                                                                        "
                                                                        class="btn btn-danger  "
                                                                        v-if="
                                                                            !finaliza &&
                                                                                subs_id !=
                                                                                    2
                                                                        "
                                                                    >
                                                                        Cancel
                                                                        Subscription
                                                                    </button>

                                                                    <button
                                                                        @click="
                                                                            editar()
                                                                        "
                                                                        class="btn btn-primary  "
                                                                    >
                                                                        Edit
                                                                        Subscription
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            subs_id: 0,
            usuarios_p: 0,
            waping_p: 0,
            dialog_p: 0,
            total_p: 0,
            name: "",
            mensualidad: "",
            subs: "",
            finaliza: false,
            spinner: true,
            opened: true,
            visible: true,
            opened_: false,
            visible_: false
        };
    },
    mounted() {
        this.cargar_plan();
    },
    methods: {
        cargar_plan() {
            (this.subs_id = 0),
                (this.usuarios_p = 0),
                (this.waping_p = 0),
                (this.dialog_p = 0),
                (this.total_p = 0),
                (this.name = ""),
                (this.mensualidad = ""),
                (this.subs = ""),
                (this.finaliza = false);
            this.$store.dispatch("Postproductsplansubscrito").then(() => {
                //console.log(this.$store.state.plansubscrito)
                this.plan_subscrito.map(plan => {
                    this.subs_id = plan.id;

                    this.name = plan.name;
                    this.mensualidad = plan.monthly_price;

                    /*           if(plan.monthly_price==10 ){
            this.finaliza=true;
          } */
                    if (plan.renewal_cancelled_at != null) {
                        this.finaliza = true;
                        this.subs = plan.finish_at;
                    }
                });
                this.spinner = false;
                this.visible = false;
            });
            this.$store.dispatch("Postproductsplanes").then(() => {
                this.productos.map(item => {
                    if (item.product_id == 1) {
                        this.usuarios_p++;
                        this.total_p += 10;
                    }
                    if (item.product_id == 2) {
                        this.dialog_p++;
                        this.total_p += 10;
                    }
                    if (item.product_id == 3) {
                        this.waping_p++;
                        this.total_p += 30;
                    }
                });
            });
        },
        cancelar() {
            this.$swal({
                title: "Are you sure you want to cancel your plan?",
                text:
                    " IChapp will change it to the free plan with 1 user, telegram and facebook for free",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, cancel my plan!"
            }).then(result => {
                if (result.isConfirmed) {
                    (this.opened_ = true),
                        (this.visible_ = true),
                        this.$store.dispatch("PostplanBasico").then(() => {
                            (this.opened_ = false),
                                (this.visible_ = false),
                                this.cargar_plan();

                            this.$swal(
                                "canceled!",
                                "Your Subscription has been canceled.",
                                "success"
                            );
                        });
                }
            });
        },
        editar() {
            this.$store.dispatch("setpaginas", "editplan");
        }
    },
    computed: {
        productos() {
            return this.$store.state.productsubscriptos;
        },
        usuarios() {
            return this.usuarios_p;
        },
        dialog() {
            return this.dialog_p;
        },
        waping() {
            return this.waping_p;
        },
        usuarios_totales() {
            return `${this.usuarios_p * 10 - 10}`;
        },
        dialog_totales() {
            if (this.dialog_p > 0) {
                return 10;
            }

            return 0;
        },
        waping_totales() {
            if (this.waping_p > 0) {
                return 30;
            }

            return 0;
        },
        totales() {
            return this.total_p - 10;
        },
        plan_subscrito() {
            return this.$store.state.plansubscrito;
        }
    }
};
</script>
