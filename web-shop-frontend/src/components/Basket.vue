<template>
    <div>
        <item-list :basket="true"></item-list>
    </div>
</template>

<script>
import ItemList from './ItemList'
import userMixin from '../mixins/user'
export default {
    name:'basket',
    components: {ItemList},
    mixins: [userMixin],
}
</script>