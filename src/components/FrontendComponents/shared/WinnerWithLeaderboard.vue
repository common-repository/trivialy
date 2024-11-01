<template>
  <div v-if="!isLeaderBoard" class="winner-custom">
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
    <div class="leader-board" @click="goLeaderboard">Join Leaderboard</div>
  </div>
  <div v-if="isLeaderBoard" class="leaderBoard">
    <div class="board-form">
      <div class="form-header">
        <div class="header-text">Join Leaderboard!</div>
        <div class="header-des">
          Ready to showcase your skills and climb the ranks? Join our
          leaderboard and compete against the best!
        </div>
      </div>
      <div class="form-body">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" placeholder="Enter Your Name" v-model="add.name" />
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input
            type="email"
            placeholder="Enter Your Email"
            v-model="add.email"
          />
        </div>
        <button
          :disabled="isSubmitDisabled"
          :style="
            isSubmitDisabled ? 'background-color: #C9C9CE;' : 'cursor:pointer'
          "
          @click="saveLeaderboardData"
        >
          Submit
        </button>
      </div>
    </div>
    <Loader v-if="isLoading" />
  </div>
</template>

<script>
import axios from "axios";
import Loader from "./LoaderComponent.vue";
export default {
  props: {
    drag: {
      type: Object,
    },
    coupon: {
      type: String,
    },
    timer: {
      type: String,
    },
    link: String,
    message: String,
  },
  mounted() {
    if (this.drag) {
      this.couponCode = this.drag.coupon;
    } else if (this.coupon) {
      this.couponCode = this.coupon;
    }

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
  components: {
    Loader,
  },
  data() {
    return {
      couponCode: "TRQ48674UI",
      isLeaderBoard: false,
      add: {
        name: "",
        email: "",
      },
      isNotEmail: false,
      isCopy: false,
      isLoading: false,
      createdData: [],
      newLink: "",
      imagePath: wpApiSettings.imagePath,
    };
  },
  computed: {
    isSubmitDisabled() {
      return (
        !this.add.name || !this.add.email || !this.isValidEmail(this.add.email)
      );
    },
  },
  methods: {
    isValidEmail(email) {
      // Regular expression for a basic email format validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },
    saveLeaderboardData() {
      this.isLoading = true;
      const data = {
        user_name: this.add.name,
        user_email: this.add.email,
        spent_time: this.timer,
        won_reward: this.drag.reward,
      };

      axios
        .post(
          wpApiSettings.root + "custom/v1/save-drag-leaderboard-data",
          data,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.createdData = response.data;
          // console.log(this.createdData);
          this.$emit("leaderboardDataSaved", {
            createdData: this.createdData,
            success: true,
          });
          this.isLoading = false;
        });
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

      // Optionally, provide some feedback to the user
      this.isCopy = true;

      setTimeout(() => {
        this.isCopy = false;
      }, 2000);
    },
    goLeaderboard() {
      this.isLeaderBoard = true;
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
.leaderBoard {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.form-body button {
  border: none;
  background-color: #706aea;
  padding: 20px 16px;
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
.form-group label {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);

  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.form-group input:focus-visible {
  outline: none;
  border: 1px solid #706aea;
}

.form-group input {
  padding: 12px 16px;
  border-radius: 8px;
  border: 1px solid #e3e3e3;
  background-color: #fff;

  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.form-body {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.board-form {
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 32px;
}
.header-des {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  text-align: center;

  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}
.header-text {
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
.form-header {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.leader-board {
  cursor: pointer;
  margin-top: -14px;
  color: var(--Color-Primary-Color-500, #706aea);
  text-align: center;
  /* Text/Body/Body 2 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
}
.winner-custom {
  display: flex;
  height: 100%;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 28px;
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
  font-family: Inter;
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
  .winner-custom {
    width: 100%;
  }
  .winner-custom img {
    width: 120px;
    height: 120px;
  }

  .winner-header {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
    letter-spacing: 0;
  }

  .winnerContent {
    width: auto;
  }

  .winner-header-des {
    font-size: 12px;
  }

  .coupon-section {
    padding: 16px 20px;
  }

  .coupon-text {
    font-size: 18px;
  }

  .shop-btn {
    padding: 16px 20px;
    width: 296px;
  }

  .leader-board {
    font-size: 12px;
  }

  .header-text {
    font-size: 24px;
  }
  .header-des {
    font-size: 12px;
  }

  .form-group label {
    font-size: 14px;
    line-height: 130%;
  }
  .form-group input {
    padding: 16px;
  }

  .form-body button {
    padding: 16px 20px;
    font-size: 16px;
    line-height: 140%;
  }
}
</style>
