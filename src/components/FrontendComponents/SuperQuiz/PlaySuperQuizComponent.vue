<template>
  <div class="question-body">
    <div class="questions">
      <div class="question-no">
        Question {{ currentQuestion }}/{{ totalQuestion }}
      </div>
    </div>
    <div class="question-content">
      <div class="question">{{ questionData.question }}</div>
      <div class="option-group">
        <div class="options">
          <div
            class="option"
            :class="
              isCorrect[0]
                ? 'correct_select'
                : '' || isWrong[0]
                ? 'wrong_select'
                : ''
            "
            @click="setResult(0)"
          >
            <div>{{ letterCount(questionData.option_one) }}</div>
            <svg
              v-if="isCorrect[0]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM9.29 16.29L5.7 12.7C5.31 12.31 5.31 11.68 5.7 11.29C6.09 10.9 6.72 10.9 7.11 11.29L10 14.17L16.88 7.29C17.27 6.9 17.9 6.9 18.29 7.29C18.68 7.68 18.68 8.31 18.29 8.7L10.7 16.29C10.32 16.68 9.68 16.68 9.29 16.29Z"
                fill="#1CAF68"
              />
            </svg>
            <svg
              v-if="isWrong[0]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 25 24"
              fill="none"
            >
              <path
                d="M12.5 2C6.97 2 2.5 6.47 2.5 12C2.5 17.53 6.97 22 12.5 22C18.03 22 22.5 17.53 22.5 12C22.5 6.47 18.03 2 12.5 2ZM16.8 16.3C16.41 16.69 15.78 16.69 15.39 16.3L12.5 13.41L9.61 16.3C9.22 16.69 8.59 16.69 8.2 16.3C7.81 15.91 7.81 15.28 8.2 14.89L11.09 12L8.2 9.11C7.81 8.72 7.81 8.09 8.2 7.7C8.59 7.31 9.22 7.31 9.61 7.7L12.5 10.59L15.39 7.7C15.78 7.31 16.41 7.31 16.8 7.7C17.19 8.09 17.19 8.72 16.8 9.11L13.91 12L16.8 14.89C17.18 15.27 17.18 15.91 16.8 16.3Z"
                fill="#F55151"
              />
            </svg>
          </div>
          <div
            class="option"
            :class="
              isCorrect[1]
                ? 'correct_select'
                : '' || isWrong[1]
                ? 'wrong_select'
                : ''
            "
            @click="setResult(1)"
          >
            <div>{{ letterCount(questionData.option_two) }}</div>
            <svg
              v-if="isCorrect[1]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM9.29 16.29L5.7 12.7C5.31 12.31 5.31 11.68 5.7 11.29C6.09 10.9 6.72 10.9 7.11 11.29L10 14.17L16.88 7.29C17.27 6.9 17.9 6.9 18.29 7.29C18.68 7.68 18.68 8.31 18.29 8.7L10.7 16.29C10.32 16.68 9.68 16.68 9.29 16.29Z"
                fill="#1CAF68"
              />
            </svg>
            <svg
              v-if="isWrong[1]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 25 24"
              fill="none"
            >
              <path
                d="M12.5 2C6.97 2 2.5 6.47 2.5 12C2.5 17.53 6.97 22 12.5 22C18.03 22 22.5 17.53 22.5 12C22.5 6.47 18.03 2 12.5 2ZM16.8 16.3C16.41 16.69 15.78 16.69 15.39 16.3L12.5 13.41L9.61 16.3C9.22 16.69 8.59 16.69 8.2 16.3C7.81 15.91 7.81 15.28 8.2 14.89L11.09 12L8.2 9.11C7.81 8.72 7.81 8.09 8.2 7.7C8.59 7.31 9.22 7.31 9.61 7.7L12.5 10.59L15.39 7.7C15.78 7.31 16.41 7.31 16.8 7.7C17.19 8.09 17.19 8.72 16.8 9.11L13.91 12L16.8 14.89C17.18 15.27 17.18 15.91 16.8 16.3Z"
                fill="#F55151"
              />
            </svg>
          </div>
        </div>
        <div class="options">
          <div
            class="option"
            :class="
              isCorrect[2]
                ? 'correct_select'
                : '' || isWrong[2]
                ? 'wrong_select'
                : ''
            "
            @click="setResult(2)"
          >
            <div>{{ letterCount(questionData.option_three) }}</div>
            <svg
              v-if="isCorrect[2]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM9.29 16.29L5.7 12.7C5.31 12.31 5.31 11.68 5.7 11.29C6.09 10.9 6.72 10.9 7.11 11.29L10 14.17L16.88 7.29C17.27 6.9 17.9 6.9 18.29 7.29C18.68 7.68 18.68 8.31 18.29 8.7L10.7 16.29C10.32 16.68 9.68 16.68 9.29 16.29Z"
                fill="#1CAF68"
              />
            </svg>
            <svg
              v-if="isWrong[2]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 25 24"
              fill="none"
            >
              <path
                d="M12.5 2C6.97 2 2.5 6.47 2.5 12C2.5 17.53 6.97 22 12.5 22C18.03 22 22.5 17.53 22.5 12C22.5 6.47 18.03 2 12.5 2ZM16.8 16.3C16.41 16.69 15.78 16.69 15.39 16.3L12.5 13.41L9.61 16.3C9.22 16.69 8.59 16.69 8.2 16.3C7.81 15.91 7.81 15.28 8.2 14.89L11.09 12L8.2 9.11C7.81 8.72 7.81 8.09 8.2 7.7C8.59 7.31 9.22 7.31 9.61 7.7L12.5 10.59L15.39 7.7C15.78 7.31 16.41 7.31 16.8 7.7C17.19 8.09 17.19 8.72 16.8 9.11L13.91 12L16.8 14.89C17.18 15.27 17.18 15.91 16.8 16.3Z"
                fill="#F55151"
              />
            </svg>
          </div>
          <div
            class="option"
            :class="
              isCorrect[3]
                ? 'correct_select'
                : '' || isWrong[3]
                ? 'wrong_select'
                : ''
            "
            @click="setResult(3)"
          >
            <div>{{ letterCount(questionData.option_four) }}</div>
            <svg
              v-if="isCorrect[3]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM9.29 16.29L5.7 12.7C5.31 12.31 5.31 11.68 5.7 11.29C6.09 10.9 6.72 10.9 7.11 11.29L10 14.17L16.88 7.29C17.27 6.9 17.9 6.9 18.29 7.29C18.68 7.68 18.68 8.31 18.29 8.7L10.7 16.29C10.32 16.68 9.68 16.68 9.29 16.29Z"
                fill="#1CAF68"
              />
            </svg>
            <svg
              v-if="isWrong[3]"
              xmlns="http://www.w3.org/2000/svg"
              width="18"
              height="18"
              viewBox="0 0 25 24"
              fill="none"
            >
              <path
                d="M12.5 2C6.97 2 2.5 6.47 2.5 12C2.5 17.53 6.97 22 12.5 22C18.03 22 22.5 17.53 22.5 12C22.5 6.47 18.03 2 12.5 2ZM16.8 16.3C16.41 16.69 15.78 16.69 15.39 16.3L12.5 13.41L9.61 16.3C9.22 16.69 8.59 16.69 8.2 16.3C7.81 15.91 7.81 15.28 8.2 14.89L11.09 12L8.2 9.11C7.81 8.72 7.81 8.09 8.2 7.7C8.59 7.31 9.22 7.31 9.61 7.7L12.5 10.59L15.39 7.7C15.78 7.31 16.41 7.31 16.8 7.7C17.19 8.09 17.19 8.72 16.8 9.11L13.91 12L16.8 14.89C17.18 15.27 17.18 15.91 16.8 16.3Z"
                fill="#F55151"
              />
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    // console.log(this.questionData.correct_ans);
  },
  props: {
    questionData: {
      type: Object,
      required: true,
    },
    totalQuestion: {
      type: Number,
      required: true,
    },
    currentQuestion: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      isCorrect: [false, false, false, false],
      isWrong: [false, false, false, false],
      isResult: false,
      isCorrectAns: false,
      isclicked: false,
      correctAns: 0,
    };
  },
  watch: {
    questionData(newValue) {
      this.isCorrect = [false, false, false, false];
      this.isWrong = [false, false, false, false];
      this.isResult = false;
      this.isCorrectAns = false;
      this.isclicked = false;
    },
  },
  methods: {
    setResult(id) {
      if (this.isclicked) {
        return;
      }
      const correct = this.questionData.correct_ans;

      if (id == correct) {
        this.isResult = true;
        this.isCorrect[id] = true;
        this.isCorrectAns = true;
        this.correctAns++;
      } else {
        this.isResult = true;
        this.isWrong[id] = true;
      }
      this.isclicked = true;
      this.$emit("next", this.correctAns);
    },
    letterCount(string) {
      if (string.length > 20) {
        newString = string.slice(0, 20);
        return newString + "...";
      } else {
        return string;
      }
    },
  },
  components: {},
};
</script>

