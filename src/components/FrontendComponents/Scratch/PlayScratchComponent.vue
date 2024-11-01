<template>
  <div class="scratch-card">
    <div class="background-canvas">
      <div class="background-canvas-header">Your Exclusive</div>
      <div class="background-canvas-body">{{ offText }}</div>
      <div class="background-canvas-footer">
        Click <b>NEXT</b> to get a coupon code.
      </div>
    </div>
    <canvas
      ref="scratchCanvas"
      @mousedown="startScratching"
      @mousemove="scratch"
      @mouseup="stopScratching"
      class="scratch-canvas"
    ></canvas>
  </div>
  <Loader v-if="isLoading" />
</template>

<script>
import Loader from "../shared/LoaderComponent.vue";
export default {
  mounted() {
    this.initializeScratchCanvas();
  },
  props: {
    reward: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      isLoading: false,
      isScratching: false,
      offText: this.reward || "",
      scratchPercentage: 0,
    };
  },
  watch: {
    reward(newValue) {
      this.offText = newValue;
    },
  },
  components: {
    Loader,
  },

  methods: {
    initializeScratchCanvas() {
      this.isLoading = true;
      const canvas = this.$refs.scratchCanvas;
      this.ctx = canvas.getContext("2d");

      const computedStyles = window.getComputedStyle(canvas);
      const canvasWidth = parseInt(computedStyles.width, 10);
      const canvasHeight = parseInt(computedStyles.height, 10);

      // Create a linear gradient
      const gradient = this.ctx.createLinearGradient(0, 0, canvasWidth, 0);
      gradient.addColorStop(0, "#6F6F6F");
      gradient.addColorStop(0.3627, "#656565");
      gradient.addColorStop(0.8114, "#A8A7A7");
      gradient.addColorStop(1, "#191919");

      // Set the gradient as the fill style
      this.ctx.fillStyle = gradient;

      // Fill the entire canvas with the gradient
      this.ctx.fillRect(0, 0, canvasWidth, canvasHeight);

      // Set the global composite operation
      this.ctx.globalCompositeOperation = "destination-out";
      this.isLoading = false;
    },
    startScratching() {
      this.isScratching = true;
    },
    scratch(event) {
      if (!this.isScratching) return;

      const canvas = this.$refs.scratchCanvas;
      const rect = canvas.getBoundingClientRect();

      // Get the CSS-computed dimensions of the canvas
      const computedStyles = window.getComputedStyle(canvas);
      const canvasWidth = parseInt(computedStyles.width, 10);
      const canvasHeight = parseInt(computedStyles.height, 10);

      const x = (event.clientX - rect.left) * (canvas.width / canvasWidth);
      const y = (event.clientY - rect.top) * (canvas.height / canvasHeight);

      this.ctx.beginPath();
      this.ctx.arc(x, y, 16, 0, 2 * Math.PI);
      this.ctx.fill();

      this.calculateScratchPercentage();
    },
    stopScratching() {
      this.isScratching = false;
    },
    calculateScratchPercentage() {
      const canvas = this.$refs.scratchCanvas;

      const computedStyles = window.getComputedStyle(canvas);
      const canvasWidth = parseInt(computedStyles.width, 10);
      const canvasHeight = parseInt(computedStyles.height, 10);

      const imageData = this.ctx.getImageData(0, 0, canvasWidth, canvasHeight);
      const pixels = new Uint32Array(imageData.data.buffer);
      const scratchedPixels = pixels.filter((pixel) => pixel === 0);
      this.scratchPercentage = (scratchedPixels.length / pixels.length) * 100;
      // console.log(this.scratchPercentage);
      this.$emit("scratchPercentage", this.scratchPercentage);
    },
  },
};
</script>

<style scoped>
.scratch-card {
  position: relative;
  height: 145px;
  width: 510px;
  border-radius: 16px;
  overflow: hidden;
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 44px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%;
}

.background-canvas {
  width: 510px;
  height: 145px;
  padding: 40px 36px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 8px;
  z-index: 1; /* Set a higher z-index for the background canvas */
  background-color: #eff1fe;
  border: 2px dashed #8789f2;
}

.background-canvas-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 17.6px */
  letter-spacing: 6px;
  text-transform: uppercase;
}

.background-canvas-footer {
  margin-top: 4px;
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 17.6px */
}
.background-canvas-body {
  color: var(--Color-Primary-Color-700, #513fc3);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 40px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 44px */
}

.scratch-canvas {
  width: 575px;
  height: 180px;
  z-index: 2;
}

.background-canvas,
.scratch-canvas {
  position: absolute;
  top: 0;
  left: 0;
  border-radius: 16px;
}

@media screen and (max-width: 1023px) {
  .background-canvas {
    width: 420px;
    height: 132px;
    padding: 30px 28px;
    gap: 6px;
  }
  .scratch-card {
    width: 420px;
    height: 132px;
  }

  .background-canvas-header {
    font-size: 12px;
    letter-spacing: 4.383px;
  }

  .background-canvas-body {
    font-size: 28px;
    font-style: normal;
    font-weight: 700;
    line-height: 115%; /* 32.2px */
    letter-spacing: -0.56px;
  }

  .background-canvas-footer {
    margin-top: 3px;
    font-size: 12px;
  }
}

@media screen and (max-width: 767px) {
  .scratch-card {
    width: 295px;
    height: 93px;
  }
  .background-canvas {
    width: 296px;
    height: 93px;
    padding: 16px 20px;
  }

  .background-canvas-header {
    font-size: 8px;
    letter-spacing: 2px;
  }

  .background-canvas-body {
    font-size: 20px;
    line-height: 140%;
  }
  .background-canvas-footer {
    margin-top: 0px;
    font-size: 10px;
    line-height: 130%; /* 13px */
    letter-spacing: 0.2px;
  }
}
</style>
