// page init
jQuery(function(){
    initMobileNav();
    initScrollTop();
    initAccordion();
    // initTabs();
});

// content tabs init
function initTabs() {
    jQuery('ul.tabset').contentTabs({
        addToParent: true,
        animSpeed: 400,
        //effect: 'slide',
        tabLinks: 'a'
    });
}

// accordion menu init
function initAccordion() {
    jQuery('ul.accordion').slideAccordion({
        opener: 'a.opener',
        slider: 'div.slide',
        animSpeed: 300
    });
}

// $(document).ready(function() {
//   $("#datepicker").datepicker();
//   $('.fa-calendar').click(function() {
//     $("#datepicker").focus();
//   });
// });





jQuery(document).ready(function($){
    $('.row').each(function(){
        var highestBox = 0;
        $('.sameheight', this).each(function(){
            if($(this).height() > highestBox) {
                highestBox = $(this).height();
            }
        });
        $('.sameheight',this).height(highestBox);
    });
});


function initScrollTop() {
    var win = jQuery(window);
    var headerClass = 'header-fixed';
    var scrollHeight = 1080;
    var header = jQuery('#wrapper');

    // add class to header
    function addClass(){
        var scrollTop = win.scrollTop();
        if (scrollTop > scrollHeight){
            header.addClass(headerClass);
        } else {
            header.removeClass(headerClass);
        }
    }
    initMobileNav
    win.on('scroll', addClass);

}


function initMobileNav() {
    jQuery('#wrapper').mobileNav({
        hideOnClickOutside: true,
        menuActiveClass: 'nav-active',
        menuOpener: '.nav-opener',
        menuDrop: '#nav'
    });
}

/*
 * Simple Mobile NavigationBar
 */
;(function($) {
    function MobileNav(options) {
        this.options = $.extend({
            container: null,
            hideOnClickOutside: false,
            menuActiveClass: 'nav-active',
            menuOpener: '.nav-opener',
            menuDrop: '.nav-drop',
            toggleEvent: 'click',
            outsideClickEvent: 'click touchstart pointerdown MSPointerDown'
        }, options);
        this.initStructure();
        this.attachEvents();
    }
    MobileNav.prototype = {
        initStructure: function() {
            this.page = $('html');
            this.container = $(this.options.container);
            this.opener = this.container.find(this.options.menuOpener);
            this.drop = this.container.find(this.options.menuDrop);
        },
        attachEvents: function() {
            var self = this;

            if(activateResizeHandler) {
                activateResizeHandler();
                activateResizeHandler = null;
            }

            this.outsideClickHandler = function(e) {
                if(self.isOpened()) {
                    var target = $(e.target);
                    if(!target.closest(self.opener).length && !target.closest(self.drop).length) {
                        self.hide();
                    }
                }
            };

            this.openerClickHandler = function(e) {
                e.preventDefault();
                self.toggle();
            };

            this.opener.on(this.options.toggleEvent, this.openerClickHandler);
        },
        isOpened: function() {
            return this.container.hasClass(this.options.menuActiveClass);
        },
        show: function() {
            this.container.addClass(this.options.menuActiveClass);
            if(this.options.hideOnClickOutside) {
                this.page.on(this.options.outsideClickEvent, this.outsideClickHandler);
            }
        },
        hide: function() {
            this.container.removeClass(this.options.menuActiveClass);
            if(this.options.hideOnClickOutside) {
                this.page.off(this.options.outsideClickEvent, this.outsideClickHandler);
            }
        },
        toggle: function() {
            if(this.isOpened()) {
                this.hide();
            } else {
                this.show();
            }
        },
        destroy: function() {
            this.container.removeClass(this.options.menuActiveClass);
            this.opener.off(this.options.toggleEvent, this.clickHandler);
            this.page.off(this.options.outsideClickEvent, this.outsideClickHandler);
        }
    };

    var activateResizeHandler = function() {
        var win = $(window),
            doc = $('html'),
            resizeClass = 'resize-active',
            flag, timer;
        var removeClassHandler = function() {
            flag = false;
            doc.removeClass(resizeClass);
        };
        var resizeHandler = function() {
            if(!flag) {
                flag = true;
                doc.addClass(resizeClass);
            }
            clearTimeout(timer);
            timer = setTimeout(removeClassHandler, 500);
        };
        win.on('resize orientationchange', resizeHandler);
    };

    $.fn.mobileNav = function(options) {
        return this.each(function() {
            var params = $.extend({}, options, {container: this}),
                instance = new MobileNav(params);
            $.data(this, 'MobileNav', instance);
        });
    };
}(jQuery));












