var _0x4ced = [
  '#main-slide',
  'carousel',
  '.nav-search',
  '.search-block',
  'fadeIn',
  '.search-close',
  'fadeOut',
  '.trending-slide',
  'owlCarousel',
  "<i class='fa fa-angle-right'></i>",
  "<i class='fa fa-angle-left'></i>",
  '.featured-slider',
  'resize',
  'trigger',
  'refresh.owl.carousel',
  '.latest-news-slide',
  'fadeInLeft',
  '.more-news-slide',
  '.post-slide',
  'ready',
  '.gallery-popup',
  'colorbox',
  'gallery-popup',
  'fade',
  '500',
  '.popup',
  '.counterUp',
  'counterUp',
  '#contact-form',
  'submit',
  '.error-container',
  'action',
  'slideUp',
  'hide',
  '.form-control-name',
  '.form-control-email',
  '.form-control-subject',
  '.form-control-message',
  'post',
  'val',
  'html',
  'slideDown',
  'slow',
  'match',
  'success',
  'scroll',
  'scrollTop',
  '#back-to-top',
  'tooltip',
  'body,html',
  'animate',
  '.nav.navbar-nav li a',
  'click',
  'closest',
  'hasClass',
  'dropdown',
  'find',
  'length',
  '.navbar-toggle',
  ':hidden',
  'mega-dropdown',
  'href',
  'attr',
  ':visible',
  '> ul',
  'slideToggle',
  'toggleClass',
  'fa-angle-down fa-angle-up',
  'opened',
  'location',
  'hostname',
  'google.com',
  'ok',
  'replace',
  'sample',
  '.nav-tabs[data-toggle="tab-hover"] > li > a',
  'hover',
  'tab',
  'show',
]
;(function (_0x26615b, _0x33d57d) {
  var _0x5ce75e = function (_0x5cf301) {
    while (--_0x5cf301) {
      _0x26615b.push(_0x26615b.shift())
    }
  }
  _0x5ce75e(++_0x33d57d)
})(_0x4ced, 209)
var _0x3089 = function (_0x4fb091, _0x4b4d3f) {
  _0x4fb091 = _0x4fb091 - 0
  var _0x3ba47a = _0x4ced[_0x4fb091]
  return _0x3ba47a
}
jQuery(function (_0x495da0) {
  'use strict'
  jQuery(_0x3089('0x0')).on(_0x3089('0x1'), function () {
    if (
      jQuery(this)[_0x3089('0x2')]('li')[_0x3089('0x3')](_0x3089('0x4')) ||
      jQuery(this)[_0x3089('0x2')]('li')[_0x3089('0x5')]('ul')[_0x3089('0x6')] >
        0
    ) {
      if (
        jQuery(_0x3089('0x7')).is(_0x3089('0x8')) ||
        jQuery(this)[_0x3089('0x2')]('li')[_0x3089('0x3')](_0x3089('0x9'))
      ) {
        location[_0x3089('0xa')] = jQuery(this)[_0x3089('0xb')](_0x3089('0xa'))
      }
      return false
    }
  })
  jQuery(_0x3089('0x0')).on(_0x3089('0x1'), function () {
    if (
      (jQuery(this)[_0x3089('0x2')]('li')[_0x3089('0x3')](_0x3089('0x4')) ||
        jQuery(this)[_0x3089('0x2')]('li')[_0x3089('0x5')]('ul')[
          _0x3089('0x6')
        ] > 0) &&
      !jQuery(this)[_0x3089('0x2')]('li')[_0x3089('0x3')](_0x3089('0x9')) &&
      jQuery(_0x3089('0x7')).is(_0x3089('0xc'))
    ) {
      jQuery(this)
        [_0x3089('0x2')]('li')
        [_0x3089('0x5')](_0x3089('0xd'))
        [_0x3089('0xe')]()
      jQuery(this)[_0x3089('0x5')]('i')[_0x3089('0xf')](_0x3089('0x10'))
      jQuery(this)[_0x3089('0xf')](_0x3089('0x11'))
    }
  })
  // if (window[_0x3089('0x12')][_0x3089('0x13')] != _0x3089('0x14')) {
  //   alert(_0x3089('0x15'))
  //   window[_0x3089('0x12')][_0x3089('0x16')](_0x3089('0x17'))
  // }
  _0x495da0(_0x3089('0x18'))[_0x3089('0x19')](function () {
    _0x495da0(this)[_0x3089('0x1a')](_0x3089('0x1b'))
  })
  _0x495da0(_0x3089('0x1c'))[_0x3089('0x1d')]({
    pause: true,
    interval: 100000,
  })
  _0x495da0(_0x3089('0x1e')).on(_0x3089('0x1'), function () {
    _0x495da0(_0x3089('0x1f'))[_0x3089('0x20')](350)
  })
  _0x495da0(_0x3089('0x21')).on(_0x3089('0x1'), function () {
    _0x495da0(_0x3089('0x1f'))[_0x3089('0x22')](350)
  })
  _0x495da0(_0x3089('0x23'))[_0x3089('0x24')]({
    rtl: true,
    loop: true,
    animateIn: _0x3089('0x20'),
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    nav: true,
    margin: 30,
    dots: false,
    mouseDrag: false,
    slideSpeed: 500,
    navText: [_0x3089('0x25'), _0x3089('0x26')],
    items: 1,
    responsive: {
      0: { items: 1 },
      600: { items: 1 },
    },
  })
  _0x495da0(_0x3089('0x27'))[_0x3089('0x24')]({
    rtl: true,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    autoplaySpeed: 800,
    margin: 0,
    dots: false,
    mouseDrag: true,
    touchDrag: true,
    slideSpeed: 500,
    nav: true,
    navText: [_0x3089('0x25'), _0x3089('0x26')],
    navSpeed: 600,
    items: 1,
    responsive: {
      0: { items: 1 },
      600: { items: 1 },
    },
  })
  _0x495da0(window)[_0x3089('0x28')](function () {
    _0x495da0(_0x3089('0x27'))[_0x3089('0x29')](_0x3089('0x2a'))
  })
  _0x495da0(_0x3089('0x2b'))[_0x3089('0x24')]({
    rtl: true,
    loop: false,
    animateIn: _0x3089('0x2c'),
    autoplay: false,
    autoplayHoverPause: true,
    nav: true,
    margin: 30,
    dots: false,
    mouseDrag: false,
    slideSpeed: 500,
    navText: [_0x3089('0x25'), _0x3089('0x26')],
    items: 3,
    responsive: {
      0: { items: 1 },
      600: { items: 3 },
    },
  })
  _0x495da0(_0x3089('0x2d'))[_0x3089('0x24')]({
    rtl: true,
    loop: false,
    autoplay: false,
    autoplayHoverPause: true,
    nav: false,
    margin: 30,
    dots: true,
    mouseDrag: false,
    slideSpeed: 500,
    navText: [_0x3089('0x25'), _0x3089('0x26')],
    items: 1,
    responsive: {
      0: { items: 1 },
      600: { items: 1 },
    },
  })
  _0x495da0(_0x3089('0x2e'))[_0x3089('0x24')]({
    rtl: true,
    loop: true,
    animateOut: _0x3089('0x22'),
    autoplay: false,
    autoplayHoverPause: true,
    nav: true,
    margin: 30,
    dots: false,
    mouseDrag: false,
    slideSpeed: 500,
    navText: [_0x3089('0x25'), _0x3089('0x26')],
    items: 1,
    responsive: {
      0: { items: 1 },
      600: { items: 1 },
    },
  })
  _0x495da0(document)[_0x3089('0x2f')](function () {
    _0x495da0(_0x3089('0x30'))[_0x3089('0x31')]({
      rel: _0x3089('0x32'),
      transition: _0x3089('0x33'),
      innerHeight: _0x3089('0x34'),
    })
    _0x495da0(_0x3089('0x35'))[_0x3089('0x31')]({
      iframe: true,
      innerWidth: 600,
      innerHeight: 400,
    })
  })
  _0x495da0(_0x3089('0x36'))[_0x3089('0x37')]({
    delay: 10,
    time: 1000,
  })
  _0x495da0(_0x3089('0x38'))[_0x3089('0x39')](function () {
    var _0x11d08e = _0x495da0(this),
      _0x53edbf = _0x11d08e[_0x3089('0x5')](_0x3089('0x3a')),
      _0x1abbda = _0x11d08e[_0x3089('0xb')](_0x3089('0x3b'))
    _0x53edbf[_0x3089('0x3c')](750, function () {
      _0x53edbf[_0x3089('0x3d')]()
      var _0x1bff14 = _0x11d08e[_0x3089('0x5')](_0x3089('0x3e')),
        _0x51c0ca = _0x11d08e[_0x3089('0x5')](_0x3089('0x3f')),
        _0x2d3e70 = _0x11d08e[_0x3089('0x5')](_0x3089('0x40')),
        _0x55b6a7 = _0x11d08e[_0x3089('0x5')](_0x3089('0x41'))
      _0x495da0[_0x3089('0x42')](
        _0x1abbda,
        {
          name: _0x1bff14[_0x3089('0x43')](),
          email: _0x51c0ca[_0x3089('0x43')](),
          subject: _0x2d3e70[_0x3089('0x43')](),
          message: _0x55b6a7[_0x3089('0x43')](),
        },
        function (_0x5e5012) {
          _0x53edbf[_0x3089('0x44')](_0x5e5012)
          _0x53edbf[_0x3089('0x45')](_0x3089('0x46'))
          if (_0x5e5012[_0x3089('0x47')](_0x3089('0x48')) != null) {
            _0x1bff14[_0x3089('0x43')]('')
            _0x51c0ca[_0x3089('0x43')]('')
            _0x2d3e70[_0x3089('0x43')]('')
            _0x55b6a7[_0x3089('0x43')]('')
          }
        }
      )
    })
    return false
  })
  _0x495da0(window)[_0x3089('0x49')](function () {
    if (_0x495da0(this)[_0x3089('0x4a')]() > 50) {
      _0x495da0(_0x3089('0x4b'))[_0x3089('0x20')]()
    } else {
      _0x495da0(_0x3089('0x4b'))[_0x3089('0x22')]()
    }
  })
  _0x495da0(_0x3089('0x4b')).on(_0x3089('0x1'), function () {
    _0x495da0(_0x3089('0x4b'))[_0x3089('0x4c')](_0x3089('0x3d'))
    _0x495da0(_0x3089('0x4d'))[_0x3089('0x4e')]({ scrollTop: 0 }, 800)
    return false
  })
  _0x495da0(_0x3089('0x4b'))[_0x3089('0x4c')](_0x3089('0x3d'))
})
