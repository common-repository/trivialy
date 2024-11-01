<template>
  <div class="master-spin">
    <div class="spin">
      <div class="lucky-wheel" ref="luckyWheel">
        <div class="pointer-container">
          <!-- pointer -->
          <div
            class="pointer"
            id="pointer"
            ref="pointer"
            :style="{ transform: rotate_deg, transition: prize_transition }"
          ></div>
        </div>
        <!-- lucky wheel -->
        <div :class="containerClass">
          <div
            v-for="(item, index) in prizes"
            :key="item.name"
            ref="item"
            :class="itemClass"
          >
            <div :class="contentClass">
              <span class="itemName"
                >{{ separateRewardFirst(item.name) }}
              </span>
              <span class="itemDes">{{ separateRewardSecond(item.name) }}</span>
            </div>
          </div>
        </div>

        <!-- display results -->
      </div>
    </div>

    <div class="luck-btn">
      <button
        class="try-luck-btn"
        @click="prize_draw(num)"
        :disabled="isPlay"
        :style="isPlay ? 'background-color:#EDEDED; color: #9E9FA7' : ''"
      >
        Try Your Luck
      </button>
      <button class="no-btn" @click="$emit('tryLater')">No, Try Later</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: {
    spinId: Number,
  },
  data() {
    return {
      prizes: [],
      prize_name: "",
      prize_coupon: "",
      prize_rotate: [],
      prize_transition: "",
      isShowing: true,
      each_deg: 0,
      rotate_deg: "",
      start_deg: 0,
      current_deg: 0,
      index: 0,
      isPlay: false,
      duration: 3000,
      time_remaining: 20,
      num: 0,
      numbers: [],
      isToggle: false,
      isClicked: false,
      isShow: true,
      spinData: [],
      quadrantData: [],
      isSuccess: false,
      imagePath: wpApiSettings.imagePath,
    };
  },
  mounted() {
    this.fetchSpinData();
    this.setWheelBackgroundImage();
    this.setPointerBackgroundImage();
  },
  computed: {
    containerClass() {
      return this.spinData.select_quadrant == 1
        ? "container"
        : "container container-large";
    },
    itemClass() {
      return this.spinData.select_quadrant == 1
        ? "item item-skew"
        : "item item-skew-large";
    },
    contentClass() {
      return this.spinData.select_quadrant == 1
        ? "item-content"
        : "item-content item-content-large";
    },
    countClass() {
      return this.spinData.select_quadrant == 1 ? "count" : "count count-large";
    },
  },
  methods: {
    setWheelBackgroundImage() {
      const wheelElement = this.$refs.luckyWheel;
      if (wheelElement) {
        const imageUrl = `${this.imagePath}/Spin-Circle.svg`;
        wheelElement.style.setProperty(
          "--wheel-background-image",
          `url(${imageUrl})`
        );
      }
    },
    setPointerBackgroundImage() {
      const pointerElement = this.$refs.pointer;
      if (pointerElement) {
        const imageUrl = `${this.imagePath}/spin-pointer.svg`;
        pointerElement.style.setProperty(
          "--pointer-background-image",
          `url(${imageUrl})`
        );
      }
    },
    separateRewardFirst(data) {
      const words = data.split(/\s+/);

      return words[0];
    },
    separateRewardSecond(data) {
      const words = data.split(/\s+/);

      return words[1];
    },
    fetchSpinData() {
      axios
        .get(
          wpApiSettings.root + "custom/v1/get-spin-quiz-data/" + this.spinId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.spinData = response.data;
          this.initPrize();

          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
        });
    },

    prizeActive() {
      setTimeout(() => {
        this.$refs.item[
          this.index
        ].classList.value = `${this.itemClass} active`;
      }, this.duration);
    },

    initPrize() {
      if (this.spinData.select_quadrant == 1) {
        this.prizes = [
          { name: this.spinData.reward_one, coupon: this.spinData.coupone_one },
          { name: this.spinData.reward_two, coupon: this.spinData.coupone_two },
          {
            name: this.spinData.reward_three,
            coupon: this.spinData.coupone_three,
          },
          {
            name: this.spinData.reward_four,
            coupon: this.spinData.coupone_four,
          },
          {
            name: this.spinData.reward_five,
            coupon: this.spinData.coupone_five,
          },
        ];
      } else if (this.spinData.select_quadrant == 2) {
        this.prizes = [
          { name: this.spinData.reward_one, coupon: this.spinData.coupone_one },
          { name: this.spinData.reward_two, coupon: this.spinData.coupone_two },
          {
            name: this.spinData.reward_three,
            coupon: this.spinData.coupone_three,
          },
          {
            name: this.spinData.reward_four,
            coupon: this.spinData.coupone_four,
          },
          {
            name: this.spinData.reward_five,
            coupon: this.spinData.coupone_five,
          },
          {
            name: this.spinData.reward_six,
            coupon: this.spinData.coupone_six,
          },
          {
            name: this.spinData.reward_seven,
            coupon: this.spinData.coupone_seven,
          },
        ];
      }

      this.num = this.prizes.length;
      this.degree(this.num);
      this.numberArray();
    },
    degree(num) {
      for (let i = 1; i <= num; i++) {
        let deg = 360 / num;
        this.each_deg = deg;
        let eachDeg = i * deg;

        this.prize_rotate.push(eachDeg);
      }
    },
    numberArray() {
      this.numbers = this.prizes.map((prize, index) => index);
    },

    prize_draw(num) {
      this.isPlay = true;
      if (this.isClicked) return;
      this.isShow = this.isClicked;

      this.$refs.item[this.index].classList.value = this.itemClass;

      this.index =
        this.numbers[Math.floor(Math.random() * this.numbers.length)];

      let circle = 4;
      let degree;
      degree =
        this.start_deg +
        circle * 360 +
        this.prize_rotate[this.index] -
        (this.start_deg % 360);

      this.start_deg = degree;

      this.rotate_deg = "rotate" + "(" + degree + "deg)";

      this.prize_transition =
        "all" +
        " " +
        this.duration / 1000 +
        "s" +
        " " +
        "cubic-bezier(0.42, 0, 0.2, 0.91)";

      this.time_remaining--;

      let remainder = this.start_deg % 360;

      this.current_deg =
        remainder <= 0
          ? this.spinData.select_quadrant == 1
            ? remainder + 360
            : remainder + 360 - this.each_deg / 2
          : this.spinData.select_quadrant == 1
          ? remainder
          : remainder - this.each_deg / 2;

      let prize = this.prizes[this.index];

      this.prize_name = prize.name;
      this.prize_coupon = prize.coupon;

      this.prizeActive();

      setTimeout(() => {
        this.isShow = false;
        this.isSuccess = true;
        this.$emit("success-event", {
          prizeCoupon: prize.coupon,
          link: this.spinData.link,
        });
      }, this.duration + 1000);
    },
  },
};
</script>

