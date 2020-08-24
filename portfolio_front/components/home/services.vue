<template>
  <div v-if="sliders.length > 0" >
    <Divider>Services</Divider>

    <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>

    <Carousel v-model="value1" loop >
      <CarouselItem v-for="slider in sliders" :key="slider.id">
        <div class="demo-carousel"  style="background:green">
          <Card style="min-width:320px;    min-height: 391px;">
            <div style="text-align:center ">
              <img
                :src="imageLink  + slider.image"
                width="355"
                height="355"
                style=" border-radius: 50%;"
              />

              <h4>{{slider.name}}</h4>

            </div>
          </Card>
        </div>
      </CarouselItem>
    </Carousel>
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
        .get(process.env.moduleUrl + "services")
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