/*
 * jQuery Tabs plugin
 */
;(function($){
    $.fn.contentTabs = function(o){
        // default options
        var options = $.extend({
            activeClass:'active',
            addToParent:false,
            autoHeight:false,
            autoRotate:false,
            checkHash:false,
            animSpeed:400,
            switchTime:3000,
            effect: 'none', // "fade", "slide"
            tabLinks:'a',
            attrib:'href',
            event:'click'
        },o);

        return this.each(function(){
            var tabset = $(this), tabs = $();
            var tabLinks = tabset.find(options.tabLinks);
            var tabLinksParents = tabLinks.parent();
            var prevActiveLink = tabLinks.eq(0), currentTab, animating;
            var tabHolder;

            // handle location hash
            if(options.checkHash && tabLinks.filter('[' + options.attrib + '="' + location.hash + '"]').length) {
                (options.addToParent ? tabLinksParents : tabLinks).removeClass(options.activeClass);
                setTimeout(function() {
                    window.scrollTo(0,0);
                },1);
            }

            // init tabLinks
            tabLinks.each(function(){
                var link = $(this);
                var href = link.attr(options.attrib);
                var parent = link.parent();
                href = href.substr(href.lastIndexOf('#'));

                // get elements
                var tab = $(href).hide().addClass(tabHiddenClass);
                tabs = tabs.add(tab);
                link.data('cparent', parent);
                link.data('ctab', tab);

                // find tab holder
                if(!tabHolder && tab.length) {
                    tabHolder = tab.parent();
                }

                // show only active tab
                var classOwner = options.addToParent ? parent : link;
                if(classOwner.hasClass(options.activeClass) || (options.checkHash && location.hash === href)) {
                    classOwner.addClass(options.activeClass);
                    prevActiveLink = link; currentTab = tab;
                    tab.removeClass(tabHiddenClass).width('');
                    contentTabsEffect[options.effect].show({tab:tab, fast:true});
                } else {
                    var tabWidth = tab.width();
                    if(tabWidth) {
                        tab.width(tabWidth);
                    }
                    tab.addClass(tabHiddenClass);
                }

                // event handler
                link.bind(options.event, function(e){
                    if(link != prevActiveLink && !animating) {
                        switchTab(prevActiveLink, link);
                        prevActiveLink = link;
                    }
                });
                if(options.attrib === 'href') {
                    link.bind('click', function(e){
                        e.preventDefault();
                    });
                }
            });

            // tab switch function
            function switchTab(oldLink, newLink) {
                animating = true;
                var oldTab = oldLink.data('ctab');
                var newTab = newLink.data('ctab');
                prevActiveLink = newLink;
                currentTab = newTab;

                // refresh pagination links
                (options.addToParent ? tabLinksParents : tabLinks).removeClass(options.activeClass);
                (options.addToParent ? newLink.data('cparent') : newLink).addClass(options.activeClass);

                // hide old tab
                resizeHolder(oldTab, true);
                contentTabsEffect[options.effect].hide({
                    speed: options.animSpeed,
                    tab:oldTab,
                    complete: function() {
                        // show current tab
                        resizeHolder(newTab.removeClass(tabHiddenClass).width(''));
                        contentTabsEffect[options.effect].show({
                            speed: options.animSpeed,
                            tab:newTab,
                            complete: function() {
                                if(!oldTab.is(newTab)) {
                                    oldTab.width(oldTab.width()).addClass(tabHiddenClass);
                                }
                                animating = false;
                                resizeHolder(newTab, false);
                                autoRotate();
                                $(window).trigger('resize');
                            }
                        });
                    }
                });
            }

            // holder auto height
            function resizeHolder(block, state) {
                var curBlock = block && block.length ? block : currentTab;
                if(options.autoHeight && curBlock) {
                    tabHolder.stop();
                    if(state === false) {
                        tabHolder.css({height:''});
                    } else {
                        var origStyles = curBlock.attr('style');
                        curBlock.show().css({width:curBlock.width()});
                        var tabHeight = curBlock.outerHeight(true);
                        if(!origStyles) curBlock.removeAttr('style'); else curBlock.attr('style', origStyles);
                        if(state === true) {
                            tabHolder.css({height: tabHeight});
                        } else {
                            tabHolder.animate({height: tabHeight}, {duration: options.animSpeed});
                        }
                    }
                }
            }
            if(options.autoHeight) {
                $(window).bind('resize orientationchange', function(){
                    tabs.not(currentTab).removeClass(tabHiddenClass).show().each(function(){
                        var tab = jQuery(this), tabWidth = tab.css({width:''}).width();
                        if(tabWidth) {
                            tab.width(tabWidth);
                        }
                    }).hide().addClass(tabHiddenClass);

                    resizeHolder(currentTab, false);
                });
            }

            // autorotation handling
            var rotationTimer;
            function nextTab() {
                var activeItem = (options.addToParent ? tabLinksParents : tabLinks).filter('.' + options.activeClass);
                var activeIndex = (options.addToParent ? tabLinksParents : tabLinks).index(activeItem);
                var newLink = tabLinks.eq(activeIndex < tabLinks.length - 1 ? activeIndex + 1 : 0);
                prevActiveLink = tabLinks.eq(activeIndex);
                switchTab(prevActiveLink, newLink);
            }
            function autoRotate() {
                if(options.autoRotate && tabLinks.length > 1) {
                    clearTimeout(rotationTimer);
                    rotationTimer = setTimeout(function() {
                        if(!animating) {
                            nextTab();
                        } else {
                            autoRotate();
                        }
                    }, options.switchTime);
                }
            }
            autoRotate();
        });
    };

    // add stylesheet for tabs on DOMReady
    var tabHiddenClass = 'js-tab-hidden';
    (function() {
        var tabStyleSheet = $('<style type="text/css">')[0];
        var tabStyleRule = '.'+tabHiddenClass;
        tabStyleRule += '{position:absolute !important;left:-9999px !important;top:-9999px !important;display:block !important}';
        if (tabStyleSheet.styleSheet) {
            tabStyleSheet.styleSheet.cssText = tabStyleRule;
        } else {
            tabStyleSheet.appendChild(document.createTextNode(tabStyleRule));
        }
        $('head').append(tabStyleSheet);
    }());

    // tab switch effects
    var contentTabsEffect = {
        none: {
            show: function(o) {
                o.tab.css({display:'block'});
                if(o.complete) o.complete();
            },
            hide: function(o) {
                o.tab.css({display:'none'});
                if(o.complete) o.complete();
            }
        },
        fade: {
            show: function(o) {
                if(o.fast) o.speed = 1;
                o.tab.fadeIn(o.speed);
                if(o.complete) setTimeout(o.complete, o.speed);
            },
            hide: function(o) {
                if(o.fast) o.speed = 1;
                o.tab.fadeOut(o.speed);
                if(o.complete) setTimeout(o.complete, o.speed);
            }
        },
        slide: {
            show: function(o) {
                var tabHeight = o.tab.show().css({width:o.tab.width()}).outerHeight(true);
                var tmpWrap = $('<div class="effect-div">').insertBefore(o.tab).append(o.tab);
                tmpWrap.css({width:'100%', overflow:'hidden', position:'relative'}); o.tab.css({marginTop:-tabHeight,display:'block'});
                if(o.fast) o.speed = 1;
                o.tab.animate({marginTop: 0}, {duration: o.speed, complete: function(){
                        o.tab.css({marginTop: '', width: ''}).insertBefore(tmpWrap);
                        tmpWrap.remove();
                        if(o.complete) o.complete();
                    }});
            },
            hide: function(o) {
                var tabHeight = o.tab.show().css({width:o.tab.width()}).outerHeight(true);
                var tmpWrap = $('<div class="effect-div">').insertBefore(o.tab).append(o.tab);
                tmpWrap.css({width:'100%', overflow:'hidden', position:'relative'});

                if(o.fast) o.speed = 1;
                o.tab.animate({marginTop: -tabHeight}, {duration: o.speed, complete: function(){
                        o.tab.css({display:'none', marginTop:'', width:''}).insertBefore(tmpWrap);
                        tmpWrap.remove();
                        if(o.complete) o.complete();
                    }});
            }
        }
    };
}(jQuery));


