<template>
  <div class="chat-leftbar">
    <div class="tab-content" id="pills-tab-justifiedContent">
      <vxchats_component />
      <vxnewchats_component />
      <vxmiperfil_component />
      <vxajuste_component />
    </div>

    <div class="chat-menu">
      <ul class="nav nav-pills nav-justified mb-0" id="pills-tab-justified" role="tablist">
        <li class="nav-item">
          <a
            class="nav-link active"
            id="pills-chat-tab-justified"
            data-toggle="pill"
            href="#pills-chat-justified"
            role="tab"
            aria-controls="pills-chat-justified"
            aria-selected="true"
          >
            <i class="feather icon-message-circle"></i>
          </a>
        </li>
        <!--         <li class="nav-item">
          <a
            class="nav-link"
            id="pills-addchat-tab-justified"
            data-toggle="pill"
            href="#pills-addchat-justified"
            role="tab"
            aria-controls="pills-addchat-justified"
            aria-selected="false"
          >
            <i class="feather icon-edit-1"></i>
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="pills-profile-tab-justified"
            data-toggle="pill"
            href="#pills-profile-justified"
            role="tab"
            aria-controls="pills-profile-justified"
            aria-selected="false"
          >
            <i class="feather icon-user"></i>
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            id="pills-setting-tab-justified"
            data-toggle="pill"
            href="#pills-setting-justified"
            role="tab"
            aria-controls="pills-setting-justified"
            aria-selected="false"
          >
            <i class="feather icon-settings"></i>
          </a>
        </li>-->
      </ul>
    </div>
  </div>
</template>

<script>
export default {};
</script>