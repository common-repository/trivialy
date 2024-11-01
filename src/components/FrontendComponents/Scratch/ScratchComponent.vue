<template>
  <div class="l-content">
    <img :src="imagePath + 'scratch-banner.jpg'" alt="" />
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
    <div v-if="!isConfirm" class="popup-body">
      <div class="popup-body-header">Scratch n Win</div>
      <div class="popup-body-content">
        <div class="body-tag">Scratch it now!</div>
        <div class="body-des">
          Scratch to win exciting Promo Codes. Scratch today and buy products
          affordably.
        </div>
        <PlayScratch
          @scratchPercentage="handleScratchPercentage"
          :reward="selectedObject.reward"
          v-if="selectedObject.reward"
        />
        <div v-else>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="575"
            height="181"
            viewBox="0 0 575 181"
            fill="none"
          >
            <path
              d="M559 0.5H16C7.16344 0.5 0 7.66344 0 16.5V164.5C0 173.337 7.16343 180.5 16 180.5H559C567.837 180.5 575 173.337 575 164.5V16.5C575 7.66344 567.837 0.5 559 0.5Z"
              fill="url(#paint0_linear_1089_5117)"
            />
            <defs>
              <linearGradient
                id="paint0_linear_1089_5117"
                x1="184.76"
                y1="314.72"
                x2="468.292"
                y2="-76.7917"
                gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#6F6F6F" />
                <stop offset="0.3631" stop-color="#656565" />
                <stop offset="0.8115" stop-color="#A8A7A7" />
                <stop offset="1" stop-color="#191919" />
              </linearGradient>
            </defs>
          </svg>
        </div>
      </div>
      <div class="popup-footer">
        <button
          class="next-btn"
          @click="goNext()"
          :disabled="!isNext"
          :style="!isNext ? 'background-color: #EDEDED; color: #9E9FA7' : ''"
        >
          Next
        </button>
      </div>
    </div>
    <Loader v-if="isLoading" />
    <Winner
      v-if="isConfirm"
      :spin="selectedObject.coupon"
      :link="scratchData.link"
    />
  </div>
</template>

<script>
import axios from "axios";
import Loader from "../shared/LoaderComponent.vue";
import Winner from "../shared/WinnerComponent.vue";
import PlayScratch from "./PlayScratchComponent.vue";
export default {
  props: {
    scratchId: Number,
  },
  mounted() {
    this.fetchAllScratch();
  },
  data() {
    return {
      isLoading: false,

      isConfirm: false,
      isNext: false,
      scratchData: [],
      filteredScratchData: [],
      selectedObject: [],
      imagePath: wpApiSettings.imagePath,
    };
  },
  components: {
    Loader,
    Winner,
    PlayScratch,
  },
  methods: {
    closePopup() {
      this.$emit("close");
    },
    goNext() {
      this.isConfirm = true;
    },
    randomSetScratchData() {
      if (this.filteredScratchData.length > 0) {
        const randomIndex = Math.floor(
          Math.random() * this.filteredScratchData.length
        );
        const randomObject = this.filteredScratchData[randomIndex];

        const modifiedObject = {};

        for (const key in randomObject) {
          if (randomObject.hasOwnProperty(key)) {
            if (key.startsWith("coupon_")) {
              modifiedObject["coupon"] = randomObject[key];
            } else if (key.startsWith("reward_")) {
              modifiedObject["reward"] = randomObject[key];
            } else {
              modifiedObject[key] = randomObject[key];
            }
          }
        }

        // Check if coupon or reward is empty
        if (
          modifiedObject["coupon"] === "" ||
          modifiedObject["reward"] === ""
        ) {
          // Call the function again to shuffle
          return this.randomSetScratchData();
        }

        // console.log(modifiedObject);
        return modifiedObject;
      } else {
        console.warn("No data available to select randomly.");
      }
    },

    fetchAllScratch() {
      this.isLoading = true;
      axios
        .get(
          wpApiSettings.root +
            "custom/v1/get-scratch-quiz-data/" +
            this.scratchId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.scratchData = response.data;
          this.filteredScratchData = this.filterScratchData(response.data);
          // console.log(this.filteredScratchData);
          this.selectedObject = this.randomSetScratchData();
          // console.log(this.selectedObject);
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
        });
    },
    filterScratchData(data) {
      const filteredData = [];

      // Iterate through keys
      for (const key in data) {
        if (key.startsWith("coupon_") && data[key] !== "N/A") {
          const index = key.split("_")[1];
          const rewardKey = `reward_${index}`;

          // Create filtered object
          const filteredObject = {
            [rewardKey]: data[rewardKey],
            [key]: data[key],
          };

          // Add filtered object to the array
          filteredData.push(filteredObject);
        }
      }

      // console.log(filteredData);
      return filteredData;
    },
    handleScratchPercentage(scratchPercentage) {
      if (scratchPercentage >= 60) {
        this.isNext = true;
      } else {
        this.isNext = false;
      }
    },
  },
};
</script>

<style scoped>
.next-btn {
  padding: 20px 42px;

  border-radius: 12px;
  background: var(--Color-Primary-Color-500, #706aea);
  border: none;

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

  cursor: pointer;
}
.body-des {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}

svg {
  width: 100%;
}
.body-tag {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/H1-H6/H4 | Title 2 | Mobile H2 | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 40px;
  font-style: normal;
  font-weight: 700;
  line-height: 110%; /* 44px */
  letter-spacing: -1.6px;
}
.popup-body-content {
  display: flex;
  flex-direction: column;
  gap: 20px;
  width: 100%;
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

.popup-body-header {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  /* Text/Body/Body 1 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 28px */
}
.l-content img {
  width: 210px;
  border-radius: 24px 0 0 24px;
  object-fit: cover;
}

.popup-body {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.overlay-svg {
  width: 100%;
}

.overlay-svg svg {
  width: 100%;
}

@media screen and (max-width: 1023px) {
  .l-content img {
    width: 210px;
    border-radius: 24px 0 0 24px;
    object-fit: cover;
  }
}

@media screen and (max-width: 767px) {
  .l-content img {
    display: none;
  }

  .r-content {
    padding: 40px 16px;
  }

  .popup-body-header {
    font-size: 16px;
    line-height: 140%;
    letter-spacing: 0;
    text-transform: none;
    text-align: center;
  }

  .body-tag {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
    text-align: center;
  }

  .body-des {
    font-size: 14px;
    line-height: 130%;
    text-align: center;
  }

  .popup-body {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .popup-body-content {
    align-items: center;
  }
}
</style>
