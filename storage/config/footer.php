<footer class="main-footer">
    
</footer>

<?php 
$message = '';
if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<script>
    let message = '';
    message = '<?php echo $message;?>';
    
    $(document).ready(function() {
        //alert('hello');
        $('[data-toggle=confirmation]').confirmation();
        
        if(message !== '') {
            showCustomMessage("Information!", message, "success");
        }
        
        $("input[type=text]").blur(function() {
            let data = $(this).val().trim();
            $(this).val(data);
        });
        
    });
    //https://lipis.github.io/bootstrap-sweetalert/
</script>