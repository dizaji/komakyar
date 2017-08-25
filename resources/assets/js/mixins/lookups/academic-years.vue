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
                console.log("here");
                console.log(this.$root.ac_loaded);
                if(this.$root.ac_loaded === false) {
                    alert(0);
                }
                this.$root.ac_loaded = true;
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