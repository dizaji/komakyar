<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-sm-3 col-xs-4 text-center">

                    <img width="100%"
                         src="http://lorempixel.com/150/150/people/"
                         class="img-circle">

                    <h4>احمد حسن زاده</h4>
                    <div>
                        <a href="#"
                           class="test-actual"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="مشاهده">
                            <span class="glyphicon glyphicon-eye-open text-info"></span>
                        </a>
                        <a href="#"
                           class="test-actual"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="ویرایش">
                            <span class="glyphicon glyphicon-pencil text-pimary"></span>
                        </a>
                        <a href="#"
                           class="test-actual"
                           data-toggle="tooltip"
                           data-placement="bottom"
                           title="حدف">
                            <span class="glyphicon glyphicon-remove text-danger"></span>
                        </a>
                    </div>
                </div>
                <div class="form-horizontal col-sm-9 col-xs-6">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">نام کاربری</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">a.hasanzadeh@nourinik.ir</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label"
                               data-toggle="tooltip"
                               data-placement="bottom"
                               title="شماره دانش آموزی">شماره د.آ</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">05413287987</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">کد ملی</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">05413287987</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">تلفن</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">05413287987</p>
                        </div>
                    </div>
                    <div class="form-group hidden-sm hidden-xs">
                        <div class="col-md-2 col-sm-3 col-xs-4 control-label">آدرس</div>
                        <div class="col-md-10 col-sm-9 col-xs-8">
                            <p class="form-control-static">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad aliquid debitis, distinctio dolore doloremque dolores dolorum itaque laborum natus perspiciatis sapiente, sed ullam vero voluptatibus? Delectus distinctio nam quo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['group'],

        data() {
            return {
                msg: 'hello vue'
            }
        },

        methods: {
            test: function () {
                console.log("mounted");
            }
        }
    }


</script>
