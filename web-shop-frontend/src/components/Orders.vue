<template>
    <div>
        <h1>Orders</h1>

        <div class="row">
            <div class="col-6">
                <table class="table table-dark">
                    <tr>
                        <th>Broj Narudzbine</th>
                    </tr>
                    <tbody>
                        <tr v-for="(order,index) in allOrders" v-bind:key="index" v-on:click="info(order)">
                            {{index}}
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-dark">
                    <tr>
                        <th>Naziv proizvoda</th>
                        <th>Cena</th>
                    </tr>
                    <tbody v-if="(orderInfo)">
                        <tr v-for="(oInfo,oindex) in orderInfo" v-bind:key="oindex">
                            <td>{{oInfo.item.name}}</td>
                            <td>{{oInfo.item.price}}</td>
                        </tr>
                        <tr>
                            <td>Ukupno: {{total}}</td>
                        </tr>
                    </tbody>
                </table>
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
        },
        total: {
            get() {
                let total = 0;
                for (let index = 0; index < this.orderInfo.length; index++) {
                    total += parseFloat(this.orderInfo[index].item.price)
                }
                return parseFloat(total).toFixed(2)
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