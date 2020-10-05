<template>
  <div class="row">
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row pb-50">
              <div
                class="col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 order-2 mt-lg-0 mt-2"
              >
                <div>
                  <h2 class="text-bold-700 mb-25">5.0K</h2>
                  <p class="text-bold-500 mb-75">Avg messages</p>
                </div>
                <!--          <a href="#" class="btn btn-primary shadow"
                  >View Details <i class="feather icon-chevrons-right"></i
                ></a> -->
              </div>
              <div
                class="col-lg-6 col-12 d-flex justify-content-between flex-column text-right order-lg-2 order-1"
              >
                <!--                 <div class="dropdown chart-dropdown">
                  <button
                    class="btn btn-sm border-0 dropdown-toggle p-0"
                    type="button"
                    id="dropdownItem5"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    Last 7 Days
                  </button>
                  <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="dropdownItem5"
                  >
                    <a class="dropdown-item" href="#">Last 28 Days</a>
                    <a class="dropdown-item" href="#">Last Month</a>
                    <a class="dropdown-item" href="#">Last Year</a>
                  </div>
                </div> -->
                <div id="avg-session-chart"></div>
              </div>
            </div>
            <hr />
            <div class="row avg-sessions pt-50">
              <div class="col-6">
                <p class="mb-0">Whatsapp</p>
                <div class="progress progress-bar-primary mt-25">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="50"
                    aria-valuemin="50"
                    aria-valuemax="100"
                    style="width: 50%"
                  ></div>
                </div>
              </div>
              <div class="col-6">
                <p class="mb-0">Telegram</p>
                <div class="progress progress-bar-warning mt-25">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="60"
                    aria-valuemin="60"
                    aria-valuemax="100"
                    style="width: 60%"
                  ></div>
                </div>
              </div>
              <div class="col-6">
                <p class="mb-0">Facebook</p>
                <div class="progress progress-bar-danger mt-25">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="70"
                    aria-valuemin="70"
                    aria-valuemax="100"
                    style="width: 70%"
                  ></div>
                </div>
              </div>
              <div class="col-6">
                <p class="mb-0">Instagram</p>
                <div class="progress progress-bar-success mt-25">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="90"
                    aria-valuemin="90"
                    aria-valuemax="100"
                    style="width: 90%"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between pb-0">
          <h4 class="card-title">Customer Support</h4>
        </div>
        <div class="card-content">
          <div class="card-body pt-0">
            <div class="row">
              <div
                class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center"
              >
                <h1 class="font-large-2 text-bold-700 mt-2 mb-0">280</h1>
                <small>Conversations</small>
              </div>
              <div class="col-sm-10 col-12 d-flex justify-content-center">
                <div id="support-tracker-chart"></div>
              </div>
            </div>
            <div class="chart-info d-flex justify-content-between">
              <div class="text-center">
                <p class="mb-50">Open</p>
                <span class="font-large-1">6</span>
              </div>
              <div class="text-center">
                <p class="mb-50">Finished</p>
                <span class="font-large-1">274</span>
              </div>
              <div class="text-center">
                <p class="mb-50">Response Time</p>
                <span class="font-large-1">10min</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>