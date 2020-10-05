<template>
  <div
    class="main-menu menu-fixed menu-light menu-accordion menu-shadow"
    data-scroll-to-active="true"
  >
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mr-auto">
          <a
            class="navbar-brand"
            href="../../../html/ltr/vertical-collapsed-menu-template/index.html"
          >
            <div class="brand-logo"></div>
            <h2 class="brand-text mb-0">IChapp</h2>
          </a>
        </li>
        <li class="nav-item nav-toggle">
          <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"
            ><i
              class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"
            ></i
            ><i
              class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
              data-ticon="icon-disc"
            ></i
          ></a>
        </li>
      </ul>
    </div>
    <div class="shadow-bottom"></div>
    <dashboarmenu_component />
  </div>
</template>

<script>
export default {};
</script>