<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6 text-right">{{ group.title }}</div>
                    <div class="col-xs-6 text-left">
                        <a :href="url.show"
                           class="btn btn-sm btn-success"
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
                        <label class="col-lg-6 col-sm-6 control-label">پایه</label>
                        <div class="col-lg-6 col-sm-6">
                            <p class="form-control-static">{{ group.level_field.level.title }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-6 col-sm-6 control-label">رشته</label>
                        <div class="col-lg-6 col-sm-6">
                            <p class="form-control-static">{{ group.level_field.field.title }}</p>
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

                    <a v-for="student in group.students" :href="studentUrl(student)">
                        <img width="40"
                             :src="profilePictureUrl(student.user.profile_picture)"
                             class="img-circle"
                             data-toggle="tooltip"
                             data-placement="bottom"
                             :title="student.user.first_name + ' ' + student.user.surname">
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['group'],

        data() {
            return {}
        },
        computed: {
            url: function () {
                return {
                    show: route('staff.group.show', {group: this.group.id}),
                }
            }
        },
        methods: {
            studentUrl(student) {
                return route('staff.student.show', {student: student.id})
            },
            profilePictureUrl: function (profile_picture) {
                if (profile_picture) {
                    if(window.isValidURL(profile_picture)) {
                        return profile_picture;
                    } else {
                        return window.default_values.storage_base_url + profile_picture;
                    }
                } else {
                    return window.default_values.defaults.dp;
                }
            },
        }
    }


</script>
