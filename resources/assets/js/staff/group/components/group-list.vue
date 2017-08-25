<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">گروه ها</div>
                            <div class="col-xs-6 text-left">
                                <group-create v-on:created="groupCreated"></group-create>
                            </div>
                        </div>
                    </div>
                        <div>

                        </div>
                    <div class="panel-body">
                        <template  v-if="groups">
                            <template v-for="group in groups.data" >
                                <group-card :group="group"></group-card>
                            </template>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <pagination :data="groups" v-on:pagination-change-page="loadData"></pagination>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <vue-progress-bar></vue-progress-bar>
    </div>
</template>
<script>
    import GroupCard from './group-card.vue'
    import GroupCreate from './group-create.vue'
    export default{
        data(){
            return{
                groups: {
                    data: []
                },
                current_page: 1,
            }
        },
        components:{
            GroupCreate,
            'group-card': GroupCard,
            'group-create': GroupCreate,
        },
        created(){
            this.loadData();
        },
        methods:{
            loadData: function(page){
                this.$Progress.start();

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                console.log(default_values.routes);
                // Using vue-resource as an example
                axios.get(route('staff.group.index'), {
                    params: {
                        page: page
                    }
                })
                    .then(this.onLoadSuccess)
                    .catch(this.onLoadError);
            },

            onLoadSuccess: function(response){
                console.log(response.data);
                this.groups = response.data;
                this.$Progress.finish();
            },

            onLoadError: function(error){
                alert('Oops! Some thing went wrong. :(');
                this.$Progress.fail();
                console.log(error);

            },

            groupCreated: function (group) {
                this.groups.data.unshift(group);
            }
        }
    }

</script>
