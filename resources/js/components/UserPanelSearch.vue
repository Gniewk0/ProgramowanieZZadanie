<template>
    <div>
        <transition name="fade" mode="out-in">
            <ListModal v-if="showEdit" @close="showEdit = false" id="exampleModal" :modalEditId="modalEditId" :modalEditName="modalEditName" :modalEditDate="modalEditDate">
                Edytuj Liste
            </ListModal>
        </transition>
        <div id="accordion" class="mx-5 px-5">
            <div class="card my-2" v-for="list in mainlist" :key="list.id">
                <div class="card-header" v-bind:id="'heading'+list.id">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" v-bind:data-target="'#collapse'+list.id" v-bind:aria-controls="'collapse'+list.id">
                            {{list.name}}  -  {{list.date}}
                        </button>
                        <div class="float-right">
                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#" @click="AddToArchive(list.id)">zarchiwizuj</a>
                                    <!-- <a class="dropdown-item" href="#" @click="modalEditId = list.id, modalEditName = list.name, modalEditDate = list.date, showEdit = true">edytuj</a> -->
                                    <a class="dropdown-item disabled" href="#" @click="AlertMethod()">edytuj</a>
                                </div>
                            </div>
                        </div>
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
                                    v-bind:id="'Check'+product.id"
                                    :disabled="disabledCheckbox"
                                    @change="handleUpdate(product)"
                                >
                                <label
                                    class="form-check-label"
                                    v-bind:for="'Check'+product.id"
                                    disabled
                                    v-bind:class="{ line_through: product.is_bought }"
                                    @change="handleUpdate(product)"
                                >
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
    import store from "../store"
    import ListModal from './UserPanelListModal';
    export default {
        data(){
            return {
                mainlist: [],
                disabledCheckbox: false,
                showEdit: false,
                modalEditId: '',
            }
        },
        components: {
            ListModal,
        },
        props: {
            value: String,
        },
        mounted() {
            this.Search();
        },
        methods: {
            Search(){
                axios.get('/search', { params: { data: this.value }})
                    .then(response => this.mainlist = response.data)
                    .catch(error => this.errors.record(error.response.data));
            },
            AlertMethod(){
                alert('Opcja edycji jest czasowo niedostępna, proszę usunąć listę i stworzyć nową')
            },
            handleUpdate(product){
                this.disabledCheckbox = true
                axios.put('/product', { product: product})
                    .then(response => this.disabledCheckbox = false)
                    .catch(error => this.errors.record(error.response.data));
            },
            AddToArchive(id){
                axios.post('/archivelist', {id: id})
                    .then(response => this.Search())
                    .catch(error => this.errors.record(error.response.data));
            }
        }
    }
</script>

<style scoped>
    .line_through{
        text-decoration: line-through;
    }
</style>
