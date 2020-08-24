<template>
  <div>
     <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>

    <Carousel autoplay  loop>


        <CarouselItem v-for="slider in sliders" :key="slider.id">
            <div class="demo-carousel" style="position:relative;">
                <div class="slider-content">
                    <h2>{{slider.name}}</h2><br>
                    <p>{{slider.description}}</p>
                </div>

               <img :src="imageLink + slider.image" width="100%" height="650px" alt="">
            </div>
        </CarouselItem>
    </Carousel>
  </div>
</template>
<script>
    export default {
        mounted(){
          this.showLoading = true;
          this.fetchData();
        },
        data () {
            return {
              sliders:[],
              showLoading:false,
              imageLink: process.env.imageUrl
            }
        },
        methods:{
          fetchData(){

            this.$axios.get(process.env.moduleUrl + "slider").then(response => {
              this.showLoading = false;

               this.sliders = response.data.data.data;
            })
          }
        }
    }
</script>
<style>
.slider-content{
  position:absolute;
  z-index: 262362;

  font-size: 27px;
  color: white;
  border:2px solid white);
  padding: 15px 30px 15px 30px;
  background-color: rgb(70, 63, 64,.3);
  justify-content: center;
  margin:auto

}

.slider-content h2{
  text-transform:capitalize;

}

.color-white{
  color: white;
}
</style>
