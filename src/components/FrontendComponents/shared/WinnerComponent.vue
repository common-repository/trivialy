<template>
  <div class="winner-custom">
    <img
      :src="imagePath + 'Congratulations.gif'"
      alt=""
      width="130"
      height="130"
    />
    <div class="winnerContent">
      <div class="winner-header-content">
        <div class="winner-header">You're a winner! 🎉</div>
        <div class="winner-header-des">
          {{ this.message }}
        </div>
      </div>
      <div class="coupon-section">
        <div class="coupon-text">{{ couponCode }}</div>

        <div v-if="isCopy" class="cpy-toast">Coppied</div>

        <div class="copy-btn" @click="couponCopy">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="25"
            height="25"
            viewBox="0 0 25 25"
            fill="none"
          >
            <g opacity="0.3">
              <path
                d="M17 1.5H5C3.9 1.5 3 2.4 3 3.5V17.5H5V3.5H17V1.5ZM20 5.5H9C7.9 5.5 7 6.4 7 7.5V21.5C7 22.6 7.9 23.5 9 23.5H20C21.1 23.5 22 22.6 22 21.5V7.5C22 6.4 21.1 5.5 20 5.5ZM20 21.5H9V7.5H20V21.5Z"
                fill="#3A3F57"
              />
            </g>
          </svg>
        </div>
      </div>
    </div>
    <div>
      <a :href="newLink" target="_blank"
        ><button class="shop-btn">Shop Now</button></a
      >
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.addCoupon();

    if (this.link) {
      // console.log("parrent:" + this.link);
      if (!this.link.startsWith("https://")) {
        this.newLink = "https://" + this.link;
        // console.log(this.link);
      } else {
        this.newLink = this.link;
      }
    }
  },
  props: {
    spin: {
      type: String,
      required: true,
    },
    link: String,
    message: String,
  },
  data() {
    return {
      couponCode: "TRQ48674UI",
      isCopy: false,
      newLink: "",
      imagePath: wpApiSettings.imagePath,
    };
  },
  methods: {
    addCoupon() {
      if (this.spin) {
        this.couponCode = this.spin;
      }
    },
    couponCopy() {
      const tempInput = document.createElement("input");
      tempInput.value = this.couponCode;
      document.body.appendChild(tempInput);

      // Select and copy the text inside the input
      tempInput.select();
      document.execCommand("copy");

      // Remove the temporary input element
      document.body.removeChild(tempInput);

      this.isCopy = true;

      setTimeout(() => {
        this.isCopy = false;
      }, 2000);
    },
  },
};
</script>

<style scoped>
.cpy-toast {
  position: absolute;
  top: 13px;
  right: 63px;
  color: #33d286;
}
.winnerContent {
  width: 500px;
  display: flex;
  flex-direction: column;
  gap: 28px;
}
.winner-custom {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 28px;
  height: 100%;
}
.shop-btn {
  border: none;
  width: 500px;
  padding: 20px 16px;
  border-radius: 12px;
  background-color: #706aea;

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
.copy-btn {
  cursor: pointer;
}
.coupon-text {
  color: #2f2f2f;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: bold;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}
.coupon-section {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;

  border: 1px solid #c9c9ce;
  background-color: #eeeef4;
  padding: 12px 16px;
  border-radius: 12px;
}
.winner-header-des {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  text-align: center;
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}
.winner-header-content {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.winner-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  text-align: center;
  /* Text/H1-H6/H4 | Title 2 | Mobile H2 | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 40px;
  font-style: normal;
  font-weight: 700;
  line-height: 110%; /* 44px */
  letter-spacing: -1.6px;
}

@media screen and (max-width: 767px) {
  .winner-custom img {
    width: 120px;
    height: 120px;
  }

  .winner-header {
    font-size: 24px;
    font-style: normal;
    line-height: 120%;
  }

  .winner-header-des {
    font-size: 12px;
    line-height: 130%;
  }

  .winnerContent {
    width: auto;
  }

  .shop-btn {
    width: 296px;
    padding: 16px 20px;
  }
}
</style>
