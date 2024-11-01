<template>
  <div class="quiz-main-header">
    <div class="page-header">
      <div class="left-content">
        <svg
          style="cursor: pointer"
          @click="this.$router.push({ name: 'quizCampaing' })"
          data-v-7078eae5=""
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
        >
          <path
            data-v-7078eae5=""
            d="M22.0001 12.0003C22.0001 12.5523 21.5531 13.0003 21.0001 13.0003H5.41413L10.7071 18.2933C11.0981 18.6842 11.0981 19.3163 10.7071 19.7073C10.5121 19.9023 10.2561 20.0003 10.0001 20.0003C9.74407 20.0003 9.48804 19.9023 9.29304 19.7073L2.29401 12.7083C2.20101 12.6153 2.12797 12.5054 2.07697 12.3824C1.97597 12.1384 1.97597 11.8622 2.07697 11.6182C2.12797 11.4952 2.20101 11.3853 2.29401 11.2923L9.29304 4.29325C9.68403 3.90225 10.3161 3.90225 10.7071 4.29325C11.0981 4.68425 11.0981 5.31631 10.7071 5.70731L5.41413 11.0003H21.0001C21.5531 11.0003 22.0001 11.4483 22.0001 12.0003Z"
            fill="#25314C"
          ></path>
        </svg>
        Text Quiz
      </div>
    </div>
    <div v-if="isPublish" class="campaign-time">
      <div>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="25"
          viewBox="0 0 24 25"
          fill="none"
        >
          <path
            d="M11.99 2.5C6.47 2.5 2 6.98 2 12.5C2 18.02 6.47 22.5 11.99 22.5C17.52 22.5 22 18.02 22 12.5C22 6.98 17.52 2.5 11.99 2.5ZM12 20.5C7.58 20.5 4 16.92 4 12.5C4 8.08 7.58 4.5 12 4.5C16.42 4.5 20 8.08 20 12.5C20 16.92 16.42 20.5 12 20.5ZM11.78 7.5H11.72C11.32 7.5 11 7.82 11 8.22V12.94C11 13.29 11.18 13.62 11.49 13.8L15.64 16.29C15.98 16.49 16.42 16.39 16.62 16.05C16.83 15.71 16.72 15.26 16.37 15.06L12.5 12.76V8.22C12.5 7.82 12.18 7.5 11.78 7.5Z"
            fill="#FF5858"
          />
        </svg>
      </div>
      <div>{{ timeDifference }}</div>
    </div>
  </div>
  <div class="quiz-wraper">
    <div class="quiz-wraper-header">
      <div class="text-quiz-body">
        <div class="quiz-body-row">
          <div class="form-group-quiz">
            <label>Title</label>
            <input
              type="text"
              v-model="quiz_title"
              placeholder="Enter Quiz Title"
            />
          </div>
          <div class="form-group-quiz">
            <label>Category</label>
            <select v-model="category" disabled>
              <option disabled>Select Category</option>
              <option v-for="item in quizCategory" :value="item.category_name">
                {{ item.category_name }}
              </option>
            </select>
          </div>
        </div>
        <div class="quiz-body-row">
          <div class="form-group-quiz">
            <label>Location</label>
            <select v-model="location" disabled>
              <option>Select Location</option>
              <option v-for="item in quizLocation" :value="item.location_name">
                {{ item.location_name }}
              </option>
            </select>
          </div>
          <div class="form-group-quiz">
            <label>Hardness</label>
            <select v-model="hardness" disabled>
              <option>Select Hardness</option>
              <option
                v-for="item in quizHardness"
                :value="item.difficulty_name"
              >
                {{ item.difficulty_name }}
              </option>
            </select>
          </div>
        </div>
        <div class="quiz-body-row">
          <div class="form-group-quiz">
            <label>Campaign Time</label>
            <select v-model="selectedTime" disabled>
              <option disabled>Select Campaign Time</option>
              <option value="3 Days">3 Days</option>
              <option value="" disabled style="color: #ffce29">
                ─────────────────────────────────────────────
              </option>
              <option value="6 Hours" disabled>6 Hours</option>
              <option value="12 Hours" disabled>12 Hours</option>
              <option value="24 Hours" disabled>24 Hours</option>
              <option value="7 Days" disabled>7 Days</option>
              <option value="30 Days" disabled>30 Days</option>
            </select>
          </div>
          <div class="form-group-quiz">
            <label>Number</label>
            <select v-model="selectedQuestion" disabled>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
        </div>
        <div class="quiz-body-row">
          <div class="form-group-quiz">
            <label>Popup Timing</label>
            <select v-model="selectedPopTime">
              <option disabled>Select Timing</option>

              <option value="30 seconds">30 seconds</option>
              <option value="" disabled style="color: #ffce29">
                ─────────────────────────────────────────────
              </option>
              <option value="15 seconds" disabled>15 seconds</option>
              <option value="1 Minutes" disabled>1 Minutes</option>
              <option value="5 Minutes" disabled>5 Minutes</option>
              <option value="30 Minutes" disabled>30 Minutes</option>
              <option value="1 Hour" disabled>1 Hour</option>
            </select>
          </div>
          <div class="form-group-quiz">
            <label>"Shop Now" Link</label>
            <input type="text" v-model="link" />
          </div>
        </div>
      </div>

      <div class="reward-section">
        <div class="reward-header">Rewards</div>
        <div
          v-for="(reward, index) in selectedQuestion"
          :key="index"
          class="reward-content"
        >
          <div class="reward-section-group">
            <label for="">Reward Scenario</label>
            <div class="reward-text">
              If Correct Answer is - {{ index + 1 }}
            </div>
          </div>
          <div class="reward-section-group">
            <label for="">Reward Message</label>
            <div class="reward-input">
              <input
                type="text"
                name=""
                id=""
                placeholder="Coupon"
                v-model="reward_message[index]"
              />
            </div>
          </div>
          <div class="reward-section-group">
            <label for="">Coupon</label>
            <div class="reward-input">
              <input
                type="text"
                name=""
                id=""
                placeholder="Coupon here"
                v-model="coupon_code[index]"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="quiz-body-row">
        <div class="form-group-quiz">
          <label>Status</label>
          <select v-model="live_status" :disabled="temp_live_status == 3">
            <option value="1">
              {{ temp_live_status == "3" ? "Re-Publish" : "Publish" }}
            </option>
            <option value="2">Pending</option>
            <option value="3">Completed</option>
          </select>
        </div>
        <div class="form-group-quiz"></div>
      </div>
    </div>
    <div class="footer-section">
      <div class="preview-btn" @click="previewCamp">Preview</div>
      <div
        class="cancel-btn"
        @click="this.$router.push({ name: 'quizCampaing' })"
      >
        Cancel
      </div>
      <div
        class="create-btn"
        @click="checkStatus"
        :style="temp_live_status == 3 ? 'display:none' : ''"
      >
        Update
      </div>
    </div>
  </div>
  <Loader v-if="isLoading" />
  <PreviewCampaign
    v-if="isPreview"
    @close="closePreview"
    :imageUrl="previewImageUrl"
  />
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import PreviewCampaign from "../../Shared/PreviewCampaign.vue";
export default {
  mounted() {
    this.itemId = this.$route.params.id;
    this.fetchSuperCategory();
  },
  data() {
    return {
      previewImageUrl: wpApiSettings.imagePath + "/previewCampaign/quiz.jpg",
      isPreview: false,
      isLoading: false,
      baseUrl: this.$base_url,
      quiz_title: "",
      tempStatus: 0,
      temp_live_status: 0,

      isPublish: false,

      coupon_code: [],
      reward_message: [],
      selectedQuestion: 0,
      selectedTime: "",
      selectedPopTime: "",
      live_status: 0,
      time: "",
      hardness: "",
      category: "",
      location: "",
      quizCategory: [],
      quizLocation: [],
      quizHardness: [],
      timeDifference: "00d 00h 00m 00s",
      newTimeDifference: "",
    };
  },
  components: {
    Loader,
    PreviewCampaign,
  },

  methods: {
    previewCamp() {
      this.isPreview = true;
    },
    closePreview() {
      this.isPreview = false;
    },
    fetchSuperCategory() {
      this.isLoading = true;
      axios
        .get(this.baseUrl + "quiz_category")
        .then((response) => {
          this.quizCategory = response.data.data;
          // console.log(this.quizCategory);
          this.fetchSuperLocation();
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchSuperLocation() {
      axios
        .get(this.baseUrl + "quiz_location")
        .then((response) => {
          this.quizLocation = response.data.data;
          //   console.log(this.quizLocation);
          this.fetchSuperHardness();
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchSuperHardness() {
      axios
        .get(this.baseUrl + "quiz_difficulty")
        .then((response) => {
          this.quizHardness = response.data.data;
          //   console.log(this.quizHardness);
          this.fetchSingleQuiz();
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          toast.error("No Data Found", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchSingleQuiz() {
      axios
        .get(wpApiSettings.root + "custom/v1/get-quiz-data/" + this.itemId, {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // console.log(response.data);
          this.category = response.data.quiz_category;
          this.location = response.data.quiz_location;
          this.hardness = response.data.quiz_hardness;

          this.tempStatus = response.data.live_status;
          this.temp_live_status = response.data.live_status;

          this.coupon_code = JSON.parse(response.data.reward);
          this.reward_message = JSON.parse(response.data.reward_message);
          this.selectedQuestion = parseInt(response.data.question_number);
          this.selectedTime = response.data.campaign_time;
          this.selectedPopTime = response.data.popup_time;
          this.quiz_title = response.data.quiz_title;
          this.live_status = response.data.live_status;
          this.time = response.data.time;
          this.link = response.data.link;

          if (this.live_status == 1) {
            this.isLoading = false;
            this.isPublish = true;

            // this.timeDifference = this.calculateTimeDifference();
            setInterval(() => {
              this.timeDifference = this.calculateTimeDifference(
                this.selectedTime
              );
            }, 1000);
          }
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },

    parseCampaignTime(campaignTime) {
      const match = campaignTime.match(/^(\d+)\s+(\w+)$/);
      if (match) {
        const value = parseInt(match[1]);
        const unit = match[2].toLowerCase();
        switch (unit) {
          case "second":
          case "seconds":
            return value * 1000;
          case "minute":
          case "minutes":
            return value * 60 * 1000;
          case "hour":
          case "hours":
            return value * 60 * 60 * 1000;
          case "day":
          case "days":
            return value * 24 * 60 * 60 * 1000;
          default:
            return 0; // unknown unit
        }
      }
      return 0; // invalid format
    },
    calculateTimeDifference(campaign_time) {
      // Convert this.time to a Date object
      const quizTime = new Date(this.time.replace(" ", "T"));

      // Calculate the total quiz time by adding campaign_time
      const quizEndTime =
        quizTime.getTime() + this.parseCampaignTime(campaign_time);

      // Get the current time
      const currentTime = new Date().getTime();

      // Calculate the remaining time in milliseconds
      let remainingTime = quizEndTime - currentTime;

      if (remainingTime <= 0) {
        // Quiz has ended
        return "00d 00h 00m 00s";
      } else {
        // Calculate days, hours, minutes, and seconds
        const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        remainingTime %= 1000 * 60 * 60 * 24;
        const hours = Math.floor(remainingTime / (1000 * 60 * 60));
        remainingTime %= 1000 * 60 * 60;
        const minutes = Math.floor(remainingTime / (1000 * 60));
        remainingTime %= 1000 * 60;
        const seconds = Math.floor(remainingTime / 1000);

        // Format and return the time difference
        return `${this.formatTimeComponent(days)}d ${this.formatTimeComponent(
          hours
        )}h ${this.formatTimeComponent(minutes)}m ${this.formatTimeComponent(
          seconds
        )}s`;
      }
    },

    formatTimeComponent(component) {
      // Helper function to format time components (days, hours, minutes, seconds)
      return component < 10 ? `0${component}` : component;
    },

    checkStatus() {
      this.isLoading = true;
      if (this.live_status == 1) {
        if (this.live_status == this.tempStatus) {
          this.updateSingleQuiz(this.live_status, this.time);
        } else {
          axios
            .get(wpApiSettings.root + "custom/v1/check-live-status", {
              headers: {
                "X-WP-Nonce": wpApiSettings.nonce,
              },
            })
            .then((response) => {
              if (response.data.success == true) {
                this.isLoading = false;
                toast.error("You have already publish another", {
                  position: toast.POSITION.BOTTOM_RIGHT,
                });
              } else {
                let formattedDate = this.getCurrentTime();
                this.updateSingleQuiz(this.live_status, formattedDate);
              }
            })
            .catch((error) => {
              this.isLoading = false;
              this.error = "Error fetching data: " + error.message;
            });
        }
      } else {
        this.updateSingleQuiz(this.live_status, this.time);
      }
    },

    getCurrentTime() {
      var currentDate = new Date();

      var formattedDate = currentDate.toISOString().split("T")[0];
      var formattedTime =
        ("0" + currentDate.getHours()).slice(-2) +
        ":" +
        ("0" + currentDate.getMinutes()).slice(-2) +
        ":" +
        ("0" + currentDate.getSeconds()).slice(-2);

      var currentTime = formattedDate + " " + formattedTime;

      return currentTime;
    },

    updateSingleQuiz(status, time) {
      this.isLoading = true;
      const updateData = {
        quiz_title: this.quiz_title,
        campaign_time: this.selectedTime,
        popup_time: this.selectedPopTime,
        reward: this.coupon_code,
        reward_message: this.reward_message,
        live_status: status,
        time: time,
        link: this.link,
      };

      axios
        .post(
          wpApiSettings.root + "custom/v1/update-quiz-data/" + this.itemId,
          updateData,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.isLoading = false;

          this.$router.push({ name: "quizCampaing" });
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
  },
};
</script>

<style scoped>
.preview-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #706aea;
  border-radius: 8px;
  background-color: transparent;
  cursor: pointer;

  color: var(--status-error, #706aea);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
select:disabled {
  background-color: #e0e0e0;
  color: #9e9fa7;
}
.reward-section-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%;
}
label {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);

  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.page-header {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 32px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
  margin-bottom: 32px;
}
.reward-section {
  display: flex;
  flex-direction: column;
}

.question-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.question-section {
  margin-top: 32px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.quiz-wraper {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 32px;
}

.campaign-time {
  display: flex;
  gap: 8px;
  width: 100%;
  max-width: max-content;
}

.quiz-wraper-header {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.cancel-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #f55151;
  border-radius: 8px;
  background-color: transparent;
  cursor: pointer;

  color: var(--status-error, #f55151);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}

.create-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
  background-color: #706aea;
  cursor: pointer;

  color: var(--color-natural-50, #fff);

  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
.footer-section {
  display: flex;
  gap: 8px;
  justify-content: end;
}

.quiz-body-row {
  display: flex;
  max-width: 99.5%;
  gap: 16px;
}

.form-group-quiz {
  flex: 1; /* Add this to allow flex items to take up available space */
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group-quiz label {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.text-quiz-body {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.form-group-quiz input {
  border: 1px solid #e3e3e3;
  padding: 12px 16px;
  border-radius: 8px;

  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.form-group-quiz select {
  padding: 12px 16px !important;
  width: 100%;
  max-width: inherit;
  border-radius: 8px;
  border: 1px solid #e3e3e3;
  color: var(--color-text-colors-200-white-low-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.form-group-quiz select:hover {
  text-decoration: none;
}

.reward-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.reward-content {
  margin-top: 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
}

input {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

select {
  color: var(--color-text-colors-900-black-high-emp, #181a17) !important;
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.reward-section-group .reward-input input {
  padding: 12px 16px;
  border-radius: 12px;
  border: 1px solid #e3e3e3;
  width: 100%;
}

.reward-text {
  width: 100%;
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Link/Link 2 | Active | Medium 500 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
  background-color: #ffffff;
  padding: 12px 16px;
  border-radius: 12px;
  border: 1px solid #e3e3e3;
}

.quiz-main-header {
  display: flex;
  justify-content: space-between;
  color: #ff5858;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%;
}
/* dev ayan */

.page-header .left-content {
  display: flex;
  gap: 16px;
  align-items: center;
}

.page-header .right-content {
  display: flex;
  align-items: center;
  gap: 8px;
}
</style>
