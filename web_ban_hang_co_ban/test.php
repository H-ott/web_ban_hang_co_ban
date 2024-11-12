<html>
    <form action="">
        Fill: 
        <input type="text" name="ten" id="ten">
    </form>
    <div id="ket_qua"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#ten").keydown(function () { 
                let ten = $(this).val();
                $("#ket_qua").text('Ban da dien: ' + ten);
            });
        });
    </script>
</html>