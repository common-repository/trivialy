<template>
  <Loader v-if="isLoading" />
  <div v-else class="information-wrap">
    <div class="information-header">System Information</div>
    <div class="information-box">
      <div class="single-box">
        <div class="box-header">Site URL:</div>
        <div class="box-content">{{ wordpressData.site_url }}</div>
      </div>
      <div class="single-box">
        <div class="box-header">Home URL:</div>
        <div class="box-content">{{ wordpressData.home_url }}</div>
      </div>
    </div>
    <div class="information-header">Wordpress Information</div>
    <div class="information-box">
      <div class="single-box-column">
        <div class="single-box-content">
          <div class="box-header">WordPress Version:</div>
          <div class="box-content">{{ wordpressData.wordpress_version }}</div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Language:</div>
          <div class="box-content">{{ wordpressData.language }}</div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Memory Limit</div>
          <div class="box-content">{{ wordpressData.memory_limit }}</div>
        </div>
      </div>
      <div class="single-box-column">
        <div class="single-box-content">
          <div class="box-header">Active Theme</div>
          <div class="box-content">
            {{ wordpressData.name }}&nbsp;{{ wordpressData.version }}
          </div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Parent Theme</div>
          <div class="box-content">
            {{ wordpressData.name }}&nbsp;{{ wordpressData.version }}
          </div>
        </div>
      </div>
    </div>
    <div class="information-header">Server Information</div>
    <div class="information-box">
      <div class="single-box-column">
        <div class="single-box-content">
          <div class="box-header">PHP:</div>
          <div class="box-content">{{ wordpressData.php_version }}</div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Webserver</div>
          <div class="box-content">{{ wordpressData.web_server }}</div>
        </div>
      </div>
      <div class="single-box-column">
        <div class="single-box-content">
          <div class="box-header">MySQL</div>
          <div class="box-content">{{ wordpressData.mysql_version }}</div>
        </div>
      </div>
    </div>
    <div class="information-header">Trivialy Information</div>
    <div class="information-box">
      <div class="single-box-column">
        <div class="single-box-content">
          <div class="box-header">Total Campaign:</div>
          <div class="box-content">{{ wordpressData.total_campaign }}</div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Total Active Campaign:</div>
          <div class="box-content">{{ wordpressData.active_quiz }}</div>
        </div>
      </div>
      <div class="single-box-column">
        <div class="single-box-content">
          <div class="box-header">Initial Version:</div>
          <div class="box-content">{{ wordpressData.plugin_version }}</div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Current Version</div>
          <div class="box-content">{{ wordpressData.plugin_version }}</div>
        </div>
        <hr />
        <div class="single-box-content">
          <div class="box-header">Memory Limit</div>
          <div class="box-content">{{ wordpressData.memory_limit }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Loader from "../../Shared/AdminLoaderComponent.vue";
export default {
  data() {
    return {
      wordpressData: null,
      isLoading: true,
    };
  },
  mounted() {
    this.fetchWordPressData();
    // console.log(wpApiSettings.root);
  },
  components: {
    Loader,
  },
  methods: {
    fetchWordPressData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/about-data")
        .then((response) => {
          // Handle successful response
          this.wordpressData = response.data;
          this.isLoading = false;
          // console.log(response.data);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },
  },
};
</script>

<style scoped>
hr {
  width: 100%;
  background: #e3e3e3;
}

.single-box-content {
  display: flex;
  justify-content: space-between;
}

.information-wrap {
  margin-top: 32px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.information-box {
  display: flex;
  gap: 16px;
  width: 100%;
}

.single-box {
  background-color: #ffffff;
  padding: 16px 24px;
  width: 100%;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.single-box-column {
  background-color: #ffffff;
  padding: 16px 24px;
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  width: 100%;
  gap: 16px;
}

.information-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 2 | Light | Regular 400 */
  font-family: Inter;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: 130%; /* 23.4px */
}

.box-header {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: Inter;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.box-content {
  color: var(--color-text-colors-600-black-low-emp, #5e6064);
  /* Text/Body/Body 2 | Bold | Semibold 600 */
  font-family: Inter;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
}
</style>
