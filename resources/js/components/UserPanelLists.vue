<template>
    <div>
        <form class="d-flex justify-content-center" v-on:submit.prevent>
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInput">Produkt</label>
                    <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Produkt" v-model="new_product">
                </div>
                <!-- <div class="col-2">
                    <label class="sr-only" for="inlineFormInput">ilość</label>
                    <input type="number" class="form-control mb-2" id="inlineFormInput" placeholder="ilość">
                </div> -->
                <div class="col-auto">
                    <button class="btn btn-primary mb-2" @click="AddProducktToList">Dodaj</button>
                </div>
            </div>
        </form>

        <ul class="list-group mx-5 px-5">
            <li class="list-group-item" v-for="list in lists" :key="list">{{list}}
                <button type="button" class="btn btn-secondary float-right" @click="EditList(list)">Edit</button>
                <button type="button" class="btn btn-secondary float-right" @click="DeleteList(list)">X</button>
            </li>
        </ul>
    </div>
</template>

<script>
    // import Magicbutton from './Magicbutton';
    export default {
        data(){
            return {
                new_product: '',
                list: [],
            }
        },
        components: {
            // Magicbutton
        },
        mounted() {
        },
        computed: {
        },
        watch: {
        },
        methods: {
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
            getText(){
                axios.get('/usertextget', { textarea: this.textarea })
                    .then(response => this.textarea = response.data[0])
                    .catch(error => this.errors.record(error.response.data));
            },
        }
    }
</script>
