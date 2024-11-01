<template>
  <div class="quizLeader-wrap">
    <table>
      <thead>
        <tr>
          <th>Ranking</th>
          <th>Name</th>

          <th class="text-center">Quiz type</th>
          <th class="text-center">Spent Time (s)</th>
          <th class="text-center">Right Answer</th>
          <th class="text-center">Won Award</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in currentRows" :key="index">
          <td>
            {{
              currentPage === 1 && index + 1 < 10
                ? "0" + (rowPerPage * (currentPage - 1) + index + 1)
                : rowPerPage * (currentPage - 1) + index + 1
            }}
          </td>
          <td>{{ item.user_name }}</td>

          <td class="text-center">{{ item.quiz_type }}</td>
          <td class="text-center">
            {{ calculate_time(item.spent_time) }}
          </td>
          <td class="text-center">{{ item.right_ans }}</td>
          <td class="text-center">{{ winPercentage(item.won_reward) }}%</td>
        </tr>
      </tbody>
    </table>
  </div>
  <Pagination
    :nextPage="nextPage"
    :previousPage="previousPage"
    :pageSelect="pageSelect"
    :totalRows="quizLeaderboard.length"
    :rowPerPage="rowPerPage"
    :currentPage="currentPage"
    :totalPage="totalPage"
  />
  <Loader v-if="isLoading" />
</template>

<script>
import axios from "axios";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import Pagination from "../../Shared/PaginationMenuComponent.vue";
export default {
  mounted() {
    this.fetchLeaderboard();
  },
  data() {
    return {
      quizLeaderboard: [],
      isLoading: false,
      rowPerPage: 5,
      currentPage: 1,
      totalPage: 0,
    };
  },
  components: {
    Pagination,
    Loader,
  },
  computed: {
    startIndex() {
      return (this.currentPage - 1) * this.rowPerPage;
    },

    endIndex() {
      return this.currentPage * this.rowPerPage;
    },

    currentRows() {
      return this.quizLeaderboard.slice(this.startIndex, this.endIndex);
    },
  },
  methods: {
    fetchLeaderboard() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/get-all-quiz-leaderboard-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.quizLeaderboard = response.data;
          this.totalPage = Math.ceil(response.data.length / this.rowPerPage);

          // console.log(this.dragLeaderboard);
          this.isLoading = false;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },

    winPercentage(percentage) {
      return parseFloat(percentage).toFixed(3);
    },

    calculate_time(time) {
      const minutes = Math.floor(time / 60);
      const seconds = time % 60;

      // Format the time as MM:SS
      const formattedTime =
        (minutes < 10 ? "0" : "") +
        minutes +
        ":" +
        (seconds < 10 ? "0" : "") +
        seconds;

      return formattedTime;
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
      if (this.endIndex < this.quizLeaderboard.length) {
        this.currentPage += 1;
        // console.log(this.currentPage);
      }
    },
  },
};
</script>

<style scoped>
table {
  border-collapse: collapse;
  width: 100%;
}

th {
  text-overflow: ellipsis;
  /* Text/Button/Button 3 | Small | Semibold 600 */
  font-family: Inter;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 125%; /* 17.5px */
  letter-spacing: 0.14px;
}

td {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  text-align: center;

  font-family: Inter;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 18.2px */
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
  gap: 8px;
}

.quizLeader-wrap {
  margin-top: 40px;
  margin-bottom: 24px;
  height: 300px;
}

/* utils */

.text-center {
  text-align: center;
}
</style>
