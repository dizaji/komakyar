<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-8 text-right">سوم ریاضی</div>
                    <div class="col-sm-4 text-left">
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
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left">رشته / پایه</label>
                        <div class="col-sm-9 pull-right">
                            <p class="form-control-static text-right">ریاضی / سوم دبیرستان</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">تعداد دانش آموزان</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">20 نفر</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        },
    }

</script>
