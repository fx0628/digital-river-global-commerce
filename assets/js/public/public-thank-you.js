import CheckoutUtils from './checkout-utils';

const ThankYouModule = {};

jQuery(document).ready(($) => {
    if ($('.dr-thank-you-wrapper').length) {
        $(document).on('click', '#print-button', function() {
            var printContents = $('.dr-thank-you-wrapper').html();
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        });

        const digitalriverjs = new DigitalRiver(drgc_params.digitalRiverKey);
        CheckoutUtils.applyLegalLinks(digitalriverjs);

        $(document).on('click', '#my-subs-btn', () => {
            window.location.href = drgc_params.mySubsUrl;
        });
    }
});

export default ThankYouModule;
