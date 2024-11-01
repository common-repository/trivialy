<template>
  <Loader v-if="isLoading" />
  <div v-else class="text-quiz-body">
    <div class="quiz-body-row">
      <div class="form-group-quiz">
        <label>Title</label>
        <input
          type="text"
          v-model="add.quiz_title"
          placeholder="Enter Quiz Title"
        />
      </div>
      <div class="form-group-quiz">
        <label>Category</label>
        <select v-model="add.category">
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
        <select v-model="add.location">
          <option>Select Location</option>
          <option v-for="item in quizLocation" :value="item.location_name">
            {{ item.location_name }}
          </option>
        </select>
      </div>
      <div class="form-group-quiz">
        <label>Hardness</label>
        <select v-model="add.hardness">
          <option disabled>Select Hardness</option>
          <!-- First two options -->
          <option
            v-for="(item, index) in quizHardness.slice(0, 1)"
            :key="item.difficulty_name"
            :value="item.difficulty_name"
            :disabled="
              item.difficulty_name === 'Standard' ||
              item.difficulty_name === 'Hard'
            "
          >
            {{ item.difficulty_name }}
          </option>

          <option value="" disabled style="color: #ffce29">
            ─────────────────────────────────────────────
          </option>

          <!-- Remaining options -->
          <option
            v-for="item in quizHardness.slice(1, 3)"
            :key="item.difficulty_name"
            :value="item.difficulty_name"
            :disabled="
              item.difficulty_name === 'Standard' ||
              item.difficulty_name === 'Hard'
            "
          >
            {{ item.difficulty_name }}
          </option>
        </select>
      </div>
    </div>
    <div class="quiz-body-row">
      <div class="form-group-quiz">
        <label>Time</label>
        <select v-model="add.campaign_time">
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
        <select v-model="selectedQuestion">
          <option :value="3">3 Questions</option>
          <option :value="4">4 Questions</option>
          <option :value="5">5 Questions</option>
          <option :value="6">6 Questions</option>
          <option :value="7">7 Questions</option>
          <option :value="8">8 Questions</option>
        </select>
      </div>
    </div>
    <div class="quiz-body-row">
      <div class="form-group-quiz">
        <label>Popup Timing</label>
        <select v-model="add.popup_time">
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
        <input
          type="text"
          v-model="add.link"
          placeholder="https://trivialy.co"
        />
      </div>
    </div>
  </div>
  <div class="reward-section">
    <div class="reward-header">Rewards</div>
    <div
      v-for="index in parseInt(showQuestions)"
      :key="index"
      class="reward-content"
    >
      <div class="reward-section-group">
        <label>Reward Scenario</label>
        <div class="reward-text">If Correct Answer is - {{ index }}</div>
      </div>

      <div class="reward-section-group">
        <label for="">Reward Message</label>
        <div class="reward-input">
          <input
            type="text"
            placeholder="Type reward related message here"
            v-model="add.reward_message[index - 1]"
          />
        </div>
      </div>
      <div class="reward-section-group">
        <label for="">Coupon</label>
        <div class="reward-input">
          <input
            type="text"
            placeholder="Coupon here"
            v-model="add.reward[index - 1]"
          />
        </div>
      </div>
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
    <div class="create-btn" @click="checkStatus()">Create Campaign</div>
  </div>
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
import { base_url } from "../../../../config";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import PreviewCampaign from "../../Shared/PreviewCampaign.vue";
export default {
  mounted() {
    this.fetchUserData();
    this.fetchSuperCategory();
    this.fetchSuperLocation();
    this.fetchSuperHardness();
  },
  data() {
    return {
      previewImageUrl: wpApiSettings.imagePath + "/previewCampaign/quiz.jpg",
      isPreview: false,
      baseUrl: this.$base_url,
      isLoading: false,
      selectedQuestion: 3,
      showQuestions: 3,
      quizCategory: [],
      quizLocation: [],
      quizHardness: [],
      add: {
        category: "Select Category",
        location: "Select Location",
        hardness: "Select Hardness",
        popup_time: "Select Timing",
        campaign_time: "Select Campaign Time",
        quiz_title: "",
        reward_message: [],
        reward: [],
        link: "",
        wp_email: "",
        quizCount: 0,
      },
      status: 1,
      quizCountTotal: 0,
      wp_email: "",
      wp_name: "",
    };
  },
  components: {
    Loader,
    PreviewCampaign,
  },
  watch: {
    selectedQuestion(newValue) {
      this.showQuestions = newValue;
      //   console.log(newValue);
    },
  },
  methods: {
    previewCamp() {
      this.isPreview = true;
    },
    closePreview() {
      this.isPreview = false;
    },
    fetchUserData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/user-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.wp_email = response.data.user_email;
          this.wp_name = response.data.user_name;
          // console.log(response.data);
          this.fetchAllQuizData();
          this.isLoading = false;
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchAllQuizData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/all-quizzes-list", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.quizCountTotal = response.data.length;
          // console.log(this.quizCountTotal);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },

    fetchSuperCategory() {
      this.isLoading = true;
      axios
        .get(this.baseUrl + "quiz_category")
        .then((response) => {
          this.quizCategory = response.data.data;
          // console.log(this.quizCategory);
          this.isLoading = false;
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchSuperLocation() {
      this.isLoading = true;
      axios
        .get(this.baseUrl + "quiz_location")
        .then((response) => {
          this.quizLocation = response.data.data;
          //   console.log(this.quizLocation);
          this.isLoading = false;
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchSuperHardness() {
      this.isLoading = true;
      axios
        .get(this.baseUrl + "quiz_difficulty")
        .then((response) => {
          this.quizHardness = response.data.data;
          //   console.log(this.quizHardness);
          this.isLoading = false;
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

    checkStatus() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/check-live-status", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // console.log(response.data);
          if (response.data.success == true) {
            this.status = 2;
            this.createCampaign(this.status);
          } else {
            this.createCampaign(this.status);
          }
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
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
    createCampaign(status) {
      var currentDate = this.getCurrentTime();
      if (
        this.add.quiz_title == "" ||
        this.add.campaign_time == "" ||
        this.add.popup_time == "" ||
        this.add.category == "" ||
        this.add.hardness == "" ||
        this.add.reward == "" ||
        this.add.reward_message == "" ||
        this.add.link == ""
      ) {
        this.isLoading = false;
        toast.error("Please Fill All Section", {
          position: toast.POSITION.BOTTOM_RIGHT,
        });
      } else {
        const quizData = {
          quiz_title: this.add.quiz_title,
          campaign_time: this.add.campaign_time,
          popup_time: this.add.popup_time,
          quiz_location: this.add.location,
          quiz_category: this.add.category,
          quiz_hardness: this.add.hardness,
          reward: this.add.reward,
          reward_message: this.add.reward_message,
          question_number: this.selectedQuestion,
          live_status: status,
          time: currentDate,
          link: this.add.link,
          quiz_type: "text_quiz",
        };

        const superAdminData = {
          quiz_title: this.add.quiz_title,
          user: this.wp_name,
          email: this.wp_email,
          quiz_type: "text_quiz",
          status: status,
        };

        axios
          .post(wpApiSettings.root + "custom/v1/save-quiz-data", quizData, {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          })
          .then((response) => {
            axios
              .post(base_url + "quiz_hsitory", superAdminData)
              .then((response) => {
                this.isLoading = false;
                if (status == 2) {
                  this.$router.push({
                    name: "quizCampaing",
                    query: { showPendingToast: true },
                  });
                } else {
                  this.$router.push({ name: "quizCampaing" });
                }
              });
          })
          .catch((error) => {
            this.isLoading = false;
            toast.error("Please Fill All Section", {
              position: toast.POSITION.BOTTOM_RIGHT,
            });
            this.error = "Error fetching data: " + error.message;
          });
      }
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
  width: max-content;
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
  margin-top: 24px;
  display: flex;
  gap: 8px;
  justify-content: end;
}
.text-quiz-body {
  margin-top: 32px;
}

.quiz-body-row {
  display: flex;
  max-width: 100%;
  gap: 40px;
  margin-top: 16px;
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

.form-group-quiz select {
  width: 100%;
  padding: 12px 16px; /* Optional: Add padding for better appearance */
  max-width: inherit;
  border-radius: 8px;
  border: 1px solid #e3e3e3;
}

.form-group-quiz input {
  width: 100%;
  padding: 12px 16px; /* Optional: Add padding for better appearance */
  max-width: inherit;
  border-radius: 8px;
  border: 1px solid #e3e3e3;
}
.form-group-quiz select:hover {
  text-decoration: none;
}

.reward-section {
  margin-top: 32px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.reward-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}

.reward-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
}

.reward-section-group .reward-input input {
  padding: 12px 16px;
  border-radius: 12px;
  border: 1px solid #e3e3e3;
  width: 100%;
}

.reward-text {
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
</style>
