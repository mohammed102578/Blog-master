<template>
    <div>
        <div class="content">
			<div class="container-fluid">
        <h1>
            I am purpose to show all component
            
        </h1>
        <h2>
                current state of counter :{{$store.state.counter}}
        </h2>
    </div>

    <div>
<comA></comA>

    </div>
     <div>
<comB></comB>

    </div>
     <div>
<comC></comC>

    </div>
  <button class="btn btn-primary" @click="changeCounter">change state</button>
     </div>
   
      </div>
      
</template>

<script>

import comA from './comA.vue'
import comB from './comB.vue'
import comC from './comC.vue'

export default {
data(){
return{

}

},
methods:{
changeCounter(){
this.$store.commit('changeTheCounter',1)

}
},

created(){
    console.log(this.$store.state.counter)
},
components:{
comA,
comB,
comC
}
}
</script>

