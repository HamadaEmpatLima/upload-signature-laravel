<script>
    function setErrors(error, form) {
        let errors = error.response.data.errors;
        let keys = Object.keys(errors);
        keys.forEach(function(key) {
            $(form).find('#' + key).addClass('is-invalid');
            $(form).find('#' + key + '-invalid-feedback').html(errors[key]);
        });
    }

    function resetErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').empty();
    }
</script>
