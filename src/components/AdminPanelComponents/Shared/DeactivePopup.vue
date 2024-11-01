<template>
  <div class="popup-overlay">
    <div class="popup">
      <h1 style="text-align: center">
        Are you sure! You Want to Deactivate Your Subscription??
      </h1>
      <div class="popup-buttons">
        <button @click="cancel" class="cancel">Cancel</button>
        <button @click="confirm" class="confirm">Confirm</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputText: "",
    };
  },
  methods: {
    cancel() {
      // Emit an event to let the parent component know that the popup was cancelled
      this.$emit("cancelDe");
    },
    confirm() {
      // Emit an event to let the parent component know that the user confirmed with the input text
      this.$emit("confirmDe");
    },
  },
};
</script>

<style scoped>
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup {
  background-color: #f7f7f7;
  padding: 20px;
  border-radius: 8px;
  width: 450px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.popup-input {
  border-color: #e3e3e3;
  width: 100%;
  padding: 16px 8px;
  border-radius: 8px;
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%;
}
.cancel {
  background-color: #f55151 !important;
}

.popup-buttons {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
}

.popup-buttons button {
  padding: 16px 32px;
  margin-left: 8px;
  border: none;
  border-radius: 8px;
  background-color: #33d286;
  color: #fff;
  cursor: pointer;
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%;
}
</style>
