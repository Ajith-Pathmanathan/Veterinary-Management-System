<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Dashboard - NiceAdmin Bootstrap Template</title>
<meta content="" name="description">
<meta content="" name="keywords">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    /* Change the color of the validation error message */
    .parsley-errors-list {
        color: red; /* Change this to any color you want */
        font-size: 14px;
        margin-top: 5px;
    }

    /* Change the border color of valid and invalid fields */
    input.parsley-success, select.parsley-success, textarea.parsley-success {
        border-color: green !important;
    }

    input.parsley-error, select.parsley-error, textarea.parsley-error {
        border-color: red !important;
    }

    /* Remove bullet points from error messages */
    .parsley-errors-list li {
        list-style: none;
    }
</style>


