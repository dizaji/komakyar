<template>
    <div class="container">
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
        methods:{
            loadData(page){
                this.$Progress.start();

                if (typeof page === 'undefined') {
                    page = this.current_page;
                } else {
                    this.current_page = page;
                }

                // Using vue-resource as an example
                axios.get(default_values.routes.resource.index('group'), {
                    params: {
                        page: page
                    }
                }).then(this.onLoadSuccess).catch(this.onError);
            },

            onLoadSuccess(response){
                console.log(response.data);
                this.group = response.data;
                this.$Progress.finish();
            },

            onError(error){
                alert('Oops! Some thing went wrong. :(');
                this.$Progress.fail();
                console.log(error);

            }
        }
    }

</script>
