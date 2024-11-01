<!-- Accordion.vue -->
<template>
  <div class="accordion">
    <div
      class="accordion-header"
      @click="toggleAccordion"
      :class="isOpen ? 'custom-border' : ''"
    >
      <div class="l-content">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
        >
          <path
            d="M10.5009 8.99996H13.5009C13.7809 8.99996 14.0009 8.77996 14.0009 8.49996V5.99996H15.7909C16.2409 5.99996 16.4609 5.45996 16.1409 5.14996L12.3509 1.35996C12.1509 1.15996 11.8409 1.15996 11.6409 1.35996L7.85094 5.14996C7.54094 5.45996 7.76094 5.99996 8.21094 5.99996H10.0009V8.49996C10.0009 8.77996 10.2209 8.99996 10.5009 8.99996ZM8.50094 9.99996H6.00094V8.20996C6.00094 7.75996 5.46094 7.53996 5.15094 7.85996L1.36094 11.65C1.16094 11.85 1.16094 12.16 1.36094 12.36L5.15094 16.15C5.46094 16.46 6.00094 16.24 6.00094 15.79V14H8.50094C8.78094 14 9.00094 13.78 9.00094 13.5V10.5C9.00094 10.22 8.78094 9.99996 8.50094 9.99996ZM22.6509 11.65L18.8609 7.85996C18.5409 7.53996 18.0009 7.75996 18.0009 8.20996V9.99996H15.5009C15.2209 9.99996 15.0009 10.22 15.0009 10.5V13.5C15.0009 13.78 15.2209 14 15.5009 14H18.0009V15.79C18.0009 16.24 18.5409 16.46 18.8509 16.14L22.6409 12.35C22.8409 12.16 22.8409 11.84 22.6509 11.65ZM13.5009 15H10.5009C10.2209 15 10.0009 15.22 10.0009 15.5V18H8.21094C7.76094 18 7.54094 18.54 7.86094 18.85L11.6509 22.64C11.8509 22.84 12.1609 22.84 12.3609 22.64L16.1509 18.85C16.4609 18.54 16.2409 18 15.8009 18H14.0009V15.5C14.0009 15.22 13.7809 15 13.5009 15Z"
            fill="#B8B8B8"
          />
        </svg>
        {{ question.question }}
      </div>
      <div class="r-content">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
        >
          <path
            d="M8.12656 8.99953L12.0066 12.8795L15.8866 8.99953C16.2766 8.60953 16.9066 8.60953 17.2966 8.99953C17.6866 9.38953 17.6866 10.0195 17.2966 10.4095L12.7066 14.9995C12.3166 15.3895 11.6866 15.3895 11.2966 14.9995L6.70656 10.4095C6.31656 10.0195 6.31656 9.38953 6.70656 8.99953C7.09656 8.61953 7.73656 8.60953 8.12656 8.99953Z"
            fill="#B8B8B8"
          />
        </svg>
      </div>
    </div>
    <div
      style="transition: all 0.3s ease"
      :style="
        isOpen ? 'height : 520px;overflow:auto' : 'height : 0px;overflow:hidden'
      "
    >
      <div class="accordion-content">
        <textarea
          class="question"
          placeholder="Type your question here"
          v-model="questionAllData.questionData"
        ></textarea>
        <div class="option-group">
          <input
            type="text"
            placeholder="Option 1"
            class="option-input"
            v-model="questionAllData.option.option_one"
          />
          <input
            type="Checkbox"
            name="correct_option_one"
            :checked="questionAllData.correct_ans == 0 ? true : false"
            @click="setChecked(0)"
          />
          <label for="">Correct</label>
        </div>
        <div class="option-group">
          <input
            type="text"
            placeholder="Option 2"
            class="option-input"
            v-model="questionAllData.option.option_two"
          />
          <input
            type="Checkbox"
            name="correct_option_two"
            :checked="questionAllData.correct_ans == 1 ? true : false"
            @click="setChecked(1)"
          />
          <label for="">Correct</label>
        </div>
        <div class="option-group">
          <input
            type="text"
            placeholder="Option 3"
            class="option-input"
            v-model="questionAllData.option.option_three"
          />
          <input
            type="Checkbox"
            name="correct_option_three"
            :checked="questionAllData.correct_ans == 2 ? true : false"
            @click="setChecked(2)"
          />
          <label for="">Correct</label>
        </div>
        <div class="option-group">
          <input
            type="text"
            placeholder="Option 4"
            class="option-input"
            v-model="questionAllData.option.option_four"
          />
          <input
            type="Checkbox"
            name="correct_option_four"
            :checked="questionAllData.correct_ans == 3 ? true : false"
            @click="setChecked(3)"
          />
          <label for="">Correct</label>
        </div>
        <div class="accordian-footer">
          <div class="save-btn" @click="saveQuestion(question.id)">
            Save Question
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
export default {
  props: {
    question: String,
    questionSavedData: Array,
  },
  data() {
    return {
      isOpen: false,
      questionAllData: {
        id: "",
        questionData: "",
        option: {
          option_one: "",
          option_two: "",
          option_three: "",
          option_four: "",
        },
        correct_ans: null,
      },
    };
  },
  methods: {
    toggleAccordion(id) {
      this.isOpen = !this.isOpen;
    },
    saveQuestion(id) {
      if (this.isOpen == true) {
        this.saveQuestionData(id);
      }
    },
    setChecked(id) {
      this.questionAllData.correct_ans = id;
    },
    saveQuestionData(id) {
      if (
        this.questionAllData.questionData == "" ||
        this.questionAllData.option.option_one == "" ||
        this.questionAllData.option.option_two == "" ||
        this.questionAllData.option.option_three == "" ||
        this.questionAllData.option.option_four == "" ||
        this.questionAllData.correct_ans == null
      ) {
        toast.error("Please Fill All Section", {
          position: toast.POSITION.BOTTOM_RIGHT,
        });
      } else {
        this.questionAllData.id = id;
        this.questionSavedData.push(this.questionAllData);
        toast.success("Question - " + id + " Successfully Saved", {
          position: toast.POSITION.BOTTOM_RIGHT,
        });
        this.isOpen = false;
      }
    },
  },
};
</script>

<style scoped>
/* Add styles for the accordion here */
.accordion {
  margin-bottom: 16px;
}

.btn-text {
  color: #706aea;
  text-align: center;
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
  cursor: pointer;
}

.accordian-footer {
  display: flex;
  justify-content: end;
}

.save-btn {
  padding: 12px 16px;
  border: 1px solid #706aea;
  border-radius: 8px;
  cursor: pointer !important;

  color: #706aea;
  text-align: center;
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
}

.option-group {
  display: flex;
  align-items: center;
  gap: 12px;
}

.custom-border {
  border-radius: 12px 12px 0px 0px !important;
}

.option-input {
  width: 93%;
  padding: 16px 24px;
  border-radius: 12px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);

  color: var(--color-text-colors-200-white-low-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.question {
  width: 100%;
  resize: none;
  height: 120px;
  border: 1px solid #e3e3e3;
  border-radius: 12px;
  padding: 24px;

  color: var(--color-text-colors-200-white-low-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.l-content {
  display: flex;
  align-items: center;
  gap: 16px;
}

.accordion-header {
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  padding: 16px 24px;
  background-color: #ffffff;
  border-radius: 12px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}

.accordion-content {
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 24px;
  border-radius: 16px;
  background-color: #ffffff;
  border: 1px solid #ffffff;
  border-radius: 0 0 16px 16px;
}
</style>
