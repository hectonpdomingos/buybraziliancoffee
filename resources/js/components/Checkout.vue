<template>
  <div id="app">
    <div class="product-list">
      <h3>Shopping Cart</h3>
      <div class="total-cart">
        <hr>

        <p>Subtotal: {{ (subTotal).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }}</p>
        <p>Shipping: {{ shipping }}</p>
        <hr>
        <h4>Total: {{ (subTotal + shipping).toFixed(2)}}</h4>
      </div>

      <div v-for="(product, index) in myCart" v-bind:key="index">
        <p>
          {{product.name}} x {{product.quantity}}
           <button v-on:click="plusQty(product.id)">+</button><button v-on:click="minusQty(product.id)">-</button>
          | {{ product.price}} UN
        </p>
      </div>
    </div>
    <button
      class="btn btn-success"
      style="width: auto;"
      id="show-modal"
      @click="showModal = true"
    >Pay Now</button>

    
    <div class="shipping-address">
      <h3>Shipping Address</h3>
      {{ getQuantityCart }}
      <br>
      <ul>
        <div v-for="(item, index) in getItemsCart" v-bind:key="index" >
          <li> {{ item.name }}</li>
        </div>
      </ul>
      <div v-for="(info, index) in customer" v-bind:key="index">
        <p>Customer: {{ info.fullName }}</p>
        <p>Address: {{ info.address }}</p>
        <p>Email: {{ info.email}}</p>
      </div>
    </div>
      <button v-on:click="commitIntoStore"> Push items to store</button>

      <button v-on:click="removeItems"> Remove item</button>
    <payment-modal v-if="showModal" @close="showModal = false"></payment-modal>
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
          address: "Rua Jose Ribeiro Sobrinho 76 - São vicente - Brazil",
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
    }
  },
  computed: {
  

    getQuantityCart(){
      return this.$store.getters.quantity;
     },
     getItemsCart(){
       return this.$store.getters.items.filter(item => item.quantity !== "0");
     },
    myCart: function() {
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

<style scoped>
.product-list {
  width: 70%;
  height: auto;
  background-color: ‎#6f4e37;
}
</style>
