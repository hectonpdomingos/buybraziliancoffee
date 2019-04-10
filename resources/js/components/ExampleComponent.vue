<template>
  
</template>

<script>
    export default {
       data() {
           return {
               cart: [],
               products: []
           }

       },
       methods:{
           soma(fn){
               return Function('return ' + fn)();
           }
       },
       computed: {
            totalCart: function(){      
            
           //this function only works if the value is string - needs the soma function on methods
           return this.cart.reduce((acc, item) => acc + this.soma(item.price), 0);
           
           
           //this function only works if the value is not string (it will not work with json format data for decimals)      
           //return this.cart.reduce((acc, item) => acc + item.price, 0);

         
            }
       }
    }

</script>
