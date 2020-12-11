<template>
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
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
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">
                                Subscritions
                            </h2>
                        </div>
                        <div class="col-12">
                            <h6 class="content-header-title float-left mb-0">
                                Checkout
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div
                    action="#"
                    class="icons-tab-steps checkout-tab-steps wizard-circle"
                >
                    <fieldset class="checkout-step-1 px-0">
                        <section
                            id="place-order"
                            class="list-view product-checkout"
                        >
                            <div class="checkout-items">
                                <!-- user -->
                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a
                                                href="app-ecommerce-details.html"
                                            >
                                                <img
                                                    src="/assets/icons/agentes.png"
                                                    height="150px"
                                                    width="150px"
                                                    alt="img-placeholder"
                                                />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a
                                                    >Agents 10$/per user per
                                                    month</a
                                                >
                                                <span></span>
                                                <p class="item-company">
                                                    By
                                                    <span class="company-name"
                                                        >ichapp</span
                                                    >
                                                </p>
                                                <p class="stock-status-in">
                                                    In Stock
                                                </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    Quantity
                                                </p>
                                                <div
                                                    class="input-group quantity-counter-wrapper bootstrap-touchspin"
                                                >
                                                    <span
                                                        class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                                                    >
                                                        <button
                                                            class="btn btn-primary bootstrap-touchspin-down"
                                                            type="button"
                                                            @click="
                                                                bajar_user()
                                                            "
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            -
                                                        </button>
                                                    </span>

                                                    <input
                                                        type="text"
                                                        class="quantity-counter form-control"
                                                        :value="valor_user"
                                                        readonly
                                                    />

                                                    <span
                                                        class="input-group-btn input-group-append bootstrap-touchspin-injected"
                                                    >
                                                        <button
                                                            class="btn btn-primary bootstrap-touchspin-up"
                                                            type="button"
                                                            @click="
                                                                subir_user()
                                                            "
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            +
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--  <p class="delivery-date">Delivery by, Wed Apr 25</p>
                                            <p class="offers">17% off 4 offers Available</p> -->
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div
                                                        class="badge badge-primary badge-md"
                                                    >
                                                        4
                                                        <i
                                                            class="feather icon-star ml-25"
                                                        ></i>
                                                    </div>
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        ${{ pago_user }}
                                                    </h6>
                                                    <p class="shipping">
                                                        <i
                                                            class="feather icon-shopping-cart"
                                                        ></i>
                                                        1 user free
                                                    </p>
                                                </div>
                                            </div>
                                            <!--   <div class="wishlist remove-wishlist">
                                                <i class="feather icon-x align-middle"></i> Remove
                                            </div>
                                            <div class="cart remove-wishlist">
                                                <i class="fa fa-heart-o mr-25"></i> Wishlist
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- canales -->
                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a
                                                href="app-ecommerce-details.html"
                                            >
                                                <img
                                                    src="/assets/icons/telegram.png"
                                                    height="80px"
                                                    width="80px"
                                                    alt="img-placeholder"
                                                />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a
                                                    href="app-ecommerce-details.html"
                                                    >Telegram Free</a
                                                >
                                                <span></span>
                                                <p class="item-company">
                                                    By
                                                    <span class="company-name"
                                                        >Ichapp</span
                                                    >
                                                </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    Quantity
                                                </p>
                                                <div
                                                    class="input-group quantity-counter-wrapper bootstrap-touchspin"
                                                >
                                                    <span
                                                        class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-down"
                                                            type="button"
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            -
                                                        </button></span
                                                    ><input
                                                        type="text"
                                                        class="quantity-counter form-control"
                                                        value="1"
                                                        readonly
                                                    /><span
                                                        class="input-group-btn input-group-append bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-up"
                                                            type="button"
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            +
                                                        </button></span
                                                    >
                                                </div>
                                            </div>
                                            <!--                                             <p class="delivery-date">Delivery by, Wed Apr 25</p>
                                            <p class="offers">17% off 4 offers Available</p> -->
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div
                                                        class="badge badge-primary badge-md"
                                                    >
                                                        5
                                                        <i
                                                            class="feather icon-star ml-25"
                                                        ></i>
                                                    </div>
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        $0
                                                    </h6>
                                                    <p class="shipping">
                                                        <i
                                                            class="feather icon-shopping-cart"
                                                        ></i>
                                                        Free
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a
                                                href="app-ecommerce-details.html"
                                            >
                                                <img
                                                    src="/assets/icons/facebook.png"
                                                    height="100px"
                                                    width="100px"
                                                    alt="img-placeholder"
                                                />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a
                                                    href="app-ecommerce-details.html"
                                                    >Messenger Facebook free</a
                                                >
                                                <span></span>
                                                <p class="item-company">
                                                    By
                                                    <span class="company-name"
                                                        >Ichapp</span
                                                    >
                                                </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    Quantity
                                                </p>
                                                <div
                                                    class="input-group quantity-counter-wrapper bootstrap-touchspin"
                                                >
                                                    <span
                                                        class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-down"
                                                            type="button"
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            -
                                                        </button></span
                                                    ><input
                                                        type="text"
                                                        class="quantity-counter form-control"
                                                        value="1"
                                                        readonly
                                                    /><span
                                                        class="input-group-btn input-group-append bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-up"
                                                            type="button"
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            +
                                                        </button></span
                                                    >
                                                </div>
                                            </div>
                                            <!--                                             <p class="delivery-date">Delivery by, Wed Apr 25</p>
                                            <p class="offers">17% off 4 offers Available</p> -->
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div
                                                        class="badge badge-primary badge-md"
                                                    >
                                                        5
                                                        <i
                                                            class="feather icon-star ml-25"
                                                        ></i>
                                                    </div>
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        $0
                                                    </h6>
                                                    <p class="shipping">
                                                        <i
                                                            class="feather icon-shopping-cart"
                                                        ></i>
                                                        Free
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a
                                                href="app-ecommerce-details.html"
                                            >
                                                <img
                                                    src="/assets/icons/dialogflow.png"
                                                    height="100px"
                                                    width="100px"
                                                    alt="img-placeholder"
                                                />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a
                                                    href="app-ecommerce-details.html"
                                                    >DialogFlow AI 10$/per
                                                    month</a
                                                >
                                                <span></span>
                                                <p class="item-company">
                                                    By
                                                    <span class="company-name"
                                                        >Ichapp</span
                                                    >
                                                </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    Quantity
                                                </p>
                                                <div
                                                    class="input-group quantity-counter-wrapper bootstrap-touchspin"
                                                >
                                                    <span
                                                        class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-down"
                                                            type="button"
                                                            @click="
                                                                bajar_dialog()
                                                            "
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            -
                                                        </button></span
                                                    ><input
                                                        type="text"
                                                        class="quantity-counter form-control"
                                                        :value="dialogadd"
                                                        readonly
                                                    /><span
                                                        class="input-group-btn input-group-append bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-up"
                                                            type="button"
                                                            @click="
                                                                subir_dialog()
                                                            "
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            +
                                                        </button></span
                                                    >
                                                </div>
                                            </div>
                                            <!--                                             <p class="delivery-date">Delivery by, Wed Apr 25</p>
                                <p class="offers">17% off 4 offers Available</p> -->
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div
                                                        class="badge badge-primary badge-md"
                                                    >
                                                        5
                                                        <i
                                                            class="feather icon-star ml-25"
                                                        ></i>
                                                    </div>
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        ${{ pago_dialog }}
                                                    </h6>
                                                    <p class="shipping">
                                                        <i
                                                            class="feather icon-shopping-cart"
                                                        ></i>
                                                        Per month
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a
                                                href="app-ecommerce-details.html"
                                            >
                                                <img
                                                    src="/assets/icons/whatsapp.png"
                                                    height="100px"
                                                    width="100px"
                                                    alt="img-placeholder"
                                                />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a
                                                    href="app-ecommerce-details.html"
                                                    >Whatsapp by Waping 30$/per
                                                    month</a
                                                >
                                                <span></span>
                                                <p class="item-company">
                                                    By
                                                    <span class="company-name"
                                                        >waping</span
                                                    >
                                                </p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">
                                                    Quantity
                                                </p>
                                                <div
                                                    class="input-group quantity-counter-wrapper bootstrap-touchspin"
                                                >
                                                    <span
                                                        class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-down"
                                                            type="button"
                                                            @click="
                                                                bajar_waping()
                                                            "
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            -
                                                        </button></span
                                                    ><input
                                                        type="text"
                                                        class="quantity-counter form-control"
                                                        :value="wapingadd"
                                                        readonly
                                                    /><span
                                                        class="input-group-btn input-group-append bootstrap-touchspin-injected"
                                                        ><button
                                                            class="btn btn-primary bootstrap-touchspin-up"
                                                            type="button"
                                                            @click="
                                                                subir_waping()
                                                            "
                                                            :disabled="
                                                                desabilitaBotonesporrenderisado
                                                            "
                                                        >
                                                            +
                                                        </button></span
                                                    >
                                                </div>
                                            </div>
                                            <!--                                             <p class="delivery-date">Delivery by, Wed Apr 25</p>
                                <p class="offers">17% off 4 offers Available</p> -->
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div
                                                        class="badge badge-primary badge-md"
                                                    >
                                                        4
                                                        <i
                                                            class="feather icon-star ml-25"
                                                        ></i>
                                                    </div>
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        ${{ pago_waping }}
                                                    </h6>
                                                    <p class="shipping">
                                                        <i
                                                            class="feather icon-shopping-cart"
                                                        ></i>
                                                        Per month
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p class="options-title">
                                                Subscribe
                                            </p>
                                            <!--                       <div class="coupons">
                        <div class="coupons-title">
                          <p>Coupons</p>
                        </div>
                        <div class="apply-coupon">
                          <p>Apply</p>
                        </div>
                      </div> -->
                                            <hr />
                                            <div class="price-details">
                                                <p>Price Details</p>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Users
                                                </div>
                                                <div
                                                    class="detail-amt emi-details"
                                                >
                                                    ${{ pago_user }}
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Telegram
                                                </div>
                                                <div
                                                    class="detail-amt discount-amt"
                                                >
                                                    $0
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Facebook messenger
                                                </div>
                                                <div
                                                    class="detail-amt discount-amt"
                                                >
                                                    $0
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    DialogFlow Ai
                                                </div>
                                                <div
                                                    class="detail-amt emi-details"
                                                >
                                                    ${{ pago_dialog }}
                                                </div>
                                            </div>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Whatsapp with waping
                                                </div>
                                                <div
                                                    class="detail-amt emi-details"
                                                >
                                                    ${{ pago_waping }}
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="detail">
                                                <div
                                                    class="detail-title detail-total"
                                                >
                                                    Total
                                                </div>
                                                <div
                                                    class="detail-amt total-amt"
                                                    @change="cambiTotal()"
                                                >
                                                    ${{ total }}
                                                </div>
                                            </div>

                                            <!-- BOTONES DE SUBSCRIPTION -->
                                            <div
                                                v-if="
                                                    subscripcion_diferente_a_la_actual
                                                "
                                            >
                                                <div v-if="boton_plan_basico">
                                                    <button
                                                        @click="
                                                            BajarPlanBasico()
                                                        "
                                                        class="btn btn-primary btn-block "
                                                    >
                                                        Subscribe plan basic
                                                    </button>
                                                </div>
                                                <div v-else>
                                                    <div
                                                        id="paypal-button-container"
                                                        class="payclass"
                                                        v-if="creabotonpaypal"
                                                    ></div>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <button
                                                    @click="
                                                        ActualizaProductos()
                                                    "
                                                    class="btn btn-primary btn-block "
                                                >
                                                    Updates products
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            boton_de_plan_basico: true,
            subscripcion_diferente_a_la_actual: false,
            creabotonpaypal: false,
            plan_act: 0,
            valor_user: 0,
            pago_user: 0,
            pago_dialog: 0,
            dialogadd: 0,
            pago_waping: 0,
            wapingadd: 0,
            renderisar: 0,
            opened_: false,
            visible_: false,
            desabilitaBotonesporrenderisado: false,
            accesstoken: "sin-token",
            subscriptionid: "",
            state: {
                plan_paypal: "P-91534868U2353433WL6VIDHY",
                respuestapaypal: []
            }
        };
    },
    mounted() {
        this.cargarInicio();
    },
    methods: {
        reiniciarVariables() {
            this.boton_de_plan_basico = true;
            this.subscripcion_diferente_a_la_actual = false;
            this.creabotonpaypal = false;
            this.plan_act = 0;
            this.valor_user = 0;
            this.pago_user = 0;
            this.pago_dialog = 0;
            this.dialogadd = 0;
            this.pago_waping = 0;
            this.wapingadd = 0;
            this.renderisar = 0;
            this.opened_ = false;
            this.visible_ = false;
            this.desabilitaBotonesporrenderisado = false;
            this.accesstoken = "sin-token";
        },
        cargarInicio() {
            console.log("cargando");
            this.reiniciarVariables();
            this.desabilitaBotonesporrenderisado = true;
            console.log("v-1.12");
            this.plan_Actual();

            this.$store.dispatch("getPlanes").then(() => {});
            this.$store.dispatch("Postproductsplanes").then(() => {
                this.productos.map(item => {
                    if (item.product_id == 1) {
                        this.valor_user;
                        this.valor_user++;
                        this.pago_user += 10;
                    }
                    if (item.product_id == 2) {
                        this.dialogadd++;
                        this.pago_dialog += 10;
                    }
                    if (item.product_id == 3) {
                        this.wapingadd++;
                        this.pago_waping += 30;
                    }
                });
                this.pago_user -= 10;
                this.subscripcion_diferente_a_la_actual = false;
                this.desabilitaBotonesporrenderisado = false;
            });
        },
        plan_Actual() {
            this.$store.dispatch("Postproductsplansubscrito").then(() => {
                this.plan_subscrito.map(plan => {
                    this.plan_act = plan.plan_id;
                    this.precio = plan.monthly_price;
                    this.subscriptionid = plan.subscription_id;
                });
            });
        },
        crearSubscription_paypal(valor_code, params) {
            var thi = this;
            setTimeout(() => {
                paypal
                    .Buttons({
                        createSubscription: function(data, actions) {
                            return actions.subscription.create({
                                plan_id: valor_code
                            });
                        },

                        onApprove: function(data, actions) {
                            const p = {
                                subscritor: data.subscriptionID,
                                body: params
                            };
                            thi.opened_ = true;
                            thi.visible_ = true;
                            axios
                                .post("/api/v1/user/planes", p)
                                .then(response => {
                                    thi.opened_ = false;
                                    thi.visible_ = false;
                                    thi.cargarInicio();
                                    thi.desabilitaBotonesporrenderisado = true;
                                    thi.subscripcion_diferente_a_la_actual = false;
                                    thi.actualizarIntegracion();
                                })
                                .catch(error => {
                                    console.log(error.response);
                                });
                        },
                        onError: function() {
                            return "error";
                        }
                    })
                    .render("#paypal-button-container");
                this.desabilitaBotonesporrenderisado = false;
            }, 500);
        },
        Updatesubscribe(valor_code, params, subscriptor) {
            var thi = this;
            setTimeout(() => {
                paypal
                    .Buttons({
                        createSubscription: function(data, actions) {
                            // SubscriptionId - The current subscription Id of the buyer. I-XXXXXXXXX
                            // plan_id : The new Plan id which the buyer wish to opt in.
                            // Buyer must login and approve the revision.\
                            console.log("subs", subscriptor);
                            return actions.subscription.revise(subscriptor, {
                                plan_id: valor_code
                            });
                        },

                        onApprove: function(data, actions) {
                            const p = {
                                subscritor: data.subscriptionID,
                                body: params
                            };
                            thi.opened_ = true;
                            thi.visible_ = true;
                            console.log(p);
                            axios
                                .post("/api/v1/user/planes", p)
                                .then(response => {
                                    thi.opened_ = false;
                                    thi.visible_ = false;
                                    thi.cargarInicio();
                                    thi.desabilitaBotonesporrenderisado = true;
                                    thi.subscripcion_diferente_a_la_actual = false;
                                    thi.actualizarIntegracion();
                                })
                                .catch(error => {
                                    console.log(error.response);
                                });
                        }
                    })
                    .render("#paypal-button-container");
                this.desabilitaBotonesporrenderisado = false;
            }, 500);
        },
        actualizarIntegracion() {
            this.$store.dispatch("getSubscripciones", 0).then(() => {
                // console.log("cargando integracion");
            });
        },
        subir_user() {
            if (this.valor_user < 51) {
                this.desabilitaBotonesporrenderisado = true;
                this.valor_user++;
                this.pago_user += 10;
            }
        },
        bajar_user() {
            if (this.valor_user > 1) {
                this.desabilitaBotonesporrenderisado = true;
                this.valor_user--;
                this.pago_user -= 10;
                if (this.valor_user == 1) {
                    this.desabilitaBotonesporrenderisado = false;
                    this.boton_de_plan_basico = true;
                }
            }
        },
        subir_dialog() {
            if (this.dialogadd == 0) {
                this.desabilitaBotonesporrenderisado = true;
                this.dialogadd = 1;
                this.pago_dialog = 10;
            }
        },
        bajar_dialog() {
            if (this.dialogadd == 1) {
                this.desabilitaBotonesporrenderisado = true;
                this.dialogadd = 0;
                this.pago_dialog = 0;
            }
        },
        subir_waping() {
            if (this.wapingadd == 0) {
                this.desabilitaBotonesporrenderisado = true;
                this.wapingadd = 1;
                this.pago_waping = 30;
            }
        },
        bajar_waping() {
            if (this.wapingadd == 1) {
                this.desabilitaBotonesporrenderisado = true;
                this.wapingadd = 0;
                this.pago_waping = 0;
            }
        },
        subscribir_parametros() {
            const params = {
                user_id: this.$store.state.user_id,

                cant_users: this.valor_user,
                dialogflow: this.dialogadd,
                waping: this.wapingadd,
                facebook: 1,
                telegram: 1,
                plan_actual: this.state.plan_paypal
            };

            return params;
        },
        BajarPlanBasico() {
            this.opened_ = true;
            this.visible_ = true;
            this.$store.dispatch("PostplanBasico").then(() => {
                this.opened_ = true;
                this.visible_ = true;
                this.$swal({
                    title: "<strong>Subscription plan Basic</strong>",
                    icon: "info",
                    html:
                        "The plan basic start when you plan actuallity arriThe basic plan begins when the current plan reaches the subscription end date",
                    showCloseButton: true,

                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!'
                });
                this.cargarInicio();
            });
        },
        ActualizaProductos() {
            this.opened_ = true;
            this.visible_ = true;
            const p = {
                subscritor: this.subscriptionid,
                body: this.subscribir_parametros()
            };

            axios
                .post("/api/v1/user/planes", p)
                .then(response => {
                    this.$swal({
                        title: "<strong>Subscription plan Basic</strong>",
                        icon: "info",
                        html: "The products update successfully",
                        showCloseButton: true,

                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!'
                    });
                    this.actualizarIntegracion();
                    this.opened_ = false;
                    this.visible_ = false;
                    this.cargarInicio();
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    },
    computed: {
        total() {
            let price = this.pago_user + this.pago_dialog + this.pago_waping;

            if (this.plan_act != 0) {
                this.boton_de_plan_basico = true;
                if (this.plan_act != 1) {
                    //Si el plan no es trial
                    this.plan.map(res => {
                        if (res.monthly_price == price) {
                            this.state.plan_paypal = res.plan_code;
                        }
                    });

                    if (this.precio != price) {
                        this.subscripcion_diferente_a_la_actual = true;
                        if (price > 0) {
                            // EL PLAN SELECCIONADO NO ES BASICO
                            if (this.renderisar == 1) {
                                //borra el boton anterior renderizado
                                const el = document.querySelector(".payclass");
                                el.innerHTML = "";
                            }
                            this.boton_de_plan_basico = false;
                            if (!this.boton_de_plan_basico) {
                                this.renderisar = 1;
                                if (this.plan_act == 2) {
                                    //NUEVA SUBSCRIPTION si viene de el plan BASICO
                                    this.creabotonpaypal = true;
                                    this.crearSubscription_paypal(
                                        this.state.plan_paypal,
                                        this.subscribir_parametros()
                                    );
                                } else {
                                    //UPGRADE O DONWGRADE DE SUBSCRIPTION SI YA TIENE UN PLAN DIFERENTE AL BASICO
                                    this.creabotonpaypal = true;

                                    this.Updatesubscribe(
                                        this.state.plan_paypal,
                                        this.subscribir_parametros(),
                                        this.subscriptionid
                                    );
                                }
                            }
                        } else {
                            //ACTIVAR PLAN BASICO
                            this.desabilitaBotonesporrenderisado = false;
                            this.boton_de_plan_basico = true;
                            this.renderisar = 0;
                        }
                    } else {
                        //SI LA SUBSCRIPTION ES IGUAL PERO PRODUCTOS DIFERENTES
                        this.renderisar = 0;
                        this.desabilitaBotonesporrenderisado = false;
                        this.subscripcion_diferente_a_la_actual = false;
                        this.boton_de_plan_basico = false;
                    }
                }
            }

            return price;
        },
        plan() {
            return this.$store.state.planes;
        },
        plan_subscrito() {
            return this.$store.state.plansubscrito;
        },
        boton_plan_basico() {
            return this.boton_de_plan_basico;
        },
        subscribe() {
            this.subscribir_paypal(data);
            return this.state.respuestapaypal;
        },
        productos() {
            return this.$store.state.productsubscriptos;
        }
    }
};
</script>

<!--         this.$swal({
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
        });-->

<!--      this.$swal({
                    title: "<strong>Subscription plan Basic</strong>",
                    icon: "info",
                    html:
                    "If the removal is after the first 5 days of the month, it will be pending closing until the next billing closing.",
                    showCloseButton: true,

                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
                    }); -->
