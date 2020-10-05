<template>
  <div>
    <a
      class="dropdown-toggle nav-link"
      id="dropdown-flag"
      href="#"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      ><i class="flag-icon flag-icon-us"></i
      ><span class="selected-language">English</span></a
    >
    <div class="dropdown-menu" aria-labelledby="dropdown-flag">
      <a class="dropdown-item" href="#" data-language="en"
        ><i class="flag-icon flag-icon-us"></i> English</a
      ><a class="dropdown-item" href="#" data-language="fr"
        ><i class="flag-icon flag-icon-fr"></i> French</a
      ><a class="dropdown-item" href="#" data-language="de"
        ><i class="flag-icon flag-icon-de"></i> German</a
      ><a class="dropdown-item" href="#" data-language="pt"
        ><i class="flag-icon flag-icon-pt"></i> Portuguese</a
      >
    </div>
  </div>
</template>
<script>
export default {};
</script>