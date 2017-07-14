<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <group-card></group-card>
                    </div>
                </div>
            </div>
        </div>
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
