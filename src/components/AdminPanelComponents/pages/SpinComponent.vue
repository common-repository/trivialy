<template>
  <div class="myCampaing-wrap">
    <div class="campaign-header">
      <div class="super-main-header">
        <div class="drag-main-header">
          <div class="main-header-text">My Spin List</div>
          <router-link :to="{ name: 'createSpin' }" class="header-button">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"
                fill="white"
              />
            </svg>
            <div class="btn-text">Create New</div>
          </router-link>
        </div>
      </div>
      <div class="myCampaing-header">
        <div class="myCampaing-left-corner">
          <div
            class="myCampaing-left-text"
            @click="showAll"
            :style="{
              color: isActive === 'all' ? '#706aea' : '',
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
              color: isActive === 'publish' ? '#706aea' : '',
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
              color: isActive === 'complete' ? '#706aea' : '',
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
            <tr>
              <th style="width: 2%"></th>
              <th>Sl</th>
              <th>Title</th>
              <th>Quadrant</th>
              <th>Campaign type</th>
              <th>Created</th>
              <th>Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in currentRows" :key="index">
              <td>
                <input
                  type="checkbox"
                  v-model="item.isSelected"
                  @change="handleCheckboxChange(item.id)"
                />
              </td>
              <td>
                {{
                  currentPage === 1 && index + 1 < 10
                    ? "0" + (rowPerPage * (currentPage - 1) + index + 1)
                    : rowPerPage * (currentPage - 1) + index + 1
                }}
              </td>
              <td>{{ item.title }}</td>
              <td>
                {{
                  item.select_quadrant == 1 ? "Five Quadrant" : "Seven Quadrant"
                }}
              </td>
              <td>Spin n Win</td>

              <td>{{ timeFormatechange(item.time) }}</td>
              <td>
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
              <td class="action-btn">
                <router-link
                  :to="{ name: 'edit_spin', params: { id: item.id } }"
                >
                  <div class="edit-btn">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                    >
                      <path
                        d="M3 17.4605V20.5005C3 20.7805 3.22 21.0005 3.5 21.0005H6.54C6.67 21.0005 6.8 20.9505 6.89 20.8505L17.81 9.94055L14.06 6.19055L3.15 17.1005C3.05 17.2005 3 17.3205 3 17.4605ZM20.71 7.04055C21.1 6.65055 21.1 6.02055 20.71 5.63055L18.37 3.29055C17.98 2.90055 17.35 2.90055 16.96 3.29055L15.13 5.12055L18.88 8.87055L20.71 7.04055Z"
                        fill="#8789F2"
                      />
                    </svg>
                  </div>
                </router-link>
                <div class="delete-btn" @click="openModel(item.id)">
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
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="campaign-footer">
      <pagination
        :nextPage="nextPage"
        :previousPage="previousPage"
        :pageSelect="pageSelect"
        :totalRows="spinData.length"
        :rowPerPage="rowPerPage"
        :currentPage="currentPage"
        :totalPage="totalPage"
      />
      <div class="myCampaing-footer">
        <select name="" id="" v-model="bulkActionSelect">
          <option>Bulk Action</option>
          <option value="1" style="color: red">Delete</option>
        </select>
        <div class="footer-btn" @click="groupDelete(bulkActionSelect)">
          Apply
        </div>
      </div>
    </div>
  </div>
  <DeletePop
    v-show="isModalVisible"
    @close="closeModal"
    @confirm="deleteSpin(temp_delete_id)"
  />
  <Loader v-if="isLoading" />
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Loader from "../Shared/AdminLoaderComponent.vue";
import DeletePop from "../Shared/DeletePopUp.vue";
import pagination from "../Shared/PaginationMenuComponent.vue";
export default {
  created() {
    this.fetchUserData();
    this.fetchAllSpinData();
    if (this.$route.query.showPendingToast) {
      const showPendingToast = this.$route.query.showPendingToast;
      if (showPendingToast == true) {
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
      createdLimit: false,
      bulkActionSelect: "Bulk Action",
      selectedIds: [],
      isLoading: false,
      isModalVisible: false,
      temp_delete_id: "",
      spinData: [],
      rowPerPage: 5,
      currentPage: 1,
      totalPage: 0,
      allCampaign: 0,
      publishCount: 0,
      pendingCount: 0,
      completeCount: 0,
      spinMainData: [],
      isActive: "all",
      select_last_date: 0,
      wp_email: "",
      totalSpin: 0,
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
      return this.spinData.slice(this.startIndex, this.endIndex);
    },

    selectedItems() {
      return this.currentRows.filter((item) =>
        this.selectedIds.includes(item.id)
      );
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

          this.isLoading = false;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },

    groupDelete(selectedItem) {
      if (selectedItem == 1) {
        const data = {
          ids: this.selectedIds,
        };
        this.isLoading = true;
        axios
          .post(
            wpApiSettings.root + "custom/v1/delete-bulk-spin-quiz-data",
            data,
            {
              headers: {
                "X-WP-Nonce": wpApiSettings.nonce,
              },
            }
          )
          .then((response) => {
            this.isLoading = false;
            toast.error("Delete Successfully", {
              position: toast.POSITION.BOTTOM_RIGHT,
            });
            this.fetchAllSpinData();
          })
          .catch((error) => {
            // Handle error

            this.error = "Error fetching data: " + error.message;
          });
      }
    },
    handleCheckboxChange(itemId) {
      if (this.selectedIds.includes(itemId)) {
        // Item was unchecked, remove it from the array
        this.selectedIds = this.selectedIds.filter((id) => id !== itemId);
      } else {
        // Item was checked, add it to the array
        this.selectedIds.push(itemId);
      }
    },
    fetchAllSpinData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/get-all-spin-quiz-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.spinData = response.data;
          this.spinMainData = response.data;
          this.totalPage = Math.ceil(response.data.length / this.rowPerPage);
          this.countData(this.spinData);
          this.totalSpin = response.data.length;
          this.isLoading = false;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

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
        // console.log(this.currentPage);
      }
    },
    pageSelect(item) {
      this.currentPage = item;
    },

    nextPage() {
      if (this.endIndex < this.spinData.length) {
        this.currentPage += 1;
        // console.log(this.currentPage);
      }
    },

    openModel(id) {
      this.temp_delete_id = id;
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    deleteSpin(id) {
      this.isModalVisible = false;
      this.isLoading = true;
      axios
        .delete(wpApiSettings.root + "custom/v1/delete-spin-quiz-data/" + id, {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((res) => {
          // console.log("Successfully Deleted");

          this.fetchAllSpinData();
          this.isLoading = false;
          toast.error("Delete Successfully", {
            position: toast.POSITION.BOTTOM_RIGHT,
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
    timeFormatechange(time) {
      const date = new Date(time);
      const options = { day: "numeric", month: "long", year: "numeric" };

      return date.toLocaleDateString("en-US", options);
    },

    showAll() {
      this.isActive = "all";
      this.isLoading = true;
      this.spinData = this.spinMainData;
      this.isLoading = false;
    },

    showPublish() {
      this.isActive = "publish";
      this.isLoading = true;

      const liveStatusOneItems = this.spinMainData.filter(
        (item) => item.live_status == 1
      );

      this.totalPage = Math.ceil(liveStatusOneItems.length / this.rowPerPage);

      this.spinData = liveStatusOneItems;
      this.isLoading = false;
      // console.log(this.dragData);
    },

    showPending() {
      this.isActive = "pending";
      this.isLoading = true;

      const liveStatusOneItems = this.spinMainData.filter(
        (item) => item.live_status == 2
      );

      this.totalPage = Math.ceil(liveStatusOneItems.length / this.rowPerPage);

      this.spinData = liveStatusOneItems;
      this.isLoading = false;
      // console.log(this.dragData);
    },

    showComplete() {
      this.isActive = "complete";
      this.isLoading = true;

      const liveStatusOneItems = this.spinMainData.filter(
        (item) => item.live_status == 3
      );

      this.totalPage = Math.ceil(liveStatusOneItems.length / this.rowPerPage);

      this.spinData = liveStatusOneItems;
      this.isLoading = false;
      // console.log(this.dragData);
    },

    fetchLast7Days() {
      const currentDate = new Date();

      // Filter the array to include only items with a time within the last 7 days
      const last7DaysData = this.spinMainData.filter((item) => {
        // Assuming that the 'time' property is a timestamp (you may need to adjust accordingly)
        const itemDate = new Date(item.time);

        // Calculate the difference in milliseconds
        const timeDifference = currentDate - itemDate;

        // Check if the time difference is within 7 days (7 days * 24 hours * 60 minutes * 60 seconds * 1000 milliseconds)
        return timeDifference <= 7 * 24 * 60 * 60 * 1000;
      });

      this.spinData = last7DaysData;

      this.totalPage = Math.ceil(last7DaysData.length / this.rowPerPage);
    },

    fetchLast30Days() {
      const currentDate = new Date();

      // Filter the array to include only items with a time within the last 7 days
      const last30DaysData = this.spinMainData.filter((item) => {
        // Assuming that the 'time' property is a timestamp (you may need to adjust accordingly)
        const itemDate = new Date(item.time);

        // Calculate the difference in milliseconds
        const timeDifference = currentDate - itemDate;

        // Check if the time difference is within 7 days (7 days * 24 hours * 60 minutes * 60 seconds * 1000 milliseconds)
        return timeDifference <= 30 * 24 * 60 * 60 * 1000;
      });

      this.spinData = last30DaysData;

      this.totalPage = Math.ceil(last30DaysData.length / this.rowPerPage);
    },
  },
};
</script>

<style scoped>
.search-input {
  width: 300px !important;
}
.fixed-table {
  height: 370px;
}
.edit-btn,
.delete-btn {
  cursor: pointer;
}
.drag-main-header {
  display: flex;
  align-items: center;
  gap: 16px;
}

.header-button {
  display: flex;
  gap: 4;
  background-color: #706aea;
  color: #ffffff;
  align-items: center;
  padding: 8px 12px;
  border-radius: 6px;
  cursor: pointer;
}
.btn-text {
  color: var(--color-natural-50, #fff);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}

a {
  text-decoration: none !important;
}
.main-header-text {
  color: var(--color-text-colors-900-black-high-emp, #181a17);

  /* Text/H1-H6/H6 |  Subtitle | Bold 700 */
  font-family: Inter;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
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
  justify-content: space-between;
  gap: 24px;
  height: 100%;
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
.myCampaing-right-corner input {
  padding: 0px 24px;
  width: 169px;
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
  align-items: center;
  justify-content: center;
  gap: 8px;
}

/* dev ayan */
.campaign-header {
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.campaign-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-direction: row-reverse;
}
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
  margin: auto 0;
  max-width: max-content;
}

.class-live {
  background-color: #eff1fe;
  color: #706aea;
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

/*  */
</style>
