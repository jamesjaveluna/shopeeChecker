$(window).on('load', function () {
    'use strict';

    var $trackBgColor = '#EBEBEB';
    var $earningsStrokeColor2 = '#28c76f66';
    var $earningsStrokeColor3 = '#28c76f33';

    var communityStar = $('#community-star');
    var communityRating = parseFloat(communityStar.attr('data-rating'));

    var shopeeStar = $('#shopee-star');
    var shopeeRating = parseFloat(shopeeStar.attr('data-rating'));

    var sellerStar = $('#seller_star');
    var sellerRating = parseFloat(sellerStar.attr('data-rating'));

    var productStar = $('#product_star');
    var productRating = parseFloat(productStar.attr('data-rating'));

    var viewResultBtn = $('#view-result');

    var $engagementRateSuccess = document.querySelector('#engagement-rate');
    var $browserStateChartPrimary = document.querySelector('#browser-state-chart-primary');
    var $browserStateChartWarning = document.querySelector('#browser-state-chart-warning');
    var $browserStateChartSecondary = document.querySelector('#browser-state-chart-secondary');
    var $browserStateChartInfo = document.querySelector('#browser-state-chart-info');
    var $browserStateChartDanger = document.querySelector('#browser-state-chart-danger');
    var $earningsChart = document.querySelector('#result-chart');

    var engagementRateOptions;
    var browserStatePrimaryChartOptions;
    var browserStateWarningChartOptions;
    var browserStateSecondaryChartOptions;
    var browserStateInfoChartOptions;
    var browserStateDangerChartOptions;
    var earningsChartOptions;

    var engagementSuccessRate;
    var browserStatePrimaryChart;
    var browserStateDangerChart;
    var browserStateInfoChart;
    var browserStateSecondaryChart;
    var browserStateWarningChart;
    var earningsChart;

    //var engagementValue = $engagementRateSuccess.getAttribute('data-value');
    let resultValue = parseInt($earningsChart.getAttribute('data-value'));
    let excessValue = parseInt($earningsChart.getAttribute('data-excess'));

    var searchUrl = $('#search_url');
    var searchUrl2 = $('#search_url2');

    var slide1 = $('.slide-1');
    var slide250 = $('.slide-250');
    var slide500 = $('.slide-500');
    var prepend2Slides = $('.prepend-2-slides');
    var appendSlide = $('.append-slide');

    communityStar.rateYo({
        rating: communityRating,
        readOnly: true,
        starWidth: "20px"
    });

    shopeeStar.rateYo({
        rating: shopeeRating,
        readOnly: true,
        starWidth: "20px"
    });

    sellerStar.rateYo({
        rating: sellerRating,
        readOnly: true,
        starWidth: "20px"
    });

    productStar.rateYo({
        rating: productRating,
        readOnly: true,
        starWidth: "20px"
    });

    // default
    var mySwiper = new Swiper('.swiper-default');

    // navigation
    var mySwiper1 = new Swiper('.swiper-navigations', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // pagination
    var mySwiper2 = new Swiper('.swiper-paginations', {
        pagination: {
            el: '.swiper-pagination'
        }
    });

    // progress
    var mySwiper3 = new Swiper('.swiper-progress', {
        pagination: {
            el: '.swiper-pagination',
            type: 'progressbar'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // multiple
    var mySwiper4 = new Swiper('.swiper-multiple', {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    });

    // multi row
    var mySwiper5 = new Swiper('.swiper-multi-row', {
        slidesPerView: 3,
        slidesPerColumn: 2,
        spaceBetween: 30,
        slidesPerColumnFill: 'row',
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    });

    // centered slides option-1
    var mySwiperOpt1 = new Swiper('.swiper-centered-slides', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // centered slides option-2

    var swiperLength = $('.swiper-slide').length;
    if (swiperLength) {
        swiperLength = Math.floor(swiperLength / 2);
    }

    var mySwiperOpt2 = new Swiper('.swiper-centered-slides-2', {
        slidesPerView: 'auto',
        initialSlide: swiperLength,
        centeredSlides: true,
        spaceBetween: 30,
        slideToClickedSlide: true
    });
    activeSlide(swiperLength);

    // Active slide change on swipe
    mySwiper.on('slideChange', function () {
        activeSlide(mySwiper.realIndex);
    });

    //add class active content of active slide
    function activeSlide(index) {
        var slideEl = mySwiper.slides[index];
        var slideId = $(slideEl).attr('id');
        $('.wrapper-content').removeClass('active');
        $('[data-faq=' + slideId + ']').addClass('active');
    }

    // fade effect
    var mySwiper7 = new Swiper('.swiper-fade-effect', {
        spaceBetween: 30,
        effect: 'fade',
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // cube effect
    var mySwiper8 = new Swiper('.swiper-cube-effect', {
        effect: 'cube',
        grabCursor: true,
        cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94
        },
        pagination: {
            el: '.swiper-pagination'
        }
    });

    // coverflow effect
    var mySwiper9 = new Swiper('.swiper-coverflow', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true
        },
        pagination: {
            el: '.swiper-pagination'
        }
    });

    // autoplay
    var mySwiper10 = new Swiper('.swiper-autoplay', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // gallery
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true
    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        thumbs: {
            swiper: galleryThumbs
        }
    });

    // parallax
    var mySwiper12 = new Swiper('.swiper-parallax', {
        speed: 600,
        parallax: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // lazy loading
    var mySwiper13 = new Swiper('.swiper-lazy-loading', {
        // Enable lazy loading
        lazy: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });

    // Responsive Breakpoints
    var mySwiper14 = new Swiper('.swiper-responsive-breakpoints', {
        slidesPerView: 5,
        spaceBetween: 50,
        // init: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 40
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });

    // virtual slides
    var appendNumber = 600;
    var prependNumber = 1;
    var mySwiper15 = new Swiper('.swiper-virtual', {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        virtual: {
            slides: (function () {
                var slides = [];
                for (var i = 0; i < 600; i += 1) {
                    slides.push('Slide ' + (i + 1));
                }
                return slides;
            })()
        }
    });
    // Go to first slide
    if (slide1) {
        slide1.on('click', function (e) {
            e.preventDefault();
            mySwiper15.slideTo(0, 0);
        });
    }
    // Go to slide 250
    if (slide250) {
        slide250.on('click', function (e) {
            e.preventDefault();
            mySwiper15.slideTo(249, 0);
        });
    }
    // Go to slide 500
    if (slide500) {
        slide500.on('click', function (e) {
            e.preventDefault();
            mySwiper15.slideTo(499, 0);
        });
    }
    // Prepend 2 slides
    if (prepend2Slides) {
        prepend2Slides.on('click', function (e) {
            e.preventDefault();
            mySwiper15.virtual.prependSlide(['Slide ' + --prependNumber, 'Slide ' + --prependNumber]);
        });
    }
    // Append a slide
    if (appendSlide) {
        appendSlide.on('click', function (e) {
            e.preventDefault();
            mySwiper15.virtual.appendSlide('Slide ' + ++appendNumber);
        });
    }

    //--------------- Earnings Chart ---------------
    //----------------------------------------------
    earningsChartOptions = {
        chart: {
            type: 'donut',
            height: 120,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        tooltip: {
            enabled: false
        },
        series: [excessValue, resultValue],
        legend: { show: false },
        comparedResult: [2, -3, 8],
        stroke: { width: 0 },
        colors: identifyType(resultValue),
        grid: {
            padding: {
                right: -20,
                bottom: -8,
                left: -20
            }
        },
        plotOptions: {
            pie: {
                expandOnClick: false,
                startAngle: -10,
                donut: {
                    labels: {
                        show: true,
                        value: {
                            show: true,
                            offsetY: -8,
                            fontSize: '20px',
                            formatter: function (val) {
                                return parseInt(val) + '%';
                            }
                        },
                        total: {
                            show: true,
                            showAlways: true,
                            offsetY: 15,
                            fontSize: '20px ',
                            label: '',
                            formatter: function (w) {
                                //return '53%';
                                return parseInt(resultValue) + '%';
                            }
                        }
                    }
                }
            }
        },
        responsive: [
            {
                breakpoint: 1325,
                options: {
                    chart: {
                        height: 100
                    }
                }
            },
            {
                breakpoint: 1200,
                options: {
                    chart: {
                        height: 120
                    }
                }
            },
            {
                breakpoint: 1045,
                options: {
                    chart: {
                        height: 100
                    }
                }
            },
            {
                breakpoint: 992,
                options: {
                    chart: {
                        height: 120
                    }
                }
            }
        ]
    };
    earningsChart = new ApexCharts($earningsChart, earningsChartOptions);
    earningsChart.render();


    // Engagement Rate
    /*engagementRateOptions = {
        chart: {
            height: 30,
            width: 30,
            type: 'radialBar'
        },
        grid: {
            show: false,
            padding: {
                left: -15,
                right: -15,
                top: -12,
                bottom: -15
            }
        },
        colors: [window.colors.solid.success],
        series: [engagementValue],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '22%'
                },
                track: {
                    background: $trackBgColor
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        show: false
                    },
                    value: {
                        show: false
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        }
    };
    engagementSuccessRate = new ApexCharts($engagementRateSuccess, engagementRateOptions);
    engagementSuccessRate.render();

    //------------ Browser State Charts ------------
    //----------------------------------------------

    // State Primary Chart
    browserStatePrimaryChartOptions = {
        chart: {
            height: 30,
            width: 30,
            type: 'radialBar'
        },
        grid: {
            show: false,
            padding: {
                left: -15,
                right: -15,
                top: -12,
                bottom: -15
            }
        },
        colors: [window.colors.solid.primary],
        series: [54.4],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '22%'
                },
                track: {
                    background: $trackBgColor
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        show: false
                    },
                    value: {
                        show: false
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        }
    };
    browserStatePrimaryChart = new ApexCharts($browserStateChartPrimary, browserStatePrimaryChartOptions);
    browserStatePrimaryChart.render();
    
    // State Warning Chart
    browserStateWarningChartOptions = {
        chart: {
            height: 30,
            width: 30,
            type: 'radialBar'
        },
        grid: {
            show: false,
            padding: {
                left: -15,
                right: -15,
                top: -12,
                bottom: -15
            }
        },
        colors: [window.colors.solid.warning],
        series: [6.1],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '22%'
                },
                track: {
                    background: $trackBgColor
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        show: false
                    },
                    value: {
                        show: false
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        }
    };
    browserStateWarningChart = new ApexCharts($browserStateChartWarning, browserStateWarningChartOptions);
    browserStateWarningChart.render();

    // State Secondary Chart 1
    browserStateSecondaryChartOptions = {
        chart: {
            height: 30,
            width: 30,
            type: 'radialBar'
        },
        grid: {
            show: false,
            padding: {
                left: -15,
                right: -15,
                top: -12,
                bottom: -15
            }
        },
        colors: [window.colors.solid.secondary],
        series: [14.6],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '22%'
                },
                track: {
                    background: $trackBgColor
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        show: false
                    },
                    value: {
                        show: false
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        }
    };
    browserStateSecondaryChart = new ApexCharts($browserStateChartSecondary, browserStateSecondaryChartOptions);
    browserStateSecondaryChart.render();

    // State Info Chart
    browserStateInfoChartOptions = {
        chart: {
            height: 30,
            width: 30,
            type: 'radialBar'
        },
        grid: {
            show: false,
            padding: {
                left: -15,
                right: -15,
                top: -12,
                bottom: -15
            }
        },
        colors: [window.colors.solid.info],
        series: [4.2],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '22%'
                },
                track: {
                    background: $trackBgColor
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        show: false
                    },
                    value: {
                        show: false
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        }
    };
    browserStateInfoChart = new ApexCharts($browserStateChartInfo, browserStateInfoChartOptions);
    browserStateInfoChart.render();

    // State Danger Chart
    browserStateDangerChartOptions = {
        chart: {
            height: 30,
            width: 30,
            type: 'radialBar'
        },
        grid: {
            show: false,
            padding: {
                left: -15,
                right: -15,
                top: -12,
                bottom: -15
            }
        },
        colors: [window.colors.solid.danger],
        series: [8.4],
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '22%'
                },
                track: {
                    background: $trackBgColor
                },
                dataLabels: {
                    showOn: 'always',
                    name: {
                        show: false
                    },
                    value: {
                        show: false
                    }
                }
            }
        },
        stroke: {
            lineCap: 'round'
        }
    };
    browserStateDangerChart = new ApexCharts($browserStateChartDanger, browserStateDangerChartOptions);
    browserStateDangerChart.render();

    function viewResult() {
        var summaryReport = document.getElementById("summary-report");
        summaryReport.scrollIntoView();
    }

    if (viewResultBtn.length) {
        viewResultBtn.on('click', function (e) {
            var summaryReport = document.getElementById("summary-report");
            summaryReport.scrollIntoView();
        });
    }
    */
    if (searchUrl.length) {
        searchUrl.keyup(function (event) {
            if (event.keyCode === 13) { // Enter key
               // var searchUrl = searchUrl.val();
                $.ajax({
                    type: "POST",
                    url: "../../process.php",
                    data: { url: searchUrl.val() },
                    success: function (response) {
                        // Handle successful response here
                        toastr[response.status](response.text, response.title, {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: false
                        });


                        if (response.status === "success" || response.status === "warning") {
                            window.location.href = response.slug;
                        }

                    },
                    error: function (xhr, status, error) {
                        // Handle error here
                        toastr['error']('Cannot proceed', 'Error Occured', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: false
                        });
                    }
                });
            }
        });
    }

    if (searchUrl2.length) {
        searchUrl2.keyup(function (event) {
            if (event.keyCode === 13) { // Enter key
                // var searchUrl = searchUrl.val();
                $.ajax({
                    type: "POST",
                    url: "../../process.php",
                    data: { url: searchUrl2.val() },
                    success: function (response) {
                        // Handle successful response here
                        toastr[response.status](response.text, response.title, {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: false
                        });


                        if (response.status === "success" || response.status === "warning") {
                            window.location.href = response.slug;
                        }

                    },
                    error: function (xhr, status, error) {
                        // Handle error here
                        alert('worked but error');
                    }
                });
            }
        });
    }

    function identifyType(number) {
        if (number < 50) {
            return [window.colors.light.danger,window.colors.solid.danger];
        } else if (number >= 50 && number < 80) {
            return [window.colors.light.warning, window.colors.solid.warning];
        } else if (number >= 80 && number <= 100) {
            return [window.colors.light.success, window.colors.solid.success];
        } else {
            return "invalid input";
        }
    }
});