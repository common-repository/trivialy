<template>
  <div>
    <div class="popup-overlay" @click.self="close">
      <div class="popup-content">
        <div class="close-button" @click="close">
          <svg
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g id="close">
              <path
                id="Vector"
                d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"
                fill="#3A3F57"
              />
            </g>
          </svg>
        </div>
        <img :src="imageUrl" alt="Popup Image" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    imageUrl: {
      type: String,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>

<style>
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-content {
  position: relative;
  background: transparent;

  border-radius: 10px;
  max-width: 100%;
  max-height: 100%;
  overflow: auto;
}

.close-button {
  position: absolute;
  top: 24px;
  right: 24px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 4px 4px 20px 0px rgba(0, 0, 0, 0.4);
  border-radius: 100px;
  padding: 6px;
  cursor: pointer;
}

img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
}
</style>
