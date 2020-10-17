<template>
  <div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card bg-analytics text-white">
        <div class="card-content">
          <div class="card-body text-center">
            <div class="avatar avatar-xl bg-primary shadow mt-0">
              <div class="avatar-content">
                <span
                  ><img
                    class="round"
                    src="app-assets/images/portrait/small/avatar-s-11.jpg"
                    alt="avatar"
                    height="40"
                    width="40"
                /></span>
              </div>
            </div>
            <div class="text-center">
              <h1 class="mb-2 text-white">Wellcome Juan David Gonzalez,</h1>
              <p class="m-auto w-75">
                You have received <strong>5039</strong> messages today
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex flex-column align-items-start pb-0">
          <div class="avatar bg-rgba-primary p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-users text-primary font-medium-5"></i>
            </div>
          </div>
          <h2 class="text-bold-700 mt-1 mb-25">280</h2>
          <p class="mb-0">Usuarios de hoy</p>
        </div>
        <div class="card-content">
          <div id="subscribe-gain-chart"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex flex-column align-items-start pb-0">
          <div class="avatar bg-rgba-warning p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-package text-warning font-medium-5"></i>
            </div>
          </div>
          <h2 class="text-bold-700 mt-1 mb-25">274</h2>
          <p class="mb-0">Conversations finished</p>
        </div>
        <div class="card-content">
          <div id="orders-received-chart"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>