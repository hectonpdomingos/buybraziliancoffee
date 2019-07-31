<template>
  <div id="app">
    <div class="product-list">
      <div class="container-flex" style="margin: 30px;">

      <h3>{{ $t('cart') }}</h3>
      <div class="total-cart">
        <hr>

        <p>Subtotal: {{ (subTotal).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }}</p>
        <p>{{ $t('shipping')}}: {{ shipping }}</p>
        <hr>
        <h4>{{ $t('total') }}: {{ (subTotal + shipping).toFixed(2)}}</h4>
      </div>

      <div v-for="(product, index) in getItemsCart" v-bind:key="index">
        <p>
          {{product.name}} x {{product.quantity}}
           <button v-on:click="plusQty(product.id)">+</button>
           <button v-on:click="minusQty(product.id)">-</button>
          | {{ product.price}} UN
        </p>
      </div>
    </div>
    <!-- <button
      class="btn btn-success"
      style="width: auto;"
      id="show-modal"
      @click="showModal = true"
    >Pay Now</button> -->

     <button class="btn btn-success" @click="pay">{{ $t('pay') }}</button>
    
    <div class="shipping-address">
      <h3> {{ $t('shippingaddress') }} {{ getTotalAmout }}</h3>
      <br>      
      <div v-for="(info, index) in customer" v-bind:key="index">
        <p> {{ $t('customer') }}: {{ info.fullName }}</p>
        <p>{{ $t('address') }}: {{ info.address }}</p>
        <p>Email: {{ info.email}}</p>
      </div>
    </div>
    <payment-modal v-if="showModal" @close="showModal = false"></payment-modal>
  </div>
  </div>
</template> 

<script>

import { mapGetters, mapActions } from 'vuex'
 
export default {
 
  name: "app",
  data() {
    return {
      testeArray: { id: '2', name: 'User 2'},
      showModal: false,
      readyToPay: false,
      paymentMethod: 0,
      //products: 0,//this.$store.getters.items,
      customer: [
        {
          fullName: "Hecton Paulino Domingos",
          email: "hectonpdomingos@gmail.com",
          address: "Rua Jose Ribeiro - São vicente - Brazil",
          shippingPrice: "22.99"
        }
      ]
    };
  },
  methods: {

    plusQty(id){
       this.$store.commit('addQty', id);
    },
    minusQty(id){
         this.$store.commit('minusQty', id);
    },
    commitIntoStore(){
      this.$store.commit('addItem', this.testeArray)
    },
    removeItems(){
       this.$store.commit('removeItem', 1)
    },
    pay() {
      this.$store.commit('pay');
    }

  },
  computed: {
  
    getTotalAmout() {
       if(this.$store.getters.getTotalFromController) {
         this.showModal = true;
         return this.$store.getters.getTotalFromController;
         
       }
     
    },    
    getQuantityCart(){
      return this.$store.getters.quantity;
     },
     getItemsCart(){
      return this.$store.getters.items.filter(item => item.quantity !== "0");
     },
    myCart: function() {
      console.log(this.$store.getters.items.id);
      return this.$store.getters.items.filter(item => item.quantity !== "0");
    },
    leaveTheCart: function() {
      if (this.myCart.length == "0") {
        this.$emit("leaveTheCart");
      }
    },

    subTotal: function() {
      return (
        this.$store.getters.items
          .filter(item => item.quantity !== "0")
          //this function only works if the value is string - needs the soma function on methoods
          .reduce(
            (acc, item) => acc + parseFloat(item.price) * item.quantity,
            0
          )
      );

      //this function only works if the value is not string (it will not work with json format data)
      //return this.cart.reduce((acc, item) => acc + item.price, 0);
    },

    shipping: function() {
      //**  */ result double as expected
      return this.customer.reduce(
        (acc, item) => acc + parseFloat(item.shippingPrice),
        0
      );
    }
  }
};
</script>


