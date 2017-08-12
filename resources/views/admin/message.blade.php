<div class="alert alert-danger" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <ul>

        <li> error</li>

    </ul>
</div>

<div class="alert alert-success" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>
        <i class="fa fa-check-circle fa-lg fa-fw"></i>
    </strong>
    success
</div>

<div class="alert alert-info" style="display: none;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>
        <i class="fa fa-check-circle fa-lg fa-fw"></i>
    </strong>
    success
</div>

<script type="text/javascript">
    function success(msg) {
        $('.alert-success').text(msg).fadeIn(1000,function () {
            $(this).fadeOut(1000);
        });
    }

    function fail(msg) {
        $('.alert-danger').text(msg).fadeIn(1000,function () {
            $(this).fadeOut(1000);
        });
    }

    function info(msg) {
        $('.alert-info').text(msg).fadeIn(1000,function () {
            $(this).fadeOut(1000);
        });
    }
</script>