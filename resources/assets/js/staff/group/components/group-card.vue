<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6 text-right">{{ group.title }}</div>
                    <div class="col-xs-6 text-left">
                        <a class="btn btn-sm btn-primary"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="ویرایش">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a class="btn btn-sm btn-success"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="مشاهده">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="form-horizontal col-xs-4">
                    <div class="form-group">
                        <label class="col-lg-6 col-sm-6 control-label">رشته / پایه</label>
                        <div class="col-lg-6 col-sm-6">
                            <p class="form-control-static">{{ group.level_field.field.title }} / {{ group.level_field.level.title }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-6 col-sm-6 control-label">دانش آموزان</label>
                        <div class="col-lg-6 col-sm-6">
                            <p class="form-control-static">20 نفر</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 multi-image">
                    <a href="#">
                        <img v-for="i in 30"
                             width="40"
                             :src="'http://lorempixel.com/150/150/people/' + i%10"
                             class="img-circle"
                             data-toggle="tooltip"
                             data-placement="bottom"
                             title="احمد حسن زاده">
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{

        props: ['group'],

        data(){
            return{
                msg:'hello vue'
            }
        },

        methods: {
            test: function() {console.log("mounted");}
        }
    }


</script>
