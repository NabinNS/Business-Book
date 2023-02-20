<!DOCTYPE html>
<html lang="en">

<head>
    <title>Practise</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width = device-width, initial-scale = 1" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <select class="js-example-basic-single" name="state">
        <option value="AL">Alabama</option>
        ...
        <option value="WY">Wyoming</option>
    </select>

    <script>
        // $(document).ready(function() {

        // });
        // In your Javascript (external .js resource or <script> tag)

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            // Open/Close select options
            $("#input-field").on("focus", function() {
                $("#select-options").show();
            });
            $("#input-field").on("blur", function() {

                $("#select-options").hide();

            });
            // $("#input-field").click(function () {
            //   $("#select-options").toggle();
            // });

            // Set selected value to input field
            $("#select-options li").click(function() {
                var value = $(this).attr("data-value");
                $("#input-field").val(value);
                $("#select-options").hide();
            });

            $("#input-field").on("input", function() {
                var search = $(this).val().toLowerCase();
                $("#select-options li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1);
                });
            });
        });
    </script>
    </body>

</html>
