<template>
  <div class="layout">
    <Layout>
      <Header :style="{position: 'fixed', width: '100%'}">
        <Menu mode="horizontal" theme="dark" active-name="1">
          <div class="layout-logo">
            <img src="logo_portfolio.jpg" width="130px" height="45px"/>
          </div>
          <div class="layout-nav">
            <MenuItem name="1">
              <NuxtLink to="/" class="color-white">
                <Icon type="ios-navigate"></Icon>Home
              </NuxtLink>
            </MenuItem>

            <MenuItem name="2">
              <NuxtLink to="/services"  class="color-white">
                <Icon type="ios-navigate"></Icon>Services
              </NuxtLink>
            </MenuItem>
            <MenuItem name="3">
              <NuxtLink to="/our_works"  class="color-white">
                <Icon type="ios-navigate"></Icon>Our Works
              </NuxtLink>
            </MenuItem>
            <MenuItem name="4">
              <NuxtLink to="/teams" class="color-white">
                <Icon type="ios-navigate" ></Icon>Teams
              </NuxtLink>
            </MenuItem>
            <MenuItem name="5">
              <NuxtLink to="/clients" class="color-white">
                <Icon type="ios-navigate" ></Icon>Clients
              </NuxtLink>
            </MenuItem>
            <MenuItem name="" v-for="page in pages" :key="page.id">
              <NuxtLink :to="'/pages/' + page.id" class="color-white">
                <Icon type="ios-navigate"></Icon>{{page.title}}
              </NuxtLink>
            </MenuItem>

          </div>
        </Menu>
      </Header>
      <Content :style="{margin: '88px 20px 0', background: '#fff', minHeight: '500px'}">
        <Nuxt />
        <Spin fix size="large" v-show="showLoading">
          <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
          <div>Loading</div>
        </Spin>
      </Content>
       <Contact />
      <Footer class="layout-footer-center" style="background:#333;color:#e6d1d1">2020 &copy; Portfolio</Footer>
    </Layout>
  </div>
</template>
<script>

  import Contact from "../components/contact"

export default {
  head(){
     return {
         title: 'Osha'
     }
  },
  components:{
     Contact
  },
  mounted() {
    this.getPages();
  },
  data() {
    return {
      pages: [],
      showLoading: false,
    }
  },
  methods:{
    getPages(){
      this.showLoading = true;

      this.$axios.get(process.env.moduleUrl + "pages").then(response => {
        this.showLoading = false;
        if(response.data.status){
           this.pages =  response.data.data.data;

        }
      });
    }
  }
};
</script>


<style scoped>
.layout {
  border: 1px solid #d7dde4;
  background: #f5f7f9;
  position: relative;
  border-radius: 4px;
  overflow: hidden;
}
.layout-logo {
  width: 100px;
  height: 30px;
  background: #5b6270;
  border-radius: 3px;
  float: left;
  position: relative;
  top: 15px;
  left: 20px;
  margin-right: 10px;
}
.layout-nav {
  margin: 0 10px 0 10px;
  margin-right: 20px;
  float: right;
}
.layout-footer-center {
  text-align: center;
}
</style>
