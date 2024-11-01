<template>
  <div class="dash-wrap">
    <div class="dash-header">
      <div class="card">
        <img src="/src/assets/dash-content/1.svg" alt="" />
        <div class="card-content">
          <div class="card-text-one">Total Campaigns</div>
          <div class="card-text-two">{{ totalCampaign }}</div>
        </div>
      </div>
      <div class="card">
        <img src="/src/assets/dash-content/2.svg" alt="" />
        <div class="card-content">
          <div class="card-text-one">Number Of Quiz</div>
          <div class="card-text-two">{{ totalQuiz }}</div>
        </div>
      </div>
      <div class="card">
        <img src="/src/assets/dash-content/3.svg" alt="" />
        <div class="card-content">
          <div class="card-text-one">Total Participants</div>
          <div class="card-text-two">{{ totalUser }}</div>
        </div>
      </div>
    </div>
    <div class="dash-body-content">
      <div class="dash-body">
        <div class="dash-table">
          <Chart />
        </div>
        <div class="dash-tab">
          <div class="dash-tab-content">
            <a href="https://trivialy.co/documentation" target="_blank">
              <div class="tab-content">
                <div class="tab-header">
                  <div class="l-content">
                    <img src="/src/assets/dash-content/4.svg" alt="" />
                    <div class="tab-header-text">View Documentation</div>
                  </div>
                  <img src="/src/assets/dash-content/arrow.svg" alt="" />
                </div>
                <div class="tab-body">
                  <div class="tab-body-text">
                    Dive into our documentation to discover everything you need
                    for a seamless experience
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="dash-tab-content">
            <a
              href="https://netrosupport.raiseaticket.com/support/#/newticket"
              target="_blank"
            >
              <div class="tab-content">
                <div class="tab-header">
                  <div class="l-content">
                    <img src="/src/assets/dash-content/5.svg" alt="" />
                    <div class="tab-header-text">Help Center</div>
                  </div>
                  <img src="/src/assets/dash-content/arrow.svg" alt="" />
                </div>
                <div class="tab-body">
                  <div class="tab-body-text">
                    Stuck With something? Get help from live chat or submit
                    support ticket.
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="dash-tab-content">
            <a href="https://trivialy.co/contact" target="_blank">
              <div class="tab-content">
                <div class="tab-header">
                  <div class="l-content">
                    <img src="/src/assets/dash-content/6.svg" alt="" />
                    <div class="tab-header-text">Share Your Feedback</div>
                  </div>
                  <img src="/src/assets/dash-content/arrow.svg" alt="" />
                </div>
              </div>
              <div class="tab-body">
                <div class="tab-body-text">
                  We value your opinion and are eager to hear about your
                  experience with our Trivialy! Your feedback helps us enhance
                  the app and create a better quizzing environment for everyone.
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="dash-body">
        <div class="dash-table">
          <div class="dash-table-header">
            <div class="table-header-text">Quizzes</div>
            <div class="table-action">
              <select class="table-action-select" name="" id="">
                <option value="">This Month</option>
              </select>
              <button
                class="view-all-btn"
                @click="this.$router.push({ name: 'quizCampaing' })"
              >
                <span class="all-btn-text">View All</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="12"
                  height="13"
                  viewBox="0 0 12 13"
                  fill="none"
                >
                  <path
                    d="M4.5 8.795L6.79 6.5L4.5 4.205L5.205 3.5L8.205 6.5L5.205 9.5L4.5 8.795Z"
                    fill="#6A5AE0"
                  />
                </svg>
              </button>
            </div>
          </div>
          <div class="dash-table-content">
            <table>
              <thead>
                <tr>
                  <th>Quiz Name</th>
                  <th>Categories</th>
                  <th>Last Modifies</th>
                  <th>Status</th>
                  <!-- <th class="text-center">Actions</th> -->
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in quizData" :key="index">
                  <!-- quiz name -->
                  <td>{{ item?.quiz_title }}</td>
                  <!-- categories -->
                  <td>{{ item?.quiz_type }}</td>
                  <!-- last modifies -->
                  <td>{{ item?.time }}</td>
                  <!-- status -->
                  <td
                    :style="{
                      color:
                        item.live_status == 1
                          ? '#33d286'
                          : item.live_status == 2
                          ? '#FFBC3A'
                          : item.live_status == 3
                          ? '#706AEA'
                          : 'inherit',
                    }"
                  >
                    {{
                      item.live_status == 1
                        ? "Publish"
                        : item.live_status == 2
                        ? "Pending"
                        : item.live_status == 3
                        ? "Completed"
                        : ""
                    }}
                  </td>
                  <!-- actions -->
                  <!-- <td class="action-btns">
                    <button class="view-content-btn">View Quiz</button>
                  </td> -->
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="dash-tab">
          <div class="upgrade-premium">
            <div class="upgrade-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="70"
                height="70"
                viewBox="0 0 70 70"
                fill="none"
              >
                <path
                  d="M69.9958 36.2785C69.7595 51.9386 59.6551 65.1555 45.7478 69.7294C45.3846 69.85 45.0083 69.5775 45.0083 69.1844V39.5257C45.0083 39.2086 45.2621 38.9495 45.5728 38.9495H55.4978C55.966 38.9495 56.2286 38.4046 55.9442 38.0249L35.8272 11.2338C35.604 10.9346 35.1664 10.9346 34.9388 11.2294L14.0911 38.3153C13.8022 38.6905 14.0648 39.2443 14.5331 39.2443H25.202C25.5127 39.2443 25.7665 39.5034 25.7665 39.8205V69.4256C25.7665 69.8098 25.4033 70.0867 25.0401 69.975C10.5595 65.5977 0 51.9207 0 35.7246C0 16.1874 15.3645 0.317288 34.4312 0.00462055C54.1149 -0.31698 70.2978 16.1918 69.9958 36.2785Z"
                  fill="url(#paint0_linear_446_220)"
                />
                <defs>
                  <linearGradient
                    id="paint0_linear_446_220"
                    x1="35"
                    y1="0"
                    x2="35"
                    y2="70"
                    gradientUnits="userSpaceOnUse"
                  >
                    <stop stop-color="white" stop-opacity="0.74" />
                    <stop offset="1" stop-color="white" stop-opacity="0.5" />
                  </linearGradient>
                </defs>
              </svg>
            </div>
            <div class="upgrade-header">Upgrade to Premium</div>
            <div class="upgrade-content">
              Get started by spending some time with the documentation to get
              familiar with Essential Addons.
            </div>
            <a :href="trivialy_upgrade" target="_blank">
              <div class="upgrade-btn">
                <div class="btn-text">Upgrade</div>
                <div class="tap-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="25"
                    viewBox="0 0 24 25"
                    fill="none"
                  >
                    <path
                      d="M8.55031 10.24V6.5C8.55031 5.12 9.67031 4 11.0503 4C12.4303 4 13.5503 5.12 13.5503 6.5V10.24C14.7603 9.43 15.5503 8.06 15.5503 6.5C15.5503 4.01 13.5403 2 11.0503 2C8.56031 2 6.55031 4.01 6.55031 6.5C6.55031 8.06 7.34031 9.43 8.55031 10.24ZM14.0503 12.71C13.7703 12.57 13.4703 12.5 13.1603 12.5H12.5503V6.5C12.5503 5.67 11.8803 5 11.0503 5C10.2203 5 9.55031 5.67 9.55031 6.5V17.24L6.11031 16.52C5.74031 16.44 5.35031 16.56 5.08031 16.83C4.65031 17.27 4.65031 17.97 5.08031 18.41L9.09031 22.42C9.47031 22.79 9.98031 23 10.5103 23H16.6103C17.6103 23 18.4503 22.27 18.5903 21.28L19.2203 16.81C19.3403 15.96 18.9003 15.12 18.1303 14.74L14.0503 12.71Z"
                      fill="white"
                    />
                  </svg>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Loader v-if="isLoading" />
