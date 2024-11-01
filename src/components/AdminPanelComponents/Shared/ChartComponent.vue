<template>
  <div class="chart-label">User Engagement</div>
  <canvas ref="barChart" style="height: 200px"></canvas>
</template>

<script>
import axios from "axios";
import Chart from "chart.js/auto";
import { base_url } from "../../../config.js";
export default {
  mounted() {
    this.fetchUser();
  },
  data() {
    return {
      legend: "",
      currentMonthUserCount: [], // Sample data
      lastMonthUserCount: [], // Sample data
      allUser: [],
    };
  },
  methods: {
    fetchUser() {
      axios
        .get(base_url + "total_user")
        .then((response) => {
          this.allUser = response.data.data;
          this.calculateData(this.allUser);
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    calculateData(allUser) {
      // Function to get the month from timestamp
      const getMonthFromTimestamp = (timestamp) => {
        const date = new Date(parseInt(timestamp));
        return date.getMonth() + 1; // JavaScript months are zero-based
      };

      // Get current month and last month
      const currentDate = new Date();
      const currentMonth = currentDate.getMonth() + 1; // Adding 1 to match JavaScript's month indexing
      const currentYear = currentDate.getFullYear();

      let lastMonth = currentMonth - 1;
      let lastYear = currentYear;

      // If current month is January, last month would be December of previous year
      if (lastMonth === 0) {
        lastMonth = 12;
        lastYear = currentYear - 1;
      }

      // Initialize arrays for current and last month user counts
      let currentMonthUserCount = new Array(12).fill(0);
      let lastMonthUserCount = new Array(12).fill(0);

      // Iterate through all users to count registrations in current and last month
      allUser.forEach((user) => {
        const userMonth = getMonthFromTimestamp(user.timestamp);
        const userYear = new Date(parseInt(user.timestamp)).getFullYear();

        if (userMonth === currentMonth && userYear === currentYear) {
          currentMonthUserCount[currentMonth - 1]++; // Subtracting 1 to match JavaScript's month indexing
        } else if (userMonth === lastMonth && userYear === lastYear) {
          lastMonthUserCount[lastMonth - 1]++; // Subtracting 1 to match JavaScript's month indexing
        }
      });

      this.currentMonthUserCount = currentMonthUserCount;
      this.lastMonthUserCount = lastMonthUserCount;
      this.createBarChart();

      //   console.log("Current Month User Count:", currentMonthUserCount);
      //   console.log("Last Month User Count:", lastMonthUserCount);
    },
    createBarChart() {
      const ctx = this.$refs.barChart.getContext("2d");
      const data = {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ],
        datasets: [
          {
            label: "This Month",
            data: this.currentMonthUserCount, // Add your data points for This Month
            backgroundColor: "#A9B2F8",
            borderColor: "#A9B2F8",
            borderWidth: 1,
          },
          {
            label: "Last Month",
            data: this.lastMonthUserCount, // Add your data points for Last Month
            backgroundColor: "#FBE191",
            borderColor: "#FBE191",
            borderWidth: 1,
          },
        ],
      };
      const options = {
        plugins: {
          legend: {
            display: true,
            labels: {
              usePointStyle: true,
              pointStyle: "circle",
              useBorderRadius: true,
              borderRadius: 50,
            },
          },
        },
      };
      const chart = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options,
      });
    },
  },
};
</script>

<style>
.chart-label {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 3 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 600;
  line-height: 140%; /* 22.4px */
}
</style>
