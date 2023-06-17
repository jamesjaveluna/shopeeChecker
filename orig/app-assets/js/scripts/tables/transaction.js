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
                "sEmptyTable": 'You haven\'t made any transaction yet.'
            },
            ajax: {
                url: '../../../api/panel.php?op=get_user_transaction',
                type: 'POST'
            },
            columns: [
                { data: 'type' },
                { data: 'date' },
                { data: 'provider' },
                { data: 'amount'}
            ],
            columnDefs: [
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        var $type = full['type'];
                        var $action = {
                            1: { title: 'Offers' },
                            2: { title: 'Promotion' },
                            3: { title: 'Admin Change' }
                        };
                        return (
                            $action[$type].title
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
                    // Provider
                    responsivePriority: 1,
                    targets: 2,
                    render: function (data, type, full, meta) {
                        if (full['type'] == 1) {
                            return (
                                '<a href="./offer">'+full['provider']+'</a>'
                            );
                        } else {
                            return (
                                full['provider']
                            );
                        }
                        
                    }
                },
                {
                    // Amount
                    responsivePriority: 2,
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $amount = full['amount'];
                        var $status = {
                            1: { title: 'Increased', class: 'badge-light-success' },
                            2: { title: 'Decreased', class: ' badge-light-danger' },
                            3: { title: 'Unchanged', class: ' badge-light-primary' },
                        };

                        if ($amount.replace(/,/g, '') == 0) {
                            return (
                                '<span class="badge badge-pill ' +
                                $status[3].class +
                                '"><strong> +' +
                                $amount +
                                '</strong></span>'
                            );
                        } else if ($amount.replace(/,/g, '') > 0) {
                            return (
                                '<span class="badge badge-pill ' +
                                $status[1].class +
                                '"><strong> +' +
                                $amount +
                                '</strong></span>'
                            );
                        } else {
                            return (
                                '<span class="badge badge-pill ' +
                                $status[2].class +
                                '"><strong> ' +
                                $amount +
                                '</strong></span>'
                            );
                        }
                        
                    }
                }
            ]
        });
    }

});