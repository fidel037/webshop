<template>
    <div>
        <h1>Orders</h1>
        <div v-for="(order,index) in allOrders" v-bind:key="index" class="row" v-on:click="info(order)">
            <div class="col-4">
                {{index}}
            </div>
        </div>
        <div v-if="(orderInfo)">
            <div v-for="(oInfo,oindex) in orderInfo" v-bind:key="oindex">
                    {{oInfo.item.name}}
                    {{oInfo.item.price}}
            </div>
        </div>
    </div>
</template>

<script>
import userMixin from '../mixins/user'
export default {
    name: 'payed-orders',
    mixins: [userMixin],
    data() {
        return {
            orders: [],
            orderInfo: false
        }
    },
    computed: {
        allOrders: {
            get() {
                return this.orders
            },
            set(v) {
                this.orders = v
            }
        }
    },
    methods: {
        info(item) {
            this.orderInfo = item
        }
    },
    async created() {
        this.orders = await this.getOrders()
    }
}
</script>