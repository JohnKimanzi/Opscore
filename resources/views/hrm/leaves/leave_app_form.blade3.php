<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Bootstrap Date Time Picker Example</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css"> -->


</head>

<body>
    <div class="form-group">
        <div class='input-group date' id='CalendarDateTime'>
        <input type='text' class="form-control" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>
</body>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> -->

    <script>
        $(function () {
            $('input[name="datetime"]').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                startDate: moment().startOf('day'),
                endDate: moment().startOf('day').add(24, 'hours'),
                locale: {
                    format: 'MM/DD/YYYY HH:mm'
                }
            });
        });
    </script>
</html>