<style lang="scss" scoped>
$primary-color: #706aea;
$primary-color-dark: #1f1172;
$secondary-color: #dbe0ff;
$access-color: #ffbc3a;
$prize-color: linear-gradient(16deg, #ffbc3a 11.8%, #ffdfa0 90.04%);
$duration: 3s;

$text-blue-color: #3a327d;
$text-white-color: #ffffff;

.master-spin {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.spin {
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  font-family: "Inter", sans-serif;
  position: relative;

  user-select: none;
}

.luck-btn {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}

.no-btn {
  border: none;
  background-color: transparent;
  text-decoration: none;
  width: 100%;
  cursor: pointer;

  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  text-align: center;
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 120%; /* 19.2px */
}

.try-luck-btn {
  border: none;
  padding: 20px 42px;
  border-radius: 12px;
  background-color: #706aea;

  color: var(--color-text-colors-50-white-high-emp, #fff);
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 22px */
  cursor: pointer;
}

.status-container {
  position: relative;
  left: 100px;
}

button:focus {
  outline: 0;
}

.lucky-wheel {
  display: flex;
  width: 330px;
  height: 330px;
  border-radius: 330px;
  justify-content: center;
  align-items: center;
  z-index: 3;

  &::after {
    content: "";
    width: 330px;
    height: 330px;
    background-image: var(--wheel-background-image);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    position: absolute;
  }

  .container {
    display: block;
    width: 300px;
    height: 300px;
    border-radius: 300px;
    overflow: hidden;
    position: relative;
    transform: rotate(-33deg);

    &.container-large {
      display: block;
      display: block;
      width: 300px;
      height: 300px;
      border-radius: 300px;
      overflow: hidden;
      position: relative;
      transform: rotate(-32deg);
    }
  }
}

.pointer-container {
  display: flex;
  width: 80px;
  height: 151px;
  flex-shrink: 0;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  position: absolute;
  color: $access-color;
  font-size: 20px;

  &::after {
    display: flex;
    justify-content: center;
    align-items: center;
    content: "Spin";
    color: #fff;
    width: 70px;
    height: 70px;
    border-radius: 70px;
    background-color: #9e93e4;
    line-height: 130%;
    text-align: center;
    font-weight: 600;
  }

  .pointer {
    width: 100px;
    height: 120px;
    display: block;
    background-image: var(--pointer-background-image);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    position: absolute;
    bottom: 16px;
    transform-origin: 51px 61px;
  }
}

.item {
  position: absolute;
  display: flex;
  width: 50%;
  height: 50%;

  top: 0;
  right: 0;
  transform-origin: 0% 100%;
  justify-content: center;
  align-items: center;
}

$n: 5;

@for $i from 1 through $n {
  $deg: calc(360deg / $n);

  .item-skew:nth-child(#{$i}) {
    transform: rotate($deg * $i) skewY($deg - 90);
  }
}

$num: 7;

@for $i from 1 through $num {
  $deg: calc(360deg / $num);

  .item-skew-large:nth-child(#{$i}) {
    transform: rotate($deg * $i) skewY($deg - 90);
  }
}

.item-content {
  display: flex;
  width: 123px;
  align-items: center;
  flex-direction: column;
  /* font-size: 14px; */
  font-weight: bold;
  transform-origin: center center;
  // 16輪盤

  transform: skewY(12deg) rotate(40deg) translate(-44px, -3px);
  position: absolute;
  right: 0;
  bottom: 0;

  .itemName {
    font-size: 20px;
  }

  .itemDes {
    font-size: 10px;
  }

  &.item-content-large {
    // 20輪盤
    transform: skewY(39deg) rotate(30deg) translate(-55px, -91px);
    position: absolute;
    left: 0;
    top: 196px;
    .itemName {
      font-size: 18;
    }
    .itemDes {
      font-size: 8px;
    }
  }
}

.item:nth-child(odd) {
  background-color: $primary-color;

  .item-content {
    color: $text-white-color;
  }
}

.item:last-child {
  background-color: #fff;

  .item-content {
    color: $text-blue-color;
  }
}

.item:nth-child(even) {
  background-color: $secondary-color;

  .item-content {
    color: $text-blue-color;
  }
}

.item {
  &.active {
    background: $prize-color;

    transition: 0.2s ease-in;

    .item-content {
      color: #706aea;
      transition: 0.2s ease-in;
    }
  }
}

@media screen and (max-width: 767px) {
  .try-luck-btn {
    width: 100%;
    font-size: 16px;
    line-height: 140%;
  }

  .no-btn {
    font-weight: 400;
    font-size: 12px;
    line-height: 130%;
  }

  .lucky-wheel::after {
    width: 305px;
    height: 305px;
  }

  .pointer-container .pointer {
    width: 99px;
    height: 119px;
    bottom: 17px;
    transform-origin: 51px 61px;
  }

  .lucky-wheel .container {
    width: 258px;
    height: 258px;

    &.container-large {
      width: 270px;
      height: 270px;

      .itemName {
        font-size: 16px;
      }

      .itemDes {
        font-size: 12px;
      }
    }
  }

  .pointer-container {
    font-size: 1.5rem;
  }

  .lucky-wheel {
    width: 330px;
    height: 330px;
    border-radius: 330px;
  }

  .pointer-container::after {
    width: 80px;
    height: 80px;
    border-radius: 80px;
  }

  .item-content {
    transform: skewY(12deg) rotate(42deg) translate(-26px, -16px);

    &.item-content-large {
      transform: skewY(40deg) rotate(22deg) translate(-55px, -107px);
    }
  }

  .item-content .itemName {
    font-size: 19px;
  }
  .item-content .itemDes {
    font-size: 12px;
  }

  .item-content-large .itemName {
    font-size: 18px;
  }

  .item-content-large .itemDes {
    font-size: 11px;
  }
}
</style>
