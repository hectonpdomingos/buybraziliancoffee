import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
      products: [],
      cart: [],
      total: 0
    },
    
    
    getters: {      
      quantity (state) {
          return state.cart.reduce((acc, item) => acc + Function("return " + item.quantity)(), 0);
      },
      items (state) {
         return state.cart;
      },
      getTotalFromController(state){
        return state.total;
      }
    },
    mutations: {
    
      addProductList(state, items){
        state.products.push(items)
      },
      addItem (state, item) {
        state.cart.push(item);
      

      //   for(var i = 0 ; i < state.cart.length ; i++){
      //      if(state.cart[i].id === item.id){
      //       console.log("found item")
      //       //this.$store.state.commit('addQty');
      //      }else {
      //       console.log("not found item")
      //       //state.cart.push(item)
      //     }
      //  }
              
      },

      removeItem (state, item){
        state.cart.splice(item, 1)
      },

      removeItem: (state, id) =>
             (state.cart = state.cart.filter(item => item.id !== id)),

      updateQuantity(state, id) {
        state.cart[id].quantity = state.cart.filter(item => item.id = id)
      },
      addQty(state, id){
        for(var i = 0; i < state.cart.length ; i++ ){
          if(state.cart[i].id === id){
            state.cart[i].quantity++;
          }
        }
      },
      minusQty(state, id){
        for(var i = 0; i < state.cart.length ; i++ ){
          if(state.cart[i].id === id){
            if(state.cart[i].quantity === 1){
              state.cart.splice(state.cart[i], 1)
            }else{
              state.cart[i].quantity--;
            }
          }
        }
      },
      pay(state){      
        axios.post('/purchase/cart/', {
           data: state.cart,
          _method: 'patch'
          })
          .then(function (response) {
            //get total from the server and put on the total property
              state.total = response.data.message;
          })
          .catch(function (error) {
                console.log(error);            
          });
       }
                
    },
    actions: {
      //push into cart array using the actions 
      addItem (context) {
          context.commit('addItem');
      },
      removeItem (context) {
        context.commit('removeItem');
      },
      addQty (context) {
        context.commit('addQty');
      },
      minusQty (context) {
        context.commit('minusQty');
      },//payment
      pay(context) {
        context.commit('pay');
      }
     

    }
  })