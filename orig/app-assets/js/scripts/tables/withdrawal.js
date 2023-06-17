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
                "sEmptyTable": 'You haven\'t made any withdrawals yet.'
            },
            ajax: {
                url: '../../../api/panel.php?op=get_user_withdrawals',
                type: 'POST'
            },
            columns: [
                { data: 'id' },
                { data: 'date' },
                { data: 'itemID' },
                { data: 'status' },
                { data: 'amount'}
            ],
            columnDefs: [
                {
                    // ID
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
                        var $user_img = full['img'],
                            $name = full['figure'] +' ' + full['name'],
                            $post = full['quantity'];
                        if ($user_img) {
                            // For Avatar image
                            var $output =
                                '<img src="' + assetPath + 'images/pages/eCommerce/' + $user_img + '" alt="Avatar" width="32" height="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = 1;
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = full['name'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + '</span>';
                        }

                        var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate font-weight-bold">' +
                            $name +
                            '</span>' +
                            '<small class="emp_post text-truncate text-muted"> Quantity: <strong>' +
                            $post +
                            'x</strong></small>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
               
                {
                    responsivePriority: 3,
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return (
                            '<img src="../../../app-assets/images/ico/coins-16.png" alt="Points" draggable="false"><strong class="text-primary"> ' + full['amount'] +
                            '</strong>'
                        );
                    }
                },
                {
                    responsivePriority: 4,
                    targets: 4,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        var $stat = full['status'];
                        var $status = {
                            0: { title: 'Processing', class: 'badge-light-primary' },
                            1: { title: 'Ready', class: 'badge-light-info' },
                            2: { title: 'Delivered', class: ' badge-light-success' },
                            3: { title: 'Cancelled', class: ' badge-light-danger' },
                            4: { title: 'On-hold', class: ' badge-light-warning' },
                            5: { title: 'Refunded', class: ' badge-light-success' }
                        };
                        if (full['status'] == 1) {
                            return (
                                '<button type="button" class="btn btn-relief-success">Claim</button>'
                            );
                        } else if (full['status'] == 2) {
                            return (
                                'SADA-SDWE-231SD'
                            );
                        } else {
                            return (
                                '<span class="badge badge-pill ' +
                                $status[$stat].class +
                                '">' +
                                $status[$stat].title +
                                '</span>'
                            );
                        }
                        
                    }
                }
                

            ]
        });
    }

});