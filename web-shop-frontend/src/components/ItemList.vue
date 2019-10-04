<template>
    <div class="row">
        <div class="row">
        <div class="card col-3 mt-2" v-for="(item, index) in loadedItems.data" v-bind:key="index">
                <img src="@/assets/stock-vector-no-image-available-icon-template-for-no-image-or-picture-coming-soon-vector-illustration-isolated-1036735678.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{item.name}}</h5>
                    <p class="card-text">{{item.price}}</p>
                    <button v-if="!basket" v-on:click="add(item)" class="btn btn-success">Dodaj u korpu</button>
                    <button v-if="basket" v-on:click="remove(item)" class="btn btn-danger">Izbaci</button>
                </div>
            </div>
        </div>
        <div v-if="loadedItems.prev_page_url || loadedItems.next_page_url" class="row">
            <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" v-on:click="prev()">Previous</a></li>
                        <li class="page-item"><a class="page-link" v-on:click="next()">Next</a></li>
                    </ul>
                </nav>
        </div>
        <div v-if="this.basket && loadedItems.length > 0">
            <button class="btn btn-primary" v-on:click="pay()">Pay</button>
        </div>
    </div>
</template>

<script>
import userMixin from '../mixins/user'
export default {
    name: 'item-list',
    mixins: [userMixin],
    props: ['basket'],
    data(){
        return {
            items: []
        }
    },
    computed: {
        loadedItems: {
            get() {
                return this.items
            },
            set(v) {
                this.items = v
            }
        }
    },
    methods: {
        add(item) {
            this.addToBasket(item)
        },
        async remove(item) {
            this.removeItem(item).then(async () => {
                this.items = await this.getBasket()
                this.items.data = this.items
            })
        },
        async prev() {
            this.items = await this.getItems(this.loadedItems.prev_page_url)
        },
        async next() {
            this.items = await this.getItems(this.loadedItems.next_page_url)
        },
        async pay() {
            await this.payOrder()
            this.items = await this.getBasket()
            this.items.data = this.items
        }
    },
    async created(){
        if (this.basket === true) {
            this.items = await this.getBasket()
            this.items.data = this.items
            return
        }
        this.getBasket()
        this.items = await this.getItems()
    }
}
</script>