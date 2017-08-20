<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">لیست دانش آموزان</div>
                    <div class="panel-body">
                        <template v-if="students">
                            <template v-for="student in students.data" >
                                <student-card :student="student"></student-card>
                            </template>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <pagination :data="students" v-on:pagination-change-page="loadData"></pagination>
                                </div>
                            </div>
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
                students: null,
                current_page: 1,
            }
        },
        components:{
            'student-card': StudentCard,
        },
        created: function () {
            this.loadData();
        },
        methods:{
            loadData: function (page) {
                this.$Progress.start();
                this.parents = null;

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                // Using vue-resource as an example
                axios.get(route('staff.student.index'), {
                    params: {
                        page: page
                    }
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onError);
            },
            onLoadSuccess(response) {
                this.students = response.data;
                this.$Progress.finish();
            },
            onError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },
        }
    }

</script>
