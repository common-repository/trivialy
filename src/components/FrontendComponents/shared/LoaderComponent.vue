<template>
  <div class="loader-overlay">
    <div class="loader-content">
      <div class="spinner rotating-dots-spinner">
        <div class="dot dot1"></div>
        <div class="dot dot2"></div>
        <div class="dot dot3"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Loader",
};
</script>

<style scoped>
.loader-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 0 24px 24px 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.loader-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  text-align: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.rotating-dots-spinner {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 40px;
}

.dot {
  width: 12px;
  height: 12px;
  margin: 0 6px;
  border-radius: 50%;
  background-color: #706aea; /* Change color as needed */
  animation: dot-spin 1s infinite;
}

.dot1 {
  animation-delay: 0.1s;
}
.dot2 {
  animation-delay: 0.2s;
}
.dot3 {
  animation-delay: 0.3s;
}

@keyframes dot-spin {
  0%,
  25% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
    animation-delay: 0.5s;
  }
  75%,
  100% {
    transform: translateY(0);
  }
}
</style>
