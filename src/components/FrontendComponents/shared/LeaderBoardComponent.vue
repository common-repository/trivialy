<template>
  <div class="leaderboard-master">
    <div class="closebtn-section">
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
    <div class="leader-board-container">
      <div class="popup-primary-header">Quiz</div>
      <div class="popup-secondary-header">Leaderboard</div>
      <div class="quizLeader-wrap">
        <table>
          <thead>
            <tr>
              <th>Ranking</th>
              <th>Name</th>
              <th>Quiz type</th>
              <th>Spent Time (s)</th>
              <th>Right Answer</th>
              <th>Win Percentage</th>
            </tr>
          </thead>
          <Loader v-if="isLoading" />
          <tbody v-else>
            <tr v-for="(item, index) in sortedData" :key="index">
              <td>
                <img v-if="item.rank == 1" :src="firstRank" alt="" />
                <img v-else-if="item.rank == 2" :src="secondRank" alt="" />
                <img v-else-if="item.rank == 3" :src="thirdRank" alt="" />
                <div v-else>
                  {{ item.rank < 10 ? "0" + item.rank : item.rank }}
                </div>
              </td>
              <td>{{ item.user_name }}</td>

              <td>{{ item.quiz_type }}</td>
              <td>{{ calculate_time(item.spent_time) }} Minutes</td>
              <td>{{ item.right_ans }}</td>
              <td>{{ winPercentage(item.won_reward) }}%</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="popup-footer-content">
        <div class="coupon-section">
          <div class="coupon-text">{{ coupon }}</div>
          <div v-if="isCopy" class="cpy-toast">Coppied</div>
          <svg
            class="copy-btn"
            @click="couponCopy"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="25"
            viewBox="0 0 24 25"
            fill="none"
          >
            <g opacity="0.3">
              <path
                d="M16.5 1.5H4.5C3.4 1.5 2.5 2.4 2.5 3.5V17.5H4.5V3.5H16.5V1.5ZM19.5 5.5H8.5C7.4 5.5 6.5 6.4 6.5 7.5V21.5C6.5 22.6 7.4 23.5 8.5 23.5H19.5C20.6 23.5 21.5 22.6 21.5 21.5V7.5C21.5 6.4 20.6 5.5 19.5 5.5ZM19.5 21.5H8.5V7.5H19.5V21.5Z"
                fill="#3A3F57"
              />
            </g>
          </svg>
        </div>
        <a :href="link" target="_blank">Shop Now</a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Loader from "./LoaderComponent.vue";
export default {
  mounted() {
    // console.log(this.leaderboardData, " ", this.coupon);
    this.fetchLeaderboard(this.leaderboardData.id);
  },
  props: {
    leaderboardData: Object,
    coupon: String,
    link: String,
  },
  data() {
    return {
      isLoading: false,
      sortedData: [],
      isCopy: false,
      firstRank: wpApiSettings.imagePath + "/rank-img/rank-1st.svg",
      secondRank: wpApiSettings.imagePath + "/rank-img/rank-2nd.svg",
      thirdRank: wpApiSettings.imagePath + "/rank-img/rank-3rd.svg",
    };
  },
  methods: {
    winPercentage(percentage) {
      return parseFloat(percentage).toFixed(2);
    },

    calculate_time(time) {
      const minutes = Math.floor(time / 60);
      const seconds = time % 60;

      // Format the time as MM:SS
      const formattedTime =
        (minutes < 10 ? "0" : "") +
        minutes +
        ":" +
        (seconds < 10 ? "0" : "") +
        seconds;

      return formattedTime;
    },
    closePopup() {
      this.$emit("close");
    },

    couponCopy() {
      const tempInput = document.createElement("input");
      tempInput.value = this.coupon;
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
    fetchLeaderboard(id) {
      this.isLoading = true;
      const data = {
        id: id,
      };

      axios
        .post(
          wpApiSettings.root + "custom/v1/get-all-quiz-leaderboard-sorted-data",
          data,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.sortedData = response.data;
          // console.log(this.sortedData);
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
  },
  components: {
    Loader,
  },
};
</script>

<style scoped>
.popup-footer-content {
  margin-top: 8px;
}
.popup-footer-content a {
  border: none;
  padding: 20px;
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

.cpy-toast {
  position: absolute;
  top: 14px;
  right: 63px;
  color: #33d286;
}

.copy-btn {
  cursor: pointer;
}
.coupon-text {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Link/Link 2 | Active | Medium 500 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}
.coupon-section {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 260px;
  height: 62px;
  background-color: #eeeef4;
  border-radius: 12px;
  border: 1px solid #c9c9ce;
  padding: 12px 16px;
}
.closebtn-section {
  display: flex;
  justify-content: end;
}
.close-btn {
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 4px 4px 20px 0px rgba(0, 0, 0, 0.1);
  border-radius: 100px;
  padding: 6px;
  cursor: pointer;
}

td img {
  width: 22px;
  height: 22px;
}

.leaderboard-master {
  display: flex;
  flex-direction: column;
  padding: 24px;
  width: 100%;
}
.leader-board-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  gap: 8px;
}

.popup-primary-header {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 110%; /* 26.4px */
  letter-spacing: 6px;
  text-transform: uppercase;
}

.popup-secondary-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 36px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 48.4px */
}

table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  padding: 8px 16px;
  text-align: left;
  border-bottom: 1px solid #ddd; /* Border color for the bottom of each cell */
}

th {
  background-color: #706aea; /* Blue color for header */
  border-bottom: 1px solid #cad1fb;
  color: #fff; /* Text color for header */
}

tbody {
  background-color: #fff; /* White color for body */
}

tr:last-child td {
  border-bottom: none; /* Remove bottom border for the last row */
}
th:first-child {
  border-radius: 8px 0px 0px 0px;
}
th:last-child {
  border-radius: 0px 8px 0px 0px;
}

tbody tr:last-child {
  background-color: #cad1fb;
}

tbody tr:last-child td:last-child {
  border-radius: 0 0 8px 0;
}

tbody tr:last-child td:first-child {
  border-radius: 0 0 0 8px;
}

.popup-footer-content {
  margin-top: 8px;
  display: flex;
  gap: 8px;
  justify-content: start;
}

@media screen and (max-width: 767px) {
  .popup-footer-content a {
    padding: 16px;
    font-size: 14px;
    line-height: normal; /* 22px */
  }
  .leaderboard-master {
    padding: 32px 16px;
  }

  .quizLeader-wrap {
    overflow: auto;
    white-space: nowrap;
    padding-bottom: 16px;
  }

  .quizLeader-wrap::-webkit-scrollbar-track {
    background-color: #eff1fe; /* Set the background color of the track */
  }

  .quizLeader-wrap::-webkit-scrollbar-thumb:hover {
    background-color: #706aea; /* Set the color of the thumb on hover */
  }

  .cpy-toast {
    font-size: 8px;
  }

  .popup-primary-header {
    font-size: 16px;
    line-height: 140%;
  }

  .popup-secondary-header {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
  }

  .coupon-section {
    width: 177px;
    height: 52px;
    padding: 20px 16px;
  }

  .popup-footer-content button {
    padding: 16px;
    font-size: 16px;
    font-weight: 600;
    line-height: 140%;
  }
}
</style>
