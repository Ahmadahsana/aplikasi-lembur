<style type="text/css">
    .bootstrap-timepicker-meridian,
    .meridian-column {
        display: none;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery.min.js "></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.time').timepicker({
            showMeridian: false,
            showInputs: true
        });
    });
</script>
<input id="timepicker" class="time" type="text">
<input id="timepicker4" class="time" type="text">