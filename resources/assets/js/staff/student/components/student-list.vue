<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">لیست دانش آموزان</div>
                    <div class="panel-body">

                        <template v-for="i in 25" >
                            <student-card></student-card>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import StudentCard from './student-card.vue'
    export default{
        data(){
            return{
                groups: JSON.parse(this.initialGroups)
            }
        },
        components:{
            StudentCard,
            'student-card': StudentCard,
        }
    }

</script>
