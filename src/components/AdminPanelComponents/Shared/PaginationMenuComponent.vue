<template>
  <div class="myCampaing-pagination">
    <div class="item-count-text">
      Showing {{ showStart }} to {{ showRes }} from {{ totalRows }} entries
    </div>
    <div class="page-button">
      <svg
        @click="previousPage"
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
      >
        <path
          d="M11.332 4.66699L8.66536 8.00033L11.332 11.3337"
          :stroke="
            totalPage != 1
              ? totalPage == currentPage || currentPage > 1
                ? '#706AEA'
                : '#B8B8B8'
              : '#B8B8B8'
          "
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M7.33203 4.66699L4.66537 8.00033L7.33203 11.3337"
          :stroke="
            totalPage != 1
              ? totalPage == currentPage || currentPage > 1
                ? '#706AEA'
                : '#B8B8B8'
              : '#B8B8B8'
          "
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
      <div class="page-count">
        <div
          v-for="item in totalPage"
          class="page-no"
          :class="currentPage == item ? 'page-btn-active' : ''"
          @click="pageSelect(item)"
        >
          {{ item }}
        </div>
      </div>
      <svg
        @click="nextPage"
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
      >
        <path
          d="M4.66797 4.66699L7.33464 8.00033L4.66797 11.3337"
          :stroke="totalPage <= currentPage ? '#B8B8B8' : '#706AEA'"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
        <path
          d="M8.66797 4.66699L11.3346 8.00033L8.66797 11.3337"
          :stroke="totalPage <= currentPage ? '#B8B8B8' : '#706AEA'"
          stroke-width="1.5"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    // console.log(this.currentPage);
    // console.log(this.totalRows);
  },
  props: {
    nextPage: Function,
    previousPage: Function,
    pageSelect: Function,
    totalRows: Number,
    currentPage: Number,
    rowPerPage: Number,
    totalPage: Number,
  },
  watch: {
    totalPage(newValue) {
      // console.log(newValue);
    },
    // totalRows(newValue) {
    //   console.log(newValue);
    // },
  },
  computed: {
    showRes() {
      return Math.min(this.rowPerPage * this.currentPage, this.totalRows);
    },
    showStart() {
      return (this.currentPage - 1) * this.rowPerPage + 1;
    },
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style scoped>
.myCampaing-pagination {
  display: flex;
  align-items: center;
  justify-content: end;
  gap: 24px;

  color: #5e6064;
  /* Text/Label/Label | Rest | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 125%; /* 15px */
  letter-spacing: 0.24px;
}

.page-button svg {
  cursor: pointer;
}
.page-button {
  display: flex;
  align-items: center;
  gap: 8px;
}

.page-count {
  display: flex;
  gap: 8px;
}

.item-count-text {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  font-family: "Inter", sans-serif;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 125%; /* 15px */
  letter-spacing: 0.24px;
}

.page-content select {
  border: none;
  width: 50px;
  border-radius: 4px;
}

.page-btn-active {
  background-color: #706aea;
  color: #fff;
  border-radius: 8px;
}
.page-no {
  padding: 6px;
  height: 32px;
  width: 32px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}
</style>
