<script>
    export default {
        data: function () {
            return {
                academic_years: [],
            }
        },
        created: function () {
            this.loadAcademicYearsData();
        },
        methods: {
            loadAcademicYearsData: function () {
                axios.get(route('staff.lookup.academic-year.index'))
                    .then(this.onLoadAcademicYearSuccess)
                    .catch(this.onLoadAcademicYear);
            },
            onLoadAcademicYearSuccess: function (response) {
                this.academic_years = response.data;
            },
            onLoadAcademicYear: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!! \n could not load academic years data");
                console.log(error.response);
            }
        }
    };
</script>