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
            <li class="list-group-item" v-for="product in list" :key="product">{{product}}</li>
        </ul>
    </div>
</template>

<script>
    // import Magicbutton from './Magicbutton';
    export default {
        data(){
            return {
                new_product: '',
                list: ['papryka','pomidor','ogórek','placki','kukurydza','kurczak'],
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
            getText(){
                axios.get('/usertextget', { textarea: this.textarea })
                    .then(response => this.textarea = response.data[0])
                    .catch(error => this.errors.record(error.response.data));
            },
        }
    }
</script>
