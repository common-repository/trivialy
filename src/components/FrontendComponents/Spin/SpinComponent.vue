<template>
  <div class="l-content">
    <img :src="imagePath + 'spin-banner.jpg'" alt="" />
  </div>
  <div class="r-content">
    <div class="popup-header">
      <div class="close-btn" @click="closePopup">
        <svg
          width="18"
          height="18"
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
    </div>
    <div v-if="isPlay" class="play-spin">
      <div class="spin-header">Spin n Win</div>
      <div class="spin-sub-header">
        You will get exciting coupon while you spin!
      </div>
      <PlaySpin
        @success-event="handleSuccessEvent"
        @tryLater="closePopup"
        :spinId="this.id"
      />
    </div>
    <Winner v-if="!isPlay" :spin="spinCoupon" :link="link" />
  </div>
</template>

<script>
import Winner from "../shared/WinnerComponent.vue";
import PlaySpin from "./PlaySpinComponent.vue";
export default {
  props: {
    id: Number,
  },

  data() {
    return {
      isPlay: true,
      isConfirm: false,
      popupData: {},
      image: "",
      spinning: false,
      spinCoupon: "",
      link: "",
      imagePath: wpApiSettings.imagePath,
    };
  },
  components: {
    Winner,
    PlaySpin,
  },
  methods: {
    closePopup() {
      this.$emit("close");
    },
    handleSuccessEvent(data) {
      (this.link = data.link),
        (this.spinCoupon = data.prizeCoupon),
        // console.log(
        //   "Received success event:",
        //   data.isSuccess,
        //   "Prize Coupon:",
        //   data.prizeCoupon
        // );
        (this.isPlay = false);
      // Handle the emitted data as needed
    },
  },
};
</script>

<style scoped>
.spinning-wheel {
  position: relative;
  width: 300px; /* Adjust as needed */
  height: 300px; /* Adjust as needed */
}
.spin-sub-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);

  /* Text/Body/Body 4 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 18.2px */
}
.spin-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 110%; /* 26.4px */
}
.play-spin {
  height: 88%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.close-btn {
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 4px 4px 20px 0px rgba(0, 0, 0, 0.4);
  border-radius: 100px;
  padding: 6px;
  position: relative;
  z-index: 999999;
}
.r-content {
  width: 100%;
  padding: 24px;
  display: flex;
  flex-direction: column;
}
.popup-header {
  display: flex;
  justify-content: end;
}

.l-content img {
  border-radius: 24px 0 0 24px;
  object-fit: cover;
  width: 210px;
}

@media screen and (max-width: 1023px) {
  .l-content img {
    width: 230px;
    object-fit: cover;
    border-radius: 24px 0 0 24px;
  }
}

@media screen and (max-width: 767px) {
  .l-content img {
    display: none;
  }

  .r-content {
    padding: 40px 16px;
  }

  .spin-header {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
  }
}
</style>
