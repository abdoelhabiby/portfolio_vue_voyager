<template>
  <div class="container">
    <h2
      style="display: flex;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 15px;"
    >Our Teams</h2>

    <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>

    <Row>
      <Col
        style="margin-bottom:20px;"
        :xs="{ span: 5, offset: 1 }"
        :lg="{ span: 6, offset: 2 }"
        v-for="team in teams"
        :key="team.id"
      >
        <Card style="width:320px;    min-height: 391px;">
          <div style="text-align:center ">
            <img
              :src="imageLink  + team.image"
              width="288"
              height="288"
              style=" border-radius: 50%;" />

            <h4>{{team.name}}</h4>
            <p>Job Title : {{team.job_title}}</p>
            <div class="sochiale">
              <a v-if="team.facebook" :href="team.facebook" target="_tblank">
                <Icon type="logo-facebook" size="23" />
              </a>
              <a v-if="team.linkedin" :href="team.linkedin" target="_tblank">
                <Icon type="logo-linkedin" size="23" />
              </a>
            </div>
          </div>
        </Card>
      </Col>
    </Row>
    <div style="    display: flex;
    justify-content: center;">
      <ButtonGroup>
        <Button type="primary" v-if="prevPage" @click="getPrevPage()">
          <Icon type="ios-arrow-back"></Icon>previos
        </Button>
        <Button type="primary" v-if="nextPage != '' && nextPage != null" @click="getClients()">
          next
          <Icon type="ios-arrow-forward"></Icon>
        </Button>
      </ButtonGroup>
    </div>
  </div>
</template>




<script>
export default {
          head(){
     return {
         title: 'Osha | Teams'
     }
  },
  components: {},
  mounted() {
    this.showLoading = true;

    this.getClients();
  },
  data() {
    return {
      teams: [],
      showLoading: false,
      currentPage: 1,
      nextPage: null,
      prevPage: null,
      lastPage: 1,
      imageLink: process.env.imageUrl,
    };
  },

  methods: {
    getClients() {
      this.showLoading = true;

      let url = process.env.moduleUrl + "teams?page=1";
      if (this.nextPage != "" && this.nextPage != null) {
        url = this.nextPage;
      }

      this.$axios.get(url).then((response) => {
        if (response.data.status) {
          this.showLoading = false;
          this.teams = response.data.data.data;

          this.currentPage = response.data.data.current_page;
          this.nextPage = response.data.data.next_page_url;
          this.lastPage = response.data.data.last_page_url;
          this.prevPage = response.data.data.prev_page_url;
        }
      });
    },
    getPrevPage() {
      this.showLoading = true;

      let url = process.env.moduleUrl + "teams?page=1";
      if (this.prevPage != "" && this.prevPage != null) {
        url = this.prevPage;
      }

      this.$axios.get(url).then((response) => {
        if (response.data.status) {
          this.showLoading = false;
          this.teams = response.data.data.data;

          this.currentPage = response.data.data.current_page;
          this.nextPage = response.data.data.next_page_url;
          this.lastPage = response.data.data.last_page_url;
          this.prevPage = response.data.data.prev_page_url;
        }
      });
    },
  },
};
</script>

