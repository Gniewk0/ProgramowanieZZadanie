<template>
    <div class="modback">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col pt-1">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <slot></slot>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="row mb-4">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nazwa" v-model="name">
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" v-model="date">
                            </div>
                        </div>
                        <form class="d-flex justify-content-center" v-on:submit.prevent>
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInput">Produkt</label>
                                    <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Produkt" v-model="new_product">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary mb-3" @click="addProducktToList">Dodaj</button>
                                </div>
                            </div>
                        </form>

                        <ul class="list-group mx-2">
                            <li class="list-group-item" v-for="(product, index) in list" :key="index">
                                {{product}}
                                <button type="button" class="btn btn-secondary float-right btn-sm" @click="deleteProduct(product)">X</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="$emit('close')">
                        zamknij
                    </button>
                    <button type="button" class="btn btn-secondary" @click="postList()">
                        <slot></slot>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                new_product: '',
                list: [],
                name: '',
                date: ''
            }
        },
        mounted() {
            if(this.modalEditId){
                console.log('wbijam do funkcji')
                this.date = this.modalEditDate
                this.name = this.modalEditName
                for(var i=0; i<this.mainlist.length; i++){
                    console.log('wbijam do pętli')
                    if(this.mainlist[i].id == this.modalEditId){
                        for(var j=0; j<this.mainlist[i].listitem.length; j++){
                            this.list.push(this.mainlist[i].listitem[j].product_name)
                        }
                    }
                }
            }else if(this.modaldata) {
                this.list = this.modaldata
            }
        },
        props: {
            modalEditId: Number,
            modalEditName: String,
            modalEditDate: String,
            modaldata: Array
        },
        computed: {
            mainlist: {
                get () {
                    return this.$store.getters.getList
                },
                set (value) {
                    this.$store.commit('getList', value);
                }
            },
        },
        watch: {
        },
        methods: {
            emitMethod() {
                this.$emit('close')
            },
            addProducktToList(){
                this.list.push(this.new_product)
                this.new_product = ''
            },
            deleteProduct(product){
                for( var i = 0; i < this.list.length; i++){
                    if ( this.list[i] === product) {
                        this.list.splice(i, 1);
                    }
                }
            },
            postList(){
                if(!this.modalEditId){
                    axios.post('/list', { list: this.list, name: this.name, date: this.date })
                        .then(response => this.emitMethod())
                        .catch(error => console.log(error.response.data));
                }else{
                    axios.put('/list', { id: this.modalEditId, list: this.list, name: this.name, date: this.date })
                        .then(response => this.emitMethod())
                        .catch(error => console.log(error.response.data));
                }
            },
        }
    }
</script>

<style scoped>
    .modback{
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: scroll; /* Enable scroll if needed */
        background-color: rgb(0,0,0)!important; /* Fallback color */
        background-color: rgba(0,0,0,0.3)!important; /* Black w/ opacity */
    }

    .spinner{
        position: absolute;
        z-index: 1;
        left: 47%;
        top: 40%;
    }

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(228, 226, 226, 0.548);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 900px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(247, 247, 247, 0.089);
        transition: all 0.3s ease;
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
