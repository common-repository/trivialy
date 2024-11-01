<template>
  <div class="app-wrapper">
    <div class="app-container">
      <!-- Navbar -->
      <Navbar />
      <div class="content-container">
        <!-- Sidebar -->

        <Sidebar />
        <!-- Main Content -->
        <main>
          <router-view />
        </main>
      </div>
      <Footer />
    </div>
  </div>
  <div class="terms-page" v-if="!termsApproved">
    <TermsPage @updateTerms="continueAction()" />
  </div>
</template>

<script>
import axios from "axios";
import Footer from "./Navigations/FooterComponent.vue";
import Navbar from "./Navigations/NavbarComponent.vue";
import Sidebar from "./Navigations/SidebarComponent.vue";
import TermsPage from "./Shared/TermsPage.vue";
export default {
  mounted() {
    this.fetchUserData();
    this.continueAction(this.data);
    this.checkStatus();
  },
  watch: {
    $route(to, from) {
      if (to.name == undefined) {
        this.$router.push({ name: "dashboard" });
      } else if (to.name == "spin") {
        this.$router.push({ name: "spin" });
      } else if (to.name == "image_quiz") {
        // console.log(to.name);
        this.$router.push({
          name: "image_quiz",
          query: { quizType: to.name },
        });
      } else if (to.name == "quiz") {
        // console.log(to.name);
        this.$router.push({
          name: "quiz",
          query: { quizType: to.name },
        });
      }
    },
    campaignEndTime(newValue) {
      // console.log(newValue);

      const currentTime = new Date();

      if (currentTime >= newValue) {
        this.updateStatus();
      }

      // console.log(currentTime);
    },
  },
  data() {
    return {
      campaignData: [],
      campaignEndTime: "",
      termsApproved: false,
      data: {},
    };
  },
  components: {
    Navbar,
    Sidebar,
    Footer,
    TermsPage,
  },
  computed: {
    currentRouteName() {
      return this.$router.name;
    },
  },
  methods: {
    continueAction(data) {
      const agreed = localStorage.getItem("agreed");
      // console.log(agreed);
      // You can then perform actions based on the retrieved value
      if (agreed) {
        this.termsApproved = true;
      } else {
        this.termsApproved = false;
      }
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
          // this.checkPacakge(response.data.user_email);
          this.data = {
            wp_user_email: response.data.user_email,
            wp_user_name: response.data.user_name,
          };

          // console.log(data);
        })
        .catch((error) => {
          // Handle error
          this.isLoading = false;
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
          this.campaignData = response.data;
          // console.log(this.campaignData);
          this.campaignEndTime = this.endTime(
            response.data.time,
            response.data.campaign_time
          );
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    endTime(createdTime, campaignTime) {
      // console.log(createdTime, campaignTime);
      const endTime = new Date(createdTime);

      const regexResult = campaignTime.match(/(\d+)\s*(\w+)/);
      if (regexResult) {
        const amount = parseInt(regexResult[1]);
        const unit = regexResult[2].toLowerCase();

        switch (unit) {
          case "minute":
          case "minutes":
            endTime.setHours(endTime.getMinutes() + amount);
            break;
          case "hour":
          case "hours":
            endTime.setHours(endTime.getHours() + amount);
            break;
          case "day":
          case "days":
            endTime.setDate(endTime.getDate() + amount);
            break;
          default:
            // Handle unsupported units or provide a default behavior
            console.error("Unsupported time unit:", unit);
            break;
        }
      } else {
        // Handle invalid campaign time format
        console.error("Invalid campaign time format:", this.campaignTime);
      }
      // console.log(endTime);
      return endTime;
    },

    updateStatus() {
      const data = {
        table: this.campaignData.table,
        id: this.campaignData.row_id,
      };
      axios
        .post(wpApiSettings.root + "custom/v1/change-status", data, {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // console.log(response.data);
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
html,
body,
.app-container {
  height: 100%;
  margin: 0;
}

/* Style for the app container */
.app-container {
  display: flex;
  flex-direction: column;
}

.terms-page {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

/* Style for the navbar */

/* Style for the content container (sidebar + main content) */
.content-container {
  padding: 32px 40px 0px;
  display: flex;
  flex: 1;
}

main {
  border-radius: 24px;
  background-color: #f7f7f7;
  flex-grow: 1;
  padding: 32px;
}
</style>
