<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Checkout</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <form
          action="#"
          class="icons-tab-steps checkout-tab-steps wizard-circle"
        >
          <fieldset class="checkout-step-1 px-0">
            <section id="place-order" class="list-view product-checkout">
              <div class="checkout-items">
                <div class="card ecommerce-card">
                  <div class="card-content">
                    <div class="item-img text-center">
                      <a href="app-ecommerce-details.html">
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
                        <a>Agents 10$/per user per month</a>
                        <span></span>
                        <p class="item-company">
                          By <span class="company-name">ichapp</span>
                        </p>
                        <p class="stock-status-in">In Stock</p>
                      </div>
                      <div class="item-quantity">
                        <p class="quantity-title">Quantity</p>
                        <div
                          class="input-group quantity-counter-wrapper bootstrap-touchspin"
                        >
                          <span
                            class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                          >
                            <button
                              class="btn btn-primary bootstrap-touchspin-down"
                              type="button"
                              @click="bajar_user()"
                            >
                              -
                            </button>
                          </span>

                          <input
                            type="text"
                            class="quantity-counter form-control"
                            :value="valor_user"
                          />

                          <span
                            class="input-group-btn input-group-append bootstrap-touchspin-injected"
                          >
                            <button
                              class="btn btn-primary bootstrap-touchspin-up"
                              type="button"
                              @click="subir_user()"
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
                          <div class="badge badge-primary badge-md">
                            4 <i class="feather icon-star ml-25"></i>
                          </div>
                        </div>
                        <div class="item-cost">
                          <h6 class="item-price">${{ pago_user }}</h6>
                          <p class="shipping">
                            <i class="feather icon-shopping-cart"></i> 1 user
                            free
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

                <div class="card ecommerce-card">
                  <div class="card-content">
                    <div class="item-img text-center">
                      <a href="app-ecommerce-details.html">
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
                        <a href="app-ecommerce-details.html">Telegram Free</a>
                        <span></span>
                        <p class="item-company">
                          By <span class="company-name">Ichapp</span>
                        </p>
                      </div>
                      <div class="item-quantity">
                        <p class="quantity-title">Quantity</p>
                        <div
                          class="input-group quantity-counter-wrapper bootstrap-touchspin"
                        >
                          <span
                            class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-down"
                              type="button"
                            >
                              -
                            </button></span
                          ><input
                            type="text"
                            class="quantity-counter form-control"
                            value="1"
                          /><span
                            class="input-group-btn input-group-append bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-up"
                              type="button"
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
                          <div class="badge badge-primary badge-md">
                            5 <i class="feather icon-star ml-25"></i>
                          </div>
                        </div>
                        <div class="item-cost">
                          <h6 class="item-price">
                            $0
                          </h6>
                          <p class="shipping">
                            <i class="feather icon-shopping-cart"></i> Free
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card ecommerce-card">
                  <div class="card-content">
                    <div class="item-img text-center">
                      <a href="app-ecommerce-details.html">
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
                        <a href="app-ecommerce-details.html"
                          >Messenger Facebook free</a
                        >
                        <span></span>
                        <p class="item-company">
                          By <span class="company-name">Ichapp</span>
                        </p>
                      </div>
                      <div class="item-quantity">
                        <p class="quantity-title">Quantity</p>
                        <div
                          class="input-group quantity-counter-wrapper bootstrap-touchspin"
                        >
                          <span
                            class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-down"
                              type="button"
                            >
                              -
                            </button></span
                          ><input
                            type="text"
                            class="quantity-counter form-control"
                            value="1"
                          /><span
                            class="input-group-btn input-group-append bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-up"
                              type="button"
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
                          <div class="badge badge-primary badge-md">
                            5 <i class="feather icon-star ml-25"></i>
                          </div>
                        </div>
                        <div class="item-cost">
                          <h6 class="item-price">
                            $0
                          </h6>
                          <p class="shipping">
                            <i class="feather icon-shopping-cart"></i> Free
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card ecommerce-card">
                  <div class="card-content">
                    <div class="item-img text-center">
                      <a href="app-ecommerce-details.html">
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
                        <a href="app-ecommerce-details.html"
                          >DialogFlow AI 10$/per month</a
                        >
                        <span></span>
                        <p class="item-company">
                          By <span class="company-name">Ichapp</span>
                        </p>
                      </div>
                      <div class="item-quantity">
                        <p class="quantity-title">Quantity</p>
                        <div
                          class="input-group quantity-counter-wrapper bootstrap-touchspin"
                        >
                          <span
                            class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-down"
                              type="button"
                            >
                              -
                            </button></span
                          ><input
                            type="text"
                            class="quantity-counter form-control"
                            value="1"
                          /><span
                            class="input-group-btn input-group-append bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-up"
                              type="button"
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
                          <div class="badge badge-primary badge-md">
                            4 <i class="feather icon-star ml-25"></i>
                          </div>
                        </div>
                        <div class="item-cost">
                          <h6 class="item-price">
                            $39.99
                          </h6>
                          <p class="shipping">
                            <i class="feather icon-shopping-cart"></i> Free
                            Shipping
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card ecommerce-card">
                  <div class="card-content">
                    <div class="item-img text-center">
                      <a href="app-ecommerce-details.html">
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
                        <a href="app-ecommerce-details.html"
                          >Whatsapp by Waping 30$/per month</a
                        >
                        <span></span>
                        <p class="item-company">
                          By <span class="company-name">waping</span>
                        </p>
                      </div>
                      <div class="item-quantity">
                        <p class="quantity-title">Quantity</p>
                        <div
                          class="input-group quantity-counter-wrapper bootstrap-touchspin"
                        >
                          <span
                            class="input-group-btn input-group-prepend bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-down"
                              type="button"
                            >
                              -
                            </button></span
                          ><input
                            type="text"
                            class="quantity-counter form-control"
                            value="1"
                          /><span
                            class="input-group-btn input-group-append bootstrap-touchspin-injected"
                            ><button
                              class="btn btn-primary bootstrap-touchspin-up"
                              type="button"
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
                          <div class="badge badge-primary badge-md">
                            4 <i class="feather icon-star ml-25"></i>
                          </div>
                        </div>
                        <div class="item-cost">
                          <h6 class="item-price">
                            $39.99
                          </h6>
                          <p class="shipping">
                            <i class="feather icon-shopping-cart"></i> Free
                            Shipping
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
                      <p class="options-title">Options</p>
                      <div class="coupons">
                        <div class="coupons-title">
                          <p>Coupons</p>
                        </div>
                        <div class="apply-coupon">
                          <p>Apply</p>
                        </div>
                      </div>
                      <hr />
                      <div class="price-details">
                        <p>Price Details</p>
                      </div>
                      <div class="detail">
                        <div class="detail-title">
                          Total MRP
                        </div>
                        <div class="detail-amt">
                          $598
                        </div>
                      </div>
                      <div class="detail">
                        <div class="detail-title">
                          Bag Discount
                        </div>
                        <div class="detail-amt discount-amt">
                          -25$
                        </div>
                      </div>
                      <div class="detail">
                        <div class="detail-title">
                          Estimated Tax
                        </div>
                        <div class="detail-amt">
                          $1.3
                        </div>
                      </div>
                      <div class="detail">
                        <div class="detail-title">
                          EMI Eligibility
                        </div>
                        <div class="detail-amt emi-details">
                          Details
                        </div>
                      </div>
                      <div class="detail">
                        <div class="detail-title">
                          Delivery Charges
                        </div>
                        <div class="detail-amt discount-amt">
                          Free
                        </div>
                      </div>
                      <hr />
                      <div class="detail">
                        <div class="detail-title detail-total">Total</div>
                        <div class="detail-amt total-amt">$574</div>
                      </div>
                      <div class="btn btn-primary btn-block place-order">
                        Subscribe
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      valor_user: 1,
      pago_user: 0,
    };
  },
  methods: {
    subir_user() {
      if (this.valor_user < 51) {
        this.valor_user++;
        this.pago_user += 10;
      }
    },
    bajar_user() {
      if (this.valor_user > 1) {
        this.valor_user--;
        this.pago_user -= 10;
      }
    },
  },
};
</script>
