<template>
    <div>
        <div id="accordion" class="mx-5 px-5">
            <div class="card" v-for="list in lists" :key="list.id">
                <div class="card-header" v-bind:id="'heading'+list.id">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" v-bind:data-target="'#collapse'+list.id" v-bind:aria-controls="'collapse'+list.id">
                            {{list.name}}
                        </button>
                    </h5>
                </div>

                <div v-bind:id="'collapse'+list.id" class="collapse" v-bind:aria-labelledby="'heading'+list.id" data-parent="#accordion">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(product, index) in list.listitem" :key="index">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    v-bind:true-value="1"
                                    v-bind:false-value="0"
                                    v-model="product.is_bought"
                                    v-bind:id="'Check'+list.id"
                                    :disabled="disabledCheckbox"
                                    @change="handleUpdate(product)"
                                >
                                <label class="form-check-label"  v-bind:for="'Check'+list.id" v-bind:class="{ line_through: product.is_bought }">
                                    {{product.product_name}}
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    // import Magicbutton from './Magicbutton';
    export default {
        data(){
            return {
                new_product: '',
                lists: [],
                disabledCheckbox: false,
            }
        },
        compnts: {
            // Magicbutton
        },
        mounted() {
            this.getLists();
        },
        computed: {
        },
        watch: {
        },
        methods: {
            handleUpdate(product){
                this.disabledCheckbox = true
                axios.put('/product', { product: product})
                    .then(response => this.disabledCheckbox = false)
                    .catch(error => this.errors.record(error.response.data));
            },
            AddProducktToList(){
                this.list.push(this.new_product)
                this.new_product = ''
            },
            DeleteProduct(product){
                for( var i = 0; i < this.list.length; i++){
                    if ( this.list[i] === product) {
                        this.list.splice(i, 1);
                    }
                }
            },
            getLists(){
                axios.get('/list')
                    .then(response => this.lists = response.data)
                    .catch(error => this.errors.record(error.response.data));
            },
        }
    }
</script>

<style scoped>
    .line_through{
        text-decoration: line-through;
    }
</style>
