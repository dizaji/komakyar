<template>
    <div class="container" v-if="groups">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                        <div>

                        </div>
                    <div class="panel-body">
                        <template v-for="group in groups.data" >
                            <group-card :group="group"></group-card>
                        </template>
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
                groups: null,
            }
        },
        components:{
            'group-card': GroupCard,
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
                    .catch(this.onError);
            },

            onLoadSuccess: function(response){
                console.log(response.data);
                this.groups = response.data;
                this.$Progress.finish();
            },

            onError: function(error){
                alert('Oops! Some thing went wrong. :(');
                this.$Progress.fail();
                console.log(error);

            }
        }
    }

</script>
