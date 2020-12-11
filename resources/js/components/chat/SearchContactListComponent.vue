<template>
  <div class="chat-left-search">
    <form>
      <div class="input-group">
        <input
          type="search"
          class="form-control"
          placeholder="Search"
          aria-label="Search"
          aria-describedby="chat-left-search-btn"
          v-model="querySearch"
        />
        <div class="input-group-append">
          <button class="btn" type="submit" id="chat-left-search-btn">
            <i class="feather icon-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  computed: {
    querySearch: {
      get() {
        return this.$store.state.querySearch;
      },
      set(value) {
        this.$store.commit("newQuerySearch", value);
      },
    },
  },
};
</script>
