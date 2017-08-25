<script>
    export default {
        data: function () {
            return {
                level_fields: [],
            }
        },
        created: function () {
            this.loadLevelFieldsData();
        },
        methods: {
            loadLevelFieldsData: function () {
                axios.get(route('staff.lookup.level-field.index'))
                    .then(this.onLoadLevelFieldSuccess)
                    .catch(this.onLoadLevelFieldError);
            },
            onLoadLevelFieldSuccess: function (response) {
                this.level_fields = response.data;
            },
            onLoadLevelFieldError: function (error) {
                alert("Oops, Something went wrong!!! \n could not load level_fields data");
                console.log(error.response);
            }
        }
    };
</script>