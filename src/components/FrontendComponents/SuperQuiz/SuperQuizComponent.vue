<template>
  <div v-if="!isLeaderBoard" class="l-content">
    <img :src="imagePath + 'quiz-banner.jpg'" alt="" />
  </div>
  <div v-if="!isLeaderBoard" class="r-content">
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
    <div v-if="!isStart && !isResult && !isWinner" class="popup-body">
      <div class="popup-body-header">Get Ready to Quiz!</div>
      <div class="popup-body-des">
        Win exciting Promo offers by answering Quizes!
      </div>
      <div class="popup-body-para">
        Test your knowledge with our engaging questions. Dive into the challenge
        – Start Quiz Questions! Awesome offers awaits for you!
      </div>
      <div class="popup-body-footer">
        <button class="start-btn" @click="startQuiz">Let's Start</button>
      </div>
    </div>
    <Play
      v-if="isStart"
      :questionData="passedQuestionData"
      :currentQuestion="currentQuestion"
      :totalQuestion="totalQuestion"
      @next="enableNext"
    />
    <button
      v-if="isStart"
      class="next-btn"
      @click="quizFinish"
      :disabled="isDisable"
      :style="isDisable ? 'background-color: #EDEDED; color: #9E9FA7' : ''"
    >
      Next
    </button>

    <Result v-if="isResult" :totalAns="totalCurrentAns" />
    <button v-if="isResult" class="coupon-btn" @click="getCoupon">
      Complete & Get a Coupon
    </button>

    <Winner
      v-if="isWinner"
      :coupon="couponReward"
      :message="messageReward"
      :link="quizData.link"
      :timer="elapsedTime"
      :rightAns="totalCurrentAns"
      :quiz_type="quiz_type"
      :totalQuestion="sortedQuestionData.length"
      @leaderboardDataSaved="showLeaderboard"
    />
    <Loader v-if="isLoading" />
  </div>
  <LeaderBoardComponent
    v-if="isLeaderBoard"
    @close="closePopup"
    :leaderboardData="leaderboard"
    :coupon="couponReward"
    :link="quizData.link"
  />
</template>

