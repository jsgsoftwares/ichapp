<template>
  <div class="row match-height">
    <div class="col-lg-4 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
          <h4>Product Orders</h4>
          <div class="dropdown chart-dropdown">
            <button
              class="btn btn-sm border-0 dropdown-toggle p-0"
              type="button"
              id="dropdownItem2"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Last 7 Days
            </button>
            <div
              class="dropdown-menu dropdown-menu-right"
              aria-labelledby="dropdownItem2"
            >
              <a class="dropdown-item" href="#">Last 28 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div id="product-order-chart" class="mb-3"></div>
            <div class="chart-info d-flex justify-content-between mb-1">
              <div class="series-info d-flex align-items-center">
                <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                <span class="text-bold-600 ml-50">Finished</span>
              </div>
              <div class="product-result">
                <span>23043</span>
              </div>
            </div>
            <div class="chart-info d-flex justify-content-between mb-1">
              <div class="series-info d-flex align-items-center">
                <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                <span class="text-bold-600 ml-50">Pending</span>
              </div>
              <div class="product-result">
                <span>14658</span>
              </div>
            </div>
            <div class="chart-info d-flex justify-content-between mb-75">
              <div class="series-info d-flex align-items-center">
                <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                <span class="text-bold-600 ml-50">Rejected</span>
              </div>
              <div class="product-result">
                <span>4758</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="card">
        <div
          class="card-header d-flex justify-content-between align-items-start"
        >
          <div>
            <h4 class="card-title">Sales Stats</h4>
            <p class="text-muted mt-25 mb-0">Last 6 months</p>
          </div>
          <p class="mb-0">
            <i
              class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"
            ></i>
          </p>
        </div>
        <div class="card-content">
          <div class="card-body px-0">
            <div id="sales-chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Activity Timeline</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <ul class="activity-timeline timeline-left list-unstyled">
              <li>
                <div class="timeline-icon bg-primary">
                  <i class="feather icon-plus font-medium-2 align-middle"></i>
                </div>
                <div class="timeline-info">
                  <p class="font-weight-bold mb-0">Client Meeting</p>
                  <span class="font-small-3"
                    >Bonbon macaroon jelly beans gummi bears jelly lollipop
                    apple</span
                  >
                </div>
                <small class="text-muted">25 mins ago</small>
              </li>
              <li>
                <div class="timeline-icon bg-warning">
                  <i
                    class="feather icon-alert-circle font-medium-2 align-middle"
                  ></i>
                </div>
                <div class="timeline-info">
                  <p class="font-weight-bold mb-0">Email Newsletter</p>
                  <span class="font-small-3"
                    >Cupcake gummi bears soufflé caramels candy</span
                  >
                </div>
                <small class="text-muted">15 days ago</small>
              </li>
              <li>
                <div class="timeline-icon bg-danger">
                  <i class="feather icon-check font-medium-2 align-middle"></i>
                </div>
                <div class="timeline-info">
                  <p class="font-weight-bold mb-0">Plan Webinar</p>
                  <span class="font-small-3"
                    >Candy ice cream cake. Halvah gummi bears</span
                  >
                </div>
                <small class="text-muted">20 days ago</small>
              </li>
              <li>
                <div class="timeline-icon bg-success">
                  <i class="feather icon-check font-medium-2 align-middle"></i>
                </div>
                <div class="timeline-info">
                  <p class="font-weight-bold mb-0">Launch Website</p>
                  <span class="font-small-3">Candy ice cream cake. </span>
                </div>
                <small class="text-muted">25 days ago</small>
              </li>
              <li>
                <div class="timeline-icon bg-primary">
                  <i class="feather icon-check font-medium-2 align-middle"></i>
                </div>
                <div class="timeline-info">
                  <p class="font-weight-bold mb-0">Marketing</p>
                  <span class="font-small-3"
                    >Candy ice cream. Halvah bears Cupcake gummi bears.</span
                  >
                </div>
                <small class="text-muted">28 days ago</small>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>