<template>
    <div>
        <group-card></group-card>
    </div>
</template>
<script>
    import GroupCard from './group-card.vue'
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
        components:{
            'group-card': GroupCard,
        }
    }

</script>
