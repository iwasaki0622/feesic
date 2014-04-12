<input type="submit" value="うりゃっ！" onclick="loadFeeling()">

<script type="text/javascript">

function loadFeeling() {
    $.ajax({
        url: "/api/index",
        type: "POST",
        success: function (result) {
            		console.log(result);
        },
    });
}

</script>