<script>
import axios from "axios";
import LeaderBoardComponent from "../shared/LeaderBoardComponent.vue";
import Loader from "../shared/LoaderComponent.vue";
import Winner from "../shared/QuizWinnerWithLeaderboard.vue";
import Play from "./PlaySuperQuizComponent.vue";
import Result from "./SuperQuizResultComponent.vue";
export default {
  props: {
    superQuizId: Number,
  },
  mounted() {
    // console.log(this.baseUrl);
    this.fetchQuizData();
  },
  data() {
    return {
      isStart: false,
      isResult: false,
      isWinner: false,
      paused: false,

      baseUrl: this.$base_url,
      isLoading: false,
      quizData: [],
      questionCount: 1,
      currentQuestion: 1,
      totalCurrentAns: 0,
      elapsedTime: 0,
      isDisable: true,
      totalQuestion: null,
      sortedQuestionData: [],
      passedQuestionData: [],
      couponReward: "",
      messageReward: "",

      quiz_type: "Text",
      isLeaderBoard: false,
      leaderboard: [],
      rewardData: [],
      messageData: [],
      imagePath: wpApiSettings.imagePath,
    };
  },
  components: {
    Play,
    Result,
    Winner,
    Loader,
    LeaderBoardComponent,
  },
  methods: {
    fetchQuizData() {
      this.isLoading = true;
      axios
        .get(
          wpApiSettings.root + "custom/v1/get-quiz-data/" + this.superQuizId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.quizData = response.data;
          this.messageData = JSON.parse(response.data.reward_message);
          this.rewardData = JSON.parse(response.data.reward);

          this.fetchQuestionData(response.data);
          // console.log(this.quizData);
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    showLeaderboard(data) {
      this.isLeaderBoard = data.createdData.success;
      this.leaderboard = data.createdData.data;
    },
    fetchQuestionData(data) {
      // console.log(data);
      const sortingAttribute = {
        category: data.quiz_category,
        location: data.quiz_location,
        hardness: data.quiz_hardness,
        question_number: data.question_number,
      };

      axios
        .post(this.baseUrl + "sort_quiz", sortingAttribute)
        .then((response) => {
          this.sortedQuestionData = response.data.data;

          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });

      // console.log(sortingAttribute);
    },
    enableNext(correctAns) {
      this.totalCurrentAns = correctAns;
      // console.log(this.totalCurrentAns);
      this.isDisable = false;
    },
    closePopup() {
      this.$emit("close");
    },
    startQuiz() {
      this.startTimer();
      if (this.sortedQuestionData.length > 0) {
        this.passedQuestionData = this.sortedQuestionData[0];
        this.totalQuestion = this.sortedQuestionData.length;
      }
      this.isStart = true;
    },
    quizFinish() {
      if (this.questionCount < this.sortedQuestionData.length) {
        this.isDisable = true;
        this.passedQuestionData = this.sortedQuestionData[this.questionCount];
        this.currentQuestion = this.questionCount + 1;
        this.questionCount++;
      } else {
        this.paused = true;
        this.isStart = false;
        this.isResult = true;
      }
    },
    getCoupon() {
      this.couponReward = this.rewardData[this.totalCurrentAns - 1];
      this.messageReward = this.messageData[this.totalCurrentAns - 1];
      // console.log(this.messageReward);
      this.isResult = false;
      this.isWinner = true;
    },
    startTimer() {
      this.timerInterval = setInterval(() => {
        if (!this.paused) {
          this.elapsedTime += 1;
        }
      }, 1000); // Update elapsed time every 1000 milliseconds (1 second)
    },
  },
};
</script>

<style scoped>
.coupon-btn {
  margin-top: 40px;

  background-color: #706aea;
  padding: 20px 16px;
  cursor: pointer;
  border: none;
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
.next-btn {
  background-color: #706aea;
  padding: 14px 50px;
  cursor: pointer;
  border: none;
  border-radius: 12px;
  margin-top: 26px;
  color: var(--color-text-colors-50-white-high-emp, #fff);
  font-feature-settings: "clig" off, "liga" off;
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 600;
  line-height: 110%; /* 22px */
}
.start-btn {
  width: 200px;
  padding: 20px 16px;
  border: none;
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
.popup-body-para {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}
.popup-body-des {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/H1-H6/H5 | Title 2 | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 32px;
  font-style: normal;
  font-weight: 900;
  line-height: 115%; /* 36.8px */
  letter-spacing: -0.64px;
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
.popup-body {
  height: 89%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 24px;
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
    border-radius: 24px 0 0 24px;
    object-fit: cover;
    width: 284px;
  }

  .svg-logo svg {
    width: 160px;
    height: 160px;
  }
}

@media screen and (max-width: 767px) {
  .r-content {
    padding: 32px 16px;
    text-align: center;
  }
  .coupon-btn {
    padding: 16px 20px;
    font-size: 16px;
    line-height: 140%;
    width: 240px;
    margin-top: 50px;
  }

  .next-btn {
    width: 140px;
    padding: 16px 20px;
    font-size: 16px;
    margin-top: 48px;
  }
  .l-content {
    display: none;
  }

  .popup-body {
    align-items: center;
  }

  .popup-body-header {
    font-size: 16px;
    line-height: 140%;
    letter-spacing: 0;
    text-align: center;
  }

  .popup-body-des {
    font-size: 24px;
    font-weight: 700;
    line-height: 120%;
    text-align: center;
  }

  .popup-body-para {
    font-size: 14px;
    line-height: 130%;
    text-align: center;
  }

  .start-btn {
    margin-top: 32px;
    padding: 16px 20px;
    width: auto;
  }

  .svg-logo svg {
    width: 120px;
    height: 120px;
  }
}
</style>
