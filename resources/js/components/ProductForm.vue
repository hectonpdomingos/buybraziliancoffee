<template>
    <div id="product-form" class="container-fluid">
          
       <h4>To sell products in our marketplace, you need to register them in this form</h4>
        <form @submit.prevent="handleSubmit" enctype="multipart/form-data; charset=utf-8">

             <div class="row">
                  
                 <div class="col-md-6">
                <label for="name">Nome</label>
                <input type="text" v-model="product.name" name="name" id="name" class="form-control" placeholder="Examplo: Café coração de Minas">
                  </div>
                   <div class=" col-md-2">
                <label for="weight">Peso</label>
                <input type="text" v-model="product.weight" name="weight" id="weight" class="form-control">
                   </div>
                    <div class=" col-md-4">
                <label for="type">Tipo</label>
                <input type="text" v-model="product.coffeetype" name="coffeetype" id="coffeetype" class="form-control" placeholder="Examplo: Serrado">
                 </div>
            </div>
             <div class="row">
                 <div class="col-md-4">
                  <label for="eancode">Código EAN</label>
                <input type="text" v-model="product.ean" name="ean" id="ean" class="form-control">
                </div>
                <div class="col-md-4">
                  <label for="producercode">Código Produtor</label>
                <input type="text" v-model="product.product_code" name="product_code" id="product_code" class="form-control">
                </div>
                <div class="col-md-2">
                  <label for="price">Preço</label>
                <input type="text" v-model="product.price" name="price" id="price" class="form-control">
                </div>
                <div class="col-md-2">
                  <label for="stock">Estoque</label>
                <input type="text" v-model="product.stock" name="stock" id="stock" class="form-control">
                </div>    
               
            </div>
            <div class="row">
                 <div class="col-md-3">
                  <label for="photo">Foto</label>
                 <input type="file" @change="uploadPhoto" name="photo" class="form-control-file" id="photo">
                </div>
                    
            </div>
             <div class="row">
                 <div class="col-md-6">
                  <label for="aboutcoffee">Sobre o Café</label>
                <textarea rows="4" v-model="product.about_coffee" cols="50" name="about_coffee" id="about_coffee" class="form-control">
                </textarea>    
                </div>
                    
            </div>
            <div class="row">
                <div class="col">
               <button class="btn btn-success" type="submit">Adicionar Produto</button>
               </div>
            </div>
        </form>



         <p v-if="errors.length == 0">
            <b>Please correct the following error(s):</b>
            <ul>
            <li v-for="(error, index) in errors" v-bind:key="index">{{ error[index] }}</li>
            </ul>
        </p>
       
        </div>
</template>

<script>

export default {
    name: 'product-form',
    data () {
       return {
       
            errors: [],
            photo: null,
            product: {
                    name: '',
                    weight: '',
                    coffeetype: '',
                    ean: '',
                    product_code: '',
                    price: '',
                    stock: '',                    
                    about_coffee: ''
         }
       }
    },
    methods: {
    uploadPhoto(e){
                console.log(e.target.files[0]);
                this.photo = e.target.files[0];

    },    
    handleSubmit(e) {
       
      e.preventDefault();
        let currentObj = this;
        const config = {
            headers: { 'content-type': 'multipart/form-data' }
        }
        let formData = new FormData();        
        formData.append('photo', this.photo);
        formData.append('name', this.product.name);
        formData.append('weight', this.product.weight);
        formData.append('coffeetype', this.product.coffeetype);
        formData.append('ean', this.product.ean);
        formData.append('product_code', this.product.product_code);
        formData.append('price', this.product.price);
        formData.append('stock', this.product.stock);
        formData.append('about_coffee', this.product.about_coffee);

        axios.post('/form-product/', formData, config)       
       .then(function (response) {
            return (response)
          })
          .catch(function (error) {
                console.log(error.response);
          });
       
       
    },
  },
    
}
</script>


<style scoped>

form {
    margin-bottom: 2rem;
}
</style>