/*
 * jQuery Accordion plugin
 */
;(function($){
    $.fn.slideAccordion = function(opt){
        // default options
        var options = $.extend({
            addClassBeforeAnimation: false,
            allowClickWhenExpanded: false,
            activeClass:'active',
            opener:'.opener',
            slider:'.slide',
            animSpeed: 300,
            collapsible:true,
            event:'click'
        },opt);

        return this.each(function(){
            // options
            var accordion = $(this);
            var items = accordion.find(':has('+options.slider+')');

            items.each(function(){
                var item = $(this);
                var opener = item.find(options.opener);
                var slider = item.find(options.slider);
                opener.bind(options.event, function(e){
                    if(!slider.is(':animated')) {
                        if(item.hasClass(options.activeClass)) {
                            if(options.allowClickWhenExpanded) {
                                return;
                            } else if(options.collapsible) {
                                slider.slideUp(options.animSpeed, function(){
                                    hideSlide(slider);
                                    item.removeClass(options.activeClass);
                                });
                            }
                        } else {
                            // show active
                            var levelItems = item.siblings('.'+options.activeClass);
                            var sliderElements = levelItems.find(options.slider);
                            item.addClass(options.activeClass);
                            showSlide(slider).hide().slideDown(options.animSpeed);

                            // collapse others
                            sliderElements.slideUp(options.animSpeed, function(){
                                levelItems.removeClass(options.activeClass);
                                hideSlide(sliderElements);
                            });
                        }
                    }
                    e.preventDefault();
                });
                if(item.hasClass(options.activeClass)) showSlide(slider); else hideSlide(slider);
            });
        });
    };

    // accordion slide visibility
    var showSlide = function(slide) {
        return slide.css({position:'', top: '', left: '', width: '' });
    };
    var hideSlide = function(slide) {
        return slide.show().css({position:'absolute', top: -9999, left: -9999, width: slide.width() });
    };
}(jQuery));







//
// $(function () {
//     var bindDatePicker = function() {
//         $(".date").datetimepicker({
//             format:'YYYY-MM-DD',
//             icons: {
//                 time: "fa fa-clock-o",
//                 date: "fa fa-calendar",
//                 up: "fa fa-arrow-up",
//                 down: "fa fa-arrow-down"
//             }
//         }).find('input:first').on("blur",function () {
//             // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
//             // update the format if it's yyyy-mm-dd
//             var date = parseDate($(this).val());
//
//             if (! isValidDate(date)) {
//                 //create date based on momentjs (we have that)
//                 date = moment().format('YYYY-MM-DD');
//             }
//
//             $(this).val(date);
//         });
//     }
//
//     var isValidDate = function(value, format) {
//         format = format || false;
//         // lets parse the date to the best of our knowledge
//         if (format) {
//             value = parseDate(value);
//         }
//
//         var timestamp = Date.parse(value);
//
//         return isNaN(timestamp) == false;
//     }
//
//     var parseDate = function(value) {
//         var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
//         if (m)
//             value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);
//
//         return value;
//     }
//
//     bindDatePicker();
// });

