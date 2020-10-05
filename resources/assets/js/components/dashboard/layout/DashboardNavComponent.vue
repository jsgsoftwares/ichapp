<template>
  <div>
    <nav
      class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow"
    >
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="navbar-collapse" id="navbar-mobile">
            <div
              class="mr-auto float-left bookmark-wrapper d-flex align-items-center"
            >
              <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu d-xl-none mr-auto">
                  <a
                    class="nav-link nav-menu-main menu-toggle hidden-xs"
                    href="#"
                    ><i class="ficon feather icon-menu"></i
                  ></a>
                </li>
              </ul>
            </div>
            <ul class="nav navbar-nav float-right">
              <li class="dropdown dropdown-language nav-item">
                <!-- <dashlanguage_component /> -->
              </li>
              <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-expand"
                  ><i class="ficon feather icon-maximize"></i
                ></a>
              </li>
              <li class="nav-item nav-search">
                <a class="nav-link nav-link-search"
                  ><i class="ficon feather icon-search"></i
                ></a>
                <div class="search-input">
                  <div class="search-input-icon">
                    <i class="feather icon-search primary"></i>
                  </div>
                  <input
                    class="input"
                    type="text"
                    placeholder="Explore Vuexy..."
                    tabindex="-1"
                    data-search="template-list"
                  />
                  <div class="search-input-close">
                    <i class="feather icon-x"></i>
                  </div>
                  <ul class="search-list search-list-main"></ul>
                </div>
              </li>

              <li class="dropdown dropdown-user nav-item">
                <a
                  class="dropdown-toggle nav-link dropdown-user-link"
                  href="#"
                  data-toggle="dropdown"
                >
                  <div class="user-nav d-sm-flex d-none">
                    <span class="user-name text-bold-600"
                      >Juan david Gonzalez</span
                    ><span class="user-status">Available</span>
                  </div>
                  <span
                    ><img
                      class="round"
                      src="app-assets/images/portrait/small/avatar-s-11.jpg"
                      alt="avatar"
                      height="40"
                      width="40"
                  /></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="page-user-profile.html"
                    ><i class="feather icon-user"></i> Edit Profile</a
                  ><a class="dropdown-item" href="app-email.html"
                    ><i class="feather icon-mail"></i> My Inbox</a
                  ><a class="dropdown-item" href="app-todo.html"
                    ><i class="feather icon-check-square"></i> Task</a
                  ><a class="dropdown-item" href="app-chat.html"
                    ><i class="feather icon-message-square"></i> Chats</a
                  >
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" @click="logout()"
                    ><i class="feather icon-power"></i> Logout</a
                  >
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <ul class="main-search-list-defaultlist-other-list d-none">
      <li
        class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"
      >
        <a
          class="d-flex align-items-center justify-content-between w-100 py-50"
        >
          <div class="d-flex justify-content-start">
            <span class="mr-75 feather icon-alert-circle"></span
            ><span>No results found.</span>
          </div>
        </a>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  methods: {
    logout() {
      this.$store.dispatch("PostLogout");
    },
  },
};
</script>
