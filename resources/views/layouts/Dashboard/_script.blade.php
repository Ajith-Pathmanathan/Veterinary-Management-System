<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Load jQuery First -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    $(document).ready(function () {
        // Add custom Parsley validator for NIC uniqueness
        window.Parsley.addValidator('nicExists', {
            validateString: function (value) {
                return $.ajax({
                    url: '{{ url("/checkNIC") }}',
                    type: 'GET',
                    data: {national_id: value},
                }).then(function (response) {
                    console.log(response);
                    return !response.exists; // Returns false if NIC exists
                });
            },
            messages: {
                en: 'Not registered NIC number!',
            }
        });

        // Initialize Parsley
        $('#yourFormId').parsley();
    });
</script>
<script>
    let rowCount = 1;

    function addRow() {
        const tableBody = document.querySelector("#test-details-table tbody");
        const newRow = document.createElement("tr");

        newRow.innerHTML = `
            <td><input type="text" name="test_details[${rowCount}][key]" class="form-control" required></td>
            <td><input type="text" name="test_details[${rowCount}][value]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>
        `;

        tableBody.appendChild(newRow);
        rowCount++;
    }

    function removeRow(button) {
        button.closest("tr").remove();
    }
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action will permanently delete the record!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>









