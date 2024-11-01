<template>
  <div class="result-page">
    <div class="result-status">Completed!</div>
    <div class="result-body">
      <img
        :src="imagePath + 'text_snippet.png'"
        alt=""
        width="40"
        height="40"
      />
      <div class="right-ans">{{ totalAns }} correct answers</div>
      <div class="ans-detail">
        You gave {{ totalAns }} correct answers and got a coupon, Go to next to
        collect the coupon!
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    totalAns: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      imagePath: wpApiSettings.imagePath,
    };
  },
};
</script>

<style scoped>
.ans-detail {
  margin-top: 16px;
  color: #808080;

  /* Text/Body/Body 1 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 28px */
}
.right-ans {
  margin-top: 24px;
  color: var(--Color-Primary-Color-500, #706aea);
  font-family: "Inter", sans-serif;
  font-size: 44px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 48.4px */
  letter-spacing: -1.76px;
}
.result-body {
  border: 1px solid #e3e3e3;
  border-radius: 16px;
  padding: 24px;
  display: flex;
  flex-direction: column;
}
.result-page {
  height: 55%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 32px;
  margin-top: 44px;
}
.result-status {
  color: var(--Status-Success, #33d286);
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 26.4px */
  letter-spacing: 6px;
  text-transform: uppercase;
}

@media screen and (max-width: 767px) {
  .result-body {
    align-items: center;
  }
  .result-page {
    height: 45%;
  }
  .right-ans {
    font-size: 20px;
    line-height: 140%;
  }

  .ans-detail {
    font-size: 12px;
    line-height: 130%;
  }
}
</style>
