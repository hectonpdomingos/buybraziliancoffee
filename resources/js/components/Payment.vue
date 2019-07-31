<template>
      <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
             
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              
            <form action="/purchase/{purchase}" method="PATCH">   
            <!-- {{ getItems }} -->
            
            <h1>Total: {{ total }}</h1>
            <stripe-checkout
                stripe-key="pk_test_cwyFNXgdnhj1ZTyhNLfLqSgy"
                 :product="products"
                 :total="total"
                 >
            </stripe-checkout>
            </form>

            </slot>
         </div>
        
        
          <div class="modal-footer">
            <slot name="footer">
              
              <button class="modal-default-button btn btn-danger" @click="$emit('close')">
                Cancel
              </button>
            </slot>
          </div>
        </div>
       </div>
      </div>
  
  </transition>
</template>


<script>

import { mapGetters, mapActions } from 'vuex'
export default {
  

  data () {
    return {
       csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
       products:[
            {
                id:1,
                name:'Product A',
                description:'Product A Description',
                amount: 10000
            }
        ]     
    }
  }, 
  computed: {
    total() {
        return this.$store.getters.getTotalFromController;
    },
    // getItems (){
    //   return this.$store.getters.items;
    // }
  }
}
</script>

<style scoped>
    .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 600px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>
