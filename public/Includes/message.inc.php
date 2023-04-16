<?php if (isset($_GET['message'])) { ?>
<div class="m-5" id="message">
    <div class="p-2 text-center text-white 
                rounded-md border-2 bg-green-500 
                flex flex-row gap-5 align-center justify-center"
    >
        <p><?php echo $_GET['message'] ?></p>
        <i id="toggle-message" class="bi bi-x-lg"></i>
    </div>
</div>
<?php } ?>