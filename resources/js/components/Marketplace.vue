<template>
  <div>
      <div>
            <button v-for="entry in languages" :key="entry.title" @click="changeLocale(entry.language)">
                <flag :iso="entry.flag" v-bind:squared=false /> {{entry.title}}
            </button>
    </div>
    <div class="cart" >
      <transition name="fade">
        <p  v-if="this.$store.getters.quantity > 0" v-on:click="showCart" type="button" class="btn btn-success">
          <span class="badge badge-secondary">{{this.$store.getters.quantity }}</span>
          {{ $t('checkout') }}
        </p>
      </transition>
      <transition name="fade">
        <checkout-page v-if="this.$store.getters.quantity > 0"></checkout-page>
      </transition>
    </div>
  
    <div class="menu">
      <h3>{{ $t('orderby') }}</h3>
      <div class="row sortBy">
        <a v-on:click="orderByPrice">{{ $t('price') }}</a>
        <a v-on:click="orderByProducer">{{ $t('producer') }}</a>
        <a v-on:click="orderByPrice">{{ $t('type') }}</a>
      </div>
    </div>
    <div class="vitrine">
      <div v-for="(product, index) in paginatedData" v-bind:key="index">
        
        <div class="vitrine-card">
          <div class="card">
            <img class="card-img-top" :src="product.photo"   alt="Card image cap">
            <div class="card-body">
               <h5 class="card-title">{{product.name }}</h5>
              <h5 class="card-title">{{product.coffeetype}}</h5>
              <p class="card-text">                
                <i class="fas fa-weight"></i>
                : {{ product.weight }} g |
                <i class="fas fa-tag"></i>
                : {{ product.price }} UN
              </p>
              <a v-on:click="addItem(product)" class="btn btn-success" style="width: 13rem;">
                {{ $t('buy') }}
                <i class="fas fa-cart-plus"></i>
              </a>
            </div>
          </div>
        </div>
     
      </div>
    </div>
    <div class="row col-4">
      <button class="btn btn-success" :disabled="pageNumber === 0" @click="prevPage"> {{ $t('previous') }}</button>
      <button class="btn btn-success" :disabled="pageNumber >= pageCount -1" @click="nextPage"> {{ $t('next') }}</button>
    </div>
  </div>
</template>


<script>
import i18n from '../plugins/i18n';
import { mapGetters, mapActions } from 'vuex'
import { store } from '../store/store';
import CheckOut from "./Checkout.vue";


export default {
  data() {
    return {
      languages: [
          { flag: 'us', language: 'en', title: 'English' },
          { flag: 'br', language: 'br', title: 'Português' },
          { flag: 'ru', language: 'ru', title: 'Russian' }
      ],
      url: 'https://google.com.br',
      products: [],  //products from database passed by axios, but the list gets data from paginatedData function.
      checkout: false,  // True if the user added any item there.
      pageNumber: 0, 
      size: 5, //10 first ids to show
      orderBy: 0,
     
           
    };
  },
   //get json data from DB
  created() {
    axios.get("/products").then(response => (this.products = response.data));
  },

  components: {
    "checkout-page": CheckOut
  },

  methods: {
      changeLocale(locale) {
      i18n.locale = locale;
    },
    showCart() {
      console.log('Firing the showCart')
      this.checkout = !this.checkout;
    },
    //pagination buttons
    nextPage() {
      this.pageNumber++;
    },
    prevPage() {
      this.pageNumber--;
    },

 


    //Add item in the cart
    addItem(item) {
      
      // var itemQtd = this.qtd;
      var myItem = {
        id: item.id,
        name: item.name,
        weight: item.weight,
        price: item.price,
        quantity: 1
      };
      this.$store.commit('addItem', myItem);
     
    },
    removeItem(index) {
      //remove the index X from cart
     // this.cart.splice(index, 1);
    },

    //order By Functions
    orderByProducer() {
      var orderByProducer;
      if (this.orderBy == 0) {
        orderByProducer = _.orderBy(this.products, "producer_id", "asc");
        this.orderBy = 1;
      } else {
        orderByProducer = _.orderBy(this.products, "producer_id", "desc");
        this.orderBy = 0;
      }
      this.products = orderByProducer;
    },
    orderByPrice() {
      var orderByPrice;
      if (this.orderBy == 0) {
        orderByPrice = _.orderBy(this.products, "price", "asc");
        this.orderBy = 1;
      } else {
        orderByPrice = _.orderBy(this.products, "price", "desc");
        this.orderBy = 0;
      }
      this.products = orderByPrice;
    },
    orderByType() {
      var orderByType;
      if (this.orderBy == 0) {
        var orderByType = _.orderBy(this.products, "coffeetype", "asc");
        this.orderBy = 1;
      } else {
        var orderByType = _.orderBy(this.products, "coffeetype", "desc");
        this.orderBy = 0;
      }
      this.products = orderByType;
    },

    //convert string from json to decimal to be able to calculate
    soma(fn) {
      return new Function("return " + fn)();
    },

    },
 
  computed: {

   //get qty of products in the cart
    //  totalItemInTheCart(){
    //   return this.$store.getters.quantity;
    //  },
    //Show in the badge the total qty of items in the cart  #
    // totalItemInTheCart: function() {
    //   return this.cart.length;
    // },
    //calculate de total price in the cart
    totalCart: function() {
      //this function only works if the value is string - needs the soma function on methoods
      //return this.cart.reduce((acc, item) => acc + this.soma(item.price), 0);

       //getting from store
         return this.$store.getters.items.reduce((acc, item) => acc + this.soma(item.price), 0);
      //  if(total === 0){
      //    this.checkout = false;
      //  }else{
       
      // }
      //this function only works if the value is not string (it will not work with json format data)
      //return this.cart.reduce((acc, item) => acc + item.price, 0);
    },

     
    //get the number of item and then use math.ceil to divide by the number of pages you want
    pageCount() {
      let l = this.products.length,
        s = this.size;
      return Math.ceil(l / s);
    },
    //gets the products from created() and return paginated
    paginatedData() {
      const start = this.pageNumber * this.size,
        end = start + this.size;

      return this.products.slice(start, end);
    }
  }
};
</script>


<style scoped>

.fade-fade-enter-active {
  transition: all 0.3s ease;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.vitrine,
.vitrine-card {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  padding-right: 2rem;
  padding-bottom: 20px;
  align-items: stretch;
  border-bottom: 2rem;
}
.card-img-top {
  margin-block-start: 1em;
  margin-block-end: 1em;
  margin-inline-start: 40px;
  margin-inline-end: 40px;
}
.card-title {
  font-size: 14px;
  line-height: 18px;
}
.card-img-top {
  width: 15rem;
}
.cart {
  float: right;
}

.sortBy a:hover {
  background: #3e7b99;
}

.sortBy a {
  background: #85c8ea;
  border-radius: 3px 0 0 3px;
  color: #fff !important;
  display: inline-block !important;
  height: 26px;
  float: left;
  line-height: 26px;
  padding: 0 30px 0 10px;
  position: relative;
  margin: 0 3px 3px 0;
  text-decoration: none;
  -webkit-transition: color 0.2s;
}
.sortBy a::before {
  background: #fff;
  border-radius: 10px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
  content: "";
  height: 6px;
  right: 13px;
  position: absolute;
  width: 6px;
  top: 10px;
}

.sortBy a::after {
  background: #fff;
  border-bottom: 13px solid transparent;
  border-left: 10px solid #85c8ea;
  border-top: 13px solid transparent;
  content: "";
  position: absolute;
  right: 0;
  top: 0;
}
</style>

