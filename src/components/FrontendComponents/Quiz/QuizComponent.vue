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
      :link="AllQuizData.link"
      :timer="elapsedTime"
      :rightAns="totalCurrentAns"
      :quiz_type="quiz_type"
      :totalQuestion="totalQuestion"
      @leaderboardDataSaved="showLeaderboard"
    />
  </div>
  <LeaderBoardComponent
    v-if="isLeaderBoard"
    @close="closePopup"
    :leaderboardData="leaderboard"
    :coupon="couponReward"
    :link="AllQuizData.link"
  />
</template>

<script>
import axios from "axios";
import LeaderBoardComponent from "../shared/LeaderBoardComponent.vue";
import Winner from "../shared/QuizWinnerWithLeaderboard.vue";
import Play from "./PlayQuizComponent.vue";
import Result from "./QuizResultComponent.vue";
export default {
  props: {
    customQuizId: Number,
  },
  mounted() {
    this.fetchAllCustomQuiz();
    console.log(this.imagePath);
  },
  data() {
    return {
      isDisable: true,
      isStart: false,
      isResult: false,
      isWinner: false,
      paused: false,

      AllQuizData: [],
      QuestionData: [],
      passedQuestionData: [],
      rewardData: [],
      questionCount: 1,
      totalQuestion: null,
      currentQuestion: 1,
      totalCurrentAns: 0,
      couponReward: "",
      messageReward: "",
      messageData: [],
      elapsedTime: 0,

      quiz_type: "Custom",

      isLeaderBoard: false,
      leaderboard: [],
      imagePath: wpApiSettings.imagePath,
    };
  },
  components: {
    Play,
    Result,
    Winner,
    LeaderBoardComponent,
  },
  methods: {
    fetchAllCustomQuiz() {
      this.isLoading = true;
      axios
        .get(
          wpApiSettings.root +
            "custom/v1/get-custom-quiz-data/" +
            this.customQuizId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.AllQuizData = response.data;
          // console.log(this.AllQuizData);
          this.rewardData = JSON.parse(response.data.reward);
          this.messageData = JSON.parse(response.data.reward_message);
          // console.log(this.rewardData);
          this.QuestionData = this.shortQuestionData(response.data);
          // console.log(this.QuestionData);
          this.this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
        });
    },
    showLeaderboard(data) {
      this.isLeaderBoard = data.createdData.success;
      this.leaderboard = data.createdData.data;
    },
    enableNext(correctAns) {
      this.totalCurrentAns = correctAns;
      // console.log(this.totalCurrentAns);
      this.isDisable = false;
    },
    closePopup() {
      this.$emit("close");
    },
    shortQuestionData(data) {
      let questions = JSON.parse(data.question);
      let rewards = JSON.parse(data.reward);

      // Create an array to store merged data
      let mergedData = [];

      // Iterate through the arrays and merge the data
      let minLength = Math.min(questions.length, rewards.length);
      for (let i = 0; i < minLength; i++) {
        let mergedItem = {
          question: questions[i],
          reward: rewards[i],
        };
        mergedData.push(mergedItem);
      }

      // If there are remaining questions, fill them with "No reward"
      for (let i = minLength; i < questions.length; i++) {
        let mergedItem = {
          question: questions[i],
          reward: "No reward",
        };
        mergedData.push(mergedItem);
      }

      // If there are remaining rewards, fill them with "No question"
      for (let i = minLength; i < rewards.length; i++) {
        let mergedItem = {
          question: "No question",
          reward: rewards[i],
        };
        mergedData.push(mergedItem);
      }

      return mergedData;
    },
    startQuiz() {
      this.startTimer();
      if (this.QuestionData.length > 0) {
        this.passedQuestionData = this.QuestionData[0];
        this.totalQuestion = this.QuestionData.length;
      }

      this.isStart = true;
    },
    quizFinish() {
      if (this.questionCount < this.QuestionData.length) {
        this.isDisable = true;
        this.passedQuestionData = this.QuestionData[this.questionCount];
        this.currentQuestion = this.questionCount + 1;
        this.questionCount++;
      } else {
        this.isStart = false;
        this.isResult = true;
      }
    },
    getCoupon() {
      // console.log(this.totalCurrentAns);
      this.couponReward = this.rewardData[this.totalCurrentAns - 1];
      this.messageReward = this.messageData[this.totalCurrentAns - 1];
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
  font-family: Inter;
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
  padding: 40px;
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

@media screen and (max-width: 767px) {
  .popup-body {
    height: 77%;
  }
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
    margin-top: 24px;
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
