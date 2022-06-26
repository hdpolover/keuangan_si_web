            </div>
            
        </div><!-- Page Content -->
    </div>
</body>
	<script type="text/javascript" src="<?= base_url();?>assets/js/alpha.min.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/js/pages/dashboard.js"></script>

    <script>
    $('form').submit(function(event) {
        $('#send-button').prop("disabled", true);
        // add spinner to button
        $('#send-button').html(
            `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...`
        );
        return;
    });
    
    </script>

</html>

</body>

</html>
