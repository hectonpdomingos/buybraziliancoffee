<template>
    <div>
        <div class="cart" >
                <h3>My Cart</h3>
                <ul>
                    <li v-for="(product, index)  in cart" v-bind:key="index"> {{ product.name }} - R$ {{ product.price }}  <a  v-on:click="removeItem(index)" class="far fa-trash-alt" >    Remove</a> </li>
                </ul>
                Total: {{ (totalCart).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }}  
                <div class="row">
                    
                <p v-if="this.cart.length > 0" type="button" class="btn btn-success">Check Out</p>
                </div>
        </div>
        <div class="menu">
            <h3>Sort By</h3>
            <div class="row sortBy">
                <a v-on:click="orderByPrice">Price </a> <a v-on:click="orderByProducer"> Producer </a> <a  v-on:click="orderByPrice" > Type </a>
            </div>


        </div>
        <div class="vitrine">
        <div  v-for="(product, index )  in products" v-bind:key="index">
            <div class="vitrine-card">
                    <div class="card">
                    <img class="card-img-top" src="/img/cafeimg.jpg" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{product.name }}</h5>
                    <h5 class="card-title">{{product.coffeetype}}</h5>
                    <p class="card-text">Weight: {{ product.weight }} g | Price: {{ product.price }} UN</p>
                    <a v-on:click="addItem(product)" class="btn btn-success" style="width: 13rem;">Add on <i class="fas fa-cart-plus"></i></a> 
                    
            </div>
            </div>

            </div>
         </div>
       </div>

       
    </div>
</template>


<script>

     
export default {
      data() {
        return {
            orderBy: 0,
            cart: [ ],
          
            qtd:0,
            itemQtd: 0,
            //productsTeste: [],

            products: [
                // {id: 1, name: 'Café 3 corações', coffeetype: 'Canilon', weight: 350, price: 3.99, producer: 'Fazenda Coração'},
                // {id: 2, name: 'Café Tata', coffeetype: 'Special',  weight: 350, price: 4.99, producer: 'Fazenda Tata'},
                // {id: 3, name: 'Café Ouro', coffeetype: 'Altas Montanhas', weight: 350, price: 4.99, producer: 'Fazenda Ouro'},
                // {id: 4, name: 'Café Montanha', coffeetype: 'Arabica', weight: 350, price: 6.99, producer: 'Fazenda Montanha'},
                // {id: 5, name: 'Café Arabica', coffeetype: 'Robusta', weight: 350, price: 9.99, producer: 'Fazenda Arabica'},
                // {id: 6, name: 'Café Especial', coffeetype: 'Robusta', weight: 350, price: 5.99, producer: 'Fazenda Especial'},
                // {id: 7, name: 'Café Minas', coffeetype: 'Arabica', weight: 350, price: 4.99, producer: 'Fazenda Minas'},
                
            ],

            
        }
    },

    methods:{
        addItem(item){
            var itemQtd = this.qtd;
            var myItem = {id: item.id, name: item.name, weight: item.weight, price: item.price}
            this.cart.push(myItem);
            
            this.qtd = 0;
        },
        removeItem(index){
            //remove the index X from cart
            this.cart.splice(index, 1);
           
        },
        orderByProducer(){  
            var orderByProducer;       
          if(this.orderBy == 0){ 
                 orderByProducer = _.orderBy(this.products, 'producer_id', 'asc');
                 this.orderBy = 1;
          }else {
                  orderByProducer = _.orderBy(this.products, 'producer_id', 'desc');
                  this.orderBy = 0;
          }
          this.products = orderByProducer;
        },
        orderByPrice(){
           var orderByPrice;
           if(this.orderBy == 0){ 
                orderByPrice = _.orderBy(this.products, 'price', 'asc');
                this.orderBy = 1;
           }else{
                 orderByPrice = _.orderBy(this.products, 'price', 'desc');
                 this.orderBy = 0;
           }            
          this.products = orderByPrice;       
        },
        orderByType(){     
            var orderByType;
          if(this.orderBy == 0){              
                 var orderByType = _.orderBy(this.products, 'coffeetype', 'asc');
                 this.orderBy = 1;
          }else {
                  var orderByType = _.orderBy(this.products, 'coffeetype', 'desc');
                  this.orderBy = 0;
          }
          this.products = orderByType;
        },

        //convert string from json to decimal to be able to calculate
        soma(fn) {
            return  new Function('return ' + fn)();
       }

    },
    //get json data from DB
    created(){
          axios.get('/products')
         .then(response => this.products = response.data);
    },
    

    computed:{
        //calculate de total price in the cart
        totalCart: function(){      
            
           //this function only works if the value is string - needs the soma function on methoods
           return this.cart.reduce((acc, item) => acc + this.soma(item.price), 0);
           
           
           //this function only works if the value is not string (it will not work with json format data)      
           //return this.cart.reduce((acc, item) => acc + item.price, 0);

         
       }
    }
}
</script>


<style scoped>
.vitrine, .vitrine-card{
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    padding-right: 5rem;
    padding-bottom: 20px;
    align-items: stretch;
    border-bottom: 5rem;
    

}
.card-img-top{
    width: 15rem;
}
.cart{
    margin-right: 18rem;
    float: right;
}

.sortBy a:hover  {
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
    content: '';
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
    content: '';
    position: absolute;
    right: 0;
    top: 0;

}
</style>

