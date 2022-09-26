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

    $(document).ready( function () {
        $('#myTable').DataTable();
        $('input[name="periode"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="periode"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="periode"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    } );
    
    </script>

</html>

</body>

</html>
