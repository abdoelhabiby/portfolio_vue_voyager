<template>
  <div class="container">
    <h2 style="display: flex;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 15px;">Our Services</h2>

    <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>

    <Row>
      <Col
        style="margin-bottom:20px"
        :xs="{ span: 5, offset: 1 }"
        :lg="{ span: 6, offset: 2 }"
        v-for="service in services"
        :key="service.id"
      >
        <Card style="width:320px">
        <nuxt-link :to="'/services/' + service.id" >
          <div style="text-align:center ">
            <img :src="imageLink  + service.image" width="288" height="250" />
             <h3>{{service.name}}</h3>
          </div>
        </nuxt-link>
        </Card>
      </Col>
    </Row>
     <div style="    display: flex;
    justify-content: center;">
      <ButtonGroup>
        <Button type="primary" v-if="prevPage" @click="getPrevPage()">
            <Icon type="ios-arrow-back"></Icon>
            previos
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
         title: 'Osha | serivces'
     }
  },
  components: {},
  mounted() {
    this.showLoading = true;

    this.getClients();
  },
  data() {
    return {
      services: [],
      showLoading: false,
      currentPage : 1,
      nextPage : null,
      prevPage : null,
      lastPage:1,
      imageLink : process.env.imageUrl


    };
  },

  methods: {
    getClients() {
            this.showLoading = true;

      let url = process.env.moduleUrl + "services?page=1";
      if(this.nextPage != '' && this.nextPage != null){
         url = this.nextPage;
      }

      this.$axios
        .get(url)
        .then((response) => {
          if (response.data.status) {
            this.showLoading = false;
            this.services = response.data.data.data;

            this.currentPage = response.data.data.current_page;
            this.nextPage = response.data.data.next_page_url;
            this.lastPage = response.data.data.last_page_url;
            this.prevPage = response.data.data.prev_page_url;
          }
        });
    },
    getPrevPage(){
            this.showLoading = true;

      let url = process.env.moduleUrl + "services?page=1";
      if(this.prevPage != '' && this.prevPage != null){
         url = this.prevPage;
      }

      this.$axios
        .get(url)
        .then((response) => {
          if (response.data.status) {
            this.showLoading = false;
            this.services = response.data.data.data;

            this.currentPage = response.data.data.current_page;
            this.nextPage = response.data.data.next_page_url;
            this.lastPage = response.data.data.last_page_url;
            this.prevPage = response.data.data.prev_page_url;
          }
        });
    }
  },
};
</script>

