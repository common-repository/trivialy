<template>
  <Loader v-if="isLoading" />
  <div class="main-header">
    <div class="myCampaing-wrap">
      <div class="super-main-header">
        <div class="main-header-text">My Quiz List</div>
      </div>
      <div class="myCampaing-wrap_top">
        <div class="myCampaing-header">
          <div class="myCampaing-left-corner">
            <div
              class="myCampaing-left-text"
              @click="showAll"
              :style="{
                color: isActive === 'all' ? '#706AEA' : '',
                fontWeight: isActive === 'all' ? '400' : '',
              }"
            >
              All Campaing ({{ allCampaign }})
            </div>
            <div>|</div>
            <div
              class="filter-tab-text"
              @click="showPublish"
              :style="{
                color: isActive === 'publish' ? '#706AEA' : '',
                fontWeight: isActive === 'publish' ? '400' : '',
              }"
            >
              Live ({{ publishCount }})
            </div>
            <div>|</div>

            <div
              class="filter-tab-text"
              @click="showComplete"
              :style="{
                color: isActive === 'complete' ? '#706AEA' : '',
                fontWeight: isActive === 'complete' ? '400' : '',
              }"
            >
              Complete ({{ completeCount }})
            </div>
          </div>
          <div class="myCampaing-right-corner">
            <select name="" id="" v-model="select_last_date">
              <option value="0">Select Date</option>
              <option value="1">Last 7 Days</option>
              <option value="2">Last 30 Days</option>
            </select>
          </div>
        </div>
        <div class="myCampaing-body fixed-table">
          <table>
            <thead>
              <!-- #919191 -->
              <tr>
                <th style="width: 2%">
                  <input
                    type="checkbox"
                    :style="{
                      background: 'transparent',
                      border: '2px solid white ',
                    }"
                  />
                </th>

                <th>Quiz Name</th>
                <th>Participants</th>
                <th class="text-center">Campaign type</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in currentRows" :key="index">
                <!-- checkbox -->
                <td>
                  <input
                    type="checkbox"
                    :checked="isSelected(item.id, item.quiz_type)"
                    :style="{
                      background: 'transparent',
                      border: '2px solid #919191 ',
                    }"
                    @change="toggleSelection(item)"
                  />
                </td>
                <!-- quiz name -->
                <td>{{ item.quiz_title }}</td>
                <!-- Participants -->
                <td>{{ item.question_number }}</td>
                <td class="text-center">
                  {{
                    item.quiz_type == "custom_quiz"
                      ? "Custom"
                      : item.quiz_type == "text_quiz"
                      ? "Text"
                      : item.quiz_type == "image_quiz"
                      ? "Image"
                      : ""
                  }}
                </td>
                <td class="text-center">
                  <div
                    :class="
                      item.live_status == 1
                        ? 'class-status class-live'
                        : item.live_status == 2
                        ? 'class-status class-pending'
                        : item.live_status == 3
                        ? 'class-status class-completed'
                        : 'inherit'
                    "
                  >
                    {{
                      item.live_status == 1
                        ? "Live"
                        : item.live_status == 2
                        ? "Pending"
                        : item.live_status == 3
                        ? "Completed"
                        : ""
                    }}
                  </div>
                </td>
                <td>
                  <div class="action-btn">
                    <!-- edit links -->

                    <router-link
                      :to="{ name: 'editQuiz', params: { id: item.id } }"
                    >
                      <div class="edit_btn">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="25"
                          height="24"
                          viewBox="0 0 25 24"
                          fill="none"
                        >
                          <path
                            d="M3.33594 17.4615V20.5015C3.33594 20.7815 3.55594 21.0015 3.83594 21.0015H6.87594C7.00594 21.0015 7.13594 20.9515 7.22594 20.8515L18.1459 9.94152L14.3959 6.19152L3.48594 17.1015C3.38594 17.2015 3.33594 17.3215 3.33594 17.4615ZM21.0459 7.04152C21.4359 6.65152 21.4359 6.02152 21.0459 5.63152L18.7059 3.29152C18.3159 2.90152 17.6859 2.90152 17.2959 3.29152L15.4659 5.12152L19.2159 8.87152L21.0459 7.04152Z"
                            fill="#8789F2"
                          />
                        </svg>
                      </div>
                    </router-link>

                    <!-- delete  btn -->
                    <div
                      class="delete_btn"
                      @click="openModel(item.id, item.quiz_type)"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="25"
                        height="24"
                        viewBox="0 0 25 24"
                        fill="none"
                      >
                        <path
                          d="M6.33594 19C6.33594 20.1 7.23594 21 8.33594 21H16.3359C17.4359 21 18.3359 20.1 18.3359 19V9C18.3359 7.9 17.4359 7 16.3359 7H8.33594C7.23594 7 6.33594 7.9 6.33594 9V19ZM18.3359 4H15.8359L15.1259 3.29C14.9459 3.11 14.6859 3 14.4259 3H10.2459C9.98594 3 9.72594 3.11 9.54594 3.29L8.83594 4H6.33594C5.78594 4 5.33594 4.45 5.33594 5C5.33594 5.55 5.78594 6 6.33594 6H18.3359C18.8859 6 19.3359 5.55 19.3359 5C19.3359 4.45 18.8859 4 18.3359 4Z"
                          fill="#F55151"
                        />
                      </svg>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="campaign-footer">
      <pagination
        :nextPage="nextPage"
        :previousPage="previousPage"
        :pageSelect="pageSelect"
        :totalRows="quizList.length"
        :rowPerPage="rowPerPage"
        :currentPage="currentPage"
        :totalPage="totalPage"
      />
      <div class="myCampaing-footer">
        <select v-model="bulkActionSelect">
          <option>Bulk Action</option>
          <option value="1" style="color: red">Delete</option>
        </select>
        <div class="footer-btn" @click="groupDelete(bulkActionSelect)">
          Apply
        </div>
        <!-- <div v-if="isTrue">Hello, This is Test</div> -->
      </div>
    </div>
  </div>

  <DeletePop
    v-show="isModalVisible"
    @close="closeModal"
    @confirm="deleteQuiz(temp_delete_id, temp_delete_type)"
  />
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Loader from "../Shared/AdminLoaderComponent.vue";
import DeletePop from "../Shared/DeletePopUp.vue";
import pagination from "../Shared/PaginationMenuComponent.vue";
export default {
  mounted() {
    // this.fetchCustomQuizData();
    this.fetchUserData();
    this.fetchQuizData();

    if (this.$route.query.showPendingToast) {
      const showPendingToast = this.$route.query.showPendingToast;

      // console.log(showPendingToast);
      // Check if showToast is true
      if (showPendingToast == "true") {
        // Show the toast message
        // console.log("Hi");
        // this.isTrue = true;
        toast.warning(
          "😵‍💫 You already have a campaign running.This campaign marked as “Pending”",
          {
            position: toast.POSITION.BOTTOM_RIGHT,
          }
        );
      }
    }
  },
  data() {
    return {
      quizList: {},
      isLoading: false,
      temp_delete_id: 0,
      temp_delete_type: "",
      isModalVisible: false,
      rowPerPage: 7,
      currentPage: 1,
      totalPage: 0,
      selectedItems: [],
      bulkActionSelect: "Bulk Action",
      allCampaign: 0,
      publishCount: 0,
      pendingCount: 0,
      completeCount: 0,
      spinMainData: [],
      isActive: "all",
      select_last_date: 0,
      wp_email: "",
      createdLimit: false,
      totalQuiz: 0,
      // isTrue: false,
    };
  },
  computed: {
    startIndex() {
      return (this.currentPage - 1) * this.rowPerPage;
    },

    endIndex() {
      return this.currentPage * this.rowPerPage;
    },

    currentRows() {
      if (this.quizList.length > 0) {
        return this.quizList.slice(this.startIndex, this.endIndex);
      } else {
        return [];
      }
    },
  },
  components: {
    pagination,
    Loader,
    DeletePop,
  },
  watch: {
    select_last_date(newValue) {
      if (newValue == 1) {
        this.fetchLast7Days();
      } else if (newValue == 2) {
        this.fetchLast30Days();
      }
    },
  },
  methods: {
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
          this.wp_email = response.data.user_email;
          this.checkSubscriptionForCount(this.wp_email);
          this.isLoading = false;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },

    openModel(id, type) {
      this.temp_delete_id = id;
      this.temp_delete_type = type;
      this.isModalVisible = true;
    },
    groupDelete(item) {
      this.isLoading = true;
      if (item == 1) {
        const data = {
          ids: this.selectedItems,
        };

        axios
          .post(
            wpApiSettings.root + "custom/v1/bulk-delete-quizzes-list",
            data,
            {
              headers: {
                "X-WP-Nonce": wpApiSettings.nonce,
              },
            }
          )
          .then((response) => {
            this.fetchQuizData();
            toast.error("Delete Successfully", {
              position: toast.POSITION.BOTTOM_RIGHT,
            });
            this.isLoading = false;
          })
          .catch((error) => {
            // Handle error

            this.error = "Error fetching data: " + error.message;
          });
      }
    },
    closeModal() {
      this.isModalVisible = false;
    },
    isSelected(itemId, quizType) {
      return this.selectedItems.some(
        (selectedItem) =>
          selectedItem.id === itemId && selectedItem.quiz_type === quizType
      );
    },

    // Toggle the selection of an item
    toggleSelection(item) {
      const { id, quiz_type } = item;

      // Check if the item is already selected
      const selectedIndex = this.selectedItems.findIndex(
        (selectedItem) =>
          selectedItem.id === id && selectedItem.quiz_type === quiz_type
      );

      // If selected, remove it; otherwise, add it
      if (selectedIndex !== -1) {
        this.selectedItems.splice(selectedIndex, 1);
      } else {
        this.selectedItems.push({ id, quiz_type });
      }
      // console.log(this.selectedItems);
    },
    fetchQuizData() {
      axios
        .get(wpApiSettings.root + "custom/v1/all-quizzes-list", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          this.quizList = response.data;
          // console.log(this.quizList);

          this.quizMainData = response.data;
          this.totalQuiz = response.data.length;
          this.countData(this.quizList);

          this.totalPage = Math.ceil(response.data.length / this.rowPerPage);
          this.isLoading = false;
          // console.log(this.customQuiz);
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },

    countData(data) {
      this.allCampaign = data.length;

      this.publishCount = data.reduce((count, item) => {
        // Check if live_status is equal to 1
        if (item.live_status == 1) {
          return count + 1; // Increment count for each matching item
        }
        return count;
      }, 0);

      this.pendingCount = data.reduce((count, item) => {
        // Check if live_status is equal to 1
        if (item.live_status == 2) {
          return count + 1; // Increment count for each matching item
        }
        return count;
      }, 0);

      this.completeCount = data.reduce((count, item) => {
        // Check if live_status is equal to 1
        if (item.live_status == 3) {
          return count + 1; // Increment count for each matching item
        }
        return count;
      }, 0);
    },

    previousPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
      }
    },
    pageSelect(item) {
      this.currentPage = item;
    },

    nextPage() {
      if (this.endIndex < this.quizList.length) {
        this.currentPage += 1;
      }
    },

    showAll() {
      this.isActive = "all";
      this.isLoading = true;
      this.quizList = this.quizMainData;
      this.isLoading = false;
    },

    deleteQuiz(id, type) {
      this.isModalVisible = false;
      this.isLoading = true;
      var data = {
        quiz_type: type,
      };
      axios
        .post(
          wpApiSettings.root + "custom/v1/delete-quizzes-list/" + id,
          data,
          {
            headers: {
              "X-WP-Nonce": wpApiSettings.nonce,
            },
          }
        )
        .then((res) => {
          // console.log("Successfully Deleted");

          this.fetchQuizData();
          this.isLoading = false;
          toast.error("Delete Successfully", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },

    showPublish() {
      this.isActive = "publish";
      this.isLoading = true;

      const liveStatusOneItems = this.quizMainData.filter(
        (item) => item.live_status == 1
      );

      this.totalPage = Math.ceil(liveStatusOneItems.length / this.rowPerPage);

      this.quizList = liveStatusOneItems;
      this.isLoading = false;
      // console.log(this.dragData);
    },

    showPending() {
      this.isActive = "pending";
      this.isLoading = true;

      const liveStatusOneItems = this.quizMainData.filter(
        (item) => item.live_status == 2
      );

      this.totalPage = Math.ceil(liveStatusOneItems.length / this.rowPerPage);

      this.quizList = liveStatusOneItems;
      this.isLoading = false;
      // console.log(this.dragData);
    },

    showComplete() {
      this.isActive = "complete";
      this.isLoading = true;

      const liveStatusOneItems = this.quizMainData.filter(
        (item) => item.live_status == 3
      );

      this.totalPage = Math.ceil(liveStatusOneItems.length / this.rowPerPage);

      this.quizList = liveStatusOneItems;
      this.isLoading = false;
      // console.log(this.dragData);
    },

    fetchLast7Days() {
      const currentDate = new Date();

      // Filter the array to include only items with a time within the last 7 days
      const last7DaysData = this.quizMainData.filter((item) => {
        // Assuming that the 'time' property is a timestamp (you may need to adjust accordingly)
        const itemDate = new Date(item.time);

        // Calculate the difference in milliseconds
        const timeDifference = currentDate - itemDate;

        // Check if the time difference is within 7 days (7 days * 24 hours * 60 minutes * 60 seconds * 1000 milliseconds)
        return timeDifference <= 7 * 24 * 60 * 60 * 1000;
      });

      this.quizList = last7DaysData;

      this.totalPage = Math.ceil(last7DaysData.length / this.rowPerPage);
    },

    fetchLast30Days() {
      const currentDate = new Date();

      // Filter the array to include only items with a time within the last 7 days
      const last30DaysData = this.quizMainData.filter((item) => {
        // Assuming that the 'time' property is a timestamp (you may need to adjust accordingly)
        const itemDate = new Date(item.time);

        // Calculate the difference in milliseconds
        const timeDifference = currentDate - itemDate;

        // Check if the time difference is within 7 days (7 days * 24 hours * 60 minutes * 60 seconds * 1000 milliseconds)
        return timeDifference <= 30 * 24 * 60 * 60 * 1000;
      });

      this.quizList = last30DaysData;

      this.totalPage = Math.ceil(last30DaysData.length / this.rowPerPage);
    },
  },
};
</script>

<style scoped>
.page-header {
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}
.fixed-table {
  height: 100%;
}
.edit_btn {
  cursor: pointer;
}

.edit_btn a:focus {
  box-shadow: none;
}
.delete_btn {
  cursor: pointer;
}
.myCampaing-footer {
  display: flex;
  gap: 14px;
}
.myCampaing-footer select {
  width: 164px;
  border: 1px solid #ddd;
  border-radius: 8px;
}

.footer-btn {
  padding: 12px 16px;
  background-color: #181a17;
  border-radius: 8px;
  cursor: pointer;

  color: var(--color-natural-50, #fff);

  text-align: center;
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
.myCampaing-wrap {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.myCampaing-wrap_top {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.myCampaing-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.myCampaing-left-corner {
  display: flex;
  gap: 16px;
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
  cursor: pointer;
}
.filter-tab-text {
  cursor: pointer;
}

.myCampaing-right-corner {
  display: flex;
  gap: 12px;
  align-items: center;
}

.myCampaing-right-corner select {
  padding: 0px 24px;
  width: 169px;
  height: 48px;
  border-radius: 8px;
  border: 1px solid #ddd;
  display: flex;
  align-items: center;
}
.myCampaing-right-corner input {
  padding: 0px 24px;
  width: 300px;
  height: 48px;
  border-radius: 8px;
  border: 1px solid #ddd;
  display: flex;
  align-items: center;
}
table {
  border-collapse: collapse;
  width: 100%;
}

.main-header-text {
  color: var(--color-text-colors-900-black-high-emp, #181a17);

  /* Text/H1-H6/H6 |  Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}

.main-header {
  display: flex;
  flex-direction: column;
  gap: 24px;
  justify-content: space-between;
  height: 100%;
}

.super-main-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.header-separator {
  color: rgb(255, 88, 88);
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: bold;
  font-weight: 600;
  line-height: 140%;
  margin-right: 12px;
}

th,
td {
  padding: 16px 12px;
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

.action-btn {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
}

/* dev ayan */
.campaign-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: row-reverse;
}

/* utils */
.text-center {
  text-align: center;
}
.class-status {
  display: flex;
  padding: 6px 8px 6px 12px;
  justify-content: center;
  align-items: center;
  gap: 4px;
  border-radius: 4px;
  font-family: "Inter";
  font-size: 12px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 15.6px */
  border-radius: 4px;
  background: #fffbe8;
  margin: auto 0;
  max-width: max-content;
}
.class-live {
  background-color: var(--Color-Primary-Color-100, #eff1fe);
  color: var(--Color-Primary-Color-500, #706aea);
  text-overflow: ellipsis;
}
.class-completed {
  background: #fffbe8;
  color: var(--Status-Alert, #ffbc3a);
  text-overflow: ellipsis;
}
.class-pending {
  background: #fffbe8;
  color: #f55151;
}

.border {
  border: 1px solid black;
}
</style>
