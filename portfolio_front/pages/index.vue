<template>
 <div>
   <Slider />
   <Services />
   <Testmonials />


 </div>

</template>


<script>
 import Slider from "../components/home/slider"
 import Testmonials from "../components/home/testmonials"
 import Services from "../components/home/services"
export default {
  components:{
    Slider,
    Testmonials,
    Services

  }
}
</script>
