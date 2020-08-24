<template>
  <div class="container">


    <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>



        <Card  style="display: flex;
                  justify-content: center;" >
          <div style=" " v-if="!notFound">
            <img :src="imageLink  + page.image" width="100%"  />
             <h2>{{page.title}}</h2><br>
             <h3>{{page.excerpt}}</h3><br>
             <p v-html="page.body"></p><br>
          </div>
            <div v-else>
            <p style="color:red;font-size:25px">Not Found 404 !</p>
          </div>

        </Card>




  </div>




</template>




<script>
export default {
    head(){
     return {
         title: 'Osha | page |' + this.page.title
     }
  },
  components: {},
  mounted() {
    this.showLoading = true;

    this.fetchData();
  },
  data() {
    return {
      page: {},
      showLoading: false,
      notFound:false,

      imageLink : process.env.imageUrl


    };
  },

  methods: {
    fetchData() {
            this.showLoading = true;

      let url = process.env.moduleUrl + "page/" + this.$route.params.id;


      this.$axios
        .get(url)
        .then((response) => {
          if (response.data.status) {
            this.showLoading = false;
            this.page = response.data.data;
          }


          if(response.data.status == false){
              this.notFound = true;
              this.showLoading = false;

          }

        });
    },

  },
};
</script>

