<template>
<div>
    <transition name="fade" mode="out-in">
        <ListModal v-if="showModal" @close="showModal = false" id="exampleModal"></ListModal>
    </transition>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="btn btn-outline-secondary mx-2 my-sm-0" :to="{ name: 'Index'}">
                        <span>Aktualne listy</span>
                    </router-link>
                    <!-- <button class="btn btn-outline-secondary mx-2 my-sm-0" >Lista</button> -->
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-secondary mx-2 my-sm-0" @click="showModal = true">Dodaj liste</button>
                </li>
                <li class="nav-item">
                    <router-link class="btn btn-outline-secondary mx-2 my-sm-0" :to="{ name: 'Archive'}">
                        <span>Archiwum</span>
                    </router-link>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 py-2">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Szukaj</button>
            </form>
        </div>
    </nav>
    <div class="px-2 py-2">
        <!-- <List></List> -->
        <transition name="fade" mode="out-in">
           <router-view></router-view>
        </transition>
    </div>
</div>
</template>

<script>
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import router from '../router'
    import ListModal from './UserPanelListModal';
    export default {
        data(){
            return {
                showModal: false,
            }
        },
        components: {
            ListModal,
        },
        mounted() {
            router.push({name: 'Index'}).catch(()=>{});
        },
        watch: {
            showModal(newVal, oldVal) {
                if(newVal == false){
                    this.$store.commit('getData', newVal);
                }
            }
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