<style scoped>
.wrong_select {
  border: 1px solid #f55151 !important;
  background-color: #fff3f3;
}
.correct_select {
  border: 1px solid #33d286 !important;
  background-color: #edfff6;
}

.result {
  margin-top: 24px;
}
.correct_ans {
  color: #2cc672;
}
.wrong_ans {
  color: #ff5858;
}
.question-content img {
  border-radius: 12px;
}
.question-body {
  height: 68%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 12px;
}
.option {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px;
  width: 100%;
  border: 1px solid #e3e3e3;
  border-radius: 8px;

  color: var(--Color-Neutral-Colors-700, #444448);
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
  cursor: pointer;
}
.options {
  display: flex;
  gap: 16px;
}
.option-group {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
.question {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/H1-H6/H7 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 28px;
  font-style: normal;
  font-weight: 700;
  line-height: 115%; /* 32.2px */
  letter-spacing: -0.56px;
}
.question-no {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  /* Text/Body/Body 1 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 28px */
}
.question-content {
  border-radius: 24px;
  border: 1px solid #e3e3e3;
  padding: 24px 24px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.questions {
  display: flex;
}
.total-question {
  color: var(--color-text-colors-200-white-low-emp, #9e9fa7);
  font-size: 20px;
}

@media screen and (max-width: 767px) {
  .questions {
    align-items: center;
  }

  .options {
    flex-direction: column;
  }

  .question-no {
    font-size: 16px;
    letter-spacing: 0;
    line-height: 140%;
  }
  .total-question {
    font-size: 16px;
    line-height: 140%;
  }

  .question {
    font-size: 16px;
    font-weight: 600;
    line-height: 140%;
    text-align: center;
  }
}
</style>
