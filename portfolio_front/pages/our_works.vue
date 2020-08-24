<template>
  <div class="container">
    <h2
      style="display: flex;
    justify-content: center;
    margin-bottom: 20px;
    margin-top: 15px;"
    >Our Works</h2>

    <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>


 <List item-layout="vertical">
        <ListItem  v-for="ourWork in ourWorks"
        :key="ourWork.id" style="margin: 30px;">
           <ListItemMeta  :title="ourWork.name" :description="ourWork.description" />


            <template slot="extra">
                <img :src="imageLink  + ourWork.image" style="width: 280px;height:255px">
            </template>
        </ListItem>
    </List>




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
         title: 'Osha | Our Works'
     }
  },
  components: {},
  mounted() {
    this.showLoading = true;

    this.getClients();
  },
  data() {
    return {
      ourWorks: [],
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

      let url = process.env.moduleUrl + "our_work?page=1";
      if (this.nextPage != "" && this.nextPage != null) {
        url = this.nextPage;
      }

      this.$axios.get(url).then((response) => {
        if (response.data.status) {
          this.showLoading = false;
          this.ourWorks = response.data.data.data;

          this.currentPage = response.data.data.current_page;
          this.nextPage = response.data.data.next_page_url;
          this.lastPage = response.data.data.last_page_url;
          this.prevPage = response.data.data.prev_page_url;
        }
      });
    },
    getPrevPage() {
      this.showLoading = true;

      let url = process.env.moduleUrl + "our_work?page=1";
      if (this.prevPage != "" && this.prevPage != null) {
        url = this.prevPage;
      }

      this.$axios.get(url).then((response) => {
        if (response.data.status) {
          this.showLoading = false;
          this.ourWorks = response.data.data.data;

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

