<template>
    <div>
        <div id="accordion" class="mx-5 px-5">
            <div class="card my-2" v-for="list in lists" :key="list.id">
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
                                    <a class="dropdown-item" href="#" @click="Delete(list.id)">usuń</a>
                                </div>
                            </div>
                        </div>
                    </h5>
                </div>

                <div v-bind:id="'collapse'+list.id" class="collapse" v-bind:aria-labelledby="'heading'+list.id" data-parent="#accordion">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="(product, index) in list.listitem" :key="index">
                            <div class="form-check">
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
    export default {
        data(){
            return {
                new_product: '',
                lists: [],
                disabledCheckbox: false,
            }
        },
        compnts: {
        },
        mounted() {
            this.getArchiveLists();
        },
        computed: {
        },
        watch: {
        },
        methods: {
            getArchiveLists(){
                axios.get('/archivelist')
                    .then(response => this.lists = response.data)
                    .catch(error => this.errors.record(error.response.data));
            },
            Delete(id){
                if(confirm("Czy na pewno chcesz usunąć liste ?")){
                    axios.delete('/list', {data: {id: id}})
                        .then(response => this.getArchiveLists())
                        .catch(error => this.errors.record(error.response.data));
                }
            }
        }
    }
</script>
