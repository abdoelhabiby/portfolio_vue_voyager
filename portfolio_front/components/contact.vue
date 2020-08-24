<template>
  <div style="padding:20px;background:#333;color:#e6d1d1">

  <Spin fix size="large" v-show="showLoading">
      <Icon type="ios-loading" size="18" class="demo-spin-icon-load"></Icon>
      <div>Loading</div>
    </Spin>

    <h2 style="text:center">Contact Us</h2>
    <br />

    <Form :label-width="80" style="color:#e6d1d1">
      <Row>
        <Col span="8">
          <FormItem label="name">
            <Input v-model="name" placeholder="Enter name..." />
            <p style="color:#41ca20" v-if="errors.name">{{errors.name[0]}}</p>
          </FormItem>
        </Col>
        <Col span="8">
          <FormItem label="email">
            <Input v-model="email" placeholder="Enter email..." />
            <p style="color:#41ca20" v-if="errors.email">{{errors.email[0]}}</p>
          </FormItem>
        </Col>

        <Col span="8">
          <FormItem label="mobile">
            <Input v-model="mobile" placeholder="Enter mobile..." />
            <p style="color:#41ca20" v-if="errors.mobile">{{errors.mobile[0]}}</p>
          </FormItem>
        </Col>
      </Row>

      <FormItem label="Message">
        <Input
          v-model="message"
          type="textarea"
          :autosize="{minRows: 2,maxRows: 5}"
          placeholder="Enter your  Message..."
        />
        <p style="color:#41ca20" v-if="errors.message">{{errors.message[0]}}</p>
      </FormItem>
      <FormItem>
        <Button type="primary" @click="contact()">Send</Button>
      </FormItem>
    </Form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      mobile: "",
      message: "",
      errors: [],
      showLoading:false
    };
  },
  methods: {
    contact() {
      this.showLoading = true
      this.errors = [];
      this.$axios
        .post(process.env.baseUrl + "api/contact", {
          name: this.name,
          email: this.email,
          mobile: this.mobile,
          message: this.message,
        })
        .then((response) => {
          this.showLoading = false;
          if (response.data.status == false) {
            this.errors = response.data.data;
          }

          if (response.data.status) {
            this.name = "";
            this.email = "";
            this.mobile = "";
            this.message = "";
            this.success(response.data.message);
          }
          console.log(response.data);
        });
    },
    success(message) {
      this.$Message.success({
        content: message,
        duration: 5,
      });
    },
  },
};
</script>
