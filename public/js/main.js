let body = document.querySelector('body')
let bodyWidth = body.offsetWidth;
let navSpan = document.querySelectorAll('.menu-item ul li span');

$('.nav-icon').click(function() {
    if ($('.sidebar').outerWidth() == "60") {
        $('.sidebar').css('width', '250px');
        $('.main-content').css({ 'margin-left': '250px', 'width': bodyWidth - 250 + 'px' });
        $('.icon').css('transform', 'translateX(10px)');
        $('.logo-desc').css({ 'opacity': 1, 'transition-delay': '.2s', })
        $('.icon-box').css('margin-left', '255px');
        $('.sub-menu ul').css({ 'display': 'block' });
        navSpan.forEach(el => {
            el.style.opacity = 1;
            el.style.transitionDelay = '.15s'
        })
    } else {
        $('.sidebar').css('width', '60px');
        $('.main-content').css({ 'margin-left': '60px', 'width': bodyWidth - 60 + 'px' });
        $('.icon').css('transform', 'translateX(10px)');
        $('.logo-desc').css({ 'opacity': 0, 'transition-delay': '.1s', })
        $('.icon-box').css('margin-left', '65px');
        $('.sub-menu ul').css({ 'display': 'none' });
        navSpan.forEach(el => {
            el.style.opacity = 0;
            el.style.transitionDelay = 0
        })
    }
})


$('.nav-icon').on('click ', function() {
    $(this).toggleClass('closed');
})

let toggle = true;
$('.sub-menu').on('click', function() {
    $(this.children[1]).slideToggle();
    let transform = $(this.children[0].children[1].children).css('transform')
    if (transform == 'matrix(1, 0, 0, 1, 0, 0)') {
        $(this.children[0].children[1].children).css('transform', 'rotate(90deg)');
        toggle = false;
    } else {
        $(this.children[0].children[1].children).css('transform', 'rotate(0deg)');
        toggle = true;
    }
})

let noti = true;
$('.uil-bell').on('click', function() {
    if (noti) {
        $('.notification-box').css('display', 'block');
        noti = false;
    } else {
        $('.notification-box').css('display', 'none');
        noti = true;
    }
})

let table = new DataTable('#myTable', {
    // options
});

$('.btn-danger').on('click', function(event) {
    var form = $(this).closest("form");
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
})