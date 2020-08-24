<template>
  <div v-if="sliders.length > 0">
    <Divider>Tesmonials</Divider>

    <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>

  <Row>
      <Col
        style="margin-bottom:20px"
        :xs="{ span: 5, offset: 1 }"
        :lg="{ span: 6, offset: 2 }"
       v-for="(slider,index) in sliders" :key="index"
       v-if="index < 3"
      >
        <Card style="width:320px">
          <div style="text-align:center ">
            <img :src="imageLink  + slider.image" width="288" height="250" />
             <h3>{{slider.name}}</h3>
              <p>Job Title : {{slider.job_title}}</p>
              <p>project type : {{slider.project_type}}</p>
              <p>{{slider.comment}}</p>
          </div>
        </Card>
      </Col>
    </Row>


  </div>
</template>
<script>
export default {
  mounted() {
    this.showLoading = true;
    this.fetchData();
  },
  data() {
    return {
      sliders: [],
      showLoading: false,
      imageLink: process.env.imageUrl,
      value1: 1,
    };
  },
  methods: {
    fetchData() {
      this.$axios
        .get(process.env.moduleUrl + "testimonials")
        .then((response) => {
          this.showLoading = false;
          if (response.data.status) {
            this.sliders = response.data.data.data;
          }
        });
    },
  },
};
</script>
