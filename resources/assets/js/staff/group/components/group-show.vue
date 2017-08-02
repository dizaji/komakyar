<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 float-none">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">گروه شماره 101</div>
                            <div class="col-xs-6 text-left">
                                <a class="btn btn-sm btn-primary"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   title="ویرایش">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="form-horizontal">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-lg-6 col-sm-6 control-label">رشته / پایه</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <p class="form-control-static">ریاضی / سوم دبیرستان</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="col-lg-6 col-sm-6 control-label">دانش آموزان</label>
                                    <div class="col-lg-6 col-sm-6">
                                        <p class="form-control-static">20 نفر</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h3>دانش آموزان</h3>
                        <student-card></student-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import StudentCard from '../../student/components/student-card.vue'

    export default {

        props: ['initialGroups'],

        data() {
            return {
                groups: null
            }
        },
        components: {
            'student-card': StudentCard,
        }
    }

</script>