</template>

<script>
import axios from "axios";
import { base_url, trivialy_upgrade_url } from "../../../config";
import Loader from "../Shared/AdminLoaderComponent.vue";
import Chart from "../Shared/ChartComponent.vue";
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      isLoading: false,
      totalCampaign: 0,
      totalQuiz: 0,
      totalUser: 0,
      trivialy_upgrade: trivialy_upgrade_url,
    };
  },
  components: {
    Loader,
    Chart,
  },
  methods: {
    fetchData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/dashboard-info", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.totalCampaign = response.data.total_campaign;
          this.fetchQuizCount();
          this.fetchUserCount();
          this.fetchQuiz();
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchQuizCount() {
      axios
        .get(base_url + "total_quiz")
        .then((response) => {
          this.totalQuiz = response.data.totalQuiz;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchUserCount() {
      axios
        .get(base_url + "total_user")
        .then((response) => {
          this.totalUser = response.data.totalUser;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    fetchQuiz() {
      axios
        .get(wpApiSettings.root + "custom/v1/all-quizzes-list", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.quizData = this.sortData(response.data);
          this.isLoading = false;
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },

    sortData(data) {
      data.sort(function (value1, value2) {
        // Sort in descending order by subtracting b from a
        return value2 - value1;
      });

      // Return the sorted data
      return data.slice(0, 5);
    },
  },
};
</script>

<style scoped>
a:focus {
  box-shadow: none;
}

.dash-wrap {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.action-btn {
  display: flex;
  justify-content: center;
}

.all-btn-text {
  color: var(--color-primary-color-600, #6a5ae0);
  font-family: "Inter";
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 125%; /* 12.5px */
  letter-spacing: 0.2px;
}

.view-single-quiz {
  display: flex;
  width: max-content;
  align-items: center;
  text-align: center;
  padding: 6px 12px;
  border-radius: 4px;
  border: 1px solid #cad1fb;
  cursor: pointer;
}

.table-action-select {
  padding-right: 0; /* Adjust as needed */
  width: 120px;
  height: 40px;
  background-color: #eff1fe;
  color: #5e6064;
  border: none;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  gap: 8.075px;
  padding: 7px 8px 7px 12px;
  border-radius: 4px;
  color: #5e6064;
  font-family: Inter;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 13px */
  letter-spacing: 0.2px;
  outline: none;
}

.table-action-select:focus,
.table-action-select:active,
.table-action-select:focus-visible {
  outline: none;
}
.dash-header {
  display: flex;
  gap: 16px;
}

.view-all-btn {
  display: flex;
  justify-content: center;
  gap: 8px;
  align-items: center;
  width: 120px;
  height: 40px;
  align-items: center;
  padding: 7px 8px 7px 12px;
  border-radius: 40px;
  border: 0.897px solid #cad1fb;
  cursor: pointer;
  background-color: transparent;
  text-align: center;
  font-size: 14px !important;
}
.table-action {
  display: flex;
  gap: 16px;
}

.dash-body-content {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
/* .dash-table-content {
} */

.dash-table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.table-header-text {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);

  /* Text/Body/Body 3 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 22.4px */
}

.btn-text {
  color: var(--color-natural-50, #fff);
  text-align: center;
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 500;
  line-height: normal;
}

.upgrade-btn {
  margin-top: 40px;
  display: flex;
  gap: 4px;
  padding: 8px 12px 8px 16px;
  border-radius: 40px;
  background: linear-gradient(261deg, #a59df5 5.88%, #6c5ce1 68.52%);
  box-shadow: 0px 1px 0px 0px #5b4dbe;
  align-items: center;
  cursor: pointer;
}

.upgrade-content {
  margin-top: 16px;
  color: var(
    --color-text-colors-50-white-high-emp,
    var(--color-natural-50, #fff)
  );
  text-align: center;
  /* Text/Badge/Badge | Light | Regular 400 */
  font-family: "Inter";
  font-size: 11px;
  font-style: normal;
  font-weight: 400;
  line-height: 125%; /* 12.5px */
  letter-spacing: 0.2px;
}

.upgrade-header {
  color: var(
    --color-text-colors-50-white-high-emp,
    var(--color-natural-50, #fff)
  );
  text-align: center;
  /* Text/Body/Body 3 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 22.4px */
}

.tab-body {
  margin-top: 8px;
  margin-left: 35px;
}

.upgrade-premium {
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 16px;
  background: radial-gradient(
      54.24% 58.01% at 4.48% 70.65%,
      rgba(160, 188, 255, 0.2) 0%,
      rgba(106, 90, 224, 0.2) 100%
    ),
    linear-gradient(180deg, #a59df5 0%, #6c5ce1 100%);
  padding: 24px;
  height: 100%;
}
.tab-body-text {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Badge/Badge | Light | Regular 400 */
  font-family: "Inter";
  font-size: 11px;
  font-style: normal;
  font-weight: 400;
  line-height: 125%; /* 12.5px */
}

.l-content {
  display: flex;
  gap: 12px;
  align-items: center;
}
.dash-tab {
  display: flex;
  flex-direction: column;
  gap: 12px;
  flex: 1;
}

.dash-body {
  display: flex;
  gap: 24px;
  height: 100%;
}
.tab-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
}

.tab-header-text {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter";
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}

.dash-table {
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 16px;
  background-color: #ffffff;
  width: 100%;
  border-radius: 12px;
  flex: 2;
}

.card {
  display: flex;
  gap: 12px;
  margin: 0;
  border: none;
  border-radius: 12px;
  padding: 24px;
  width: 100%;
}

.card-content {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.card-text-one {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Navigation/Navigation | Rest | Regular 400 */
  font-family: "Inter";
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 125%; /* 17.5px */
}

.card-text-two {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter";
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}

.dash-tab-content {
  cursor: pointer;
  margin-left: -4px;
  border-radius: 8px;
  padding: 12px;
  background-color: #ffffff;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  padding: 8px 12px;
  text-align: left;
  border-bottom: 1px solid #ddd; /* Border color for the bottom of each cell */
}

td {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Caption/Caption 1 | Light | Regular 400 */
  font-family: "Inter";
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 15.6px */
}

th {
  background-color: #eff1fe; /* color for header */
  border-bottom: 1px solid #cad1fb;
  color: #2f2f2f; /* Text color for header */

  overflow: hidden;
  text-overflow: ellipsis;
  /* Text/Caption/Caption 1 | Bold | Semibold 600 */
  font-family: Inter;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 15.6px *
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
td {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Caption/Caption 1 | Light | Regular 400 */
  font-family: Inter;
  font-size: 12px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 15.6px */
}

/* dev: ayan */
.view-content-btn {
  display: flex;
  padding: 6px 12px;
  justify-content: center;
  align-items: center;
  gap: 10px;
  border-radius: 4px;
  border: 1px solid #cad1fb;
  background-color: transparent !important;

  /* text */
  overflow: hidden;
  text-overflow: ellipsis;
  color: #5e6064;
  text-align: center;
  font-family: Inter;
  font-size: 10px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 13px */
}

.action-btns {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* utils */
.text-center {
  text-align: center;
}
</style>
