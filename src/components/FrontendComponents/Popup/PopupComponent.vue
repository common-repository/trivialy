<template>
  <div class="l-content">
    <img :src="image" alt="" />
  </div>
  <div class="r-content">
    <div class="popup-header">
      <div class="close-btn" @click="closePopup">
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
    </div>
    <div class="front-popup-body">
      <div class="front-popup-body-header">Great OFF!</div>
      <div class="front-popup-body-title">{{ popupData.title }}</div>
      <div class="front-popup-body-des">
        {{ popupData.description }}
      </div>
      <div class="btn-cpn-section">
        <div class="front-popup-coupon" v-if="popupData.coupon_select == 1">
          {{ popupData.coupon_code }}
        </div>
        <button
          class="front-popup-btn"
          v-if="popupData.button_select == 1"
          :style="popupData.coupon_select == 0 ? 'width: 200px' : ''"
          @click="openExternalLink"
        >
          {{ popupData.button_title }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Winner from "../shared/WinnerComponent.vue";
export default {
  props: {
    popupId: Number,
  },
  mounted() {
    this.fetchPopup();
    // console.log(this.image);
  },
  data() {
    return {
      isConfirm: false,
      popupData: {},
      image: "",
    };
  },
  components: {
    Winner,
  },
  methods: {
    openExternalLink() {
      if (this.popupData.button_link) {
        // Open the external link in a new tab/window
        window.open(this.popupData.button_link, "_blank");
      }
    },
    fetchPopup() {
      axios
        .get(
          wpApiSettings.root + "custom/v1/get-popup-quiz-data/" + this.popupId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.popupData = response.data;
          this.image = response.data.image;
          this.showImgBool = true;
          //   console.log(this.popupData);
          // this.getImage();
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
          console.log(this.error);
        });
    },

    closePopup() {
      this.$emit("close");
    },
    goNext() {
      this.isConfirm = true;
    },
  },
};
</script>

<style scoped>
.l-content {
  width: 257px;
}
.l-content img {
  border-radius: 24px 0 0 24px;
}
.btn-width {
  width: 200px;
}
.front-popup-coupon {
  border: 1px dashed var(--Color-Primary-Color-500, #706aea);
  border-radius: 12px;
  background-color: #eff1fe;
  padding: 12px 16px;

  color: var(--Color-Primary-Color-500, #706aea);
  text-align: center;
  /* Text/Body/Body 1 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 28px */
}
.btn-cpn-section {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-top: 90px;
}
.front-popup-btn {
  cursor: pointer;
  padding: 20px 16px;
  width: auto;
  border: none;
  background-color: #706aea;
  border-radius: 12px;

  color: var(
    --color-text-colors-50-white-high-emp,
    var(--Color-Natural-50, #fff)
  );
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 22px */
}
.front-popup-body-des {
  margin-top: 20px;
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}
.front-popup-body-title {
  margin-top: 28px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/H1-H6/H4 | Title 2 | Mobile H2 | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 40px;
  font-style: normal;
  font-weight: 700;
  line-height: 110%; /* 44px */
  letter-spacing: -1.6px;
}
.front-popup-body-header {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  /* Text/Body/Body 1 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 28px */
}
.front-popup-body {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.close-btn {
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 4px 4px 20px 0px rgba(0, 0, 0, 0.4);
  border-radius: 100px;
  padding: 6px;
  cursor: pointer;
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

@media screen and (max-width: 1023px) {
  .l-content img {
    width: 265px;
    object-fit: cover;
  }
}

@media screen and (max-width: 767px) {
  .l-content {
    display: none;
  }
  .l-content img {
    display: none;
  }

  .btn-cpn-section {
    margin-top: 40px;
  }
  .front-popup-body {
    align-items: center;
  }

  .front-popup-body-header {
    font-size: 16px;
    line-height: 140%;
    letter-spacing: 0;
    text-align: center;
  }

  .front-popup-body-title {
    font-size: 24px;
    line-height: 120%;
    text-align: center;
    font-weight: 700;
  }

  .front-popup-body-des {
    font-size: 14px;
    line-height: 130%;
    text-align: center;
  }

  .front-popup-coupon {
    padding: 16px 20px;
    font-size: 16px;
  }

  .front-popup-btn {
    padding: 16px 20px;
    width: 296px;
    font-size: 16px;
    line-height: 140%;
  }
}
</style>
