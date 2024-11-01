<template>
  <div class="modal">
    <div class="modal-inner">
      <div class="delete-content">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="150"
          height="150"
          viewBox="0 0 150 150"
          fill="none"
        >
          <path
            opacity="0.4"
            d="M131.75 53.6252V96.375C131.75 103.375 128 109.875 121.938 113.438L84.8127 134.875C78.7502 138.375 71.2501 138.375 65.1251 134.875L28 113.438C21.9375 109.938 18.1875 103.438 18.1875 96.375V53.6252C18.1875 46.6252 21.9375 40.125 28 36.5625L65.1251 15.125C71.1876 11.625 78.6877 11.625 84.8127 15.125L121.938 36.5625C128 40.125 131.75 46.5627 131.75 53.6252Z"
            fill="#FF6B6B"
          />
          <path
            d="M75 85.9375C72.4375 85.9375 70.3125 83.8125 70.3125 81.25V48.4375C70.3125 45.875 72.4375 43.75 75 43.75C77.5625 43.75 79.6875 45.875 79.6875 48.4375V81.25C79.6875 83.8125 77.5625 85.9375 75 85.9375Z"
            fill="#FF6B6B"
          />
          <path
            d="M75 107.813C74.1875 107.813 73.375 107.626 72.625 107.313C71.8125 107.001 71.1874 106.563 70.5624 106.001C69.9999 105.376 69.5625 104.688 69.1875 103.938C68.875 103.188 68.75 102.376 68.75 101.563C68.75 99.9383 69.3749 98.3132 70.5624 97.1257C71.1874 96.5632 71.8125 96.1259 72.625 95.8134C74.9375 94.8134 77.6876 95.3757 79.4376 97.1257C80.0001 97.7507 80.4374 98.3758 80.7499 99.1883C81.0624 99.9383 81.25 100.751 81.25 101.563C81.25 102.376 81.0624 103.188 80.7499 103.938C80.4374 104.688 80.0001 105.376 79.4376 106.001C78.2501 107.188 76.6875 107.813 75 107.813Z"
            fill="#FF6B6B"
          />
        </svg>
      </div>
      <div class="delete-text">Delete</div>
      <div class="confirm-text">Are you sure to delete the content?</div>
      <div class="delete-buttons">
        <button class="no" @click="close">No, Thanks</button>
        <button class="yes" @click="confirmDelete">Yes, Delete</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    close() {
      this.$emit("close");
    },
    confirmDelete() {
      this.$emit("confirm");
    },
  },
};
</script>

<style scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(5px);
}
.modal-inner {
  background-color: white;
  width: 500px;
  height: 430px;
  padding: 64px;
  border-radius: 24px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.delete-content {
  display: flex;
  align-items: center;
  justify-content: center;
}

.delete-text {
  margin-top: 24px;
  color: var(--status-error, #ff6b6b);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-size: 36px;
  font-style: normal;
  font-weight: 700;
  line-height: 110%; /* 39.6px */
}

.confirm-text {
  margin-top: 8px;
  color: var(--text-colors-600-black-low-emp, #707d9b);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-size: 24px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 26.4px */
}
.delete-buttons {
  margin-top: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 24px;
}

.no {
  border: none;
  width: 200px;
  padding: 18px 40px;
  border-radius: 8px;
  background: var(--primary-color-400-main, #4faafd);
  color: #ffffff;
  cursor: pointer;
}

.yes {
  border: none;
  width: 200px;
  padding: 18px 40px;
  border-radius: 8px;
  background: var(--status-error, #ff6b6b);
  color: #ffffff;
  cursor: pointer;
}
</style>
