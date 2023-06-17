/**
 * DataTables Basic
 */

$(function () {
    'use strict';

    var dt_basic_table = $('.datatables-basic'),
        btnHome = $('.btn-home'),
        btnTransaction = $('.btn-transaction'),
        btnWithdrawal = $('.btn-withdrawal'),
        btnOffer = $('.btn-offer'),
        btnReferral = $('.btn-referral'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }

    btnHome.on('click', function () {
        window.location.href = "home";
    });

    btnTransaction.on('click', function () {
        window.location.href = "transaction";
    });

    btnWithdrawal.on('click', function () {
        window.location.href = "withdrawal";
    });

    btnOffer.on('click', function () {
        window.location.href = "offer";
    });

    btnHome.on('click', function () {
        window.location.href = "referral";
    });


    if (dt_basic_table.length) {
        var dt_basic = dt_basic_table.DataTable({
            responsive: true,
            "oLanguage": {
                "sEmptyTable": 'You haven\'t completed any offers yet.'
            },
            ajax: {
                url: '../../../api/panel.php?op=get_user_offers',
                type: 'POST'
            },
            columns: [
                { data: 'id' },
                { data: 'date' },
                { data: 'offer_name' },
                { data: 'amount'}
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return (
                            full['id']
                        );
                    }
                },
                {
                    // Date
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return (
                            full['date']
                        );
                    }
                },
                {
                    targets: 2,
                    responsivePriority: 1,
                    render: function (data, type, full, meta) {
                        var $user_img = null,
                            $name = full['offer_name'],
                            $post = full['provider'];
                       
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate font-weight-bold">' +
                            $name +
                            '</span>' +
                            '<small class="emp_post text-truncate text-muted"> Provider: <strong>' +
                            $post +
                            '</strong></small>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    // Amount
                    responsivePriority: 2,
                    targets: 3,
                    render: function (data, type, full, meta) {
                            return (
                                '<img src="../../../app-assets/images/ico/coins-16.png" draggable="false" alt="Points">'+
                                '' +
                                '<strong> +' +
                                full['amount'] +
                                '</strong>'
                            );
                    }
                }
            ]
        });
    }

});