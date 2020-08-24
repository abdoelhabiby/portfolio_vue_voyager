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



        <Card  style="display: flex;
                  justify-content: center;" >
          <div style="text-align:center " v-if="!notFound">
            <img :src="imageLink  + service.image" width="400" height="350" />
             <h3>{{service.name}}</h3>
             <p>{{service.description}}</p>
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
         title: 'Osha | serivce |' + this.service.name
     }
  },
  components: {},
  mounted() {
    this.showLoading = true;

    this.fetchData();
  },
  data() {
    return {
      service: {},
      showLoading: false,
      notFound:false,

      imageLink : process.env.imageUrl


    };
  },

  methods: {
    fetchData() {
            this.showLoading = true;

      let url = process.env.moduleUrl + "services/" + this.$route.params.id;


      this.$axios
        .get(url)
        .then((response) => {
          if (response.data.status) {
            this.showLoading = false;
            this.service = response.data.data;
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

