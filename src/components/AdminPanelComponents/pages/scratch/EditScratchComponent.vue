<template>
  <div class="spin-wrap">
    <!-- page header -->
    <div class="page-main-header">
      <div class="page-header">
        <svg
          @click="this.$router.push({ name: 'scratch' })"
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="25"
          viewBox="0 0 24 25"
          fill="none"
          class="cursor-pointer"
        >
          <path
            d="M18.7912 11.5051H7.62124L12.5012 6.6251C12.8912 6.2351 12.8912 5.5951 12.5012 5.2051C12.1112 4.8151 11.4812 4.8151 11.0912 5.2051L4.50124 11.7951C4.11124 12.1851 4.11124 12.8151 4.50124 13.2051L11.0912 19.7951C11.4812 20.1851 12.1112 20.1851 12.5012 19.7951C12.8912 19.4051 12.8912 18.7751 12.5012 18.3851L7.62124 13.5051H18.7912C19.3412 13.5051 19.7912 13.0551 19.7912 12.5051C19.7912 11.9551 19.3412 11.5051 18.7912 11.5051Z"
            fill="black"
          />
        </svg>

        Scratch n Win
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

    <div class="grid-container">
      <!-- title -->
      <div class="from-group">
        <div class="input-section-header">Title</div>
        <input
          type="text"
          class="link-input"
          placeholder="Enter Title"
          v-model="title"
        />
      </div>

      <div class="from-group">
        <div class="input-section-header">Number</div>
        <select name="" id="" v-model="selectNumber">
          <option value="4">4</option>
          <option value="" disabled style="color: #ffce29">
            ─────────────────────────────────────────────
          </option>
          <option value="6" disabled>6</option>
          <option value="8" disabled>8</option>
          <option value="10" disabled>10</option>
        </select>
      </div>
      <div class="from-group">
        <div class="input-section-header">Campaign Time</div>
        <select v-model="scratchData.campaign_time" disabled>
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

      <div class="from-group">
        <div class="input-section-header">Popup Timing</div>
        <select v-model="scratchData.popup_time">
          <option disabled>Select Popup Timing</option>
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
    </div>
    <div class="grid-container">
      <div class="from-group">
        <div class="input-section-header">"Shop Now" Link</div>
        <input
          type="text"
          class="link-input"
          v-model="scratchData.link"
          placeholder="Enter Url"
        />
      </div>
    </div>
    <div class="form-in-line">
      <div class="from-group"></div>
    </div>

    <div class="input-section-header">Reward</div>
    <div class="reward-input-section" v-if="selectNumber >= 4">
      <div class="input-group">
        <div class="quadrant-no">1</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_one"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_one"
          />
        </div>
      </div>
      <div class="input-group">
        <div class="quadrant-no">2</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_two"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_two"
          />
        </div>
      </div>
    </div>
    <div class="reward-input-section" v-if="selectNumber >= 4">
      <div class="input-group">
        <div class="quadrant-no">3</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_three"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_three"
          />
        </div>
      </div>
      <div class="input-group">
        <div class="quadrant-no">4</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_four"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_four"
          />
        </div>
      </div>
    </div>
    <div class="reward-input-section" v-if="selectNumber >= 6">
      <div class="input-group">
        <div class="quadrant-no">5</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_five"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_five"
          />
        </div>
      </div>
      <div class="input-group">
        <div class="quadrant-no">6</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_six"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_six"
          />
        </div>
      </div>
    </div>
    <div class="reward-input-section" v-if="selectNumber >= 8">
      <div class="input-group">
        <div class="quadrant-no">7</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_seven"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_seven"
          />
        </div>
      </div>
      <div class="input-group">
        <div class="quadrant-no">8</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_eight"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_eight"
          />
        </div>
      </div>
    </div>
    <div class="reward-input-section" v-if="selectNumber >= 10">
      <div class="input-group">
        <div class="quadrant-no">9</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_nine"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_nine"
          />
        </div>
      </div>
      <div class="input-group">
        <div class="quadrant-no">10</div>
        <div class="quadrant-input">
          <input
            type="text"
            placeholder="Reward Title"
            class="custom-reward"
            v-model="scratchData.reward.reward_ten"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="scratchData.coupon.coupon_ten"
          />
        </div>
      </div>
    </div>
    <div class="form-in-line">
      <div class="from-group">
        <div v-if="scratchData.status" class="input-section-header">Status</div>
        <select
          v-if="scratchData.status"
          v-model="scratchData.status"
          :disabled="temp_live_status == 3"
        >
          <option value="1">
            {{ temp_live_status == "3" ? "Re-Publish" : "Publish" }}
          </option>
          <option value="2">Pending</option>
          <option value="3">Completed</option>
        </select>
      </div>
      <div class="from-group"></div>
    </div>

    <div class="footer-section">
      <div class="preview-btn" @click="previewCamp">Preview</div>
      <div class="cancel-btn" @click="this.$router.push({ name: 'scratch' })">
        Cancel
      </div>
      <div
        class="create-btn"
        @click="checkEditStatus"
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
import { base_url } from "../../../../config.js";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import PreviewCampaign from "../../Shared/PreviewCampaign.vue";
export default {
  mounted() {
    this.itemId = this.$route.params.id;
    this.fetchSingleScratch();
    this.fetchUserData();
  },
  data() {
    return {
      previewImageUrl: wpApiSettings.imagePath + "/previewCampaign/scratch.png",
      isPreview: false,
      isLoading: false,
      selectNumber: 4,
      userData: [],
      title: "",
      status: 1,
      itemId: "",
      isPublish: false,
      scratchData: {
        id: "",
        reward: {
          reward_one: "",
          reward_two: "",
          reward_three: "",
          reward_four: "",
          reward_five: "",
          reward_six: "",
          reward_seven: "",
          reward_eight: "",
          reward_nine: "",
          reward_ten: "",
        },
        coupon: {
          coupon_one: "",
          coupon_two: "",
          coupon_three: "",
          coupon_four: "",
          coupon_five: "",
          coupon_six: "",
          coupon_seven: "",
          coupon_eight: "",
          coupon_nine: "",
          coupon_ten: "",
        },
        popup_time: "Select Popup Timing",
        campaign_time: "Select Campaign Time",
        status: "",
        link: "",
      },
      time: "",
      tempStatus: 0,
      temp_live_status: 0,
      timeDifference: "00d 00h 00m 00s",
    };
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
          // Handle successful response
          this.userData = response.data;
          this.isLoading = false;
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },

    fetchSingleScratch() {
      this.isLoading = true;
      axios
        .get(
          wpApiSettings.root + "custom/v1/get-scratch-quiz-data/" + this.itemId,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          this.tempStatus = response.data.live_status;
          this.temp_live_status = response.data.live_status;
          this.time = response.data.time;
          this.selectNumber = response.data.select_number;
          this.scratchData.id = response.data.id;
          this.scratchData.status = response.data.live_status;
          this.scratchData.popup_time = response.data.popup_time;
          this.scratchData.campaign_time = response.data.campaign_time;
          this.scratchData.link = response.data.link;
          this.title = response.data.title;

          this.scratchData.reward.reward_one = response.data.reward_one;
          this.scratchData.reward.reward_two = response.data.reward_two;
          this.scratchData.reward.reward_three = response.data.reward_three;
          this.scratchData.reward.reward_four = response.data.reward_four;
          this.scratchData.reward.reward_five = response.data.reward_five;
          this.scratchData.reward.reward_six = response.data.reward_six;
          this.scratchData.reward.reward_seven = response.data.reward_seven;
          this.scratchData.reward.reward_eight = response.data.reward_eight;
          this.scratchData.reward.reward_nine = response.data.reward_nine;
          this.scratchData.reward.reward_ten = response.data.reward_ten;

          this.scratchData.coupon.coupon_one = response.data.coupon_one;
          this.scratchData.coupon.coupon_two = response.data.coupon_two;
          this.scratchData.coupon.coupon_three = response.data.coupon_three;
          this.scratchData.coupon.coupon_four = response.data.coupon_four;
          this.scratchData.coupon.coupon_five = response.data.coupon_five;
          this.scratchData.coupon.coupon_six = response.data.coupon_six;
          this.scratchData.coupon.coupon_seven = response.data.coupon_seven;
          this.scratchData.coupon.coupon_eight = response.data.coupon_eight;
          this.scratchData.coupon.coupon_nine = response.data.coupon_nine;
          this.scratchData.coupon.coupon_ten = response.data.coupon_ten;

          if (this.scratchData.status == 1) {
            this.isLoading = false;
            this.isPublish = true;
            setInterval(() => {
              this.timeDifference = this.calculateTimeDifference(
                this.scratchData.campaign_time
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

    checkEditStatus() {
      this.isLoading = true;
      if (this.scratchData.status == 1) {
        if (this.scratchData.status == this.tempStatus) {
          this.updateScratch(this.scratchData.status, this.time);
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
                this.updateScratch(this.scratchData.status, formattedDate);
              }
            })
            .catch((error) => {
              this.isLoading = false;
              this.error = "Error fetching data: " + error.message;
            });
        }
      } else {
        this.updateScratch(this.scratchData.status, this.time);
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

      // console.log(quizEndTime);

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

    updateScratch(status, time) {
      this.isLoading = true;

      if (this.selectNumber == 4) {
        if (
          this.scratchData.reward.reward_one == "" ||
          this.scratchData.reward.reward_two == "" ||
          this.scratchData.reward.reward_three == "" ||
          this.scratchData.reward.reward_four == "" ||
          this.scratchData.coupon.coupon_one == "" ||
          this.scratchData.coupon.coupon_two == "" ||
          this.scratchData.coupon.coupon_three == "" ||
          this.scratchData.coupon.coupon_four == ""
        ) {
          toast.error("Please Fill All Reward Section", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
          this.isLoading = false;
        } else {
          this.updateWithValidation(status, time);
        }
      } else if (this.selectNumber == 6) {
        if (
          this.scratchData.reward.reward_one == "" ||
          this.scratchData.reward.reward_two == "" ||
          this.scratchData.reward.reward_three == "" ||
          this.scratchData.reward.reward_four == "" ||
          this.scratchData.reward.reward_five == "" ||
          this.scratchData.reward.reward_six == "" ||
          this.scratchData.coupon.coupon_one == "" ||
          this.scratchData.coupon.coupon_two == "" ||
          this.scratchData.coupon.coupon_three == "" ||
          this.scratchData.coupon.coupon_four == "" ||
          this.scratchData.coupon.coupon_five == "" ||
          this.scratchData.coupon.coupon_six == ""
        ) {
          toast.error("Please Fill All Reward Section", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
          this.isLoading = false;
        } else {
          this.updateWithValidation(status, time);
        }
      } else if (this.selectNumber == 8) {
        if (
          this.scratchData.reward.reward_one == "" ||
          this.scratchData.reward.reward_two == "" ||
          this.scratchData.reward.reward_three == "" ||
          this.scratchData.reward.reward_four == "" ||
          this.scratchData.reward.reward_five == "" ||
          this.scratchData.reward.reward_six == "" ||
          this.scratchData.reward.reward_seven == "" ||
          this.scratchData.reward.reward_eight == "" ||
          this.scratchData.coupon.coupon_one == "" ||
          this.scratchData.coupon.coupon_two == "" ||
          this.scratchData.coupon.coupon_three == "" ||
          this.scratchData.coupon.coupon_four == "" ||
          this.scratchData.coupon.coupon_five == "" ||
          this.scratchData.coupon.coupon_six == "" ||
          this.scratchData.coupon.coupon_seven == "" ||
          this.scratchData.coupon.coupon_eight == ""
        ) {
          toast.error("Please Fill All Reward Section", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
          this.isLoading = false;
        } else {
          this.updateWithValidation(status, time);
        }
      } else if (this.selectNumber == 10) {
        if (
          this.scratchData.reward.reward_one == "" ||
          this.scratchData.reward.reward_two == "" ||
          this.scratchData.reward.reward_three == "" ||
          this.scratchData.reward.reward_four == "" ||
          this.scratchData.reward.reward_five == "" ||
          this.scratchData.reward.reward_six == "" ||
          this.scratchData.reward.reward_seven == "" ||
          this.scratchData.reward.reward_eight == "" ||
          this.scratchData.reward.reward_nine == "" ||
          this.scratchData.reward.reward_ten == "" ||
          this.scratchData.coupon.coupon_one == "" ||
          this.scratchData.coupon.coupon_two == "" ||
          this.scratchData.coupon.coupon_three == "" ||
          this.scratchData.coupon.coupon_four == "" ||
          this.scratchData.coupon.coupon_five == "" ||
          this.scratchData.coupon.coupon_six == "" ||
          this.scratchData.coupon.coupon_seven == "" ||
          this.scratchData.coupon.coupon_eight == "" ||
          this.scratchData.coupon.coupon_nine == "" ||
          this.scratchData.coupon.coupon_ten == ""
        ) {
          toast.error("Please Fill All Reward Section", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
          this.isLoading = false;
        } else {
          this.updateWithValidation(status, time);
        }
      }
    },

    updateWithValidation(status, time) {
      const superAdminData = {
        coupon_number: this.selectNumber,
      };
      this.isLoading = true;
      const scratchData = {
        id: this.scratchData.id,
        select_number: this.selectNumber,
        reward: this.scratchData.reward,
        coupon: this.scratchData.coupon,
        popup_time: this.scratchData.popup_time,
        campaign_time: this.scratchData.campaign_time,
        live_status: status,
        time: time,
        link: this.scratchData.link,
        title: this.title,
      };

      // console.log(time);
      axios
        .post(
          wpApiSettings.root +
            "custom/v1/update-scratch-quiz-data/" +
            this.scratchData.id,
          scratchData,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((response) => {
          axios
            .post(
              base_url + "update_scratch/" + this.userData.user_email,
              superAdminData
            )
            .then((response) => {
              this.isLoading = false;
              this.$router.push({ name: "scratch" });
            })
            .catch((error) => {
              this.isLoading = false;
              this.error = "Error fetching data: " + error.message;
            });
          //   this.isLoading = false;
          // location.reload();
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
  },
  components: {
    Loader,
    PreviewCampaign,
  },
  watch: {},
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
.page-main-header {
  display: flex;
  justify-content: space-between;
  color: #ff5858;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%;
}
.page-header {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
  margin-bottom: 24px;
}
.campaign-time {
  display: flex;
  gap: 8px;
  width: 100%;
  max-width: max-content;
}
.from-group select {
  max-width: 96%;
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
  padding: 12px 16px;

  color: var(--color-text-colors-900-black-high-emp, #181a17);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%;
}
.form-in-line {
  display: flex;
  gap: 36px;
  width: 100%;
}
.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Two columns with equal width */
  gap: 16px;
}
.from-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%;
}
.quadrant-input {
  display: flex;
  gap: 8px;
}
.custom-reward {
  width: 30% !important;
}
.input-section-input select {
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
  width: 18.5% !important;
  padding: 12px 16px;

  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.input-section {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.input-section-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);

  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.quadrant-no {
  height: 56px;
  width: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #a0a0a0;
  padding: 16px 32px;
  border-radius: 12px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
}
.input-group {
  display: flex;
  gap: 16px;
  flex: 1;
}

.input-group input {
  width: 70%;
  border: 1px solid #e3e3e3;
  border-radius: 12px;
  padding: 0px 24px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Link/Link 2 | Active | Medium 500 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}
.reward-input-section {
  display: flex;
  gap: 16px;
}
.spin-header {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}

.spin-wrap {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.footer-section {
  display: flex;
  justify-content: end;
  gap: 8px;
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

.link-input {
  max-width: 96%;
  border-radius: 8px;
  border: 1px solid var(--color-neutral-colors-200, #e3e3e3);
  padding: 12px 16px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%;
}

/* utils */

.cursor-pointer {
  cursor: pointer;
}
</style>
